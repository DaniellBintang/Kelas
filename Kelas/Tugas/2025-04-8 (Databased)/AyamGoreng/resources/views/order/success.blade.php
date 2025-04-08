@extends('layouts.app')

@section('head_extras')
    <style>
        .success-section {
            padding: 80px 0;
            text-align: center;
        }

        .success-icon {
            font-size: 5rem;
            color: #28a745;
            margin-bottom: 20px;
        }

        .success-message {
            margin-bottom: 30px;
        }

        .btn-home {
            background-color: var(--secondary-color);
            color: white;
            font-weight: 600;
            padding: 10px 30px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-home:hover {
            background-color: #45b7aa;
            color: white;
        }
    </style>
@endsection

@section('content')
    <div class="success-section">
        <div class="container">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="success-message">
                <h1>Pesanan Berhasil!</h1>
                <p>Terima kasih telah melakukan pemesanan. Pesanan Anda sedang diproses.</p>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div>
                <a href="{{ url('/menu') }}" class="btn btn-home">Kembali ke Menu</a>
            </div>
        </div>
    </div>
@endsection
