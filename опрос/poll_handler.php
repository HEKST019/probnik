<?php
// poll_handler.php
header('Content-Type: application/json');

// Конфигурация базы данных - укажите ваши данные
$host = 'localhost';
$dbname = 'stolovka'; // ваша база данных
$username = 'root'; // ваш пользователь БД
$password = 'root'; // ваш пароль БД

// Создаем соединение с БД
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(array('success' => false, 'message' => 'Ошибка подключения к БД: ' . $e->getMessage()));
    exit;
}

// Создаем идентификатор пользователя
$user_ip = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$userIdentifier = md5($user_ip . $user_agent);

$action = $_POST['action'];

if ($action == 'get_results') {
    // Получаем результаты опроса
    $stmt = $pdo->query("SELECT technology, votes FROM st_poll_votes ORDER BY technology");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalVotes = 0;
    foreach ($results as $result) {
        $totalVotes += $result['votes'];
    }

    echo json_encode(array(
        'success' => true,
        'results' => $results,
        'totalVotes' => $totalVotes
    ));

} elseif ($action == 'vote') {
    $technology = $_POST['technology'];

    // Проверяем, голосовал ли уже пользователь
    $stmt = $pdo->prepare("SELECT ID FROM st_poll_users WHERE user_browser_hash = ?");
    $stmt->execute(array($userIdentifier));

    if ($stmt->fetch()) {
        echo json_encode(array('success' => false, 'message' => 'Вы уже проголосовали!'));
        exit;
    }

    // Проверяем существование технологии
    $stmt = $pdo->prepare("SELECT ID FROM st_poll_votes WHERE technology = ?");
    $stmt->execute(array($technology));

    if (!$stmt->fetch()) {
        echo json_encode(array('success' => false, 'message' => 'Неверная технология'));
        exit;
    }

    // Начинаем транзакцию
    $pdo->beginTransaction();

    try {
        // Увеличиваем счетчик голосов
        $stmt = $pdo->prepare("UPDATE st_poll_votes SET votes = votes + 1 WHERE technology = ?");
        $stmt->execute(array($technology));

        // Сохраняем информацию о голосовании пользователя
        $stmt = $pdo->prepare("INSERT INTO st_poll_users (user_ip, user_browser_hash, voted_for, voted_at) VALUES (?, ?, ?, NOW())");
        $stmt->execute(array($user_ip, $userIdentifier, $technology));

        $pdo->commit();

        // Получаем обновленные результаты
        $stmt = $pdo->query("SELECT technology, votes FROM st_poll_votes ORDER BY technology");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $totalVotes = 0;
        foreach ($results as $result) {
            $totalVotes += $result['votes'];
        }

        echo json_encode(array(
            'success' => true,
            'message' => 'Спасибо за ваш голос!',
            'results' => $results,
            'totalVotes' => $totalVotes
        ));

    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode(array('success' => false, 'message' => 'Ошибка при голосовании: ' . $e->getMessage()));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Неизвестное действие'));
}
?>
