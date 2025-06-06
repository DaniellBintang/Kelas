<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO admins (email, password) VALUES ('$email', '$password')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;
        header('Location: login.php');
        exit();
    } else {
        $error = "Failed to register. Email might be already in use.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
            margin-bottom: 1rem;
        }

        .register-link a {
            color: rgb(8, 177, 255);
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Admin Register</h2>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="POST" action="">
                    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="register-link">
                        Already have an account? <a href="login.php">Login Here</a>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>