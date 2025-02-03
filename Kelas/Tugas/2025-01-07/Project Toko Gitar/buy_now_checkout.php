<?php
session_start();
require_once 'crud/signup_db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: crud/login.php");
    exit();
}

$guitarId = $_GET['id']; // Asumsikan ID gitar dikirim melalui GET
$sql = "SELECT id, guitar_name, guitar_price, guitar_image FROM guitars WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $guitarId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $guitar = $result->fetch_assoc();

    // Simpan item "Buy Now" secara terpisah di session
    $_SESSION['buy_now'] = [
        'id' => $guitar['id'],
        'name' => $guitar['guitar_name'],
        'price' => $guitar['guitar_price'],
        'image' => $guitar['guitar_image'],
        'quantity' => 1
    ];

    header("Location: checkout.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}

$stmt->close();
closeConnection($conn);
