<x-admin-layout>
    <div class="max-w-7xl mx-auto space-y-6">

        <!-- Welcome banner -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-200 dark:border-slate-700">
        <h2 class="text-base font-semibold text-slate-900 dark:text-white">Welcome back, Suvajit 👋</h2>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-0.5">Here's what's happening in your workspace today.</p>
        </div>

        <!-- Stat cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-4 border border-slate-200 dark:border-slate-700">
            <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Users</p>
            <p class="text-2xl font-semibold text-slate-900 dark:text-white mt-1">2,841</p>
            <p class="text-xs text-emerald-500 mt-1">↑ 12% this week</p>
        </div>
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-4 border border-slate-200 dark:border-slate-700">
            <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Revenue</p>
            <p class="text-2xl font-semibold text-slate-900 dark:text-white mt-1">$18.4k</p>
            <p class="text-xs text-emerald-500 mt-1">↑ 8% this month</p>
        </div>
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-4 border border-slate-200 dark:border-slate-700">
            <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Orders</p>
            <p class="text-2xl font-semibold text-slate-900 dark:text-white mt-1">634</p>
            <p class="text-xs text-red-400 mt-1">↓ 3% this week</p>
        </div>
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-4 border border-slate-200 dark:border-slate-700">
            <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Sessions</p>
            <p class="text-2xl font-semibold text-slate-900 dark:text-white mt-1">9,210</p>
            <p class="text-xs text-emerald-500 mt-1">↑ 5% today</p>
        </div>
        </div>

        <!-- Recent activity placeholder -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
            <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Recent Activity</h3>
        </div>
        <div class="divide-y divide-slate-100 dark:divide-slate-700">
            <div class="px-5 py-3.5 flex items-center gap-3">
            <div class="w-7 h-7 rounded-full bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center shrink-0">
                <svg class="w-3.5 h-3.5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10z" clip-rule="evenodd"/></svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm text-slate-700 dark:text-slate-300 truncate">New user <span class="font-medium text-slate-900 dark:text-white">Rahul Sharma</span> registered</p>
            </div>
            <span class="text-xs text-slate-400 shrink-0">2m ago</span>
            </div>
            <div class="px-5 py-3.5 flex items-center gap-3">
            <div class="w-7 h-7 rounded-full bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center shrink-0">
                <svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4z" clip-rule="evenodd"/></svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm text-slate-700 dark:text-slate-300 truncate">Payment of <span class="font-medium text-slate-900 dark:text-white">$1,240</span> received</p>
            </div>
            <span class="text-xs text-slate-400 shrink-0">18m ago</span>
            </div>
            <div class="px-5 py-3.5 flex items-center gap-3">
            <div class="w-7 h-7 rounded-full bg-amber-100 dark:bg-amber-900/40 flex items-center justify-center shrink-0">
                <svg class="w-3.5 h-3.5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92z" clip-rule="evenodd"/></svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm text-slate-700 dark:text-slate-300 truncate">Server CPU usage reached <span class="font-medium text-amber-500">78%</span></p>
            </div>
            <span class="text-xs text-slate-400 shrink-0">1h ago</span>
            </div>
        </div>
        </div>

    </div>
</x-admin-layout>
