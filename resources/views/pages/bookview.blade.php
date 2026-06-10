<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Book View - eBook Stack</title>

    <link rel="shortcut icon" href="images/1731092903.jpg" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>

.btn-logout {
    appearance: none;
    -webkit-appearance: none;
    background: none;
    border: none;
    outline: none;
    padding: 0;
    margin: 0;
    font: inherit;
    color: inherit;
    cursor: pointer;
    text-decoration: none;
}

.badge{
    display:inline-block;
    padding:4px 10px;
    margin:2px;
    border-radius:20px;
    font-size:12px;
    background:#4f46e5;
    color:#fff;
}
    </style>

</head>

<body>

    <!-- ═══ HEADER ══════════════════════════════════════════════ -->
    @include('layouts.header')

    <!-- ═══ HERO STRIP ════════════════════════════════════════════ -->
    <div class="hero-strip">
        <div class="inner">
            <span class="bc">
                <a href="index.html">eBook Stack</a> &rsaquo; <span id="bcLabel">Book Details</span>
            </span>
        </div>
    </div>

    <!-- ═══ PAGE BODY ════════════════════════════════════════════ -->
    <div class="page-wrap">

        <!-- ─── ACCORDION SIDEBAR ─────────────────────────────── -->
        <aside class="sidebar">
            <button class="sb-mob-btn" onclick="toggleSB()">
                <span><i class="fas fa-sliders-h me-2"></i>Browse Categories</span>
                <i class="fas fa-chevron-down" id="sbChev"></i>
            </button>

            <div class="sb-body" id="sbBody">
                <!-- Popular Categories accordion -->
                <div class="acc-card">
                    <div class="acc-head open" id="accHead1" onclick="toggleAcc('acc1','accHead1')">
                        <span class="aht"><i class="fas fa-fire-alt"></i>Popular Categories</span>
                        <i class="fas fa-chevron-down acc-chev"></i>
                    </div>
                    <div class="acc-body" id="acc1">
                        <ul class="sb-list">
                            <li><a href="index.html" data-cat="all">All Books <span class="cnt">0</span></a></li>
                            <li><a href="index.html?cat=Fiction+Bookshelf" data-cat="Fiction Bookshelf">Fiction Bookshelf <span class="cnt">0</span></a></li>
                            <li><a href="index.html?cat=Classics" data-cat="Harvard Classics">Classics <span class="cnt">0</span></a></li>
                            <li><a href="index.html?cat=Language+and+Literature" data-cat="Language and Literature">Language &amp; Literature <span class="cnt">0</span></a></li>
                            <li><a href="index.html?cat=War" data-cat="History - Warfare">War <span class="cnt">0</span></a></li>
                            <li><a href="index.html?cat=Crimes" data-cat="Crimes">Crimes <span class="cnt">0</span></a></li>
                        </ul>
                    </div>
                </div>

                <!-- Fiction accordion -->
                <div class="acc-card">
                    <div class="acc-head open" id="accHead2" onclick="toggleAcc('acc2','accHead2')">
                        <span class="aht"><i class="fas fa-book"></i>Fiction</span>
                        <i class="fas fa-chevron-down acc-chev"></i>
                    </div>
                    <div class="acc-body" id="acc2">
                        <ul class="sb-list">
                            <li><a href="index.html?cat=Fiction" data-cat="Fiction">Fiction <span class="cnt">0</span></a></li>
                            <li><a href="index.html?cat=Science-Fiction+%26+Fantasy" data-cat="Science-Fiction & Fantasy">Science-Fiction &amp; Fantasy <span class="cnt">0</span></a></li>
                            <li><a href="index.html?cat=Historical+Fiction" data-cat="Historical Fiction">Historical Fiction <span class="cnt">0</span></a></li>
                            <li><a href="index.html?cat=Science+Fiction" data-cat="Science Fiction">Science Fiction <span class="cnt">0</span></a></li>
                            <li><a href="index.html?cat=Adventure" data-cat="Adventure">Adventure <span class="cnt">0</span></a></li>
                            <li><a href="index.html?cat=Mystery+Fiction" data-cat="Mystery Fiction">Mystery Fiction <span class="cnt">0</span></a></li>
                            <li><a href="index.html?cat=Children%27s+Fiction" data-cat="Children's Fiction">Children's Fiction <span class="cnt">0</span></a></li>
                            <li><a href="index.html?cat=Harvard+Classics" data-cat="Harvard Classics">Harvard Classics <span class="cnt">0</span></a></li>
                            <li><a href="index.html?cat=Classical+Antiquity" data-cat="Classical Antiquity">Classical Antiquity <span class="cnt">0</span></a></li>
                            <li><a href="index.html?cat=Literature" data-cat="Literature">Literature <span class="cnt">0</span></a></li>
                            <li><a href="index.html?cat=Language+%26+Communication" data-cat="Language & Communication">Language &amp; Communication <span class="cnt">0</span></a></li>
                            <li><a href="index.html?cat=Teaching+%26+Education" data-cat="Teaching & Education">Teaching &amp; Education <span class="cnt">0</span></a></li>
                            <li><a href="index.html?cat=History+-+Warfare" data-cat="History - Warfare">History - Warfare <span class="cnt">0</span></a></li>
                            <li><a href="index.html?cat=Crime+Fiction" data-cat="Crime Fiction">Crime Fiction <span class="cnt">0</span></a></li>
                            <li><a href="index.html?cat=Crime+Nonfiction" data-cat="Crime Nonfiction">Crime Nonfiction <span class="cnt">0</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

        <!-- ─── MAIN ───────────────────────────────────────────── -->
        <main class="content">
            <!-- <div id="bookContent"> -->
                <!-- Populated dynamically -->
                <!-- <div class="empty-state" style="padding:3rem;text-align:center">
                    <i class="fas fa-spinner fa-spin fa-2x"></i>
                    <p style="margin-top:1rem">Loading book details…</p>
                </div> -->
            <!-- </div> -->


            <div class="book-view-container">

                <div class="book-cover-section">

                    <img
                        src="{{  $book->cover_image_url }}"
                        alt="{{ $book->title }}"
                        class="book-cover-img"
                    >

                    <div class="book-cover-actions">

                        <button class="btn-read-online">
                            <i class="fas fa-play me-2"></i>Read Online
                        </button>

                        <button class="btn-bookmark" id="bookmarkBtn">
                            <i class="far fa-bookmark me-2"></i>Add Bookmark
                        </button>

                    </div>

                </div>

                <div class="book-details-section">

                    <h1 class="book-title">
                        {{ $book->title }}
                    </h1>

                    <p class="book-author">
                        by <strong>{{ $book->author_name }}</strong>
                    </p>

                    <div class="book-meta">

                        <div class="meta-item">
                            <span class="meta-label">Language</span>
                            <span class="meta-value">
                                {{ $book->language }}
                            </span>
                        </div>

                        @if($book->year)
                        <div class="meta-item">
                            <span class="meta-label">Year</span>
                            <span class="meta-value">
                                {{ $book->year }}
                            </span>
                        </div>
                        @endif

                        <div class="meta-item">
                            <span class="meta-label">Category</span>
                            <span class="meta-value">

                                @foreach($book->categories as $category)
                                    {{ $category->name }}@if(!$loop->last), @endif
                                @endforeach

                            </span>
                        </div>

                    </div>

                    <div class="book-description">

                        <h3 class="book-description-title">
                            About This Book
                        </h3>

                        <p class="book-description-text">
                            {{ $book->about }}
                        </p>

                    </div>

                </div>

            </div>
        </main>
    </div>

    <!-- ═══ FOOTER ═══════════════════════════════════════════════ -->
    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const BOOKMARKS_KEY = 'ebookStackBookmarks';
        let bookData = null;

        // ── Helpers ──────────────────────────────────────────────
        function esc(s) {
            return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }

        function getBookmarks() {
            try { return JSON.parse(localStorage.getItem(BOOKMARKS_KEY)) || []; }
            catch { return []; }
        }
        function saveBookmarks(bm) { localStorage.setItem(BOOKMARKS_KEY, JSON.stringify(bm)); }
        function isBookmarked(id) { return getBookmarks().some(b => b.id === id); }

        function updateBookmarkButton() {
            const btn = document.getElementById('bookmarkBtn');
            if (!btn || !bookData) return;
            const active = isBookmarked(bookData.id);
            btn.classList.toggle('added', active);
            btn.innerHTML = active
                ? '<i class="fas fa-bookmark me-2"></i>Bookmarked'
                : '<i class="far fa-bookmark me-2"></i>Add Bookmark';
        }

        function toggleBookmark() {
            if (!bookData) return;
            const bm = getBookmarks();
            if (bm.some(b => b.id === bookData.id)) {
                saveBookmarks(bm.filter(b => b.id !== bookData.id));
            } else {
                bm.push({ id: bookData.id, href: 'book-view.html?id=' + bookData.id, title: bookData.title, author: bookData.author, cat: bookData.cat, img: bookData.img });
                saveBookmarks(bm);
            }
            updateBookmarkButton();
        }

        function readOnline() {
            if (bookData && bookData.readUrl) window.open(bookData.readUrl, '_blank');
        }

        // ── Sidebar toggles ──────────────────────────────────────
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

        // ── Sidebar category counts ──────────────────────────────
        function updateCategoryCounts(books) {
            const CAT_MAP = {
                'Fiction Bookshelf': ['Fiction', 'Science-Fiction & Fantasy', 'Historical Fiction'],
                'Language and Literature': ['Literature', 'Language & Communication'],
                'Crimes': ['Crime Fiction', 'Crime Nonfiction'],
            };
            const counts = { all: books.length };

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
                if (cntSpan && counts[cat] !== undefined) cntSpan.textContent = counts[cat];
            });
        }

        function highlightCurrentCat(bookCat) {
            const cats = Array.isArray(bookCat) ? bookCat : [bookCat];
            document.querySelectorAll('.sb-list a').forEach(link => {
                link.classList.toggle('active', cats.includes(link.getAttribute('data-cat')));
            });
        }

        // ── Render book ──────────────────────────────────────────
        function renderBook(book) {
            document.title = book.title + ' - eBook Stack';
            document.getElementById('bcLabel').textContent = book.title;

            document.getElementById('bookContent').innerHTML = `
                <div class="book-view-container">
                    <div class="book-cover-section">
                        <img src="${esc(book.img)}" alt="${esc(book.title)}" class="book-cover-img">
                        <div class="book-cover-actions">
                            <button class="btn-read-online" onclick="readOnline()">
                                <i class="fas fa-play me-2"></i>Read Online
                            </button>
                            <button class="btn-bookmark" id="bookmarkBtn" onclick="toggleBookmark()">
                                <i class="far fa-bookmark me-2"></i>Add Bookmark
                            </button>
                        </div>
                    </div>

                    <div class="book-details-section">
                        <h1 class="book-title">${esc(book.title)}</h1>
                        <p class="book-author">by <strong>${esc(book.author)}</strong></p>

                        <div class="book-meta">
                            <div class="meta-item">
                                <span class="meta-label">Language</span>
                                <span class="meta-value">English</span>
                            </div>
                            <div class="meta-item d-none">
                                <span class="meta-label">Year</span>
                                <span class="meta-value">${esc(String(book.year))}</span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-label">Category</span>
                                <span class="meta-value">${[].concat(book.cat).map(c => esc(c)).join(', ')}</span>
                            </div>
                        </div>

                        <div class="book-description">
                            <h3 class="book-description-title">About This Book</h3>
                            <p class="book-description-text">${esc(book.desc)}</p>
                        </div>
                    </div>
                </div>`;

            updateBookmarkButton();
        }

        // ── Load book from books.json ────────────────────────────
        const params = new URLSearchParams(window.location.search);
        const bookId = parseInt(params.get('id'), 10);

        if (!bookId) {
            document.getElementById('bookContent').innerHTML =
                '<div class="empty-state"><i class="fas fa-exclamation-circle"></i><p>No book specified. <a href="index.html">Go back to library</a>.</p></div>';
        } else {
            fetch('books.json')
                .then(res => res.json())
                .then(books => {
                    const book = books.find(b => b.id === bookId);
                    if (!book) {
                        document.getElementById('bookContent').innerHTML =
                            '<div class="empty-state"><i class="fas fa-exclamation-circle"></i><p>Book not found. <a href="index.html">Go back to library</a>.</p></div>';
                        return;
                    }
                    bookData = book;
                    updateCategoryCounts(books);
                    highlightCurrentCat(book.cat);
                    renderBook(book);
                })
                .catch(() => {
                    document.getElementById('bookContent').innerHTML =
                        '<div class="empty-state"><i class="fas fa-exclamation-circle"></i><p>Could not load book data. Please try again.</p></div>';
                });
        }
    </script>
</body>

</html>
