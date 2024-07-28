@extends('layouts.admin')

@section('content')
<div class="statistics-container">
    <h1>Статистика посещений</h1>

    <div class="table-responsive">
        <table class="statistics-table">
            <thead>
                <tr>
                    <th>Дата и время</th>
                    <th>Страница</th>
                    <th>IP-адрес</th>
                    <th>Имя хоста</th>
                    <th>Браузер</th>
                </tr>
            </thead>
            <tbody>
                @foreach($visitors as $visitor)
                    <tr>
                        <td>{{ $visitor->visit_time}}</td>
                        <td><span class="page-url" title="{{ $visitor->web_page }}">{{ Str::limit($visitor->web_page, 30) }}</span></td>
                        <td>{{ $visitor->ip_address }}</td>
                        <td><span class="host-name" title="{{ $visitor->host_name }}">{{ Str::limit($visitor->host_name, 20) }}</span></td>
                        <td><span class="browser-info" title="{{ $visitor->browser_name }}">{{ Str::limit($visitor->browser_name, 50) }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        @if ($visitors->lastPage() > 1)
            <div class="pagination">
                <span>Страницы:</span>
                @if ($visitors->currentPage() > 3)
                    <a href="{{ $visitors->url(1) }}">1</a>
                    @if ($visitors->currentPage() > 2)
                        <span>...</span>
                    @endif
                @endif
                @for ($i = max(1, $visitors->currentPage() - 2); $i <= min($visitors->lastPage(), $visitors->currentPage() + 2); $i++)
                    @if ($i == $visitors->currentPage())
                        <span class="active">{{ $i }}</span>
                    @else
                        <a href="{{ $visitors->url($i) }}">{{ $i }}</a>
                    @endif
                @endfor
                @if ($visitors->currentPage() < $visitors->lastPage() - 2)
                    @if ($visitors->currentPage() < $visitors->lastPage() - 3)
                        <span>...</span>
                    @endif
                    <a href="{{ $visitors->url($visitors->lastPage()) }}">{{ $visitors->lastPage() }}</a>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection