<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            --error-red: #ef4444;
            --error-bg: #fee2e2;
            --error-border: #fecaca;
            --success-green: #10b981;
        }

        body {
            font-family: "Poppins", sans-serif;
            background-color: var(--light-gray);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--white) 100%);
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%231a56db' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E"), linear-gradient(135deg, var(--light-blue) 0%, var(--white) 100%);
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem;
        }

        .login-card {
            width: 100%;
            max-width: 450px;
            background-color: var(--white);
            border-radius: 16px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .logo-container {
            display: flex;
            justify-content: center;
            padding: 2rem 0 1rem;
        }

        .restaurant-logo {
            width: 90px;
            height: 90px;
            background: linear-gradient(145deg, var(--primary-blue), var(--dark-blue));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(26, 86, 219, 0.3);
            position: relative;
            overflow: hidden;
            animation: pulse 3s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.5);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(59, 130, 246, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
            }
        }

        .restaurant-logo::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.3) 50%, rgba(255, 255, 255, 0) 100%);
            transform: rotate(45deg);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-150%) rotate(45deg);
            }

            100% {
                transform: translateX(150%) rotate(45deg);
            }
        }

        .restaurant-logo img {
            width: 75px;
            height: auto;
            position: relative;
            z-index: 1;
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            color: var(--white);
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
        }

        .login-header h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .login-header p {
            margin-top: 0.5rem;
            font-size: 1rem;
            opacity: 0.9;
        }

        .login-form-container {
            padding: 2.5rem;
        }

        .form-group {
            margin-bottom: 1.8rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.7rem;
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text-dark);
            transition: all 0.3s ease;
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
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .toggle-password {
            right: 1rem;
            left: auto;
            top: 50%;
            /* Pastikan nilai ini 50% */
            transform: translateY(-50%);
            /* Tambahkan transform ini untuk sempurna memusatkan secara vertikal */
            cursor: pointer;
        }

        .password-toggle-position {
            position: absolute;
            left: 20.5rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 2;
        }

        .input-group:focus-within .input-icon {
            color: var(--primary-blue);
        }

        .form-control {
            width: 100%;
            padding: 0.9rem 1rem 0.9rem 2.8rem;
            font-size: 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            background-color: var(--white);
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--secondary-blue);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.25);
        }

        .password-control {
            padding-right: 2.8rem;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.8rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 0.5rem;
            cursor: pointer;
        }

        .remember-me label {
            font-size: 0.9rem;
            color: var(--text-gray);
            cursor: pointer;
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
            padding: 1rem;
            background: linear-gradient(to right, var(--primary-blue), var(--secondary-blue));
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);
            position: relative;
            overflow: hidden;
        }

        .btn-login::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0) 100%);
            transform: rotate(45deg);
            transition: all 0.3s ease;
            opacity: 0;
        }

        .btn-login:hover {
            background: linear-gradient(to right, var(--dark-blue), var(--primary-blue));
            box-shadow: 0 8px 15px rgba(59, 130, 246, 0.3);
            transform: translateY(-2px);
        }

        .btn-login:hover::after {
            animation: btnShimmer 1s forwards;
        }

        @keyframes btnShimmer {
            0% {
                opacity: 1;
                transform: translateX(-150%) rotate(45deg);
            }

            100% {
                opacity: 0;
                transform: translateX(150%) rotate(45deg);
            }
        }

        .login-footer {
            text-align: center;
            padding: 1.8rem;
            border-top: 1px solid #e5e7eb;
            color: var(--text-gray);
            background-color: rgba(241, 245, 249, 0.3);
        }

        .login-footer p {
            margin: 0;
            font-size: 0.95rem;
        }

        .login-footer a {
            color: var(--primary-blue);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .login-footer a:hover {
            color: var(--dark-blue);
            text-decoration: underline;
        }

        /* Alert styles */
        .alert {
            padding: 1rem 1.25rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            animation: slideDown 0.4s ease-out;
        }

        @keyframes slideDown {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-error {
            background-color: var(--error-bg);
            border-left: 4px solid var(--error-red);
        }

        .alert-icon {
            margin-right: 0.9rem;
            font-size: 1.3rem;
            color: var(--error-red);
        }

        .alert-message {
            font-size: 0.95rem;
            flex: 1;
            color: var(--error-red);
        }

        /* Password toggle animation */
        .toggle-password {
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .toggle-password:hover {
            color: var(--primary-blue);
        }

        .toggle-password.active {
            color: var(--success-green);
            transform: scale(1.2);
        }

        @keyframes rotate {
            0% {
                transform: translateY(-50%) rotate(0deg);
            }

            100% {
                transform: translateY(-50%) rotate(360deg);
            }
        }

        .rotate-icon {
            animation: rotate 0.5s ease-out;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .login-card {
                border-radius: 12px;
                margin: 1rem;
            }

            .login-header {
                padding: 1.5rem;
            }

            .login-form-container {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
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
                @if (session('error'))
                    <div class="alert alert-error">
                        <span class="alert-icon"><i class="fas fa-exclamation-circle"></i></span>
                        <span class="alert-message">{{ session('error') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error">
                        <span class="alert-icon"><i class="fas fa-exclamation-circle"></i></span>
                        <span class="alert-message">
                            Invalid email or password. Please try again.
                        </span>
                    </div>
                @endif

                <form action="{{ url('/login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="input-group">
                            <span class="input-icon">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Enter your email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <span class="input-icon">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" name="password" class="form-control password-control" id="password"
                                placeholder="Enter your password" required>
                            <span class="input-icon password-toggle-position" id="toggle-password">
                                <i id="toggle-password-icon" class="fas fa-eye-slash"></i>
                            </span>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('toggle-password');
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggle-password-icon');

            togglePassword.addEventListener('click', function() {
                // Add rotation animation
                toggleIcon.classList.add('rotate-icon');

                // Toggle password visibility
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                    togglePassword.classList.add('active');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                    togglePassword.classList.remove('active');
                }

                // Remove animation class after animation completes
                setTimeout(() => {
                    toggleIcon.classList.remove('rotate-icon');
                }, 500);
            });
        });
    </script>
</body>

</html>
