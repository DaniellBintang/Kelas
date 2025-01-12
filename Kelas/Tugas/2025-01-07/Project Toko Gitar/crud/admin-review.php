<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit();
}

include 'db_connection.php';
$conn = openConnection();

// Handle delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_review_id'])) {
    $reviewId = intval($_POST['delete_review_id']);

    // Delete review from database
    $deleteQuery = "DELETE FROM reviews WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $reviewId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $message = "Review successfully deleted!";
    } else {
        $message = "Failed to delete the review.";
    }

    $stmt->close();
}

// Fetch all reviews from database
$reviewsQuery = "SELECT id, email, item_name, review, photo, created_at FROM reviews ORDER BY created_at DESC";
$result = $conn->query($reviewsQuery);

closeConnection($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Reviews</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="navbar">
        <img alt="Logo" height="40" src="../Fender_guitars_logo.svg.png" width="100" />
        <div class="nav-links">
            <a href="manage_guitars.php">Manage Guitars</a>
            <a href="manage-orders.php">Manage Orders</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <main>
        <section id="review-management">
            <h1>Manage Reviews</h1>

            <?php if (isset($message)): ?>
                <p class="message"><?= htmlspecialchars($message) ?></p>
            <?php endif; ?>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Email</th>
                        <th>Item Name</th>
                        <th>Review Text</th>
                        <th>Review Image</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td><?= htmlspecialchars($row['item_name']) ?></td>
                                <td><?= nl2br(htmlspecialchars($row['review'])) ?></td>
                                <td style="text-align: center;">
                                    <?php if (!empty($row['photo'])): ?>
                                        <img src="<?= str_replace('crud/', '', htmlspecialchars($row['photo'])) ?>" alt="Review Image" width="150">
                                    <?php else: ?>
                                        No Image
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($row['created_at']) ?></td>
                                <td>
                                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                        <input type="hidden" name="delete_review_id" value="<?= $row['id'] ?>">
                                        <button type="submit" class="delete-btn">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No reviews found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>

</html>