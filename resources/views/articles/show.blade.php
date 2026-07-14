<x-layouts.app :title="$article->title">

    <div class="article-layout">
        <div class="article-main">
            <nav class="breadcrumb">
                <a href="/">Home</a>
                <span>/</span>
                <a href="/category/{{ $article->category->slug }}">{{ $article->category->name }}</a>
            </nav>

            <span class="cat-badge"
                style="background:{{ $article->category->color }}">{{ $article->category->name }}</span>

            <h1 class="article__title">{{ $article->title }}</h1>

            <div class="article__meta">
                <span>by {{ $article->author_name }}</span>
                <span class="dot"></span>
                <span>{{ $article->published_at->format('F j, Y') }}</span>
            </div>

            @if($article->featured_image)
                <div class="article__hero">
                    <img src="{{ featured_image_url($article->featured_image) }}" alt="{{ $article->title }}">
                </div>
            @endif

            @if($article->video_url)
                <div class="video-embed">
                    @if(str_contains($article->video_url, 'youtube.com') || str_contains($article->video_url, 'youtu.be'))
                        <iframe src="{{ str_replace('watch?v=', 'embed/', $article->video_url) }}" frameborder="0"
                            allowfullscreen></iframe>
                    @elseif(str_contains($article->video_url, 'vimeo.com'))
                        <iframe src="https://player.vimeo.com/video/{{ basename($article->video_url) }}" frameborder="0"
                            allowfullscreen></iframe>
                    @else
                        <video controls
                            poster="{{ $article->featured_image ? featured_image_url($article->featured_image) : '' }}">
                            <source src="{{ asset($article->video_url) }}" type="video/mp4">
                        </video>
                    @endif
                </div>
            @endif

            <div class="article__body">
                {!! $article->body !!}
            </div>

            <div class="share">
                <span class="share__label">Share</span>
                <div class="share__btns">
                    <a class="share__btn share--fb"
                        href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                        target="_blank" rel="noopener">
                        <i data-feather="facebook" width="16" height="16"></i>
                        Facebook
                    </a>
                    <a class="share__btn share--tw"
                        href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(url()->current()) }}"
                        target="_blank" rel="noopener">
                        <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16">
                            <path
                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                        </svg>
                        Twitter
                    </a>
                    <a class="share__btn share--wa"
                        href="https://wa.me/?text={{ urlencode($article->title . ' ' . url()->current()) }}"
                        target="_blank" rel="noopener">
                        <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        WhatsApp
                    </a>
                    <button class="share__btn share--copy"
                        onclick="navigator.clipboard.writeText('{{ url()->current() }}'); this.innerHTML='<i data-feather=\'check\' width=\'16\' height=\'16\'></i> Copied!'; feather.replace(); setTimeout(function(){ this.innerHTML='<i data-feather=\'link\' width=\'16\' height=\'16\'></i> Copy Link'; feather.replace(); }.bind(this), 2000)">
                        <i data-feather="link" width="16" height="16"></i>
                        Copy Link
                    </button>
                </div>
            </div>

            <div class="author-box">
                <span class="avatar avatar--lg">{{ substr($article->author_name, 0, 1) }}</span>
                <div>
                    <div class="author-box__by">Written by</div>
                    <div class="author-box__name">{{ $article->author_name }}</div>
                </div>
            </div>

            {{-- Comments --}}
            <div id="comments-section" class="comments">
                <h3>Comments</h3>

                @forelse($comments as $comment)
                    @include('partials.articles._comment', ['comment' => $comment])
                @empty
                    <p class="empty">No comments yet. Be the first to share your thoughts!</p>
                @endforelse
            </div>

            {{-- Comment Form --}}
            <div class="comment-form" id="comment-section">
                <h3>Leave a comment</h3>
                <p>Comments are reviewed before they appear.</p>

                @if(session('flash'))
                    <div class="flash flash--success">{{ session('flash') }}</div>
                @endif

                @if($errors->any())
                    <div class="flash flash--error">{{ $errors->first() }}</div>
                @endif

                <form hx-post="/article/{{ $article->slug }}/comments" hx-target="body"
                    hx-swap="outerHTML show:#comment-section:top">
                    @csrf
                    <div class="row mb-3">
                        <input type="text" name="name" placeholder="Your name" value="{{ old('name') }}" required>
                        <input type="email" name="email" placeholder="Your email (not published)"
                            value="{{ old('email') }}" required>
                    </div>
                    <br>
                    <textarea name="body" placeholder="Share your thoughts..." rows="4"
                        required>{{ old('body') }}</textarea>

                    <input type="text" class="hp-field" tabindex="-1" autocomplete="off">
                    <button type="submit" class="btn comment-submit">
                        <span class="comment-submit__text">Post comment</span>
                        <span class="comment-submit__spinner"></span>
                    </button>
                </form>
            </div>
        </div>

        <aside class="article-sidebar">
            <div class="site-search" style="width:100%">
                <form action="/search" method="get" role="search" style="display:contents">
                    <input type="search" name="q" placeholder="Search…" value="{{ request('q') }}" aria-label="Search"
                        style="flex:1;min-width:0">
                    <button type="submit" aria-label="Search"><i data-feather="search" width="16"
                            height="16"></i></button>
                </form>
            </div>

            <div class="widget">
                <h4 class="widget__title">Recent Posts</h4>
                @forelse($relatedArticles->take(4) as $sidebarArticle)
                    <div class="pick-item">
                        <a class="pick-item__media" href="/article/{{ $sidebarArticle->slug }}">
                            <img src="{{ featured_image_url($sidebarArticle->featured_image) }}"
                                alt="{{ $sidebarArticle->title }}" loading="lazy">
                        </a>
                        <div>
                            <h4 class="pick-item__title">
                                <a href="/article/{{ $sidebarArticle->slug }}">{{ $sidebarArticle->title }}</a>
                            </h4>
                            <div class="pick-item__meta">{{ $sidebarArticle->published_at->format('F j, Y') }}</div>
                        </div>
                    </div>
                @empty
                    <p class="empty">No related articles.</p>
                @endforelse
            </div>

            <div class="widget widget--cta">
                <h4 class="widget__title">Newsletter</h4>
                <p>Join our readers and get the day's headlines in your inbox.</p>
                <div class="newsletter-error"></div>
                <form hx-post="/newsletter" hx-target="this" hx-swap="outerHTML">
                    @csrf
                    <input type="email" name="email" placeholder="Your email address" required>
                    <button type="submit" class="btn newsletter-submit">
                        <span class="newsletter-submit__text">Subscribe</span>
                        <span class="newsletter-submit__spinner"></span>
                    </button>
                </form>
            </div>
        </aside>
    </div>
</x-layouts.app>