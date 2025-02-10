<?php
session_start();
require_once "php/config.php";
require_once "php/auth.php";


// Cek koneksi database
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Add the missing function
function getCartTotalQuantity()
{
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        return 0;
    }
    return array_sum($_SESSION['cart']);
}

// Rest of your existing cart.php code
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['remove'])) {
    $product_id = $_GET['remove'];
    unset($_SESSION['cart'][$product_id]);
    header("Location: cart.php");
    exit();
}

if (isset($_GET['update'])) {
    $product_id = $_GET['update'];
    $action = $_GET['action'];

    if ($action == 'increase') {
        $_SESSION['cart'][$product_id]++;
    } elseif ($action == 'decrease') {
        if ($_SESSION['cart'][$product_id] > 1) {
            $_SESSION['cart'][$product_id]--;
        } else {
            unset($_SESSION['cart'][$product_id]);
        }
    }
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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

    <div class="container cart-container">
        <div class="row">
            <?php if (!empty($_SESSION['cart'])): ?>
                <div class="col-lg-8">
                    <?php
                    $total_belanja = 0;
                    foreach ($_SESSION['cart'] as $product_id => $quantity):
                        $sql = "SELECT name, image, price FROM products WHERE id = $product_id";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $subtotal = $row['price'] * $quantity;
                        $total_belanja += $subtotal;
                    ?>
                        <div class="cart-card">
                            <div class="cart-card-content">
                                <img src="uploads/<?= $row['image']; ?>" alt="<?= $row['name']; ?>" class="cart-image">
                                <div class="cart-details">
                                    <h3 class="product-name"><?= $row['name']; ?></h3>
                                    <p class="product-price">Rp <?= number_format($row['price'], 0, ',', '.'); ?></p>
                                    <div class="quantity-controls">
                                        <a href="cart.php?update=<?= $product_id; ?>&action=decrease"
                                            class="quantity-btn decrease-btn">-</a>
                                        <span class="quantity-number"><?= $quantity; ?></span>
                                        <a href="cart.php?update=<?= $product_id; ?>&action=increase"
                                            class="quantity-btn increase-btn">+</a>
                                    </div>
                                    <a href="cart.php?remove=<?= $product_id; ?>" class="remove-btn">
                                        <i class="fas fa-trash"></i> Remove
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h3 class="summary-title">Cart Summary</h3>
                        <div class="summary-item">
                            <span>Subtotal</span>
                            <span>Rp <?= number_format($total_belanja, 0, ',', '.'); ?></span>
                        </div>
                        <div class="summary-item">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <hr>
                        <div class="summary-item">
                            <strong>Total</strong>
                            <strong>Rp <?= number_format($total_belanja, 0, ',', '.'); ?></strong>
                        </div>
                        <a href="php/checkout.php" class="btn checkout-btn">Proceed to Checkout</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-12">
                    <div class="empty-cart">
                        <i class="fas fa-shopping-cart"></i>
                        <h3>Your cart is empty</h3>
                        <p>Looks like you haven't added anything to your cart yet.</p>
                        <a href="shop.php" class="btn btn-primary mt-3">Continue Shopping</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$conn->close();
?>