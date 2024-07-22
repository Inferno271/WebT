@extends('layouts.admin')

@section('content')
<main>
        <section class="content">
            <h1>Загрузка сообщений блога</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.upload_csv') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="csv_file">Выберите CSV файл:</label>
                    <input type="file" id="csv_file" name="csv_file" required>
                </div>
                <button type="submit">Загрузить</button>
            </form>
        </section>
    </main>
@endsection