@extends('layouts.app1')

@section('head_extras')
    <style>
        .cart-section {
            padding: 60px 0;
        }

        .cart-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .cart-table th,
        .cart-table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .cart-table th {
            background-color: var(--secondary-color);
            color: white;
            font-weight: 600;
        }

        .cart-table img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }

        .cart-total {
            text-align: right;
            font-size: 1.25rem;
            font-weight: 700;
            margin-top: 20px;
        }

        .btn-checkout {
            display: inline-block;
            background-color: var(--secondary-color);
            color: white;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .btn-checkout:hover {
            background-color: #45b7aa;
            color: white;
        }
    </style>
@endsection

@section('content')
    <div class="cart-section">
        <div class="container">
            <h1>Your Cart</h1>

            <!-- Cart Table -->
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dummy Data -->
                    <tr>
                        <td><img src="{{ asset('images/ayamgoreng.jpg') }}" alt="Ayam Goreng"></td>
                        <td>Ayam Goreng</td>
                        <td>Rp 20.000</td>
                        <td>2</td>
                        <td>Rp 40.000</td>
                        <td><button class="btn btn-danger btn-sm">Remove</button></td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('images/saltedegg.jpg') }}" alt="Ayam Telur Asin"></td>
                        <td>Ayam Telur Asin</td>
                        <td>Rp 23.000</td>
                        <td>1</td>
                        <td>Rp 23.000</td>
                        <td><button class="btn btn-danger btn-sm">Remove</button></td>
                    </tr>
                </tbody>
            </table>

            <!-- Cart Total -->
            <div class="cart-total">
                Total: <strong>Rp 63.000</strong>
            </div>

            <!-- Checkout Button -->
            <div class="text-end mt-4">
                <a href="{{ url('/order') }}" class="btn-checkout">Proceed to Checkout</a>
            </div>
        </div>
    </div>
@endsection
