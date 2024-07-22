@extends('layouts.admin')

@section('content')
<h1>Загрузка сообщений гостевой книги</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <form action="{{ url('/upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="csv_file">Выберите .inc/.txt файл:</label>
        <input type="file" name="file" accept=".inc,.txt">
        <button type="submit">Загрузить</button>
    </form>
@endsection