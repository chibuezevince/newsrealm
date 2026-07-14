(function () {
    'use strict';

    feather.replace();

    var dateEl = document.getElementById('topbar-date');
    if (dateEl) {
        dateEl.textContent = new Date().toLocaleDateString('en-US', {
            weekday: 'long', month: 'long', day: 'numeric'
        });
    }

    if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark');
    }

    function initThemeToggle() {
        var btn = document.getElementById('theme-toggle');
        if (!btn || btn._listener) return;
        btn._listener = true;
        btn.addEventListener('click', function () {
            var html = document.documentElement;
            var isDark = html.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });
    }
    initThemeToggle();

    function initNavToggle() {
        document.body.style.overflow = '';
        var toggle = document.querySelector('.nav-toggle');
        var nav = document.querySelector('.site-nav');
        var overlay = document.querySelector('.nav-overlay');
        if (!toggle || !nav) return;

        var newToggle = toggle.cloneNode(true);
        toggle.parentNode.replaceChild(newToggle, toggle);

        var overlayNew = overlay ? overlay.cloneNode(true) : null;
        if (overlay) overlay.parentNode.replaceChild(overlayNew, overlay);

        function closeNav() {
            newToggle.classList.remove('is-open');
            newToggle.setAttribute('aria-expanded', 'false');
            nav.classList.remove('is-open');
            if (overlayNew) overlayNew.classList.remove('is-open');
            document.body.style.overflow = '';
        }

        newToggle.addEventListener('click', function () {
            var isOpen = nav.classList.contains('is-open');
            if (isOpen) { closeNav(); }
            else {
                newToggle.classList.add('is-open');
                newToggle.setAttribute('aria-expanded', 'true');
                nav.classList.add('is-open');
                if (overlayNew) overlayNew.classList.add('is-open');
                document.body.style.overflow = 'hidden';
            }
        });

        if (overlayNew) overlayNew.addEventListener('click', closeNav);
    }
    initNavToggle();

    var copyBtn = document.querySelector('.share--copy');
    if (copyBtn) {
        copyBtn.addEventListener('click', function () {
            var url = copyBtn.getAttribute('data-url') || window.location.href;
            var done = function () {
                copyBtn.textContent = 'Copied!';
                setTimeout(function () { copyBtn.textContent = 'Copy Link'; }, 1500);
            };
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(url).then(done, done);
            } else {
                var t = document.createElement('textarea');
                t.value = url; document.body.appendChild(t); t.select();
                try { document.execCommand('copy'); } catch (e) { }
                document.body.removeChild(t); done();
            }
        });
    }

    document.addEventListener('htmx:beforeRequest', function () { NProgress.start(); });
    document.addEventListener('htmx:afterRequest', function () { NProgress.done(); });
    document.addEventListener('htmx:load', function () { NProgress.done(); });
    window.addEventListener('pageshow', function (e) { if (e.persisted) NProgress.done(); });

    document.addEventListener('htmx:afterSettle', function () {
        feather.replace();
        initThemeToggle();
        initNavToggle();
    });
})();
