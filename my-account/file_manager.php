<?php
// Для PHP 5.6 - старая версия синтаксиса для Столовой

// Простейшая проверка авторизации
if (!isset($_COOKIE['user']) || $_COOKIE['user'] != 'admin1') {
    die("Доступ запрещен. Требуется авторизация администратора.");
}

// Базовая директория
$base_dir = $_SERVER['DOCUMENT_ROOT'];
$current_dir = $base_dir;

// Обработка параметра dir (старый синтаксис)
if (isset($_GET['dir']) && !empty($_GET['dir'])) {
    $requested_dir = $base_dir . '/' . $_GET['dir'];
    if (is_dir($requested_dir)) {
        $current_dir = $requested_dir;
    }
}

// Простые функции (без современного синтаксиса)
if (isset($_GET['action']) && isset($_GET['file'])) {
    $file_path = $base_dir . '/' . $_GET['file'];

    if (file_exists($file_path)) {
        switch ($_GET['action']) {
            case 'download':
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
                readfile($file_path);
                exit();
                break;

            case 'view':
                if (is_file($file_path)) {
                    header('Content-Type: text/plain');
                    readfile($file_path);
                    exit();
                }
                break;

            case 'delete':
                if (is_file($file_path)) {
                    unlink($file_path);
                } elseif (is_dir($file_path)) {
                    // Простое удаление пустой папки
                    rmdir($file_path);
                }
                $redirect_dir = isset($_GET['dir']) ? $_GET['dir'] : '';
                header('Location: ?dir=' . urlencode($redirect_dir));
                exit();
                break;
        }
    }
}

// Загрузка файлов (старый синтаксис)
if (isset($_POST['upload']) && isset($_FILES['file'])) {
    $target_file = $current_dir . '/' . basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        $redirect_dir = isset($_GET['dir']) ? $_GET['dir'] : '';
        header('Location: ?dir=' . urlencode($redirect_dir));
        exit();
    }
}

// Создание папки (старый синтаксис)
if (isset($_POST['create_folder']) && !empty($_POST['folder_name'])) {
    $new_folder = $current_dir . '/' . $_POST['folder_name'];
    if (!file_exists($new_folder)) {
        mkdir($new_folder, 0755);
        $redirect_dir = isset($_GET['dir']) ? $_GET['dir'] : '';
        header('Location: ?dir=' . urlencode($redirect_dir));
        exit();
    }
}

// Получаем список файлов (старый синтаксис массивов)
$files = scandir($current_dir);
$files = array_diff($files, array('.', '..'));

// Функция для размера файла
function formatSize($bytes) {
    if ($bytes == 0) return '0 B';
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    $i = floor(log($bytes, 1024));
    return round($bytes / pow(1024, $i), 2) . ' ' . $units[$i];
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
                   <h2 class="poll-title">Файловый менеджер</h2>

                   <div class="container">
                       <h1>📁 Файловый менеджер</h1>

                       <div class="breadcrumb">
                           <a href="?">Корень сайта</a>
                           <?php
                           if (isset($_GET['dir'])) {
                               $parts = explode('/', $_GET['dir']);
                               $current_path = '';
                               foreach ($parts as $part) {
                                   if (!empty($part)) {
                                       $current_path .= $current_path ? '/' . $part : $part;
                                       echo ' / <a href="?dir=' . $current_path . '">' . $part . '</a>';
                                   }
                               }
                           }
                           ?>
                       </div>

                       <h3>Папка: <?php echo basename($current_dir); ?></h3>

                       <?php if (empty($files)): ?>
                           <p>Папка пуста</p>
                       <?php else: ?>
                           <?php foreach ($files as $file): ?>
                           <?php
                           $file_path = $current_dir . '/' . $file;
                           $is_dir = is_dir($file_path);
                           $file_size = $is_dir ? '' : formatSize(filesize($file_path));
                           $relative_path = isset($_GET['dir']) ? $_GET['dir'] . '/' . $file : $file;
                           $current_dir_param = isset($_GET['dir']) ? $_GET['dir'] : '';
                           ?>
                           <div class="file-item">
                               <div>
                                   <?php if ($is_dir): ?>
                                       <strong>📁</strong>
                                       <a href="?dir=<?php echo $relative_path; ?>" style="color: #2c3e50; text-decoration: none;">
                                           <?php echo $file; ?>/
                                       </a>
                                   <?php else: ?>
                                       <strong>📄</strong> <?php echo $file; ?>
                                   <?php endif; ?>
                                   <?php if (!$is_dir): ?>
                                       <br><small>Размер: <?php echo $file_size; ?></small>
                                   <?php endif; ?>
                               </div>
                               <div>
                                   <?php if (!$is_dir): ?>
                                       <a href="?action=view&file=<?php echo $relative_path; ?>&dir=<?php echo $current_dir_param; ?>" class="btn btn-view">Просмотр</a>
                                       <a href="?action=download&file=<?php echo $relative_path; ?>&dir=<?php echo $current_dir_param; ?>" class="btn btn-download">Скачать</a>
                                   <?php endif; ?>
                                   <a href="?action=delete&file=<?php echo $relative_path; ?>&dir=<?php echo $current_dir_param; ?>" class="btn btn-delete"
                                      onclick="return confirm('Удалить <?php echo $file; ?>?')">Удалить</a>
                               </div>
                           </div>
                           <?php endforeach; ?>
                       <?php endif; ?>

                       <div class="upload-form">
                           <h4>📤 Загрузить файл</h4>
                           <form method="post" enctype="multipart/form-data">
                               <input type="file" name="file" required style="margin: 10px 0; display: block;">
                               <button type="submit" name="upload" style="background: #3498db; color: white; padding: 10px; border: none; border-radius: 3px; cursor: pointer;">Загрузить файл</button>
                           </form>
                       </div>

                       <div class="upload-form">
                           <h4>📂 Создать папку</h4>
                           <form method="post">
                               <input type="text" name="folder_name" placeholder="Название папки" required style="padding: 8px; width: 300px; margin: 10px 0; display: block;">
                               <button type="submit" name="create_folder" style="background: #27ae60; color: white; padding: 10px; border: none; border-radius: 3px; cursor: pointer;">Создать папку</button>
                           </form>
                       </div>
                   </div>

                   <script type="text/javascript">
                       function confirmDelete(filename) {
                           return confirm('Вы уверены, что хотите удалить ' + filename + '?');
                       }
                   </script>
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
