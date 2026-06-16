<x-admin-layout>
    <div class="max-w-7xl mx-auto space-y-6">

        <!-- Welcome Banner -->
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 dark:from-blue-600 dark:to-indigo-700 rounded-2xl p-6 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-2xl font-bold">Welcome back, {{ auth()->user()->name }}! 👋</h2>
                    <p class="text-blue-100 mt-1">Here's what's happening in your e-book platform today.</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-blue-100">Last updated: {{ now()->format('M d, Y H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Main Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Users -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide">Total Users</p>
                        <p class="text-3xl font-bold text-slate-900 dark:text-white mt-2">{{ $totalUsers }}</p>
                        <p class="text-xs text-emerald-500 mt-2">{{ $activeUsers }} active</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM4 20h16a2 2 0 002-2v-2a3 3 0 00-5.856-1.487M9 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Books -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide">Total Books</p>
                        <p class="text-3xl font-bold text-slate-900 dark:text-white mt-2">{{ $totalBooks }}</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">Available</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Categories -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide">Categories</p>
                        <p class="text-3xl font-bold text-slate-900 dark:text-white mt-2">{{ $totalCategories }}</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">Active</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Users by Role -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700 hover:shadow-lg transition-shadow">
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide">Role Distribution</p>
                    <div class="mt-4 space-y-2">
                        @forelse($usersByRole->take(3) as $role)
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-700 dark:text-slate-300">{{ $role->name }}</span>
                                <span class="font-semibold text-slate-900 dark:text-white">{{ $role->users_count }}</span>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500">No roles found</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Books by Category Chart -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Books by Category</h3>
                </div>
                <div class="p-6">
                    @if($booksByCategory->count() > 0)
                        <div class="space-y-3">
                            @foreach($booksByCategory as $category)
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $category->name }}</span>
                                        <span class="text-sm font-semibold text-slate-900 dark:text-white">{{ $category->books_count }}</span>
                                    </div>
                                    <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2">
                                        @php
                                            $maxBooks = $booksByCategory->max('books_count');
                                            $percentage = $maxBooks > 0 ? ($category->books_count / $maxBooks) * 100 : 0;
                                        @endphp
                                        <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-slate-500 text-sm">No categories found</p>
                    @endif
                </div>
            </div>

            <!-- Books by Language Chart -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Books by Language</h3>
                </div>
                <div class="p-6">
                    @if($booksByLanguage->count() > 0)
                        <div class="space-y-3">
                            @foreach($booksByLanguage as $language)
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                            {{ ucfirst($language->language) }}
                                        </span>
                                        <span class="text-sm font-semibold text-slate-900 dark:text-white">{{ $language->count }}</span>
                                    </div>
                                    <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2">
                                        @php
                                            $maxLang = $booksByLanguage->max('count');
                                            $percentage = $maxLang > 0 ? ($language->count / $maxLang) * 100 : 0;
                                        @endphp
                                        <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-slate-500 text-sm">No books found</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Users -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Recent Users</h3>
                    <a href="{{ route('admin.users.index') }}" class="text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">View all</a>
                </div>
                <div class="divide-y divide-slate-100 dark:divide-slate-700">
                    @forelse($recentUsers as $user)
                        <div class="px-6 py-4 flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-sm font-semibold shrink-0">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-slate-900 dark:text-white truncate">{{ $user->name }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400 truncate">{{ $user->email }}</p>
                            </div>
                            <div class="text-right shrink-0">
                                <p class="text-xs text-slate-500 dark:text-slate-400">{{ $user->created_at->diffForHumans() }}</p>
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $user->status === 'active' ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400' : 'bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-8">
                            <p class="text-slate-500 text-sm text-center">No users found</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Books -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Recent Books</h3>
                    <a href="{{ route('admin.books.index') }}" class="text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">View all</a>
                </div>
                <div class="divide-y divide-slate-100 dark:divide-slate-700">
                    @forelse($recentBooks as $book)
                        <div class="px-6 py-4 flex items-center gap-4">
                            <div class="w-10 h-10 rounded bg-slate-200 dark:bg-slate-700 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-slate-500 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-slate-900 dark:text-white truncate">{{ $book->title }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400 truncate">{{ $book->author_name }}</p>
                            </div>
                            <div class="text-right shrink-0">
                                <p class="text-xs text-slate-500 dark:text-slate-400">{{ $book->created_at->diffForHumans() }}</p>
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400">
                                    {{ ucfirst($book->language) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-8">
                            <p class="text-slate-500 text-sm text-center">No books found</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>
