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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
        }

        .delete-btn {
            padding: 5px 10px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: darkred;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Manage Reviews</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Item Name</th>
                <th>Review</th>
                <th>Photo</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            <?php foreach ($reviews as $review): ?>
                <tr>
                    <td><?= htmlspecialchars($review['id']); ?></td>
                    <td><?= htmlspecialchars($review['email']); ?></td>
                    <td><?= htmlspecialchars($review['item_name']); ?></td>
                    <td><?= htmlspecialchars($review['review']); ?></td>
                    <td>
                        <?php if ($review['photo']): ?>
                            <img src="../<?= htmlspecialchars($review['photo']); ?>" width="50" alt="Review Photo">
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($review['created_at']); ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="review_id" value="<?= $review['id']; ?>">
                            <button type="submit" name="action" value="delete_review" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>