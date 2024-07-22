
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Мой сайт</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css\style_test.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css\styles.css') }}">
  <script src="{{ asset('js\script.js') }}"></script>
</head>
<body>
  @include('partials.menu')
  <main>
<section ('content')>
<div class="container">
    <h2>Гостевая книга</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('guestbook.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="surname">Фамилия:</label>
            <input type="text" class="form-control" id="surname" name="surname" required>
        </div>
        <div class="form-group">
            <label for="name">Имя:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="patronymic">Отчество:</label>
            <input type="text" class="form-control" id="patronymic" name="patronymic" required>
        </div>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="message">Текст отзыва:</label>
            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>

    <h3 class="mt-4">Сообщения:</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Дата</th>
                <th>ФИО</th>
                <th>E-mail</th>
                <th>Сообщение</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td>{{ $message['date'] }}</td>
                    <td>{{ $message['fullName'] }}</td>
                    <td>{{ $message['email'] }}</td>
                    <td>{{ $message['message'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</section>
  </main>

  <footer>
    <p>&copy; 2023 Мой сайт</p>
  </footer>
</body>
</html>
