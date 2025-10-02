<?php
session_start();
require_once 'configDB.php';

// Обработка добавления товара в корзину
if (isset($_GET['add-to-cart'])) {
    $product_id = (int)$_GET['add-to-cart'];

    try {
        // Получаем информацию о товаре с калориями из ОБОИХ источников
        $stmt = $pdo->prepare(
            "SELECT p.ID, p.post_title,
                    wc.min_price as price,
                    COALESCE(wc.calories, pm_calories.meta_value) as calories,  -- Берем калории из обоих источников
                    pm_sale.meta_value as sale_price,
                    pm_sku.meta_value as sku,
                    pm_stock.meta_value as stock_quantity
             FROM st_posts p
             LEFT JOIN st_wc_product_meta_lookup wc ON p.ID = wc.product_id
             LEFT JOIN st_postmeta pm_sale ON (p.ID = pm_sale.post_id AND pm_sale.meta_key = '_sale_price')
             LEFT JOIN st_postmeta pm_sku ON (p.ID = pm_sku.post_id AND pm_sku.meta_key = '_sku')
             LEFT JOIN st_postmeta pm_stock ON (p.ID = pm_stock.post_id AND pm_stock.meta_key = '_stock')
             LEFT JOIN st_postmeta pm_calories ON (p.ID = pm_calories.post_id AND pm_calories.meta_key = '_calories')  -- ДОБАВЛЕНО
             WHERE p.ID = ? AND p.post_type = 'product' AND p.post_status = 'publish'"
        );

        $stmt->execute([$product_id]);
        $product = $stmt->fetch();

        if ($product) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Определяем актуальную цену
            $actual_price = $product['sale_price'] ? $product['sale_price'] : $product['price'];

            // Преобразуем калории в число (на случай если NULL)
            $calories = (float)$product['calories'] ?: 0;

            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]['quantity'] += 1;
            } else {
                $_SESSION['cart'][$product_id] = [
                    'name' => $product['post_title'],
                    'price' => (float)$actual_price,
                    'regular_price' => (float)$product['price'],
                    'sale_price' => (float)$product['sale_price'],
                    'calories' => $calories, // Используем исправленные калории
                    'sku' => $product['sku'],
                    'quantity' => 1
                ];
            }

            $_SESSION['cart_message'] = 'Товар "' . $product['post_title'] . '" добавлен в корзину!';
            header('Location: /cart/');
            exit();
        } else {
            $_SESSION['cart_error'] = 'Товар не найден!';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

    } catch (PDOException $e) {
        $_SESSION['cart_error'] = 'Ошибка при добавлении товара: ' . $e->getMessage();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

// Получаем все товары с калориями
try {
    $products_query = $pdo->query("
        SELECT p.ID, p.post_title, p.post_content,
               wc.min_price as price,
               wc.calories as calories,
               pm_sale.meta_value as sale_price,
               pm_sku.meta_value as sku,
               pm_stock.meta_value as stock_quantity,
               pm_image.meta_value as image_id
        FROM st_posts p
        LEFT JOIN st_wc_product_meta_lookup wc ON p.ID = wc.product_id
        LEFT JOIN st_postmeta pm_sale ON (p.ID = pm_sale.post_id AND pm_sale.meta_key = '_sale_price')
        LEFT JOIN st_postmeta pm_sku ON (p.ID = pm_sku.post_id AND pm_sku.meta_key = '_sku')
        LEFT JOIN st_postmeta pm_stock ON (p.ID = pm_stock.post_id AND pm_stock.meta_key = '_stock')
        LEFT JOIN st_postmeta pm_image ON (p.ID = pm_image.post_id AND pm_image.meta_key = '_thumbnail_id')
        WHERE p.post_type = 'product' AND p.post_status = 'publish'
        ORDER BY p.post_date DESC
    ");
    $products = $products_query->fetchAll(PDO::FETCH_ASSOC);
    $total_products = count($products);

} catch (PDOException $e) {
    $products = [];
    $total_products = 0;
    error_log("Ошибка при получении товаров: " . $e->getMessage());
}

// Функция для получения изображения (остается без изменений)
function get_product_image($product_id) {
    // Проверяем есть ли картинка с именем как ID продукта
    if (file_exists("../img/{$product_id}.jpg")) {
        return "/img/{$product_id}.jpg";
    }

    // Если нет - используем заглушку
    return '/img/placeholder-product.jpg';
}
?>


<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин — Столовая</title>
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/styleM.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            margin: 40px 0;
        }

        .product-item {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .product-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
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
            z-index: 2;
        }

        .product-badge.out-of-stock {
            background: #666;
        }

        .product-image-container {
            width: 100%;
            height: 250px;
            overflow: hidden;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .product-content {
            padding: 20px;
        }

        .product-title {
            font-size: 18px;
            font-weight: 600;
            margin: 0 0 10px 0;
            color: #333;
            line-height: 1.3;
            min-height: 46px;
        }

        .product-title a {
            color: inherit;
            text-decoration: none;
        }

        .product-title a:hover {
            color: #0AAA09;
        }

        .product-price {
            margin: 15px 0;
        }

        .current-price {
            font-size: 20px;
            font-weight: 700;
            color: #0AAA09;
        }

        .old-price {
            font-size: 16px;
            color: #999;
            text-decoration: line-through;
            margin-right: 10px;
        }

        .add-to-cart-btn {
            display: block;
            width: 100%;
            background: #0AAA09;
            color: white;
            text-align: center;
            padding: 12px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s ease;
            cursor: pointer;
        }

        .add-to-cart-btn:hover {
            background: #089908;
        }

        .add-to-cart-btn.loading {
            background: #ccc;
            cursor: not-allowed;
        }

        .out-of-stock-btn {
            display: block;
            width: 100%;
            background: #ccc;
            color: #666;
            text-align: center;
            padding: 12px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            cursor: not-allowed;
        }

        .woocommerce-result-count {
            color: #666;
            margin-bottom: 20px;
        }

        .woocommerce-ordering {
            margin-bottom: 30px;
        }

        .orderby {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: white;
        }

        .no-products {
            text-align: center;
            padding: 60px 20px;
            color: #666;
            grid-column: 1 / -1;
        }

        .no-products h3 {
            margin-bottom: 10px;
            color: #333;
        }

        .placeholder-image {
            width: 100px;
            height: 100px;
            opacity: 0.3;
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
                    <a href="/">Главная</a> > Товары
                </div>
                <h1 class="page-title">Товары</h1>
            </div>
        </div>

        <!-- Основной контент -->
        <main class="main-content">
            <div class="site-wrapper">
                <div class="content-section">
                    <h2 class="section-title">Магазин</h2>

                    <p class="woocommerce-result-count">
                        <?php if ($total_products > 0): ?>
                            Показано <?= $total_products ?> товар(ов)
                        <?php else: ?>
                            Товары не найдены
                        <?php endif; ?>
                    </p>

                    <form class="woocommerce-ordering" method="get">
                        <select name="orderby" class="orderby">
                            <option value="menu_order" selected>Исходная сортировка</option>
                            <option value="date">По новизне</option>
                            <option value="price">По возрастанию цены</option>
                            <option value="price-desc">По убыванию цены</option>
                            <option value="title">По названию (А-Я)</option>
                            <option value="title-desc">По названию (Я-А)</option>
                        </select>
                        <input type="hidden" name="paged" value="1">
                    </form>

                    <div class="products-grid">
                        <?php if ($total_products > 0): ?>
                            <?php foreach ($products as $product): ?>
                                <?php
                                $product_id = $product['ID'];
                                $product_title = htmlspecialchars($product['post_title']);
                                $product_price = (float)$product['price'];
                                $sale_price = (int)$product['sale_price'];
                                $stock_quantity = (int)$product['stock_quantity'];
                                $actual_price = $sale_price > 0 ? $sale_price : $product_price;
                                $has_discount = $sale_price > 0 && $sale_price < $product_price;
                                $in_stock = $stock_quantity > 0;
                                $product_image = get_product_image($product_id);
                                ?>

                                <div class="product-item">
                                    <?php if ($has_discount): ?>
                                        <div class="product-badge">Распродажа!</div>
                                    <?php elseif (!$in_stock): ?>
                                        <div class="product-badge out-of-stock">Нет в наличии</div>
                                    <?php endif; ?>

                                    <div class="product-image-container">
                                        <a href="/product/<?= $product_id ?>/">
                                            <img src="<?= $product_image ?>"
                                                 alt="<?= $product_title ?>"
                                                 class="product-image"
                                                 onerror="this.src='/img/placeholder-product.jpg'; this.onerror=null;">
                                        </a>
                                    </div>

                                    <div class="product-content">
                                        <h3 class="product-title">
                                            <a href="/product/<?= $product_id ?>/"><?= $product_title ?></a>
                                        </h3>

                                        <div class="product-price">
                                            <?php if ($has_discount): ?>
                                                <span class="old-price"><?= number_format($product_price, 2, ',', ' ') ?> ₽</span>
                                            <?php endif; ?>
                                            <span class="current-price"><?= number_format($actual_price, 2, ',', ' ') ?> ₽</span>
                                        </div>

                                        <?php if ($in_stock): ?>
                                            <a href="/shop/?add-to-cart=<?= $product_id ?>"
                                               aria-label="Добавить в корзину &ldquo;<?= $product_title ?>&rdquo;"
                                               data-quantity="1"
                                               data-product_id="<?= $product_id ?>"
                                               data-product_sku="<?= htmlspecialchars($product['sku']) ?>"
                                               data-price="<?= $actual_price ?>"
                                               rel="nofollow"
                                               class="add-to-cart-btn">
                                                В корзину
                                            </a>
                                        <?php else: ?>
                                            <span class="out-of-stock-btn">Нет в наличии</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="no-products">
                                <h3>Товары не найдены</h3>
                                <p>В нашем магазине пока нет товаров. Загляните позже!</p>
                            </div>
                        <?php endif; ?>
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
    // Упрощенная обработка добавления в корзину
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('add-to-cart-btn')) {
            e.preventDefault();

            // Просто переходим по ссылке без задержки
            window.location.href = e.target.href;
        }
    });

    // Обработка изменения сортировки
    document.querySelector('.orderby')?.addEventListener('change', function() {
        this.form.submit();
    });

    // Обработка ошибок загрузки изображений
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('.product-image');
        images.forEach(img => {
            img.onerror = function() {
                this.src = '/img/placeholder-product.jpg';
                this.onerror = null; // Предотвращаем бесконечный цикл
            };
        });
    });
    </script>
</body>
</html>
