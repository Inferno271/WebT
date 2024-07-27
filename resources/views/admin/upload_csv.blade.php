@extends('layouts.admin')

@section('content')
    <h1>Загрузка записей блога из CSV</h1>

    <form action="{{ route('admin.upload_csv.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="csv_file">Выберите CSV файл:</label>
            <input type="file" id="csv_file" name="csv_file" accept=".csv,.txt" required>
        </div>
        <button type="submit">Загрузить</button>
    </form>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection