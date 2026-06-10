<x-admin-layout>
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $permission->name }}</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">View permission details and role assignments</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.permissions.edit', $permission) }}"
                   class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                    Edit Permission
                </a>
                <a href="{{ route('admin.permissions.index') }}"
                   class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                    ← Back
                </a>
            </div>
        </div>

        <!-- Permission Details -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Main Info -->
            <div class="md:col-span-2 space-y-6">
                <!-- Basic Info -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Basic Information</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Permission Name</p>
                            <p class="text-slate-900 dark:text-white font-medium">{{ $permission->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Slug</p>
                            <code class="text-slate-900 dark:text-white bg-slate-100 dark:bg-slate-900 px-2 py-1 rounded text-sm">{{ $permission->slug }}</code>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Module</p>
                            <p class="text-slate-900 dark:text-white font-medium capitalize">{{ $permission->module ?? 'General' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Description</p>
                            <p class="text-slate-700 dark:text-slate-300">{{ $permission->description ?: 'No description provided' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Roles -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Assigned to Roles ({{ $permission->roles->count() }})</h3>
                    @if($permission->roles->isNotEmpty())
                        <div class="space-y-3">
                            @foreach($permission->roles as $role)
                                <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-900/50 rounded-lg border border-slate-100 dark:border-slate-700">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-900 dark:text-white">{{ $role->name }}</p>
                                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ $role->slug }}</p>
                                        </div>
                                    </div>
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-medium bg-{{ $role->status === 'active' ? 'green' : 'gray' }}-100 dark:bg-{{ $role->status === 'active' ? 'green' : 'gray' }}-900/30 text-{{ $role->status === 'active' ? 'green' : 'gray' }}-700 dark:text-{{ $role->status === 'active' ? 'green' : 'gray' }}-400">
                                        {{ ucfirst($role->status) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-slate-500 dark:text-slate-400">This permission is not assigned to any role</p>
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
                            <p class="text-slate-700 dark:text-slate-300">{{ $permission->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Last Updated</p>
                            <p class="text-slate-700 dark:text-slate-300">{{ $permission->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Actions</h3>
                    <form action="{{ route('admin.permissions.destroy', $permission) }}"
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this permission?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-colors">
                            Delete Permission
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
