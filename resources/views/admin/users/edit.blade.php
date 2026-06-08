<x-admin-layout>
    <div class="max-w-4xl mx-auto space-y-6">
        
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Edit User</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Update user information</p>
            </div>
            <a href="{{ route('admin.users.index') }}" 
               class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                ← Back to Users
            </a>
        </div>

        <!-- Edit User Form -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="px-6 py-6 space-y-6">
                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name"
                               value="{{ old('name', $user->name) }}"
                               class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                               name="email" 
                               id="email"
                               value="{{ old('email', $user->email) }}"
                               class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field (Optional) -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            New Password <span class="text-xs text-slate-500">(Leave blank to keep current)</span>
                        </label>
                        <input type="password" 
                               name="password" 
                               id="password"
                               placeholder="Enter new password"
                               class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('password')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- User Type Field -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            User Type <span class="text-red-500">*</span>
                        </label>
                        <select name="type" 
                                id="type"
                                class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="0" {{ old('type', $user->type) == 0 ? 'selected' : '' }}>Regular User</option>
                            <option value="1" {{ old('type', $user->type) == 1 ? 'selected' : '' }}>Administrator</option>
                        </select>
                        @error('type')
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
                                class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="pending" {{ old('status', $user->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="banned" {{ old('status', $user->status) == 'banned' ? 'selected' : '' }}>Banned</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Footer -->
                <div class="px-6 py-4 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-200 dark:border-slate-700 flex justify-end gap-3">
                    <a href="{{ route('admin.users.index') }}" 
                       class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>