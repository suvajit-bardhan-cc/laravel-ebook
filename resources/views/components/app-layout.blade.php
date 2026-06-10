<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ config('app.name') }}</title>

    <link rel="shortcut icon" href="{{ asset('images/1731092903.jpg') }}" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

    <style>
        #booksWrap.v-gallery { display: block; width: 100%; padding: 8px 24px 48px; box-sizing: border-box; }
        .gallery-slider { width: 100%; }
        .gallery-slider .slick-list { overflow: hidden; }
        .gallery-slider .slick-track { display: flex !important; }
        .gallery-slider .slick-slide { display: flex !important; padding: 0 6px; box-sizing: border-box; }
        .gallery-slider .slick-slide > div { width: 100%; }
        .gallery-slider .book-card { width: 100%; box-sizing: border-box; cursor: pointer; }
        .gallery-slider .cover-wrap img { width: 100%; height: 210px; object-fit: cover; display: block; }
        .gallery-slider .slick-prev,
        .gallery-slider .slick-next { z-index: 10; }
        .gallery-slider .slick-prev { left: -18px; }
        .gallery-slider .slick-next { right: -18px; }
        .gallery-slider .slick-prev:before,
        .gallery-slider .slick-next:before { color: #555; font-size: 24px; }
        .gallery-slider .slick-dots { bottom: -32px; }
        .gallery-slider .slick-dots li button:before { font-size: 8px; color: #aaa; }
        .gallery-slider .slick-dots li.slick-active button:before { color: #333; }
    </style>
</head>

<body>
    <!-- ═══ HEADER ══════════════════════════════════════════════ -->
    <header class="site-header">
        <div class="hdr-top">
            <a href="{{ route('dashboard') }}" class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}">
            </a>

            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search titles, authors…" oninput="renderBooks()">
                <button type="button"><i class="fas fa-search"></i> Search</button>
            </div>

            <div class="hdr-actions">
                <div class="dropdown">
                    <button class="btn-acct dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle"></i> My Account
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" style="font-size:13px">
                        <li>
                            <a class="dropdown-item" href="{{ route('bookmark') }}">
                                <i class="fas fa-bookmark fa-fw me-2 text-muted"></i>
                                Bookmark
                            </a>
                        </li>
                    </ul>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="d-inline">@csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i> Log Out
                    </button>
                </form>
            </div>
        </div>
    </header>

    {{ $slot }}

    <!-- ═══ FOOTER ═══════════════════════════════════════════════ -->
    <footer class="site-footer">
        <div class="footer-inner">
            <div class="footer-links">
                <a href="{{ route('privacy') }}">Privacy policy</a>
                <a href="{{ route('about') }}">About</a>
                <a href="{{ route('terms') }}">Terms of Use</a>
                <a href="{{ route('contact') }}">Contact Us</a>
            </div>
            <div class="footer-brand">
                <a href="{{ route('dashboard') }}"><img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" class="footer_logo"></a>
            </div>
            <span class="footer-copy">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</span>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- <script>
        let currentTab = 'featured';
        let currentView = 'icon';
        let currentCat = 'all';

        let books = [];

        function getBooks() {
        const q = (document.getElementById('searchInput').value || '').toLowerCase();
        const sort = document.getElementById('sortSel').value;
        const CAT_MAP = {
            'Fiction Bookshelf': ['Fiction', 'Science-Fiction & Fantasy', 'Historical Fiction'],
            'Language and Literature': ['Literature', 'Language & Communication'],
            'Crimes': ['Crime Fiction', 'Crime Nonfiction'],
        };
        let list = books.filter(b => {
            const cats = Array.isArray(b.cat) ? b.cat : [b.cat];
            // If filtering by a specific category (not 'all'), ignore tab so all matches show
            const ignorTab = currentCat !== 'all';
            if (!ignorTab && b.tab !== currentTab) return false;
            if (currentCat !== 'all') {
            const m = CAT_MAP[currentCat];
            if (m) { if (!cats.some(c => m.includes(c))) return false; }
            else { if (!cats.includes(currentCat)) return false; }
            }
            if (q && !b.title.toLowerCase().includes(q) && !b.author.toLowerCase().includes(q)) return false;
            return true;
        });
        if (sort === 'title-az') list.sort((a, b) => a.title.localeCompare(b.title));
        if (sort === 'title-za') list.sort((a, b) => b.title.localeCompare(a.title));
        if (sort === 'author') list.sort((a, b) => a.author.localeCompare(b.author));
        if (sort === 'year-old') list.sort((a, b) => a.year - b.year);
        if (sort === 'year-new') list.sort((a, b) => b.year - a.year);
        return list;
        }

        function updateTabBadges() {
        const CAT_MAP = {
            'Fiction Bookshelf': ['Fiction', 'Science-Fiction & Fantasy', 'Historical Fiction'],
            'Language and Literature': ['Literature', 'Language & Communication'],
            'Crimes': ['Crime Fiction', 'Crime Nonfiction'],
        };
        ['featured', 'bestsellers', 'popular'].forEach(tab => {
            const count = books.filter(b => {
            if (b.tab !== tab) return false;
            if (currentCat === 'all') return true;
            const cats = Array.isArray(b.cat) ? b.cat : [b.cat];
            const m = CAT_MAP[currentCat];
            return m ? cats.some(c => m.includes(c)) : cats.includes(currentCat);
            }).length;
            const ids = { featured: 'tbFeatured', bestsellers: 'tbBestsellers', popular: 'tbPopular' };
            const el = document.getElementById(ids[tab]);
            if (el) el.textContent = count;
        });
        }

        function renderBooks() {
        updateTabBadges();
        const list = getBooks();
        document.getElementById('resCount').textContent = list.length;
        const filterEl = document.getElementById('activeFilter');
        filterEl.innerHTML = `<i class="fas fa-filter"></i> ${currentCat === 'all' ? 'All Categories' : esc(currentCat)}`;

        const wrap = document.getElementById('booksWrap');
        // Destroy slick if previously initialized
        if (currentView === 'gallery' && $('.gallery-slider').length && $('.gallery-slider').hasClass('slick-initialized')) {
            $('.gallery-slider').slick('destroy');
        }
        if (!list.length) {
            wrap.className = '';
            wrap.innerHTML = '<div class="empty-state"><i class="fas fa-book-open"></i><p>No books found for this selection.</p></div>';
            return;
        }
        const cls = { gallery: 'v-gallery', list: 'v-list', icon: 'v-icon' };
        wrap.className = cls[currentView];

        if (currentView === 'gallery') {
            wrap.innerHTML = `<div class="gallery-slider">${list.map(b => `
        <div>
            <div class="book-card" onclick="window.location.href='book-view.html?id=${b.id}'" role="link" tabindex="0" onkeypress="if(event.key==='Enter') window.location.href='book-view.html?id=${b.id}'">
            <div class="cover-wrap">
                <img src="${b.img}" alt="${esc(b.title)}" loading="lazy">
                <span class="cover-badge d-none">${b.year}</span>
                <div class="cover-overlay">
                <a class="btn-read text-decoration-none" href="book-view.html?id=${b.id}"><i class="fas fa-play me-1"></i>Read Now</a>
                <button class=" d-none" onclick="event.preventDefault();"><i class="far fa-bookmark me-1"></i>Save</button>
                </div>
            </div>
            <div class="card-body">
                <p class="ct">${esc(b.title)}</p>
                <p class="ca">${esc(b.author)}</p>
                <div class="card-foot d-none">
                <span class="cc"><span class="cat-dot"></span>${esc([].concat(b.cat).join(', '))}</span>
                <span class="yr d-none">${b.year}</span>
                </div>
            </div>
            </div>
        </div>`).join('')}</div>`;

            $('.gallery-slider').slick({
            slidesToShow: 6,
            slidesToScroll: 6,
            dots: false,
            arrows: true,
            infinite: false,
            responsive: [
                { breakpoint: 1400, settings: { slidesToShow: 5, slidesToScroll: 5 } },
                { breakpoint: 1200, settings: { slidesToShow: 4, slidesToScroll: 4 } },
                { breakpoint: 991,  settings: { slidesToShow: 3, slidesToScroll: 3 } },
                { breakpoint: 768,  settings: { slidesToShow: 2, slidesToScroll: 1 } },
                { breakpoint: 480,  settings: { slidesToShow: 1, slidesToScroll: 1 } }
            ]
            });
            
        } else if (currentView === 'list') {
            wrap.innerHTML = list.map(b => `
        <div class="list-item align-items-center" onclick="window.location.href='book-view.html?id=${b.id}'" role="link" tabindex="0" onkeypress="if(event.key==='Enter') window.location.href='book-view.html?id=${b.id}'">
            <div class="list-thumb"><img src="${b.img}" alt="${esc(b.title)}" loading="lazy"></div>
            <div class="list-info">
            <h4>${esc(b.title)}</h4>
            <p class="la">
                <span><i class="fas fa-user fa-xs me-1"></i>${esc(b.author)}</span>
                <span class="d-none"><i class="fas fa-calendar-alt fa-xs me-1"></i>${b.year}</span>
            </p>
            <p class="ld">${esc(b.desc.length > 150 ? b.desc.slice(0, 150) + '…' : b.desc)}</p>
            <div class="tag-row">
                ${[].concat(b.cat).map(c => `<span class="tag">${esc(c)}</span>`).join('')}
            </div>
            </div>
            <div class="list-actions">
            <a class="btn-read-now text-decoration-none" href="book-view.html?id=${b.id}"><i class="fas fa-book-reader me-1"></i>Read</a>
            <span class="yr-badge d-none">${b.year}</span>
            </div>
        </div>`).join('');
        } else {
            wrap.innerHTML = list.map(b => `
        <a class="icon-item" href="book-view.html?id=${b.id}">
            <div class="icon-img-wrap">
            <img src="${b.img}" alt="${esc(b.title)}" loading="lazy">
            <div class="icon-shine"></div>
            </div>
            <abbr class="icon-link" title="${esc(b.title)}">${esc(b.title)}</abbr>
            <div class="ia">${esc(b.author)}</div>
        </a>`).join('');
        }
        }

        function setTab(e, tab) {
        e.preventDefault(); currentTab = tab;
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        e.currentTarget.classList.add('active'); updateCategoryCounts(); renderBooks();
        }
        function setView(v) {
        currentView = v;
        document.querySelectorAll('.vbtn').forEach((b, i) => b.classList.toggle('active', ['gallery', 'list', 'icon'][i] === v));
        renderBooks();
        }
        function setCat(e, cat) {
        e.preventDefault(); currentCat = cat;
        document.querySelectorAll('.sb-list a').forEach(a => a.classList.remove('active'));
        e.currentTarget.classList.add('active'); updateCategoryCounts(); renderBooks();
        }
        function toggleSB() {
        const body = document.getElementById('sbBody');
        const chev = document.getElementById('sbChev');
        body.classList.toggle('open');
        chev.style.transform = body.classList.contains('open') ? 'rotate(180deg)' : '';
        }
        function toggleAcc(bodyId, headId) {
        const body = document.getElementById(bodyId);
        const head = document.getElementById(headId);
        body.classList.toggle('collapsed');
        head.classList.toggle('open', !body.classList.contains('collapsed'));
        }
        function esc(s) {
        return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }

        function updateCategoryCounts() {
        const CAT_MAP = {
            'Fiction Bookshelf': ['Fiction', 'Science-Fiction & Fantasy', 'Historical Fiction'],
            'Language and Literature': ['Literature', 'Language & Communication'],
            'Crimes': ['Crime Fiction', 'Crime Nonfiction'],
        };

        const counts = {};
        counts['all'] = books.length;

        // Count per individual category
        books.forEach(b => {
            const cats = Array.isArray(b.cat) ? b.cat : [b.cat];
            cats.forEach(c => { counts[c] = (counts[c] || 0) + 1; });
        });

        // Count meta-categories by unique books (not sum of sub-counts)
        Object.keys(CAT_MAP).forEach(meta => {
            const subCats = CAT_MAP[meta];
            counts[meta] = books.filter(b => {
            const cats = Array.isArray(b.cat) ? b.cat : [b.cat];
            return cats.some(c => subCats.includes(c));
            }).length;
        });

        document.querySelectorAll('.sb-list a').forEach(link => {
            const cat = link.getAttribute('data-cat');
            const cntSpan = link.querySelector('.cnt');
            if (cntSpan && counts[cat] !== undefined) {
            cntSpan.textContent = counts[cat];
            }
        });
        }

        // Read ?cat= URL param and apply before first render
        (function applyCatParam() {
        const param = new URLSearchParams(window.location.search).get('cat');
        if (!param) return;
        currentCat = param;
        // Highlight matching sidebar link
        document.querySelectorAll('.sb-list a').forEach(a => {
            a.classList.toggle('active', a.getAttribute('data-cat') === param);
        });
        })();

        // Load books dynamically from books.json
        fetch('books.json')
        .then(res => res.json())
        .then(data => {
            books = data;
            document.getElementById('bcLabel').textContent = data.length + ' eBooks';
            updateCategoryCounts();
            renderBooks();
        })
        .catch(err => {
            console.error('Failed to load books.json:', err);
            document.getElementById('booksWrap').innerHTML =
            '<div class="empty-state"><i class="fas fa-exclamation-circle"></i><p>Could not load books. Please try again.</p></div>';
        });
    </script> --}}
</body>

</html>