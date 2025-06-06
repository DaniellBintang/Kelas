@extends('layouts.app')

@section('title', 'Customer Login')

@section('styles')
    <style>
        .auth-container {
            padding: 5rem 0;
            min-height: 80vh;
            display: flex;
            align-items: center;
        }

        .auth-card {
            max-width: 450px;
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
                        <i class="fas fa-user"></i>
                    </div>
                    <h1>Customer Login</h1>
                    <p class="text-muted">Enter your credentials to access your account</p>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-floating">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                        <label for="email">Email address</label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-auth">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </button>
                    </div>
                </form>

                <div class="auth-link">
                    <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
