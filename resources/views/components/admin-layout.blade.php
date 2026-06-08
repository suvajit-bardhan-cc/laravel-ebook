<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Panel</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
        darkMode: 'class',
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>
    <style>
        * { font-family: 'DM Sans', sans-serif; }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: background-color 0.15s, color 0.15s;
            color: #475569;
            text-decoration: none;
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            cursor: pointer;
        }
        .sidebar-link:hover {
            background-color: #f1f5f9;
            color: #0f172a;
        }
        .sidebar-link.active {
            background-color: #eef2ff;
            color: #4f46e5;
        }

        /* Dark mode overrides */
        html.dark .sidebar-link { color: #94a3b8; }
        html.dark .sidebar-link:hover { background-color: #334155; color: #f8fafc; }
        html.dark .sidebar-link.active { background-color: rgba(79,70,229,0.25); color: #818cf8; }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            color: #374151;
            text-decoration: none;
            transition: background-color 0.15s;
        }
        .dropdown-item:hover { background-color: #f1f5f9; }
        html.dark .dropdown-item { color: #e2e8f0; }
        html.dark .dropdown-item:hover { background-color: #334155; }
    </style>
</head>
<body class="bg-slate-100 dark:bg-slate-900 text-slate-700 dark:text-slate-300 transition-colors duration-200">
    <div class="flex h-screen overflow-hidden">

        <div id="sidebarBackdrop" onclick="closeSidebar()" class="fixed inset-0 bg-black/40 z-20 hidden lg:hidden"></div>

        <!-- ===== SIDEBAR ===== -->
        @include('admin.LAYOUTS.sidebar')

        <!-- ===== MAIN AREA ===== -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            <!-- ===== HEADER ===== -->
            @include('admin.LAYOUTS.header')

            <!-- ===== PAGE CONTENT ===== -->
            <main class="flex-1 overflow-y-auto p-4 lg:p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        /* ---- Sidebar (mobile) ---- */
        function openSidebar() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            document.getElementById('sidebarBackdrop').classList.remove('hidden');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebarBackdrop').classList.add('hidden');
        }

        /* ---- Sidebar dropdown ---- */
        function toggleDropdown() {
            const menu = document.getElementById('dropdownMenu');
            const chevron = document.getElementById('dropdownChevron');
            menu.classList.toggle('hidden');
            chevron.classList.toggle('rotate-180');
        }

        /* ---- Active link ---- */
        function setActive(el) {
            document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
            el.classList.add('active');
        }

        /* ---- Header profile dropdown ---- */
        function toggleProfileMenu() {
            document.getElementById('profileMenu').classList.toggle('hidden');
        }
        document.addEventListener('click', function(e) {
            const btn = document.getElementById('profileBtn');
            const menu = document.getElementById('profileMenu');
            if (!btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
            }
        });

        /* ---- Dark / Light theme ---- */
        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            document.getElementById('sunIcon').classList.toggle('hidden', !isDark);
            document.getElementById('moonIcon').classList.toggle('hidden', isDark);
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }

        // Init theme from storage
        (function() {
            const saved = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (saved === 'dark' || (!saved && prefersDark)) {
            document.documentElement.classList.add('dark');
            document.getElementById('sunIcon').classList.remove('hidden');
            document.getElementById('moonIcon').classList.add('hidden');
            }
        })();
    </script>
</body>
</html>