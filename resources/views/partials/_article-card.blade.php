<article class="card">
    <a class="card__media" href="/article/{{ $article->slug }}">
        <span class="cat-badge" style="background:{{ $article->category?->color ?? '#888' }}">
            {{ $article->category?->name ?? 'Uncategorized' }}
        </span>
        @if($article->video_url)
            <span class="play-badge" aria-hidden="true">&#9654;</span>
        @endif
        <img src="{{ featured_image_url($article->featured_image) }}" alt="{{ $article->title }}" loading="lazy">
    </a>
    <div class="card__body">
        <h3 class="card__title">
            <a href="/article/{{ $article->slug }}">{{ $article->title }}</a>
        </h3>
        <p class="card__excerpt">{{ $article->excerpt }}</p>
        <div class="card__meta">
            <span class="meta-author">
                <span class="avatar">{{ substr($article->author_name, 0, 1) }}</span>
                {{ $article->author_name }}
            </span>
            <span class="dot"></span>
            <span>{{ $article->published_at->format('M j, Y') }}</span>
        </div>
    </div>
</article>