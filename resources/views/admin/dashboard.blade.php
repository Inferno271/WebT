@extends('layouts.admin')

@section('content')
    <h1>Панель администратора</h1>
    <ul>
        <li><a href="{{ route('admin.blog_editor') }}">Редактор блога</a></li>
        <li><a href="{{ route('admin.guestbook_upload') }}">Загрузка сообщений гостевой книги</a></li>
    </ul>
@endsection