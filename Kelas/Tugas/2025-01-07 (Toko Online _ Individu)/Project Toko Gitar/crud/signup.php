<?php
// Include the database configuration file
require_once 'signup_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user input
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $address = htmlspecialchars(trim($_POST['address']));
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    // Periksa apakah koneksi database berhasil
    if (!isset($conn) || $conn->connect_error) {
        die("Connection to the database failed: " . $conn->connect_error);
    }

    // Check if the email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    if (!$stmt) {
        die("Failed to prepare statement: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('Email already exists! Please use a different email.'); window.location.href = 'signup.php';</script>";
    } else {
        // Insert user data into the database
        $stmt = $conn->prepare("INSERT INTO users (name, email, address, password) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            die("Failed to prepare statement: " . $conn->error);
        }

        $stmt->bind_param("ssss", $name, $email, $address, $password);

        if ($stmt->execute()) {
            echo "<script>alert('Sign Up successful! You can now log in.'); window.location.href = 'login.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles/sign-up.css">
</head>

<body>
    <div class="logo">
        <img src="../Fender_guitars_logo.svg.png" alt="">
    </div>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form action="signup.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Sign Up</button>
            </div>
        </form>
        <div class="login-link">
            <p>Already have an account? <a href="login.php">Log in</a></p>
        </div>
    </div>
</body>

</html>