@extends('layouts.front')

@section('content')
    <div class="container py-5">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-primary mb-3">Menu {{ $kategori->kategori }}</h1>
            <div class="mx-auto" style="width: 100px; height: 3px; background: linear-gradient(45deg, #007bff, #0056b3);">
            </div>
        </div>

        @if ($menus->count() > 0)
            <!-- Menu Cards Grid -->
            <div class="row g-4 mb-5">
                @foreach ($menus as $menu)
                    <div class="col-lg-4 col-md-6 col-sm-12">
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
                                <p class="menu-description">{{ Str::limit($menu->deskripsi, 80) }}</p>
                                <div class="menu-footer">
                                    <span class="menu-price">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                                    @if (session()->has('idpelanggan'))
                                        <a href="{{ route('cart.add', $menu->idmenu) }}"
                                            class="btn btn-primary btn-sm order-btn">
                                            <i class="fas fa-shopping-cart me-1"></i>
                                            Pesan
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm order-btn"
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
        @else
            <!-- Empty State -->
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-utensils text-muted" style="font-size: 4rem;"></i>
                </div>
                <h4 class="text-muted mb-3">Tidak ada menu dalam kategori ini</h4>
                <p class="text-muted">Silakan pilih kategori lain atau kembali nanti.</p>
                <a href="{{ url('/') }}" class="btn btn-outline-primary mt-3">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                </a>
            </div>
        @endif

        <!-- Pagination -->
        @if ($menus->count() > 0)
            <div class="d-flex justify-content-center mt-5">
                <div class="pagination-wrapper">
                    {{ $menus->links() }}
                </div>
            </div>
        @endif
    </div>

    <!-- Tambahkan sebelum closing tag </body> -->
    <script>
        function showLoginAlert() {
            alert('Silakan login terlebih dahulu untuk melakukan pemesanan');
            window.location.href = '{{ route('login') }}';
        }
    </script>

    <!-- Font Awesome untuk Icons (jika belum ada) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
