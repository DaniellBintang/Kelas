<?php
require_once '../crud/db_connection.php';

if (!isset($_GET['order_id'])) {
    echo "No order ID provided.";
    exit();
}

$orderId = intval($_GET['order_id']);
$conn = openConnection();

$sql = "SELECT oi.*, g.guitar_name, g.guitar_price, g.guitar_image
        FROM order_items oi
        JOIN guitars g ON oi.guitar_id = g.id
        WHERE oi.order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $orderId);
$stmt->execute();
$result = $stmt->get_result();
$orderItems = $result->fetch_all(MYSQLI_ASSOC);

if (empty($orderItems)) {
    echo "No order details found.";
    exit();
}

// Get order information
$orderSql = "SELECT * FROM orders WHERE id = ?";
$orderStmt = $conn->prepare($orderSql);
$orderStmt->bind_param("i", $orderId);
$orderStmt->execute();
$orderResult = $orderStmt->get_result();
$order = $orderResult->fetch_assoc();
?>

<div class="order-details">
    <h3>Order #<?= htmlspecialchars($orderId) ?></h3>
    <p><strong>Order Date:</strong> <?= htmlspecialchars($order['created_at']) ?></p>
    <p><strong>Total Price:</strong> $<?= number_format($order['total_price'], 2) ?></p>
    <p><strong>Status:</strong> <?= htmlspecialchars(ucfirst($order['status'])) ?></p>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Guitar</th>
                <th>Image</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>