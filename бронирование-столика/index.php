<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Бронирование столика — Столовая</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/styleMMMM.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
</head>

<body class="site-body">
    <div class="site-wrapper">
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

        <div class="page-header">
            <div class="site-wrapper">
                <div class="breadcrumbs">
                    <a href="/">Главная</a> > Бронирование столика
                </div>
                <h1 class="page-title">Бронирование столика</h1>
            </div>
        </div>

        <main class="main-content">
            <div class="site-wrapper">
                <div class="content-section">
                    <div class="delivery-info">
                        <p>Здесь вы сможете выбрать актуальный свободный столик в нашей столовой и сделать бронирование для того чтобы удобно и спокойно отведать нашей вкусной еды.</p>
                    </div>
                    <?php
                      if ($_COOKIE['user'] == ''):


                    ?>

                    <h2>Бронирование столиков доступно для авторизованных пользователей</h2>

                    <?php else: ?>


                    <div id="table-booking-system">
                        <h2>Бронирование столиков на сегодня</h2>
                        <div class="current-date"></div>

                        <div class="booking-grid">
                            <table>
                                <thead>
                                    <tr>
                                        <!-- Заголовки будут добавлены через JavaScript -->
                                    </tr>
                                </thead>
                                <tbody class="grid-content"></tbody>
                            </table>
                        </div>

                        <div id="booking-form" class="booking-form" style="display:none;">
                            <h3>Вы бронируете: <span id="selected-table"></span> в <span id="selected-slot"></span></h3>
                            <div id="expiry-info" class="timer"></div>
                            <button id="confirm-booking" class="booking-button">Забронировать (60 мин)</button>
                            <button id="cancel-booking" class="booking-button cancel" style="display:none;">Отменить бронь</button>
                            <button id="close-form" class="booking-button" style="background: #95a5a6;">Закрыть</button>
                        </div>

                        <div id="booking-status"></div>
                    </div>

                    <?php endif; ?>

                </div>
            </div>
        </main>

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
    // Функция для получения куки
    function getCookie(name) {
        const value = '; ' + document.cookie;
        const parts = value.split('; ' + name + '=');
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }

    // Определение пользователя
    function getCurrentUser() {
        const userName = getCookie('user');

        if (userName === 'admin1') {
            return { id: 'admin1', name: 'Администратор', role: 'admin' };
        } else if (userName === 'manager1') {
            return { id: 'manager1', name: 'Менеджер', role: 'support' };
        } else if (userName) {
            return { id: 'user_' + userName, name: userName, role: 'user' };
        }

        // Гостевой аккаунт
        return {
            id: 'guest_' + Math.random().toString(36).slice(2, 11),
            name: 'Гость',
            role: 'guest'
        };
    }

    // Функция для получения московского времени
    function getMoscowTime() {
        return new Date(new Date().toLocaleString("en-US", {timeZone: "Europe/Moscow"}));
    }

    // Функция для создания даты с московским временем
    function createMoscowDate(dateString, timeString) {
        // Создаем строку в формате для московского времени
        const moscowDateTimeString = `${dateString}T${timeString}:00+03:00`;
        return new Date(moscowDateTimeString);
    }

    // Функция для проверки, истекло ли время слота (в московском времени)
    function isTimeSlotPassed(slot) {
        const nowMoscow = getMoscowTime();
        const today = nowMoscow.toISOString().split('T')[0];

        // Создаем объект времени для слота в московском времени
        const slotTime = createMoscowDate(today, slot);

        return nowMoscow > slotTime;
    }

    // Основной класс системы бронирования
    class TableBookingSystem {
        constructor() {
            this.currentUser = getCurrentUser();
            this.selectedSlot = '';
            this.selectedTable = '';
            this.bookingsData = {};
            this.expiryTimer = null;
            this.pollInterval = 5000; // Обновление каждые 5 секунд
        }

        async init() {
            console.log('Инициализация системы бронирования для:', this.currentUser.name);
            console.log('Роль пользователя:', this.currentUser.role);

            // Отладочная информация о времени
            const localTime = new Date();
            const moscowTime = getMoscowTime();
            console.log('Локальное время:', localTime.toString());
            console.log('Московское время:', moscowTime.toString());
            console.log('Разница во времени:', (moscowTime - localTime) / (1000 * 60 * 60), 'часов');

            // Показываем текущую дату
            this.showCurrentDate();

            // Загружаем данные о бронированиях
            await this.loadBookings();

            // Запускаем периодическое обновление
            this.startPolling();

            // Настраиваем обработчики событий
            this.setupEventListeners();

            this.showStatus('Система бронирования загружена (время МСК)', 'info');
        }

        showCurrentDate() {
            const moscowTime = getMoscowTime();
            const dateElement = document.querySelector('.current-date');
            dateElement.textContent = moscowTime.toLocaleDateString('ru-RU', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                timeZone: 'Europe/Moscow'
            }) + ' (Московское время)';
        }

        async loadBookings() {
            try {
                const response = await this.makeRequest('get_bookings');
                if (response.success) {
                    this.bookingsData = response.bookings;
                    this.renderGrid();
                } else {
                    this.showStatus('Ошибка загрузки данных: ' + response.error, 'error');
                }
            } catch (error) {
                console.error('Ошибка загрузки бронирований:', error);
                this.showStatus('Ошибка соединения с сервером', 'error');
            }
        }

        renderGrid() {
            const gridContent = document.querySelector('.grid-content');
            if (!gridContent) return;

            gridContent.innerHTML = '';

            // Временные слоты (с 10:00 до 22:00 с интервалом в 1 час)
            const timeSlots = [];
            for (let hour = 10; hour <= 22; hour++) {
                timeSlots.push(hour + ':00');
            }

            // Столики (10 столиков)
            const tables = [];
            for (let i = 1; i <= 10; i++) {
                tables.push('Столик ' + i);
            }

            // Создаем заголовок с временными слотами
            const headerRow = document.createElement('tr');

            // Пустая ячейка в углу
            const cornerCell = document.createElement('th');
            cornerCell.className = 'table-name';
            cornerCell.textContent = 'Столики \\ Время (МСК)';
            headerRow.appendChild(cornerCell);

            // Заголовки времени
            timeSlots.forEach(slot => {
                const th = document.createElement('th');
                th.className = 'time-header';

                // Помечаем прошедшие временные слоты (по московскому времени)
                if (isTimeSlotPassed(slot)) {
                    th.className += ' passed-slot';
                    th.innerHTML = slot + '<br><small>Прошедшее<br>(МСК)</small>';
                } else {
                    th.innerHTML = slot + '<br><small>МСК</small>';
                }

                headerRow.appendChild(th);
            });

            gridContent.appendChild(headerRow);

            // Создаем строки для каждого столика
            tables.forEach(table => {
                const row = document.createElement('tr');

                // Ячейка с названием столика
                const nameCell = document.createElement('td');
                nameCell.className = 'table-name';
                nameCell.textContent = table;
                row.appendChild(nameCell);

                // Ячейки для каждого временного слота
                timeSlots.forEach(slot => {
                    const cell = document.createElement('td');
                    cell.className = 'time-slot';

                    // Проверяем, прошел ли временной слот (по московскому времени)
                    const isPassed = isTimeSlotPassed(slot);

                    // Проверяем статус бронирования
                    const booking = this.getBooking(slot, table);
                    let status = 'available';
                    let title = 'Свободно - нажмите для бронирования';
                    let isClickable = true;

                    if (booking) {
                        // Есть бронь - показываем информацию о брони независимо от времени
                        if (booking.user_id === this.currentUser.id) {
                            status = 'my-booking';
                            const slotTime = new Date(booking.slot_time * 1000);
                            const expires = new Date(booking.expires_at * 1000);

                            const nowMoscow = getMoscowTime();
                            if (isPassed) {
                                title = `Ваша прошедшая бронь (была на ${slotTime.toLocaleTimeString('ru-RU', {hour: '2-digit', minute: '2-digit', timeZone: 'Europe/Moscow'})} МСК)`;
                                isClickable = false; // Нельзя кликать на прошедшие свои брони
                            } else if (nowMoscow < slotTime) {
                                title = `Ваша бронь (начнется в ${slotTime.toLocaleTimeString('ru-RU', {hour: '2-digit', minute: '2-digit', timeZone: 'Europe/Moscow'})} МСК)`;
                            } else if (nowMoscow < expires) {
                                title = `Ваша бронь (истекает в ${expires.toLocaleTimeString('ru-RU', {hour: '2-digit', minute: '2-digit', timeZone: 'Europe/Moscow'})} МСК)`;
                            } else {
                                title = 'Ваша бронь истекла (МСК)';
                            }
                        } else {
                            status = 'booked';
                            const slotTime = new Date(booking.slot_time * 1000);
                            if (isPassed) {
                                title = `Было забронировано: ${booking.user_name} (${slotTime.toLocaleTimeString('ru-RU', {hour: '2-digit', minute: '2-digit', timeZone: 'Europe/Moscow'})} МСК)`;
                            } else {
                                title = 'Забронировано: ' + booking.user_name + ' (МСК)';
                            }
                            // Админ может кликать на чужие брони для отмены
                            isClickable = this.currentUser.role === 'admin';
                        }
                    } else if (isPassed) {
                        // Нет брони и время прошло - слот недоступен
                        status = 'passed';
                        title = 'Время истекло (свободно) МСК';
                        isClickable = false;
                    }

                    cell.className += ' ' + status;
                    cell.title = title;

                    // Добавляем текст в ячейку
                    if (status === 'passed') {
                        cell.innerHTML = '⌛<br><small>Истекло</small>';
                        cell.style.opacity = '0.6';
                    } else if (status === 'my-booking') {
                        if (isPassed) {
                            cell.innerHTML = '✓<br><small>Ваша<br>прошлая</small>';
                            cell.style.opacity = '0.7';
                        } else {
                            cell.innerHTML = '✓<br><small>Ваше</small>';
                        }
                    } else if (status === 'booked') {
                        if (isPassed) {
                            cell.innerHTML = '✗<br><small>Было<br>занято</small>';
                            cell.style.opacity = '0.7';
                        } else {
                            cell.innerHTML = '✗<br><small>Занято</small>';
                        }
                    } else {
                        cell.innerHTML = '○<br><small>Свободно</small>';
                    }

                    // Добавляем обработчик клика только для доступных слотов
                    if (isClickable) {
                        cell.addEventListener('click', () => {
                            this.handleCellClick(slot, table, booking);
                        });
                    } else {
                        cell.style.cursor = 'default';
                        cell.style.pointerEvents = 'none';
                    }

                    row.appendChild(cell);
                });

                gridContent.appendChild(row);
            });
        }

        getBooking(slot, table) {
            const today = this.getTodayKey();
            if (this.bookingsData[today] && this.bookingsData[today][slot]) {
                return this.bookingsData[today][slot][table] || null;
            }
            return null;
        }

        getTodayKey() {
            const moscowTime = getMoscowTime();
            return moscowTime.toISOString().split('T')[0]; // YYYY-MM-DD
        }

        handleCellClick(slot, table, booking) {
            // Дополнительная проверка на случай, если время истекло во время сессии
            if (isTimeSlotPassed(slot) && this.currentUser.role !== 'admin') {
                this.showStatus('Это время уже прошло по московскому времени, бронирование невозможно', 'error');
                return;
            }

            this.selectedSlot = slot;
            this.selectedTable = table;

            const form = document.getElementById('booking-form');
            form.style.display = 'block';

            // Исправляем отображение времени - показываем именно выбранный слот
            document.getElementById('selected-slot').textContent = slot;
            document.getElementById('selected-table').textContent = table;

            const isMyBooking = booking && booking.user_id === this.currentUser.id;
            const isAdmin = this.currentUser.role === 'admin';
            const hasBooking = booking !== null;

            // Логика отображения кнопок для разных пользователей
            if (isAdmin && hasBooking) {
                // Админ видит кнопку отмены для любой брони
                document.getElementById('confirm-booking').style.display = 'none';
                document.getElementById('cancel-booking').style.display = 'inline-block';
                document.getElementById('cancel-booking').textContent = 'Отменить бронь (Админ)';
                document.getElementById('cancel-booking').style.background = '#e74c3c';
            } else if (isMyBooking) {
                // Обычный пользователь видит кнопку отмены только для своих броней
                document.getElementById('confirm-booking').style.display = 'none';
                document.getElementById('cancel-booking').style.display = 'inline-block';
                document.getElementById('cancel-booking').textContent = 'Отменить мою бронь';
                document.getElementById('cancel-booking').style.background = '#e74c3c';
            } else if (!hasBooking && !isTimeSlotPassed(slot)) {
                // Свободный слот - можно бронировать
                document.getElementById('confirm-booking').style.display = 'inline-block';
                document.getElementById('cancel-booking').style.display = 'none';
                document.getElementById('confirm-booking').textContent = `Забронировать на ${slot} (60 мин)`;
                document.getElementById('confirm-booking').style.background = '#27ae60';
            } else {
                // Во всех остальных случаях скрываем обе кнопки
                document.getElementById('confirm-booking').style.display = 'none';
                document.getElementById('cancel-booking').style.display = 'none';
            }

            // Обновляем информацию о брони
            this.updateBookingInfo(booking, slot);
        }

        updateBookingInfo(booking, slot) {
            const expiryEl = document.getElementById('expiry-info');

            if (booking) {
                const slotTime = new Date(booking.slot_time * 1000);
                const expiresAt = new Date(booking.expires_at * 1000);
                const nowMoscow = getMoscowTime();

                let infoText = '';

                if (this.currentUser.role === 'admin') {
                    // Информация для администратора
                    infoText = `Бронь пользователя: ${booking.user_name}<br>`;
                    infoText += `Забронировано: ${new Date(booking.booked_at * 1000).toLocaleTimeString('ru-RU', {hour: '2-digit', minute: '2-digit'})}<br>`;
                }

                if (nowMoscow < slotTime) {
                    infoText += `Начнется в: ${slotTime.toLocaleTimeString('ru-RU', {hour: '2-digit', minute: '2-digit', timeZone: 'Europe/Moscow'})} МСК`;
                } else if (nowMoscow < expiresAt) {
                    infoText += `Действует до: ${expiresAt.toLocaleTimeString('ru-RU', {hour: '2-digit', minute: '2-digit', timeZone: 'Europe/Moscow'})} МСК`;
                } else {
                    infoText += 'Бронь истекла (МСК)';
                }

                expiryEl.innerHTML = infoText;

                if (nowMoscow < expiresAt) {
                    this.startExpiryTimer(slotTime, expiresAt, booking);
                } else {
                    if (this.expiryTimer) {
                        clearInterval(this.expiryTimer);
                        this.expiryTimer = null;
                    }
                }
            } else {
                // Для новой брони
                const today = this.getTodayKey();
                const slotDateTime = createMoscowDate(today, slot);
                const nowMoscow = getMoscowTime();

                if (nowMoscow > slotDateTime) {
                    expiryEl.textContent = 'Это время уже прошло по московскому времени';
                } else {
                    expiryEl.textContent = `Бронь будет действительна с ${slotDateTime.toLocaleTimeString('ru-RU', {hour: '2-digit', minute: '2-digit', timeZone: 'Europe/Moscow'})} МСК в течение 60 минут`;
                }

                if (this.expiryTimer) {
                    clearInterval(this.expiryTimer);
                    this.expiryTimer = null;
                }
            }
        }

        startExpiryTimer(slotTime, expiresAt, booking) {
            const expiryEl = document.getElementById('expiry-info');
            const isAdmin = this.currentUser.role === 'admin';

            const updateTimer = () => {
                const now = getMoscowTime(); // Используем московское время

                // Создаем базовый текст информации
                let baseText = '';
                if (isAdmin && booking) {
                    baseText = `Бронь пользователя: ${booking.user_name}<br>`;
                    baseText += `Забронировано: ${new Date(booking.booked_at * 1000).toLocaleTimeString('ru-RU', {hour: '2-digit', minute: '2-digit'})}<br>`;
                }

                if (now < slotTime) {
                    // До начала временного слота
                    const timeUntilStart = Math.max(0, Math.round((slotTime - now) / 1000));
                    const minutes = Math.floor(timeUntilStart / 60);
                    const seconds = timeUntilStart % 60;
                    expiryEl.innerHTML = baseText + `Начнется в: ${slotTime.toLocaleTimeString('ru-RU', {hour: '2-digit', minute: '2-digit', timeZone: 'Europe/Moscow'})} МСК<br>До начала: ${minutes}:${seconds.toString().padStart(2, '0')}`;
                } else if (now < expiresAt) {
                    // Во время действия брони
                    const timeLeft = Math.max(0, Math.round((expiresAt - now) / 1000));
                    const minutes = Math.floor(timeLeft / 60);
                    const seconds = timeLeft % 60;
                    expiryEl.innerHTML = baseText + `Действует до: ${expiresAt.toLocaleTimeString('ru-RU', {hour: '2-digit', minute: '2-digit', timeZone: 'Europe/Moscow'})} МСК<br>Осталось: ${minutes}:${seconds.toString().padStart(2, '0')}`;
                } else {
                    // Бронь истекла
                    expiryEl.innerHTML = baseText + 'Бронь истекла (МСК)';
                    clearInterval(this.expiryTimer);
                    this.loadBookings(); // Перезагружаем данные
                }
            };

            if (this.expiryTimer) clearInterval(this.expiryTimer);
            this.expiryTimer = setInterval(updateTimer, 1000);
            updateTimer(); // Первоначальный вызов
        }

        async confirmBooking() {
            if (!this.selectedSlot || !this.selectedTable) return;

            // Финальная проверка перед бронированием
            if (isTimeSlotPassed(this.selectedSlot) && this.currentUser.role !== 'admin') {
                this.showStatus('Это время уже прошло по московскому времени, бронирование невозможно', 'error');
                document.getElementById('booking-form').style.display = 'none';
                await this.loadBookings(); // Обновляем сетку
                return;
            }

            try {
                const response = await this.makeRequest('book_table', {
                    slot: this.selectedSlot,
                    table: this.selectedTable,
                    user_id: this.currentUser.id,
                    user_name: this.currentUser.name
                });

                if (response.success) {
                    const slotTime = new Date(response.booking.slot_time * 1000);
                    const expiresAt = new Date(response.booking.expires_at * 1000);

                    const nowMoscow = getMoscowTime();
                    if (nowMoscow < slotTime) {
                        this.showStatus(`Столик успешно забронирован! Бронь будет действительна с ${slotTime.toLocaleTimeString('ru-RU', {hour: '2-digit', minute: '2-digit', timeZone: 'Europe/Moscow'})} МСК в течение 60 минут.`, 'success');
                    } else {
                        this.showStatus('Столик успешно забронирован! Бронь действительна 60 минут (МСК).', 'success');
                    }

                    document.getElementById('booking-form').style.display = 'none';
                    await this.loadBookings(); // Обновляем сетку
                } else {
                    this.showStatus('Ошибка: ' + response.error, 'error');
                }
            } catch (error) {
                this.showStatus('Ошибка соединения при бронировании', 'error');
            }
        }

        async cancelBooking() {
            if (!this.selectedSlot || !this.selectedTable) return;

            try {
                const booking = this.getBooking(this.selectedSlot, this.selectedTable);
                const isAdmin = this.currentUser.role === 'admin';

                // Для администратора отправляем данные о брони, которую он отменяет
                const requestData = {
                    slot: this.selectedSlot,
                    table: this.selectedTable,
                    user_id: this.currentUser.id // ID администратора
                };

                // Если админ отменяет чужую бронь, добавляем информацию о исходном пользователе
                if (isAdmin && booking && booking.user_id !== this.currentUser.id) {
                    requestData.target_user_id = booking.user_id;
                    requestData.is_admin_cancel = true;
                }

                const response = await this.makeRequest('cancel_booking', requestData);

                if (response.success) {
                    if (isAdmin && booking && booking.user_id !== this.currentUser.id) {
                        this.showStatus(`Бронь пользователя ${booking.user_name} успешно отменена администратором`, 'success');
                    } else {
                        this.showStatus('Бронь успешно отменена', 'success');
                    }
                    document.getElementById('booking-form').style.display = 'none';
                    await this.loadBookings(); // Обновляем сетку
                } else {
                    this.showStatus('Ошибка: ' + response.error, 'error');
                }
            } catch (error) {
                this.showStatus('Ошибка соединения при отмене', 'error');
            }
        }

        async makeRequest(action, data = {}) {
            const formData = new FormData();
            formData.append('action', action);
            formData.append('data', JSON.stringify(data));

            const response = await fetch('booking_server.php', {
                method: 'POST',
                body: formData
            });

            if (!response.ok) {
                throw new Error('HTTP error: ' + response.status);
            }

            return await response.json();
        }

        startPolling() {
            setInterval(async () => {
                await this.loadBookings();
            }, this.pollInterval);
        }

        setupEventListeners() {
            document.getElementById('confirm-booking').addEventListener('click', () => {
                this.confirmBooking();
            });

            document.getElementById('cancel-booking').addEventListener('click', () => {
                this.cancelBooking();
            });

            document.getElementById('close-form').addEventListener('click', () => {
                document.getElementById('booking-form').style.display = 'none';
                if (this.expiryTimer) {
                    clearInterval(this.expiryTimer);
                    this.expiryTimer = null;
                }
            });
        }

        showStatus(message, type) {
            const statusEl = document.getElementById('booking-status');
            statusEl.textContent = message;
            statusEl.className = type + '-message';

            setTimeout(() => {
                statusEl.textContent = '';
                statusEl.className = '';
            }, 5000);
        }
    }

    // Инициализация при загрузке страницы
    document.addEventListener('DOMContentLoaded', () => {
        window.bookingSystem = new TableBookingSystem();
        window.bookingSystem.init();
    });
</script>
</body>
</html>
