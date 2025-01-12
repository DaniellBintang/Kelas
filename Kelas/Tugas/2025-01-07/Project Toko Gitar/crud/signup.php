<?php
include 'db_connection.php';
$conn = openConnection();
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $password);

    if ($stmt->execute()) {
        $_SESSION['signup_success'] = true;
        header("Location: login.php");
        exit();
    } else {
        $error = "Error: Email already exists.";
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
    <link rel="stylesheet" href="auth-style.css">
</head>

<body>
    <div class="logo">
        <img src="../Fender_guitars_logo.svg.png" alt="">
    </div>

    <div class="container">
        <h2><i><b>Sign Up</b></i></h2>
        <?php if (isset($error_message)) : ?>
            <div class="error-message"><?= htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <form action="signup.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Sign Up</button>
        </form>
        <span>Don't have an account? </span><a href="login.php">Log in here.</a>

    </div>
</body>

</html>