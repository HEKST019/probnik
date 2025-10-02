<?php
	if ($_COOKIE['user'] == 'admin1'):


?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Данные пользователей — Столовая</title>
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
                    <a href="/">Главная</a> > Данные пользователей
                </div>
                <h1 class="page-title">Данные пользователей</h1>
            </div>
        </div>

        <!-- Основной контент -->
        <main class="main-content">
            <div class="site-wrapper">
                <div class="content-section">






                    <h2 class="section-title">Данные пользователей</h2>

                    <div class="delivery-info">
											<?php
												require '../../configDB.php';
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


										<?php
										require '../../configDB.php';
										$query = $pdo->query('SELECT * FROM `st_users`');
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

										<div class="table-container">
											<table class="data-table">
													<thead>
															<tr>
																	<th>ID</th>
																	<th>Login</th>
																	<th>Nicename</th>
																	<th>Email</th>
																	<th>URL</th>
																	<th>Registered</th>
																	<th>Status</th>
																	<th>Display Name</th>
															</tr>
													</thead>
													<tbody>
															<?php while ($row = $query->fetch(PDO::FETCH_OBJ)): ?>
															<tr>
																	<td><strong><?= htmlspecialchars($row->ID) ?></strong></td>
																	<td><?= htmlspecialchars($row->user_login) ?></td>
																	<td><?= htmlspecialchars($row->user_nicename) ?></td>
																	<td><?= htmlspecialchars($row->user_email) ?></td>
																	<td><?= htmlspecialchars($row->user_url) ?></td>
																	<td><?= htmlspecialchars($row->user_registered) ?></td>
																	<td><?= htmlspecialchars($row->user_status) ?></td>
																	<td><?= htmlspecialchars($row->display_name) ?></td>
															</tr>
															<?php endwhile; ?>
													</tbody>
											</table>
										</div>


										<form class="order-form" action="../add.php" method="post" novalidate>
											<h4>Изменить данные профиля пользователя</h4>
											<p class="form-group">
												<label class="form-label" for="userpol">Логин пользователя&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
												<input type="text" class="form-input input-text" name="userpol" id="userpol" autocomplete="userpol" value="" required aria-required="true">
											</p>

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

										<h5>Привет <?=$_COOKIE['user']?>. Чтобы выйти нажмите <a
											href="../../../exit.php">здесь</a>. </h5>






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

<?php endif; ?>
