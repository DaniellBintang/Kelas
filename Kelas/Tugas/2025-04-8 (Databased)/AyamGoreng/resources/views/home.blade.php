@extends('layouts.app')

@section('head_extras')
    <style>
        /* Gradient Background and Hero Section */
        .hero-section {
            background: linear-gradient(rgba(201, 201, 201, 0.288), rgba(0, 0, 0, 0.7)),
                url('{{ asset('images/background.jpg') }}') no-repeat center center;
            background-size: cover;
            color: white;
            text-align: center;
            padding: 200px 0;
            position: relative;
            width: 99.8vw;
            margin-left: calc(-50vw + 50%);
        }

        .hero-content {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 25px;
            line-height: 1.2;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 40px;
            font-weight: 300;
        }

        /* Tombol Order */
        .btn-order {
            background-color: var(--secondary-color, #4ECDC4);
            border: none;
            color: white;
            padding: 15px 50px;
            font-size: 1.2rem;
            font-weight: 700;
            border-radius: 10px;
            transition: all 0.4s ease;
            text-transform: uppercase;
            letter-spacing: 2px;
            box-shadow: 0 15px 25px rgba(78, 205, 196, 0.4);
        }

        .btn-order:hover {
            background-color: #45b7aa;
            transform: translateY(-7px);
            box-shadow: 0 20px 30px rgba(78, 205, 196, 0.5);
        }

        /* Bagian Tentang Kami */
        .about-section {
            padding: 100px 0;
        }

        .about-content {
            display: flex;
            align-items: center;
            gap: 50px;
        }

        .about-image {
            flex: 1;
            border-radius: 15px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .about-image img {
            width: 100%;
            height: auto;
            transition: transform 0.4s ease;
        }

        .about-image img:hover {
            transform: scale(1.1);
        }

        .about-text {
            flex: 1;
        }

        .about-text h2 {
            font-size: 3rem;
            margin-bottom: 25px;
            color: #333;
        }

        .about-text p {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.8;
        }

        /* Bagian Menu Unggulan */
        .featured-menu {
            padding: 100px 0;
        }

        .featured-menu h2 {
            text-align: center;
            margin-bottom: 50px;
            font-size: 3rem;
            color: #333;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .menu-item {
            text-align: center;
            border-radius: 15px;
            padding: 30px;
            transition: all 0.4s ease;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .menu-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .menu-item img {
            width: 100%;
            height: 400px;
            /* Tetapkan tinggi tetap untuk gambar */
            object-fit: cover;
            /* Memastikan gambar dipotong secara proporsional */
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .menu-item h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #333;
        }

        .menu-item p {
            color: #666;
            margin-bottom: 20px;
        }

        /* Bagian Testimonial */
        .testimonials {
            padding: 100px 0;
            text-align: center;
        }

        .testimonials h2 {
            margin-bottom: 50px;
            font-size: 3rem;
            color: #333;
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .testimonial-card {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .testimonial-card p {
            font-style: italic;
            color: #666;
            margin-bottom: 20px;
        }

        .testimonial-author {
            font-weight: 600;
            color: #333;
        }

        .margin {
            margin-top: -2rem;
        }

        /* Perbaikan Styling untuk tombol-tombol pada Menu Unggulan */
        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 15px;
        }

        .btn-group .btn {
            width: 100%;
            padding: 10px 0;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary-color, #1E88E5);
            border: none;
            color: white;
            box-shadow: 0 4px 10px rgba(30, 136, 229, 0.3);
        }

        .btn-primary:hover {
            background-color: #1976D2;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(30, 136, 229, 0.4);
        }

        .btn-secondary {
            background-color: var(--secondary-color, #4ECDC4);
            border: none;
            color: white;
            box-shadow: 0 4px 10px rgba(78, 205, 196, 0.3);
        }

        .btn-secondary:hover {
            background-color: #45b7aa;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(78, 205, 196, 0.4);
        }

        /* Login Modal Styles */
        .login-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .login-modal-content {
            background-color: white;
            border-radius: 15px;
            padding: 35px;
            width: 90%;
            max-width: 420px;
            box-shadow: 0 10px 25px rgba(30, 136, 229, 0.25);
            text-align: center;
            position: relative;
            animation: slideIn 0.4s ease-out;
        }

        .login-modal-title {
            margin-bottom: 20px;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .login-modal-buttons {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
        }

        .login-modal-buttons .btn {
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-modal-buttons .btn-primary {
            background: var(--gradient-button);
            border: none;
            box-shadow: 0 4px 10px rgba(30, 136, 229, 0.3);
        }

        .login-modal-buttons .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(30, 136, 229, 0.4);
        }

        .login-modal-buttons .btn-outline-secondary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            background: transparent;
        }

        .login-modal-buttons .btn-outline-secondary:hover {
            background-color: var(--background-light);
            transform: translateY(-2px);
        }

        .login-modal-close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 1.5rem;
            cursor: pointer;
            color: #aaa;
            transition: color 0.3s ease;
        }

        .login-modal-close:hover {
            color: var(--primary-dark);
        }

        /* Cart Notification Modal Styles */
        #cartNotificationModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease-out;
        }

        .cart-notification-content {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            width: 90%;
            max-width: 380px;
            box-shadow: 0 10px 25px rgba(30, 136, 229, 0.25);
            text-align: center;
            position: relative;
            animation: slideIn 0.4s ease-out;
        }

        .cart-notification-icon {
            font-size: 3.5rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .cart-notification-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--primary-dark);
        }

        .cart-notification-message {
            margin-bottom: 25px;
            font-size: 1.05rem;
            color: var(--text-dark);
        }

        .cart-notification-buttons {
            display: flex;
            justify-content: space-between;
        }

        .cart-notification-buttons .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            flex: 1;
            margin: 0 8px;
            transition: all 0.3s ease;
        }

        .cart-notification-buttons .btn-primary {
            background: var(--gradient-button);
            border: none;
            box-shadow: 0 4px 10px rgba(30, 136, 229, 0.3);
        }

        .cart-notification-buttons .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(30, 136, 229, 0.4);
        }

        .cart-notification-buttons .btn-outline-secondary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            background: transparent;
        }

        .cart-notification-buttons .btn-outline-secondary:hover {
            background-color: var(--background-light);
            transform: translateY(-2px);
        }

        .cart-notification-close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 1.5rem;
            cursor: pointer;
            color: #aaa;
            transition: color 0.3s ease;
        }

        .cart-notification-close:hover {
            color: var(--primary-dark);
        }

        /* Cart Icon */
        .cart-icon {
            position: fixed;
            bottom: 30px;
            right: 50px;
            width: 65px;
            height: 65px;
            background: var(--gradient-button, linear-gradient(135deg, #1E88E5, #1565C0));
            color: white;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 15px rgba(30, 136, 229, 0.3);
            z-index: 1000;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .cart-icon:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(30, 136, 229, 0.4);
        }

        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #FF3E3E;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="hero-section margin">
        <div class="hero-content">
            <h1 class="hero-title">Ayam Goreng Jos</h1>
            <p class="hero-subtitle">Kelezatan Ayam Goreng Renyah dengan Bumbu Rahasia Keluarga</p>
            <a href="{{ url('/menu') }}" class="btn btn-order">Pesan Sekarang</a>
        </div>
    </div>

    <!-- Tentang Kami -->
    <div class="about-section container">
        <div class="about-content">
            <div class="about-image">
                <img src="{{ asset('images/restaurant.jpg') }}" alt="Ayam Goreng Jos Restaurant">
            </div>
            <div class="about-text">
                <h2>Tentang Kami</h2>
                <p>Ayam Goreng Jos adalah destinasi kuliner untuk pecinta ayam goreng sejati. Dengan resep turun-temurun
                    yang telah disempurnakan selama puluhan tahun, kami menghadirkan cita rasa autentik dan kualitas premium
                    dalam setiap gigitan.</p>
                <p>Kami menggunakan bahan-bahan pilihan, bumbu rahasia keluarga, dan teknik penggorengan khusus untuk
                    menghasilkan ayam goreng yang renyah di luar, juicy di dalam, dan memiliki cita rasa yang tak
                    tertandingi.</p>
            </div>
        </div>
    </div>

    <!-- Menu Unggulan -->
    <div class="featured-menu container">
        <h2>Menu Favorit Kami</h2>
        <div class="menu-grid">
            @foreach ($featuredMenus as $menu)
                <div class="menu-item">
                    <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}">
                    <h3>{{ $menu->name }}</h3>
                    <p>{{ $menu->description }}</p>
                    <div class="btn-group">
                        <a href="{{ route('order.direct', $menu->id) }}" class="btn btn-primary"
                            data-requires-auth="true">Order Sekarang</a>
                        <button class="btn btn-secondary add-to-cart" data-id="{{ $menu->id }}"
                            data-name="{{ $menu->name }}" data-requires-auth="true">
                            <i class="fas fa-cart-plus me-2"></i>Masukkan Keranjang
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Testimonial -->
    <div class="testimonials container">
        <h2>Kata Mereka Tentang Kami</h2>
        <div class="testimonial-grid">
            <div class="testimonial-card">
                <p>"Ayam gorengnya luar biasa! Renyah, gurih, dan bumbu yang menempel pas banget."</p>
                <p class="testimonial-author">- Sarah K.</p>
            </div>
            <div class="testimonial-card">
                <p>"Sudah berkali-kali datang, selalu suka sama cita rasa ayam gorengnya. Recommended!"</p>
                <p class="testimonial-author">- Michael L.</p>
            </div>
            <div class="testimonial-card">
                <p>"Pelayanannya ramah, suasana nyaman, dan ayamnya top banget. Pasti balik lagi!"</p>
                <p class="testimonial-author">- Emma W.</p>
            </div>
        </div>
    </div>

    <!-- Cart Icon (visible when cart has items) -->
    @if (session('cart') && count(session('cart')) > 0)
        <a href="{{ route('cart.index') }}" class="cart-icon">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-count" id="cartCount">{{ count(session('cart')) }}</span>
        </a>
    @endif

    <!-- Login Modal -->
    <div class="login-modal" id="loginModal">
        <div class="login-modal-content">
            <span class="login-modal-close">&times;</span>
            <div class="login-modal-icon mb-3">
                <i class="fas fa-user-lock" style="font-size: 3rem; color: var(--primary-color);"></i>
            </div>
            <div class="login-modal-title">Login Diperlukan</div>
            <p>Anda harus login terlebih dahulu untuk menambahkan item ke keranjang</p>
            <div class="login-modal-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('signup') }}" class="btn btn-outline-secondary">Register</a>
            </div>
        </div>
    </div>

    <!-- Cart Notification Modal -->
    <div id="cartNotificationModal">
        <div class="cart-notification-content">
            <span class="cart-notification-close">&times;</span>
            <div class="cart-notification-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="cart-notification-title">Berhasil Ditambahkan!</div>
            <div class="cart-notification-message">
                <span id="itemName"></span> telah ditambahkan ke keranjang belanja Anda.
            </div>
            <div class="cart-notification-buttons">
                <button class="btn btn-outline-secondary continue-shopping">Lanjut Belanja</button>
                <a href="{{ route('cart.index') }}" class="btn btn-primary">Lihat Keranjang</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Check user authentication status
            const isUserLoggedIn = {{ Auth::check() ? 'true' : 'false' }};

            // Handle Add to Cart and authentication check
            $('.add-to-cart, [data-requires-auth="true"]').click(function(e) {
                e.preventDefault(); // Prevent default form submission

                // If user is not logged in and element requires auth, show login modal
                if (!isUserLoggedIn && $(this).data('requires-auth')) {
                    $('#loginModal').css('display', 'flex');
                    return;
                }

                // If it's the add to cart button and user is logged in, proceed with adding to cart
                if ($(this).hasClass('add-to-cart')) {
                    let menuId = $(this).data('id');
                    let menuName = $(this).data('name');
                    let quantity = 1; // Default quantity for home page

                    $.ajax({
                        url: '{{ route('cart.add') }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            menu_id: menuId,
                            quantity: quantity
                        },
                        success: function(response) {
                            // Update cart count dynamically
                            if ($('#cartCount').length) {
                                $('#cartCount').text(response.cartCount);
                            } else {
                                // If cart icon doesn't exist, create it
                                $('body').append(`
                                    <a href="{{ route('cart.index') }}" class="cart-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span class="cart-count" id="cartCount">${response.cartCount}</span>
                                    </a>
                                `);
                            }

                            // Show notification modal with item name
                            $('#itemName').text(menuName);
                            $('#cartNotificationModal').css('display', 'flex');
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                        }
                    });
                } else if (isUserLoggedIn && $(this).attr('href')) {
                    // If it's another button that requires auth (like "Order Sekarang") and user is logged in
                    // Follow the link normally
                    window.location.href = $(this).attr('href');
                }
            });

            // Close login modal
            $('.login-modal-close').on('click', function() {
                $('#loginModal').hide();
            });

            // Close login modal when clicking outside the modal content
            $('#loginModal').on('click', function(e) {
                if (e.target === this) {
                    $(this).hide();
                }
            });

            // Close notification modal
            $('.cart-notification-close, .continue-shopping').on('click', function() {
                $('#cartNotificationModal').hide();
            });

            // Close notification modal when clicking outside the modal content
            $('#cartNotificationModal').on('click', function(e) {
                if (e.target === this) {
                    $(this).hide();
                }
            });
        });
    </script>
@endsection
