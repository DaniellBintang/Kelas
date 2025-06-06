{{-- resources/views/shop.blade.php --}}

@extends('layouts.app')

@section('title', 'Shop - Guitar Store')

@section('styles')
    <style>
        .shop-container {
            padding: 2rem 0;
            margin-top: 5rem;
            background-color: #f8f9fa;
        }

        .shop-header {
            background-color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .filter-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .sort-select {
            padding: 0.5rem;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            padding: 1rem;
        }

        .product-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image-container {
            position: relative;
            padding-top: 100%;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        .product-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 1rem;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .product-details {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #333;
            height: 2.8em;
            /* Fixed height for title, approximately 2 lines */
            overflow: hidden;
        }

        .product-price {
            font-size: 1.2rem;
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .add-to-cart-btn {
            width: 100%;
            padding: 0.8rem;
            background-color: var(--primary-color);
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
            /* Push button to bottom */
        }

        .add-to-cart-btn:hover {
            background-color: #c41820;
            transform: translateY(-2px);
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .cart-badge {
            position: absolute;
            top: -12px;
            right: -8px;
        }

        .cart-icon {
            bottom: -1px;
        }
    </style>
@endsection

@section('content')
    <div class="shop-header mt-4">
        <div class="container">
            <h1 class="text-center mt-4 mb-4">Our Guitar Collection</h1>
            <div class="filter-section">
                <div class="sort-dropdown">
                    <select class="sort-select" id="sortSelect">
                        <option value="name_asc" {{ $sort == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                        <option value="name_desc" {{ $sort == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                        <option value="price_asc" {{ $sort == 'price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
                        <option value="price_desc" {{ $sort == 'price_desc' ? 'selected' : '' }}>Price (High to Low)
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="shop-container">
        <div class="container">
            @if ($products->count() > 0)
                <div class="product-grid">
                    @foreach ($products as $product)
                        <div class="product-card">
                            <div class="product-image-container">
                                <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="product-image">
                            </div>
                            <div class="product-details">
                                <h3 class="product-name">{{ $product->name }}</h3>
                                <p class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <form action="{{ route('shop.addToCart') }}" method="POST" class="add-to-cart-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" name="add_to_cart" class="add-to-cart-btn">
                                        <i class="fas fa-shopping-cart"></i>
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-guitar fa-3x mb-3"></i>
                    <h3>No Products Found</h3>
                    <p>We're currently restocking our inventory. Please check back later.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Notification -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Produk Ditambahkan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
                        <p>Produk berhasil ditambahkan ke keranjang!</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('cart.index') }}" class="btn btn-primary">Lihat Keranjang</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Lanjut Belanja</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sort select functionality
            const sortSelect = document.getElementById('sortSelect');
            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    window.location.href = '{{ route('shop') }}?sort=' + this.value;
                });
            }

            // Add to cart animation
            const addToCartForms = document.querySelectorAll('.add-to-cart-form');
            addToCartForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const button = this.querySelector('.add-to-cart-btn');
                    button.innerHTML = '<i class="fas fa-check"></i> Added!';
                    button.style.backgroundColor = '#28a745';

                    // We're not preventing default because we want the form to submit
                    // This is just for visual feedback before the page reloads
                });
            });

            // Show modal with animation if product was added to cart
            @if (session('addedToCart'))
                const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
                cartModal.show();

                // Update cart badge with animation
                const cartBadge = document.querySelector('.cart-badge');
                if (cartBadge) {
                    cartBadge.classList.add('cart-animation');
                }
            @endif
        });
    </script>
@endsection
