<?php
include 'crud/db_connection.php';
session_start();

// Inisialisasi session cart jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = $_SESSION['cart']; // Pastikan $cart selalu array

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
    <title>Guitar Catalog</title>
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

    <main>
        <section id="guitar-catalog">
            <h2>Choose Your Guitars</h2>
            <div class="guitar-cards">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='card'>";
                        echo "<img src='crud/" . htmlspecialchars($row['guitar_image']) . "' alt='" . htmlspecialchars($row['guitar_name']) . "'>";
                        echo "<h3>" . htmlspecialchars($row['guitar_name']) . "</h3>";
                        echo "<p>Price: $" . htmlspecialchars($row['guitar_price']) . "</p>";
                        if (isset($_SESSION['user_id'])) {
                            echo "<button class='add-to-cart' data-id='" . $row['id'] . "' data-name='" . $row['guitar_name'] . "' data-price='" . $row['guitar_price'] . "' data-image='" . $row['guitar_image'] . "'>Add to Cart</button>";
                        } else {
                            echo "<a href='crud/login.php' class='login-to-add'>Login to Add to Cart</a>";
                        }
                        echo "</div>";
                    }
                } else {
                    echo "<p>No guitars available.</p>";
                }
                ?>
            </div>
        </section>
    </main>
</body>

</html>
<?php
closeConnection($conn);
?>