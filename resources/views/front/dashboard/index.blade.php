<x-app-layout>
    <div class="hero-strip">
        <div class="inner">
            <span class="bc">
                <a href="{{ route('dashboard') }}">{{ config('app.name') }}</a> &rsaquo; <span id="bcLabel">{{ $books->total() }} {{ config('app.name') }}</span>
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
                                <a href="#" data-cat="all" onclick="selectCategory(event, 'all')" class="cat-link active">
                                    All Books <span class="cnt">{{ $books->total() }}</span>
                                </a>
                            </li>

                            @if($popularCategories->count() > 0)
                                @foreach($popularCategories as $category)
                                    <li>
                                        <a href="#" data-cat="{{ $category->name }}" onclick="selectCategory(event, '{{ $category->name }}')" class="cat-link">
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
                                    <a href="#" data-cat="{{ $category->name }}" onclick="selectCategory(event, '{{ $category->name }}')" class="cat-link">
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
            <!-- Livewire Books Component -->
            @livewire('dashboard-books')
        </main>
    </div>

    <script>
        function selectCategory(event, category) {
            event.preventDefault();

            // Update active state in sidebar
            document.querySelectorAll('.cat-link').forEach(link => {
                link.classList.remove('active');
            });
            event.target.closest('a').classList.add('active');

            // Dispatch Livewire event to update the books component
            Livewire.dispatch('selectCategory', { category: category });
        }
    </script>
</x-app-layout>