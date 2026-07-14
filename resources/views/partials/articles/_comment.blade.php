<div class="comment">
    <span class="avatar">{{ substr($comment->author_name, 0, 1) }}</span>
    <div>
        <div class="comment__name">
            {{ $comment->author_name }}
            <span class="comment__date">{{ $comment->created_at->format('F j, Y') }}</span>
        </div>
        <p class="comment__body">{{ $comment->body }}</p>
    </div>
</div>