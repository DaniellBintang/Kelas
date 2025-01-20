<?php
session_start();
require_once 'crud/signup_db.php'; // Menghubungkan ke database

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: crud/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_data = [];

// Ambil informasi pengguna dari database
$query = $conn->prepare("SELECT name, email, address FROM users WHERE id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
} else {
    die("User not found.");
}

$query->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .checkout-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .checkout-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            width: 95%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-group textarea {
            resize: none;
        }

        .form-group input[type="checkbox"] {
            width: auto;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        .cart-summary {
            margin-top: 20px;
            padding: 10px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .cart-summary h3 {
            margin-top: 0;
        }

        .cart-summary ul {
            list-style: none;
            padding: 0;
        }

        .cart-summary ul li {
            padding: 5px 0;
        }

        .checkbox {
            display: flex;
            align-items: center;
        }

        .checkbox input {
            margin-bottom: 7px;
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <div class="checkout-container">
        <h2>Checkout</h2>

        <form action="crud/process_checkout.php" method="POST">
            <!-- Informasi pengguna -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($user_data['name']); ?>" readonly>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user_data['email']); ?>" readonly>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" readonly><?= htmlspecialchars($user_data['address']); ?></textarea>
            </div>

            <!-- Pilihan alamat baru -->
            <div class="form-group checkbox">
                <label for="use_new_address">Use a new address</label>
                <input type="checkbox" id="use_new_address" name="use_new_address">
            </div>

            <div class="form-group">
                <textarea id="new_address" name="new_address" placeholder="Enter your new address" style="display: none;"></textarea>
            </div>

            <!-- Total harga -->
            <div class="cart-summary">
                <h3>Order Summary</h3>
                <ul>
                    <?php
                    // Ambil isi cart dari session
                    $cart = $_SESSION['cart'] ?? [];
                    $total_price = 0;

                    foreach ($cart as $item) {
                        $item_total = $item['price'] * $item['quantity'];
                        $total_price += $item_total;
                        echo "<li>" . htmlspecialchars($item['name']) . " - $" . htmlspecialchars($item['price']) . " x " . htmlspecialchars($item['quantity']) . " = $" . $item_total . "</li>";
                    }
                    ?>
                </ul>
                <p><strong>Total Price:</strong> $<?= $total_price; ?></p>
            </div>

            <input type="hidden" name="total_price" value="<?= $total_price; ?>">

            <div class="form-group">
                <button type="submit">Confirm Order</button>
            </div>
        </form>
    </div>

    <script>
        // Tampilkan atau sembunyikan input alamat baru
        const useNewAddressCheckbox = document.getElementById('use_new_address');
        const newAddressTextarea = document.getElementById('new_address');

        useNewAddressCheckbox.addEventListener('change', () => {
            if (useNewAddressCheckbox.checked) {
                newAddressTextarea.style.display = 'block';
                newAddressTextarea.required = true;
            } else {
                newAddressTextarea.style.display = 'none';
                newAddressTextarea.required = false;
            }
        });
    </script>
</body>

</html>