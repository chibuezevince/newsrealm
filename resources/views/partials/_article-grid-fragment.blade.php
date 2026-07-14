@foreach($articles as $article)
    @include('partials._article-card', ['article' => $article])
@endforeach

@if($articles->hasMorePages())
    <div class="scroll-sentinel" hx-get="{{ $loadMoreUrl }}" hx-trigger="revealed" hx-swap="outerHTML"
        hx-indicator="#scroll-loader">
    </div>
@endif