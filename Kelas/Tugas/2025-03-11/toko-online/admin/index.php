<?php
session_start();
include 'db.php';
// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Admin Dashboard</h1>
        <div class="list-group mt-4">
            <a href="manage_products.php" class="list-group-item list-group-item-action">Manage Products</a>
            <a href="manage_banners.php" class="list-group-item list-group-item-action">Manage Banners</a>
            <a href="manage_orders.php" class="list-group-item list-group-item-action">Manage Orders</a>
            <a href="manage_contacts.php" class="list-group-item list-group-item-action">Manage Contacts</a>
            <a href="manage_users.php" class="list-group-item list-group-item-action">Manage Users</a>
            <a href="logout.php" class="list-group-item list-group-item-action text-danger">Logout</a>
        </div>
    </div>
</body>

</html>