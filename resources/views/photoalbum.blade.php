<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Мой сайт - Фотоальбом</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css\styles.css') }}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js\script.js') }}"> </script>
</head>
<body>
  @include('partials.menu')

  <main>
    <section id="photoalbum">
      <h1>Фотоальбом</h1>

      <div class="gallery">
        @foreach(App\Models\Photo::PHOTOS as $photo)
          <img src="{{ asset($photo['src']) }}" alt="{{ $photo['alt'] }}">
        @endforeach
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; 2023 Мой сайт</p>
  </footer>
</body>
</html>
