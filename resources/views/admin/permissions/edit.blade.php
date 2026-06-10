<x-admin-layout>
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Permission</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Update permission details</p>
            </div>
            <a href="{{ route('admin.permissions.index') }}"
               class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                ← Back to Permissions
            </a>
        </div>

        <!-- Edit Permission Form -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
            <form action="{{ route('admin.permissions.update', $permission) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Form Body -->
                <div class="px-6 py-6 space-y-6">

                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Permission Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name', $permission->name) }}"
                               placeholder="Enter permission name"
                               class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug Field -->
                    <div>
                        <label for="slug" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Slug <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="slug"
                               id="slug"
                               value="{{ old('slug', $permission->slug) }}"
                               placeholder="Enter slug"
                               class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('slug') border-red-500 @enderror">
                        @error('slug')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Unique identifier for the permission (lowercase, hyphens only)</p>
                    </div>

                    <!-- Module Field -->
                    <div>
                        <label for="module" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Module
                        </label>
                        <input type="text"
                               name="module"
                               id="module"
                               value="{{ old('module', $permission->module) }}"
                               placeholder="Enter module"
                               class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('module') border-red-500 @enderror">
                        @error('module')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description Field -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Description
                        </label>
                        <textarea name="description"
                                  id="description"
                                  rows="4"
                                  placeholder="Describe what this permission allows"
                                  class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description', $permission->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Roles Section -->
                    @if($permission->roles->isNotEmpty())
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-3">
                            Assigned to Roles
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            @foreach($permission->roles as $role)
                                <div class="flex items-center gap-2 p-2 bg-slate-50 dark:bg-slate-900/50 rounded">
                                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                    <span class="text-sm text-slate-700 dark:text-slate-300">{{ $role->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Form Footer -->
                <div class="px-6 py-4 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-200 dark:border-slate-700 flex justify-end gap-3">
                    <a href="{{ route('admin.permissions.index') }}"
                       class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                        Update Permission
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
