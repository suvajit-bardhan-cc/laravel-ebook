<div class="search-box-wrapper">
    <div class="search-box">
        <input
            type="text"
            wire:model.live.debounce-300ms="searchQuery"
            placeholder="Search titles, authors…"
            class="search-input"
            autocomplete="off">
        <button type="button" class="search-btn">
            <i class="fas fa-search"></i> Search
        </button>
    </div>

    <!-- Search Results Dropdown -->
    @if(count($searchResults) > 0)
        <div class="search-dropdown">
            <div class="search-results-list">
                @foreach($searchResults as $book)
                    <a href="{{ route('books.show', encrypt($book->id)) }}" class="search-result-item">
                        <div class="sr-thumb">
                            <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}" loading="lazy">
                        </div>
                        <div class="sr-info">
                            <h5 class="sr-title">{{ $book->title }}</h5>
                            <p class="sr-author">{{ $book->author_name }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @elseif($searchQuery && count($searchResults) == 0)
        <div class="search-dropdown">
            <div class="search-no-results">
                <i class="fas fa-search"></i>
                <p>No books found</p>
            </div>
        </div>
    @endif
</div>

<style>
    .search-box-wrapper {
        position: relative;
    }

    .search-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #e0e0e0;
        border-top: none;
        border-radius: 0 0 8px 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        max-height: 400px;
        overflow-y: auto;
    }

    .search-results-list {
        display: flex;
        flex-direction: column;
    }

    .search-result-item {
        display: flex;
        gap: 12px;
        padding: 12px 16px;
        border-bottom: 1px solid #f0f0f0;
        text-decoration: none;
        color: inherit;
        transition: background-color 0.2s;
    }

    .search-result-item:last-child {
        border-bottom: none;
    }

    .search-result-item:hover {
        background-color: #f9f9f9;
    }

    .sr-thumb {
        width: 50px;
        height: 70px;
        flex-shrink: 0;
        overflow: hidden;
        border-radius: 4px;
    }

    .sr-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .sr-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-width: 0;
    }

    .sr-title {
        font-size: 14px;
        font-weight: 600;
        margin: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: #333;
    }

    .sr-author {
        font-size: 12px;
        color: #666;
        margin: 4px 0 0 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .search-no-results {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 30px 20px;
        color: #999;
    }

    .search-no-results i {
        font-size: 32px;
        margin-bottom: 10px;
        opacity: 0.5;
    }

    .search-no-results p {
        margin: 0;
        font-size: 14px;
    }
</style>
