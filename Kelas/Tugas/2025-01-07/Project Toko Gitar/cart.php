<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (!isset($_SESSION['user_id'])) {
    header("Location:crud/login.php");
    exit();
}

$cart = $_SESSION['cart'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/cart.css">
    <script src="js/cart.js"></script>
</head>

<body>
    <div class="navbar">
        <img src="Fender_guitars_logo.svg.png" alt="Logo">
        <div class="nav-links">
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
    </div>

    <main>
        <section id="cart">
            <h2>Your Cart</h2>
            <?php if (count($cart) > 0): ?>
                <ul id="cart-items">
                    <?php foreach ($cart as $item): ?>
                        <li class="card">
                            <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                            <div class="item-details">
                                <h3><?= htmlspecialchars($item['name']) ?></h3>
                                <p>Price: $<?= htmlspecialchars($item['price']) ?></p>
                                <div class="quantity-controls">
                                    <button class="decrement" data-id="<?= $item['id'] ?>">-</button>
                                    <span class="quantity"><?= htmlspecialchars($item['quantity']) ?></span>
                                    <button class="increment" data-id="<?= $item['id'] ?>">+</button>
                                </div>
                                <button class="remove-from-cart" data-id="<?= $item['id'] ?>">Remove</button>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Your cart is empty. Choose your heroes from the catalog!</p>
            <?php endif; ?>
        </section>
    </main>

    <?php if (count($cart) === 0): ?>
        <div class="disabled">
            Choose Your Heroes to Proceed Checkout
        </div>
    <?php else: ?>
        <div id="checkout-container">
            <div class="checkout-wrapper">
                <p>Total Price: $<span id="total-price">
                        <?php
                        $total = 0;
                        foreach ($cart as $item) {
                            $total += $item['price'] * $item['quantity'];
                        }
                        echo $total;
                        ?>
                    </span></p>
                <div id="checkout-button">
                    <a href="checkout.php"">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    <?php endif; ?>


</body>

</html>