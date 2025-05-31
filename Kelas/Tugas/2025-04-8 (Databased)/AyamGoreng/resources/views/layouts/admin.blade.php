<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Dashboard for Restaurant Management System">
    <meta name="author" content="Your Name">
    <title>@yield('title', 'Admin Dashboard') | Restaurant Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-color: #3a3f51;
            --secondary-color: #2d8cf0;
            --accent-color: #f56c6c;
            --sidebar-width: 250px;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f5f7fa;
        }

        /* Sidebar Styles */
        .admin-sidebar {
            width: var(--sidebar-width);
            background: var(--primary-color);
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            z-index: 1030;
            transition: all 0.3s;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .admin-sidebar .brand {
            padding: 15px 20px;
            background: rgba(0, 0, 0, 0.1);
            height: 60px;
            display: flex;
            align-items: center;
        }

        .admin-sidebar .brand a {
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .admin-sidebar .sidebar-menu {
            padding: 20px 0;
        }

        .admin-sidebar .sidebar-menu a {
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            transition: all 0.3s;
            text-decoration: none;
            border-left: 3px solid transparent;
        }

        .admin-sidebar .sidebar-menu a:hover,
        .admin-sidebar .sidebar-menu a.active {
            background: rgba(0, 0, 0, 0.1);
            color: white;
            border-left: 3px solid var(--secondary-color);
        }

        .admin-sidebar .sidebar-menu i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .admin-sidebar .sidebar-menu .menu-header {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.8rem;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 1px;
            padding: 20px 20px 10px;
        }

        /* Main Content */
        .admin-content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            transition: all 0.3s;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Header */
        .admin-header {
            height: 60px;
            background: white;
            border-bottom: 1px solid #e8eaec;
            display: flex;
            align-items: center;
            padding: 0 20px;
            position: sticky;
            top: 0;
            z-index: 1020;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .admin-header .toggle-sidebar {
            margin-right: 15px;
            color: #333;
            cursor: pointer;
            display: none;
        }

        .admin-header .breadcrumb {
            margin-bottom: 0;
            background: transparent;
        }

        .admin-header .user-menu .dropdown-toggle::after {
            display: none;
        }

        .admin-header .user-menu .dropdown-toggle {
            display: flex;
            align-items: center;
        }

        .admin-header .user-menu .user-image {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            margin-right: 10px;
            background: var(--secondary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Cards and components */
        .stat-card {
            border-radius: 8px;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: none;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
        }

        /* Data tables */
        .data-table th {
            font-weight: 600;
            background-color: #f5f7fa;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 5px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .admin-sidebar {
                margin-left: calc(-1 * var(--sidebar-width));
            }

            .admin-sidebar.show {
                margin-left: 0;
            }

            .admin-content {
                margin-left: 0;
                width: 100%;
            }

            .admin-header .toggle-sidebar {
                display: block;
            }
        }

        /* Footer */
        footer {
            margin-top: auto;
            background-color: #fff;
            border-top: 1px solid #e8eaec;
        }

        /* Activity timeline */
        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 9px;
            top: 0;
            height: 100%;
            width: 2px;
            background: #e8eaec;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 20px;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -30px;
            top: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--secondary-color);
            border: 3px solid white;
        }

        .timeline-item.warning::before {
            background: #faad14;
        }

        .timeline-item.danger::before {
            background: var(--accent-color);
        }

        .timeline-item.success::before {
            background: #52c41a;
        }
    </style>
    @yield('styles')
</head>

<body>
    <!-- Sidebar -->
    <div class="admin-sidebar">
        <div class="brand">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-utensils me-2"></i>RestAdmin
            </a>
        </div>
        <div class="sidebar-menu">
            <div class="menu-header">MAIN NAVIGATION</div>
            <a href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.menus.index') ?? '#' }}"
                class="{{ request()->routeIs('admin.menus.*') ? 'active' : '' }}">
                <i class="fas fa-utensils"></i>
                <span>Menu Management</span>
            </a>
            <a href="{{ route('admin.orders.index') ?? '#' }}"
                class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i>
                <span>Orders</span>
            </a>
            <a href="{{ route('admin.users.index') ?? '#' }}"
                class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>User Management</span>
            </a>
            <a href="{{ route('admin.contacts.index') }}"
                class="{{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i>
                <span>Kontak</span>
            </a>

            <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="admin-content">
        <!-- Top Header -->
        <div class="admin-header">
            <div class="toggle-sidebar">
                <i class="fas fa-bars"></i>
            </div>

            <nav aria-label="breadcrumb" class="flex-grow-1">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    @yield('breadcrumbs')
                </ol>
            </nav>

            <div class="d-flex align-items-center">

                <div class="dropdown user-menu">
                    <a class="dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <div class="user-image">
                            {{ substr(Auth::guard('admin')->user()->name, 0, 1) }}
                        </div>
                        <span class="d-none d-md-inline">{{ Auth::guard('admin')->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#logoutModal">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="container-fluid p-4">
            <!-- Flash Messages -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn"
                    role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeIn"
                    role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Page Title -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">@yield('page-title', 'Dashboard')</h1>
                @yield('page-actions')
            </div>

            <!-- Main Content -->
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="py-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0">&copy; {{ date('Y') }} Restaurant Management System. All rights
                            reserved.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-0 text-muted">Version 1.0.0 | <a href="#">Documentation</a></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Select "Logout" below if you are ready to end your current session.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // Sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const toggleSidebar = document.querySelector('.toggle-sidebar');
            const adminSidebar = document.querySelector('.admin-sidebar');
            const adminContent = document.querySelector('.admin-content');

            toggleSidebar.addEventListener('click', function() {
                adminSidebar.classList.toggle('show');
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = adminSidebar.contains(event.target);
                const isClickInsideToggle = toggleSidebar.contains(event.target);

                if (!isClickInsideSidebar && !isClickInsideToggle && window.innerWidth < 992 && adminSidebar
                    .classList.contains('show')) {
                    adminSidebar.classList.remove('show');
                }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992) {
                    adminSidebar.classList.remove('show');
                }
            });
        });
    </script>
    @yield('scripts')
</body>

</html>
