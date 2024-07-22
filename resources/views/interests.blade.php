<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Мои интересы</title>
  <link rel="stylesheet" href="{{ asset('css\style_interests.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css\styles.css') }}">
  <script src="{{ asset('js\int_script.js') }}"></script>
</head>
<body>
  @include('partials.menu')


<div class="anchor">
        <p>НАВИГАЦИЯ</p><hr>
        <a href="#top">Наверх</a><br>
        <a href="#music">Музыка</a><br>
        <a href="#hobby">Хобби</a><br>
        <a href="#games">Игры</a><br>
        <a href="#movies">Фильмы</a><br>
    </div>


  <main>
  <div class="content">
    @foreach(App\Models\Interest::INTERESTS as $key => $interest)
      <div class="item_header" id="{{ $key }}"><h2>{{ $interest['title'] }}</h2></div>
      @foreach($interest['items'] as $item)
        <div class="item">
          @if(isset($item['image']))
            <div class="item_photo"><img src="{{ asset($item['image']) }}" alt="photo"></div>
          @endif
          <div class="item_text">
            <p class="item_date">{{ $item['name'] }}</p>
            <h2 class="item_heading">{{ $item['description'] }}</h2>
            @if(isset($item['audio']))
              <audio src="{{ asset($item['audio']) }}" controls></audio>
            @endif
          </div>
        </div>
      @endforeach
    @endforeach
  </div>
</main>


<script> 
document.addEventListener("DOMContentLoaded", function() {
  var sections = document.querySelectorAll("main > div.item_header");
  var navigationLinks = document.querySelectorAll(".vertical-menu a");

  window.addEventListener("scroll", function() {
    var currentSection = "";

    sections.forEach(function(section) {
      var sectionTop = section.offsetTop;
      var sectionHeight = section.offsetHeight;

      if (pageYOffset >= sectionTop - sectionHeight / 2) {
        currentSection = section.getAttribute("id");
      }
    });

    navigationLinks.forEach(function(link) {
      link.classList.remove("active");
      if (link.getAttribute("href").slice(1) === currentSection) {
        link.classList.add("active");
      }
    });
  });
});


</script>

  <footer>
    <p>&copy; 2023 Мой сайт</p>
  </footer>
</body>
</html>
