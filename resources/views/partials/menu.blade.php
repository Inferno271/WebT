<header>
  <a href="{{ url('/') }}" class="logo"> 
    <img src="{{ asset('images/logo.png') }}" alt="Логотип"> 
  </a>
  <nav>
    <ul>
      <li><a href="{{ url('/') }}">Главная</a></li>
      <li><a href="{{ url('/interests') }}">Мои интересы</a></li>
      <li><a href="{{ url('/photoalbum') }}">Фотоальбом</a></li>
      <li><a href="{{ url('/contacts') }}">Контакты</a></li>
      <li><a href="{{ url('/about') }}">Обо мне</a></li>
      <li><a href="{{ url('/test') }}">Тест</a></li>
      <li><a href="{{ url('/guestbook') }}">Гостевая книга</a></li>
      <li><a href="{{ url('/myblog') }}">Мой Блог</a></li>
    </ul>
  </nav>
</header>
