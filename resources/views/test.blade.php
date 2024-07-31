<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Мой сайт</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css\style_test.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css\styles.css') }}">
  <script src="{{ asset('js\script.js') }}"></script>
  <script src="{{ asset('js\modal.js') }}"></script>

</head>
<body>
  @include('partials.menu')

  <main>
<!-- Внутри тега <main> в файле index.html -->
   <div class="content">
        <div class="item_header item_header_univers">
            <h2>Институт информационных технологий и управления в технических системах</h2>
        </div>
        <div class="item_header item_header_kaf">
            <h2>Кафедра: Информационные системы</h2>
        </div>
        <div class="main_table">
            <table border="1">
                <caption>Перечень изучаемых дисциплин с 1 по 4 семестр</caption>
                <!-- Голова таблицы -->
                <thead>
                    <tr>
                        <td colspan="9"><b>План учебного процесса</b></td>
                    </tr>
                </thead>

                <!-- Тело таблицы -->
                <tbody>
                    <tr>
                        <td rowspan="2"><b>№</b></td>
                        <td rowspan="2"><b>Дисциплина</b></td>
                        <td rowspan="2"><b>Кафедра</b></td>
                        <td colspan="6"><b>Всего часов</b></td>
                    </tr>
                    <tr>
                        <td><b>Всего</b></td>
                        <td><b>Ауд</b></td>
                        <td><b>Лк</b></td>
                        <td><b>Лб</b></td>
                        <td><b>Пр</b></td>
                        <td><b>СРС</b></td>
                    </tr> 
                    <tr>
                        <td>1</td>
                        <td class="main_table_item">Экология</td>
                        <td>БЖ</td>
                        <td>54</td>
                        <td>27</td>
                        <td>18</td>
                        <td>0</td>
                        <td>9</td>
                        <td>27</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td class="main_table_item">Высшая математика</td>
                        <td>ВМ</td>
                        <td>540</td>
                        <td>282</td>
                        <td>141</td>
                        <td>0</td>
                        <td>141</td>
                        <td>258</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td class="main_table_item">Русский язык и культура речи</td>
                        <td>НГиГ</td>
                        <td>108</td>
                        <td>54</td>
                        <td>18</td>
                        <td>0</td>
                        <td>36</td>
                        <td>54</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td class="main_table_item">Основы дискретной математики</td>
                        <td>ИС</td>
                        <td>216</td>
                        <td>139</td>
                        <td>87</td>
                        <td>0</td>
                        <td>52</td>
                        <td>77</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td class="main_table_item">Основы программирования и алгоритмические языки</td>
                        <td>ИС</td>
                        <td>405</td>
                        <td>210</td>
                        <td>105</td>
                        <td>87</td>
                        <td>18</td>
                        <td>195</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td class="main_table_item">Основы экологии</td>
                        <td>ПЭОП</td>
                        <td>54</td>
                        <td>27</td>
                        <td>18</td>
                        <td>0</td>
                        <td>9</td>
                        <td>27</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td class="main_table_item">Теория вероятностей и математическая статистика</td>
                        <td>ИС</td>
                        <td>162</td>
                        <td>72</td>
                        <td>54</td>
                        <td>18</td>
                        <td>0</td>
                        <td>90</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td class="main_table_item">Физика</td>
                        <td>Физики</td>
                        <td>324</td>
                        <td>194</td>
                        <td>106</td>
                        <td>88</td>
                        <td>0</td>
                        <td>130</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td class="main_table_item">Основы электротехники и электроники</td>
                        <td>ИС</td>
                        <td>108</td>
                        <td>72</td>
                        <td>36</td>
                        <td>18</td>
                        <td>18</td>
                        <td>36</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td class="main_table_item">Численные методы в информатике</td>
                        <td>ИС</td>
                        <td>189</td>
                        <td>89</td>
                        <td>36</td>
                        <td>36</td>
                        <td>17</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td class="main_table_item">Методы исследования операций</td>
                        <td>ИС</td>
                        <td>216</td>
                        <td>104</td>
                        <td>52</td>
                        <td>35</td>
                        <td>17</td>
                        <td>112</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="9">
                            Общий вид перечня дисциплин согласно варианту №1
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
<section class="content container">
    <form action="{{ route('test.submit') }}" method="POST">
        @csrf
        <div class="item_header item_header_main">
                <h2>Тестирование по программированию на C#</h2>
            </div>
            <div class="content_contact">

                <div>
                  <label for="name">ФИО:</label>
                  <input type="text" id="name" name="name" required>
                </div>

                <p class="contact"><label for="group">Группа</label></p>
                <p><select name="group">
                    <option  hidden>Выберите группу</option> 
                    <optgroup label="Первый курс">
                        <option>ИС/б-22-1-о</option>
                        <option>ИС/б-22-2-о</option>
                        <option>ПИ/б-22-1-о</option>
                    </optgroup>
                    <optgroup label="Второй курс">
                        <option>ИС/б-21-1-о</option>
                        <option>ИС/б-21-2-о</option>
                        <option>ПИ/б-21-1-о</option>
                    </optgroup>
                    <optgroup label="Третий курс">
                        <option>ИС/б-20-1-о</option>
                        <option>ИС/б-20-2-о</option>
                        <option>ПИ/б-20-1-о</option>
                    </optgroup>
                    <optgroup label="Четвертый курс">
                        <option>ИС/б-19-1-о</option>
                        <option>ИС/б-19-2-о</option>
                        <option>ПИ/б-19-1-о</option>
                    </optgroup>
                </select></p>
                <div class="item_header">
                    <h2>Тестирование</h2>
                </div>
                <div class="question">
                    <p>Вопрос №1. Какой тип переменной используется в коде: int a = 5;</p>
                    <input type="radio" id="quest1_a" name="quest1" value="8">
                    <label for="quest1_a">Знаковое 8-бит целое</label><br>
                    <input type="radio" id="quest1_b" name="quest1" value="32">
                    <label for="quest1_b">Знаковое 32-бит целое</label><br>
                    <input type="radio" id="quest1_c" name="quest1" value="64">
                    <label for="quest1_c">Знаковое 64-бит целое</label><br>
                </div>

                <div class="question">
                    <p>Вопрос №2. Обозначения оператора «НЕ»</p>
                    <select name="quest2" id="quest2" required>
                        <option value="" hidden>Выберите ответ</option>
                        <option value="8">Not</option>
                        <option value="32">No</option>
                        <option value="64">!</option>
                        <option value="128">!=</option>
                    </select>
                </div>

                <div class="question">
                    <p>Вопрос №3. Чему будет равен c, если int a = 10; int b = 4; bool c = (a == 10 && b == 4);</p>
                    <input type="text" id="quest3" name="quest3" required>
                </div>


                <div class="in_btn">
                    <input type="reset" value="Очистить">
                    <input type="submit" value="Отправить">
                </div>
            </div>
    </form>
   @if(isset($result))
    <p>Результат: {{ $result }}/3</p>
    @endif

    @auth
    <div class="view-results-button">
        <a href="{{ route('test.results') }}" class="btn btn-primary">Просмотреть все результаты</a>
    </div>
    @else
        <p>Для просмотра результатов необходимо авторизоваться.</p>
    @endauth
</section>
  </main>

<div class="cover"></div>






  <footer>
    <p>&copy; 2023 Мой сайт</p>
  </footer>
</body>
</html>
