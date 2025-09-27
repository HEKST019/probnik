import eventlet

eventlet.monkey_patch()
from flask import Flask, request
from flask_socketio import SocketIO, emit
from datetime import datetime, timedelta
from threading import Timer

app = Flask(__name__)
app.config['SECRET_KEY'] = 'your_secret_key_here'
socketio = SocketIO(app, cors_allowed_origins="*", async_mode='eventlet')

# Конфигурация бронирования
TIME_SLOTS = [f"{h}:00-{h + 1}:00" for h in range(10, 18)]
TABLES = [f"Столик {i}" for i in range(1, 11)]
BOOKING_EXPIRE_MINUTES = 5

bookings = {}
expiration_timers = {}


def init_bookings():
    today = datetime.now().strftime('%Y-%m-%d')
    bookings[today] = {slot: {table: None for table in TABLES} for slot in TIME_SLOTS}


def schedule_booking_expiration(date, slot, table, user_id):
    timer_key = f"{date}_{slot}_{table}_{user_id}"

    if timer_key in expiration_timers:
        expiration_timers[timer_key].cancel()

    def cancel_booking():
        if date in bookings and slot in bookings[date] and table in bookings[date][slot]:
            bookings[date][slot][table] = None
            socketio.emit('slots_update', bookings)
            socketio.emit('booking_expired', {
                'slot': slot,
                'table': table
            }, room=request.sid)
            del expiration_timers[timer_key]

    expiration_timers[timer_key] = Timer(BOOKING_EXPIRE_MINUTES * 60, cancel_booking)
    expiration_timers[timer_key].start()


init_bookings()


@socketio.on('connect')
def handle_connect():
    emit('slots_update', bookings)
    emit('init_data', {
        'tables': TABLES,
        'time_slots': TIME_SLOTS,
        'booking_limit': BOOKING_EXPIRE_MINUTES
    })


@socketio.on('book_table')
def handle_booking(data):
    try:
        date = datetime.now().strftime('%Y-%m-%d')
        slot = data['slot']
        table = data['table']
        user_id = data['user_id']
        user_name = data['user_name']

        if bookings[date][slot][table] is not None:
            emit('booking_error', {'message': 'Этот столик уже забронирован'})
            return

        bookings[date][slot][table] = {
            'user_id': user_id,
            'user_name': user_name,
            'booked_at': datetime.now().isoformat(),
            'expires_at': (datetime.now() + timedelta(minutes=BOOKING_EXPIRE_MINUTES)).isoformat()
        }

        schedule_booking_expiration(date, slot, table, user_id)

        emit('booking_success', {
            'slot': slot,
            'table': table,
            'user_name': user_name,
            'expires_at': bookings[date][slot][table]['expires_at']
        })

        # Вместо broadcast используем emit без room
        socketio.emit('slots_update', bookings)

    except Exception as e:
        emit('booking_error', {'message': f'Ошибка: {str(e)}'})


@socketio.on('cancel_booking')
def handle_cancel(data):
    try:
        date = datetime.now().strftime('%Y-%m-%d')
        slot = data['slot']
        table = data['table']
        user_id = data['user_id']

        if (bookings[date][slot][table] is None or
                bookings[date][slot][table]['user_id'] != user_id):
            emit('cancel_error', {'message': 'Нельзя отменить чужую бронь'})
            return

        bookings[date][slot][table] = None

        timer_key = f"{date}_{slot}_{table}_{user_id}"
        if timer_key in expiration_timers:
            expiration_timers[timer_key].cancel()
            del expiration_timers[timer_key]

        emit('cancel_success', {
            'slot': slot,
            'table': table
        })

        socketio.emit('slots_update', bookings)

    except Exception as e:
        emit('cancel_error', {'message': f'Ошибка: {str(e)}'})


if __name__ == '__main__':
    print("🚀 Система бронирования столиков запущена на http://localhost:5000")
    socketio.run(app, host='0.0.0.0', port=5000, debug=True)