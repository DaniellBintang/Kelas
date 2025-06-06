{{-- resources/views/layouts/app.blade.php --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Add this line -->
    <title>@yield('title', 'Fender Guitar Shop')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('styles')
</head>

<body>
    <!-- Header and Navigation -->
    <header class="py-4">
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('images/Fender_guitars_logo.svg.png') }}" alt="Fender Logo" class="img-fluid">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('shop') ? 'active' : '' }}"
                                href="{{ route('shop') }}">Shop</a>
                        </li>
                        {{-- In your resources/views/layouts/app.blade.php file --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                                href="{{ route('about') }}">About</a>
                        </li>
                        {{-- In your resources/views/layouts/app.blade.php file --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                                href="{{ route('contact') }}">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('ratings') ? 'active' : '' }}"
                                href="{{ route('ratings') }}">Ratings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link cart-icon {{ request()->routeIs('cart.index') ? 'active' : '' }}"
                                href="{{ route('cart.index') }}">
                                <i class="fas fa-shopping-cart"></i>
                                @if (Session::has('cart') && $cartTotalQuantity > 0)
                                    <span class="cart-badge">{{ $cartTotalQuantity }}</span>
                                @endif
                            </a>
                        </li>
                    </ul>
                    <div class="auth-buttons">
                        @auth
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-user me-1"></i>{{ Auth::user()->full_name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                            <i class="fas fa-user me-2"></i>Profile
                                        </a></li>
                                    <li><a class="dropdown-item" href="{{ route('order-history') }}">
                                            <i class="fas fa-shopping-bag me-2"></i>Purchase History
                                        </a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a class="nav-link btn btn-login" href="{{ route('login') }}">Login</a>
                            <a class="nav-link btn btn-signup" href="{{ route('register') }}">Sign Up</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="mt-5 pt-5">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer bg-dark text-white py-5">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('cart.index') }}">Cart</a></li>
                    <li><a href="{{ route('ratings') }}">Reviews</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Payment Methods</h3>
                <div class="payment-methods">
                    <i class="fab fa-cc-visa fa-2x"></i>
                    <i class="fab fa-cc-mastercard fa-2x"></i>
                    <i class="fab fa-cc-paypal fa-2x"></i>
                    <i class="fab fa-cc-apple-pay fa-2x"></i>
                </div>
            </div>

            <div class="footer-section">
                <h3>Connect With Us</h3>
                <div class="social-links">
                    <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
                <p style="color: var(--neutral-400); margin-top: 1rem; margin-left: -4rem;">
                    Follow us for updates and exclusive offers!
                </p>
            </div>

            <div class="footer-section">
                <h3>Contact Us</h3>
                <ul>
                    <li><i class="far fa-envelope"></i> info@guitarshop.com</li>
                    <li><i class="fas fa-phone"></i> (555) 123-4567</li>
                    <li><i class="fas fa-map-marker-alt"></i> 123 Guitar Street, Music City</li>
                    <li><i class="far fa-clock"></i> Mon - Fri: 9:00 AM - 6:00 PM</li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Guitar Shop. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    @yield('scripts')
</body>

</html>
