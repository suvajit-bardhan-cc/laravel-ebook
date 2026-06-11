<x-app-layout>
    <div class="hero-strip">
        <div class="inner">
            <span class="bc">
                <a href="{{ route('dashboard') }}">{{ config('app.name') }}</a> &rsaquo;
                <a href="{{ route('profile.index') }}">My Profile</a> &rsaquo;
                <span id="bcLabel">Edit Profile</span>
            </span>
        </div>
    </div>

    <div class="page-wrap">
        <main class="content">
            <div class="container-fluid" style="max-width: 600px; margin: 0 auto; padding: 20px;">
                <!-- Header -->
                <div class="mb-5 text-center">
                    <h1 class="h2 fw-bold mb-2">Edit Profile</h1>
                    <p class="text-muted">Update your account information</p>
                </div>

                <!-- Edit Profile Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Full Name -->
                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold">
                                    Full Name <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    placeholder="Enter your full name"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">
                                    Email Address <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="email"
                                    name="email"
                                    value="{{ old('email', $user->email) }}"
                                    placeholder="Enter your email address"
                                    required>
                                @error('email')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="text-muted d-block mt-2">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Use this email to log in to your account
                                </small>
                            </div>

                            <!-- Current Password (for verification) -->
                            <div class="mb-4">
                                <label for="current_password" class="form-label fw-semibold">
                                    Current Password <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="password"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    id="current_password"
                                    name="current_password"
                                    placeholder="Enter your current password"
                                    required>
                                @error('current_password')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="text-muted d-block mt-2">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Required to confirm changes
                                </small>
                            </div>

                            <!-- Divider -->
                            <hr class="my-4">

                            <!-- Change Password Section -->
                            <div class="mb-4">
                                <h6 class="fw-semibold mb-3">Change Password (Optional)</h6>
                                <p class="text-muted small mb-3">Leave blank if you don't want to change your password</p>

                                <!-- New Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold">
                                        New Password
                                    </label>
                                    <input
                                        type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        id="password"
                                        name="password"
                                        placeholder="Enter new password (min. 8 characters)">
                                    @error('password')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label fw-semibold">
                                        Confirm Password
                                    </label>
                                    <input
                                        type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        placeholder="Confirm new password">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Success Message -->
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <!-- Error Messages -->
                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <strong>Please fix the errors below:</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="d-flex gap-2 flex-wrap">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Save Changes
                                </button>
                                <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="fas fa-shield-alt me-2"></i>
                    <strong>Your security is important.</strong>
                    Your password will never be shared and is securely stored.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
