<?php
session_start();
require_once "php/config.php";
require_once "php/auth.php";

// Function to get total quantity in cart
function getCartTotalQuantity()
{
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        return 0;
    }
    return array_sum($_SESSION['cart']);
}

// Get current page filename
$current_page = basename($_SERVER['PHP_SELF']);

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .contact-section {
            padding: 5rem 0;
            margin-top: 2rem;
            background-color: #f8f9fa;
        }

        .contact-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .contact-info {
            background: var(--fender-red);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            height: 100%;
        }

        .contact-info-item {
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .contact-info-item i {
            font-size: 1.5rem;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-control {
            padding: 0.8rem;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            margin-bottom: 1rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(227, 24, 35, 0.25);
            border-color: var(--fender-red);
        }

        .submit-btn {
            background-color: var(--fender-red);
            color: white;
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #c41820;
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 20% auto;
            padding: 20px;
            width: 80%;
            max-width: 400px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .close-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }

        .close-btn:hover {
            background-color: #0056b3;
        }

        .cart-badge {
            position: absolute;
            top: -12px;
            right: -8px;
        }

        .cart-icon {
            bottom: -1px;
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
                            <a class="nav-link <?php echo ($current_page == 'shop.php') ? 'active' : ''; ?>" href="shop.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'about.php') ? 'active' : ''; ?>" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'ratings.php') ? 'active' : ''; ?>" href="ratings.php">Ratings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link cart-icon <?php echo ($current_page == 'cart.php') ? 'active' : ''; ?>" href="cart.php">
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
                                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                    <li><a class="dropdown-item" href="purchase-history.php">Purchase History</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="php/logout.php">Logout</a></li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <a class="nav-link btn btn-login <?php echo ($current_page == 'login.php') ? 'active' : ''; ?>" href="login.php">Login</a>
                            <a class="nav-link btn btn-signup <?php echo ($current_page == 'register.php') ? 'active' : ''; ?>" href="register.php">Sign Up</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- Include your navbar here -->

    <section class="contact-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <div class="contact-info">
                                <h2 class="mb-4">Get in Touch</h2>
                                <div class="contact-info-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <div>
                                        <h5 class="mb-0">Our Location</h5>
                                        <p class="mb-0">123 Guitar Street, Music City</p>
                                    </div>
                                </div>
                                <div class="contact-info-item">
                                    <i class="fas fa-phone"></i>
                                    <div>
                                        <h5 class="mb-0">Phone Number</h5>
                                        <p class="mb-0">(555) 123-4567</p>
                                    </div>
                                </div>
                                <div class="contact-info-item">
                                    <i class="fas fa-envelope"></i>
                                    <div>
                                        <h5 class="mb-0">Email Address</h5>
                                        <p class="mb-0">info@guitarshop.com</p>
                                    </div>
                                </div>
                                <div class="contact-info-item">
                                    <i class="fas fa-clock"></i>
                                    <div>
                                        <h5 class="mb-0">Working Hours</h5>
                                        <p class="mb-0">Mon - Fri: 9:00 AM - 6:00 PM</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-card">
                                <h2 class="mb-4">Send us a Message</h2>

                                <?php if (isset($_SESSION['message'])): ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <?= $_SESSION['message'] ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <?php unset($_SESSION['message']); ?>
                                <?php endif; ?>

                                <form action="php/process_contact.php" method="post">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="message" class="form-label">Message</label>
                                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                    </div>

                                    <button type="submit" class="submit-btn">Send Message</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer bg-dark text-white py-5">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="reviews.php">Reviews</a></li>
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <li><a href="crud/login.php">Login</a></li>
                    <?php else: ?>
                        <li><a href="crud/logout.php">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Payment Methods</h3>
                <div class="payment-methods">
                    <i class="fab fa-cc-visa fa-2x"></i>
                    <i class="fab fa-cc-mastercard fa-2x"></i>
                    <i class="fab fa-cc-paypal fa-2x"></i>
                    <i class="fab fa-cc-apple-pay fa-2x"></i>
                </div>
            </div>

            <div class="footer-section">
                <h3>Connect With Us</h3>
                <div class="social-links">
                    <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
                <p style="color: var(--neutral-400); margin-top: 1rem; margin-left: -4rem;">
                    Follow us for updates and exclusive offers!
                </p>
            </div>

            <div class="footer-section">
                <h3>Contact Us</h3>
                <ul>
                    <li><i class="far fa-envelope"></i> info@guitarshop.com</li>
                    <li><i class="fas fa-phone"></i> (555) 123-4567</li>
                    <li><i class="fas fa-map-marker-alt"></i> 123 Guitar Street, Music City</li>
                    <li><i class="far fa-clock"></i> Mon - Fri: 9:00 AM - 6:00 PM</li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> Guitar Shop. All rights reserved.</p>
        </div>
    </footer>
    <!-- Modal Notifikasi -->
    <div id="messageModal" class="modal">
        <div class="modal-content">
            <p id="modalText"></p>
            <button class="close-btn" onclick="closeModal()">OK</button>
        </div>
    </div>


    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi untuk menampilkan modal
        function showModal(message) {
            document.getElementById("modalText").innerText = message;
            document.getElementById("messageModal").style.display = "block";
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            document.getElementById("messageModal").style.display = "none";
        }

        // Mengecek apakah ada pesan dari PHP
        <?php if (isset($_SESSION['message'])): ?>
            showModal("<?php echo $_SESSION['message']; ?>");
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
    </script>
</body>

</html>