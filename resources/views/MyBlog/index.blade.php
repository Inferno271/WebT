<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Мой сайт - Блог</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_blog.css') }}">
    <script src="{{ asset('js/script.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <div class="comments">
                            <h4>Комментарии:</h4>
                            @foreach($post->comments as $comment)
                                @include('partials.comment', ['comment' => $comment])
                            @endforeach
                        </div>

                        @auth
                            <button class="add-comment-btn" data-post-id="{{ $post->id }}">Добавить комментарий</button>
                        @endauth
                    </article>
                @endforeach

                <div id="comment-modal" class="modal" style="display: none;">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h3>Добавить комментарий</h3>
                        <textarea id="comment-content"></textarea>
                        <button id="submit-comment">Отправить</button>
                    </div>
                </div>  




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


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('comment-modal');
            const commentContent = document.getElementById('comment-content');
            const closeBtn = document.querySelector('.close');
            let currentPostId;

            // Открытие модального окна
            document.querySelectorAll('.add-comment-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    currentPostId = this.dataset.postId;
                    modal.style.display = 'block';
                });
            });

            // Закрытие модального окна при клике на крестик
            closeBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            // Закрытие модального окна при клике вне его содержимого
            window.addEventListener('click', function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            });

            // Отправка комментария
            document.getElementById('submit-comment').addEventListener('click', function() {
                const content = commentContent.value;
                if (!content) return;

                const formData = new FormData();
                formData.append('content', content);
                formData.append('blog_post_id', currentPostId);

                fetch('/comments', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.text())
                .then(html => {
                    const commentsContainer = document.querySelector(`[data-post-id="${currentPostId}"]`).closest('.blog-post').querySelector('.comments');
                    commentsContainer.insertAdjacentHTML('beforeend', html);
                    modal.style.display = 'none';
                    commentContent.value = '';
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                    alert('Произошла ошибка при добавлении комментария. Пожалуйста, попробуйте еще раз.');
                });
            });
        });
</script>
</body>
</html>
