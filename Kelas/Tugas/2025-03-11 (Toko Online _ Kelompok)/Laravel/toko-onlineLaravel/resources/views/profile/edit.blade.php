{{-- resources/views/profile/edit.blade.php --}}

@extends('layouts.app')

@section('title', 'My Profile')

@section('styles')
    <style>
        .profile-card {
            border: none;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-top: 2rem;
        }

        .profile-card:hover {
            transform: translateY(-5px);
        }

        .profile-card .card-header {
            background-color: var(--primary-color);
            color: white;
            padding: 1.5rem;
            border: none;
        }

        .profile-card .card-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: 500;
            color: #333;
        }

        .form-control {
            border: 1px solid #dee2e6;
            padding: 0.75rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(227, 27, 35, 0.25);
        }

        .btn-update-profile {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-update-profile:hover {
            background-color: #c41820;
            transform: translateY(-2px);
            color: white;
        }

        .profile-section {
            background-color: white;
            padding: 2rem 0;
            margin-top: 5rem;
        }

        .form-floating {
            margin-bottom: 1rem;
        }

        .form-floating>.form-control {
            padding-top: 1.625rem;
            padding-bottom: 0.625rem;
        }

        .form-floating>label {
            padding: 1rem 0.75rem;
        }

        .margin-top {
            margin-top: -5rem;
        }

        .invalid-feedback {
            display: block;
            margin-top: -0.75rem;
            margin-bottom: 1rem;
        }
    </style>
@endsection

@section('content')
    <div class="profile-section">
        <div class="container margin-top">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="profile-card card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">My Profile</h3>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                        id="full_name" name="full_name" placeholder="Full Name"
                                        value="{{ old('full_name', $user->full_name) }}" required>
                                    <label for="full_name">Full Name</label>
                                    @error('full_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Email"
                                        value="{{ old('email', $user->email) }}" required>
                                    <label for="email">Email</label>
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="New Password">
                                    <label for="password">New Password (leave blank to keep current)</label>
                                    @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3">
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                                        placeholder="Address" style="height: 100px" required>{{ old('address', $user->address) }}</textarea>
                                    <label for="address">Address</label>
                                    @error('address')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('city') is-invalid @enderror"
                                        id="city" name="city" placeholder="City"
                                        value="{{ old('city', $user->city) }}" required>
                                    <label for="city">City</label>
                                    @error('city')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('postal_code') is-invalid @enderror"
                                        id="postal_code" name="postal_code" placeholder="Postal Code"
                                        value="{{ old('postal_code', $user->postal_code) }}" required>
                                    <label for="postal_code">Postal Code</label>
                                    @error('postal_code')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" placeholder="Phone Number"
                                        value="{{ old('phone', $user->phone) }}" required>
                                    <label for="phone">Phone Number</label>
                                    @error('phone')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-update-profile w-100">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Add any profile-specific JavaScript here
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-dismiss alerts after 5 seconds
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });
    </script>
@endsection
