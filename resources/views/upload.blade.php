<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Мой сайт</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style_test.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style_blog.css') }}">
  <script src="{{ asset('js\script.js') }}"></script>
</head>
<body>
  @include('partials.menu')
  <main>
    <h1>Загрузка сообщений гостевой книги</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <form action="{{ url('/upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="csv_file">Выберите .inc/.txt файл:</label>
        <input type="file" name="file" accept=".inc,.txt">
        <button type="submit">Загрузить</button>
    </form>
    </main>
 <footer>
    <p>&copy; 2023 Мой сайт</p>
  </footer>
</body>
</html>
