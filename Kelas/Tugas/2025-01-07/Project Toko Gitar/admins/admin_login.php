<?php
session_start();
require_once '../crud/signup_db.php';

// Cek apakah admin sudah login
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit();
}

// Login admin
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek username dan password admin (gunakan hashing password untuk keamanan di produksi)
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <div class="admin-container">
        <h2>Admin Login</h2>
        <?php if (!empty($error_message)): ?>
            <p class="error"><?= htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
        <form class="admin-form" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Login</button>
            </div>
        </form>
    </div>
</body>

</html>