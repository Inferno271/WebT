<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Мой сайт</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css\styles.css') }}">
  <script src="{{ asset('js\script.js') }}"></script>
</head>
<body>
  @include('partials.menu')
  <main>
<!-- Внутри тега <main> в файле index.html -->
    <section id="home">
      <h1>Добро пожаловать на мой сайт!</h1>
      <p>Баранник Никита Дмитриевич</p>

    </section>
  </main>

  <footer>
    <p>&copy; 2023 Мой сайт</p>
  </footer>
</body>
</html>
