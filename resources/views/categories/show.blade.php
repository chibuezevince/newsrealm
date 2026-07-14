<x-layouts.app :title="$category->name">

    <div class="section-head">
        <h2>{{ $category->name }}</h2>
        @if($category->description)
            <p>{{ $category->description }}</p>
        @endif
    </div>

    @if($articles->isEmpty())
        <div class="empty">
            <h2>No articles yet</h2>
            <p>Check back soon for articles in this category.</p>
        </div>
    @else
        <section class="article-grid" id="article-grid">
            @foreach($articles as $article)
                @include('partials._article-card', ['article' => $article])
            @endforeach

            @if($articles->hasMorePages())
                <div class="scroll-sentinel"
                    hx-get="{{ route('categories.load-more', ['category' => $category->slug]) . '?page=2' }}"
                    hx-trigger="revealed" hx-swap="outerHTML" hx-indicator="#scroll-loader">
                </div>
            @endif
        </section>

        <div id="scroll-loader" class="scroll-loader htmx-indicator">
            <span class="spinner"></span> Loading more articles...
        </div>
    @endif
</x-layouts.app>