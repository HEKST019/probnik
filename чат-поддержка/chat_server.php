<?php
// chat_server.php - Версия для PHP 5.6 на Beget

// Включаем вывод ошибок
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Логирование
$debugFile = 'chat_debug.log';
file_put_contents($debugFile, date('Y-m-d H:i:s') . " - Start\n", FILE_APPEND);

// Простые заголовки
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// Файл для сообщений (в той же папке)
$messagesFile = 'chat_messages.json';

// Функция логирования для PHP 5.6
function log_debug($message) {
    file_put_contents('chat_debug.log', date('Y-m-d H:i:s') . " - " . $message . "\n", FILE_APPEND);
}

// Создаем файл если нет
if (!file_exists($messagesFile)) {
    file_put_contents($messagesFile, '[]');
    log_debug("Created messages file");
}

// Получаем данные (простой способ для PHP 5.6)
$input = file_get_contents('php://input');
log_debug("Input: " . substr($input, 0, 200));

$action = '';
$request_data = array();

// Пробуем разные способы получить данные
if (!empty($_POST['action'])) {
    // Форма данных
    $action = $_POST['action'];
    if (!empty($_POST['data'])) {
        $request_data = json_decode($_POST['data'], true);
        if ($request_data === null) {
            $request_data = array();
        }
    }
} elseif (!empty($input)) {
    // JSON данные
    $data = json_decode($input, true);
    if ($data !== null) {
        $action = isset($data['action']) ? $data['action'] : '';
        $request_data = isset($data['data']) ? $data['data'] : array();
    }
}

log_debug("Action: " . $action);
log_debug("Data: " . print_r($request_data, true));

// Функции для работы с сообщениями
function get_messages() {
    global $messagesFile;

    if (!file_exists($messagesFile)) {
        return array();
    }

    $data = file_get_contents($messagesFile);
    if ($data === false) {
        return array();
    }

    $messages = json_decode($data, true);
    return is_array($messages) ? $messages : array();
}

function save_message($message_data) {
    global $messagesFile;

    $messages = get_messages();

    // Простой ID
    $new_id = 1;
    if (!empty($messages)) {
        $last_msg = end($messages);
        $new_id = $last_msg['id'] + 1;
    }

    $new_message = array(
        'id' => $new_id,
        'text' => $message_data['text'],
        'user_id' => $message_data['user_id'],
        'user_name' => isset($message_data['user_name']) ? $message_data['user_name'] : 'User',
        'user_role' => isset($message_data['user_role']) ? $message_data['user_role'] : 'user',
        'time' => date('H:i'),
        'timestamp' => time()
    );

    $messages[] = $new_message;

    // Ограничиваем историю
    if (count($messages) > 100) {
        $messages = array_slice($messages, -100);
    }

    // Сохраняем
    $result = file_put_contents($messagesFile, json_encode($messages));
    return $result !== false ? $new_message : false;
}

// Обработка запросов
$response = array('success' => false, 'error' => 'Unknown action');

try {
    switch ($action) {
        case 'get_messages':
            $messages = get_messages();
            $response = array(
                'success' => true,
                'messages' => $messages
            );
            log_debug("Sent " . count($messages) . " messages");
            break;

        case 'get_new_messages':
            $last_id = isset($request_data['last_id']) ? intval($request_data['last_id']) : 0;
            $messages = get_messages();
            $new_messages = array();

            foreach ($messages as $msg) {
                if (isset($msg['id']) && $msg['id'] > $last_id) {
                    $new_messages[] = $msg;
                }
            }

            $response = array(
                'success' => true,
                'messages' => $new_messages
            );
            log_debug("New messages: " . count($new_messages));
            break;

        case 'send_message':
            $text = isset($request_data['text']) ? trim($request_data['text']) : '';
            $user_id = isset($request_data['user_id']) ? $request_data['user_id'] : '';

            if (!empty($text) && !empty($user_id)) {
                $message = save_message(array(
                    'text' => $text,
                    'user_id' => $user_id,
                    'user_name' => isset($request_data['user_name']) ? $request_data['user_name'] : 'User',
                    'user_role' => isset($request_data['user_role']) ? $request_data['user_role'] : 'user'
                ));

                if ($message) {
                    $response = array(
                        'success' => true,
                        'message' => $message
                    );
                    log_debug("Message saved: " . $text);
                } else {
                    $response = array(
                        'success' => false,
                        'error' => 'Save failed'
                    );
                }
            } else {
                $response = array(
                    'success' => false,
                    'error' => 'Empty text or user_id'
                );
            }
            break;

        default:
            $response = array(
                'success' => false,
                'error' => 'Unknown action: ' . $action
            );
    }

} catch (Exception $e) {
    log_debug("Exception: " . $e->getMessage());
    $response = array(
        'success' => false,
        'error' => 'Server error'
    );
}

// Отправляем ответ
echo json_encode($response);
log_debug("Response sent: " . substr(json_encode($response), 0, 200));
?>
