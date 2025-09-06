<?php
	if ($_COOKIE['user'] == 'admin1'):


?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформленные заказы — Столовая</title>
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
                    <a href="/">Главная</a> > Оформленные заказы
                </div>
                <h1 class="page-title">Оформленные заказы</h1>
            </div>
        </div>

        <!-- Основной контент -->
        <main class="main-content">
            <div class="site-wrapper">
                <div class="content-section">






                    <h2 class="section-title">Оформленные заказы</h2>

										<?php
										require '../../configDB.php';
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
