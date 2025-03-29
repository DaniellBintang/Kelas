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
            height: 300px;
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
            <img src="{{ asset('images/chicken-strips.jpg') }}" alt="Ayam Potong">

            <!-- Nama Menu -->
            <h1>Ayam Potong</h1>

            <!-- Deskripsi Menu -->
            <p>
                Ayam Potong adalah pilihan sempurna untuk Anda yang menginginkan potongan ayam berkualitas dengan bumbu
                mewah. Setiap potongan ayam dipilih dengan cermat dan dimasak menggunakan teknik khusus untuk menghasilkan
                rasa yang lezat dan tekstur yang sempurna.
            </p>

            <!-- Resep Menu -->
            <div class="menu-recipe">
                <h2>Resep Menu</h2>
                <ul>
                    <li>500 gram ayam potong, bersihkan</li>
                    <li>3 siung bawang putih, haluskan</li>
                    <li>1 sdm ketumbar bubuk</li>
                    <li>1 sdt kunyit bubuk</li>
                    <li>1 sdt garam</li>
                    <li>1/2 sdt lada bubuk</li>
                    <li>Minyak goreng secukupnya</li>
                    <li>Air secukupnya untuk merebus</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
