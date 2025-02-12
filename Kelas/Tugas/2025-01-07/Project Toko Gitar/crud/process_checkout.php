<?php
session_start();
require_once 'signup_db.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: crud/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$cart = $_SESSION['cart'] ?? [];
$buy_now = $_SESSION['buy_now'] ?? null;

// Gunakan sesi "Buy Now" jika ada
if ($buy_now) {
    $cart = [$buy_now];
}

$total_price = $_POST['total_price'];
$address = $_POST['address'];

// Periksa apakah pengguna memilih alamat baru
if (isset($_POST['use_new_address']) && !empty(trim($_POST['new_address']))) {
    $address = htmlspecialchars(trim($_POST['new_address']));
}

// Simpan pesanan ke dalam database
$query = $conn->prepare("INSERT INTO orders (user_id, address, total_price, created_at) VALUES (?, ?, ?, NOW())");
$query->bind_param("isd", $user_id, $address, $total_price);

if ($query->execute()) {
    // Kosongkan cart dan sesi "Buy Now" setelah checkout
    $_SESSION['cart'] = [];
    unset($_SESSION['buy_now']);
    echo "<script>alert('Order successful!'); window.location.href = '../index.php';</script>";
} else {
    echo "Error: " . $query->error;
}

$query->close();
