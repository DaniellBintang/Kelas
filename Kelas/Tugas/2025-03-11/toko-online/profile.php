<?php
session_start();
require_once 'php/config.php';


// Function to get total quantity in cart
function getCartTotalQuantity()
{
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        return 0;
    }
    return array_sum($_SESSION['cart']);
}

// Cek jika user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Ambil data user dari database
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM customers WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Proses update profile
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $postal_code = trim($_POST['postal_code']);
    $phone = trim($_POST['phone']);

    // Update password hanya jika field password tidak kosong
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $update_query = "UPDATE customers SET full_name=?, email=?, password=?, address=?, city=?, postal_code=?, phone=? WHERE id=?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("sssssssi", $full_name, $email, $password, $address, $city, $postal_code, $phone, $user_id);
    } else {
        $update_query = "UPDATE customers SET full_name=?, email=?, address=?, city=?, postal_code=?, phone=? WHERE id=?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ssssssi", $full_name, $email, $address, $city, $postal_code, $phone, $user_id);
    }

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Profile updated successfully!";
        header("Location: profile.php");
        exit();
    } else {
        $error_message = "Error updating profile. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Fender</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .profile-card {
            border: none;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-top: 2rem;
        }

        .profile-card:hover {
            transform: translateY(-5px);
        }

        .profile-card .card-header {
            background-color: var(--fender-red);
            color: white;
            padding: 1.5rem;
            border: none;
        }

        .profile-card .card-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: 500;
            color: #333;
        }

        .form-control {
            border: 1px solid #dee2e6;
            padding: 0.75rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--fender-red);
            box-shadow: 0 0 0 0.2rem rgba(227, 27, 35, 0.25);
        }

        .btn-update-profile {
            background-color: var(--fender-red);
            color: white;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-update-profile:hover {
            background-color: var(--primary-red-hover);
            transform: translateY(-2px);
            color: white;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .profile-section {
            background-color: white;
            padding: 2rem 0;
            margin-top: 5rem;
        }

        .form-floating {
            margin-bottom: 1rem;
        }

        .form-floating>.form-control {
            padding-top: 1.625rem;
            padding-bottom: 0.625rem;
        }

        .form-floating>label {
            padding: 1rem 0.75rem;
        }

        .margin-top {
            margin-top: -5rem;
        }
    </style>
</head>

<body>

    <header class="py-4">
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="Fender_guitars_logo.svg.png" alt="Fender Logo" class="img-fluid">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ratings.php">Ratings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link cart-icon" href="cart.php">
                                <i class="fas fa-shopping-cart"></i>
                                <?php if (isset($_SESSION['cart']) && getCartTotalQuantity() > 0): ?>
                                    <span class="cart-badge"><?= getCartTotalQuantity() ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                    </ul>
                    <div class="auth-buttons">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <div class="dropdown">
                                <button class="btn btn-login dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                    <li><a class="dropdown-item" href="purchase-history.php">Purchase History</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="php/logout.php">Logout</a></li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <a class="nav-link btn btn-login" href="login.php">Login</a>
                            <a class="nav-link btn btn-signup" href="register.php">Sign Up</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="profile-section">
        <div class="container margin-top">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="profile-card card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">My Profile</h3>
                        </div>
                        <div class="card-body">
                            <?php if (isset($_SESSION['success_message'])): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php
                                    echo $_SESSION['success_message'];
                                    unset($_SESSION['success_message']);
                                    ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($error_message)): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo $error_message; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <form method="POST" action="profile.php">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
                                    <label for="full_name">Full Name</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                                    <label for="email">Email</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
                                    <label for="password">New Password (leave blank to keep current)</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="address" name="address" placeholder="Address" style="height: 100px" required><?php echo htmlspecialchars($user['address']); ?></textarea>
                                    <label for="address">Address</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo htmlspecialchars($user['city']); ?>" required>
                                    <label for="city">City</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Postal Code" value="<?php echo htmlspecialchars($user['postal_code']); ?>" required>
                                    <label for="postal_code">Postal Code</label>
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
                                    <label for="phone">Phone Number</label>
                                </div>

                                <button type="submit" class="btn btn-update-profile w-100">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>