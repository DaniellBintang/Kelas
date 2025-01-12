<?php
include 'crud/db_connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location:crud/login.php");
    exit();
}

$conn = openConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $customer_address = $_POST['customer_address'];
    $order_details = $_POST['order_details'];
    $total_price = $_POST['total_price'];

    $stmt = $conn->prepare("INSERT INTO orders (customer_name, customer_email, customer_address, order_details, total_price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssd", $customer_name, $customer_email, $customer_address, $order_details, $total_price);

    if ($stmt->execute()) {
        // Set session variable to indicate success
        $_SESSION['order_success'] = true;

        // Redirect to the same page using GET
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<p>Error placing order: " . $conn->error . "</p>";
    }

    $stmt->close();
}

// Check session for success state
$showModal = false;
if (isset($_SESSION['order_success'])) {
    $showModal = true;
    unset($_SESSION['order_success']); // Clear session variable after showing modal
}

// Fetch guitars from database
$sql = "SELECT * FROM guitars";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Guitar Store</title>
    <link rel="stylesheet" href="style.css">
    <script src="scripts.js"></script>
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
                <span>Welcome, <?= htmlspecialchars($_SESSION['user_email']); ?></span>
                <a href="crud/logout.php">Logout</a>
                <a href="reviews.php">Reviews</a>
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
                        echo "<div class='card' data-guitar-id='" . htmlspecialchars($row['id']) . "' data-guitar-name='" . htmlspecialchars($row['guitar_name']) . "' data-guitar-price='" . htmlspecialchars($row['guitar_price']) . "'>";
                        echo "<img src='crud/" . htmlspecialchars($row['guitar_image']) . "' alt='" . htmlspecialchars($row['guitar_name']) . "'>";
                        echo "<h3>" . htmlspecialchars($row['guitar_name']) . "</h3>";
                        echo "<p>Price: $" . htmlspecialchars($row['guitar_price']) . "</p>";
                        echo "<div class='quantity-control' style='display: none;'>";
                        echo "<button class='decrement'>-</button>";
                        echo "<span class='quantity'>1</span>";
                        echo "<button class='increment'>+</button>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No guitars available.</p>";
                }
                ?>
            </div>
        </section>
        <section id="payment-form">
            <h2>Payment Details</h2>
            <form method="POST" action="">
                <label for="customer_name">Name:</label>
                <input type="text" id="customer_name" name="customer_name" required>

                <label for="customer_email">Email:</label>
                <input type="email" id="customer_email" name="customer_email" required>

                <label for="customer_address">Address:</label>
                <textarea id="customer_address" name="customer_address" required></textarea>

                <h3>Order Summary</h3>
                <div id="order-summary"></div>
                <input type="hidden" id="order_details" name="order_details">
                <input type="hidden" id="total_price" name="total_price">

                <p>Total Price: $<span id="display-total-price">0.00</span></p>

                <button type="submit">Pay Now</button>
            </form>
        </section>
    </main>
    <div id="success-modal" class="modal" data-show-modal="<?= $showModal ? 'true' : 'false' ?>">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Order Confirmed!</h2>
            <p>Thank you, your order has been successfully placed. We will process your order shortly.</p>
        </div>
    </div>
</body>

</html>
<?php
closeConnection($conn);
?>