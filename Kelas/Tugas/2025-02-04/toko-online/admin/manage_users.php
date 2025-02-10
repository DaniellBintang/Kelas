<!-- admin_manage_users.html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h3">Manage Users</h1>
            <nav>
                <a href="admin.php" class="btn btn-outline-light">Admin Home</a>
            </nav>
        </div>
    </header>

    <div class="container mt-5">
        <h2 class="mb-4">User Management</h2>

        <!-- User List Table -->
        <div class="card">
            <div class="card-header">User List</div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dummy Data -->
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>johndoe@example.com</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <button class="btn btn-danger btn-sm">Ban</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jane Smith</td>
                            <td>janesmith@example.com</td>
                            <td><span class="badge bg-danger">Banned</span></td>
                            <td>
                                <button class="btn btn-success btn-sm">Unban</button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Mike Johnson</td>
                            <td>mikejohnson@example.com</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <button class="btn btn-danger btn-sm">Ban</button>
                            </td>
                        </tr>
                        <!-- Add more dummy data as needed -->
                    </tbody>
                </table>
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