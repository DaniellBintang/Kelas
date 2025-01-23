<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .cart-section {
            padding: 50px 0;
        }

        .cart-table img {
            width: 80px;
            height: auto;
            margin-right: 15px;
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 5px;
        }

        .cart-table td {
            vertical-align: middle;
        }

        .cart-table .product-info {
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h3">Your Cart</h1>
            <nav>
                <a href="index.php" class="btn btn-outline-light">Home</a>
            </nav>
        </div>
    </header>

    <div class="cart-section">
        <div class="container">
            <h2 class="text-center mb-4">Shopping Cart</h2>

            <table class="table table-striped cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="product-info"><img src="images/1.jpg" alt="Product"><span>Product 1</span></td>
                        <td>Product 1</td>
                        <td>
                            <input type="number" value="1" class="form-control" style="width: 70px;">
                        </td>
                        <td>$10.00</td>
                        <td>$10.00</td>
                        <td>
                            <button class="btn btn-danger btn-sm">Remove</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="product-info"><img src="images/electric2.jpg" alt="Product"><span>Product 2</span></td>
                        <td>Product 2</td>
                        <td>
                            <input type="number" value="2" class="form-control" style="width: 70px;">
                        </td>
                        <td>$15.00</td>
                        <td>$30.00</td>
                        <td>
                            <button class="btn btn-danger btn-sm">Remove</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="text-end mt-4">
                <h4>Total: $40.00</h4>
                <a href="checkout.html" class="btn btn-success">Proceed to Checkout</a>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; 2025 Online Store. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>