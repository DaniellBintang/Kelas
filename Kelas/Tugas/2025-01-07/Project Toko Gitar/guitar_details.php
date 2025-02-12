<?php
include 'crud/db_connection.php';
session_start();

// Pastikan ID gitar diberikan melalui URL
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$guitarId = intval($_GET['id']); // Ambil ID gitar dari URL
$conn = openConnection();

// Ambil detail gitar dari database
$sql = "SELECT g.*, gd.description, gd.specifications, gd.stock 
        FROM guitars g 
        INNER JOIN guitar_details gd ON g.id = gd.id 
        WHERE g.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $guitarId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Jika gitar tidak ditemukan, kembali ke catalog
    header("Location: index.php");
    exit();
}

$guitar = $result->fetch_assoc();
$stmt->close();
closeConnection($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($guitar['guitar_name']); ?> - Guitar Details</title>
    <link rel="stylesheet" href="css/details.css">
    <script src="js/cart.js"></script>
</head>

<body>
    <div class="navbar">
        <img src="Fender_guitars_logo.svg.png" alt="Logo" height="40" width="100">
        <div class="nav-links">
            <a href="cart.php">Cart (<span id="cart-count"><?= count($_SESSION['cart'] ?? []) ?></span>)</a>
            <a href="index.php">Shop</a>
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
        <section id="guitar-detail">
            <div class="guitar-detail-card">
                <img class="guitar-image" src="crud/<?= htmlspecialchars($guitar['guitar_image']); ?>"
                    alt="<?= htmlspecialchars($guitar['guitar_name']); ?>">

                <div class="guitar-info">
                    <h1><?= htmlspecialchars($guitar['guitar_name']); ?></h1>
                    <p><strong>Price:</strong> $<?= htmlspecialchars($guitar['guitar_price']); ?></p>
                    <p><strong>Stock:</strong> <?= htmlspecialchars($guitar['stock']); ?></p>

                    <div class="tabs">
                        <button class="tab-button active" data-tab="description-tab">Description</button>
                        <button class="tab-button" data-tab="specifications-tab">Specifications</button>
                    </div>

                    <div id="description-tab" class="tab-content active">
                        <p><?= nl2br(htmlspecialchars($guitar['description'])); ?></p>
                    </div>

                    <div id="specifications-tab" class="tab-content">
                        <p><?= nl2br(htmlspecialchars($guitar['specifications'])); ?></p>
                    </div>

                    <div class="actions">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <button class="add-to-cart"
                                data-id="<?= $guitar['id']; ?>"
                                data-name="<?= htmlspecialchars($guitar['guitar_name']); ?>"
                                data-price="<?= $guitar['guitar_price']; ?>"
                                data-image="<?= htmlspecialchars($guitar['guitar_image']); ?>">Add to Cart</button>
                            <a href="buy_now_checkout.php?id=<?= $guitar['id']; ?>" class="checkout-now">Buy Now</a>
                        <?php else: ?>
                            <a href="crud/login.php" class="login-to-add">Login to Add to Cart</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>