<div>
    <!-- Tabs with count badges + view labels -->
    <div class="panel-hdr">
        <nav class="tab-group">
            @foreach ($allTags as $index => $tag)
                <button
                    wire:click="selectTag('{{ $tag->slug }}')"
                    class="tab-btn {{ $selectedTag === $tag->slug ? 'active' : '' }}">
                    <i class="{{ $tag->fa_icon }}"></i> {{ $tag->name }}
                    <span class="tbadge">{{ $tag->books->count() }}</span>
                </button>
            @endforeach
        </nav>
        <div class="view-group">
            <button
                wire:click="setView('list')"
                class="vbtn {{ $viewType === 'list' ? 'active' : '' }}"
                title="List">
                <i class="fas fa-list"></i><span>List</span>
            </button>
            <button
                wire:click="setView('icon')"
                class="vbtn {{ $viewType === 'icon' ? 'active' : '' }}"
                title="Icon">
                <i class="fas fa-th"></i><span>Icon</span>
            </button>
        </div>
    </div>

    <!-- Sort / filter bar -->
    <div class="sort-bar">
        <div class="filter-chips">
            <span class="chip active"><i class="fas fa-check-circle"></i> Total <span id="resCount" class="fw-bold">{{ $books->total() }}</span> Results</span>
            @if($selectedCategory !== 'all')
                <span class="chip"><i class="fas fa-filter"></i> {{ $selectedCategory }}</span>
            @endif
        </div>
        <div class="sort-wrap">
            <label for="sortSel"><i class="fas fa-sort-amount-down me-1"></i>Order by:</label>
            <select id="sortSel" wire:model.live="sortBy">
                <option value="default">Default</option>
                <option value="title-az">Title A-Z</option>
                <option value="title-za">Title Z-A</option>
                <option value="author">Author A-Z</option>
            </select>
        </div>
    </div>

    <!-- Books container -->
    <div id="booksWrap" class="v-{{ $viewType }}">
        @if($books->count() > 0)
            @foreach ($books as $book)
                @if ($viewType == 'icon')
                    <a class="{{ $viewType }}-item" href="{{ route('books.show', encrypt($book->id)) }}">
                        <div class="{{ $viewType }}-img-wrap">
                            <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}" loading="lazy">
                            <div class="{{ $viewType }}-shine"></div>
                        </div>
                        <abbr class="{{ $viewType }}-link" title="{{ $book->title }}">{{ $book->title }}</abbr>
                        <div class="ia">{{ $book->author_name }}</div>
                    </a>
                @else
                    <div class="list-item align-items-center">
                        <div class="list-thumb">
                            <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}" loading="lazy">
                        </div>
                        <div class="list-info">
                            <h4>{{ $book->title }}</h4>
                            <p class="la">
                                <span><i class="fas fa-user fa-xs me-1"></i>{{ $book->author_name }}</span>
                            </p>
                            <p class="ld">{{ Str::limit($book->description, 150) }}</p>
                            @if($book->categories->count() > 0)
                                <div class="tag-row">
                                    @foreach($book->categories as $category)
                                        <span class="tag">{{ $category->name }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="list-actions">
                            <a class="btn-read-now text-decoration-none" href="{{ route('books.show', encrypt($book->id)) }}">
                                <i class="fas fa-book-reader me-1"></i>Read
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <div class="no-results">
                <i class="fas fa-book"></i>
                <p>No books found in this category</p>
            </div>
        @endif

        {{ $books->links() }}
    </div>
</div>
