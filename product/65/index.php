<?php
session_start();
require_once '../../shop/configDB.php'; // Подключаем БД если нужно что-то дополнительно проверять
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пирожок с мясом — Столовая</title>
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

                <h1 class="page-title">Пирожок с мясом</h1>
            </div>
        </div>

        <!-- Основной контент -->
        <main class="main-content">
            <div class="site-wrapper">
                <div class="content-section">





                  <div class="product-detail">
                      <div class="product-images">
                          <div class="main-product-image">
                              <img src="/img/пирожок-с-мясом-600x600.jpg" alt="Пирожок с мясом" class="product-img">
                              <span class="product-badge">Распродажа!</span>
                          </div>
                      </div>

                      <div class="product-info">
                          <h2 class="product-title">Пирожок с мясом</h2>

                          <div class="product-price">
                              <span class="old-price">500,00 ₽</span>
                              <span class="current-price">150,00 ₽</span>
                          </div>

                          <div class="product-description">
                              <p>Вкусные, как у бабушки</p>
                          </div>

                          <div class="product-stock">
                              <p class="in-stock">15 в наличии</p>
                          </div>
                          <div class="product-actions">
                            <a href="/shop/?add-to-cart=65" aria-label="Добавить в корзину &ldquo;Пирожок с мясом&rdquo;" data-quantity="1" data-product_id="65" data-product_sku="а102" data-price="150" rel="nofollow" class="add-to-cart-btn">В корзину</a>
                          </div>


                          <div class="product-meta">
                              <div class="product-sku">
                                  <strong>Артикул:</strong> <span>а102</span>
                              </div>
                              <div class="product-categories">
                                  <strong>Категории:</strong>
                                  <a href="/product-category/еда/выпечка/">Выпечка</a>,
                                  <a href="/product-category/еда/">Еда</a>
                                  <strong>Метки:</strong>
                                  <a href="/product-tag/мясо/">Мясо</a>,
                                  <a href="/product-tag/пирожок/">Пирожок</a>
                              </div>
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
                              <p>Состав</p>
                              <p>Мука пшеничная в/с, масло сливочное, яйцо, соль, сахар, дрожжи прессованные, молоко 3,2%, масло растительное. Начинка: фарш тушеный говяжий, лук репчатый жареный, масло сливочное, перец молотый черный, соль, меланж.</p>
                          </div>

                          <div id="details" class="tab-pane ">
                              <h3>Детали</h3>
                              <table class="product-attributes">
                                  <tr>
                                      <th scope="row">Вес</th>
                                      <td>0,700 кг</td>
                                  </tr>
                              </table>
                          </div>
                      </div>
                  </div>

                  <!-- Похожие товары -->
                  <section class="related-products">
                      <h2 class="section-title">Похожие товары</h2>

                      <div class="products-grid">
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
                  </section>






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
