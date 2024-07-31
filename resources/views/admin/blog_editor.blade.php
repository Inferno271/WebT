@extends('layouts.admin')
<main>
        <section class="content">
            <h1>Редактор Блога</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Кнопка для перехода к загрузке CSV -->
            <a href="{{ route('admin.upload_csv') }}" class="btn">Загрузить записи из CSV</a>

            <!-- Форма добавления записи блога -->
            <form action="{{ route('admin.blog_editor.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="title">Тема сообщения:</label>
                    <input type="text" id="title" name="title" required value="{{ old('title') }}">
                </div>
                <div>
                    <label for="author">Автор</label>
                    <input type="text" name="author" id="author" required>
                </div>
                <div>
                    <label for="image">Изображение:</label>
                    <input type="file" id="image" name="image">
                </div>
                <div>
                    <label for="content">Текст сообщения:</label>
                    <textarea id="content" name="content" required>{{ old('content') }}</textarea>
                </div>
                <button type="submit">Добавить запись</button>
            </form>

            <h2>Записи блога</h2>
            @if($posts->count() > 0)
            @foreach($posts as $post)
    <article class="blog-post" id="post-{{ $post->id }}">
        <h3>{{ $post->title }}</h3>
        <p class="post-author">Автор: {{ $post->author }}</p>
        <p class="post-date">{{ $post->created_at->format('d.m.Y H:i') }}</p>
        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="Изображение к посту" class="post-image">
        @endif
        <div class="post-content">
            {{ $post->content }}
        </div>
        <button class="btn btn-edit" onclick="showEditForm({{ $post->id }})">Изменить</button>
        <form action="{{ route('admin.blog_editor.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить эту запись?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Удалить</button>
        </form>
        
        <!-- Форма редактирования (скрыта по умолчанию) -->
        <div id="edit-form-{{ $post->id }}" class="edit-form" style="display: none;">
            <form target="hidden-iframe" onsubmit="updatePost(event, {{ $post->id }})">
                @csrf
                <input type="hidden" name="id" value="{{ $post->id }}">
                <div>
                    <label for="edit-title-{{ $post->id }}">Тема сообщения:</label>
                    <input type="text" id="edit-title-{{ $post->id }}" name="title" required value="{{ $post->title }}">
                </div>
                <div>
                    <label for="edit-content-{{ $post->id }}">Текст сообщения:</label>
                    <textarea id="edit-content-{{ $post->id }}" name="content" required>{{ $post->content }}</textarea>
                </div>
                <button type="submit">Сохранить изменения</button>
            </form>
        </div>
    </article>
@endforeach

<!-- Скрытый iframe для отправки формы -->
<iframe name="hidden-iframe" style="display:none;"></iframe>

                @if ($posts->lastPage() > 1)
                    <div class="pagination">
                        <span>Страницы:</span>
                        @if ($posts->currentPage() > 3)
                            <a href="{{ $posts->url(1) }}">1</a>
                            @if ($posts->currentPage() > 4)
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

        <script>
function showEditForm(postId) {
    document.getElementById(`edit-form-${postId}`).style.display = 'block';
}

function updatePost(event, postId) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);

    fetch(`{{ route('admin.blog_editor.update', '') }}/${postId}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const post = document.getElementById(`post-${postId}`);
            post.querySelector('h3').textContent = data.post.title;
            post.querySelector('.post-content').textContent = data.post.content;
            document.getElementById(`edit-form-${postId}`).style.display = 'none';
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
    </main>