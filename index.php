

<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная — Столовая</title>
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/styleM.css">
    <link rel="stylesheet" href="/styleMM.css">
    <link rel="stylesheet" href="/styleMMM.css">
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

                <h1 class="page-title">Главная</h1>
            </div>
        </div>

        <!-- Основной контент -->
        <main class="main-content">
          <!-- Герой секция -->
          <section class="hero-section">
              <div class="site-wrapper">
                  <div class="hero-content">
                      <div class="contact-info">
                          <div class="phone-number">
                              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                  <path d="M14.576,11.0085,12.4827,8.9152a1.3923,1.3923,0,0,0-2.3176.5233,1.4244,1.4244,0,0,1-1.6447.8971A6.455,6.455,0,0,1,4.6328,6.4481,1.3551,1.3551,0,0,1,5.53,4.8033a1.3922,1.3922,0,0,0,.5233-2.3175L3.96.3925a1.4929,1.4929,0,0,0-2.0185,0l-1.42,1.42C-.8994,3.3082.6705,7.27,4.1843,10.7842s7.476,5.1585,8.9712,3.6633L14.576,13.027A1.4931,1.4931,0,0,0,14.576,11.0085Z"/>
                              </svg>
                              123-456-7890
                          </div>
                      </div>

                      <div class="green-bg">
                          <h1 class="hero-title">Мы готовим сами!</h1>
                          <p class="hero-subtitle">Мы собственноручно готовим вам вкусную еду!</p>
                          <a href="/кухня/" class="btn-primary">Наша кухня</a>
                      </div>

                      <div class="hero-image">
                      </div>
                  </div>
              </div>
          </section>

          <!-- Секция качества -->
          <section class="quality-section">
              <div class="site-wrapper">
                  <div class="content-section">
                      <div class="quality-content">
                          <div class="quality-text">
                              <h2 class="section-title">Главное это качество</h2>
                              <p>Все продукты свежие, тщательно помытые, хранятся по технологиям!</p>
                              <a href="/контакты/" class="btn-primary">Проверить</a>
                          </div>
                          <div class="quality-image">
                          </div>
                      </div>
                  </div>
              </div>
          </section>

          <!-- Секция услуг -->
          <section class="services-section">
              <div class="site-wrapper">
                  <div class="content-section">
                      <div class="services-grid">
                          <div class="service-item">
                              <h3 class="section-title">Новости</h3>
                              <p>Здесь вы сможете увидеть самую свежую информацию</p>
                              <a href="/новости-и-акции/" class="btn-secondary">Новости</a>
                          </div>

                          <div class="service-item">
                              <h3 class="section-title">Акции</h3>
                              <p>Здесь вы сможете увидеть самые свежие скидки и акции</p>
                              <a href="/акции/" class="btn-secondary">Акции</a>
                          </div>

                          <div class="service-item">
                              <h3 class="section-title">Бронирование столика</h3>
                              <p>Здесь вы сможете забронировать свободный столик</p>
                              <a href="/бронирование-столика/" class="btn-secondary">Бронь</a>
                          </div>
                      </div>
                  </div>
              </div>
          </section>

          <!-- Галерея -->
          <section class="gallery-section">
              <div class="site-wrapper">
                  <div class="content-section">
                      <h2 class="section-title">О столовой</h2>
                      <p>Мы столовая которая находится в университете! Наши сотрудники опытные профессионалы знающие свое дело!</p>

                      <div class="gallery-grid">
                          <img src="/img/столовка.jpg" alt="Столовая">
                          <img src="/img/столовая.jpg" alt="Интерьер">
                          <img src="/img/столов.jpg" alt="Столы">
                          <img src="/img/работники-1024x800.jpg" alt="Работники">
                      </div>

                      <a href="/о-компании/" class="btn-primary">О столовой</a>
                  </div>
              </div>
          </section>

          <!-- Ассортимент -->
          <section class="products-section">
              <div class="site-wrapper">
                  <div class="content-section">
                      <h2 class="section-title">Наш ассортимент</h2>
                      <p>Мы предлагаем широкий выбор продукции как готовой продукции так и собственного производства</p>

                      <div class="products-grid">
                          <div class="product-card">
                              <img src="/img/пирожок-с-мясом.jpg" alt="Пирожок с мясом">
                              <h4>Пирожок</h4>
                              <p>Культовая классика в мясном исполнении</p>
                          </div>

                          <div class="product-card">
                              <img src="/img/борщ.jpeg" alt="Борщ">
                              <h4>Борщ</h4>
                              <p>С капустой, но не красной</p>
                          </div>

                          <div class="product-card">
                              <img src="/img/пирожок-с-картошкой.jpg" alt="Пирожок с картошкой">
                              <h4>Пирожок</h4>
                              <p>Неповторимая классика с картофелем</p>
                          </div>

                          <div class="product-card">
                              <img src="/img/сосиска-в-тесте.jpg" alt="Сосиска в тесте">
                              <h4>Сосиска в тесте</h4>
                              <p>Булочка с сосискою</p>
                          </div>
                      </div>
                  </div>
              </div>
          </section>

          <!-- Дополнительные услуги -->
          <section class="features-section">
              <div class="site-wrapper">
                  <div class="content-section">
                      <div class="features-grid">
                          <div class="feature-item">
                              <h3 class="section-title">Советы по питанию</h3>
                              <p>Мы собрали полезные советы по питанию которые пригодятся каждому</p>
                              <a href="/советы-по-питанию/" class="btn-secondary">Советы</a>
                          </div>

                          <div class="feature-item">
                              <h3 class="section-title">Калькулятор калорий</h3>
                              <p>Сделали для вас калькулятор</p>
                              <a href="/калькулятор-калорий/" class="btn-secondary">Калькулятор</a>
                          </div>

                          <div class="feature-item">
                              <h3 class="section-title">Выбираем новинку вместе</h3>
                              <p>Переходи и голосуй за новинку которая будет в нашем меню</p>
                              <a href="/опрос/" class="btn-secondary">Опрос</a>
                          </div>

                          <div class="feature-item">
                              <h3 class="section-title">Мифы про столовую</h3>
                              <p>Здесь вы узнаете популярные мифы про столовую, которые мы развеем</p>
                              <a href="/мифы/" class="btn-secondary">Мифы</a>
                          </div>
                      </div>
                  </div>
              </div>
          </section>

          <!-- Отзывы -->
          <section class="testimonials-section">
              <div class="site-wrapper">
                  <div class="content-section">
                      <h2 class="section-title">Про нас говорят</h2>

                      <div class="testimonials-grid">
                          <div class="testimonial-item">
                              <div class="testimonial-content">
                                  "Прекрасный персонал, дружелюбные люди, советую"
                              </div>
                              <div class="testimonial-author">
                                  <span>Джеймс</span>
                              </div>
                          </div>

                          <div class="testimonial-item">
                              <div class="testimonial-content">
                                  "Все очень свежее, прям понравилась атмосфера, есть что-то свое, родное"
                              </div>
                              <div class="testimonial-author">
                                  <span>Гарри</span>
                              </div>
                          </div>

                          <div class="testimonial-item">
                              <div class="testimonial-content">
                                  "Очень вкусная еда, всегда теплая, свежая, только приготовленная"
                              </div>
                              <div class="testimonial-author">
                                  <span>Джесика</span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
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
