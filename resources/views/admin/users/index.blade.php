<x-admin-layout>
    <div class="max-w-7xl mx-auto space-y-6">
        
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Users Management</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Manage and filter all registered users</p>
            </div>
            <a href="{{ route('admin.users.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                + Add New User
            </a>
        </div>

        <!-- Filters Section -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Filters</h3>
            </div>
            <div class="px-5 py-4">
                <form method="GET" action="{{ route('admin.users.index') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Search -->
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Search</label>
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Name or email..."
                                   class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Status Filter -->
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Status</label>
                            <select name="status" 
                                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500">
                                <option value="">All Status</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date From -->
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Date From</label>
                            <input type="date" 
                                   name="date_from" 
                                   value="{{ request('date_from') }}"
                                   class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Date To -->
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Date To</label>
                            <input type="date" 
                                   name="date_to" 
                                   value="{{ request('date_to') }}"
                                   class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Sort By -->
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Sort By</label>
                            <select name="sort" 
                                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500">
                                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                                <option value="email" {{ request('sort') == 'email' ? 'selected' : '' }}>Email</option>
                                <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Date Registered</option>
                                <option value="updated_at" {{ request('sort') == 'updated_at' ? 'selected' : '' }}>Last Updated</option>
                            </select>
                        </div>

                        <!-- Direction -->
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1">Direction</label>
                            <select name="direction" 
                                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500">
                                <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                                <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.users.index') }}" 
                           class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                            Clear Filters
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                            Apply Filters
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Users Table -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">User</th>
                            <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Email</th>
                            <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                            <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Joined</th>
                            <th class="px-5 py-3 text-right text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        @forelse($users as $user)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-sm font-medium">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <span class="font-medium text-slate-900 dark:text-white">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-slate-600 dark:text-slate-400">{{ $user->email }}</td>
                                <td class="px-5 py-4">
                                    @php
                                        $statusColors = [
                                            'active' => 'green',
                                            'inactive' => 'gray',
                                            'banned' => 'red',
                                            'pending' => 'yellow'
                                        ];
                                        $color = $statusColors[$user->status] ?? 'gray';
                                    @endphp
                                    <span class="px-2 py-1 text-xs rounded-full bg-{{ $color }}-100 dark:bg-{{ $color }}-900/30 text-{{ $color }}-700 dark:text-{{ $color }}-400">
                                        {{ ucfirst($user->status ?? 'Active') }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-slate-500 dark:text-slate-400 text-sm">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.users.edit', $user) }}" 
                                           class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('Are you sure you want to delete this user?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 transition-colors">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-8 text-center text-slate-500 dark:text-slate-400">
                                    No users found matching your criteria.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-5 py-4 border-t border-slate-100 dark:border-slate-700">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>