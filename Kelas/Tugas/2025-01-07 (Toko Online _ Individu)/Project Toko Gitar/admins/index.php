<?php
session_start();

// Cek login admin
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="admin-container">
        <nav class="admin-nav">
            <a href="manage_guitars.php">
                <i class="fas fa-guitar"></i> Manage Guitars
            </a>
            <a href="manage_orders.php">
                <i class="fas fa-shopping-cart"></i> Manage Orders
            </a>
            <a href="manage_reviews.php">
                <i class="fas fa-comment-dots"></i> Manage Reviews
            </a>
            <a href="logout.php" class="btn btn-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </nav>

        <header>
            <h1>Welcome to Guitar Store Admin Panel</h1>
        </header>

        <div class="dashboard-summary">
            <div class="summary-card">
                <div class="card-icon">
                    <i class="fas fa-guitar"></i>
                </div>
                <div class="card-content">
                    <h3>Total Guitars</h3>
                    <?php
                    require_once '../crud/db_connection.php';
                    $conn = openConnection();
                    $guitarsQuery = $conn->query("SELECT COUNT(*) as guitar_count FROM guitars");
                    $guitarsCount = $guitarsQuery->fetch_assoc()['guitar_count'];
                    echo "<p>{$guitarsCount}</p>";
                    ?>
                </div>
            </div>

            <div class="summary-card">
                <div class="card-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="card-content">
                    <h3>Total Orders</h3>
                    <?php
                    $ordersQuery = $conn->query("SELECT COUNT(*) as order_count FROM orders");
                    $ordersCount = $ordersQuery->fetch_assoc()['order_count'];
                    echo "<p>{$ordersCount}</p>";
                    ?>
                </div>
            </div>

            <div class="summary-card">
                <div class="card-icon">
                    <i class="fas fa-comment-dots"></i>
                </div>
                <div class="card-content">
                    <h3>Total Reviews</h3>
                    <?php
                    $reviewsQuery = $conn->query("SELECT COUNT(*) as review_count FROM reviews");
                    $reviewsCount = $reviewsQuery->fetch_assoc()['review_count'];
                    echo "<p>{$reviewsCount}</p>";
                    closeConnection($conn);
                    ?>
                </div>
            </div>
        </div>

        <section class="quick-actions">
            <h2>Quick Actions</h2>
            <div class="action-buttons">
                <a href="manage_guitars.php#add-new" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Guitar
                </a>
                <a href="manage_orders.php" class="btn btn-secondary">
                    <i class="fas fa-list"></i> View Recent Orders
                </a>
            </div>
        </section>
    </div>
    <style>
        .dashboard-summary {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .summary-card {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            display: flex;
            align-items: center;
            width: 30%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            font-size: 3rem;
            margin-right: 20px;
            color: #3498db;
        }

        .card-content h3 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .card-content p {
            font-size: 2rem;
            font-weight: bold;
            color: #34495e;
        }

        .quick-actions {
            background-color: #f1f3f4;
            padding: 20px;
            border-radius: 8px;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
        }
    </style>
</body>

</html>