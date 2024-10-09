<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Restoran</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.min.css') }}">
</head>

<body>
    <div class="container">
        <div class="as">
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <a href="/"><img style="width: 220px;"
                            src="{{ asset('images/10ec2671eb62abe8528dfdb0484f9e8c.png') }}" alt=""></a>
                    <ul class="navbar-nav gap-5">

                        @if (session()->has('cart'))
                            <li class="nav-item"><a href="{{ url('cart') }}"> Cart(
                                    @php
                                        $count = count(session('cart'));
                                        echo $count;
                                    @endphp
                                    )</a></li>
                        @else
                            <li class="nav-item">Cart</li>
                        @endif



                        @if (session()->missing('idpelanggan'))
                            <li class="nav-item"><a href="{{ url('register') }}">Register</a></li>
                            <li class="nav-item"><a href="{{ url('login') }}">Log-In</a></li>
                        @endif

                        @if (session()->has('idpelanggan'))
                            <li class="nav-item"> {{ session('idpelanggan')['email'] }}</li>
                            <li class="nav-item"><a href="{{ url('logout') }}">Logout</a></li>
                        @endif

                    </ul>
                </div>
            </nav>
        </div>
        <div class="row mt-4">
            <div class="col-2">
                <ul class="list-group">
                    @foreach ($kategoris as $kategori)
                        <li class="list-group-item"><a
                                href="{{ url('show/' . $kategori->idkategori) }}">{{ $kategori->kategori }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-10">
                @yield('content')
            </div>
        </div>
        <div class="bg-light mt-5">
            <p class="text-center">@danielbintang.com</p>
        </div>
    </div>

    <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
