<x-admin-layout>
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Create New Role</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Add a new role to the system</p>
            </div>
            <a href="{{ route('admin.roles.index') }}"
               class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                ← Back to Roles
            </a>
        </div>

        <!-- Create Role Form -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
            <form action="{{ route('admin.roles.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Form Body -->
                <div class="px-6 py-6 space-y-6">

                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Role Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name') }}"
                               placeholder="Enter role name (e.g., Manager, Editor)"
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
                               value="{{ old('slug') }}"
                               placeholder="Enter slug (e.g., manager, editor)"
                               class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('slug') border-red-500 @enderror">
                        @error('slug')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Unique identifier for the role (lowercase, hyphens only)</p>
                    </div>

                    <!-- Description Field -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Description
                        </label>
                        <textarea name="description"
                                  id="description"
                                  rows="4"
                                  placeholder="Describe the purpose and responsibilities of this role"
                                  class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Field -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status"
                                id="status"
                                class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror">
                            <option value="">Select Status</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Permissions Section -->
                    <div class="pt-4 border-t border-slate-200 dark:border-slate-700">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-4">
                            Permissions
                        </label>
                        @error('permissions')
                            <p class="mb-3 text-xs text-red-500">{{ $message }}</p>
                        @enderror

                        <div class="space-y-4">
                            @forelse($permissions as $module => $modulePermissions)
                                <div class="border border-slate-200 dark:border-slate-700 rounded-lg p-4">
                                    <div class="flex items-center gap-2 mb-3">
                                        <input type="checkbox"
                                               class="module-checkbox w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                                               data-module="{{ $module }}"
                                               onchange="toggleModule(this)">
                                        <label class="text-sm font-semibold text-slate-900 dark:text-white capitalize">
                                            {{ $module }}
                                        </label>
                                        <span class="text-xs text-slate-500 dark:text-slate-400">
                                            ({{ $modulePermissions->count() }} permissions)
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 ml-6">
                                        @foreach($modulePermissions as $permission)
                                            <label class="flex items-start gap-3 p-3 rounded-lg border border-slate-100 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors cursor-pointer">
                                                <input type="checkbox"
                                                       name="permissions[]"
                                                       value="{{ $permission->id }}"
                                                       class="mt-1 w-4 h-4 text-blue-600 rounded focus:ring-blue-500 permission-checkbox"
                                                       data-module="{{ $module }}"
                                                       {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
                                                <div class="flex-1">
                                                    <p class="text-sm font-medium text-slate-900 dark:text-white">
                                                        {{ $permission->name }}
                                                    </p>
                                                    <p class="text-xs text-slate-500 dark:text-slate-400">
                                                        {{ $permission->slug }}
                                                    </p>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <p class="text-slate-500 dark:text-slate-400">No permissions available</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Form Footer -->
                <div class="px-6 py-4 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-200 dark:border-slate-700 flex justify-end gap-3">
                    <a href="{{ route('admin.roles.index') }}"
                       class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                        Create Role
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleModule(checkbox) {
            const module = checkbox.getAttribute('data-module');
            const moduleCheckboxes = document.querySelectorAll(`.permission-checkbox[data-module="${module}"]`);
            moduleCheckboxes.forEach(cb => {
                cb.checked = checkbox.checked;
            });
        }

        // Update module checkbox state when individual permissions change
        document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const module = this.getAttribute('data-module');
                const moduleCheckboxes = document.querySelectorAll(`.permission-checkbox[data-module="${module}"]`);
                const allChecked = Array.from(moduleCheckboxes).every(cb => cb.checked);
                const someChecked = Array.from(moduleCheckboxes).some(cb => cb.checked);

                const moduleCheckbox = document.querySelector(`.module-checkbox[data-module="${module}"]`);
                if (moduleCheckbox) {
                    moduleCheckbox.checked = allChecked;
                    moduleCheckbox.indeterminate = someChecked && !allChecked;
                }
            });
        });

        // Set initial state for module checkboxes
        document.querySelectorAll('.module-checkbox').forEach(checkbox => {
            const module = checkbox.getAttribute('data-module');
            const moduleCheckboxes = document.querySelectorAll(`.permission-checkbox[data-module="${module}"]`);
            const allChecked = Array.from(moduleCheckboxes).every(cb => cb.checked);
            const someChecked = Array.from(moduleCheckboxes).some(cb => cb.checked);
            checkbox.checked = allChecked;
            checkbox.indeterminate = someChecked && !allChecked;
        });
    </script>
    @endpush
</x-admin-layout>
