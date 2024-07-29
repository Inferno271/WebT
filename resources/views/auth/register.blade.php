<!DOCTYPE html>
<html>
<head>
    <title>Регистрация пользователя</title>
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
            <input type="text" name="username" id="username" value="{{ old('username') }}" required>
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
</body>
</html>
