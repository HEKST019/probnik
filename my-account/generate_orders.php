<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Проверка авторизации
if (empty($_COOKIE['user']) || $_COOKIE['user'] != 'admin1') {
    die("Доступ запрещен. Требуется авторизация администратора.");
}

// Подключение к БД
require 'configDB.php';

// Получение данных
try {
    $query = $pdo->query('SELECT * FROM `st_order_addresses` ORDER BY `order_id` DESC');
    $orders = $query->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    die("Ошибка получения данных: " . $e->getMessage());
}

// Обработка формы
if (isset($_POST['generate'])) {
    $format = $_POST['format'];

    try {
        switch ($format) {
            case 'xlsx':
                generateExcel($orders);
                break;

            case 'docx':
                generateWord($orders);
                break;

            case 'csv':
                generateCSV($orders);
                break;

            default:
                die("Неизвестный формат: $format");
        }
    } catch (Exception $e) {
        die("Ошибка генерации: " . $e->getMessage());
    }
}

// Функция генерации Excel
function generateExcel($orders) {
    // Создаем простой HTML который Excel откроет как XLS
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="orders_export.xls"');

    echo '<html><head><meta charset="UTF-8"></head><body>';
    echo '<table border="1">';
    echo '<tr style="background-color: #40B198; color: white; font-weight: bold;">';
    echo '<th>ID заказа</th><th>Тип адреса</th><th>Имя</th><th>Фамилия</th><th>Адрес 1</th><th>Адрес 2</th><th>Город</th><th>Индекс</th><th>Страна</th><th>Email</th><th>Телефон</th>';
    echo '</tr>';

    foreach ($orders as $order) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($order->order_id) . '</td>';
        echo '<td>' . htmlspecialchars($order->address_type) . '</td>';
        echo '<td>' . htmlspecialchars($order->first_name) . '</td>';
        echo '<td>' . htmlspecialchars($order->last_name) . '</td>';
        echo '<td>' . htmlspecialchars($order->address_1) . '</td>';
        echo '<td>' . htmlspecialchars($order->address_2) . '</td>';
        echo '<td>' . htmlspecialchars($order->city) . '</td>';
        echo '<td>' . htmlspecialchars($order->postcode) . '</td>';
        echo '<td>' . htmlspecialchars($order->country) . '</td>';
        echo '<td>' . htmlspecialchars($order->email) . '</td>';
        echo '<td>' . htmlspecialchars($order->phone) . '</td>';
        echo '</tr>';
    }

    echo '</table></body></html>';
    exit;
}

// Функция генерации Word
function generateWord($orders) {
    // Создаем простой HTML который Word откроет как DOC
    header('Content-Type: application/msword');
    header('Content-Disposition: attachment; filename="orders_export.doc"');

    echo '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns="http://www.w3.org/TR/REC-html40">';
    echo '<head><meta charset="UTF-8"><title>Экспорт заказов</title></head>';
    echo '<body>';
    echo '<h1>Экспорт заказов</h1>';
    echo '<p>Дата формирования: ' . date('d.m.Y H:i') . '</p>';
    echo '<p>Всего заказов: ' . count($orders) . '</p>';

    echo '<table border="1" cellpadding="5" style="border-collapse: collapse; width: 100%;">';
    echo '<tr style="background-color: #40B198; color: white;">';
    echo '<th>ID заказа</th><th>Тип адреса</th><th>Имя</th><th>Фамилия</th><th>Email</th><th>Телефон</th>';
    echo '</tr>';

    foreach ($orders as $order) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($order->order_id) . '</td>';
        echo '<td>' . htmlspecialchars($order->address_type) . '</td>';
        echo '<td>' . htmlspecialchars($order->first_name) . '</td>';
        echo '<td>' . htmlspecialchars($order->last_name) . '</td>';
        echo '<td>' . htmlspecialchars($order->email) . '</td>';
        echo '<td>' . htmlspecialchars($order->phone) . '</td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '</body></html>';
    exit;
}

