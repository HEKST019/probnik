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
        const voteBtn = document.getElementById('vote-btn');
        const resultsBtn = document.getElementById('results-btn');
        const pollResultsDiv = document.getElementById('poll-results');
        const messageDiv = document.getElementById('poll-message');

        // Загружаем результаты при загрузке страницы
        loadResults();
        pollResultsDiv.style.display = 'block';

        // Обработчик голосования
        voteBtn.addEventListener('click', function() {
            const selectedOption = document.querySelector('input[name="dish"]:checked');

            if (!selectedOption) {
                showMessage('Пожалуйста, выберите вариант!', 'error');
                return;
            }

            // Создаем данные для отправки
            var params = 'action=vote&technology=' + encodeURIComponent(selectedOption.value);

            // Отправляем голос на сервер
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'poll_handler.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    try {
                        var data = JSON.parse(xhr.responseText);
                        if (data.success) {
                            showMessage(data.message, 'success');
                            updateResults(data.results, data.totalVotes);
                        } else {
                            showMessage(data.message, 'error');
                        }
                    } catch (e) {
                        showMessage('Ошибка обработки ответа', 'error');
                    }
                }
            };

            xhr.send(params);
        });

        // Обработчик просмотра результатов
        resultsBtn.addEventListener('click', function() {
            loadResults();
            pollResultsDiv.style.display = 'block';
        });

        // Функция загрузки результатов
        function loadResults() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'poll_handler.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    try {
                        var data = JSON.parse(xhr.responseText);
                        if (data.success) {
                            updateResults(data.results, data.totalVotes);
                        } else {
                            showMessage('Ошибка загрузки результатов', 'error');
                        }
                    } catch (e) {
                        showMessage('Ошибка обработки ответа', 'error');
                    }
                }
            };

            xhr.send('action=get_results');
        }

        // Функция обновления отображения результатов
        function updateResults(results, totalVotes) {
            // Обновляем общее количество голосов
            document.getElementById('total-votes').textContent = totalVotes;

            // Обновляем каждую технологию
            for (var i = 0; i < results.length; i++) {
                var result = results[i];
                var votes = result.votes;
                var percent = totalVotes > 0 ? Math.round((votes / totalVotes) * 100) : 0;

                var bar = document.querySelector('.result-bar[data-dish="' + result.technology + '"]');
                if (bar) {
                    bar.style.width = percent + '%';
                    bar.querySelector('.dish-percent').textContent = percent + '%';
                    bar.querySelector('.dish-votes').textContent = '(' + votes + ' голосов)';
                }
            }
        }

        // Функция показа сообщений
        function showMessage(text, type) {
            messageDiv.textContent = text;
            messageDiv.className = type + '-message';
            messageDiv.style.display = 'block';

            setTimeout(function() {
                messageDiv.style.display = 'none';
            }, 3000);
        }
    });
    </script>




</body>
</html>
