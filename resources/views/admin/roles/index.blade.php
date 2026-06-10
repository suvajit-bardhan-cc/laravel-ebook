<x-admin-layout>
    <div class="max-w-7xl mx-auto space-y-6">

        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Roles Management</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Manage system roles and permissions</p>
            </div>
            <a href="{{ route('admin.roles.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                + Add New Role
            </a>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Total Roles</p>
                        <p class="text-2xl font-bold text-slate-900 dark:text-white mt-1">{{ $roles->count() }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Active Roles</p>
                        <p class="text-2xl font-bold text-slate-900 dark:text-white mt-1">{{ $roles->where('status', 'active')->count() }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Roles Table -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Role Name</th>
                            <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Slug</th>
                            <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Description</th>
                            <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                            <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Created</th>
                            <th class="px-5 py-3 text-right text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        @forelse($roles as $role)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                                <td class="px-5 py-4">
                                    <span class="font-medium text-slate-900 dark:text-white">{{ $role->name }}</span>
                                </td>
                                <td class="px-5 py-4 text-slate-600 dark:text-slate-400">
                                    <code class="text-xs bg-slate-100 dark:bg-slate-900 px-2 py-1 rounded">{{ $role->slug }}</code>
                                </td>
                                <td class="px-5 py-4 text-slate-600 dark:text-slate-400 text-sm">
                                    {{ Str::limit($role->description, 50) }}
                                </td>
                                <td class="px-5 py-4">
                                    @php
                                        $statusColors = [
                                            'active' => 'green',
                                            'inactive' => 'gray',
                                        ];
                                        $color = $statusColors[$role->status] ?? 'gray';
                                    @endphp
                                    <form action="{{ route('admin.roles.update-status', $role) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()"
                                                class="px-2 py-1 text-xs rounded-full cursor-pointer transition-all bg-{{ $color }}-100 dark:bg-{{ $color }}-900/30 text-{{ $color }}-700 dark:text-{{ $color }}-400 border-0">
                                            <option value="active" {{ $role->status === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ $role->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-5 py-4 text-slate-500 dark:text-slate-400 text-sm">
                                    {{ $role->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.roles.show', $role) }}"
                                           class="text-slate-600 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-300 transition-colors">
                                            View
                                        </a>
                                        <a href="{{ route('admin.roles.edit', $role) }}"
                                           class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                                            Edit
                                        </a>
                                        @if(!in_array($role->slug, ['super-admin', 'admin', 'editor', 'user']))
                                            <form action="{{ route('admin.roles.destroy', $role) }}"
                                                  method="POST"
                                                  class="inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this role?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 transition-colors">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-8 text-center text-slate-500 dark:text-slate-400">
                                    No roles found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
