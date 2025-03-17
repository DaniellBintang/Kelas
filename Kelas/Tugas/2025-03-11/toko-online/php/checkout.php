<?php
session_start();
require_once "config.php";

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$customer_id = $_SESSION['user_id'];

// Ambil data alamat pelanggan
$query = "SELECT * FROM customers WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$customer = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Ambil alamat tambahan pelanggan
$query = "SELECT * FROM customer_addresses WHERE customer_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$additional_addresses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Proses checkout
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_address_id = $_POST['address_id'] ?? 'default';
    $use_new_address = $_POST['use_new_address'] ?? false;

    if ($use_new_address) {
        // Simpan alamat baru
        $new_address = $_POST['new_address'];
        $new_city = $_POST['new_city'];
        $new_postal_code = $_POST['new_postal_code'];
        $save_address = isset($_POST['save_address']) ? 1 : 0;

        if ($save_address) {
            $query = "INSERT INTO customer_addresses (customer_id, address, city, postal_code) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("isss", $customer_id, $new_address, $new_city, $new_postal_code);
            $stmt->execute();
            $stmt->close();
        }

        $shipping_address = $new_address;
        $shipping_city = $new_city;
        $shipping_postal_code = $new_postal_code;
    } else {
        if ($selected_address_id === 'default') {
            $shipping_address = $customer['address'];
            $shipping_city = $customer['city'];
            $shipping_postal_code = $customer['postal_code'];
        } else {
            $addr = array_filter($additional_addresses, function ($a) use ($selected_address_id) {
                return $a['id'] == $selected_address_id;
            });
            $addr = reset($addr);
            $shipping_address = $addr['address'];
            $shipping_city = $addr['city'];
            $shipping_postal_code = $addr['postal_code'];
        }
    }

    // Proses order seperti sebelumnya
    $total_price = 0;
    $order_items = [];

    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $query = "SELECT id, price FROM products WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $subtotal = $row['price'] * $quantity;
            $total_price += $subtotal;
            $order_items[] = [
                'product_id' => $row['id'],
                'quantity' => $quantity,
                'price' => $row['price']
            ];
        }
        $stmt->close();
    }

    // Simpan order dengan alamat pengiriman
    $order_query = "INSERT INTO orders (customer_id, total_price, status, shipping_address, shipping_city, shipping_postal_code, created_at) 
                    VALUES (?, ?, 'Pending', ?, ?, ?, NOW())";
    $stmt = $conn->prepare($order_query);
    $stmt->bind_param("idsss", $customer_id, $total_price, $shipping_address, $shipping_city, $shipping_postal_code);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();

    // Simpan order items
    $order_item_query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($order_item_query);
    foreach ($order_items as $item) {
        $stmt->bind_param("iiid", $order_id, $item['product_id'], $item['quantity'], $item['price']);
        $stmt->execute();
    }
    $stmt->close();

    unset($_SESSION['cart']);
    echo "<script>alert('Checkout berhasil! Pesanan Anda sedang diproses.'); window.location.href='../index.php';</script>";
    exit();
}

