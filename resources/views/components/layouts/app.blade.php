@props(['title'])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(request()->is('/'))
        <title>{{ $title }} - {{ setting('site_tagline', 'News that matters, as it happens.') }}</title>
        <meta name="description" content="{{ setting('site_tagline', 'News that matters, as it happens.') }}">
    @else
        <title>{{ isset($title) ? "$title - " : '' }}{{ setting("site_name")  }}</title>
        <meta name="description" content="{{ $title ?? setting('site_name') }}">
    @endif
    <link rel="icon" type="image/svg+xml"
        href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='6' fill='%23F97316'/%3E%3Ctext x='12' y='21' font-family='system-ui,sans-serif' font-size='15' font-weight='800' fill='%23fff' text-anchor='middle'%3EN%3C/text%3E%3Ctext x='20' y='21' font-family='system-ui,sans-serif' font-size='15' font-weight='800' fill='%23fff' text-anchor='middle'%3ER%3C/text%3E%3C/svg%3E">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&amp;family=Roboto:wght@300;400;500;700&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/nprogress@0.2.0/nprogress.css">
    <script defer src="https://unpkg.com/htmx.org@2.0.4"></script>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body hx-boost="true">
    <div class="topbar">
        <div class="container topbar__inner">
            <span class="topbar__date" id="topbar-date"></span>
            <div class="topbar__right">
                <label class="lang-switch" title="Translate this site">
                    <i data-feather="globe" width="14" height="14" style="opacity:.7"></i>
                    <select id="lang-switch" aria-label="Translate this site">
                        <option value="en">Language</option>
                        @include('partials.home._languages')
                    </select>
                </label>
                <a class="topbar__contact">
                    <span>{{ setting('site_email') }}</span>
                </a>
                <button id="theme-toggle" class="theme-toggle" aria-label="Toggle dark mode">
                    <span class="theme-moon"><i data-feather="moon" width="14" height="14"></i></span>
                    <span class="theme-sun"><i data-feather="sun" width="14" height="14"></i></span>
                </button>
            </div>
        </div>
    </div>
    <div id="google_translate_element" aria-hidden="true"></div>
    <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({ pageLanguage: 'en', autoDisplay: false }, 'google_translate_element');
        }
        (function () {
            function readCookie(name) {
                var m = document.cookie.match('(?:^|; )' + name + '=([^;]*)');
                return m ? decodeURIComponent(m[1]) : '';
            }
            function syncSelect() {
                var sel = document.getElementById('lang-switch');
                if (!sel) return;
                var c = readCookie('googtrans');
                if (c) { var parts = c.split('index'); if (parts[2]) sel.value = parts[2]; }
            }
            function setCookie(value) {
                var host = location.hostname;
                ['', '; domain=' + host, '; domain=.' + host].forEach(function (d) {
                    document.cookie = 'googtrans=' + value + '; path=/' + d;
                });
            }
            function translateTo(lang) {
                if (lang === 'en') {
                    setCookie('; expires=Thu, 01 Jan 1970 00:00:00 GMT');
                } else {
                    setCookie('/en/' + lang);
                }
                location.reload();
            }
            function killGoogleChrome() {
                if (document.body && document.body.style.top) document.body.style.top = '0px';
                var b = document.querySelector('.goog-te-banner-frame');
                if (b) b.style.display = 'none';
            }
            document.addEventListener('DOMContentLoaded', function () {
                syncSelect();
                var sel = document.getElementById('lang-switch');
                if (sel) sel.addEventListener('change', function () { translateTo(this.value); });
                killGoogleChrome();
                var n = 0, t = setInterval(function () { killGoogleChrome(); if (++n > 40) clearInterval(t); }, 250);
            });
        })();
    </script>
    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <header class="site-header">
        <div class="container site-header__inner">
            <a class="brand" href="/">
                <svg viewBox="0 0 32 32" width="28" height="28" style="vertical-align:middle;margin-right:6px">
                    <rect width="32" height="32" rx="6" fill="#F97316" /><text x="12" y="21"
                        font-family="system-ui,sans-serif" font-size="15" font-weight="800" fill="#fff"
                        text-anchor="middle">N</text><text x="20" y="21" font-family="system-ui,sans-serif"
                        font-size="15" font-weight="800" fill="#fff" text-anchor="middle">R</text>
                </svg>
                <span class="brand__mark">{{ Str::substr(setting('site_name'), 0, 5) }}</span><span
                    class="brand__news">{{ Str::substr(setting('site_name'), 5) }}</span></a>

            <button class="nav-toggle" aria-label="Toggle menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>

            <nav class="site-nav">
                <a href="/" @class(['is-active' => request()->is('/')])>Home</a>
                @foreach($navigationCategories->take(3) as $category)
                    <a href="/category/{{ $category->slug }}" @class(['is-active' => request()->is('category/' . $category->slug)])>{{ $category->name }}</a>
                @endforeach
                @if($navigationCategories->count() > 3)
                    @php $dropdownSlugs = $navigationCategories->slice(3)->pluck('slug')->toArray(); @endphp
                    <div class="nav-dropdown">
                        <button
                            class="nav-dropdown__trigger @if(in_array(request()->segment(2), $dropdownSlugs)) is-active @endif">
                            Other Categories
                            <i data-feather="chevron-down" width="12" height="12"></i>
                        </button>
                        <div class="nav-dropdown__menu">
                            @foreach($navigationCategories->slice(3) as $category)
                                <a href="/category/{{ $category->slug }}" @class(['is-active' => request()->is('category/' . $category->slug)])>{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </nav>

            <div class="header-actions">
                <form class="site-search" action="/search" method="get" role="search">
                    <input type="search" name="q" placeholder="Search…" value="{{ request('q') }}" aria-label="Search">
                    <button type="submit" aria-label="Search"><i data-feather="search" width="16"
                            height="16"></i></button>
                </form>
            </div>
        </div>
    </header>
    <main class="container site-main">

        {{ $slot }}

    </main>
    <footer class="site-footer">
        <div class="container site-footer__inner">
            <div class="footer-about">
                <a class="brand" href="index">
                    <svg viewBox="0 0 32 32" width="28" height="28" style="vertical-align:middle;margin-right:6px">
                        <rect width="32" height="32" rx="6" fill="#F97316" /><text x="12" y="21"
                            font-family="system-ui,sans-serif" font-size="15" font-weight="800" fill="#fff"
                            text-anchor="middle">N</text><text x="20" y="21" font-family="system-ui,sans-serif"
                            font-size="15" font-weight="800" fill="#fff" text-anchor="middle">R</text>
                    </svg>
                    <span class="brand__mark">{{ Str::substr(setting('site_name'), 0, 5) }}</span><span
                        class="brand__news">{{ Str::substr(setting('site_name'), 5) }}</span></a>
                <p>{{ setting('site_tagline', 'News that matters, as it happens.') }}</p>
            </div>

            <div class="footer-categories">
                <h4>Categories</h4>
                <nav class="footer-links">
                    @foreach($navigationCategories->take(5) as $category)
                        <a href="/category/{{ $category->slug }}">{{ $category->name }}</a>
                    @endforeach
                    @if($navigationCategories->count() > 5)
                        <div class="footer-cats-extra" id="footer-cats-extra" style="display:none">
                            @foreach($navigationCategories->skip(5) as $category)
                                <a href="/category/{{ $category->slug }}">{{ $category->name }}</a>
                            @endforeach
                        </div>
                        <button type="button" class="footer-cats-toggle"
                            onclick="(function(e){var el=document.getElementById('footer-cats-extra'),btn=e.currentTarget;if(el.style.display==='none'){el.style.display='';btn.textContent='Show less'}else{el.style.display='none';btn.textContent='Show all'}})(event)">Show
                            all</button>
                    @endif
                </nav>
            </div>

            <div class="footer-contact">
                <h4>Get in touch</h4>
                <p>Have a story or a tip? We'd love to hear from you.</p>
                <p><svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16"
                        height="16" style="display:inline;vertical-align:middle;margin-right:4px">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                        <circle cx="12" cy="9" r="2.5" />
                    </svg>{{ setting('company_address') }}</p>
                <p><i data-feather="mail" width="16" height="16"
                        style="display:inline;vertical-align:middle;margin-right:4px"></i>
                    <a href="mailto:{{ setting('site_email') }}">{{ setting('site_email') }}</a>
                </p>
            </div>

            <div class="newsletter" id="newsletter-section">
                <h4>Newsletter</h4>
                <p>Join our readers and get the day's headlines in your inbox.</p>
                @if(session('flash'))
                    <div class="flash flash--success">{{ session('flash') }}</div>
                @endif

                @if(isset($errors) && $errors->any())
                    <div class="flash flash--error">{{ $errors->first() }}</div>
                @endif
                <form hx-post="/newsletter" hx-target="body" hx-swap="outerHTML show:#newsletter-section:top">
                    @csrf
                    <div class="newsletter__row">
                        <input type="email" name="email" placeholder="Your email address" required>
                        <button type="submit" class="newsletter-submit">
                            <span class="newsletter-submit__text">Subscribe</span>
                            <span class="newsletter-submit__spinner"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="site-footer__bar">
            <div class="container">
                <span>&copy; {{ date('Y') }} {{ setting('site_name') }}. All rights reserved.</span>
                <nav class="footer-pages">
                    <a href="/page/about">About Us</a>
                    <a href="/page/terms">Terms &amp; Conditions</a>
                    <a href="/page/privacy">Privacy Policy</a>
                </nav>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
    <script src="/assets/js/main.js"></script>
</body>

</html>