<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - LibreBooks</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
   
    <link rel="stylesheet" href="{{ asset('css/admindashboard.css') }}">
    
</head>
<body>
    <div class="container-wrapper">
        <!-- Sidebar -->
        @include('admin.dashboard.sidebar')

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Navigation -->
            @include('admin.dashboard.header')
            <!-- Main Section -->
            <section class="main-section">
                <!-- Page Header -->
                <div class="page-header">
                    <h1 class="page-title">Dashboard</h1>
                    <p class="page-subtitle">Welcome back! Here's your library performance overview.</p>
                </div>

                <!-- Stats Grid -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-label">Total Books</div>
                        <div class="stat-value">1,284</div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> 12.5% from last month
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-label">Active Users</div>
                        <div class="stat-value">456</div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> 8.2% from last month
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-label">Total Reads</div>
                        <div class="stat-value">12,584</div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> 24.1% from last month
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-label">Bookmarks</div>
                        <div class="stat-value">3,847</div>
                        <div class="stat-change negative">
                            <i class="fas fa-arrow-down"></i> 3.1% from last month
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-bookmark"></i>
                        </div>
                    </div>
                </div>

                <!-- Recent Books Section -->
                <div class="section-title">
                    <i class="fas fa-fire"></i>
                    Recent Books
                </div>

                <div class="table-container">
                    <div class="table-header">
                        <div>4 new books added this week</div>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Add Book
                        </button>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Views</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>The Art of Code</strong></td>
                                <td>Sarah Johnson</td>
                                <td>Technology</td>
                                <td><span class="badge badge-success">Published</span></td>
                                <td>2,345</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-sm" title="Edit">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button class="btn-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Digital Renaissance</strong></td>
                                <td>Michael Chen</td>
                                <td>Business</td>
                                <td><span class="badge badge-success">Published</span></td>
                                <td>1,856</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-sm" title="Edit">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button class="btn-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Mindful Moments</strong></td>
                                <td>Emma Wilson</td>
                                <td>Self-Help</td>
                                <td><span class="badge badge-warning">Draft</span></td>
                                <td>542</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-sm" title="Edit">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button class="btn-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Global Futures</strong></td>
                                <td>David Martinez</td>
                                <td>Science</td>
                                <td><span class="badge badge-success">Published</span></td>
                                <td>3,124</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-sm" title="Edit">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button class="btn-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Creative Pathways</strong></td>
                                <td>Lisa Anderson</td>
                                <td>Arts</td>
                                <td><span class="badge badge-danger">Archived</span></td>
                                <td>891</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-sm" title="Edit">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button class="btn-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <script>
        // =============== SIDEBAR TOGGLE ===============
        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.getElementById('menuToggle');
        const navLinks = document.querySelectorAll('.nav-link');
        const searchInput = document.querySelector('.search-input');

        // Toggle sidebar on mobile
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
        });

        // Close sidebar when clicking on a nav link (mobile)
        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                // Only close on mobile
                if (window.innerWidth <= 768) {
                    sidebar.classList.add('collapsed');
                }
                
                // Update active state
                navLinks.forEach(l => l.classList.remove('active'));
                link.classList.add('active');
            });
        });

        // Close sidebar when clicking outside (mobile)
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                const isClickInsideSidebar = sidebar.contains(e.target);
                const isClickOnToggle = menuToggle.contains(e.target);
                
                if (!isClickInsideSidebar && !isClickOnToggle && !sidebar.classList.contains('collapsed')) {
                    sidebar.classList.add('collapsed');
                }
            }
        });

        // =============== SEARCH FUNCTIONALITY ===============
        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('table tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });

        // =============== RESPONSIVE BEHAVIOR ===============
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('collapsed');
            }
        });

        // =============== ACTION BUTTONS ===============
        const actionButtons = document.querySelectorAll('.btn-sm');
        
        actionButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const icon = btn.querySelector('i');
                if (icon.classList.contains('fa-pen')) {
                    console.log('Edit action triggered');
                    alert('Edit functionality would be implemented here');
                } else if (icon.classList.contains('fa-trash')) {
                    console.log('Delete action triggered');
                    alert('Delete functionality would be implemented here');
                }
            });
        });

        // =============== NAVBAR ICONS ===============
        const navbarIcons = document.querySelectorAll('.navbar-icon');
        
        navbarIcons.forEach(icon => {
            icon.addEventListener('click', () => {
                console.log('Icon clicked:', icon);
                // Add functionality as needed
            });
        });

        // =============== USER PROFILE ===============
        const userProfile = document.querySelector('.user-profile');
        
        userProfile.addEventListener('click', () => {
            console.log('User profile clicked');
            alert('Profile menu would open here');
        });

        // =============== ADD BOOK BUTTON ===============
        const addBookBtn = document.querySelector('.btn-primary');
        
        if (addBookBtn) {
            addBookBtn.addEventListener('click', () => {
                console.log('Add book clicked');
                alert('Add book modal would open here');
            });
        }

        // =============== LOGOUT ===============
        const logoutLink = document.querySelector('[data-page="logout"]');
        
        if (logoutLink) {
            logoutLink.addEventListener('click', (e) => {
                e.preventDefault();
                if (confirm('Are you sure you want to logout?')) {
                    console.log('Logging out...');
                    alert('Logout functionality would be implemented here');
                }
            });
        }
    </script>
</body>
</html>
