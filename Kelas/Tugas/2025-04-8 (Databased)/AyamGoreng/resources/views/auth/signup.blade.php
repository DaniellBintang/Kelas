@extends('layouts.blank')

@section('head_extras')
    <style>
        /* Restaurant Auth Pages Styles - Improved */
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");

        :root {
            --primary-blue: #1a56db;
            --secondary-blue: #3b82f6;
            --light-blue: #dbeafe;
            --dark-blue: #1e40af;
            --white: #ffffff;
            --light-gray: #f3f4f6;
            --text-dark: #1f2937;
            --text-gray: #6b7280;
            --error-red: #ef4444;
            --success-green: #10b981;
        }

        body {
            font-family: "Poppins", sans-serif;
            background-color: var(--light-gray);
            margin: 0;
            padding: 0;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem;
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--white) 100%);
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%231a56db' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E"), linear-gradient(135deg, var(--light-blue) 0%, var(--white) 100%);
        }

        .login-card {
            width: 100%;
            max-width: 450px;
            background-color: var(--white);
            border-radius: 16px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .signup-card {
            max-width: 580px;
        }

        .login-header {
            background: linear-gradient(to right, var(--primary-blue), var(--secondary-blue));
            color: var(--white);
            padding: 2.5rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
            transform: rotate(30deg);
        }

        .login-header h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 600;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .login-header p {
            margin-top: 0.75rem;
            font-size: 1rem;
            opacity: 0.9;
        }

        .login-form-container {
            padding: 2.5rem;
        }

        .form-group {
            margin-bottom: 1.75rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.6rem;
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text-dark);
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-gray);
            transition: color 0.3s ease;
        }

        .textarea-control+.input-icon {
            top: 1.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.9rem 1.2rem 0.9rem 3rem;
            font-size: 1rem;
            border: 1.5px solid #e5e7eb;
            border-radius: 8px;
            background-color: var(--white);
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .textarea-control {
            padding-top: 0.9rem;
            min-height: 120px;
            resize: vertical;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--secondary-blue);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
        }

        .form-control:focus+.input-icon,
        .form-control:focus~.input-icon {
            color: var(--primary-blue);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.75rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 0.6rem;
            width: 18px;
            height: 18px;
            accent-color: var(--primary-blue);
        }

        .forgot-password {
            color: var(--primary-blue);
            font-size: 0.95rem;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: var(--dark-blue);
            text-decoration: underline;
        }

        .terms-agreement {
            display: flex;
            align-items: flex-start;
            margin-bottom: 2rem;
            font-size: 0.95rem;
            color: var(--text-gray);
        }

        .terms-agreement input {
            margin-right: 0.6rem;
            margin-top: 0.25rem;
            width: 18px;
            height: 18px;
            accent-color: var(--primary-blue);
        }

        .terms-agreement a {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .terms-agreement a:hover {
            color: var(--dark-blue);
            text-decoration: underline;
        }

        .btn-login {
            display: block;
            width: 100%;
            padding: 1rem;
            background: linear-gradient(to right, var(--primary-blue), var(--secondary-blue));
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(26, 86, 219, 0.3);
        }

        .btn-login:hover {
            background: linear-gradient(to right, var(--dark-blue), var(--primary-blue));
            box-shadow: 0 6px 15px rgba(26, 86, 219, 0.4);
            transform: translateY(-2px);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .login-footer {
            text-align: center;
            padding: 1.75rem;
            border-top: 1px solid #e5e7eb;
            color: var(--text-gray);
            background-color: rgba(243, 244, 246, 0.3);
        }

        .login-footer p {
            margin: 0;
            font-size: 1rem;
        }

        .login-footer a {
            color: var(--primary-blue);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .login-footer a:hover {
            color: var(--dark-blue);
            text-decoration: underline;
        }

        /* Input field validation styling */
        .form-control.is-invalid {
            border-color: var(--error-red);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15);
        }

        .invalid-feedback {
            display: block;
            margin-top: 0.4rem;
            font-size: 0.85rem;
            color: var(--error-red);
        }

        /* Row layout for desktop */
        .form-row {
            display: flex;
            gap: 1.5rem;
        }

        .form-row .form-group {
            flex: 1;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .login-card {
                max-width: 100%;
            }
        }

        @media (max-width: 576px) {
            .login-container {
                padding: 1rem;
            }

            .login-card {
                border-radius: 12px;
            }

            .login-header {
                padding: 2rem 1.5rem;
            }

            .login-form-container {
                padding: 1.5rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="login-container">
        <div class="login-card signup-card">
            <div class="login-header">
                <h1>Create Account</h1>
                <p>Join our restaurant community today</p>
            </div>

            <div class="login-form-container">
                <form action="{{ url('/signup') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <div class="input-group">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="John Doe" required value="{{ old('name') }}">
                                <span class="input-icon"><i class="fas fa-user"></i></span>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <div class="input-group">
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="your.email@example.com" required value="{{ old('email') }}">
                                <span class="input-icon"><i class="fas fa-envelope"></i></span>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Complete Address</label>
                        <div class="input-group">
                            <textarea name="address" class="form-control textarea-control @error('address') is-invalid @enderror" id="address"
                                placeholder="123 Restaurant St, Foodville, NY 10001" rows="3" required>{{ old('address') }}</textarea>
                            <span class="input-icon"><i class="fas fa-map-marker-alt"></i></span>
                            @error('address')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <div class="input-group">
                            <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                id="phone" placeholder="+1 (123) 456-7890" required value="{{ old('phone') }}">
                            <span class="input-icon"><i class="fas fa-phone"></i></span>
                            @error('phone')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" id="password"
                                    placeholder="" required>
                                <span class="input-icon"><i class="fas fa-lock"></i></span>
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" class="form-control"
                                    id="password_confirmation" placeholder="" required>
                                <span class="input-icon"><i class="fas fa-lock"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="terms-agreement">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">I agree to the <a href="#">Terms of Service</a> and <a
                                href="#">Privacy Policy</a></label>
                    </div>

                    <button type="submit" class="btn-login">Create Account</button>
                </form>
            </div>

            <div class="login-footer">
                <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
            </div>
        </div>
    </div>
@endsection
