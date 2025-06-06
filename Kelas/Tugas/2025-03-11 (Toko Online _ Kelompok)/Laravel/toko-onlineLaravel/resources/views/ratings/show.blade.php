{{-- resources/views/ratings/show.blade.php --}}

@extends('layouts.app')

@section('title', "$product->name - Ratings & Reviews")

@section('styles')
    <style>
        .product-rating-section {
            padding: 3rem 0;
            margin-top: 5rem;
            background-color: #f8f9fa;
        }

        .product-section {
            display: flex;
            flex-direction: column;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .product-header {
            display: flex;
            padding: 2rem;
        }

        .product-image {
            width: 200px;
            height: 200px;
            object-fit: contain;
            margin-right: 2rem;
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 10px;
        }

        .product-details {
            flex: 1;
        }

        .product-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .ratings-summary {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .average-rating {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .rating-number {
            font-size: 3rem;
            font-weight: 700;
            color: #333;
            line-height: 1;
        }

        .rating-text {
            font-size: 1rem;
            color: #666;
        }

        .rating-stars {
            color: #FFD700;
            font-size: 1.5rem;
            filter: drop-shadow(0px 1px 1px rgba(0, 0, 0, 0.05));
            margin-bottom: 0.5rem;
        }

        .rating-progress {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .star-label {
            width: 30px;
            text-align: right;
            margin-right: 1rem;
            font-weight: 600;
        }

        .progress {
            flex: 1;
            height: 10px;
            border-radius: 10px;
            margin-right: 1rem;
            background-color: #e9ecef;
        }

        .progress-bar {
            background-color: #ffc107;
            border-radius: 10px;
        }

        .progress-value {
            width: 40px;
            color: #666;
            font-size: 0.9rem;
        }

        .review-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .reviewer-name {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .review-date {
            color: #666;
            font-size: 0.9rem;
        }

        .review-rating {
            color: #FFD700;
            margin-bottom: 0.5rem;
        }

        .review-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .review-content {
            color: #333;
            line-height: 1.6;
        }

        .no-reviews {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            text-align: center;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background-color: #e22729;
            color: white;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 5px;
            font-weight: 500;
            text-decoration: none;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background-color: #c41820;
            transform: translateY(-2px);
            color: white;
        }

        @media (max-width: 768px) {
            .product-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .product-image {
                margin-right: 0;
                margin-bottom: 1.5rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="product-rating-section">
        <div class="container">
            <a href="{{ route('ratings') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Back to All Ratings
            </a>

            <div class="product-section">
                <div class="product-header">
                    @if (!empty($product->image))
                        <img src="{{ asset('uploads/' . $product->image) }}" class="product-image" alt="{{ $product->name }}">
                    @else
                        <img src="{{ asset('images/no-image.jpg') }}" class="product-image" alt="No image available">
                    @endif
                    <div class="product-details">
                        <h2 class="product-name">{{ $product->name }}</h2>
                        <div class="rating-stars">
                            @stars($averageRating)
                        </div>
                        <p>{{ number_format($averageRating, 1) }} out of 5</p>
                        <p>{{ $ratings->count() }} customer ratings</p>
                        <a href="{{ route('shop') }}" class="btn btn-danger">View in Shop</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="ratings-summary">
                        <div class="average-rating">
                            <div>
                                <div class="rating-number">{{ number_format($averageRating, 1) }}</div>
                                <div class="rating-text">out of 5</div>
                            </div>
                            <div class="rating-stars">
                                @stars($averageRating)
                            </div>
                        </div>

                        <div class="rating-bars">
                            @for ($i = 5; $i >= 1; $i--)
                                <div class="rating-progress">
                                    <div class="star-label">{{ $i }} <i class="fas fa-star"></i></div>
                                    <div class="progress">
                                        <div class="progress-bar"
                                            style="width: {{ $ratings->count() ? ($ratingCounts[$i] / $ratings->count()) * 100 : 0 }}%">
                                        </div>
                                    </div>
                                    <div class="progress-value">{{ $ratingCounts[$i] }}</div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <h3 class="mb-3">Customer Reviews</h3>

                    @if ($ratings->count() > 0)
                        @foreach ($ratings as $rating)
                            <div class="review-card">
                                <div class="review-header">
                                    <div class="reviewer-name">{{ $rating->user->name ?? 'Anonymous' }}</div>
                                    <div class="review-date">{{ $rating->created_at->format('F j, Y') }}</div>
                                </div>
                                <div class="review-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $rating->rating)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                @if ($rating->title)
                                    <h5 class="review-title">{{ $rating->title }}</h5>
                                @endif
                                <p class="review-content">{{ $rating->review }}</p>
                            </div>
                        @endforeach
                    @else
                        <div class="no-reviews">
                            <i class="far fa-comment-alt fa-3x mb-3"></i>
                            <h4>No Reviews Yet</h4>
                            <p>Be the first to review this product!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
