@extends('layouts.app')

@section('title', 'Order History')

@section('styles')
    <style>
        .order-history-section {
            background-color: white;
            padding: 2rem 0;
            margin-top: 5rem;
        }

        .order-card {
            border: none;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            cursor: pointer;
        }

        .order-card:hover {
            transform: translateY(-5px);
        }

        .order-header {
            background-color: #dc3545;
            color: white;
            padding: 1rem;
            border-radius: 8px 8px 0 0;
        }

        .order-body {
            padding: 1.5rem;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.8rem;
        }

        .status-pending {
            background-color: #ffeeba;
            color: #856404;
        }

        .status-processing {
            background-color: #b3e5fc;
            color: #01579b;
        }

        .status-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        .order-details {
            margin-top: 1rem;
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 4px;
        }

        .price {
            color: #dc3545;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .empty-orders {
            text-align: center;
            padding: 3rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .empty-orders i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 1rem;
        }

        .modal-product-image {
            width: 100px;
            height: 100px;
            object-fit: contain;
            border-radius: 8px;
            border: 1px solid #eee;
            background-color: #fff;
            padding: 5px;
        }

        .order-item {
            border-bottom: 1px solid #eee;
            padding: 1rem 0;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .product-image-container {
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        /* Star rating styles */
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
        }

        .rating input {
            display: none;
        }

        .rating label {
            cursor: pointer;
            width: 40px;
            height: 40px;
            font-size: 30px;
            color: #ccc;
            transition: all 0.2s;
            margin: 0 5px;
        }

        .rating label:before {
            content: '★';
        }

        .rating input:checked~label {
            color: #ffd700;
        }

        .rating:not(:checked) label:hover,
        .rating:not(:checked) label:hover~label {
            color: #ffc107;
        }

        .review-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            transition: all 0.3s;
        }

        .review-btn:hover {
            background-color: #c81e1e;
            color: white;
        }

        .rated-badge {
            background-color: #28a745;
            color: white;
            padding: 0.3rem 0.6rem;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .modal-product-image {
                width: 80px;
                height: 80px;
            }

            .product-image-container {
                width: 80px;
                height: 80px;
            }

            .modal .order-item .col-2 {
                width: 90px;
                min-width: 90px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="order-history-section">
        <div class="container">
            <h2 class="text-center mb-4">Order History</h2>

            @if ($orders->isEmpty())
                <div class="empty-orders">
                    <i class="fas fa-shopping-bag"></i>
                    <h3>No Orders Yet</h3>
                    <p>Start shopping to see your orders here!</p>
                    <a href="{{ route('shop') }}" class="btn btn-primary mt-3">Shop Now</a>
                </div>
            @else
                <!-- Active Orders Section -->
                <h3 class="mb-3">Active Orders</h3>
                @php $hasActiveOrders = false; @endphp
                @foreach ($orders as $order)
                    @if ($order->status == 'Pending' || $order->status == 'Processing')
                        @php $hasActiveOrders = true; @endphp
                        <div class="order-card card" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}">
                            <div class="order-header d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0">Order #{{ $order->id }}</h5>
                                    <small>{{ $order->created_at->format('F j, Y') }}</small>
                                </div>
                                <span class="status-badge status-{{ strtolower($order->status) }}">
                                    {{ $order->status }}
                                </span>
                            </div>
                            <div class="order-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Shipping Address:</h6>
                                        <p>
                                            {{ $order->shipping_address }}<br>
                                            {{ $order->shipping_city }}<br>
                                            {{ $order->shipping_postal_code }}
                                        </p>
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        <h6>Total Amount:</h6>
                                        <p class="price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                @if (!$hasActiveOrders)
                    <div class="alert alert-info">You don't have any active orders at the moment.</div>
                @endif

                <!-- Completed Orders Section -->
                <h3 class="mb-3 mt-5">Order History</h3>
                @php $hasCompletedOrders = false; @endphp
                @foreach ($orders as $order)
                    @if ($order->status == 'Completed' || $order->status == 'Cancelled')
                        @php $hasCompletedOrders = true; @endphp
                        <div class="order-card card" data-bs-toggle="modal"
                            data-bs-target="#orderModal{{ $order->id }}">
                            <div class="order-header d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0">Order #{{ $order->id }}</h5>
                                    <small>{{ $order->created_at->format('F j, Y') }}</small>
                                </div>
                                <div>
                                    <span class="status-badge status-{{ strtolower($order->status) }}">
                                        {{ $order->status }}
                                    </span>
                                    @if ($order->status == 'Completed' && $order->has_been_rated)
                                        <span class="rated-badge ms-2">
                                            <i class="fas fa-star"></i> Rated
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="order-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Shipping Address:</h6>
                                        <p>
                                            {{ $order->shipping_address }}<br>
                                            {{ $order->shipping_city }}<br>
                                            {{ $order->shipping_postal_code }}
                                        </p>
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        <h6>Total Amount:</h6>
                                        <p class="price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                @if (!$hasCompletedOrders)
                    <div class="alert alert-info">You don't have any completed or canceled orders yet.</div>
                @endif

                <!-- Order Detail Modals -->
                @foreach ($orders as $order)
                    <!-- Order Detail Modal -->
                    <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1"
                        aria-labelledby="orderModalLabel{{ $order->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="orderModalLabel{{ $order->id }}">
                                        Order Details #{{ $order->id }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="order-info mb-4">
                                        <h6>Order Information</h6>
                                        <p>Date: {{ $order->created_at->format('F j, Y') }}</p>
                                        <p>Status: <span
                                                class="status-badge status-{{ strtolower($order->status) }}">{{ $order->status }}</span>
                                        </p>
                                        <p>Shipping Address:<br>
                                            {{ $order->shipping_address }}<br>
                                            {{ $order->shipping_city }}<br>
                                            {{ $order->shipping_postal_code }}
                                        </p>
                                    </div>

                                    <h6>Ordered Items</h6>
                                    @foreach ($order->items as $item)
                                        <div class="order-item">
                                            <div class="row align-items-center">
                                                <div class="col-2">
                                                    <img src="{{ asset('uploads/' . $item->product->image) }}"
                                                        alt="{{ $item->product->name }}" class="modal-product-image">
                                                </div>
                                                <div class="col-6">
                                                    <h6>{{ $item->product->name }}</h6>
                                                    <p class="mb-0">Quantity: {{ $item->quantity }}</p>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <p class="price mb-0">Rp {{ number_format($item->price, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="total-section mt-4 text-end">
                                        <h5>Total Amount: <span class="price">Rp
                                                {{ number_format($order->total_price, 0, ',', '.') }}</span></h5>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    @if ($order->status == 'Completed' && !$order->has_been_rated)
                                        <button type="button" class="btn review-btn" data-bs-toggle="modal"
                                            data-bs-target="#reviewModal{{ $order->id }}">
                                            <i class="fas fa-star"></i> Rate & Review
                                        </button>
                                    @elseif($order->status == 'Completed' && $order->has_been_rated)
                                        <span class="rated-badge">
                                            <i class="fas fa-check-circle"></i> Order Rated
                                        </span>
                                    @endif
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($order->status == 'Completed' && !$order->has_been_rated)
                        <!-- Review Modal -->
                        <div class="modal fade" id="reviewModal{{ $order->id }}" tabindex="-1"
                            aria-labelledby="reviewModalLabel{{ $order->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="reviewModalLabel{{ $order->id }}">
                                            Rate Your Order #{{ $order->id }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Please select an item to review:</p>
                                        <form id="reviewForm{{ $order->id }}" data-order-id="{{ $order->id }}">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                                            <div class="mb-3">
                                                <label class="form-label">Product</label>
                                                <select class="form-select" name="product_id" required>
                                                    <option value="">Select Product to Review</option>
                                                    @foreach ($order->items as $item)
                                                        <option value="{{ $item->product->id }}">
                                                            {{ $item->product->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3 text-center">
                                                <label class="form-label">Your Rating</label>
                                                <div class="rating">
                                                    <input type="radio" id="star5{{ $order->id }}" name="rating"
                                                        value="5" required />
                                                    <label for="star5{{ $order->id }}"></label>
                                                    <input type="radio" id="star4{{ $order->id }}" name="rating"
                                                        value="4" />
                                                    <label for="star4{{ $order->id }}"></label>
                                                    <input type="radio" id="star3{{ $order->id }}" name="rating"
                                                        value="3" />
                                                    <label for="star3{{ $order->id }}"></label>
                                                    <input type="radio" id="star2{{ $order->id }}" name="rating"
                                                        value="2" />
                                                    <label for="star2{{ $order->id }}"></label>
                                                    <input type="radio" id="star1{{ $order->id }}" name="rating"
                                                        value="1" />
                                                    <label for="star1{{ $order->id }}"></label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="review{{ $order->id }}" class="form-label">Your
                                                    Review</label>
                                                <textarea class="form-control" id="review{{ $order->id }}" name="review" rows="4" required
                                                    placeholder="Tell us about your experience with this product..."></textarea>
                                            </div>

                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-primary">Submit Review</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle review form submission
            const reviewForms = document.querySelectorAll('form[id^="reviewForm"]');
            reviewForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);

                    fetch('{{ route('order-history.submit-review') }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Server responded with status ' + response
                                    .status);
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Close all modals
                                const modals = document.querySelectorAll('.modal');
                                modals.forEach(modal => {
                                    const modalInstance = bootstrap.Modal.getInstance(
                                        modal);
                                    if (modalInstance) {
                                        modalInstance.hide();
                                    }
                                });

                                // Show success message and reload page
                                alert('Thank you for your review!');
                                window.location.reload();
                            } else {
                                alert('Error: ' + (data.message || 'Unknown error'));
                            }
                        })
                        .catch(error => {
                            console.error('Error details:', error);
                            alert(
                                'An error occurred while submitting your review. Please try again.');
                        });
                });
            });
        });
    </script>
@endsection
