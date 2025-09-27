<?php
// Проверка авторизации для PHP 5.6
if (!isset($_COOKIE['user']) || $_COOKIE['user'] != 'admin1') {
    die("Доступ запрещен. Требуется авторизация администратора.");
}

require '../../configDB.php';

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

                // 3. Добавляем запись в st_wc_product_meta_lookup (если таблица существует)
                try {
                    $stmt = $pdo->prepare("INSERT INTO st_wc_product_meta_lookup
                        (product_id, sku, virtual, downloadable, min_price, max_price,
                         onsale, stock_quantity, stock_status, rating_count, average_rating,
                         total_sales, tax_status, tax_class)
                        VALUES
                        (?, ?, 0, 0, ?, ?, ?, ?, 'instock', 0, 0, 0, 'taxable', '')");

                    $min_max_price = $sale_price > 0 ? $sale_price : $price;
                    $onsale = $sale_price > 0 ? 1 : 0;
                    $stock_status = $stock_quantity > 0 ? 'instock' : 'outofstock';
                    $stmt->execute(array($post_id, $sku, $min_max_price, $min_max_price, $onsale, $stock_quantity, $stock_status));
                } catch (Exception $e) {
                    // Игнорируем ошибку если таблицы нет
                    error_log("WC meta lookup table not found: " . $e->getMessage());
                }

                $message = "Товар успешно добавлен! ID: " . $post_id;
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
                        sku = ?, min_price = ?, max_price = ?, onsale = ?, stock_quantity = ?, stock_status = ?
                        WHERE product_id = ?");

                    $min_max_price = $sale_price > 0 ? $sale_price : $price;
                    $onsale = $sale_price > 0 ? 1 : 0;
                    $stock_status = $stock_quantity > 0 ? 'instock' : 'outofstock';
                    $stmt->execute(array($sku, $min_max_price, $min_max_price, $onsale, $stock_quantity, $stock_status, $post_id));
                } catch (Exception $e) {
                    // Игнорируем ошибку если таблицы нет
                    error_log("WC meta lookup table not found: " . $e->getMessage());
                }

                $message = "Товар успешно обновлен! ID: " . $post_id;
                $message_class = "success";
            }

            $pdo->commit();

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
           pm_weight.meta_value as weight
    FROM st_posts p
    LEFT JOIN st_postmeta pm_price ON (p.ID = pm_price.post_id AND pm_price.meta_key = '_price')
    LEFT JOIN st_postmeta pm_sale ON (p.ID = pm_sale.post_id AND pm_sale.meta_key = '_sale_price')
    LEFT JOIN st_postmeta pm_sku ON (p.ID = pm_sku.post_id AND pm_sku.meta_key = '_sku')
    LEFT JOIN st_postmeta pm_stock ON (p.ID = pm_stock.post_id AND pm_stock.meta_key = '_stock')
    LEFT JOIN st_postmeta pm_weight ON (p.ID = pm_weight.post_id AND pm_weight.meta_key = '_weight')
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
                                    <td class="action-buttons">
                                        <a href="?edit=<?php echo $product->ID; ?>" class="btn-edit">✏️</a>
                                        <a href="?delete=<?php echo $product->ID; ?>" class="btn-delete"
                                           onclick="return confirm('Вы уверены, что хотите удалить товар \"<?php echo htmlspecialchars($product->post_title); ?>\"?')">🗑️</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" style="text-align: center;">Товары не найдены</td>
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
