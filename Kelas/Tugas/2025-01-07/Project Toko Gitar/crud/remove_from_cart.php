<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemId = $_POST['item_id'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $cart = &$_SESSION['cart'];

    foreach ($cart as $index => $item) {
        if ($item['id'] == $itemId) {
            unset($cart[$index]);
            echo json_encode(['success' => true]);
            exit();
        }
    }

    echo json_encode(['success' => false]);
    exit();
}

echo json_encode(['success' => false]);
