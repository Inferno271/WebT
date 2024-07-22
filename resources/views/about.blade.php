<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Мой сайт</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_about.css') }}">
</head>
<body>
    @include('partials.menu')

    <main>
        <div class="content">
            <div class="item">
                <img src="{{ asset('images/Layer 1.png') }}" alt="photo">
                <div class="item_text">
                    <p class="item_date">27 ФЕВРАЛЯ, 2002</p>
                    <h2 class="item_heading">Я РОДИЛСЯ В ГОРОДЕ ЛУГАНСК, ЛУГАНСКАЯ ОБЛАСТЬ.<br>ГДЕ ЖИЛ ВПЛОТЬ ДО 2014.</h2>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('images/Layer 2.png') }}" alt="photo">
                <div class="item_text">
                    <p class="item_date">1 СЕНТЯБРЯ, 2006</p>
                    <h2 class="item_heading">ПОШЕЛ В СРЕДНЮЮ ШКОЛУ №1 Г.ЛУГАНСК, ПОСЛЕ ПЕРЕВЕЛСЯ В ШКОЛУ №10 Г.ЯЛТА КОТОРУЮ ОКОНЧИЛ В 2019 ГОДУ.</h2>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('images/Layer 4.png') }}" alt="photo">
                <div class="item_text">
                    <p class="item_date">1 СЕНТЯБРЯ, 2019</p>
                    <h2 class="item_heading">ПОСТУПИЛ В СЕВАСТОПОЛЬСКИЙ ГОСУДАРСТВЕННЫЙ УНИВЕРСИТЕТ ПО НАПРАВЛЕНИЮ "ИНФОРМАЦИОННЫЕ СИСТЕМЫ И СЕТИ". В ДАННЫЙ МОМЕНТ ЯВЛЯЮСЬ СТУДЕНТОМ 3-ГО КУРСА ГРУППЫ ИС/Б-20-1-З.</h2>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2023 Мой сайт</p>
    </footer>
</body>
</html>
