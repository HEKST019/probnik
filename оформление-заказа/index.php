<?php
session_start();
require_once '../shop/configDB.php'; // Подключаем БД если нужно что-то дополнительно проверять
?>

<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформление заказа — Столовая</title>
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/styleM.css">
    <link rel="stylesheet" href="/styleMM.css">
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
                    <a href="/">Главная</a> > Оформление заказа
                </div>
                <h1 class="page-title">Оформление заказа</h1>
            </div>
        </div>

        <!-- Основной контент -->
        <main class="main-content">
            <div class="site-wrapper">
                <div class="content-section">





                  <h2 class="section-title">Оформление заказа</h2>

                  <?php if (isset($_SESSION['cart_message'])): ?>
                      <div class="alert alert-success">
                          <?php
                          echo $_SESSION['cart_message'];
                          unset($_SESSION['cart_message']);
                          ?>
                      </div>
                  <?php endif; ?>

                  <?php if (isset($_SESSION['cart_error'])): ?>
                      <div class="alert alert-error">
                          <?php
                          echo $_SESSION['cart_error'];
                          unset($_SESSION['cart_error']);
                          ?>
                      </div>
                  <?php endif; ?>

                  <?php if (!empty($_SESSION['cart'])): ?>
                      <div class="cart-table">
                          <table>
                              <thead>
                                  <tr>
                                      <th>Товар</th>
                                      <th>Цена</th>
                                      <th>Количество</th>
                                      <th>Итого</th>
                                      <th>Действие</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  $total = 0;
                                  foreach ($_SESSION['cart'] as $id => $item):
                                      $item_total = $item['price'] * $item['quantity'];
                                      $total += $item_total;
                                  ?>
                                      <tr>
                                          <td class="product-name"><?php echo htmlspecialchars($item['name']); ?></td>
                                          <td class="product-price"><?php echo number_format($item['price'], 2, ',', ' '); ?> ₽</td>
                                          <td class="product-quantity"><?php echo $item['quantity']; ?></td>
                                          <td class="product-total"><?php echo number_format($item_total, 2, ',', ' '); ?> ₽</td>
                                          <td class="product-actions">
                                              <a href="/cart/remove_from_cart.php?id=<?php echo $id; ?>" class="remove-btn">Удалить</a>
                                          </td>
                                      </tr>
                                  <?php endforeach; ?>
                              </tbody>
                              <tfoot>
                                  <tr>
                                      <th colspan="3">Общая сумма:</th>
                                      <th colspan="2" class="cart-total"><?php echo number_format($total, 2, ',', ' '); ?> ₽</th>
                                  </tr>
                              </tfoot>
                          </table>

                          <div class="cart-actions">

                              <a href="/shop/" class="continue-shopping">Продолжить покупки</a>
                          </div>
                      </div>



                      <form  id="orderForm" method="post" class="order-form">
              		    <!-- Скрытые поля для таблицы -->
              		    <input type="hidden" name="parent_id" value="0">
              		    <input type="hidden" name="num_items_sold" value="1">
              		    <input type="hidden" name="total_sales" value="0">
              		    <input type="hidden" name="tax_total" value="0">
              		    <input type="hidden" name="shipping_total" value="0">
              		    <input type="hidden" name="net_total" value="0">
              		    <input type="hidden" name="returning_customer" value="0">
              		    <input type="hidden" name="status" value="wc-checkout-draft">
              		    <input type="hidden" name="customer_id" value="12">
                      <div class="form-grid">
                        <p class="form-group">
                		        <label class="form-label" for="first_name">Имя <span class="required">*</span></label>
                		        <input class="form-input input-text" type="text" name="first_name" id="first_name" required>
                		    </p>

                		    <p class="form-group">
                		        <label class="form-label" for="last_name">Фамилия <span class="required">*</span></label>
                		        <input class="form-input input-text" type="text" name="last_name" id="last_name" required>
                		    </p>

                		    <p class="form-group">
                		        <label class="form-label" for="email">Email <span class="required">*</span></label>
                		        <input class="form-input input-text" type="email" name="email" id="email" required>
                		    </p>

                		    <p class="form-group">
                		        <label class="form-label" for="phone">Телефон <span class="required">*</span></label>
                		        <input class="form-input input-text" type="tel" name="phone" id="phone" required>
                		    </p>

                		    <p class="form-group">
                		        <label class="form-label" for="country">Страна <span class="required">*</span></label>
                		        <input class="form-input input-text" type="text" name="country" id="country" value="RU" required>
                		    </p>

                		    <p class="form-group">
                		        <label class="form-label" for="city">Город <span class="required">*</span></label>
                		        <input class="form-input input-text" type="text" name="city" id="city" required>
                		    </p>

                		    <p class="form-group">
                		        <label class="form-label" for="address_1">Адрес 1 <span class="required">*</span></label>
                		        <input class="form-input input-text" type="text" name="address_1" id="address_1" required>
                		    </p>

                		    <p class="form-group">
                		        <label class="form-label" for="address_2">Адрес 2</label>
                		        <input class="form-input input-text" type="text" name="address_2" id="address_2">
                		    </p>

                		    <p class="form-group">
                		        <label class="form-label" for="postcode">Почтовый индекс <span class="required">*</span></label>
                		        <input class="form-input input-text" type="text" name="postcode" id="postcode" required>
                		    </p>
                      </div>
              		    <!-- Поля адреса -->


              		    <!-- Скрытые поля -->
              		    <input type="hidden" name="address_type" value="billing">
              		    <input type="hidden" name="company" value="">
              		    <input type="hidden" name="state" value="">

              		    <!-- Блок для сообщений -->
              		    <div id="message" style="display: none; padding: 10px; margin: 10px 0; border-radius: 4px;"></div>

              		    <p class="form-row">
              		        <button type="submit" class="btn-primary" name="submit_order">Оформить заказ</button>
              		    </p>

              		</form>

              		<script>
              		document.getElementById('orderForm').addEventListener('submit', function(e) {
              		    e.preventDefault(); // Отменяем стандартную отправку формы

              		    var formData = new FormData(this);
              		    var messageDiv = document.getElementById('message');
              		    var submitButton = this.querySelector('button[type="submit"]');

              		    // Показываем загрузку
              		    submitButton.disabled = true;
              		    submitButton.textContent = 'Обработка...';
              		    messageDiv.style.display = 'none';

              		    
              		    fetch('process_order.php', {
              		        method: 'POST',
              		        body: formData
              		    })
              		    .then(response => response.text())
              		    .then(data => {
              		        // Показываем сообщение об успехе
              		        messageDiv.style.display = 'block';
              		        messageDiv.style.backgroundColor = '#d4edda';
              		        messageDiv.style.color = '#155724';
              		        messageDiv.style.border = '1px solid #c3e6cb';
              		        messageDiv.innerHTML = '✅ ' + data;

              		        // Очищаем форму после успешной отправки
              		        this.reset();
              		    })
              		    .catch(error => {
              		        // Показываем сообщение об ошибке
              		        messageDiv.style.display = 'block';
              		        messageDiv.style.backgroundColor = '#f8d7da';
              		        messageDiv.style.color = '#721c24';
              		        messageDiv.style.border = '1px solid #f5c6cb';
              		        messageDiv.innerHTML = '❌ Ошибка при отправке заказа: ' + error;
              		    })
              		    .finally(() => {
              		        // Восстанавливаем кнопку
              		        submitButton.disabled = false;
              		        submitButton.textContent = 'Оформить заказ';
              		    });
              		});
              		</script>

                  <?php else: ?>
                      <div class="empty-cart">
                          <h3>Сейчас ваша корзина пуста!</h3>
                          <p>Посмотрите наши новинки:</p>

                          <div class="new-products">
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
                  <?php endif; ?>






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
