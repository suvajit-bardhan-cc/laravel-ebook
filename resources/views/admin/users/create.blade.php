<x-admin-layout>
    <div class="max-w-4xl mx-auto space-y-6">
        
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Create New User</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Add a new user to the system</p>
            </div>
            <a href="{{ route('admin.users.index') }}" 
               class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                ← Back to Users
            </a>
        </div>

        <!-- Create User Form -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6" id="createUserForm">
                @csrf
                
                <!-- Form Body -->
                <div class="px-6 py-6 space-y-6">
                    
                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name"
                               value="{{ old('name') }}"
                               placeholder="Enter full name"
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
                               value="{{ old('email') }}"
                               placeholder="Enter email address"
                               class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" 
                               name="password" 
                               id="password"
                               placeholder="Enter password (min 8 characters)"
                               class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Password must be at least 8 characters</p>
                    </div>

                    <!-- Confirm Password Field -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Confirm Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" 
                               name="password_confirmation" 
                               id="password_confirmation"
                               placeholder="Confirm password"
                               class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- User Type Field -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            User Type <span class="text-red-500">*</span>
                        </label>
                        <select name="type" 
                                id="type"
                                class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('type') border-red-500 @enderror">
                            <option value="0" {{ old('type') == '0' ? 'selected' : '' }}>Regular User</option>
                            <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Administrator</option>
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
                                class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="banned" {{ old('status') == 'banned' ? 'selected' : '' }}>Banned</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Verification -->
                    <div>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" 
                                   name="email_verified" 
                                   id="email_verified"
                                   value="1"
                                   {{ old('email_verified') ? 'checked' : '' }}
                                   class="w-4 h-4 text-blue-600 focus:ring-blue-500 rounded">
                            <span class="text-sm text-slate-700 dark:text-slate-300">
                                Mark email as verified
                            </span>
                        </label>
                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400 ml-7">
                            If checked, the user won't need to verify their email address
                        </p>
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
                        Create User
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Box -->
        {{-- <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4">
            <div class="flex gap-3">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div class="text-sm text-blue-800 dark:text-blue-300">
                    <p class="font-medium mb-1">Important Information</p>
                    <p class="text-xs">New users will receive a welcome email with their login credentials. You can always edit user details later.</p>
                </div>
            </div>
        </div> --}}
    </div>

    @push('scripts')
    <script>
        // Optional: Add password strength indicator
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('password_confirmation');
        
        function checkPasswordStrength() {
            const password = passwordInput.value;
            const strengthIndicator = document.getElementById('passwordStrength');
            
            if (!strengthIndicator) return;
            
            let strength = 0;
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]+/)) strength++;
            if (password.match(/[A-Z]+/)) strength++;
            if (password.match(/[0-9]+/)) strength++;
            if (password.match(/[$@#&!]+/)) strength++;
            
            if (password.length === 0) {
                strengthIndicator.textContent = '';
                strengthIndicator.className = '';
            } else if (strength <= 2) {
                strengthIndicator.textContent = 'Weak password';
                strengthIndicator.className = 'text-red-500 text-xs mt-1';
            } else if (strength <= 4) {
                strengthIndicator.textContent = 'Medium password';
                strengthIndicator.className = 'text-yellow-500 text-xs mt-1';
            } else {
                strengthIndicator.textContent = 'Strong password';
                strengthIndicator.className = 'text-green-500 text-xs mt-1';
            }
        }
        
        if (passwordInput) {
            passwordInput.addEventListener('input', checkPasswordStrength);
        }
    </script>
    @endpush
</x-admin-layout>