@extends('layouts.app')
@section('head_extras')
    <style>
        .menu-section {
            padding: 60px 0;
        }

        .menu-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
            color: var(--primary-dark);
        }

        .card {
            border: none;
            box-shadow: 0 4px 15px var(--light-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            background-color: var(--white-color);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(30, 136, 229, 0.2);
        }

        .card-img-top {
            height: 400px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            text-align: center;
            padding: 1.5rem;
        }

        .card-title {
            color: var(--primary-dark);
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .btn-order {
            background: var(--gradient-button);
            color: white;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 10px rgba(41, 98, 255, 0.3);
        }

        .btn-order:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(41, 98, 255, 0.4);
            color: white;
        }

        .cart-icon {
            position: fixed;
            bottom: 30px;
            right: 50px;
            width: 65px;
            height: 65px;
            background: var(--gradient-button);
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

        /* Improved Quantity Counter Styles */
        .quantity-control {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            border-radius: 25px;
            border: 1px solid rgba(30, 136, 229, 0.2);
            padding: 5px;
            background-color: var(--background-light);
            max-width: 150px;
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0 2px 8px rgba(30, 136, 229, 0.05);
        }

        .quantity-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: white;
            border: none;
            color: var(--primary-color);
            font-weight: bold;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 2px 5px rgba(30, 136, 229, 0.1);
        }

        .quantity-btn:hover {
            background: var(--gradient-button);
            color: white;
        }

        .quantity-btn:focus {
            outline: none;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            border: none;
            background-color: transparent;
            font-weight: 600;
            font-size: 16px;
            color: var(--primary-dark);
            -moz-appearance: textfield;
        }

        .quantity-input::-webkit-inner-spin-button,
        .quantity-input::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .quantity-input:focus {
            outline: none;
        }

        .alert-cart {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            transition: opacity 0.5s ease-in-out;
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
    </style>
@endsection

@section('content')
    <div class="menu-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0">Our Menu</h1>
                @if (session('cart') && count(session('cart')) > 0)
                    <a href="{{ route('cart.index') }}" class="cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count" id="cartCount">{{ count(session('cart')) }}</span>
                    </a>
                @endif
            </div>

            <div class="row">
                @foreach ($menus as $menu)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset($menu->image) }}" class="card-img-top" alt="{{ $menu->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $menu->name }}</h5>
                                <p class="card-text">{{ $menu->description }}</p>
                                <p class="card-text fw-bold">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>

                                <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                    <!-- Quantity Counter -->
                                    <div class="quantity-control">
                                        <button class="quantity-btn decrease-quantity"
                                            data-id="{{ $menu->id }}">-</button>
                                        <input type="number" class="quantity-input" id="quantity-{{ $menu->id }}"
                                            value="1" min="1">
                                        <button class="quantity-btn increase-quantity"
                                            data-id="{{ $menu->id }}">+</button>
                                    </div>
                                    <button class="btn btn-order add-to-cart" data-id="{{ $menu->id }}"
                                        data-name="{{ $menu->name }}" data-requires-auth="true">
                                        <i class="fas fa-cart-plus me-2"></i>Add to Cart
                                    </button>
                                </form>
                                <a href="{{ route('order.direct', ['menu_id' => $menu->id]) }}"
                                    class="btn btn-primary mt-2" data-requires-auth="true">
                                    <i class="fas fa-shopping-bag me-2"></i>Order Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

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
            // Handle quantity increase
            $('.increase-quantity').click(function(e) {
                e.preventDefault();
                let menuId = $(this).data('id');
                let quantityInput = $(`#quantity-${menuId}`);
                let currentQuantity = parseInt(quantityInput.val());
                quantityInput.val(currentQuantity + 1);
            });

            // Handle quantity decrease
            $('.decrease-quantity').click(function(e) {
                e.preventDefault();
                let menuId = $(this).data('id');
                let quantityInput = $(`#quantity-${menuId}`);
                let currentQuantity = parseInt(quantityInput.val());
                if (currentQuantity > 1) {
                    quantityInput.val(currentQuantity - 1);
                }
            });

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
                    let quantity = $(`#quantity-${menuId}`).val();

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
                            $('#cartCount').text(response.cartCount);

                            // Show notification modal with item name
                            $('#itemName').text(menuName);
                            $('#cartNotificationModal').css('display', 'flex');
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                        }
                    });
                } else if (isUserLoggedIn) {
                    // If it's another button that requires auth (like "Order Sekarang") and user is logged in
                    // Follow the link normally
                    window.location.href = $(this).attr('href');
                }
            });

            // Prevent form submission on button click
            $('.quantity-btn').on('click', function(e) {
                e.preventDefault(); // Prevent default form submission
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
