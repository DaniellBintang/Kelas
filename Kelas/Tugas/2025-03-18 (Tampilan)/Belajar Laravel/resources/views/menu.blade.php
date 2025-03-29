@extends('layouts.app1')

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
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            height: 400px;
            /* Tetapkan tinggi tetap untuk gambar */
            object-fit: cover;
            /* Memastikan gambar dipotong secara proporsional */
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            text-align: center;
        }

        .btn-order {
            background-color: var(--secondary-color);
            color: white;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-order:hover {
            background-color: #45b7aa;
            color: white;
        }
    </style>
@endsection

@section('content')
    <div class="menu-section">
        <h1>Our Menu</h1>
        <div class="container">
            <div class="row">
                <!-- Menu Item 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('images/ayamgoreng.jpg') }}" class="card-img-top" alt="Ayam Goreng">
                        <div class="card-body">
                            <h5 class="card-title">Ayam Goreng</h5>
                            <p class="card-text">Rp 20.000</p>
                            <a href="{{ url('/order') }}" class="btn btn-order">Order Now</a>
                        </div>
                    </div>
                </div>
                <!-- Menu Item 2 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('images/ayampop.jpg') }}" class="card-img-top" alt="Ayam Bakar">
                        <div class="card-body">
                            <h5 class="card-title">Ayam Pop Corn</h5>
                            <p class="card-text">Rp 25.000</p>
                            <a href="{{ url('/order') }}" class="btn btn-order">Order Now</a>
                        </div>
                    </div>
                </div>
                <!-- Menu Item 3 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('images/chicken-strips.jpg') }}" class="card-img-top" alt="Ayam Penyet">
                        <div class="card-body">
                            <h5 class="card-title">Ayam Potong</h5>
                            <p class="card-text">Rp 22.000</p>
                            <a href="{{ url('/order') }}" class="btn btn-order">Order Now</a>
                        </div>
                    </div>
                </div>
                <!-- Menu Item 4 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('images/chickenkatsu.jpg') }}" class="card-img-top" alt="Ayam Kremes">
                        <div class="card-body">
                            <h5 class="card-title">Ayam Katsu</h5>
                            <p class="card-text">Rp 23.000</p>
                            <a href="{{ url('/order') }}" class="btn btn-order">Order Now</a>
                        </div>
                    </div>
                </div>
                <!-- Menu Item 5 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('images/karage.jpg') }}" class="card-img-top" alt="Ayam Sambal">
                        <div class="card-body">
                            <h5 class="card-title">Ayam Karage</h5>
                            <p class="card-text">Rp 24.000</p>
                            <a href="{{ url('/order') }}" class="btn btn-order">Order Now</a>
                        </div>
                    </div>
                </div>
                <!-- Menu Item 6 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('images/saltedegg.jpg') }}" class="card-img-top" alt="Ayam Geprek">
                        <div class="card-body">
                            <h5 class="card-title">Ayam Telur Asin</h5>
                            <p class="card-text">Rp 21.000</p>
                            <a href="{{ url('/order') }}" class="btn btn-order">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
