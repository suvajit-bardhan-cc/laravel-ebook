<x-admin-layout>
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $role->name }} Role</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">View role details and permissions</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.roles.edit', $role) }}"
                   class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                    Edit Role
                </a>
                <a href="{{ route('admin.roles.index') }}"
                   class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                    ← Back
                </a>
            </div>
        </div>

        <!-- Role Details -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Main Info -->
            <div class="md:col-span-2 space-y-6">
                <!-- Basic Info -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Basic Information</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Role Name</p>
                            <p class="text-slate-900 dark:text-white font-medium">{{ $role->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Slug</p>
                            <code class="text-slate-900 dark:text-white bg-slate-100 dark:bg-slate-900 px-2 py-1 rounded text-sm">{{ $role->slug }}</code>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Status</p>
                            @php
                                $statusColors = [
                                    'active' => ['bg' => 'bg-green-100 dark:bg-green-900/30', 'text' => 'text-green-700 dark:text-green-400'],
                                    'inactive' => ['bg' => 'bg-gray-100 dark:bg-gray-900/30', 'text' => 'text-gray-700 dark:text-gray-400'],
                                ];
                                $colors = $statusColors[$role->status] ?? $statusColors['inactive'];
                            @endphp
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-medium {{ $colors['bg'] }} {{ $colors['text'] }}">
                                {{ ucfirst($role->status) }}
                            </span>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Description</p>
                            <p class="text-slate-700 dark:text-slate-300">{{ $role->description ?: 'No description provided' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Permissions -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Permissions ({{ $role->permissions->count() }})</h3>
                    @if($role->permissions->isNotEmpty())
                        <div class="space-y-3">
                            @php $groupedPermissions = $role->permissions->groupBy('module') @endphp
                            @foreach($groupedPermissions as $module => $permissions)
                                <div>
                                    <p class="text-sm font-medium text-slate-700 dark:text-slate-300 mb-2 capitalize">{{ $module ?? 'General' }}</p>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        @foreach($permissions as $permission)
                                            <div class="flex items-center gap-2 p-2 bg-slate-50 dark:bg-slate-900/50 rounded">
                                                <svg class="w-4 h-4 text-green-600 dark:text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                                <div class="flex-1">
                                                    <p class="text-sm text-slate-700 dark:text-slate-300 font-medium">{{ $permission->name }}</p>
                                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $permission->slug }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-slate-500 dark:text-slate-400">No permissions assigned to this role</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Metadata -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Metadata</h3>
                    <div class="space-y-4 text-sm">
                        <div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Created</p>
                            <p class="text-slate-700 dark:text-slate-300">{{ $role->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Last Updated</p>
                            <p class="text-slate-700 dark:text-slate-300">{{ $role->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                @if(!in_array($role->slug, ['super-admin', 'admin', 'editor', 'user']))
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Actions</h3>
                    <form action="{{ route('admin.roles.destroy', $role) }}"
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this role?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-colors">
                            Delete Role
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
