<x-app-layout>
    <div class="hero-strip">
        <div class="inner">
            <span class="bc">
                <a href="{{ route('dashboard') }}">{{ config('app.name') }}</a> &rsaquo; <span id="bcLabel">My Profile</span>
            </span>
        </div>
    </div>

    <div class="page-wrap">
        <main class="content">
            <div class="container-fluid" style="max-width: 800px; margin: 0 auto; padding: 20px;">
                <!-- Header -->
                <div class="mb-5 text-center">
                    <h1 class="h2 fw-bold mb-2">My Profile</h1>
                    <p class="text-muted">View and manage your account information</p>
                </div>

                <!-- Profile Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <!-- User Avatar & Basic Info -->
                        <div class="d-flex align-items-center gap-4 mb-5 pb-5 border-bottom">
                            <div class="flex-shrink-0">
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                    <i class="fas fa-user text-white" style="font-size: 40px;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h3 class="h5 mb-1 fw-bold">{{ $user->name }}</h3>
                                <p class="text-muted mb-0 small">{{ $user->email }}</p>
                                <p class="text-muted mb-0 small">
                                    <span class="badge bg-success">Active</span>
                                </p>
                            </div>
                        </div>

                        <!-- Account Details -->
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-semibold text-uppercase">Full Name</label>
                                    <p class="mb-0 fw-500">{{ $user->name }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-semibold text-uppercase">Email Address</label>
                                    <p class="mb-0 fw-500">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-semibold text-uppercase">Account Status</label>
                                    <p class="mb-0">
                                        @if($user->status === 'active')
                                            <span class="badge bg-success">Active</span>
                                        @elseif($user->status === 'inactive')
                                            <span class="badge bg-secondary">Inactive</span>
                                        @elseif($user->status === 'banned')
                                            <span class="badge bg-danger">Banned</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-semibold text-uppercase">Member Since</label>
                                    <p class="mb-0 fw-500">{{ $user->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2 flex-wrap">
                            @if(Route::has('profile.edit'))
                                <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit me-2"></i>Edit Profile
                                </a>
                            @endif
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-arrow-left me-2"></i>Back to Books
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <a href="{{ route('bookmarks.index') }}" class="card border-0 shadow-sm text-decoration-none text-dark h-100 transition" style="transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 .75rem 1.5rem rgba(0,0,0,.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 .125rem .25rem rgba(0,0,0,.075)'">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-bookmark text-primary mb-3" style="font-size: 28px; display: block;"></i>
                                <h6 class="card-title mb-1 fw-bold">My Bookmarks</h6>
                                <p class="card-text text-muted small mb-0">View your saved books</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('dashboard') }}" class="card border-0 shadow-sm text-decoration-none text-dark h-100 transition" style="transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 .75rem 1.5rem rgba(0,0,0,.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 .125rem .25rem rgba(0,0,0,.075)'">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-book text-success mb-3" style="font-size: 28px; display: block;"></i>
                                <h6 class="card-title mb-1 fw-bold">Browse Books</h6>
                                <p class="card-text text-muted small mb-0">Explore our collection</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
