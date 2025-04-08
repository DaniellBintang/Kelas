{{-- filepath: e:\xampp\htdocs\AyamGoreng\resources\views\auth\profile.blade.php --}}
@extends('layouts.app')

@section('head_extras')
    <style>
        .profile-section {
            padding: 70px 0;
            background-color: #f8f9fa;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .profile-header h2 {
            font-size: 2.2rem;
            font-weight: 700;
            color: #333;
            position: relative;
            display: inline-block;
        }

        .profile-header h2:after {
            content: '';
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background-color: var(--secondary-color, #45b7aa);
        }

        .profile-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .profile-card .card-header {
            background-color: var(--secondary-color, #45b7aa);
            color: white;
            padding: 25px;
            border-bottom: none;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: #fff;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: 5px solid rgba(255, 255, 255, 0.3);
            overflow: hidden;
            position: relative;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-avatar .avatar-text {
            font-size: 3rem;
            font-weight: bold;
            color: var(--secondary-color, #45b7aa);
        }

        .profile-avatar:hover .avatar-overlay {
            opacity: 1;
        }

        .avatar-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            cursor: pointer;
        }

        .avatar-overlay i {
            color: white;
            font-size: 1.5rem;
        }

        .card-title {
            font-size: 2rem;
            font-weight: 600;
            color: #fff;
            margin-top: 10px;
        }

        .profile-card .card-title {
            text-align: center;
            font-size: 1.8rem;
            margin-bottom: 0;
        }

        .profile-info {
            padding: 30px;
        }

        .info-item {
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .info-label {
            font-weight: 600;
            color: #555;
            min-width: 140px;
            display: flex;
            align-items: center;
        }

        .info-label i {
            margin-right: 10px;
            color: var(--secondary-color, #45b7aa);
        }

        .info-value {
            flex-grow: 1;
            font-weight: 500;
            color: #333;
        }

        .profile-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .btn-profile {
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background-color: var(--secondary-color, #45b7aa);
            color: white;
        }

        .btn-edit:hover {
            background-color: #3aa89b;
            color: white;
        }

        .btn-logout {
            background-color: #ff6b6b;
            color: white;
            border: none;
        }

        .btn-logout:hover {
            background-color: #ff5252;
        }

        .alert-success {
            border-radius: 10px;
            border-left: 4px solid #28a745;
        }

        #avatar-upload-modal .modal-content {
            border-radius: 15px;
            border: none;
        }

        #avatar-upload-modal .modal-header {
            background-color: var(--secondary-color, #45b7aa);
            color: white;
            border-bottom: none;
            border-radius: 15px 15px 0 0;
        }

        #avatar-upload-modal .modal-footer {
            border-top: none;
        }

        #avatar-upload-form .avatar-preview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
            border: 3px solid var(--secondary-color, #45b7aa);
        }

        #avatar-upload-form .avatar-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
            background-color: #f8f9fa;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .custom-file-upload:hover {
            background-color: #e9ecef;
        }
    </style>
@endsection

@section('content')
    <div class="profile-section">
        <div class="container">
            <div class="profile-header">
                <h2>Profil Pengguna</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="profile-card card">
                        <div class="card-header">
                            <div class="profile-avatar" data-bs-toggle="modal" data-bs-target="#avatar-upload-modal">
                                @if ($user->avatar)
                                    <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="{{ $user->name }}"
                                        id="current-avatar">
                                @else
                                    <div class="avatar-text">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                @endif
                                <div class="avatar-overlay">
                                    <i class="fas fa-camera"></i>
                                </div>
                            </div>
                            <h3 class="card-title">{{ $user->name }}</h3>
                        </div>

                        <div class="card-body profile-info">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-envelope"></i> Email
                                </div>
                                <div class="info-value">{{ $user->email }}</div>
                            </div>

                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-map-marker-alt"></i> Alamat
                                </div>
                                <div class="info-value">{{ $user->address ?: 'Belum diatur' }}</div>
                            </div>

                            @if (isset($user->phone))
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="fas fa-phone"></i> Telepon
                                    </div>
                                    <div class="info-value">{{ $user->phone }}</div>
                                </div>
                            @endif

                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-calendar-alt"></i> Member Sejak
                                </div>
                                <div class="info-value">{{ $user->created_at->format('d M Y') }}</div>
                            </div>

                            <div class="profile-actions">
                                <a href="{{ route('profile.edit') }}" class="btn btn-profile btn-edit">
                                    <i class="fas fa-user-edit"></i> Edit Profil
                                </a>

                                <a href="{{ route('logout') }}" class="btn btn-profile btn-logout"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- filepath: e:\xampp\htdocs\AyamGoreng\resources\views\auth\profile.blade.php --}}
                    <div class="profile-card card mt-4">
                        <div class="card-body">
                            <h5 class="mb-3">Pesanan Terakhir</h5>

                            @if ($user->orders->isEmpty())
                                <div class="text-center py-4">
                                    <p class="text-muted">Belum ada pesanan terbaru</p>
                                    <a href="{{ url('/menu') }}" class="btn btn-profile btn-edit mt-2">
                                        <i class="fas fa-utensils"></i> Pesan Sekarang
                                    </a>
                                </div>
                            @else
                                <ul class="list-group">
                                    @foreach ($user->orders->take(5) as $order)
                                        <li class="list-group-item">
                                            <strong>Pesanan #{{ $order->id }}</strong> - Rp
                                            {{ number_format($order->total_price, 0, ',', '.') }}
                                            <br>
                                            <small>Status: {{ ucfirst($order->status) }}</small>
                                            <br>
                                            <small>Waktu: {{ $order->created_at->format('d M Y, H:i') }}</small>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Avatar Upload -->
    <div class="modal fade" id="avatar-upload-modal" tabindex="-1" aria-labelledby="avatarUploadModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="avatarUploadModalLabel">Upload Foto Profil</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="avatar-upload-form" action="{{ route('profile.avatar.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="text-center mb-4">
                            <div class="avatar-preview">
                                @if ($user->avatar)
                                    <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="{{ $user->name }}"
                                        id="avatar-preview-img">
                                @else
                                    <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar"
                                        id="avatar-preview-img">
                                @endif
                            </div>
                            <div class="mt-3">
                                <label for="avatar" class="custom-file-upload">
                                    <i class="fas fa-upload"></i> Pilih Foto
                                </label>
                                <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*">
                                <p class="text-muted small mt-2">Format yang diterima: JPG, PNG, GIF (Maks. 2MB)</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-edit">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const avatarInput = document.getElementById('avatar');
            const previewImg = document.getElementById('avatar-preview-img');

            avatarInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                    }

                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
