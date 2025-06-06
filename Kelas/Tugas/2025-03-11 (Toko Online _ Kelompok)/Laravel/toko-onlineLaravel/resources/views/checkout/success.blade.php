@extends('layouts.app')

@section('title', 'Order Confirmation')

@section('styles')
    <style>
        .success-container {
            padding: 3rem 0;
            margin-top: 5rem;
            min-height: 60vh;
        }

        .success-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0.5rem 2rem rgba(0, 0, 0, 0.1);
            padding: 3rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .success-icon {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 1.5rem;
        }

        .order-details {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0.25rem 1rem rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .order-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .order-item img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            border-radius: 8px;
            margin-right: 1rem;
        }
    </style>
@endsection

@section('content')
    <div class="success-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="success-card">
                        <div class="success-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h1 class="h2 mb-3">Order Placed Successfully!</h1>
                        <p class="lead mb-4">Thank you for your order. We'll process it shortly and send you a confirmation
                            email.</p>
                        <h4 class="text-primary">Order #{{ $order->id }}</h4>
                        <p class="text-muted">Order Date: {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>

                    <div class="order-details">
                        <h5 class="mb-3">Order Details</h5>

                        <div class="mb-4">
                            <h6>Shipping Address:</h6>
                            <p class="mb-0">{{ $order->user->full_name }}</p>
                            <p class="mb-0">{{ $order->shipping_address }}</p>
                            <p class="mb-0">{{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</p>
                        </div>

                        <h6>Items Ordered:</h6>
                        @foreach ($order->items as $item)
                            <div class="order-item">
                                <img src="{{ asset('uploads/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $item->product->name }}</h6>
                                    <p class="mb-0 text-muted">Quantity: {{ $item->quantity }}</p>
                                    <p class="mb-0 fw-bold">Rp
                                        {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach

                        <div class="text-end mt-4">
                            <h5>Total: <span class="text-danger">Rp
                                    {{ number_format($order->total_price, 0, ',', '.') }}</span></h5>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('order-history') }}" class="btn btn-primary me-3">
                            <i class="fas fa-list me-2"></i>View Order History
                        </a>
                        <a href="{{ route('shop') }}" class="btn btn-outline-primary">
                            <i class="fas fa-shopping-cart me-2"></i>Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
