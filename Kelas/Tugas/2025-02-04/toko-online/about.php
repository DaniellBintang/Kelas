<?php
session_start();
require_once "php/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Guitar Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .about-header {
            background-color: #f8f9fa;
            padding: 100px 0 50px 0;
            text-align: center;
        }

        .mission-vision {
            padding: 60px 0;
        }

        .value-card {
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: 100%;
            transition: transform 0.3s ease;
            background-color: #ffffff;
        }

        .value-card:hover {
            transform: translateY(-5px);
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .icon-circle i {
            font-size: 30px;
            color: #dc3545;
        }

        .section-title {
            position: relative;
            margin-bottom: 40px;
            padding-bottom: 20px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background-color: #dc3545;
        }

        .mission-section,
        .vision-section {
            padding: 40px 0;
        }

        .values-section {
            background-color: #f8f9fa;
            padding: 60px 0;
        }
    </style>
</head>

<body>
    <header class="py-4">
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="Fender_guitars_logo.svg.png" alt="Fender Logo" class="img-fluid">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link cart-icon" href="cart.php">
                                <i class="fas fa-shopping-cart"></i>
                                <?php if (isset($_SESSION['cart']) && getCartTotalQuantity() > 0): ?>
                                    <span class="cart-badge"><?= getCartTotalQuantity() ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                    </ul>
                    <div class="auth-buttons">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <div class="dropdown">
                                <button class="btn btn-login dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="php/logout.php">Logout</a></li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <a class="nav-link btn btn-login" href="login.php">Login</a>
                            <a class="nav-link btn btn-signup" href="register.php">Sign Up</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- Navbar (menggunakan navbar yang sudah ada) -->


    <!-- About Header -->
    <div class="about-header">
        <div class="container">
            <h1 class="display-4 mb-4">About Guitar Shop</h1>
            <p class="lead">Bringing the joy of music to everyone through quality instruments</p>
        </div>
    </div>

    <!-- Mission Section -->
    <section class="mission-section">
        <div class="container">
            <h2 class="section-title text-center">Our Mission</h2>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="images/vision.png" alt="Mission Image" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                    <p class="lead">To provide musicians of all levels with high-quality instruments and exceptional service, fostering a community where music thrives and creativity knows no bounds.</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i> Quality instruments for every budget</li>
                        <li><i class="fas fa-check text-success me-2"></i> Expert guidance and support</li>
                        <li><i class="fas fa-check text-success me-2"></i> Building musical communities</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision Section -->
    <section class="vision-section bg-light">
        <div class="container">
            <h2 class="section-title text-center">Our Vision</h2>
            <div class="row align-items-center">
                <div class="col-md-6 order-md-2">
                    <img src="images/mission.png" alt="Vision Image" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                    <p class="lead">To be the leading guitar shop that inspires and enables musical excellence, making quality instruments accessible to all passionate musicians.</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-star text-warning me-2"></i> Industry leadership in quality</li>
                        <li><i class="fas fa-star text-warning me-2"></i> Innovation in musical retail</li>
                        <li><i class="fas fa-star text-warning me-2"></i> Global reach with local touch</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section">
        <div class="container">
            <h2 class="section-title text-center">Our Values</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="value-card text-center">
                        <div class="icon-circle">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3>Passion</h3>
                        <p>We are passionate about music and committed to sharing that passion with our customers through exceptional service and quality products.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="value-card text-center">
                        <div class="icon-circle">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3>Integrity</h3>
                        <p>We conduct our business with honesty, transparency, and always put our customers' best interests first.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="value-card text-center">
                        <div class="icon-circle">
                            <i class="fas fa-star"></i>
                        </div>
                        <h3>Excellence</h3>
                        <p>We strive for excellence in everything we do, from product quality to customer service and beyond.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>