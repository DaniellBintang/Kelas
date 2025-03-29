@extends('layouts.app1')

@section('head_extras')
    <style>
        .menu-detail-section {
            padding: 60px 0;
        }

        .menu-detail-container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .menu-detail-container img {
            width: 100%;
            max-width: 500px;
            /* Lebar maksimal gambar */
            height: 500px;
            /* Tetapkan tinggi tetap untuk gambar horizontal */
            object-fit: cover;
            /* Memastikan gambar dipotong secara proporsional */
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .menu-detail-container h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .menu-detail-container p {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .menu-recipe {
            text-align: left;
            margin-top: 40px;
        }

        .menu-recipe h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .menu-recipe ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        .menu-recipe ul li {
            font-size: 1rem;
            color: #666;
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="menu-detail-section">
        <div class="menu-detail-container">
            <!-- Gambar Menu -->
            <img src="{{ asset('images/saltedegg.jpg') }}" alt="Ayam Telur Asin">

            <!-- Nama Menu -->
            <h1>Ayam Telur Asin</h1>

            <!-- Deskripsi Menu -->
            <p>
                Ayam Telur Asin adalah menu spesial kami yang memadukan ayam goreng renyah dengan saus telur asin creamy.
                Rasa gurih dan tekstur lembut dari saus telur asin membuat menu ini menjadi favorit pelanggan kami.
                Cocok dinikmati kapan saja, baik untuk makan siang maupun makan malam.
            </p>

            <!-- Resep Menu -->
            <div class="menu-recipe">
                <h2>Resep Menu</h2>
                <ul>
                    <li>500 gram ayam fillet, potong sesuai selera</li>
                    <li>3 butir kuning telur asin, haluskan</li>
                    <li>2 siung bawang putih, cincang halus</li>
                    <li>2 sdm margarin</li>
                    <li>1 sdt gula pasir</li>
                    <li>1/2 sdt garam</li>
                    <li>1/2 sdt lada bubuk</li>
                    <li>Minyak goreng secukupnya</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
