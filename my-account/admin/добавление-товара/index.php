<?php
// Проверка авторизации для PHP 5.6
if (!isset($_COOKIE['user']) || $_COOKIE['user'] != 'admin1') {
    die("Доступ запрещен. Требуется авторизация администратора.");
}

require '../../configDB.php';

// Функция для создания страницы товара
function create_product_page($product_id, $product_data, $pdo) {
    $product_dir = "../../../product/{$product_id}";

    // Создаем директорию если не существует
    if (!file_exists($product_dir)) {
        mkdir($product_dir, 0755, true);
    }

    // HTML шаблон страницы товара
    $html_content = <<<HTML
<?php
session_start();
require_once '../../shop/configDB.php';
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$product_data['name']} — Столовая</title>
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/styleM.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .product-detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin: 40px 0;
        }

        .product-images {
            position: relative;
        }

        .main-product-image {
            background: #f5f5f5;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .product-img {
            width: 100%;
            height: auto;
            display: block;
        }

        .product-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #ff4444;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .product-info {
            padding: 20px 0;
        }

        .product-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #333;
        }

        .product-price {
            margin: 20px 0;
        }

        .current-price {
            font-size: 24px;
            font-weight: 700;
            color: #0AAA09;
        }

        .old-price {
            font-size: 18px;
            color: #999;
            text-decoration: line-through;
            margin-right: 10px;
        }

        .product-description {
            margin: 20px 0;
            line-height: 1.6;
        }

        .product-stock {
            margin: 20px 0;
        }

        .in-stock {
            color: #0AAA09;
            font-weight: 600;
        }

        .out-of-stock {
            color: #ff4444;
            font-weight: 600;
        }

        .add-to-cart-btn {
            display: inline-block;
            background: #0AAA09;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: background 0.3s ease;
            cursor: pointer;
        }

        .add-to-cart-btn:hover {
            background: #089908;
        }

        .out-of-stock-btn {
            display: inline-block;
            background: #ccc;
            color: #666;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            cursor: not-allowed;
        }

        .product-meta {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .product-sku, .product-calories {
            margin-bottom: 10px;
        }

        .product-tabs {
            margin: 60px 0;
        }

        .tabs-navigation {
            display: flex;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .tab-btn {
            padding: 15px 30px;
            background: none;
            border: none;
            border-bottom: 3px solid transparent;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
        }

        .tab-btn.active {
            border-bottom-color: #0AAA09;
            color: #0AAA09;
        }

        .tab-pane {
            display: none;
            padding: 20px 0;
        }

        .tab-pane.active {
            display: block;
        }

        .product-attributes {
            width: 100%;
            border-collapse: collapse;
        }

        .product-attributes th,
        .product-attributes td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        .product-attributes th {
            width: 200px;
            font-weight: 600;
        }

        .related-products {
            margin-top: 60px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            margin: 40px 0;
        }

        @media (max-width: 768px) {
            .product-detail {
                grid-template-columns: 1fr;
            }
        }
    </style>
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
                    <a href="/">Главная</a> > <a href="/shop/">Магазин</a> > {$product_data['name']}
                </div>
                <h1 class="page-title">{$product_data['name']}</h1>
            </div>
        </div>

        <!-- Основной контент -->
        <main class="main-content">
            <div class="site-wrapper">
                <div class="content-section">
                    <div class="product-detail">
                        <div class="product-images">
                            <div class="main-product-image">
                                <img src="{$product_data['image']}" alt="{$product_data['name']}" class="product-img">
                                {$product_data['badge']}
                            </div>
                        </div>

                        <div class="product-info">
                            <h2 class="product-title">{$product_data['name']}</h2>

                            <div class="product-price">
                                {$product_data['price_html']}
                            </div>

                            <div class="product-description">
                                <p>{$product_data['description']}</p>
                            </div>

                            <div class="product-stock">
                                <p class="{$product_data['stock_class']}">{$product_data['stock_text']}</p>
                            </div>

                            <div class="product-actions">
                                {$product_data['action_button']}
                            </div>

                            <div class="product-meta">
                                <div class="product-sku">
                                    <strong>Артикул:</strong> <span>{$product_data['sku']}</span>
                                </div>
                                {$product_data['calories_html']}
                            </div>
                        </div>
                    </div>

                    <!-- Табы с информацией -->
                    <div class="product-tabs">
                        <div class="tabs-navigation">
                            <button class="tab-btn active" data-tab="description">Описание</button>
                            <button class="tab-btn" data-tab="details">Детали</button>
                        </div>

                        <div class="tab-content">
                            <div id="description" class="tab-pane active">
                                <h3>Описание</h3>
                                <p>{$product_data['description']}</p>
                            </div>

                            <div id="details" class="tab-pane">
                                <h3>Детали</h3>
                                <table class="product-attributes">
                                    {$product_data['attributes']}
                                </table>
                            </div>
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Обработка табов
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabPanes = document.querySelectorAll('.tab-pane');

        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');

                // Убираем активный класс у всех кнопок и панелей
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabPanes.forEach(pane => pane.classList.remove('active'));

                // Добавляем активный класс текущей кнопке и панели
                this.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });
    });
    </script>
