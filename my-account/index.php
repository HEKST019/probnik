
<!DOCTYPE html>
<html lang="ru-RU">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Мой аккаунт — Столовая</title>
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
                   <a href="/">Главная</a> > Мой аккаунт
               </div>
               <h1 class="page-title">Мой аккаунт</h1>
           </div>
       </div>

       <!-- Основной контент -->
       <main class="main-content">
           <div class="site-wrapper">
               <div class="content-section">






                   <h2 class="section-title">Мой аккаунт</h2>

                   <?php
                     if ($_COOKIE['user'] == ''):


                   ?>

                   <div class="u-columns col2-set" id="customer_login">

                   	<div class="u-column1 col-1">


                   		<h2>Вход</h2>



                   		<form class="order-form" action="validation-form/auth.php" method="post" novalidate>


                   			<p class="form-group">
                   				<label class="form-label" for="username">Имя пользователя или Email&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
                   				<input type="text" class="form-input input-text" name="username" id="username" autocomplete="username" value="" required aria-required="true">			</p>
                   			<p class="form-group">
                   				<label class="form-label" for="password">Пароль&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
                   				<input class="form-input input-text" type="password" name="password" id="password" autocomplete="current-password" required aria-required="true">
                   			</p>


                   			<p class="form-row">
                   				<button type="submit" class="btn-primary" name="login" value="Войти">Войти</button>
                   			</p>



                   		</form>





                   	</div>


                   	<div class="u-column2 col-2">

                   		<h2>Регистрация</h2>



                   		<form action="validation-form/check.php" method="post" class="order-form">

                   			<p class="form-group">
                   				<label class="form-label" for="username">Имя пользователя или Email&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
                   				<input type="text" class="form-input input-text" name="username" id="username" autocomplete="username" value="" required aria-required="true">			</p>
                   			<p class="form-group">
                   				<label class="form-label" for="password">Пароль&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
                   				<input class="form-input input-text" type="password" name="password" id="password" autocomplete="current-password" required aria-required="true">
                   			</p>


                   			<p class="form-row">
                          <button type="submit" class="btn-primary" >Регистрация</button>
                   			</p>

                   		</form>
                   	</div>
                   </div>



                   <?php elseif($_COOKIE['user'] == 'admin1'): ?>

                     <div class="delivery-info">
 											<?php
 												require 'configDB.php';
 												$query = $pdo->query('SELECT * FROM `st_users`');
 												while ($row = $query->fetch(PDO::FETCH_OBJ))
 												if ($row->user_login == $_COOKIE['user'])

 												{
 													echo '
 													<h4>Логин: '.$row->user_login.' </h4>
 													<h4>Никнейм: '.$row->user_nicename.' </h4>
 													<h4>Электронная почта: '.$row->user_email.' </h4>
 													';
 												}
 											?>
                     </div>



 										<form class="order-form" action="add.php" method="post" novalidate>
 											<h4>Изменить данные профиля пользователя</h4>

 											<p class="form-group">
 												<label class="form-label" for="username">Новый Логин&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
 												<input type="text" class="form-input input-text" name="username" id="username" autocomplete="username" value="" required aria-required="true">
 											</p>
 												<p class="form-group">
 													<label class="form-label" for="usernicename">Никнейм&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
 													<input type="text" class="form-input input-text" name="usernicename" id="usernicename" autocomplete="usernicename" value="" required aria-required="true">
 												</p>
 													<p class="form-group">
 														<label class="form-label" for="useremail">Электронная почта/Email&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
 														<input type="text" class="form-input input-text" name="useremail" id="useremail" autocomplete="useremail" value="" required aria-required="true">
 													</p>




 											<p class="form-group">
 												<label class="form-label" for="password">Пароль&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">&#1054;&#1073;&#1103;&#1079;&#1072;&#1090;&#1077;&#1083;&#1100;&#1085;&#1086;</span></label>
 												<input class="form-input input-text" type="password" name="password" id="password" autocomplete="current-password" required aria-required="true">
 											</p>


 											<p class="form-row">

 												<button type="submit" class="btn-primary" name="login" value="Отправить">Отправить</button>
 											</p>



 										</form>
                    <h5>Привет. Чтобы посмотреть данные пользователей нажмите <a
    									href="admin/данные-пользователей/index.php">здесь</a>. </h5>
  									<h5>Привет. Чтобы посмотреть оформленные заказы пользователей нажмите <a
  										href="admin/Оформленные-заказы/index.php">здесь</a>. </h5>
                    <h5>Привет. Чтобы посмотреть данные по товарам нажмите <a
                      href="admin/добавление-товара/index.php">здесь</a>. </h5>
 										<h5>Привет <?=$_COOKIE['user']?>. Чтобы выйти нажмите <a
 											href="/exit.php">здесь</a>. </h5>





                     <?php elseif($_COOKIE['user'] == 'manager1'): ?>



                       <h2 class="section-title">Оформленные заказы</h2>

   										<?php
   										require 'configDB.php';
   										$query = $pdo->query('SELECT * FROM `st_order_addresses`');
   										?>

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
                       .data-table td {
                           color: #555;
                       }
                       </style>
                       <div style="text-align: center; margin: 30px 0;">
   												<a href="admin/Оформленные-заказы/status.php" class="btn-secondary">Статусы по заказам</a>
   										</div>
                       <div class="table-container">
                           <table class="data-table">
                               <thead>
                                   <tr>
                                       <th>Order ID</th>
                                       <th>Type</th>
                                       <th>First Name</th>
                                       <th>Last Name</th>
                                       <th>Address</th>
                                       <th>City</th>
                                       <th>Postcode</th>
                                       <th>Country</th>
                                       <th>Email</th>
                                       <th>Phone</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   <?php while ($row = $query->fetch(PDO::FETCH_OBJ)): ?>
                                   <tr>
                                       <td><strong><?= htmlspecialchars($row->order_id) ?></strong></td>
                                       <td><?= htmlspecialchars($row->address_type) ?></td>
                                       <td><?= htmlspecialchars($row->first_name) ?></td>
                                       <td><?= htmlspecialchars($row->last_name) ?></td>
                                       <td>
                                           <?= htmlspecialchars($row->address_1) ?>
                                           <?= $row->address_2 ? '<br><small>' . htmlspecialchars($row->address_2) . '</small>' : '' ?>
                                       </td>
                                       <td><?= htmlspecialchars($row->city) ?></td>
                                       <td><?= htmlspecialchars($row->postcode) ?></td>
                                       <td><?= htmlspecialchars($row->country) ?></td>
                                       <td><?= htmlspecialchars($row->email) ?></td>
                                       <td><?= htmlspecialchars($row->phone) ?></td>
                                   </tr>
                                   <?php endwhile; ?>
                               </tbody>
                           </table>
                       </div>

   										<h5>Привет <?=$_COOKIE['user']?>. Чтобы выйти нажмите <a
   											href="/exit.php">здесь</a>. </h5>





                       <?php else: ?>

                         <div class="delivery-info">
     											<?php
     												require 'configDB.php';
     												$query = $pdo->query('SELECT * FROM `st_users`');
     												while ($row = $query->fetch(PDO::FETCH_OBJ))
     												if ($row->user_login == $_COOKIE['user'])

     												{
     													echo '
     													<h4>Логин: '.$row->user_login.' </h4>
     													<h4>Никнейм: '.$row->user_nicename.' </h4>
     													<h4>Электронная почта: '.$row->user_email.' </h4>
     													';
     												}
     											?>
                         </div>



     										<form class="order-form" action="add.php" method="post" novalidate>
     											<h4>Изменить данные профиля пользователя</h4>

     											<p class="form-group">
     												<label class="form-label" for="username">Новый Логин&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
     												<input type="text" class="form-input input-text" name="username" id="username" autocomplete="username" value="" required aria-required="true">
     											</p>
     												<p class="form-group">
     													<label class="form-label" for="usernicename">Никнейм&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
     													<input type="text" class="form-input input-text" name="usernicename" id="usernicename" autocomplete="usernicename" value="" required aria-required="true">
     												</p>
     													<p class="form-group">
     														<label class="form-label" for="useremail">Электронная почта/Email&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
     														<input type="text" class="form-input input-text" name="useremail" id="useremail" autocomplete="useremail" value="" required aria-required="true">
     													</p>




     											<p class="form-group">
     												<label class="form-label" for="password">Пароль&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">&#1054;&#1073;&#1103;&#1079;&#1072;&#1090;&#1077;&#1083;&#1100;&#1085;&#1086;</span></label>
     												<input class="form-input input-text" type="password" name="password" id="password" autocomplete="current-password" required aria-required="true">
     											</p>


     											<p class="form-row">

     												<button type="submit" class="btn-primary" name="login" value="Отправить">Отправить</button>
     											</p>



                          <h2 class="section-title">Мои заказы</h2>

                     <?php
                       require 'configDB.php';
                       // Получаем email текущего пользователя
                       $user_email = '';
                       $user_query = $pdo->query('SELECT * FROM `st_users` WHERE user_login = "'.$_COOKIE['user'].'"');
                       while ($user_row = $user_query->fetch(PDO::FETCH_OBJ)) {
                         $user_email = $user_row->user_email;
                       }

                       // Ищем заказы по email пользователя
                       $orders_query = $pdo->query('SELECT * FROM `st_order_addresses` WHERE email = "'.$user_email.'"');
                       $user_orders = $orders_query->fetchAll(PDO::FETCH_OBJ);

                       if (count($user_orders) > 0):
                     ?>

                       <style>
                         .user-orders-table {
                           width: 100%;
                           border-collapse: collapse;
                           margin: 20px 0;
                         }
                         .user-orders-table th,
                         .user-orders-table td {
                           padding: 12px 15px;
                           text-align: left;
                           border-bottom: 1px solid #e1e1e1;
                         }
                         .user-orders-table th {
                           background-color: #f8f9fa;
                           font-weight: 600;
                           color: #333;
                         }
                         .user-orders-table tr:hover {
                           background-color: #f8f9fa;
                         }
                         .no-orders {
                           text-align: center;
                           padding: 40px;
                           color: #666;
                           font-style: italic;
                         }
                       </style>

                       <div class="table-container">
                         <table class="user-orders-table">
                           <thead>
                             <tr>
                               <th>Номер заказа</th>
                               <th>Тип адреса</th>
                               <th>Имя</th>
                               <th>Фамилия</th>
                               <th>Адрес</th>
                               <th>Город</th>
                               <th>Индекс</th>
                               <th>Телефон</th>
                             </tr>
                           </thead>
                           <tbody>
                             <?php foreach ($user_orders as $order): ?>
                             <tr>
                               <td><strong><?= htmlspecialchars($order->order_id) ?></strong></td>
                               <td><?= htmlspecialchars($order->address_type) ?></td>
                               <td><?= htmlspecialchars($order->first_name) ?></td>
                               <td><?= htmlspecialchars($order->last_name) ?></td>
                               <td>
                                 <?= htmlspecialchars($order->address_1) ?>
                                 <?= $order->address_2 ? '<br><small>' . htmlspecialchars($order->address_2) . '</small>' : '' ?>
                               </td>
                               <td><?= htmlspecialchars($order->city) ?></td>
                               <td><?= htmlspecialchars($order->postcode) ?></td>
                               <td><?= htmlspecialchars($order->phone) ?></td>
                             </tr>
                             <?php endforeach; ?>
                           </tbody>
                         </table>
                       </div>

                     <?php else: ?>

                       <div class="no-orders">
                         <p>У вас пока нет оформленных заказов.</p>
                       </div>

                     <?php endif; ?>

     										</form>
                        <h5>Привет <?=$_COOKIE['user']?>. Чтобы выйти нажмите <a
     											href="/exit.php">здесь</a>. </h5>






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
