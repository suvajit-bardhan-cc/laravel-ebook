<aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <i class="fas fa-book"></i>
                <div class="logo-text">LibreBooks</div>
            </div>

            <ul class="sidebar-nav">
                <li class="nav-item">
                    <a href="#" class="nav-link active" data-page="dashboard">
                        <i class="fas fa-house"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-page="books">
                        <i class="fas fa-book-open"></i>
                        <span>Books</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-page="categories">
                        <i class="fas fa-layer-group"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-page="users">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-page="bookmarks">
                        <i class="fas fa-bookmark"></i>
                        <span>Bookmarks</span>
                    </a>
                </li>
            </ul>

            <div class="nav-divider"></div>

            <ul class="sidebar-nav">
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
        </ul>
        </aside>