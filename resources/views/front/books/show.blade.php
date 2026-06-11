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
                            <button class="btn-bookmark" id="bookmarkBtn" data-book-id="{{ $book->id }}">
                                <i class="far fa-bookmark me-2"></i><span id="bookmarkText">Add Bookmark</span>
                            </button>
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

    <script>
        const bookmarkBtn = document.getElementById('bookmarkBtn');
        const bookmarkText = document.getElementById('bookmarkText');
        const bookId = bookmarkBtn.dataset.bookId;

        // Check if book is already bookmarked
        async function checkBookmarkStatus() {
            try {
                const response = await fetch(`/api/bookmarks/${bookId}/check`);
                const data = await response.json();
                updateBookmarkButton(data.bookmarked);
            } catch (error) {
                console.error('Error checking bookmark status:', error);
            }
        }

        // Update bookmark button appearance
        function updateBookmarkButton(isBookmarked) {
            const icon = bookmarkBtn.querySelector('i');
            if (isBookmarked) {
                bookmarkBtn.classList.add('bookmarked');
                icon.classList.remove('far');
                icon.classList.add('fas');
                bookmarkText.textContent = 'Remove Bookmark';
            } else {
                bookmarkBtn.classList.remove('bookmarked');
                icon.classList.remove('fas');
                icon.classList.add('far');
                bookmarkText.textContent = 'Add Bookmark';
            }
        }

        // Toggle bookmark
        bookmarkBtn.addEventListener('click', async (e) => {
            e.preventDefault();

            try {
                const response = await fetch(`/api/bookmarks/${bookId}/toggle`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                const data = await response.json();

                if (!response.ok) {
                    if (data.requires_login) {
                        // Redirect to login
                        window.location.href = '{{ route('login') }}';
                    } else {
                        alert(data.message || 'Error updating bookmark');
                    }
                    return;
                }

                updateBookmarkButton(data.bookmarked);

                // Show toast notification
                showNotification(data.message);
            } catch (error) {
                console.error('Error:', error);
                alert('Error updating bookmark');
            }
        });

        // Show notification
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'notification-toast';
            notification.textContent = message;
            notification.style.cssText = `
                position: fixed;
                bottom: 20px;
                right: 20px;
                background-color: #10b981;
                color: white;
                padding: 12px 20px;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                z-index: 1000;
                animation: slideIn 0.3s ease-out;
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease-out';
                setTimeout(() => notification.remove(), 300);
            }, 2000);
        }

        // Add CSS animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(400px);
                    opacity: 0;
                }
            }

            .btn-bookmark.bookmarked {
                background-color: #fbbf24 !important;
                color: #78350f !important;
            }

            .btn-bookmark.bookmarked:hover {
                background-color: #f59e0b !important;
            }
        `;
        document.head.appendChild(style);

        // Check bookmark status on page load
        window.addEventListener('load', checkBookmarkStatus);
    </script>
</x-app-layout>