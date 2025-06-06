<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemId = $_POST['item_id'];
    $action = $_POST['action'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $cart = &$_SESSION['cart'];

    if ($action === "decrement") {
        foreach ($cart as $index => $item) {
            if ($item['id'] == $itemId) {
                if ($item['quantity'] > 1) {
                    $cart[$index]['quantity'] -= 1;
                } else {
                    // Hapus item jika kuantitas mencapai 1
                    unset($cart[$index]);
                }
                break;
            }
        }
    } elseif ($action === "increment") {
        foreach ($cart as $index => $item) {
            if ($item['id'] == $itemId) {
                $cart[$index]['quantity'] += 1;
                break;
            }
        }
    }

    echo json_encode(['success' => true]);
    exit();
}
echo json_encode(['success' => false]);
