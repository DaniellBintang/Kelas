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
            height: auto;
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
            <img src="{{ asset('images/ayamgoreng.jpg') }}" alt="Ayam Goreng Classic">

            <!-- Nama Menu -->
            <h1>Ayam Goreng Classic</h1>

            <!-- Deskripsi Menu -->
            <p>
                Ayam Goreng Classic adalah menu andalan kami yang menghadirkan cita rasa autentik dari resep rahasia
                keluarga.
                Dengan bumbu yang meresap hingga ke dalam daging, ayam ini digoreng hingga renyah di luar dan juicy di
                dalam.
                Cocok untuk dinikmati kapan saja bersama keluarga dan teman.
            </p>

            <!-- Resep Menu -->
            <div class="menu-recipe">
                <h2>Resep Menu</h2>
                <ul>
                    <li>1 ekor ayam segar, potong sesuai selera</li>
                    <li>5 siung bawang putih, haluskan</li>
                    <li>2 sdm ketumbar bubuk</li>
                    <li>1 sdt kunyit bubuk</li>
                    <li>1 sdm garam</li>
                    <li>1 sdt gula pasir</li>
                    <li>500 ml minyak goreng</li>
                    <li>Air secukupnya untuk merebus</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
