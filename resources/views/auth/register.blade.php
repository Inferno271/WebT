<!DOCTYPE html>
<html>
<head>
    <title>Регистрация пользователя</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_admin.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_test.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_blog.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Регистрация</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('register') }}" method="POST">
        @csrf

        <div>
            <label for="name">ФИО</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        </div>

        <div>
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label for="username">Логин</label>
            <input type="text" name="username" id="username" value="{{ old('username') }}" required onblur="checkUsername()">
            <span id="username-status"></span>
        </div>

        <div>
            <label for="password">Пароль</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div>
            <label for="password_confirmation">Подтверждение пароля</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>

        <div>
            <button type="submit">Регистрация</button>
        </div>
    </form>
    <script>
function checkUsername() {
    var username = document.getElementById('username').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/check-username', true);
    xhr.setRequestHeader('Content-Type', 'text/plain');
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            var statusElement = document.getElementById('username-status');
            if (response === 'taken') {
                statusElement.textContent = 'Логин уже занят';
                statusElement.style.color = 'red';
            } else {
                statusElement.textContent = 'Логин доступен';
                statusElement.style.color = 'green';
            }
        }
    };
    xhr.send(username);
}
</script>
</body>
</html>
