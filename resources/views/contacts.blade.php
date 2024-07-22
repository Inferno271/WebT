<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Мой сайт - Контакты</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_test.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/cont_script.js') }}"></script>
</head>
<body>
    @include('partials.menu')

    <main>
        <section id="contacts">
            <h1>Контакты</h1>
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form id="contact-form" method="POST" action="{{ route('contacts.submit') }}">
                @csrf
                <div>
                    <label for="name">ФИО:</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required class="@error('name') error @enderror">
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label>Пол:</label>
                    <input type="radio" id="male" name="gender" value="Мужской" {{ old('gender') == 'Мужской' ? 'checked' : '' }} required>
                    <label for="male">Мужской</label>
                    <input type="radio" id="female" name="gender" value="Женский" {{ old('gender') == 'Женский' ? 'checked' : '' }} required>
                    <label for="female">Женский</label>
                    @error('gender')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required class="@error('email') error @enderror">
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="phone">Телефон:</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required class="@error('email') error @enderror">
                    @error('phone')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="comment">Комментарий:</label>
                    <textarea id="comment" name="comment" required class="@error('comment') error @enderror">{{ old('comment') }}</textarea>
                    @error('comment')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit">Отправить</button>
            </form>
        </section>
    </main>

    <footer>
        <!-- Код для подвала сайта -->
        <p>&copy; 2023 Мой сайт</p>
    </footer>
</body>
</html>
