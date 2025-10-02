<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отзывы — Столовая</title>
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/styleMMMM.css">
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
                    <a href="/">Главная</a> > Отзывы
                </div>
                <h1 class="page-title">Отзывы</h1>
            </div>
        </div>

        <!-- Основной контент -->
        <main class="main-content">
            <div class="site-wrapper">
                <div class="content-section">



				<div class="poll-container">
					<h2 class="poll-title">Отзывы</h2>
          <?php
  					if ($_COOKIE['user'] == ''):


  				?>

          <form class="form-review" action="add.php" method="post">
              <div class="row">
                  <div class="">
                      <label for="taskName" class="form-label">Ваше имя</label>
                      <input type="text" class="form-control" name="taskName" id="taskName" placeholder="Введите ваше имя" required>
                  </div>

                  <div class="">
                      <label for="taskTelephone" class="form-label">Номер телефона</label>
                      <input type="tel" class="form-control" name="taskTelephone" id="taskTelephone" placeholder="Введите номер телефона" required>
                  </div>

                  <div class="">
                      <label for="taskEmail" class="form-label">Электронная почта</label>
                      <input type="email" class="form-control" name="taskEmail" id="taskEmail" placeholder="email@example.com" required>
                  </div>

                  <div class="">
                      <label for="taskOcen" class="form-label">Оценка (0 - 9)</label>
                      <input type="number" class="form-control" name="taskOcen" id="taskOcen" min="0" max="9" required>
                  </div>
              </div>

              <label for="taskKomm" class="form-label">Комментарий</label>
              <textarea class="form-control" name="taskKomm" id="taskKomm" required></textarea>

              <button class="btn-submit" name="sendTask" type="submit">Отправить отзыв</button>
          </form>

          <div class="vivodOtz">
            <h2 class="reviews-title">Оставленные отзывы</h2><br>
            <?php
              require '../my-account/configDB.php';

              echo '<ul>';
              $query = $pdo->query('SELECT * FROM `st_taskspol`ORDER BY `id` DESC');
              while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                echo '
                <li class="review-item">
                    <div class="review-header">
                        <h3 class="review-author">'.$row->taskName.'</h3>
                        <span class="review-rating">Оценка: '.$row->taskOcen.'/9</span>
                    </div>
                    <p class="review-content">'.$row->taskKomm.'</p>
                    <div class="review-meta">
                        <span>Телефон: '.$row->taskTelephone.'</span>
                        <span>Email: '.$row->taskEmail.'</span>
                    </div>
                </li>';
              }
              echo '</ul>';
            ?>
          </div>


          <?php
            elseif ($_COOKIE['user'] == 'admin1'):


          ?>

          <form class="form-review" action="add.php" method="post">
              <div class="row">
                  <div class="">
                      <label for="taskName" class="form-label">Ваше имя</label>
                      <input type="text" class="form-control" name="taskName" id="taskName" placeholder="Введите ваше имя" required>
                  </div>

                  <div class="">
                      <label for="taskTelephone" class="form-label">Номер телефона</label>
                      <input type="tel" class="form-control" name="taskTelephone" id="taskTelephone" placeholder="Введите номер телефона" required>
                  </div>

                  <div class="">
                      <label for="taskEmail" class="form-label">Электронная почта</label>
                      <input type="email" class="form-control" name="taskEmail" id="taskEmail" placeholder="email@example.com" required>
                  </div>

                  <div class="">
                      <label for="taskOcen" class="form-label">Оценка (0 - 9)</label>
                      <input type="number" class="form-control" name="taskOcen" id="taskOcen" min="0" max="9" required>
                  </div>
              </div>

              <label for="taskKomm" class="form-label">Комментарий</label>
              <textarea class="form-control" name="taskKomm" id="taskKomm" required></textarea>

              <button class="btn-submit" name="sendTask" type="submit">Отправить отзыв</button>
          </form>

          <div class="vivodOtz">
            <h2 class="reviews-title">Оставленные отзывы</h2><br>
            <?php
              require '../my-account/configDB.php';

              echo '<ul>';
              $query = $pdo->query('SELECT * FROM `st_taskspol`ORDER BY `id` DESC');
              while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                echo '
                <li class="review-item">
                    <div class="review-header">
                        <h3 class="review-author">'.$row->taskName.'</h3>
                        <span class="review-rating">Оценка: '.$row->taskOcen.'/9</span>
                    </div>
                    <p class="review-content">'.$row->taskKomm.'</p>
                    <div class="review-meta">
                        <span>Телефон: '.$row->taskTelephone.'</span>
                        <span>Email: '.$row->taskEmail.'</span>
                    </div>
                    <a href="../my-account/admin/deleteOtz.php?id='.$row->id.'" ><button class="btn-submit">Удалить</button></a>
                </li>';
              }
              echo '</ul>';
            ?>
          </div>


        <?php else: ?>

          <form class="form-review" action="add.php" method="post">
              <div class="row">
                  <div class="">
                      <label for="taskName" class="form-label">Ваше имя</label>
                      <input type="text" class="form-control" name="taskName" id="taskName" placeholder="Введите ваше имя" required>
                  </div>

                  <div class="">
                      <label for="taskTelephone" class="form-label">Номер телефона</label>
                      <input type="tel" class="form-control" name="taskTelephone" id="taskTelephone" placeholder="Введите номер телефона" required>
                  </div>

                  <div class="">
                      <label for="taskEmail" class="form-label">Электронная почта</label>
                      <input type="email" class="form-control" name="taskEmail" id="taskEmail" placeholder="email@example.com" required>
                  </div>

                  <div class="">
                      <label for="taskOcen" class="form-label">Оценка (0 - 9)</label>
                      <input type="number" class="form-control" name="taskOcen" id="taskOcen" min="0" max="9" required>
                  </div>
              </div>

              <label for="taskKomm" class="form-label">Комментарий</label>
              <textarea class="form-control" name="taskKomm" id="taskKomm" required></textarea>

              <button class="btn-submit" name="sendTask" type="submit">Отправить отзыв</button>
          </form>

          <div class="vivodOtz">
            <h2 class="reviews-title">Оставленные отзывы</h2><br>
            <?php
              require '../my-account/configDB.php';

              echo '<ul>';
              $query = $pdo->query('SELECT * FROM `st_taskspol`ORDER BY `id` DESC');
              while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                echo '
                <li class="review-item">
                    <div class="review-header">
                        <h3 class="review-author">'.$row->taskName.'</h3>
                        <span class="review-rating">Оценка: '.$row->taskOcen.'/9</span>
                    </div>
                    <p class="review-content">'.$row->taskKomm.'</p>
                    <div class="review-meta">
                        <span>Телефон: '.$row->taskTelephone.'</span>
                        <span>Email: '.$row->taskEmail.'</span>
                    </div>
                </li>';
              }
              echo '</ul>';
            ?>
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
</body>
</html>