// Ambil detail produk untuk ditampilkan
$cart_items = [];
$total_price = 0;
foreach ($_SESSION['cart'] as $product_id => $quantity) {
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    $subtotal = $product['price'] * $quantity;
    $total_price += $subtotal;
    $cart_items[] = [
        'product' => $product,
        'quantity' => $quantity,
        'subtotal' => $subtotal
    ];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <style>
        .checkout-container {
            padding-top: 120px;
            padding-bottom: 60px;
        }

        .checkout-section {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .product-summary {
            display: flex;
            align-items: start;
            /* Changed from center to start */
            padding: 15px 0;
            /* Increased padding */
            border-bottom: 1px solid #eee;
            gap: 20px;
            /* Added gap between image and content */
        }

        .product-summary img {
            width: 120px;
            /* Increased width */
            height: 120px;
            /* Increased height */
            object-fit: contain;
            /* Changed from cover to contain */
            border: 1px solid #eee;
            /* Added border */
            background: #fff;
            padding: 5px;
        }

        .product-summary-content {
            flex: 1;
        }

        .address-option {
            border: 1px solid #ddd;
            padding: 15px;
            margin: 10px 0;
            border-radius: 4px;
            cursor: pointer;
            position: relative;
            /* Added for radio button positioning */
        }

        .address-option input[type="radio"] {
            margin-right: 10px;
        }

        .address-option.selected {
            border-color: #007bff;
            background-color: #f8f9fa;
        }

        .new-address-form {
            display: none;
            margin-top: 15px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .new-address-form.active {
            display: block;
        }

        /* Added styles for radio button appearance */
        .address-radio {
            display: none;
        }

        .radio-custom {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 20px;
            height: 20px;
            border: 2px solid #007bff;
            border-radius: 50%;
        }

        .address-radio:checked+.radio-custom::after {
            content: '';
            position: absolute;
            top: 3px;
            left: 3.5px;
            width: 10px;
            height: 10px;
            background: #007bff;
            border-radius: 50%;
        }
    </style>
</head>

<body>

    <div class="container checkout-container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Alamat Pengiriman -->
                <div class="checkout-section">
                    <h3>Alamat Pengiriman</h3>
                    <form id="checkoutForm" method="POST">
                        <!-- Alamat Default -->
                        <div class="address-option" data-address="default">
                            <input type="radio" name="address_id" value="default" class="address-radio" checked>
                            <span class="radio-custom"></span>
                            <strong>Alamat Utama</strong><br>
                            <?php echo htmlspecialchars($customer['full_name']); ?><br>
                            <?php echo htmlspecialchars($customer['address']); ?><br>
                            <?php echo htmlspecialchars($customer['city']) . ' ' . htmlspecialchars($customer['postal_code']); ?>
                        </div>

                        <!-- Alamat Tambahan -->
                        <?php foreach ($additional_addresses as $address): ?>
                            <div class="address-option" data-address="<?php echo $address['id']; ?>">
                                <input type="radio" name="address_id" value="<?php echo $address['id']; ?>" class="address-radio">
                                <span class="radio-custom"></span>
                                <strong>Alamat Tambahan</strong><br>
                                <?php echo htmlspecialchars($address['address']); ?><br>
                                <?php echo htmlspecialchars($address['city']) . ' ' . htmlspecialchars($address['postal_code']); ?>
                            </div>
                        <?php endforeach; ?>

                        <!-- Opsi Alamat Baru -->
                        <div class="address-option" data-address="new">
                            <input type="radio" name="use_new_address" value="1" class="address-radio">
                            <span class="radio-custom"></span>
                            <strong>Gunakan Alamat Baru</strong>
                        </div>

                        <div class="new-address-form">
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="new_address" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kota</label>
                                <input type="text" name="new_city" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kode Pos</label>
                                <input type="text" name="new_postal_code" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-check-label">
                                    <input type="checkbox" name="save_address" class="form-check-input">
                                    Simpan alamat ini untuk penggunaan berikutnya
                                </label>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Ringkasan Produk -->
                <div class="checkout-section">
                    <h3>Ringkasan Pesanan</h3>
                    <?php foreach ($cart_items as $item): ?>
                        <div class="product-summary">
                            <img src="../uploads/<?php echo htmlspecialchars($item['product']['image']); ?>"
                                alt="<?php echo htmlspecialchars($item['product']['name']); ?>">
                            <div class="product-summary-content">
                                <h5><?php echo htmlspecialchars($item['product']['name']); ?></h5>
                                <p>Quantity: <?php echo $item['quantity']; ?></p>
                                <p>Subtotal: Rp <?php echo number_format($item['subtotal'], 0, ',', '.'); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>


            <div class="col-lg-4">
                <!-- Ringkasan Pembayaran -->
                <div class="checkout-section">
                    <h3>Ringkasan Pembayaran</h3>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>Rp <?php echo number_format($total_price, 0, ',', '.'); ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Pengiriman</span>
                        <span>Gratis</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <strong>Total</strong>
                        <strong>Rp <?php echo number_format($total_price, 0, ',', '.'); ?></strong>
                    </div>
                    <button type="submit" form="checkoutForm" class="btn btn-primary w-100">Proses Pembayaran</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addressOptions = document.querySelectorAll('.address-option');
            const newAddressForm = document.querySelector('.new-address-form');
            let currentSelectedOption = document.querySelector('.address-option[data-address="default"]');

            function updateSelectedState(selectedOption) {
                // Remove selected class from all options
                addressOptions.forEach(opt => {
                    opt.classList.remove('selected');
                    const radio = opt.querySelector('input[type="radio"]');
                    radio.checked = false;
                });

                // Add selected class to clicked option
                selectedOption.classList.add('selected');
                const radio = selectedOption.querySelector('input[type="radio"]');
                radio.checked = true;

                // Update currentSelectedOption
                currentSelectedOption = selectedOption;

                // Handle new address form visibility
                if (selectedOption.dataset.address === 'new') {
                    newAddressForm.classList.add('active');
                } else {
                    newAddressForm.classList.remove('active');
                }
            }

            addressOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    updateSelectedState(this);
                });
            });

            // Reset form fields when switching away from new address
            addressOptions.forEach(option => {
                if (option.dataset.address !== 'new') {
                    option.addEventListener('click', function() {
                        const form = document.querySelector('.new-address-form');
                        form.querySelectorAll('input, textarea').forEach(input => {
                            input.value = '';
                        });
                        form.querySelector('input[type="checkbox"]').checked = false;
                    });
                }
            });
        });
    </script>
</body>

</html>