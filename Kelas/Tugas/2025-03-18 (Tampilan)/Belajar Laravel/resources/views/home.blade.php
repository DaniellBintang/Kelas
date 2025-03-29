@extends('layouts.homeapp')

@section('content')
    <div class="container home-selection-page mt-4">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-12 text-center">
                <h1 class="display-4 mb-4 fade-in">Selamat Datang!</h1>
                <p class="lead mb-5 fade-in">Pilih halaman yang ingin Anda kunjungi:</p>

                <div class="d-flex justify-content-center align-items-center gap-4">
                    <!-- Ayam Website Card -->
                    <div class="website-card website-card-ayam">
                        <div class="website-card-inner">
                            <div class="website-card-front">
                                <img src="{{ asset('images/ayam.png') }}" alt="Ayam Icon" class="website-icon">
                                <h3 class="mt-3">Ayam Goreng Jos</h3>
                            </div>
                            <div class="website-card-back">
                                <a href="{{ url('/ayam') }}" class="btn-card-full btn-ayam">
                                    🍗 Masuk Halaman Ayam
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Sekolah Website Card -->
                    <div class="website-card website-card-sekolah">
                        <div class="website-card-inner">
                            <div class="website-card-front">
                                <img src="{{ asset('images/school.png') }}" alt="Sekolah Icon" class="website-icon">
                                <h3 class="mt-3">Halaman Sekolah</h3>
                            </div>
                            <div class="website-card-back">
                                <a href="{{ url('/sekolah') }}" class="btn-card-full btn-sekolah">
                                    🏫 Masuk Halaman Sekolah
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
        <style>
            .home-selection-page {
                background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
                position: relative;
            }

            .website-card {
                perspective: 1000px;
                width: 250px;
                height: 350px;
                position: relative;
                transition: all 0.6s ease;
            }

            .website-card-inner {
                position: relative;
                width: 100%;
                height: 100%;
                text-align: center;
                transition: transform 0.6s;
                transform-style: preserve-3d;
                cursor: pointer;
                border-radius: 15px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            }

            .website-card:hover .website-card-inner {
                transform: rotateY(180deg);
            }

            .website-card-front,
            .website-card-back {
                position: absolute;
                width: 100%;
                height: 100%;
                backface-visibility: hidden;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                border-radius: 15px;
            }

            .website-card-front {
                background: white;
                z-index: 2;
                padding: 20px;
            }

            .website-card-back {
                transform: rotateY(180deg);
                background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 15px;
            }

            /* New Full Card Button Styles */
            .btn-card-full {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                text-decoration: none;
                font-size: 1.1rem;
                font-weight: 600;
                border: none;
                border-radius: 15px;
                transition: all 0.3s ease;
                color: white;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            .btn-ayam {
                background-color: #FFC107;
                color: #000;
            }

            .btn-sekolah {
                background-color: #007BFF;
                color: white;
            }

            .btn-card-full:hover {
                opacity: 0.9;
                transform: scale(1.02);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            }

            .website-icon {
                width: 120px;
                height: 120px;
                transition: transform 0.3s ease;
            }

            .website-card:hover .website-icon {
                transform: scale(1.1);
            }

            .website-card-ayam .website-card-front {
                border-bottom: 4px solid #FFC107;
            }

            .website-card-sekolah .website-card-front {
                border-bottom: 4px solid #007BFF;
            }

            .fade-in {
                animation: fadeIn 1s ease-in;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @media (max-width: 768px) {
                .d-flex {
                    flex-direction: column;
                    gap: 20px !important;
                }

                .website-card {
                    width: 250px;
                    height: 300px;
                }
            }
        </style>
    @endpush
