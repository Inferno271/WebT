<header>
  <div class="header-container">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style_menu.css') }}">
    <a href="{{ url('/') }}" class="logo"> 
      <img src="{{ asset('images/logo.png') }}" alt="Логотип"> 
    </a>
    <nav class="main-nav">
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
    <div class="auth-buttons">
      @guest
        <a href="{{ route('user.login') }}" class="btn btn-login">Войти</a>
        <a href="{{ route('register') }}" class="btn btn-register">Регистрация</a>
      @else
        <span class="user-name">{{ Auth::user()->name }}</span>
        <form action="{{ route('user.logout') }}" method="POST" class="logout-form">
          @csrf
          <button type="submit" class="btn btn-logout">Выйти</button>
        </form>
      @endguest
    </div>
  </div>
</header>