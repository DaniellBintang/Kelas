<!-- admin_footer_settings.html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h3">Footer Settings</h1>
            <nav>
                <a href="admin.php" class="btn btn-outline-light">Admin Home</a>
            </nav>
        </div>
    </header>

    <div class="container mt-5">
        <h2 class="mb-4">Manage Footer Content</h2>

        <!-- Footer Settings Form -->
        <div class="card">
            <div class="card-header">Footer Configuration</div>
            <div class="card-body">
                <form action="#" method="post">
                    <div class="mb-3">
                        <label for="paymentOptions" class="form-label">Payment Options</label>
                        <textarea class="form-control" id="paymentOptions" name="paymentOptions" rows="3" required>e.g., Visa, MasterCard, PayPal</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="socialMediaLinks" class="form-label">Social Media Links</label>
                        <textarea class="form-control" id="socialMediaLinks" name="socialMediaLinks" rows="3" required>e.g., Facebook, Twitter, Instagram</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="contactInfo" class="form-label">Contact Information</label>
                        <textarea class="form-control" id="contactInfo" name="contactInfo" rows="3" required>e.g., Phone: +123456789, Email: support@example.com</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p>&copy; 2025 Admin Panel. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>