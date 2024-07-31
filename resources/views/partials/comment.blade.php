<div class="comment">
    <p class="comment-author">{{ $comment->user->name }}</p>
    <p class="comment-date">{{ $comment->created_at->format('d.m.Y H:i') }}</p>
    <p class="comment-content">{{ $comment->content }}</p>
</div>