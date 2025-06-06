{{-- resources/views/ratings/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Product Ratings - Guitar Shop')

@section('styles')
    <style>
        :root {
            --fender-red: #e22729;
            --fender-red-light: #ff4b4d;
            --fender-red-dark: #c41e20;
            --primary-red-hover: #d11d1f;
            --text-dark: #333333;
            --text-light: #666666;
            --bg-light: #f8f9fa;
            --bg-white: #ffffff;
            --border-color: #dee2e6;
            --shadow-sm: 0 2px 10px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 15px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 8px 20px rgba(0, 0, 0, 0.15);
            --border-radius-sm: 6px;
            --border-radius-md: 10px;
            --border-radius-lg: 15px;
            --spacing-xs: 0.5rem;
            --spacing-sm: 1rem;
            --spacing-md: 1.5rem;
            --spacing-lg: 2rem;
            --transition-speed: 0.3s;
        }

        .container.py-5.mt-5 {
            padding: 2rem 0;
            margin-top: 0 !important;
            background-color: #f8f9fa;
        }

        /* Page Header Styling */
        .page-header {
            background-color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-bottom: none;
            margin-top: 5rem;
        }

        .page-title {
            text-align: center;
            font-weight: 700;
            color: var(--text-dark);
            margin: 1rem 0;
        }

        /* Card Grid Styling */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            padding: 1rem;
        }

        /* Card Styling */
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
            border: none;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-img-container {
            position: relative;
            padding-top: 100%;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        .card-img-top {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 1rem;
            transition: transform 0.3s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        .card-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            text-align: left;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #333;
            height: 2.8em;
            overflow: hidden;
        }

        /* Button Styling */
        .btn-danger {
            width: 100%;
            padding: 0.8rem;
            background-color: var(--fender-red);
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: auto;
        }

        .btn-danger:hover {
            background-color: #c41820;
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Rating Stars Styling */
        .rating-stars {
            color: #FFD700;
            filter: drop-shadow(0px 1px 1px rgba(0, 0, 0, 0.05));
        }

        .rating-value {
            font-weight: 600;
            color: var(--text-dark);
        }

        .review-count {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 0;
            background-color: var(--bg-light);
            padding: 0.25rem 1rem;
            border-radius: 20px;
            display: inline-block;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }

        @media (max-width: 576px) {
            .product-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container py-5 mt-5">
        <div class="page-header">
            <h1 class="page-title">Product Ratings - Guitar Shop</h1>
        </div>

        <!-- Show list of all products with their average ratings -->
        <div class="product-grid">
            @if ($products->count() > 0)
                @foreach ($products as $product)
                    <div class="card h-100">
                        <div class="card-img-container">
                            @if (!empty($product->image))
                                <img src="{{ asset('uploads/' . $product->image) }}" class="card-img-top"
                                    alt="{{ $product->name }}">
                            @else
                                <img src="{{ asset('images/no-image.jpg') }}" class="card-img-top" alt="No image available">
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <div class="rating-stars mb-2">
                                @stars($product->avg_rating ?? 0)
                                <span class="rating-value ms-2">{{ number_format($product->avg_rating ?? 0, 1) }}/5</span>
                            </div>
                            <p class="review-count mb-3">{{ $product->review_count }} reviews</p>
                            <a href="{{ route('ratings.show', $product->id) }}" class="btn btn-danger">View Details</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        No products with ratings yet.
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
