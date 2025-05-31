@section('head_extras')
    <style>
        /* ===== NAVBAR STYLING ===== */
        :root {
            --navbar-height: 90px;
            --transition: all 0.3s ease;
            --primary: #FF6B35;
            --primary-dark: #E85A2A;
            --dark: #333333;
            --light: #FFFFFF;
            --gray: #F8F9FA;
            --gray-dark: #6C757D;
            --cart-color: #ff8514;
            /* New blue color for cart */
            --cart-hover: #ffe0cc;
            /* Darker blue for cart hover */
            --cart-badge: #FF3A5A;
            /* Red color for cart badge */
        }

        /* Main Navbar */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 0.75rem 0;
            z-index: 1030;
            height: var(--navbar-height);
            transition: var(--transition);
        }

        /* Logo */
        .navbar-brand {
            padding: 0;
            margin-right: 2rem;
        }

        .logo-img {
            height: 60px;
            width: auto;
            transition: var(--transition);
        }

        .logo-img:hover {
            transform: scale(1.05);
        }

        /* Mobile Toggle Button */
        .custom-toggler {
            border: none;
            padding: 0.4rem;
            border-radius: 8px;
            transition: var(--transition);
        }

        .custom-toggler:focus {
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.25);
            outline: none;
        }

        .custom-toggler .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 107, 53, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            transition: var(--transition);
        }

        .custom-toggler:hover {
            background-color: rgba(255, 107, 53, 0.1);
        }

        /* Navigation Links */
        .navbar-nav {
            align-items: center;
        }

        .navbar-nav .nav-item {
            margin: 0 0.25rem;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: var(--dark) !important;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: var(--transition);
            position: relative;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary) !important;
            background: rgba(255, 107, 53, 0.1);
            transform: translateY(-2px);
        }

        .navbar-nav .nav-link.active {
            color: var(--primary) !important;
            background: rgba(255, 107, 53, 0.1);
            font-weight: 600;
        }

        /* Cart Link - UPDATED */
        .cart-link {
            display: flex;
            align-items: center;
            background-color: var(--primary) !important;
            color: white !important;
            border-radius: 8px;
            padding: 0.5rem 1rem !important;
            transition: var(--transition);
            font-weight: 500;
            text-decoration: none;
        }

        .cart-link:hover {
            background-color: var(--cart-hover) !important;
            color: var(--primary) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(74, 111, 255, 0.3);
        }

        .cart-link-disabled {
            display: flex;
            align-items: center;
            background-color: #e9ecef !important;
            color: #adb5bd !important;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .cart-badge {
            top: -5px;
            right: -5px;
            font-size: 0.7rem;
            font-weight: 600;
            color: white;
            background-color: var(--cart-badge);
            border-radius: 50%;
            padding: 0.15rem 0.4rem;
            min-width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .cart-link:hover .cart-badge {
            transform: scale(1.1);
            background-color: var(--cart-badge);
        }

        /* Auth Links */
        .auth-link {
            display: flex;
            align-items: center;
        }

        .login-btn {
            display: flex;
            align-items: center;
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
            font-weight: 500;
            transition: var(--transition);
            box-shadow: 0 4px 10px rgba(255, 107, 53, 0.3);
        }

        .login-btn:hover {
            background-color: var(--primary-dark) !important;
            border-color: var(--primary-dark) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 107, 53, 0.4);
        }

        /* User Profile */
        .user-profile {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: var(--transition);
        }

        .user-profile:hover {
            background: rgba(255, 107, 53, 0.1);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .user-profile:hover .user-avatar {
            transform: scale(1.1);
        }

        .user-email {
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Dropdown Menu */
        .user-dropdown {
            margin-top: 0.75rem;
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 0.5rem;
            min-width: 220px;
        }

        .user-dropdown .dropdown-item {
            padding: 0.6rem 1rem;
            border-radius: 8px;
            transition: var(--transition);
            color: var(--dark);
        }

        .user-dropdown .dropdown-item:hover {
            background-color: rgba(255, 107, 53, 0.1);
            color: var(--primary);
        }

        .user-dropdown .dropdown-item i {
            width: 20px;
            text-align: center;
        }

        .user-dropdown .dropdown-divider {
            margin: 0.5rem 0;
            opacity: 0.1;
        }

        .logout-link {
            color: #dc3545 !important;
        }

        .logout-link:hover {
            background-color: rgba(220, 53, 69, 0.1) !important;
            color: #dc3545 !important;
        }

        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: white;
                border-radius: 12px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                padding: 1rem;
                margin-top: 1rem;
                max-height: calc(100vh - var(--navbar-height) - 2rem);
                overflow-y: auto;
            }

            .navbar-nav {
                gap: 0.5rem !important;
            }

            .navbar-nav .nav-item {
                width: 100%;
                margin: 0;
            }

            .navbar-nav .nav-link {
                padding: 0.75rem 1rem !important;
            }

            .login-btn {
                width: 100%;
                justify-content: center;
            }

            .user-profile {
                justify-content: space-between;
            }

            .user-email {
                max-width: none;
            }

            .user-dropdown {
                position: static !important;
                width: 100%;
                margin-top: 0.5rem;
                box-shadow: none;
                border: 1px solid rgba(0, 0, 0, 0.05);
                transform: none !important;
            }
        }

        @media (max-width: 575.98px) {
            .navbar-brand {
                margin-right: 0;
            }

            .logo-img {
                height: 35px;
            }
        }
    </style>

    <nav class="navbar navbar-expand-lg navbar-custom fixed-top shadow-sm">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/10ec2671eb62abe8528dfdb0484f9e8c.png') }}" alt="Restaurant Logo"
                    class="logo-img">
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-3">
                    <!-- Cart -->
                    <li class="nav-item">
                        @if (session()->has('cart'))
                            <a href="{{ url('cart') }}" class="cart-link position-relative">
                                <i class="fas fa-shopping-cart me-2"></i>
                                <span class="d-none d-md-inline">Keranjang</span>
                                @php
                                    $count = count(session('cart'));
                                @endphp
                                @if ($count > 0)
                                    <span class="cart-badge position-absolute">
                                        {{ $count }}
                                    </span>
                                @endif
                            </a>
                        @else
                            <span class="nav-link cart-link-disabled">
                                <i class="fas fa-shopping-cart me-2"></i>
                                <span class="d-none d-md-inline">Keranjang</span>
                            </span>
                        @endif
                    </li>

                    <!-- Authentication Links -->
                    @if (session()->missing('idpelanggan'))
                        <li class="nav-item">
                            <a href="{{ url('register') }}" class="nav-link auth-link">
                                <i class="fas fa-user-plus me-2"></i>Daftar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('login') }}" class="btn btn-primary login-btn px-4 py-2">
                                <i class="fas fa-sign-in-alt me-2"></i>Masuk
                            </a>
                        </li>
                    @else
                        <!-- User Profile Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle user-profile" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar me-2">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span class="user-email">{{ session('idpelanggan')['email'] }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end user-dropdown">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user me-2"></i>Profil Saya
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-history me-2"></i>Riwayat Pesanan
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item logout-link" href="{{ url('logout') }}">
                                        <i class="fas fa-sign-out-alt me-2"></i>Keluar
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
