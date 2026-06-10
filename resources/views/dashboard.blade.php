<x-app-layout>
    <div class="hero-strip">
        <div class="inner">
            <span class="bc">
                <a href="{{ route('dashboard') }}">{{ config('app.name') }}</a> &rsaquo; <span id="bcLabel">{{ $books->total() }} eBooks</span>
            </span>
        </div>
    </div>

    <div class="page-wrap">
        <aside class="sidebar">
            <button class="sb-mob-btn" onclick="toggleSB()">
                <span><i class="fas fa-sliders-h me-2"></i>Browse Categories</span>
                <i class="fas fa-chevron-down" id="sbChev"></i>
            </button>

            <div class="sb-body" id="sbBody">
                <div class="acc-card">
                    <div class="acc-head open" id="accHead1" onclick="toggleAcc('acc1','accHead1')">
                        <span class="aht"><i class="fas fa-fire-alt"></i>Popular Categories</span>
                        <i class="fas fa-chevron-down acc-chev"></i>
                    </div>
                    <div class="acc-body" id="acc1">
                        <ul class="sb-list">
                            <li>
                                <a href="#" data-cat="all" onclick="setCat(event,'all')" class="active">
                                    All Books <span class="cnt">{{ $books->total() }}</span>
                                </a>
                            </li>

                            @if($popularCategories->count() > 0)
                                @foreach($popularCategories as $category)
                                    <li>
                                        <a href="#" data-cat="{{ $category->name }}" onclick="setCat(event,'{{ $category->name }}')">
                                            {{ $category->name }} <span class="cnt">{{ $category->books_count }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="acc-card">
                    <div class="acc-head open" id="accHead2" onclick="toggleAcc('acc2','accHead2')">
                        <span class="aht"><i class="fas fa-book"></i>Categories</span>
                        <i class="fas fa-chevron-down acc-chev"></i>
                    </div>
                    <div class="acc-body" id="acc2">
                        <ul class="sb-list">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="#" data-cat="{{ $category->name }}" onclick="setCat(event,'{{ $category->name }}')">
                                        {{ $category->name }} <span class="cnt">{{ $category->books_count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

        <!-- ─── MAIN ───────────────────────────────────────────── -->
        <main class="content">
            <!-- Tabs with count badges + view labels -->
            <div class="panel-hdr">
                <nav class="tab-group">
                    @foreach ($allTags as $index => $tag)
                        <button class="tab-btn {{ $index == 0 ? 'active' : '' }}" onclick="setTab(event,'{{ $tag->slug }}')">
                            <i class="{{ $tag->fa_icon }}"></i> {{ $tag->name }}
                            <span class="tbadge" id="tbFeatured">{{ $tag->books->count() }}</span>
                        </button>
                    @endforeach
                </nav>
                <div class="view-group">
                    {{-- <button class="vbtn d-none" title="Gallery" onclick="setView('gallery')">
                        <i class="fas fa-th-large"></i><span>Gallery</span>
                    </button> --}}
                    <button class="vbtn" title="List" onclick="setView('list')">
                        <i class="fas fa-list"></i><span>List</span>
                    </button>
                    <button class="vbtn active" title="Icon" onclick="setView('icon')">
                        <i class="fas fa-th"></i><span>Icon</span>
                    </button>
                </div>
            </div>

            <!-- Sort / filter bar -->
            <div class="sort-bar">
                <div class="filter-chips">
                    <span class="chip active"><i class="fas fa-check-circle"></i> Total<span id="resCount" class="fw-bold">{{ $books->total() }}</span> Results</span>
                    <span class="chip d-none" id="activeFilter"><i class="fas fa-filter"></i> All Categories</span>
                    </div>
                    <div class="sort-wrap">
                    <label for="sortSel"><i class="fas fa-sort-amount-down me-1"></i>Order by:</label>
                    <select id="sortSel" onchange="renderBooks()">
                        <option value="default">Default</option>
                        <option value="title-az">Title A-Z</option>
                        <option value="title-za">Title Z-A</option>
                        <option value="author">Author A-Z</option>
                    </select>
                </div>
            </div>

            <!-- Books container -->
            <div id="booksWrap" class="v-icon">
                @foreach ($books as $book)
                    <a class="icon-item" href="book-view.html?id=1">
                        <div class="icon-img-wrap">
                            <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}" loading="lazy">
                            <div class="icon-shine"></div>
                        </div>
                        <abbr class="icon-link" title="{{ $book->title }}">{{ $book->title }}</abbr>
                        <div class="ia">{{ $book->author_name }}</div>
                    </a>
                @endforeach

                {{ $books->links() }}
            </div>
        </main>
    </div>
</x-app-layout>