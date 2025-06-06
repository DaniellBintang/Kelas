@extends('layouts.app')

@section('title', 'Customer Register')

@section('styles')
    <style>
        .auth-container {
            padding: 3rem 0;
            min-height: 80vh;
        }

        .auth-card {
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-header h1 {
            color: #dc3545;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .auth-icon {
            font-size: 3rem;
            color: #dc3545;
            margin-bottom: 1rem;
        }

        .form-floating {
            margin-bottom: 1rem;
        }

        .btn-auth {
            padding: 0.75rem;
            font-weight: 500;
            background-color: #dc3545;
            border: none;
        }

        .btn-auth:hover {
            background-color: #bb2d3b;
        }

        .auth-link {
            text-align: center;
            margin-top: 1.5rem;
        }

        .auth-link a {
            color: #dc3545;
            text-decoration: none;
        }

        .auth-link a:hover {
            text-decoration: underline;
        }
    </style>
@endsection

@section('content')
    <div class="auth-container">
        <div class="container">
            <div class="auth-card">
                <div class="auth-header">
                    <div class="auth-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h1>Create Account</h1>
                    <p class="text-muted">Join our guitar community</p>
                </div>

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                    id="full_name" name="full_name" placeholder="Full Name" value="{{ old('full_name') }}"
                                    required>
                                <label for="full_name">Full Name</label>
                                @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                                <label for="email">Email Address</label>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Password" required>
                                <label for="password">Password</label>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Confirm Password" required>
                                <label for="password_confirmation">Confirm Password</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" placeholder="Address" value="{{ old('address') }}" required>
                        <label for="address">Address</label>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('city') is-invalid @enderror"
                                    id="city" name="city" placeholder="City" value="{{ old('city') }}" required>
                                <label for="city">City</label>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('postal_code') is-invalid @enderror"
                                    id="postal_code" name="postal_code" placeholder="Postal Code"
                                    value="{{ old('postal_code') }}" required>
                                <label for="postal_code">Postal Code</label>
                                @error('postal_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                            name="phone" placeholder="Phone Number" value="{{ old('phone') }}" required>
                        <label for="phone">Phone Number</label>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-auth">
                            <i class="fas fa-user-plus me-2"></i>Create Account
                        </button>
                    </div>
                </form>

                <div class="auth-link">
                    <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
