<?php
include 'crud/db_connection.php';
session_start();

// Inisialisasi session cart jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = $_SESSION['cart'];
$conn = openConnection();

// Fetch guitars from database
$sql = "SELECT * FROM guitars";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Your Hero</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/cart.js" defer></script>
</head>

<body>
    <div class="navbar">
        <img src="Fender_guitars_logo.svg.png" alt="Logo" height="40" width="100">
        <div class="nav-links">
            <a href="cart.php">Cart (<span id="cart-count"><?= count($cart) ?></span>)</a>
            <a href="reviews.php">Reviews</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <span>Welcome, <?= htmlspecialchars($_SESSION['user_email']); ?></span>
                <a href="crud/logout.php">Logout</a>
            <?php else: ?>
                <a href="crud/login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Banner Section -->
    <div class="banner-container">
        <div class="banner-slides">
            <div class="banner active">
                <div class="banner-content">
                    <h1>Premium Guitar Collection</h1>
                    <p>Discover our finest selection of Fender guitars</p>
                    <a href="#guitar-catalog" class="cta-button">Shop Now</a>
                </div>
                <img src="crud/uploads/fenderbanner3.jpeg" alt="Premium Guitars">
            </div>
            <div class="banner">
                <div class="banner-content">
                    <h1>New Arrivals</h1>
                    <p>Check out our latest guitar models</p>
                    <a href="#guitar-catalog" class="cta-button">View Collection</a>
                </div>
                <img src="crud/uploads/Player_Series_Banner_-_Desktop_2268x630.png" alt="New Arrivals">
            </div>
            <div class="banner">
                <div class="banner-content">
                    <h1>Special Offer</h1>
                    <p>Get up to 30% off on selected models</p>
                    <a href="#guitar-catalog" class="cta-button">Shop Deals</a>
                </div>
                <img src="crud/uploads/Web_Fender_07_09_24_Player_II_NPI_Launch_Shop_Assets_EN_PLPBanners_XS_926x282@2x.png" alt="Special Offers">
            </div>
        </div>
        <button class="banner-nav prev" onclick="changeSlide(-1)">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="banner-nav next" onclick="changeSlide(1)">
            <i class="fas fa-chevron-right"></i>
        </button>
        <div class="banner-dots"></div>
    </div>

    <main>
        <section id="guitar-catalog">
            <h2>Choose Your Heroes</h2>
            <div class="guitar-cards">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<a href='guitar_details.php?id=" . $row['id'] . "' class='guitar-card-link'>";
                        echo "<div class='card'>";
                        echo "<img src='crud/" . htmlspecialchars($row['guitar_image']) . "' alt='" . htmlspecialchars($row['guitar_name']) . "'>";
                        echo "<div class='card-content'>";
                        echo "<h3>" . htmlspecialchars($row['guitar_name']) . "</h3>";
                        echo "<p>Price: $" . htmlspecialchars($row['guitar_price']) . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</a>";
                    }
                } else {
                    echo "<p>No guitars available.</p>";
                }
                ?>
            </div>
        </section>
    </main>

    <!-- Rest of the footer code remains the same -->
    <footer class="footer">
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

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.banner');
        const dots = document.querySelector('.banner-dots');

        // Create dots
        slides.forEach((_, index) => {
            const dot = document.createElement('span');
            dot.classList.add('dot');
            dot.onclick = () => goToSlide(index);
            dots.appendChild(dot);
        });

        function changeSlide(direction) {
            goToSlide(currentSlide + direction);
        }

        function goToSlide(n) {
            slides[currentSlide].classList.remove('active');
            document.querySelectorAll('.dot')[currentSlide].classList.remove('active');

            currentSlide = (n + slides.length) % slides.length;

            slides[currentSlide].classList.add('active');
            document.querySelectorAll('.dot')[currentSlide].classList.add('active');
        }

        // Auto-advance slides
        setInterval(() => changeSlide(1), 5000);

        // Initialize first slide
        goToSlide(0);
    </script>
</body>

</html>
<?php
closeConnection($conn);
?>