<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Panel</title>

    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>

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
        // function setActive(el) {
        //     document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
        //     el.classList.add('active');
        // }

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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @stack('scripts')
</body>
</html>
