<x-app-layout>
    <div class="hero-strip">
        <div class="inner">
            <span class="bc">
                <a href="{{ route('dashboard') }}">{{ config('app.name') }}</a> &rsaquo; 
                <span id="bcLabel">{{ $book->title }}</span>
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
                                <a href="{{ route('dashboard') }}" class="cat-link">
                                    All Books <span class="cnt">{{ $allBooksCount }}</span>
                                </a>
                            </li>

                            @if($popularCategories->count() > 0)
                                @foreach($popularCategories as $category)
                                    <li>
                                        <a href="{{ route('dashboard', ['selectedCategory' => $category->name]) }}" class="cat-link">
                                            {{ $category->name }} <span class="cnt">{{ $category->books_count }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- All Categories accordion -->
                <div class="acc-card">
                    <div class="acc-head open" id="accHead2" onclick="toggleAcc('acc2','accHead2')">
                        <span class="aht"><i class="fas fa-book"></i>All Categories</span>
                        <i class="fas fa-chevron-down acc-chev"></i>
                    </div>
                    <div class="acc-body" id="acc2">
                        <ul class="sb-list">
                            @forelse($categories as $category)
                                <li>
                                    <a href="{{ route('dashboard', ['selectedCategory' => $category->name]) }}" class="cat-link">
                                        {{ $category->name }} <span class="cnt">{{ $category->books_count }}</span>
                                    </a>
                                </li>
                            @empty
                                <li><p style="padding: 10px; color: #999;">No categories available</p></li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

        <!-- ─── MAIN ───────────────────────────────────────────── -->
        <main class="content">
            <div id="bookContent">
                <div class="book-view-container">
                    <div class="book-cover-section">
                        <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}" class="book-cover-img">
                        <div class="book-cover-actions">
                            <button class="btn-read-online" onclick="readOnline()">
                                <i class="fas fa-play me-2"></i>Read Online
                            </button>
                            <button class="btn-bookmark" id="bookmarkBtn" onclick="toggleBookmark()"><i class="far fa-bookmark me-2"></i>Add Bookmark</button>
                        </div>
                    </div>

                    <div class="book-details-section">
                        <h1 class="book-title">{{ $book->title }}</h1>
                        <p class="book-author">by <strong>{{ $book->author_name }}</strong></p>

                        <div class="book-meta">
                            <div class="meta-item">
                                <span class="meta-label">Language</span>
                                <span class="meta-value">{{ $book->language ?? 'English' }}</span>
                            </div>
                            @if($book->published_year)
                                <div class="meta-item">
                                    <span class="meta-label">Year</span>
                                    <span class="meta-value">{{ $book->published_year }}</span>
                                </div>
                            @endif
                            @if($book->categories->count() > 0)
                                <div class="meta-item">
                                    <span class="meta-label">Category</span>
                                    <span class="meta-value">{{ $book->categories->pluck('name')->join(', ') }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="book-description">
                            <h3 class="book-description-title">About This Book</h3>
                            <p class="book-description-text">{{ $book->about }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>