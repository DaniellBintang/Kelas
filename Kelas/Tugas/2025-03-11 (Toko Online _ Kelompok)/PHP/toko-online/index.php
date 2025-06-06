<?php
session_start();
require_once "php/config.php";


// Add at the top after session_start()
function isLoggedIn()
{
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// Function to get total quantity in cart
function getCartTotalQuantity()
{
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        return 0;
    }
    return array_sum($_SESSION['cart']);
}


// Query untuk mengambil data produk
// Query untuk mengambil hanya 9 produk
$sql = "SELECT id, name, image, price FROM products LIMIT 9";
$result = $conn->query($sql);


// Menambahkan produk ke cart
$added_to_cart = false;
// Replace existing add to cart code with:
if (isset($_POST['add_to_cart'])) {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }

    $product_id = $_POST['product_id'];
    $quantity = 1;

    if (!isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] = $quantity;
    } else {
        $_SESSION['cart'][$product_id] += $quantity;
    }

    $added_to_cart = true;
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch static banners
    $staticQuery = "SELECT * FROM banners WHERE type = 'static' ORDER BY id";
    $staticStmt = $pdo->query($staticQuery);
    $staticBanners = $staticStmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch dynamic banners
    $dynamicQuery = "SELECT * FROM banners WHERE type = 'dynamic' ORDER BY id";
    $dynamicStmt = $pdo->query($dynamicQuery);
    $dynamicBanners = $dynamicStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Store</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&display=swap');

        .banner-section h5 {
            font-family: 'Oswald', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #333;
            letter-spacing: 1.5px;
            text-align: center;
        }

        .product-img {
            height: 500px;
            width: 100%;
            object-fit: contain;
            margin-top: 2rem;
        }

        /* Banner section container */
        .banner-section {
            padding: 20px 0;
        }

        /* Carousel container */
        #staticCarousel,
        #dynamicCarousel {
            background-color: #f8f9fa;
            border-radius: 8px;
            width: 100%;
        }

        /* Carousel item - container for images */
        .carousel-item {
            height: 300px;
            position: relative;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        /* Styling for rotated images */
        .rotate {
            position: absolute;
            left: 50%;
            top: 50%;
            transform-origin: center;
            transform: translate(-50%, -50%) rotate(90deg) scale(1.5);
            height: 100%;
            width: auto;
            max-width: none;
            object-fit: contain;
        }

        /* Regular non-rotated images */
        .carousel-item img:not(.rotate) {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Navigation arrows */
        .carousel-control-prev,
        .carousel-control-next {
            width: 40px;
            height: 40px;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.8;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            opacity: 1;
        }

        /* Indicator dots */
        .carousel-indicators {
            margin-bottom: 0.5rem;
        }

        .carousel-indicators button {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin: 0 4px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .carousel-item {
                height: 250px;
            }

            .rotate {
                transform: translate(-50%, -50%) rotate(90deg) scale(1.2);
            }

            .banner-col {
                margin-bottom: 20px;
            }
        }

        /* Optional: Add smooth transitions */
        .carousel-item img {
            transition: transform 0.3s ease-in-out;
        }

        .banner {
            margin-top: 3rem;
        }
    </style>
    </st>
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
                            <a class="nav-link" href="ratings.php">Ratings</a>
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
                                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                    <li><a class="dropdown-item" href="purchase-history.php">Purchase History</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
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

    <div class="container banner mb-4">
        <div class="banner-section">
            <div class="row">
                <!-- Dynamic Banners - Left Column -->
                <div class="col-md-6 banner-col">
                    <?php if (!empty($dynamicBanners)): ?>
                        <div class="h-100">
                            <h5 class="mb-3">Discover Premium Quality at Unbeatable Prices</h5>
                            <div id="dynamicCarousel" class="carousel slide h-100" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <?php foreach ($dynamicBanners as $index => $banner): ?>
                                        <button type="button"
                                            data-bs-target="#dynamicCarousel"
                                            data-bs-slide-to="<?= $index ?>"
                                            <?= $index === 0 ? 'class="active"' : '' ?>
                                            aria-label="Slide <?= $index + 1 ?>">
                                        </button>
                                    <?php endforeach; ?>
                                </div>

                                <div class="carousel-inner rounded h-100">
                                    <?php foreach ($dynamicBanners as $index => $banner): ?>
                                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                            <img src="images/<?= htmlspecialchars($banner['image']) ?>"
                                                class="d-block w-100"
                                                alt="Dynamic Banner <?= $index + 1 ?>">
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <button class="carousel-control-prev" type="button" data-bs-target="#dynamicCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#dynamicCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Static Banners - Right Column -->
                <div class="col-md-6 banner-col">
                    <?php if (!empty($staticBanners)): ?>
                        <div class="h-100">
                            <h5 class="mb-3">Limited Time Only: Up to 70% Off - Shop Before It's Gone</h5>
                            <div id="staticCarousel" class="carousel slide h-100">
                                <div class="carousel-indicators">
                                    <?php foreach ($staticBanners as $index => $banner): ?>
                                        <button type="button"
                                            data-bs-target="#staticCarousel"
                                            data-bs-slide-to="<?= $index ?>"
                                            <?= $index === 0 ? 'class="active"' : '' ?>
                                            aria-label="Slide <?= $index + 1 ?>">
                                        </button>
                                    <?php endforeach; ?>
                                </div>

                                <div class="carousel-inner rounded h-100">
                                    <?php foreach ($staticBanners as $index => $banner): ?>
                                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                            <img src="images/<?= htmlspecialchars($banner['image']) ?>"
                                                class="rotate d-block w-100"
                                                alt="Static Banner <?= $index + 1 ?>">
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <button class="carousel-control-prev" type="button" data-bs-target="#staticCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#staticCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php
            // Tampilkan data produk
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '<div class="card">';
                    echo '<img src="uploads/' . $row["image"] . '" class="card-img-top product-img" alt="' . $row["name"] . '">';
                    echo '<div class="card-body text-center">';
                    echo '<h5 class="card-title">' . $row["name"] . '</h5>';
                    echo '<p class="card-text">Harga: Rp ' . number_format($row["price"], 0, ',', '.') . '</p>';
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='product_id' value='" . $row["id"] . "'>";
                    echo "<input type='hidden' name='redirect_url' value='" . $_SERVER['REQUEST_URI'] . "'>";
                    echo "<button class='btn btn-primary' type='submit' name='add_to_cart'>Tambah ke Keranjang</button>";
                    echo "</form><br><hr>";
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="col-12"><p class="text-center">Tidak ada produk yang tersedia.</p></div>';
            }
            ?>
        </div>
    </div>

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

    <!-- Modal Pemberitahuan -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Produk Ditambahkan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
                        <p>Produk berhasil ditambahkan ke keranjang!</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="cart.php" class="btn btn-primary">Lihat Keranjang</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Lanjut Belanja</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        // Tampilkan modal jika produk telah ditambahkan ke keranjang
        <?php if ($added_to_cart): ?>
            var cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
            cartModal.show();
        <?php endif; ?>

        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.padding = '0.5rem 0';
                navbar.style.backgroundColor = 'rgba(33, 37, 41, 0.98)';
            } else {
                navbar.style.padding = '1rem 0';
                navbar.style.backgroundColor = 'rgba(33, 37, 41, 0.98)';
            }
        });

        // Initialize dynamic carousel with auto-sliding
        const dynamicCarousel = document.getElementById('dynamicCarousel');
        if (dynamicCarousel) {
            const carousel = new bootstrap.Carousel(dynamicCarousel, {
                interval: 5000, // Change slides every 5 seconds
                wrap: true
            });
        }

        // Initialize static carousel without auto-sliding
        const staticCarousel = document.getElementById('staticCarousel');
        if (staticCarousel) {
            const carousel = new bootstrap.Carousel(staticCarousel, {
                interval: false, // Disable auto-sliding for static banners
                wrap: true
            });
        }

        // Update cart badge with animation
        const cartBadge = document.querySelector('.cart-badge');
        if (cartBadge) {
            cartBadge.classList.add('cart-animation');
        }
    </script>
</body>

</html>

<?php
// Tutup koneksi
$conn->close();
?>