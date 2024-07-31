<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Мой сайт</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css\style_test.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css\styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css\style_statistics.css') }}">

  <script src="{{ asset('js\script.js') }}"></script>
  <script src="{{ asset('js\modal.js') }}"></script>

</head>
<body>
  @include('partials.menu')
  <main>
<section ('content')>
        <h1>Результаты тестов</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Дата</th>
                    <th>ФИО</th>
                    <th>Группа</th>
                    <th>Ответы</th>
                    <th>Правильных ответов</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                    <tr>
                        <td>{{ $result->created_at }}</td>
                        <td>{{ $result->name }}</td>
                        <td>{{ $result->group }}</td>
                        <td>
                            @foreach($result->answers as $question => $answer)
                                {{ $question }}: {{ $answer }}<br>
                            @endforeach
                        </td>
                        <td>{{ $result->correct_answers }}/3</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    </main>

<div class="cover"></div>
  <footer>
    <p>&copy; 2023 Мой сайт</p>
  </footer>
</body>
</html>