<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Store</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-img {
            height: 500px;
            width: 100%;
            object-fit: contain;
            margin-top: 2rem;
        }

        .carousel-item img {
            width: 100%;
            height: 400px;
            object-fit: contain;
            rotate: 90deg;
        }

        .static-banner {
            position: relative;
            width: 100%;
            height: 250px;
            background-image: url('images/fenderbanner3.jpeg');
            background-size: cover;
            background-position: center;
            color: white;
            border-radius: 3%;
        }

        .static-banner .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .static-banner h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .static-banner p {
            font-size: 1.25rem;
            margin-top: 10px;
        }

        .static-banner .btn {
            margin-top: 20px;
        }

        .static-top {
            margin-top: 3rem;
        }
    </style>
    </st>
</head>

<body>
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <nav class="navbar navbar-expand-lg">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex flex-row">
                    <li class="nav-item me-3"><a href="#" class="nav-link text-white">Home</a></li>
                    <li class="nav-item me-3"><a href="shop.php" class="nav-link text-white">Shop</a></li>
                    <li class="nav-item me-3"><a href="about.php" class="nav-link text-white">About</a></li>
                    <li class="nav-item me-3"><a href="contact.php" class="nav-link text-white">Contact</a></li>
                    <li class="nav-item me-3"> <a href="cart.php" class="nav-link text-white">Cart</a></li>
                </ul>
            </nav>
            <form class="d-flex w-50 mx-3">
                <input class="form-control me-2" type="search" placeholder="Search products...">
            </form>
            <div>
                <a href="register.php" class="btn btn-outline-light me-2">Register</a>
                <a href="login.php" class="btn btn-light">Login</a>
            </div>
        </div>
    </header>

    <div class="container my-4">
        <div class="row">
            <div class="col-md-7 static-top mb-3">
                <div class="static-banner">
                </div>
            </div>
            <div class="col-md-5">
                <div id="dynamicBanner" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="images/bass1.jpg" class="d-block w-100" alt="Banner 1">
                        </div>
                        <div class="carousel-item">
                            <img src="images/acoustic1.jpg" class="d-block w-100" alt="Banner 2">
                        </div>
                        <div class="carousel-item">
                            <img src="images/electric1.jpg" class="d-block w-100" alt="Banner 3">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#dynamicBanner" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#dynamicBanner" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="images/1.jpg" class="card-img-top product-img" alt="Product 1">
                    <div class="card-body text-center">
                        <h5 class="card-title">Product 1</h5>
                        <p class="card-text">$10.00</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="images/2.jpg" class="card-img-top product-img" alt="Product 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">Product 2</h5>
                        <p class="card-text">$15.00</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="images/electric1.jpg" class="card-img-top product-img" alt="Product 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Product 3</h5>
                        <p class="card-text">$20.00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5>Menu</h5>
                    <p>Home | Shop | About | Contact</p>
                </div>
                <div class="col-md-3">
                    <h5>Pembayaran</h5>
                    <p>Visa, MasterCard, PayPal</p>
                </div>
                <div class="col-md-3">
                    <h5>Media Sosial</h5>
                    <p>Facebook | Twitter | Instagram</p>
                </div>
                <div class="col-md-3">
                    <h5>Kontak</h5>
                    <p>Email: info@store.com</p>
                    <p>Phone: +123 456 7890</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>