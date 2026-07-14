<x-layouts.app title="{{ $query ? 'Search: ' . $query : 'Search' }}">

    <div class="section-head">
        <h2>Results for &ldquo;{{ $query }}&rdquo;</h2>
        <span>{{ $searchResults->total() }} found</span>
    </div>

    @if($searchResults->isEmpty())
        <div class="empty">
            <h2>No results found</h2>
            <p>Try adjusting your search terms.</p>
        </div>
    @else
        <section class="article-grid" id="article-grid">
            @foreach($searchResults as $article)
                @include('partials._article-card', ['article' => $article])
            @endforeach

            @if($searchResults->hasMorePages())
                <div class="scroll-sentinel"
                    hx-get="{{ route('search.load-more') . '?page=2&q=' . urlencode(request('q', '')) }}" hx-trigger="revealed"
                    hx-swap="outerHTML" hx-indicator="#scroll-loader">
                </div>
            @endif
        </section>

        <div id="scroll-loader" class="scroll-loader htmx-indicator">
            <span class="spinner"></span> Loading more results...
        </div>
    @endif
</x-layouts.app>