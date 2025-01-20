<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $guitar_id = $_POST['guitar_id'];
    $guitar_name = $_POST['guitar_name'];
    $guitar_price = $_POST['guitar_price'];
    $guitar_image = $_POST['guitar_image']; // Jalur gambar

    // Jika session cart belum ada, buat array kosong
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Periksa apakah item sudah ada di cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] === $guitar_id) {
            $item['quantity'] += 1; // Tambahkan kuantitas
            $found = true;
            break;
        }
    }

    // Jika item belum ada, tambahkan sebagai item baru
    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $guitar_id,
            'name' => $guitar_name,
            'price' => $guitar_price,
            'image' => 'crud/' . $guitar_image, // Pastikan jalur benar
            'quantity' => 1
        ];
    }

    echo json_encode(['success' => true]);
    exit();
}
echo json_encode(['success' => false]);
exit();
