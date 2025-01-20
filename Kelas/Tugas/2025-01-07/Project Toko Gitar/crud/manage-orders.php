<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Order List</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <?php
    session_start();

    // Check if admin is logged in
    if (!isset($_SESSION['admin_id'])) {
        // Redirect to login page if not authenticated
        header("Location: admin-login.php");
        exit();
    }

    include 'db_connection.php';
    $conn = openConnection();

    // Fetch all orders from the database
    $sql = "SELECT id, customer_name, customer_email, customer_address, order_details, total_price, created_at FROM orders ORDER BY created_at DESC";
    $result = $conn->query($sql);

    // Check for query errors
    if (!$result) {
        die("Error executing query: " . $conn->error);
    }
    ?>

    <div class="navbar">
        <img alt="Logo" height="40" src="../Fender_guitars_logo.svg.png" width="100" />
        <div class="nav-links">
            <a href="manage_guitars.php">Manage Guitars</a>
            <a href="admin-review.php"> Review </a>
            <a href="logout-admin.php">Logout</a>
        </div>
    </div>

    <main>
        <section id="order-list">
            <h1>Order List</h1>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Order Details</th>
                        <th>Total Price</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td data-label='Order ID'>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td data-label='Customer Name'>" . htmlspecialchars($row['customer_name']) . "</td>";
                            echo "<td data-label='Email'>" . htmlspecialchars($row['customer_email']) . "</td>";
                            echo "<td data-label='Address'>" . htmlspecialchars($row['customer_address']) . "</td>";
                            echo "<td data-label='Order Details'>" . nl2br(htmlspecialchars($row['order_details'])) . "</td>";
                            echo "<td data-label='Total Price'>$" . number_format($row['total_price'], 2) . "</td>";
                            echo "<td data-label='Order Date'>" . htmlspecialchars($row['created_at']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No orders found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <?php
    closeConnection($conn);
    ?>

</body>

</html>