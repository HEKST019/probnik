<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Опрос — Столовая</title>
    <link rel="stylesheet" href="/style.css">
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
                    <a href="/">Главная</a> > Опрос
                </div>
                <h1 class="page-title">Опрос</h1>
            </div>
        </div>

        <!-- Основной контент -->
        <main class="main-content">
            <div class="site-wrapper">
                <div class="content-section">






                  <div class="poll-intro">
                      <p>Мы обновляем ассортимент и хотим узнать ваше мнение! Голосуйте за блюдо, которое появится в меню:</p>
                      <p>Ваш выбор поможет сделать столовую лучше! Спасибо! 😊</p>
                      <p class="poll-hashtag"><em>#Голосуй_и_вкусно_поешь</em></p>
                  </div>

                  <!-- Опрос -->
                  <div id="dish-poll" class="poll-container">
                      <h2>Какое блюдо вы хотите видеть в нашем меню?</h2>
                      <p class="poll-subtitle">Помогите нам выбрать следующую новинку для нашего меню!</p>

                      <div class="poll-options">
                          <div class="poll-option">
                              <input type="radio" id="dish1" name="dish" value="Крем-суп из тыквы с имбирем">
                              <label for="dish1">
                                  <img src="/flask/img/krem-sup-iz-tykvy.jpg" alt="Крем-суп из тыквы с имбирем">
                                  <span>Крем-суп из тыквы с имбирем</span>
                              </label>
                          </div>

                          <div class="poll-option">
                              <input type="radio" id="dish2" name="dish" value="Куриные грудки в медово-горчичном соусе">
                              <label for="dish2">
                                  <img src="/flask/img/kyrgryd.jfif" alt="Куриные грудки в медово-горчичном соусе">
                                  <span>Куриные грудки в медово-горчичном соусе</span>
                              </label>
                          </div>

                          <div class="poll-option">
                              <input type="radio" id="dish3" name="dish" value="Лазанья со шпинатом и рикоттой">
                              <label for="dish3">
                                  <img src="/flask/img/lazan.jpg" alt="Лазанья со шпинатом и рикоттой">
                                  <span>Лазанья со шпинатом и рикоттой</span>
                              </label>
                          </div>

                          <div class="poll-option">
                              <input type="radio" id="dish4" name="dish" value="Фалафель с хумусом и лепешкой">
                              <label for="dish4">
                                  <img src="/flask/img/caption.jpg" alt="Фалафель с хумусом и лепешкой">
                                  <span>Фалафель с хумусом и лепешкой</span>
                              </label>
                          </div>
                      </div>

                      <div class="poll-actions">
                          <button id="vote-btn" class="btn-vote">Голосовать</button>
                          <button id="results-btn" class="btn-results">Посмотреть результаты</button>
                      </div>

                      <div id="poll-results" class="poll-results">
                          <h3>Результаты опроса:</h3>
                          <div class="result-chart">
                              <div class="result-item">
                                  <span class="dish-name">Крем-суп из тыквы с имбирем</span>
                                  <div class="result-bar" data-dish="Крем-суп из тыквы с имбирем">
                                      <span class="dish-percent">0%</span>
                                      <span class="dish-votes">(0 голосов)</span>
                                  </div>
                              </div>
                              <div class="result-item">
                                  <span class="dish-name">Куриные грудки в медово-горчичном соусе</span>
                                  <div class="result-bar" data-dish="Куриные грудки в медово-горчичном соусе">
                                      <span class="dish-percent">0%</span>
                                      <span class="dish-votes">(0 голосов)</span>
                                  </div>
                              </div>
                              <div class="result-item">
                                  <span class="dish-name">Лазанья со шпинатом и рикоттой</span>
                                  <div class="result-bar" data-dish="Лазанья со шпинатом и рикоттой">
                                      <span class="dish-percent">0%</span>
                                      <span class="dish-votes">(0 голосов)</span>
                                  </div>
                              </div>
                              <div class="result-item">
                                  <span class="dish-name">Фалафель с хумусом и лепешкой</span>
                                  <div class="result-bar" data-dish="Фалафель с хумусом и лепешкой">
                                      <span class="dish-percent">0%</span>
                                      <span class="dish-votes">(0 голосов)</span>
                                  </div>
                              </div>
                          </div>
                          <div class="total-votes">Всего голосов: <span id="total-votes">0</span></div>
                      </div>

                      <div id="poll-message" class="poll-message"></div>
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
    <style>#dish-poll {
            max-width: 800px;
            margin: 30px auto;
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #fff;
            border-radius: 25px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }

        #dish-poll h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 10px;
        }

        #dish-poll p {
            text-align: center;
            color: #7f8c8d;
            margin-bottom: 30px;
        }

        .poll-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .poll-option {
            position: relative;
        }

        .poll-option input[type="radio"] {
            position: absolute;
            opacity: 0;
        }

        .poll-option label {
            display: block;
            border: 2px solid #eee;
            border-radius: 25px;
            padding: 15px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .poll-option label:hover {
            border-color: #3498db;
        }

        .poll-option input[type="radio"]:checked + label {
            border-color: #3498db;
            background-color: #f0f8ff;

        }

        .poll-option img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 25px;
            margin-bottom: 10px;
        }

        .poll-option span {
            display: block;
            text-align: center;
            font-weight: bold;
            color: #2c3e50;
        }

        .poll-actions {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .btn-vote, .btn-results {
            padding: 12px 25px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-vote {
            background: #0AAA09;
            color: white;
        }

        .btn-vote:hover {
            background: #077a06
        }

        .btn-results {
            background: #e74c3c;
            color: white;
        }

        .btn-results:hover {
            background: #c0392b;
        }

        #poll-results {
            margin-top: 30px;
        }

        #poll-results h3 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .result-chart {
            margin-bottom: 20px;
        }

        .result-bar {
            height: 40px;
            background: #0AAA09;
            margin-bottom: 50px;
            border-radius: 25px;
            position: relative;

            transition: width 1s ease-in-out;
            display: flex;
            align-items: center;
            padding: 0 15px;
            color: white;
            width: 70px;
        }

        .dish-name {
            flex: 1;
            font-weight: bold;
            color: black;
        }

        .dish-percent {
            margin: 0 15px;
        }

        .dish-votes {
            font-size: 14px;
        }

        .total-votes {
            text-align: center;
            font-weight: bold;
            color: #7f8c8d;
        }

        #poll-message {
            padding: 15px;
            margin-top: 20px;
            border-radius: 25px;
            text-align: center;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
        }</style>
    <!-- Скрипт для опроса -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Хранилище голосов
        let pollResults = {
            "Крем-суп из тыквы с имбирем": 0,
            "Куриные грудки в медово-горчичном соусе": 0,
            "Лазанья со шпинатом и рикоттой": 0,
            "Фалафель с хумусом и лепешкой": 0
        };

        // Проверяем, есть ли сохраненные результаты в localStorage
        if (localStorage.getItem('dishPollResults')) {
            try {
                pollResults = JSON.parse(localStorage.getItem('dishPollResults'));
            } catch (e) {
                console.error('Ошибка загрузки результатов:', e);
            }
        }

        const voteBtn = document.getElementById('vote-btn');
        const resultsBtn = document.getElementById('results-btn');
        const pollResultsDiv = document.getElementById('poll-results');
        const messageDiv = document.getElementById('poll-message');

        // Обработчик голосования
        voteBtn.addEventListener('click', function() {
            const selectedDish = document.querySelector('input[name="dish"]:checked');

            if (!selectedDish) {
                showMessage('Пожалуйста, выберите блюдо!', 'error');
                return;
            }

            // Проверяем, голосовал ли уже пользователь
            const hasVoted = localStorage.getItem('hasVoted');

            if (hasVoted === 'true') {
                showMessage('Вы уже проголосовали!', 'error');
                return;
            }

            // Увеличиваем счетчик голосов
            pollResults[selectedDish.value]++;

            // Сохраняем результаты
            localStorage.setItem('dishPollResults', JSON.stringify(pollResults));
            localStorage.setItem('hasVoted', 'true');

            showMessage('Спасибо за ваш голос!', 'success');
            updateResults();
        });

        // Обработчик просмотра результатов
        resultsBtn.addEventListener('click', function() {
            updateResults();
            pollResultsDiv.style.display = 'block';
        });

        // Функция обновления результатов
        function updateResults() {
            const totalVotes = Object.values(pollResults).reduce((a, b) => a + b, 0);
            document.getElementById('total-votes').textContent = totalVotes;

            if (totalVotes === 0) {
                // Сбрасываем все полоски к 0%
                document.querySelectorAll('.result-bar').forEach(bar => {
                    bar.style.width = '0%';
                    bar.querySelector('.dish-percent').textContent = '0%';
                    bar.querySelector('.dish-votes').textContent = '(0 голосов)';
                });
                return;
            }

            // Обновляем проценты для каждого блюда
            for (const dish in pollResults) {
                const votes = pollResults[dish];
                const percent = Math.round((votes / totalVotes) * 100);

                const bar = document.querySelector(`.result-bar[data-dish="${dish}"]`);
                if (bar) {
                    bar.style.width = `${percent}%`;
                    bar.querySelector('.dish-percent').textContent = `${percent}%`;
                    bar.querySelector('.dish-votes').textContent = `(${votes} голосов)`;
                }
            }
        }

        // Функция показа сообщений
        function showMessage(text, type) {
            messageDiv.textContent = text;
            messageDiv.className = `poll-message ${type}-message`;
            messageDiv.style.display = 'block';

            setTimeout(function() {
                messageDiv.style.display = 'none';
            }, 3000);
        }

        // Инициализация при загрузке
        updateResults();
    });
    </script>




</body>
</html>
