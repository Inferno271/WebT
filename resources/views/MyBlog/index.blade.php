<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Мой сайт - Блог</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_test.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_blog.css') }}">
    <script src="{{ asset('js/script.js') }}"></script>

</head>
<body>
    @include('partials.menu')
    
    <main>
        <section class="content">
            <h1>Мой Блог</h1>

            @if($posts->count() > 0)
                @foreach($posts as $post)
                    <article class="blog-post">
                        <h3>{{ $post->title }}</h3>
                        <p class="post-author">Автор: {{ $post->author }}</p>
                        <p class="post-date">{{ $post->created_at->format('d.m.Y H:i') }}</p>
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Изображение к посту" class="post-image">
                        @endif
                        <div class="post-content">
                            {{ $post->content }}
                        </div>
                    </article>
                @endforeach

                @if ($posts->lastPage() > 1)
                    <div class="pagination">
                        <span>Страницы:</span>
                        @if ($posts->currentPage() > 3)
                            <a href="{{ $posts->url(1) }}">1</a>
                            @if ($posts->currentPage() > 2)
                                <span>...</span>
                            @endif
                        @endif
                        @for ($i = max(1, $posts->currentPage() - 2); $i <= min($posts->lastPage(), $posts->currentPage() + 2); $i++)
                            @if ($i == $posts->currentPage())
                                <span class="active">{{ $i }}</span>
                            @else
                                <a href="{{ $posts->url($i) }}">{{ $i }}</a>
                            @endif
                        @endfor
                        @if ($posts->currentPage() < $posts->lastPage() - 2)
                            @if ($posts->currentPage() < $posts->lastPage() - 3)
                                <span>...</span>
                            @endif
                            <a href="{{ $posts->url($posts->lastPage()) }}">{{ $posts->lastPage() }}</a>
                        @endif
                    </div>
                @endif
            @else
                <p>Пока нет записей в блоге.</p>
            @endif
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Мой сайт</p>
    </footer>
</body>
</html>
