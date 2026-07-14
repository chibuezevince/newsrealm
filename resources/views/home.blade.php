<x-layouts.app title="Home">

    {{-- Trending --}}
    <div class="section-head">
        <h2>Trending</h2>
    </div>
    <section class="lead-grid">
        @if($trendingLeadArticle)
            <article class="card lead">
                <a class="card__media" href="/article/{{ $trendingLeadArticle->slug }}">
                    <span class="cat-badge" style="background:{{ $trendingLeadArticle->category->color }}">
                        {{ $trendingLeadArticle->category->name }}
                    </span>
                    <img src="{{ featured_image_url($trendingLeadArticle->featured_image) }}"
                        alt="{{ $trendingLeadArticle->title }}" loading="lazy">
                </a>
                <div class="card__body">
                    <h3 class="card__title">
                        <a href="/article/{{ $trendingLeadArticle->slug }}">{{ $trendingLeadArticle->title }}</a>
                    </h3>
                    <p class="card__excerpt">{{ $trendingLeadArticle->excerpt }}</p>
                    <div class="card__meta">
                        <span class="meta-author">
                            <span class="avatar">{{ substr($trendingLeadArticle->author_name, 0, 1) }}</span>
                            {{ $trendingLeadArticle->author_name }}
                        </span>
                        <span class="dot"></span>
                        <span>{{ $trendingLeadArticle->published_at->format('M j, Y') }}</span>
                    </div>
                </div>
            </article>
        @endif

        <div class="lead-side">
            @foreach($trendingSidebarArticles as $sidebarArticle)
                <article class="card mini">
                    <a class="card__media" href="/article/{{ $sidebarArticle->slug }}">
                        <span class="cat-badge" style="background:{{ $sidebarArticle->category->color }}">
                            {{ $sidebarArticle->category->name }}
                        </span>
                        @if($sidebarArticle->video_url)
                            <span class="play-badge" aria-hidden="true">&#9654;</span>
                        @endif
                        <img src="{{ featured_image_url($sidebarArticle->featured_image) }}"
                            alt="{{ $sidebarArticle->title }}" loading="lazy">
                    </a>
                    <div class="card__body">
                        <h3 class="card__title">
                            <a href="/article/{{ $sidebarArticle->slug }}">{{ $sidebarArticle->title }}</a>
                        </h3>
                        <div class="card__meta">
                            <span class="meta-author">
                                <span class="avatar">{{ substr($sidebarArticle->author_name, 0, 1) }}</span>
                                {{ $sidebarArticle->author_name }}
                            </span>
                            <span class="dot"></span>
                            <span>{{ $sidebarArticle->published_at->format('M j, Y') }}</span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{-- Latest News --}}
    <div class="section-head">
        <h2>Latest News</h2>
        <a href="/search">View all</a>
    </div>
    <section class="article-grid">
        @foreach($latestNewsArticles as $latestArticle)
            <article class="card">
                <a class="card__media" href="/article/{{ $latestArticle->slug }}">
                    <span class="cat-badge" style="background:{{ $latestArticle->category->color }}">
                        {{ $latestArticle->category->name }}
                    </span>
                    @if($latestArticle->video_url)
                        <span class="play-badge" aria-hidden="true">&#9654;</span>
                    @endif
                    <img src="{{ featured_image_url($latestArticle->featured_image) }}" alt="{{ $latestArticle->title }}"
                        loading="lazy">
                </a>
                <div class="card__body">
                    <h3 class="card__title">
                        <a href="/article/{{ $latestArticle->slug }}">{{ $latestArticle->title }}</a>
                    </h3>
                    <p class="card__excerpt">{{ $latestArticle->excerpt }}</p>
                    <div class="card__meta">
                        <span class="meta-author">
                            <span class="avatar">{{ substr($latestArticle->author_name, 0, 1) }}</span>
                            {{ $latestArticle->author_name }}
                        </span>
                        <span class="dot"></span>
                        <span>{{ $latestArticle->published_at->format('M j, Y') }}</span>
                    </div>
                </div>
            </article>
        @endforeach
    </section>

    {{-- Editor's Pick --}}
    <div class="section-head">
        <h2>Editor's Pick</h2>
    </div>
    <section class="pick-grid">
        @foreach($editorPickCategories as $editorPickCategory)
            <div class="pick-col">
                <h3>{{ $editorPickCategory->name }}</h3>
                @foreach($editorPickCategory->articles as $pickArticle)
                    <div class="pick-item">
                        <a class="pick-item__media" href="/article/{{ $pickArticle->slug }}">
                            <img src="{{ featured_image_url($pickArticle->featured_image) }}" alt="{{ $pickArticle->title }}"
                                loading="lazy">
                        </a>
                        <div>
                            <h4 class="pick-item__title">
                                <a href="/article/{{ $pickArticle->slug }}">{{ $pickArticle->title }}</a>
                            </h4>
                            <div class="pick-item__meta">{{ $pickArticle->published_at->format('M j, Y') }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </section>
</x-layouts.app>