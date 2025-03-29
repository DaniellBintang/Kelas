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
            --primary-color: #FF6B6B;
            --secondary-color: #4ECDC4;
            --accent-color: #343a40;
            --background-light: #F9FAFB;
            --text-dark: #2C3333;
            --gradient-primary: linear-gradient(135deg, #FF6B6B, #FF8787);
        }

        /* Transparent Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            /* Transparansi pada scrollbar */
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: rgba(0, 0, 0, 0.4);
            /* Transparansi lebih gelap saat hover */
        }

        ::-webkit-scrollbar-track {
            background-color: transparent;
            /* Track transparan */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.7;
            color: var(--text-dark);
            background-color: var(--background-light);
        }

        /* Navbar */
        .navbar {
            background: var(--gradient-primary);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
        }

        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            /* Menggunakan font Poppins */
            font-weight: 600;
            /* Membuat teks lebih tegas */
            color: white !important;
            letter-spacing: 1px;
            /* Memberikan sedikit jarak antar huruf */
            text-transform: uppercase;
            /* Mengubah teks menjadi huruf kapital */
            font-size: 1.5rem;
            /* Ukuran font */
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
            margin: 0 10px;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 50%;
            background-color: white;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover {
            color: white !important;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn-order-now {
            background-color: var(--secondary-color);
            color: white;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-order-now:hover {
            background-color: #45b7aa;
            color: white;
        }

        /* Footer */
        .footer {
            background: var(--accent-color);
            color: rgba(255, 255, 255, 0.8);
            padding: 40px 0;
            text-align: center;
        }

        .footer .social-icons a {
            color: rgba(255, 255, 255, 0.8);
            margin: 0 10px;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .footer .social-icons a:hover {
            color: var(--secondary-color);
        }

        .footer .quick-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            margin: 0 10px;
            font-size: 0.9rem;
        }

        .footer .quick-links a:hover {
            color: var(--secondary-color);
        }
    </style>
    @yield('head_extras')
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/ayam') }}">
                <img src="{{ asset('images/ayam.png') }}" alt="Ayam Goreng Jos"
                    style="height: 50px; margin-right: 10px; margin-bottom: 5px;" />
                <span>Ayam Goreng Jos</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/ayam') }}"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/menu') }}"><i class="fas fa-utensils"></i> Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/contact-ayam') }}"><i class="fas fa-envelope"></i>
                            Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/chat') }}"><i class="fas fa-comments"></i> Chat</a>
                    </li>
                    <!-- Cart Navbar -->
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ url('/cart') }}">
                            <i class="fas fa-shopping-cart"></i> Cart
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ session('cart_count', 2) }}
                            </span>
                        </a>
                    </li>
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
            <div class="social-icons mb-3">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
            <div class="quick-links mb-3">
                <a href="{{ url('/menu') }}">Menu</a> |
                <a href="{{ url('/order') }}">Order</a> |
                <a href="{{ url('/contact-ayam') }}">Contact</a>
            </div>
            <p class="mb-2">© {{ date('Y') }} Ayam Goreng Jos. All Rights Reserved.</p>
            <small>Crafted with Passion for Chicken Lovers</small>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
