<?php
session_start();
require_once "config.php";

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil ID pelanggan dari sesi
$customer_id = $_SESSION['user_id'];

// Periksa apakah keranjang belanja tidak kosong
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<script>alert('Keranjang belanja Anda kosong!'); window.location.href='shop.php';</script>";
    exit();
}

$total_price = 0;
$order_items = [];

// Ambil data produk dari database berdasarkan cart
foreach ($_SESSION['cart'] as $product_id => $quantity) {
    $query = "SELECT price FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $price = $row['price'];
        $subtotal = $price * $quantity;
        $total_price += $subtotal;

        // Simpan detail barang untuk dimasukkan ke order_items nanti
        $order_items[] = [
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => $price
        ];
    }
    $stmt->close();
}

// Simpan data ke tabel orders
$order_query = "INSERT INTO orders (customer_id, total_price, status, created_at) VALUES (?, ?, 'Pending', NOW())";
$stmt = $conn->prepare($order_query);
$stmt->bind_param("id", $customer_id, $total_price);
$stmt->execute();

// Dapatkan ID order yang baru dibuat
$order_id = $stmt->insert_id;
$stmt->close();

// Simpan data ke tabel order_items
$order_item_query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($order_item_query);

foreach ($order_items as $item) {
    $stmt->bind_param("iiid", $order_id, $item['product_id'], $item['quantity'], $item['price']);
    $stmt->execute();
}
$stmt->close();

// Kosongkan cart setelah checkout
unset($_SESSION['cart']);

// Redirect ke halaman sukses
echo "<script>alert('Checkout berhasil! Pesanan Anda sedang diproses.'); window.location.href='../index.php';</script>";
exit();
