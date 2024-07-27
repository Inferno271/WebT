<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_test.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_blog.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_admin.css') }}">
</head>
<body>
    <admin>
        <nav>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}">Главная</a></li>
                <li><a href="{{ route('admin.blog_editor') }}">Редактор блога</a></li>
                <li><a href="{{ route('admin.guestbook_upload') }}">Загрузка гостевой книги</a></li>
                <li><a href="{{ route('admin.upload_csv') }}">Загрузка CSV</a></li>
            </ul>
        </nav>
    </admin>

    <main>
        @yield('content')
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>