// Функция генерации CSV
function generateCSV($orders) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="orders_export.csv"');

    $output = fopen('php://output', 'w');
    fwrite($output, "\xEF\xBB\xBF"); // BOM для UTF-8

    fputcsv($output, [
        'ID заказа', 'Тип адреса', 'Имя', 'Фамилия', 'Адрес 1',
        'Адрес 2', 'Город', 'Индекс', 'Страна', 'Email', 'Телефон'
    ], ';');

    foreach ($orders as $order) {
        fputcsv($output, [
            $order->order_id,
            $order->address_type,
            $order->first_name,
            $order->last_name,
            $order->address_1,
            $order->address_2,
            $order->city,
            $order->postcode,
            $order->country,
            $order->email,
            $order->phone
        ], ';');
    }

    fclose($output);
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru-RU">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Мой аккаунт — Столовая</title>
   <link rel="stylesheet" href="/style.css">
   <link rel="stylesheet" href="/styleM.css">
   <link rel="stylesheet" href="/styleMM.css">
   <link rel="stylesheet" href="/styleF.css">
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
</head>

<body class="site-body">
   <div class="site-wrapper">
       <!-- Шапка -->
       <header class="site-header">
           <div class="header-container">
               <div class="site-logo">
                   <h3><a href="/">Столовая</a></h3>
               </div>

               <nav class="main-nav">
                   <ul>
                       <li><a href="/shop/">Магазин</a></li>
                       <li><a href="/новости-и-акции/">Новости</a></li>
                       <li><a href="/акции/">Акции</a></li>
                       <li><a href="/доставка/">Доставка</a></li>
                       <li><a href="/контакты/">Контакты</a></li>
                       <li><a href="/о-компании/">О компании</a></li>
                       <li><a href="/my-account/">Мой аккаунт</a></li>
                       <li><a href="/cart/">Корзина</a></li>
                   </ul>
               </nav>
           </div>
       </header>

       <!-- Заголовок страницы -->
       <div class="page-header">
           <div class="site-wrapper">
               <div class="breadcrumbs">
                   <a href="/">Главная</a> > Мой аккаунт
               </div>
               <h1 class="page-title">Мой аккаунт</h1>
           </div>
       </div>

       <!-- Основной контент -->
       <main class="main-content">
           <div class="site-wrapper">
               <div class="content-section">




    <div class="container">
        <h1 style="text-align: center; color: #2c3e50; margin-bottom: 30px;">📊 Генерация отчетов по заказам</h1>

        <div class="stats">
            <h2>Найдено заказов: <span style="color: #40B198;"><?= count($orders) ?></span></h2>
        </div>

        <form method="post">
            <h3 style="color: #2c3e50; margin-bottom: 20px;">Выберите формат:</h3>

            <div class="format-option">
                <input type="radio" name="format" value="xlsx" id="xlsx" required>
                <label for="xlsx">
                    <span class="format-icon">📈</span>
                    Excel файл (.xls)
                </label>
            </div>

            <div class="format-option">
                <input type="radio" name="format" value="docx" id="docx">
                <label for="docx">
                    <span class="format-icon">📝</span>
                    Word документ (.doc)
                </label>
            </div>

            <div class="format-option">
                <input type="radio" name="format" value="csv" id="csv">
                <label for="csv">
                    <span class="format-icon">📊</span>
                    CSV файл (для Excel)
                </label>
            </div>
            
            <button type="submit" name="generate" class="btn-secondary">
                🚀 Сгенерировать отчет
            </button>
        </form>

        <div style="text-align: center; margin-top: 30px;">
            <a href="/my-account/" style="color: #666; text-decoration: none; font-size: 16px;">
                ← Вернуться к списку заказов
            </a>
        </div>


    </div>

  </div>
</div>
</main>

<!-- Подвал -->
<footer class="site-footer">
<div class="site-wrapper">
  <div class="footer-content">
      <div class="site-logo">
          <h3><a href="/">Столовая</a></h3>
      </div>
      <p class="footer-text">© 2025 Столовая. Дёмин Александр Николаевич. Все права защищены.</p>
  </div>
</div>
</footer>
</div>
</body>
</html>