</body>
</html>
HTML;

    // Сохраняем файл
    file_put_contents("{$product_dir}/index.php", $html_content);

    return file_exists("{$product_dir}/index.php");
}

// Обработка удаления товара
if (isset($_GET['delete'])) {
    $product_id = intval($_GET['delete']);

    try {
        $pdo->beginTransaction();

        // 1. Удаляем из st_postmeta
        $stmt = $pdo->prepare("DELETE FROM st_postmeta WHERE post_id = ?");
        $stmt->execute(array($product_id));

        // 2. Удаляем из st_wc_product_meta_lookup (если таблица существует)
        try {
            $stmt = $pdo->prepare("DELETE FROM st_wc_product_meta_lookup WHERE product_id = ?");
            $stmt->execute(array($product_id));
        } catch (Exception $e) {
            // Игнорируем ошибку если таблицы нет
            error_log("WC meta lookup table not found: " . $e->getMessage());
        }

        // 3. Удаляем из st_posts (меняем статус на trash вместо полного удаления)
        $stmt = $pdo->prepare("UPDATE st_posts SET post_status = 'trash' WHERE ID = ?");
        $stmt->execute(array($product_id));

        // 4. Удаляем папку с страницей товара
        $product_dir = "../../../product/{$product_id}";
        if (file_exists($product_dir)) {
            // Удаляем все файлы в папке
            $files = glob("{$product_dir}/*");
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            // Удаляем саму папку
            rmdir($product_dir);
        }

        $pdo->commit();
        $message = "Товар успешно удален!";
        $message_class = "success";

    } catch (Exception $e) {
        $pdo->rollBack();
        $message = "Ошибка при удалении товара: " . $e->getMessage();
        $message_class = "error";
    }
}

