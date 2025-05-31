<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Restoran</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/restaurant-style.css') }}">
</head>

<body>
    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top shadow-sm">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/10ec2671eb62abe8528dfdb0484f9e8c.png') }}" alt="Restaurant Logo"
                    class="logo-img">
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Section -->
            @include('layouts.partials.navbar')
        </div>
    </nav>

    <!-- Main Content Container -->
    <div class="main-container">
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                @include('layouts.partials.sidebar')

                <div class="col-lg-9 col-md-8 main-content">
                    <div class="menu-title-section mb-4">
                        <h2 class="fw-bold fs-1">Our Delicious Menu</h2>
                        <div class="d-flex align-items-center mt-2">
                            <div class="bg-primary" style="height: 4px; width: 80px; border-radius: 2px;"></div>
                            <p class="ms-3 text-muted">Discover our chef's special creations</p>
                        </div>
                    </div>
                    <div class="menu-grid">
                        <div class="row g-4">
                            @foreach ($menus as $menu)
                                <div class="col-lg-4 col-md-6">
                                    <div class="menu-card h-100">
                                        <div class="menu-image-container">
                                            <img src="{{ asset('images/' . $menu->gambar) }}" class="menu-image"
                                                alt="{{ $menu->menu }}">
                                            <div class="menu-category-badge">
                                                {{ $menu->kategori->kategori }}
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="menu-title">{{ $menu->menu }}</h5>
                                            <p class="menu-description">{{ $menu->deskripsi }}</p>
                                            <div class="menu-footer">
                                                <span class="menu-price">Rp
                                                    {{ number_format($menu->harga, 0, ',', '.') }}</span>
                                                @if (session()->has('idpelanggan'))
                                                    <a href="{{ route('cart.add', $menu->idmenu) }}"
                                                        class="btn btn-primary btn-sm order-btn">
                                                        <i class="fas fa-shopping-cart me-1"></i>
                                                        Pesan
                                                    </a>
                                                @else
                                                    <a href="{{ route('login') }}"
                                                        class="btn btn-primary btn-sm order-btn"
                                                        onclick="event.preventDefault(); showLoginAlert();">
                                                        <i class="fas fa-shopping-cart me-1"></i>
                                                        Pesan
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <!-- Replace the existing pagination section -->
                        @if ($menus->hasPages())
                            <div class="pagination-wrapper mt-5">
                                <nav aria-label="Menu navigation">
                                    <ul class="pagination justify-content-center">
                                        {{-- Previous Page Link --}}
                                        @if ($menus->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <i class="fas fa-chevron-left"></i>
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $menus->previousPageUrl() }}"
                                                    rel="prev">
                                                    <i class="fas fa-chevron-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($menus->getUrlRange(1, $menus->lastPage()) as $page => $url)
                                            @if ($page == $menus->currentPage())
                                                <li class="page-item active">
                                                    <span class="page-link">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($menus->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $menus->nextPageUrl() }}" rel="next">
                                                    <i class="fas fa-chevron-right"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <i class="fas fa-chevron-right"></i>
                                                </span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    @include('layouts.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Tambahkan sebelum closing tag </body> -->
    <script>
        function showLoginAlert() {
            alert('Silakan login terlebih dahulu untuk melakukan pemesanan');
            window.location.href = '{{ route('login') }}';
        }
    </script>

</body>

</html>
