<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location:crud/login.php");
    exit();
}

// Inisialisasi session cart jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = $_SESSION['cart']; // Pastikan $cart selalu array

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Item</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="navbar">
        <img
            alt="Logo"
            height="40"
            src="Fender_guitars_logo.svg.png"
            width="100" />
        <div class="nav-links">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="cart.php">Cart (<span id="cart-count"><?= count($cart) ?></span>)</a>
                <a href="index.php">Shop</a>
                <span>Welcome, <?= htmlspecialchars($_SESSION['user_email']); ?></span>
                <a href="crud/logout.php">Logout</a>
            <?php else: ?>
                <a href="crud/login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>
    <?php
    include 'crud/db_connection.php';
    $conn = openConnection();

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = htmlspecialchars($_POST['email']);
        $item_name = htmlspecialchars($_POST['item_name']);
        $review = htmlspecialchars($_POST['review']);
        $photo = null;

        // Handle file upload if exists
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $photo = 'crud/uploads/' . basename($_FILES['photo']['name']);
            move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
        }

        // Insert review into the database
        $stmt = $conn->prepare("INSERT INTO reviews (email, item_name, review, photo) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $item_name, $review, $photo);

        if ($stmt->execute()) {
            echo "<p class='success-message'>Thank you for your review!</p>";
        } else {
            echo "<p class='error-message'>Failed to submit review: " . $stmt->error . "</p>";
        }
    }

    // Fetch all reviews
    $reviews = $conn->query("SELECT * FROM reviews ORDER BY created_at DESC");
    ?>

    <div class="navbar">
        <h1>Review Items</h1>
    </div>

    <main>
        <section id="review-form">
            <h2>Submit Your Review</h2>
            <form method="POST" enctype="multipart/form-data">
                <label for="email">Email <span>*</span></label>
                <input type="email" id="email" name="email" required>

                <label for="item_name">Item Name <span>*</span></label>
                <input type="text" id="item_name" name="item_name" required>

                <label for="review">Your Review <span>*</span></label>
                <textarea id="review" name="review" rows="5" required></textarea>

                <label for="photo">Upload Photo (Optional)</label>
                <input type="file" id="photo" name="photo" accept="image/*">

                <button class="add-to-cart" type="submit">Submit Review</button>
            </form>
        </section>

        <section id="reviews">
            <h2>Customer Reviews</h2>
            <?php if ($reviews->num_rows > 0) : ?>
                <div class="review-list">
                    <?php while ($row = $reviews->fetch_assoc()) : ?>
                        <div class="review-item">
                            <h3><?php echo htmlspecialchars($row['item_name']); ?></h3>
                            <p><strong>By:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                            <p><?php echo nl2br(htmlspecialchars($row['review'])); ?></p>
                            <?php if ($row['photo']) : ?>
                                <img src="<?php echo htmlspecialchars($row['photo']); ?>" alt="Review Photo">
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <p>No reviews yet. Be the first to review!</p>
            <?php endif; ?>
        </section>
    </main>

    <?php closeConnection($conn); ?>
</body>

</html>