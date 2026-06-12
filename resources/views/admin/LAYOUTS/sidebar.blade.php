<aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-30 w-64 flex flex-col
        bg-white dark:bg-slate-800 border-r border-slate-200 dark:border-slate-700
        -translate-x-full lg:translate-x-0 transition-transform duration-200">

    <!-- Logo -->
    <div class="flex items-center gap-2.5 px-5 h-16 border-b border-slate-200 dark:border-slate-700 shrink-0">
        {{-- <span class="font-semibold text-slate-900 dark:text-white text-sm tracking-tight">AdminBase</span> --}}
         <img src="{{ asset('images/logo.png') }}" alt="Logo" class="dark:brightness-0 dark:invert">
    </div>

    <!-- Nav links -->
    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5">

        <!-- Link 1: Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link @if(request()->routeIs('admin.dashboard')) active @endif">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Dashboard
        </a>

        <!-- Link 2: Users -->
        <a href="{{ route('admin.users.index') }}" class="sidebar-link @if(request()->routeIs('admin.users.*')) active @endif">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 20h5v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h5M12 12a4 4 0 100-8 4 4 0 000 8z"/>
            </svg>
            Users
        </a>

        <!-- Link 2: Books -->
        <a href="{{ route('admin.books.index') }}"
        class="sidebar-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            Books
        </a>

        <!-- Link 2: Categories -->
        <a href="{{ route('admin.categories.index') }}"
        class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"/>
            </svg>
            Categories
        </a>

        <!-- Dropdown: Settings -->
        <div>
            <button onclick="toggleDropdown()" id="dropdownBtn"
            class="sidebar-link w-full justify-between group">
            <span class="flex items-center gap-3">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Settings
            </span>
            <svg id="dropdownChevron" class="w-4 h-4 transition-transform duration-200"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
            </button>

            <div id="dropdownMenu" class="hidden mt-0.5 ml-3 pl-4 border-l border-slate-200 dark:border-slate-700 space-y-0.5">
            <a href="#" class="sidebar-link text-xs">General</a>
            <a href="#" class="sidebar-link text-xs">Security</a>
            <a href="#" class="sidebar-link text-xs">Notifications</a>
            </div>
        </div>
    </nav>

    <!-- Profile at bottom -->
    <div class="px-3 py-4 border-t border-slate-200 dark:border-slate-700 shrink-0">
        <div class="flex items-center gap-3 px-2">
            <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center text-white text-xs font-semibold shrink-0">
            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
            <div class="min-w-0">
                <p class="text-sm font-medium text-slate-900 dark:text-white truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-slate-400 truncate">{{ auth()->user()->email }}</p>
            </div>
        </div>
    </div>
</aside>
