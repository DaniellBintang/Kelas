{{-- filepath: e:\xampp\htdocs\AyamGoreng\resources\views\auth\edit-profile.blade.php --}}
@extends('layouts.app')

@section('head_extras')
    <style>
        .edit-profile-section {
            padding: 70px 0;
            background-color: #f8f9fa;
        }

        .section-header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .section-header h2 {
            font-size: 2.2rem;
            font-weight: 700;
            color: #333;
            position: relative;
            display: inline-block;
        }

        .section-header h2:after {
            content: '';
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background-color: var(--secondary-color, #45b7aa);
        }

        .edit-profile-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .edit-profile-card .card-header {
            background-color: var(--secondary-color, #45b7aa);
            color: white;
            padding: 20px 25px;
            border-bottom: none;
        }

        .card-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #ddd
        }

        .edit-profile-card .card-title {
            font-size: 1.5rem;
            margin-bottom: 0;
        }

        .form-section {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--secondary-color, #45b7aa);
            box-shadow: 0 0 0 0.2rem rgba(69, 183, 170, 0.25);
        }

        .btn-action {
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-save {
            background-color: var(--secondary-color, #45b7aa);
            color: white;
        }

        .btn-save:hover {
            background-color: #3aa89b;
            color: white;
        }

        .btn-cancel {
            background-color: #f8f9fa;
            color: #6c757d;
            border: 1px solid #ddd;
        }

        .btn-cancel:hover {
            background-color: #e9ecef;
            color: #495057;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            padding-top: 15px;
        }

        .invalid-feedback {
            font-size: 0.85rem;
            color: #dc3545;
            margin-top: 5px;
        }

        .input-icon-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 15px;
            color: #6c757d;
        }

        .input-with-icon {
            padding-left: 40px;
        }
    </style>
@endsection

@section('content')
    <div class="edit-profile-section">
        <div class="container">
            <div class="section-header">
                <h2>Edit Profil</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="edit-profile-card card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-user-edit me-2"></i>Ubah Informasi Profil
                            </h3>
                        </div>

                        <div class="card-body form-section">
                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-user input-icon"></i>
                                        <input type="text"
                                            class="form-control input-with-icon @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $user->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-envelope input-icon"></i>
                                        <input type="email"
                                            class="form-control input-with-icon @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email', $user->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="address" class="form-label">Alamat Lengkap</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-map-marker-alt input-icon"></i>
                                        <textarea class="form-control input-with-icon @error('address') is-invalid @enderror" id="address" name="address"
                                            rows="3">{{ old('address', $user->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="form-label">Nomor Telepon</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-phone input-icon"></i>
                                        <input type="text"
                                            class="form-control input-with-icon @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="form-group">
                                    <label for="current_password" class="form-label">Password Saat Ini (kosongkan jika tidak
                                        ingin mengubah password)</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-lock input-icon"></i>
                                        <input type="password"
                                            class="form-control input-with-icon @error('current_password') is-invalid @enderror"
                                            id="current_password" name="current_password">
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="form-label">Password Baru</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-key input-icon"></i>
                                        <input type="password"
                                            class="form-control input-with-icon @error('password') is-invalid @enderror"
                                            id="password" name="password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-key input-icon"></i>
                                        <input type="password" class="form-control input-with-icon"
                                            id="password_confirmation" name="password_confirmation">
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <a href="{{ route('profile.show') }}" class="btn btn-action btn-cancel">
                                        <i class="fas fa-times me-1"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-action btn-save">
                                        <i class="fas fa-save me-1"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
