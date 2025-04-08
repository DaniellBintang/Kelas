<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ayam Goreng Jos - Premium Fried Chicken</title>

    <!-- Bootstrap 5.3 and Custom Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Merriweather:wght@700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #1E88E5;
            /* Medium Blue */
            --primary-dark: #1565C0;
            /* Darker Blue */
            --primary-light: #64B5F6;
            /* Lighter Blue */
            --secondary-color: #2962FF;
            /* Accent Blue */
            --accent-color: #0D47A1;
            /* Deep Blue */
            --background-light: #F5F9FF;
            /* Very Light Blue */
            --text-dark: #0A1929;
            /* Navy Blue */
            --gradient-primary: linear-gradient(135deg, #1E88E5, #64B5F6);
            --gradient-button: linear-gradient(135deg, #2962FF, #1E88E5);
            --white-color: #FFFFFF;
            --light-shadow: rgba(30, 136, 229, 0.1);
        }

        /* Transparent Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: var(--primary-light);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: var(--primary-color);
        }

        ::-webkit-scrollbar-track {
            background-color: transparent;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.7;
            color: var(--text-dark);
            background-color: var(--background-light);
            background-image:
                radial-gradient(circle at 25% 15%, rgba(30, 136, 229, 0.05) 5%, transparent 15%),
                radial-gradient(circle at 75% 85%, rgba(30, 136, 229, 0.05) 5%, transparent 15%);
            background-attachment: fixed;
        }

        /* Navbar with depth */
        .navbar {
            background: var(--gradient-primary);
            box-shadow: 0 4px 20px rgba(30, 136, 229, 0.25);
            transition: all 0.4s ease;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-family: 'Merriweather', serif;
            font-weight: 700;
            color: var(--white-color) !important;
            letter-spacing: 1px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            font-size: 1.5rem;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
            margin: 0 10px;
            text-shadow: 0px 1px 1px rgba(0, 0, 0, 0.1);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 50%;
            background-color: var(--white-color);
            transition: all 0.3s ease;
            transform: translateX(-50%);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .navbar .dropdown-menu {
            background-color: var(--white-color);
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .navbar .dropdown-menu .dropdown-item {
            color: var(--primary-color);
            transition: all 0.3s ease;
            padding: 10px 20px;
        }

        .navbar .dropdown-menu .dropdown-item:hover {
            background-color: var(--background-light);
            color: var(--primary-dark);
            transform: translateX(5px);
        }

        .nav-link:hover {
            color: var(--white-color) !important;
            transform: translateY(-2px);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn-order-now {
            background: var(--gradient-button);
            color: var(--white-color);
            font-weight: 600;
            padding: 10px 22px;
            border-radius: 8px;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 10px rgba(41, 98, 255, 0.3);
        }

        .btn-order-now:hover {
            background: var(--gradient-button);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(41, 98, 255, 0.4);
            color: var(--white-color);
        }

        /* Main Container */
        .main-container {
            min-height: calc(100vh - 180px);
            padding-top: 30px;
            padding-bottom: 60px;
        }

        /* Card styling for content */
        .card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(30, 136, 229, 0.1);
            transition: all 0.4s ease;
            background-color: var(--white-color);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(30, 136, 229, 0.15);
        }

        .card-title {
            color: var(--primary-dark);
            font-weight: 700;
        }

        /* Button styling */
        .btn-primary {
            background: var(--gradient-button);
            border: none;
            box-shadow: 0 4px 10px rgba(41, 98, 255, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(41, 98, 255, 0.4);
        }

        /* Footer with depth */
        .footer {
            background: var(--accent-color);
            color: rgba(255, 255, 255, 0.9);
            padding: 50px 0 30px;
            position: relative;
            box-shadow: 0 -8px 20px rgba(13, 71, 161, 0.2);
        }

        .footer::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-light), var(--secondary-color), var(--primary-light));
        }

        .footer .social-icons {
            margin-bottom: 25px;
        }

        .footer .social-icons a {
            color: var(--white-color);
            margin: 0 12px;
            font-size: 1.6rem;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .footer .social-icons a:hover {
            color: var(--primary-light);
            transform: translateY(-3px) scale(1.1);
        }

        .footer .quick-links {
            margin-bottom: 25px;
        }

        .footer .quick-links a {
            color: var(--white-color);
            text-decoration: none;
            margin: 0 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .footer .quick-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: var(--primary-light);
            transition: all 0.3s ease;
        }

        .footer .quick-links a:hover::after {
            width: 100%;
        }

        .footer .quick-links a:hover {
            color: var(--primary-light);
        }

        /* Badge for cart */
        .badge {
            padding: 0.35em 0.65em;
            font-size: 0.75em;
        }

        /* Animation for navbar */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .navbar {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
    @yield('head_extras')
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/ayam.png') }}" alt="Ayam Goreng Jos"
                    style="height: 50px; margin-right: 10px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));" />
                <span>Ayam Goreng Jos</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/menu') }}"><i class="fas fa-utensils"></i> Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/contact') }}"><i class="fas fa-envelope"></i> Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/chat') }}"><i class="fas fa-comments"></i> Chat</a>
                    </li>
                    {{-- filepath: e:\xampp\htdocs\AyamGoreng\resources\views\layouts\app.blade.php --}}
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ url('/cart') }}">
                            <i class="fas fa-shopping-cart"></i> Cart
                            @if (Auth::check() && session('cart') && count(session('cart')) > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-white text-primary">
                                    {{ count(session('cart')) }}
                                </span>
                            @endif
                        </a>
                    </li>
                    @if (Auth::check())
                        <!-- Jika pengguna sudah login -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ url('/profile') }}"><i
                                            class="fas fa-id-card me-2"></i>Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i
                                                class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <!-- Jika pengguna belum login -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i>
                                Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-order-now ms-2" href="{{ route('signup') }}"><i
                                    class="fas fa-user-plus me-1"></i>
                                Signup</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid main-container">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="text-white mb-3">About Us</h5>
                    <p class="text-white-50">Ayam Goreng Jos provides premium fried chicken with authentic flavors that
                        will delight your taste buds.</p>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5 class="text-white mb-3">Quick Links</h5>
                    <div class="quick-links">
                        <a href="{{ url('/menu') }}">Menu</a> |
                        <a href="{{ url('/chat') }}">Tanya Kami</a> |
                        <a href="{{ url('/contact') }}">Contact</a>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5 class="text-white mb-3">Connect With Us</h5>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-4" style="background-color: rgba(255,255,255,0.1);">
            <div class="text-center">
                <p class="mb-2">© {{ date('Y') }} Ayam Goreng Jos. All Rights Reserved.</p>
                <small class="text-white-50">Crafted with Passion for Chicken Lovers</small>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