// Обработка формы добавления/редактирования
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = isset($_POST['post_id']) ? $_POST['post_id'] : '';
    $product_name = trim($_POST['product_name']);
    $product_description = trim($_POST['product_description']);
    $price = floatval($_POST['price']);
    $sale_price = floatval($_POST['sale_price']);
    $sku = trim($_POST['sku']);
    $stock_quantity = intval($_POST['stock_quantity']);
    $weight = floatval($_POST['weight']);
    $calories = intval($_POST['calories']);

    if (!empty($product_name) && $price > 0) {
        try {
            $pdo->beginTransaction();

            if (empty($post_id)) {
                // Добавление нового товара

                // 1. Добавляем запись в st_posts (все обязательные поля)
                $stmt = $pdo->prepare("INSERT INTO st_posts
                    (post_author, post_date, post_date_gmt, post_content, post_title,
                     post_excerpt, post_status, comment_status, ping_status,
                     post_password, post_name, to_ping, pinged, post_modified,
                     post_modified_gmt, post_content_filtered, post_parent, guid,
                     menu_order, post_type, post_mime_type, comment_count)
                    VALUES
                    (1, NOW(), NOW(), ?, ?, '', 'publish', 'open', 'open',
                     '', ?, '', '', NOW(), NOW(), '', 0, '', 0, 'product', '', 0)");

                $post_name = preg_replace('/[^a-z0-9]+/i', '-', strtolower($product_name));
                $stmt->execute(array($product_description, $product_name, $post_name));
                $post_id = $pdo->lastInsertId();

                // 2. Добавляем мета-данные в st_postmeta
                $meta_data = array(
                    '_price' => $sale_price > 0 ? $sale_price : $price,
                    '_regular_price' => $price,
                    '_sale_price' => $sale_price > 0 ? $sale_price : '',
                    '_sku' => $sku,
                    '_stock' => $stock_quantity,
                    '_weight' => $weight,
                    '_calories' => $calories,
                    '_manage_stock' => 'yes',
                    '_stock_status' => $stock_quantity > 0 ? 'instock' : 'outofstock',
                    '_visibility' => 'visible',
                    '_tax_status' => 'taxable',
                    '_tax_class' => '',
                    '_purchase_note' => '',
                    '_featured' => 'no',
                    '_virtual' => 'no',
                    '_downloadable' => 'no',
                    '_sold_individually' => 'no',
                    '_backorders' => 'no'
                );

                foreach ($meta_data as $meta_key => $meta_value) {
                    $stmt = $pdo->prepare("INSERT INTO st_postmeta (post_id, meta_key, meta_value) VALUES (?, ?, ?)");
                    $stmt->execute(array($post_id, $meta_key, $meta_value));
                }


                // 3. Добавляем запись в st_wc_product_meta_lookup
                try {
                    // Проверяем существование таблицы
                    $table_exists = $pdo->query("SHOW TABLES LIKE 'st_wc_product_meta_lookup'")->rowCount() > 0;

                    if (!$table_exists) {
                        error_log("DEBUG: Table st_wc_product_meta_lookup does not exist");
                        throw new Exception("Table does not exist");
                    }

                    error_log("DEBUG: Table exists, proceeding with insert");

                    // Получаем структуру таблицы для отладки
                    $structure = $pdo->query("DESCRIBE st_wc_product_meta_lookup")->fetchAll(PDO::FETCH_ASSOC);
                    error_log("DEBUG: Table structure: " . print_r($structure, true));

                    // Простой INSERT запрос только с обязательными полями
                    $stmt = $pdo->prepare("INSERT INTO st_wc_product_meta_lookup
                        (product_id, sku, min_price, max_price, stock_quantity, stock_status, calories)
                        VALUES (?, ?, ?, ?, ?, ?, ?)");

                    $min_max_price = $sale_price > 0 ? $sale_price : $price;
                    $stock_status = $stock_quantity > 0 ? 'instock' : 'outofstock';

                    error_log("DEBUG: Insert values: product_id=$post_id, sku=$sku, price=$min_max_price, stock=$stock_quantity, status=$stock_status, calories=$calories");

                    $result = $stmt->execute([$post_id, $sku, $min_max_price, $min_max_price, $stock_quantity, $stock_status, $calories]);

                    if ($result) {
                        $inserted_id = $pdo->lastInsertId();
                        error_log("SUCCESS: Inserted into WC meta lookup. Last insert ID: $inserted_id");
                    } else {
                        error_log("ERROR: Execute returned false");
                    }

                } catch (Exception $e) {
                    error_log("CRITICAL ERROR: WC meta lookup - " . $e->getMessage());
                }

                $pdo->commit();

                // 4. Создаем страницу товара
                $final_post_id = $temp_post_id;

                $check_stmt = $pdo->prepare("SELECT ID FROM st_posts WHERE post_title = ? AND post_type = 'product' ORDER BY ID DESC LIMIT 1");
                $check_stmt->execute([$product_name]);
                $verified_product = $check_stmt->fetch(PDO::FETCH_OBJ);

                if ($verified_product && $verified_product->ID != $temp_post_id) {
                    $final_post_id = $verified_product->ID;
                    error_log("DEBUG: ID corrected from $temp_post_id to $final_post_id");
                }





                $product_data = [
                    'name' => $product_name,
                    'description' => $product_description,
                    'price' => $price,
                    'sale_price' => $sale_price,
                    'sku' => $sku,
                    'stock_quantity' => $stock_quantity,
                    'weight' => $weight,
                    'calories' => $calories,
                    'image' => file_exists("../../../img/{$final_post_id}.jpg")
                        ? "/img/{$final_post_id}.jpg"
                        : '/img/placeholder-product.jpg',
                    'badge' => $sale_price > 0 ? '<span class="product-badge">Распродажа!</span>' : '',
                    'price_html' => $sale_price > 0 ?
                        '<span class="old-price">' . number_format($price, 2, ',', ' ') . ' ₽</span><span class="current-price">' . number_format($sale_price, 2, ',', ' ') . ' ₽</span>' :
                        '<span class="current-price">' . number_format($price, 2, ',', ' ') . ' ₽</span>',
                    'stock_class' => $stock_quantity > 0 ? 'in-stock' : 'out-of-stock',
                    'stock_text' => $stock_quantity > 0 ? $stock_quantity . ' в наличии' : 'Нет в наличии',
                    'action_button' => $stock_quantity > 0 ?
                        '<a href="/shop/?add-to-cart=' . $final_post_id . '" class="add-to-cart-btn">В корзину</a>' :
                        '<span class="out-of-stock-btn">Нет в наличии</span>',
                    'calories_html' => $calories > 0 ? '<div class="product-calories"><strong>Калории:</strong> <span>' . $calories . ' ккал</span></div>' : '',
                    'attributes' => ''
                ];

                // Добавляем атрибуты
                $attributes = [];
                if ($weight > 0) {
                    $attributes[] = '<tr><th scope="row">Вес</th><td>' . number_format($weight, 3, ',', ' ') . ' кг</td></tr>';
                }
                if ($calories > 0) {
                    $attributes[] = '<tr><th scope="row">Калории</th><td>' . $calories . ' ккал</td></tr>';
                }
                $product_data['attributes'] = implode('', $attributes);

                // Создаем страницу товара
                if (create_product_page($post_id, $product_data, $pdo)) {
                    $message = "Товар успешно добавлен! ID: " . $final_post_id . " (Страница создана)";
                } else {
                    $message = "Товар успешно добавлен! ID: " . $final_post_id . " (Ошибка создания страницы)";
                }
                $message_class = "success";

            } else {
                // Обновление существующего товара

                // 1. Обновляем st_posts
                $stmt = $pdo->prepare("UPDATE st_posts SET
                    post_content = ?, post_title = ?, post_modified = NOW()
                    WHERE ID = ?");
                $stmt->execute(array($product_description, $product_name, $post_id));

                // 2. Обновляем мета-данные в st_postmeta
                $meta_data = array(
                    '_price' => $sale_price > 0 ? $sale_price : $price,
                    '_regular_price' => $price,
                    '_sale_price' => $sale_price > 0 ? $sale_price : '',
                    '_sku' => $sku,
                    '_stock' => $stock_quantity,
                    '_weight' => $weight,
                    '_calories' => $calories,
                    '_stock_status' => $stock_quantity > 0 ? 'instock' : 'outofstock'
                );

                foreach ($meta_data as $meta_key => $meta_value) {
                    // Проверяем существует ли запись
                    $check_stmt = $pdo->prepare("SELECT meta_id FROM st_postmeta WHERE post_id = ? AND meta_key = ?");
                    $check_stmt->execute(array($post_id, $meta_key));

                    if ($check_stmt->fetch()) {
                        $stmt = $pdo->prepare("UPDATE st_postmeta SET meta_value = ? WHERE post_id = ? AND meta_key = ?");
                        $stmt->execute(array($meta_value, $post_id, $meta_key));
                    } else {
                        $stmt = $pdo->prepare("INSERT INTO st_postmeta (post_id, meta_key, meta_value) VALUES (?, ?, ?)");
                        $stmt->execute(array($post_id, $meta_key, $meta_value));
                    }
                }

                // 3. Обновляем st_wc_product_meta_lookup (если таблица существует)
                try {
                    $stmt = $pdo->prepare("UPDATE st_wc_product_meta_lookup SET
                        sku = ?, min_price = ?, max_price = ?, onsale = ?, stock_quantity = ?, stock_status = ?, calories = ?
                        WHERE product_id = ?");

                    $min_max_price = $sale_price > 0 ? $sale_price : $price;
                    $onsale = $sale_price > 0 ? 1 : 0;
                    $stock_status = $stock_quantity > 0 ? 'instock' : 'outofstock';
                    $stmt->execute(array($sku, $min_max_price, $min_max_price, $onsale, $stock_quantity, $stock_status, $calories, $post_id));
                } catch (Exception $e) {
                    // Игнорируем ошибку если таблицы нет
                    error_log("WC meta lookup table not found: " . $e->getMessage());
                }

                // 4. Обновляем страницу товара
                $product_data = [
                    'name' => $product_name,
                    'description' => $product_description,
                    'price' => $price,
                    'sale_price' => $sale_price,
                    'sku' => $sku,
                    'stock_quantity' => $stock_quantity,
                    'weight' => $weight,
                    'calories' => $calories,
                    'image' => '/img/placeholder-product.jpg',
                    'badge' => $sale_price > 0 ? '<span class="product-badge">Распродажа!</span>' : '',
                    'price_html' => $sale_price > 0 ?
                        '<span class="old-price">' . number_format($price, 2, ',', ' ') . ' ₽</span><span class="current-price">' . number_format($sale_price, 2, ',', ' ') . ' ₽</span>' :
                        '<span class="current-price">' . number_format($price, 2, ',', ' ') . ' ₽</span>',
                    'stock_class' => $stock_quantity > 0 ? 'in-stock' : 'out-of-stock',
                    'stock_text' => $stock_quantity > 0 ? $stock_quantity . ' в наличии' : 'Нет в наличии',
                    'action_button' => $stock_quantity > 0 ?
                        '<a href="/shop/?add-to-cart=' . $post_id . '" class="add-to-cart-btn">В корзину</a>' :
                        '<span class="out-of-stock-btn">Нет в наличии</span>',
                    'calories_html' => $calories > 0 ? '<div class="product-calories"><strong>Калории:</strong> <span>' . $calories . ' ккал</span></div>' : '',
                    'attributes' => ''
                ];

                // Добавляем атрибуты
                $attributes = [];
                if ($weight > 0) {
                    $attributes[] = '<tr><th scope="row">Вес</th><td>' . number_format($weight, 3, ',', ' ') . ' кг</td></tr>';
                }
                if ($calories > 0) {
                    $attributes[] = '<tr><th scope="row">Калории</th><td>' . $calories . ' ккал</td></tr>';
                }
                $product_data['attributes'] = implode('', $attributes);

                // Обновляем страницу товара
                if (create_product_page($post_id, $product_data, $pdo)) {
                    $message = "Товар успешно обновлен! ID: " . $post_id . " (Страница обновлена)";
                } else {
                    $message = "Товар успешно обновлен! ID: " . $post_id . " (Ошибка обновления страницы)";
                }
                $message_class = "success";
            }



        } catch (Exception $e) {
            $pdo->rollBack();
            $message = "Ошибка: " . $e->getMessage();
            $message_class = "error";
        }
    } else {
        $message = "Заполните обязательные поля (название и цена)!";
        $message_class = "error";
    }
}

// Получение данных для редактирования
$edit_product = null;
if (isset($_GET['edit'])) {
    $product_id = intval($_GET['edit']);

    // Получаем основные данные товара
    $stmt = $pdo->prepare("SELECT * FROM st_posts WHERE ID = ? AND post_type = 'product'");
    $stmt->execute(array($product_id));
    $edit_product = $stmt->fetch(PDO::FETCH_OBJ);

    if ($edit_product) {
        // Получаем мета-данные товара
        $meta_stmt = $pdo->prepare("SELECT meta_key, meta_value FROM st_postmeta WHERE post_id = ?");
        $meta_stmt->execute(array($product_id));
        $meta_data = $meta_stmt->fetchAll(PDO::FETCH_OBJ);

        foreach ($meta_data as $meta) {
            $edit_product->{$meta->meta_key} = $meta->meta_value;
        }
    }
}

// Получаем все товары с их мета-данными
$query = $pdo->query("
    SELECT p.ID, p.post_title, p.post_content,
           pm_price.meta_value as price,
           pm_sale.meta_value as sale_price,
           pm_sku.meta_value as sku,
           pm_stock.meta_value as stock_quantity,
           pm_weight.meta_value as weight,
           pm_calories.meta_value as calories
    FROM st_posts p
    LEFT JOIN st_postmeta pm_price ON (p.ID = pm_price.post_id AND pm_price.meta_key = '_price')
    LEFT JOIN st_postmeta pm_sale ON (p.ID = pm_sale.post_id AND pm_sale.meta_key = '_sale_price')
    LEFT JOIN st_postmeta pm_sku ON (p.ID = pm_sku.post_id AND pm_sku.meta_key = '_sku')
    LEFT JOIN st_postmeta pm_stock ON (p.ID = pm_stock.post_id AND pm_stock.meta_key = '_stock')
    LEFT JOIN st_postmeta pm_weight ON (p.ID = pm_weight.post_id AND pm_weight.meta_key = '_weight')
    LEFT JOIN st_postmeta pm_calories ON (p.ID = pm_calories.post_id AND pm_calories.meta_key = '_calories')
    WHERE p.post_type = 'product' AND p.post_status = 'publish'
    ORDER BY p.ID DESC
");
$products = $query->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление товарами — Столовая</title>
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/styleM.css">
    <link rel="stylesheet" href="/styleMM.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .table-container {
            margin: 20px 0;
            overflow-x: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table th,
        .data-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e1e1e1;
        }
        .data-table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #333;
            border-top: 1px solid #e1e1e1;
        }
        .data-table tr:last-child td {
            border-bottom: none;
        }
        .data-table tr:hover {
            background-color: #f8f9fa;
        }
        .product-form {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #333;
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .form-group textarea {
            height: 100px;
            resize: vertical;
        }
        .btn-primary {
            background: #0AAA09;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-primary:hover {
            background: #089908;
        }
        .btn-edit {
            background: #007bff;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 12px;
        }
        .btn-edit:hover {
            background: #0056b3;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 12px;
        }
        .btn-delete:hover {
            background: #c82333;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .btn-secondary {
            background: #6c757d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin: 5px;
        }
        .btn-secondary:hover {
            background: #545b62;
        }
        .page-link {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }
        .page-link:hover {
            text-decoration: underline;
        }
    </style>
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
                    <a href="/">Главная</a> > Управление товарами
                </div>
                <h1 class="page-title">Управление товарами</h1>
            </div>
        </div>

        <!-- Основной контент -->
        <main class="main-content">
            <div class="content-section">

                <!-- Форма добавления/редактирования -->
                <div class="product-form">
                    <h2><?php echo $edit_product ? 'Редактировать товар' : 'Добавить новый товар'; ?></h2>

                    <?php if (isset($message)): ?>
                        <div class="message <?php echo $message_class; ?>"><?php echo $message; ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <input type="hidden" name="post_id" value="<?php echo $edit_product ? $edit_product->ID : ''; ?>">

                        <div class="form-group">
                            <label for="product_name">Название товара *</label>
                            <input type="text" id="product_name" name="product_name"
                                   value="<?php echo $edit_product ? htmlspecialchars($edit_product->post_title) : ''; ?>"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="product_description">Описание товара</label>
                            <textarea id="product_description" name="product_description"><?php echo $edit_product ? htmlspecialchars($edit_product->post_content) : ''; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="price">Цена (руб) *</label>
                            <input type="number" id="price" name="price" step="0.01" min="0"
                                   value="<?php echo $edit_product ? ($edit_product->_regular_price ? $edit_product->_regular_price : '') : ''; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="sale_price">Цена со скидкой (руб)</label>
                            <input type="number" id="sale_price" name="sale_price" step="0.01" min="0"
                                   value="<?php echo $edit_product ? ($edit_product->_sale_price ? $edit_product->_sale_price : '') : ''; ?>">
                        </div>

                        <div class="form-group">
                            <label for="sku">Артикул (SKU)</label>
                            <input type="text" id="sku" name="sku"
                                   value="<?php echo $edit_product ? htmlspecialchars($edit_product->_sku) : ''; ?>">
                        </div>

                        <div class="form-group">
                            <label for="stock_quantity">Количество на складе</label>
                            <input type="number" id="stock_quantity" name="stock_quantity" min="0"
                                   value="<?php echo $edit_product ? ($edit_product->_stock ? $edit_product->_stock : '0') : '0'; ?>">
                        </div>

                        <div class="form-group">
                            <label for="weight">Вес (кг)</label>
                            <input type="number" id="weight" name="weight" step="0.01" min="0"
                                   value="<?php echo $edit_product ? ($edit_product->_weight ? $edit_product->_weight : '') : ''; ?>">
                        </div>

                        <div class="form-group">
                            <label for="calories">Калории (ккал)</label>
                            <input type="number" id="calories" name="calories" min="0"
                                   value="<?php echo $edit_product ? ($edit_product->_calories ? $edit_product->_calories : '') : ''; ?>">
                        </div>

                        <button type="submit" class="btn-primary">
                            <?php echo $edit_product ? 'Обновить товар' : 'Добавить товар'; ?>
                        </button>

                        <?php if ($edit_product): ?>
                            <a href="index.php" class="btn-secondary">Отмена</a>
                        <?php endif; ?>
                    </form>
                </div>

                <!-- Список товаров -->
                <h2 class="section-title">Список товаров</h2>

                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Артикул</th>
                                <th>Цена</th>
                                <th>Скидка</th>
                                <th>Остаток</th>
                                <th>Вес</th>
                                <th>Калории</th>
                                <th>Страница</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($products) > 0): ?>
                                <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><strong><?php echo $product->ID; ?></strong></td>
                                    <td><?php echo htmlspecialchars($product->post_title); ?></td>
                                    <td><?php echo htmlspecialchars($product->sku); ?></td>
                                    <td><?php echo number_format($product->price, 2, '.', ' '); ?> руб</td>
                                    <td><?php echo $product->sale_price ? number_format($product->sale_price, 2, '.', ' ') . ' руб' : '-'; ?></td>
                                    <td><?php echo $product->stock_quantity ? $product->stock_quantity . ' шт' : '0 шт'; ?></td>
                                    <td><?php echo $product->weight ? $product->weight . ' кг' : '-'; ?></td>
                                    <td><?php echo $product->calories ? $product->calories . ' ккал' : '-'; ?></td>
                                    <td>
                                        <?php if (file_exists("../../../product/{$product->ID}/index.php")): ?>
                                            <a href="/product/<?php echo $product->ID; ?>/" class="page-link" target="_blank">Открыть</a>
                                        <?php else: ?>
                                            <span style="color: #999;">Не создана</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="action-buttons">
                                        <a href="?edit=<?php echo $product->ID; ?>" class="btn-edit">✏️</a>
                                        <a href="?delete=<?php echo $product->ID; ?>" class="btn-delete"
                                           onclick="return confirm('Вы уверены, что хотите удалить товар \"<?php echo htmlspecialchars($product->post_title); ?>\"?')">🗑️</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="10" style="text-align: center;">Товары не найдены</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="/my-account/" class="btn-secondary">← Назад в панель управления</a>
                </div>

                <h5>Привет <?php echo $_COOKIE['user']; ?>. Чтобы выйти нажмите <a href="/exit.php">здесь</a>.</h5>

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

    <script>
    // Подтверждение удаления с названием товара
    function confirmDelete(productName, productId) {
        return confirm('Вы уверены, что хотите удалить товар \"' + productName + '\"?');
    }
    </script>
</body>
</html>
