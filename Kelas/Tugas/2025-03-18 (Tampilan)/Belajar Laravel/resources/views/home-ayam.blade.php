@extends('layouts.app1')

@section('head_extras')
    <style>
        /* Gradient Background and Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                url('{{ asset('images/chicken-background.jpg') }}') no-repeat center center;
            background-size: cover;
            color: white;
            text-align: center;
            padding: 200px 0;
            position: relative;
            width: 99.8vw;
            margin-left: calc(-50vw + 50%);
        }

        .hero-content {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 25px;
            line-height: 1.2;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 40px;
            font-weight: 300;
        }

        /* Tombol Order */
        .btn-order {
            background-color: var(--secondary-color, #4ECDC4);
            border: none;
            color: white;
            padding: 15px 50px;
            font-size: 1.2rem;
            font-weight: 700;
            border-radius: 10px;
            transition: all 0.4s ease;
            text-transform: uppercase;
            letter-spacing: 2px;
            box-shadow: 0 15px 25px rgba(78, 205, 196, 0.4);
        }

        .btn-order:hover {
            background-color: #45b7aa;
            transform: translateY(-7px);
            box-shadow: 0 20px 30px rgba(78, 205, 196, 0.5);
        }

        /* Bagian Tentang Kami */
        .about-section {
            padding: 100px 0;
            background-color: #f8f9fa;
        }

        .about-content {
            display: flex;
            align-items: center;
            gap: 50px;
        }

        .about-image {
            flex: 1;
            border-radius: 15px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .about-image img {
            width: 100%;
            height: auto;
            transition: transform 0.4s ease;
        }

        .about-image img:hover {
            transform: scale(1.1);
        }

        .about-text {
            flex: 1;
        }

        .about-text h2 {
            font-size: 3rem;
            margin-bottom: 25px;
            color: #333;
        }

        .about-text p {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.8;
        }

        /* Bagian Menu Unggulan */
        .featured-menu {
            padding: 100px 0;
            background-color: white;
        }

        .featured-menu h2 {
            text-align: center;
            margin-bottom: 50px;
            font-size: 3rem;
            color: #333;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .menu-item {
            text-align: center;
            background-color: #f8f9fa;
            border-radius: 15px;
            padding: 30px;
            transition: all 0.4s ease;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .menu-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .menu-item img {
            width: 100%;
            height: 400px;
            /* Tetapkan tinggi tetap untuk gambar */
            object-fit: cover;
            /* Memastikan gambar dipotong secara proporsional */
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .menu-item h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #333;
        }

        .menu-item p {
            color: #666;
            margin-bottom: 20px;
        }

        /* Bagian Testimonial */
        .testimonials {
            background-color: #f8f9fa;
            padding: 100px 0;
            text-align: center;
        }

        .testimonials h2 {
            margin-bottom: 50px;
            font-size: 3rem;
            color: #333;
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .testimonial-card {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .testimonial-card p {
            font-style: italic;
            color: #666;
            margin-bottom: 20px;
        }

        .testimonial-author {
            font-weight: 600;
            color: #333;
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Ayam Goreng Jos</h1>
            <p class="hero-subtitle">Kelezatan Ayam Goreng Renyah dengan Bumbu Rahasia Keluarga</p>
            <a href="{{ url('/menu') }}" class="btn btn-order">Pesan Sekarang</a>
        </div>
    </div>

    <!-- Tentang Kami -->
    <div class="about-section container">
        <div class="about-content">
            <div class="about-image">
                <img src="{{ asset('images/restaurant.jpg') }}" alt="Ayam Goreng Jos Restaurant">
            </div>
            <div class="about-text">
                <h2>Tentang Kami</h2>
                <p>Ayam Goreng Jos adalah destinasi kuliner untuk pecinta ayam goreng sejati. Dengan resep turun-temurun
                    yang telah disempurnakan selama puluhan tahun, kami menghadirkan cita rasa autentik dan kualitas premium
                    dalam setiap gigitan.</p>
                <p>Kami menggunakan bahan-bahan pilihan, bumbu rahasia keluarga, dan teknik penggorengan khusus untuk
                    menghasilkan ayam goreng yang renyah di luar, juicy di dalam, dan memiliki cita rasa yang tak
                    tertandingi.</p>
            </div>
        </div>
    </div>

    <!-- Menu Unggulan -->
    <div class="featured-menu container">
        <h2>Menu Favorit Kami</h2>
        <div class="menu-grid">
            <div class="menu-item">
                <img src="{{ asset('images/ayamgoreng.jpg') }}" alt="Ayam Original">
                <h3>Ayam Goreng Classic</h3>
                <p>Ayam goreng klasik dengan bumbu rahasia yang membuat lidah ketagihan.</p>
                <a href="{{ url('/menu/ayam-original') }}" class="btn btn-secondary">Lihat Detail</a>
            </div>
            <div class="menu-item">
                <img src="{{ asset('images/saltedegg.jpg') }}" alt="Ayam Telur Asin">
                <h3>Ayam Telur Asin</h3>
                <p>Ayam goreng renyah yang dilapisi saus telur asin creamy dengan rasa gurih yang menggoda.</p>
                <a href="{{ url('/menu/ayam-telurasin') }}" class="btn btn-secondary">Lihat Detail</a>
            </div>
            <div class="menu-item">
                <img src="{{ asset('images/chicken-strips.jpg') }}" alt="Ayam Premium">
                <h3>Ayam Potong</h3>
                <p>Potongan ayam pilihan dengan perpaduan bumbu mewah.</p>
                <a href="{{ url('/menu/ayam-potong') }}" class="btn btn-secondary">Lihat Detail</a>
            </div>
        </div>
    </div>

    <!-- Testimonial -->
    <div class="testimonials container">
        <h2>Kata Mereka Tentang Kami</h2>
        <div class="testimonial-grid">
            <div class="testimonial-card">
                <p>"Ayam gorengnya luar biasa! Renyah, gurih, dan bumbu yang menempel pas banget."</p>
                <p class="testimonial-author">- Sarah K.</p>
            </div>
            <div class="testimonial-card">
                <p>"Sudah berkali-kali datang, selalu suka sama cita rasa ayam gorengnya. Recommended!"</p>
                <p class="testimonial-author">- Michael L.</p>
            </div>
            <div class="testimonial-card">
                <p>"Pelayanannya ramah, suasana nyaman, dan ayamnya top banget. Pasti balik lagi!"</p>
                <p class="testimonial-author">- Emma W.</p>
            </div>
        </div>
    </div>
@endsection
