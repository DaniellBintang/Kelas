<!-- admin_home.html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bottom {
            margin-bottom: 30rem;
        }
    </style>
</head>

<body>
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h3">Admin Panel</h1>
            <nav>
                <a href="product_manage.php" class="btn btn-outline-light">Manage Products</a>
                <a href="manage_users.php" class="btn btn-outline-light">Manage Users</a>
                <a href="footer_settings.php" class="btn btn-outline-light">Footer Settings</a>
            </nav>
        </div>
    </header>

    <div class="container bottom mt-5">
        <h2>Welcome to Admin Panel</h2>
        <p>Use the navigation menu above to manage products, users, or footer settings. Click on the respective links to access detailed management pages.</p>
    </div>

    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; 2025 Admin Panel. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>