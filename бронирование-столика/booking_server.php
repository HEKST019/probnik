<?php
// booking_server.php - Сервер бронирования для PHP 5.6

// Включаем вывод ошибок
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Логирование
$debugFile = 'booking_debug.log';
file_put_contents($debugFile, date('Y-m-d H:i:s') . " - Booking request\n", FILE_APPEND);

header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// Файл для хранения бронирований
$bookingsFile = 'bookings.json';
$debugFile = 'booking_debug.log';

// Функция логирования
function log_booking($message) {
    file_put_contents('booking_debug.log', date('Y-m-d H:i:s') . " - " . $message . "\n", FILE_APPEND);
}

// Создаем файл если нет
if (!file_exists($bookingsFile)) {
    // Начальные данные - столики на сегодня
    $today = date('Y-m-d');
    $initialData = array();

    // Временные слоты с 10:00 до 22:00
    $timeSlots = array();
    for ($hour = 10; $hour <= 22; $hour++) {
        $timeSlot = $hour . ':00';
        $timeSlots[$timeSlot] = array();

        // 10 столиков
        for ($table = 1; $table <= 10; $table++) {
            $timeSlots[$timeSlot]['Столик ' . $table] = null;
        }
    }

    $initialData[$today] = $timeSlots;
    file_put_contents($bookingsFile, json_encode($initialData));
    log_booking("Created initial bookings file");
}

// Функция получения бронирований
function get_bookings() {
    global $bookingsFile;

    if (!file_exists($bookingsFile)) {
        return array();
    }

    $data = file_get_contents($bookingsFile);
    if ($data === false) {
        return array();
    }

    $bookings = json_decode($data, true);
    if ($bookings === null) {
        return array();
    }

    // Очищаем просроченные брони
    $cleanedBookings = clean_expired_bookings($bookings);
    if ($cleanedBookings != $bookings) {
        save_bookings($cleanedBookings);
    }

    return $cleanedBookings;
}

// Функция сохранения бронирований
function save_bookings($bookings) {
    global $bookingsFile;
    return file_put_contents($bookingsFile, json_encode($bookings)) !== false;
}

// Очистка просроченных броней
function clean_expired_bookings($bookings) {
    $now = time();

    foreach ($bookings as $date => &$slots) {
        foreach ($slots as $slot => &$tables) {
            foreach ($tables as $table => &$booking) {
                if ($booking !== null && isset($booking['expires_at'])) {
                    if ($booking['expires_at'] < $now) {
                        $booking = null; // Удаляем просроченную бронь
                    }
                }
            }
        }
    }

    return $bookings;
}

// Бронирование столика
function book_table($data) {
    $bookings = get_bookings();
    $today = date('Y-m-d');

    $slot = isset($data['slot']) ? $data['slot'] : '';
    $table = isset($data['table']) ? $data['table'] : '';
    $user_id = isset($data['user_id']) ? $data['user_id'] : '';
    $user_name = isset($data['user_name']) ? $data['user_name'] : 'Гость';

    if (empty($slot) || empty($table) || empty($user_id)) {
        return array('success' => false, 'error' => 'Неполные данные');
    }

    // Проверяем, существует ли дата
    if (!isset($bookings[$today])) {
        // Создаем новый день
        $bookings[$today] = array();
    }

    // Проверяем, существует ли временной слот
    if (!isset($bookings[$today][$slot])) {
        // Создаем новый временной слот
        $bookings[$today][$slot] = array();
    }

    // Проверяем, свободен ли столик
    if (isset($bookings[$today][$slot][$table]) && $bookings[$today][$slot][$table] !== null) {
        return array('success' => false, 'error' => 'Этот столик уже забронирован');
    }

    // Создаем бронь на 5 минут
    $expires_at = time() + 300; // 5 минут

    $booking = array(
        'user_id' => $user_id,
        'user_name' => $user_name,
        'booked_at' => time(),
        'expires_at' => $expires_at
    );

    $bookings[$today][$slot][$table] = $booking;

    if (save_bookings($bookings)) {
        log_booking("Table booked: $table at $slot by $user_name");
        return array('success' => true, 'booking' => $booking);
    } else {
        return array('success' => false, 'error' => 'Ошибка сохранения');
    }
}

// Отмена бронирования
function cancel_booking($data) {
    $bookings = get_bookings();
    $today = date('Y-m-d');

    $slot = isset($data['slot']) ? $data['slot'] : '';
    $table = isset($data['table']) ? $data['table'] : '';
    $user_id = isset($data['user_id']) ? $data['user_id'] : '';

    if (empty($slot) || empty($table) || empty($user_id)) {
        return array('success' => false, 'error' => 'Неполные данные');
    }

    // Проверяем, существует ли бронь
    if (!isset($bookings[$today][$slot][$table]) || $bookings[$today][$slot][$table] === null) {
        return array('success' => false, 'error' => 'Бронь не найдена');
    }

    $booking = $bookings[$today][$slot][$table];

    // Проверяем, принадлежит ли бронь пользователю
    if ($booking['user_id'] !== $user_id) {
        return array('success' => false, 'error' => 'Вы не можете отменить чужую бронь');
    }

    // Отменяем бронь
    $bookings[$today][$slot][$table] = null;

    if (save_bookings($bookings)) {
        log_booking("Booking canceled: $table at $slot by $user_id");
        return array('success' => true);
    } else {
        return array('success' => false, 'error' => 'Ошибка отмены');
    }
}

// Получаем данные запроса
$input = file_get_contents('php://input');
log_booking("Input: " . substr($input, 0, 200));

$action = '';
$request_data = array();

if (!empty($_POST['action'])) {
    $action = $_POST['action'];
    if (!empty($_POST['data'])) {
        $request_data = json_decode($_POST['data'], true);
        if ($request_data === null) {
            $request_data = array();
        }
    }
} elseif (!empty($input)) {
    $data = json_decode($input, true);
    if ($data !== null) {
        $action = isset($data['action']) ? $data['action'] : '';
        $request_data = isset($data['data']) ? $data['data'] : array();
    }
}

log_booking("Action: " . $action);

// Обработка запросов
$response = array('success' => false, 'error' => 'Unknown action');

try {
    switch ($action) {
        case 'get_bookings':
            $bookings = get_bookings();
            $response = array(
                'success' => true,
                'bookings' => $bookings
            );
            break;

        case 'book_table':
            $response = book_table($request_data);
            break;

        case 'cancel_booking':
            $response = cancel_booking($request_data);
            break;

        default:
            $response = array('success' => false, 'error' => 'Unknown action: ' . $action);
    }

} catch (Exception $e) {
    log_booking("Exception: " . $e->getMessage());
    $response = array('success' => false, 'error' => 'Server error');
}

// Отправляем ответ
echo json_encode($response);
log_booking("Response: " . substr(json_encode($response), 0, 200));
?>
