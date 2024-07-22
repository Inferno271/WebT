<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Гостевая книга</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_test.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
</head>
<body>
    @include('partials.menu')
    <h1>Гостевая книга</h1>

    <!-- Форма ввода -->
    <form action="{{ route('guestbook.store') }}" method="POST">
        @csrf
        <label for="name">Фамилия, Имя, Отчество:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="message">Текст отзыва:</label><br>
        <textarea id="message" name="message" rows="4" required></textarea><br><br>
        <input type="submit" value="Отправить">
    </form>

    <hr>

    <!-- Таблица сообщений -->
    <table>
        <thead>
            <tr>
                <th>Дата и время</th>
                <th>Фамилия, Имя, Отчество</th>
                <th>E-mail</th>
                <th>Текст отзыва</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
            <tr>
                <td>{{ $message->created_at }}</td>
                <td>{{ $message->name }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->message }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
