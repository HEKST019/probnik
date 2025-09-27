<?php
session_start();
require_once '../../shop/configDB.php'; // Подключаем БД если нужно что-то дополнительно проверять
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Еда — Столовая</title>
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/styleM.css">
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
                    <a href="/">Главная</a> > <a href="/shop/">Товары</a> > Еда
                </div>
                <h1 class="page-title">Еда</h1>
            </div>
        </div>

        <!-- Основной контент -->
        <main class="main-content">
            <div class="site-wrapper">
                <div class="content-section">





                  <h2 class="section-title">Еда</h2>

                  <p class="woocommerce-result-count">Показаны все результаты (2)</p>

                  <form class="woocommerce-ordering" method="get">
                      <select name="orderby" class="orderby">
                          <option value="menu_order" selected>Исходная сортировка</option>
                          <option value="popularity">По популярности</option>
                          <option value="rating">По рейтингу</option>
                          <option value="date">По новизне</option>
                          <option value="price">По возрастанию цены</option>
                          <option value="price-desc">По убыванию цены</option>
                      </select>
                      <input type="hidden" name="paged" value="1">
                  </form>

                  <div class="products-grid">
                      <!-- Товар 1 -->
                      <div class="product-item">
                          <a href="/product/pirogsmyas/">
                              <div class="product-badge">Распродажа!</div>
                              <img src="/img/пирожок-с-мясом-300x457.jpg" alt="Пирожок с мясом" class="product-image">
                              <h3 class="product-title">Пирожок с мясом</h3>
                          </a>
                          <div class="product-price">
                              <span class="old-price">500,00 ₽</span>
                              <span class="current-price">150,00 ₽</span>
                          </div>

                          <div >
                            <a href="/shop/?add-to-cart=65" aria-label="Добавить в корзину &ldquo;Пирожок с мясом&rdquo;" data-quantity="1" data-product_id="65" data-product_sku="а102" data-price="150" rel="nofollow" class="add-to-cart-btn">В корзину</a>
                          </div>
                      </div>

                      <!-- Товар 2 -->
                      <div class="product-item">
                          <a href="/product/pirogskart/">
                              <div class="product-badge">Распродажа!</div>
                              <img src="/img/пирожок-с-картошкой-300x457.jpg" alt="Пирожок с картошкой" class="product-image">
                              <h3 class="product-title">Пирожок с картошкой</h3>
                          </a>
                          <div class="product-price">
                              <span class="old-price">900,00 ₽</span>
                              <span class="current-price">150,00 ₽</span>
                          </div>

                          <div >
                            <a href="/shop/?add-to-cart=61" aria-label="Добавить в корзину &ldquo;Пирожок с картошкой&rdquo;" data-quantity="1" data-product_id="61" data-product_sku="а101" data-price="150" rel="nofollow" class="add-to-cart-btn">В корзину</a>
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
</body>
</html>
