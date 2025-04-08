@extends('layouts.blank')

@section('head_extras')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Restaurant Login Page Styles */
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
            border-radius: 12px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .logo-container {
            display: flex;
            justify-content: center;
            padding: 1.5rem 0 0.5rem;
        }

        .restaurant-logo {
            width: 80px;
            height: 80px;
            background-color: var(--primary-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(26, 86, 219, 0.3);
        }

        .restaurant-logo img {
            width: 80px;
            /* Atur ukuran lebar gambar */
            height: auto;
            /* Pertahankan rasio aspek */
            margin: 0 auto;
            /* Pusatkan gambar */
            display: block;
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            color: var(--white);
            padding: 1.5rem 2rem;
            text-align: center;
        }

        .login-header h1 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 600;
        }

        .login-header p {
            margin-top: 0.5rem;
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .login-form-container {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-dark);
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-gray);
            font-size: 1.1rem;
        }


        .form-control {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            font-size: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background-color: var(--white);
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--secondary-blue);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 0.5rem;
        }

        .forgot-password {
            color: var(--primary-blue);
            font-size: 0.9rem;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: var(--dark-blue);
            text-decoration: underline;
        }

        .btn-login {
            display: block;
            width: 100%;
            padding: 0.85rem;
            background: linear-gradient(to right, var(--primary-blue), var(--secondary-blue));
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);
        }

        .btn-login:hover {
            background: linear-gradient(to right, var(--dark-blue), var(--primary-blue));
            box-shadow: 0 6px 8px rgba(59, 130, 246, 0.3);
            transform: translateY(-1px);
        }

        .login-footer {
            text-align: center;
            padding: 1.5rem;
            border-top: 1px solid #e5e7eb;
            color: var(--text-gray);
            background-color: rgba(241, 245, 249, 0.3);
        }

        .login-footer a {
            color: var(--primary-blue);
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .login-footer a:hover {
            color: var(--dark-blue);
            text-decoration: underline;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .login-card {
                border-radius: 0;
            }

            .login-header {
                padding: 1.5rem;
            }

            .login-form-container {
                padding: 1.5rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="login-container">
        <div class="login-card">
            <div class="logo-container">
                <div class="restaurant-logo">
                    <img src="{{ asset('images/ayam.png') }}" alt="Restaurant Logo" class="logo">
                </div>
            </div>
            <div class="login-header">
                <h1>Welcome Back</h1>
                <p>Sign in to access your restaurant account</p>
            </div>

            <div class="login-form-container">
                <form action="{{ url('/login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="input-group">
                            <span class="input-icon"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Enter your email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <span class="input-icon"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Enter your password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-login">Sign In</button>
                </form>
            </div>

            <div class="login-footer">
                <p>Don't have an account? <a href="{{ route('signup') }}">Sign Up</a></p>
            </div>
        </div>
    </div>
@endsection
