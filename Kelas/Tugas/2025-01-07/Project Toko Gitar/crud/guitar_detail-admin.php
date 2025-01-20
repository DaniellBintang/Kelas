<?php
include 'db_connection.php';
session_start();

// Pastikan hanya admin yang dapat mengakses
if (!isset($_SESSION['admin_id'])) {
    // Redirect to login page if not authenticated
    header("Location:admin-login.php");
    exit();
}

$conn = openConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $guitar_id = $_POST['guitar_id'];
    $description = $_POST['description'];
    $specifications = $_POST['specifications'];
    $stock = $_POST['stock'];

    // Perbaiki query SQL
    $stmt = $conn->prepare("INSERT INTO guitar_details (guitar_id, description, specifications, stock) VALUES (?, ?, ?, ?)");

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("issi", $guitar_id, $description, $specifications, $stock);

    if ($stmt->execute()) {
        echo "Guitar details added successfully!";
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    $stmt->close();
}

closeConnection($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Guitar Details</title>
</head>

<body>
    <h1>Add Guitar Details</h1>
    <form method="POST" action="">
        <label for="guitar_id">Guitar ID:</label>
        <input type="number" id="guitar_id" name="guitar_id" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" required></textarea><br><br>

        <label for="specifications">Specifications:</label><br>
        <textarea id="specifications" name="specifications" rows="4" required></textarea><br><br>

        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required><br><br>

        <button type="submit">Add Details</button>
    </form>
</body>

</html>