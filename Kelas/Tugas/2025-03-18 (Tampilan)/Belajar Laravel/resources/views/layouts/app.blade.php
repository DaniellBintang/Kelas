<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SMK Negeri</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Tambahkan FontAwesome untuk ikon sosial media -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <!-- Anda bisa menambahkan logo sekolah di sini -->
                <h1>SMK Negeri</h1>
            </div>
            <nav>
                <a href="{{ url('/sekolah') }}" class="{{ Request::is('/sekolah') ? 'active' : '' }}">Home</a>
                <a href="{{ url('/profile') }}" class="{{ Request::is('profile') ? 'active' : '' }}">Profile</a>
                <a href="{{ url('/contact') }}" class="{{ Request::is('contact') ? 'active' : '' }}">Contact</a>
                <a href="{{ url('/major') }}" class="{{ Request::is('major') ? 'active' : '' }}">Jurusan</a>
            </nav>
        </div>
    </header>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        <div class="footer-content">
            <p>&copy; {{ date('Y') }} SMK Negeri - All Rights Reserved</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </footer>
</body>

</html>
