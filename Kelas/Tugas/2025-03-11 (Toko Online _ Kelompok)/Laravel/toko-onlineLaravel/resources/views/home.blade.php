{{-- resources/views/home.blade.php --}}

@extends('layouts.app')

@section('title', 'Guitar Shop - Premium Guitars and Accessories')

@section('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&display=swap');

        .banner-section h5 {
            font-family: 'Oswald', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #333;
            letter-spacing: 1.5px;
            text-align: center;
        }

        .product-img {
            height: 500px;
            width: 100%;
            object-fit: contain;
            margin-top: 2rem;
        }

        /* Banner section container */
        .banner-section {
            padding: 20px 0;
        }


        /* Carousel container */
        #staticCarousel,
        #dynamicCarousel {
            background-color: #f8f9fa;
            border-radius: 8px;
            width: 100%;
        }

        /* Carousel item - container for images */
        .carousel-item {
            height: 300px;
            position: relative;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        /* Remove the rotate class styling that was causing the problem */
        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            /* Changed from cover to contain to prevent cropping */
            transition: transform 0.3s ease-in-out;
        }

        /* Navigation arrows */
        .carousel-control-prev,
        .carousel-control-next {
            width: 40px;
            height: 40px;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.8;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            opacity: 1;
        }

        /* Indicator dots */
        .carousel-indicators {
            margin-bottom: 0.5rem;
        }

        .carousel-indicators button {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin: 0 4px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .carousel-item {
                height: 250px;
            }

            .banner-col {
                margin-bottom: 20px;
            }
        }

        .banner {
            margin-top: 3rem;
        }

        .banner {
            margin-top: 3rem;
        }
    </style>
@endsection

@section('content')
    <!-- Banner Section -->
    <div class="container banner mb-4">
        <div class="banner-section">
            <div class="row">
                <!-- Dynamic Banners - Left Column -->
                <div class="col-md-6 banner-col">
                    @if ($dynamicBanners->count() > 0)
                        <div class="h-100">
                            <h5 class="mb-3">Discover Premium Quality at Unbeatable Prices</h5>
                            <div id="dynamicCarousel" class="carousel slide h-100" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    @foreach ($dynamicBanners as $index => $banner)
                                        <button type="button" data-bs-target="#dynamicCarousel"
                                            data-bs-slide-to="{{ $index }}"
                                            @if ($index === 0) class="active" @endif
                                            aria-label="Slide {{ $index + 1 }}">
                                        </button>
                                    @endforeach
                                </div>

                                <div class="carousel-inner rounded h-100">
                                    @foreach ($dynamicBanners as $index => $banner)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ asset('images/' . $banner->image) }}" class="d-block w-100"
                                                alt="Dynamic Banner {{ $index + 1 }}">
                                        </div>
                                    @endforeach
                                </div>

                                <button class="carousel-control-prev" type="button" data-bs-target="#dynamicCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#dynamicCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Static Banners - Right Column -->
                <div class="col-md-6 banner-col">
                    @if ($staticBanners->count() > 0)
                        <div class="h-100">
                            <h5 class="mb-3">Limited Time Only: Up to 70% Off - Shop Before It's Gone</h5>
                            <div id="staticCarousel" class="carousel slide h-100">
                                <div class="carousel-indicators">
                                    @foreach ($staticBanners as $index => $banner)
                                        <button type="button" data-bs-target="#staticCarousel"
                                            data-bs-slide-to="{{ $index }}"
                                            @if ($index === 0) class="active" @endif
                                            aria-label="Slide {{ $index + 1 }}">
                                        </button>
                                    @endforeach
                                </div>

                                <div class="carousel-inner rounded h-100">
                                    @foreach ($staticBanners as $index => $banner)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ asset('images/' . $banner->image) }}" class="d-block w-100"
                                                alt="Static Banner {{ $index + 1 }}">
                                        </div>
                                    @endforeach
                                </div>

                                <button class="carousel-control-prev" type="button" data-bs-target="#staticCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#staticCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="container">
        <div class="row">
            @forelse($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('uploads/' . $product->image) }}" class="card-img-top product-img"
                            alt="{{ $product->name }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                                <button class="btn btn-danger" type="submit">Tambah ke Keranjang</button>
                            </form><br>
                            <hr>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">Tidak ada produk yang tersedia.</p>
                </div>
            @endforelse
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
        // Show modal if product was added to cart
        @if (session('addedToCart'))
            var cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
            cartModal.show();
        @endif

        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.padding = '0.5rem 0';
                navbar.style.backgroundColor = 'rgba(33, 37, 41, 0.98)';
            } else {
                navbar.style.padding = '1rem 0';
                navbar.style.backgroundColor = 'rgba(33, 37, 41, 0.98)';
            }
        });

        // Initialize dynamic carousel with auto-sliding
        const dynamicCarousel = document.getElementById('dynamicCarousel');
        if (dynamicCarousel) {
            const carousel = new bootstrap.Carousel(dynamicCarousel, {
                interval: 5000, // Change slides every 5 seconds
                wrap: true
            });
        }

        // Initialize static carousel without auto-sliding
        const staticCarousel = document.getElementById('staticCarousel');
        if (staticCarousel) {
            const carousel = new bootstrap.Carousel(staticCarousel, {
                interval: false, // Disable auto-sliding for static banners
                wrap: true
            });
        }

        // Update cart badge with animation
        const cartBadge = document.querySelector('.cart-badge');
        if (cartBadge) {
            cartBadge.classList.add('cart-animation');
        }
    </script>
@endsection
