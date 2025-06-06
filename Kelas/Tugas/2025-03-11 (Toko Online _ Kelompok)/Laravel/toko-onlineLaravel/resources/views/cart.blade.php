{{-- resources/views/cart.blade.php --}}

@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('styles')
    <style>
        .cart-container {
            padding: 2rem 0;
            margin-top: 5rem;
        }

        .cart-header {
            background-color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-bottom: 1px solid #eee;
        }

        .cart-table {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .cart-table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .quantity-input {
            width: 70px;
            text-align: center;
        }

        .cart-summary {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
        }

        .checkout-btn {
            width: 100%;
            padding: 1rem;
            font-weight: 500;
        }

        .empty-cart {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
    <div class="cart-header">
        <div class="container">
            <h1 class="text-center">Shopping Cart</h1>
        </div>
    </div>

    <div class="cart-container">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (!empty($cartItems))
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart-table mb-4">
                            <table class="table table-borderless mb-0">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('uploads/' . $item['product']->image) }}"
                                                        alt="{{ $item['product']->name }}" class="product-image me-3">
                                                    <div>
                                                        <h5 class="mb-0">{{ $item['product']->name }}</h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Rp {{ number_format($item['product']->price, 0, ',', '.') }}</td>
                                            <td>
                                                <form action="{{ route('cart.update') }}" method="POST"
                                                    class="quantity-form">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                                        min="1" class="form-control quantity-input"
                                                        onchange="this.form.submit()">
                                                </form>
                                            </td>
                                            <td>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                                            <td>
                                                <a href="{{ route('cart.remove', $item['id']) }}"
                                                    class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between mb-4">
                            <a href="{{ route('shop') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                            </a>
                            <a href="{{ route('cart.clear') }}" class="btn btn-outline-danger">
                                <i class="fas fa-trash me-2"></i> Clear Cart
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="cart-summary">
                            <h4 class="mb-4">Order Summary</h4>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping</span>
                                <span>Free</span>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between mb-4">
                                <strong>Total</strong>
                                <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                            </div>

                            <a href="{{ route('checkout') }}" class="btn btn-danger checkout-btn">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                    <h3>Your Cart is Empty</h3>
                    <p>Looks like you haven't added any products to your cart yet.</p>
                    <a href="{{ route('shop') }}" class="btn btn-primary mt-3">Start Shopping</a>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // You can add any cart-specific JavaScript here
    </script>
@endsection
