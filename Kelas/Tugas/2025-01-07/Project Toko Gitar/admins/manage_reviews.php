<?php
session_start();
require_once '../crud/signup_db.php';

// Cek login admin
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Hapus review jika diminta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_review') {
    $review_id = $_POST['review_id'];

    $query = $conn->prepare("DELETE FROM reviews WHERE id = ?");
    $query->bind_param("i", $review_id);
    $query->execute();
    $query->close();
}

$reviews = [];
$query = $conn->query("
    SELECT reviews.id, reviews.email, reviews.item_name, reviews.review, reviews.photo, reviews.created_at
    FROM reviews
    ORDER BY reviews.created_at DESC
");

// Cek apakah query berhasil
if (!$query) {
    die("Query Error: " . $conn->error);
}

while ($row = $query->fetch_assoc()) {
    $reviews[] = $row;
}
$query->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reviews</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="admin-container">
        <nav class="admin-nav">
            <a href="index.php">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="manage_guitars.php">
                <i class="fas fa-guitar"></i> Manage Guitars
            </a>
            <a href="manage_orders.php">
                <i class="fas fa-shopping-cart"></i> Manage Orders
            </a>
            <a href="logout.php" class="btn btn-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </nav>

        <div class="reviews-management">
            <h1>Manage Reviews</h1>

            <div class="review-list">
                <table class="admin-table" id="reviewsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Item Name</th>
                            <th>Review</th>
                            <th>Photo</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reviews as $review): ?>
                            <tr>
                                <td><?= htmlspecialchars($review['id']); ?></td>
                                <td><?= htmlspecialchars($review['email']); ?></td>
                                <td><?= htmlspecialchars($review['item_name']); ?></td>
                                <td><?= htmlspecialchars($review['review']); ?></td>
                                <td>
                                    <?php if ($review['photo']): ?>
                                        <img src="../<?= htmlspecialchars($review['photo']); ?>" class="review-photo" alt="Review Photo">
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($review['created_at']); ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="review_id" value="<?= $review['id']; ?>">
                                        <button type="submit" name="action" value="delete_review" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>