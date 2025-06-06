<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Guitar Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #0d6efd;
            --primary-blue-dark: #0a58ca;
            --text-dark: #333;
            --text-light: #666;
            --bg-light: #f8f9fa;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 5rem;
        }

        .login-container {
            max-width: 450px;
            margin: 0 auto;
            padding: 2rem;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0.5rem 1.5rem rgba(13, 110, 253, 0.15);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h1 {
            color: var(--primary-blue);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: var(--text-light);
            font-size: 1rem;
        }

        .login-icon {
            font-size: 3rem;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .form-floating {
            margin-bottom: 1rem;
        }

        .btn-login {
            padding: 0.75rem;
            font-weight: 500;
        }

        .footer {
            text-align: center;
            margin-top: 2rem;
            color: var(--text-light);
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-container">
            <div class="login-header">
                <div class="login-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h1>Admin Login</h1>
                <p>Enter your credentials to access the admin panel</p>
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

            <form action="{{ route('admin.login') }}" method="POST">
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
                    <button type="submit" class="btn btn-primary btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </button>
                </div>
            </form>

            <div class="footer">
                <p>&copy; {{ date('Y') }} Fender Guitar Shop. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
