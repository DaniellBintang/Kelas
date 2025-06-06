<?php
// php/submit-review.php
session_start();
require_once 'config.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

// Validate and sanitize input data
$order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
$user_id = $_SESSION['user_id']; // Ambil dari session saja untuk konsistensi
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
$review = isset($_POST['review']) ? trim($_POST['review']) : '';

// Log input data for debugging
error_log("Order ID: $order_id, User ID: $user_id, Product ID: $product_id, Rating: $rating, Review: $review");

// Check if all required fields are provided
if (!$order_id || !$user_id || !$product_id || !$rating || empty($review)) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit();
}

// Validate rating value (1-5)
if ($rating < 1 || $rating > 5) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Invalid rating value']);
    exit();
}

try {
    // Check if the order belongs to the logged-in user
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM orders WHERE id = ? AND customer_id = ?");
    if (!$stmt) {
        throw new Exception("Prepare statement error: " . $conn->error);
    }

    $stmt->bind_param("ii", $order_id, $user_id);
    if (!$stmt->execute()) {
        throw new Exception("Execute error: " . $stmt->error);
    }

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] == 0) {
        throw new Exception("Order not found or does not belong to this user");
    }

    // Check if the product is included in the order
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM order_items WHERE order_id = ? AND product_id = ?");
    if (!$stmt) {
        throw new Exception("Prepare statement error: " . $conn->error);
    }

    $stmt->bind_param("ii", $order_id, $product_id);
    if (!$stmt->execute()) {
        throw new Exception("Execute error: " . $stmt->error);
    }

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] == 0) {
        throw new Exception("Product not found in this order");
    }

    // Check if a review has already been submitted for this order and product
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM ratings WHERE order_id = ? AND user_id = ? AND product_id = ?");
    if (!$stmt) {
        throw new Exception("Prepare statement error: " . $conn->error);
    }

    $stmt->bind_param("iii", $order_id, $user_id, $product_id);
    if (!$stmt->execute()) {
        throw new Exception("Execute error: " . $stmt->error);
    }

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        throw new Exception("You have already reviewed this product for this order");
    }

    // Insert the review into the database
    $stmt = $conn->prepare("INSERT INTO ratings (user_id, product_id, order_id, rating, review, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    if (!$stmt) {
        throw new Exception("Prepare statement error: " . $conn->error);
    }

    $stmt->bind_param("iiiis", $user_id, $product_id, $order_id, $rating, $review);
    if (!$stmt->execute()) {
        throw new Exception("Execute error: " . $stmt->error);
    }

    // Update the product's average rating
    updateProductRating($conn, $product_id);

    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'Review submitted successfully']);
} catch (Exception $e) {
    error_log("Rating submission error: " . $e->getMessage());
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

// Function to update the product's average rating
function updateProductRating($conn, $product_id)
{
    try {
        // Calculate the new average rating
        $stmt = $conn->prepare("SELECT AVG(rating) as avg_rating FROM ratings WHERE product_id = ?");
        if (!$stmt) {
            throw new Exception("Prepare statement error: " . $conn->error);
        }

        $stmt->bind_param("i", $product_id);
        if (!$stmt->execute()) {
            throw new Exception("Execute error: " . $stmt->error);
        }

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $avg_rating = $row['avg_rating'] ?: 0; // default to 0 if null

        // Update the product's rating in the products table
        $stmt = $conn->prepare("UPDATE products SET rating = ? WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Prepare statement error: " . $conn->error);
        }

        $stmt->bind_param("di", $avg_rating, $product_id);
        if (!$stmt->execute()) {
            throw new Exception("Execute error: " . $stmt->error);
        }
    } catch (Exception $e) {
        error_log("Update rating error: " . $e->getMessage());
        // Not throwing here to avoid disrupting the main process
    }
}

exit();
