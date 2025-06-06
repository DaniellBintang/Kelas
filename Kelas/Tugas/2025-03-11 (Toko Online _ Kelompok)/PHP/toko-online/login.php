<?php
session_start();
require_once "php/config.php";

$error_message = "";
$success_message = "";

function loginCustomer($conn, $email, $password)
{
    $sql = "SELECT id, full_name, password FROM customers WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Since the passwords in your database are not hashed, we'll do direct comparison
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            return true;
        } else {
            return "Password salah!";
        }
    } else {
        return "Email tidak ditemukan!";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = loginCustomer($conn, $email, $password);

    if ($result === true) {
        header("Location: index.php");
        exit();
    } else {
        $error_message = $result;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Guitar Shop</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-container {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-header h1 {
            font-family: 'Poppins', sans-serif;
            /* Ganti dengan font yang lebih tegas */
            font-size: 2.2rem;
            /* Perbesar ukuran font */
            font-weight: 700;
            /* Buat lebih bold */
            text-transform: uppercase;
            /* Ubah menjadi huruf kapital */
            color: #222;
            /* Lebih gelap agar lebih tegas */
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h1 {
            color: #333;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-group input:focus {
            outline: none;
            border-color: #007bff;
        }

        .login-btn {
            width: 100%;
            padding: 0.8rem;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background-color: #c82333;
        }

        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
        }

        .register-link a {
            color: #dc3545;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            text-align: center;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Login</h1>
            <p>Welcome back! Please login to your account.</p>
        </div>

        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required
                    value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="login-btn">Login</button>
        </form>

        <div class="register-link">
            Don't have an account? <a href="register.php">Register here</a>
        </div>
    </div>
</body>

</html>