<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Guitar Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #0d6efd;
            --primary-blue-dark: #0a58ca;
            --text-dark: #333;
            --text-light: #666;
            --bg-light: #f8f9fa;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        .dashboard-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 2rem;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0.5rem 1.5rem rgba(13, 110, 253, 0.15);
        }

        .dashboard-header {
            text-align: center;
            margin-bottom: 2.5rem;
            position: relative;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .dashboard-header h1 {
            color: var(--primary-blue);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .dashboard-header p {
            color: var(--text-light);
            font-size: 1.1rem;
        }

        .dashboard-icon {
            font-size: 3.5rem;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .admin-info {
            background-color: rgba(13, 110, 253, 0.1);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
        }

        .admin-info i {
            font-size: 1.5rem;
            color: var(--primary-blue);
            margin-right: 1rem;
        }

        .admin-info p {
            margin-bottom: 0;
            color: var(--text-dark);
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .menu-item {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.1);
            text-decoration: none;
            color: var(--text-dark);
            overflow: hidden;
        }

        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(13, 110, 253, 0.2);
            border-color: var(--primary-blue);
        }

        .menu-item-header {
            background-color: var(--primary-blue);
            color: white;
            padding: 1rem;
            text-align: center;
        }

        .menu-item-body {
            padding: 1.5rem;
            text-align: center;
        }

        .menu-item-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--primary-blue);
        }

        .menu-item-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
        }

        .menu-item-desc {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        .logout-form {
            margin-top: 2rem;
        }

        .logout-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            text-align: center;
            display: block;
            width: 100%;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #bb2d3b;
            transform: translateY(-2px);
            box-shadow: 0 0.25rem 0.75rem rgba(220, 53, 69, 0.2);
        }

        .footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            color: var(--text-light);
            font-size: 0.9rem;
        }

        /* Additional styles for other admin pages */
        .content-container {
            padding: 1.5rem;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .back-btn {
            margin-bottom: 1.5rem;
        }

        @yield('additional-styles')
    </style>

    @yield('styles')
</head>

<body>
    <div class="container dashboard-container">
        @yield('content')

        <div class="footer">
            <p>&copy; {{ date('Y') }} Fender Guitar Shop Admin Panel. All rights reserved.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>
