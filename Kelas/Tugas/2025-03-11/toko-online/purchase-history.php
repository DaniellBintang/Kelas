<?php
session_start();
require_once 'php/config.php';

// Cek jika user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Function to get total quantity in cart
function getCartTotalQuantity()
{
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        return 0;
    }
    return array_sum($_SESSION['cart']);
}

// Function to check if an order has been rated
function hasOrderBeenRated($conn, $order_id, $user_id)
{
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM ratings WHERE order_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $order_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['count'] > 0;
}

// Ambil data pesanan dari database dengan join ke order_items dan products
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("
    SELECT o.*, oi.quantity, oi.price as item_price, p.id as product_id, p.name as product_name, p.image as product_image 
    FROM orders o 
    LEFT JOIN order_items oi ON o.id = oi.order_id 
    LEFT JOIN products p ON oi.product_id = p.id 
    WHERE o.customer_id = ? 
    ORDER BY o.created_at DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Mengelompokkan hasil berdasarkan order_id
$orders = [];
while ($row = $result->fetch_assoc()) {
    if (!isset($orders[$row['id']])) {
        $orders[$row['id']] = [
            'id' => $row['id'],
            'created_at' => $row['created_at'],
            'status' => $row['status'],
            'shipping_address' => $row['shipping_address'],
            'shipping_city' => $row['shipping_city'],
            'shipping_postal_code' => $row['shipping_postal_code'],
            'total_price' => $row['total_price'],
            'items' => [],
            'rated' => hasOrderBeenRated($conn, $row['id'], $user_id)
        ];
    }
    if ($row['product_name']) {
        $orders[$row['id']]['items'][] = [
            'product_id' => $row['product_id'],
            'product_name' => $row['product_name'],
            'product_image' => $row['product_image'],
            'quantity' => $row['quantity'],
            'price' => $row['item_price']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History - Fender</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .order-history-section {
            background-color: white;
            padding: 2rem 0;
            margin-top: 5rem;
        }

        .order-card {
            border: none;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            cursor: pointer;
        }

        .order-card:hover {
            transform: translateY(-5px);
        }

        .order-header {
            background-color: var(--fender-red);
            color: white;
            padding: 1rem;
            border-radius: 8px 8px 0 0;
        }

        .order-body {
            padding: 1.5rem;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.8rem;
        }

        .status-pending {
            background-color: #ffeeba;
            color: #856404;
        }

        .status-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-canceled {
            background-color: #f8d7da;
            color: #721c24;
        }

        .order-details {
            margin-top: 1rem;
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 4px;
        }

        .price {
            color: var(--fender-red);
            font-weight: 600;
            font-size: 1.2rem;
        }

        .empty-orders {
            text-align: center;
            padding: 3rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .empty-orders i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 1rem;
        }

        .modal-product-image {
            max-width: 100px;
            height: auto;
        }

        .order-item {
            border-bottom: 1px solid #eee;
            padding: 1rem 0;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .modal-product-image {
            width: 100px;
            height: 100px;
            object-fit: contain;
            border-radius: 8px;
            border: 1px solid #eee;
            background-color: #fff;
            padding: 5px;
        }

        .order-item {
            border-bottom: 1px solid #eee;
            padding: 1rem 0;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .product-image-container {
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        /* Memastikan container gambar di modal memiliki ukuran yang konsisten */
        .modal .order-item .col-2 {
            width: 120px;
            min-width: 120px;
        }

        /* Star rating styles */
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
        }

        .rating input {
            display: none;
        }

        .rating label {
            cursor: pointer;
            width: 40px;
            height: 40px;
            font-size: 30px;
            color: #ccc;
            transition: all 0.2s;
            margin: 0 5px;
        }

        .rating label:before {
            content: '★';
        }

        .rating input:checked~label {
            color: #ffd700;
        }

        .rating:not(:checked) label:hover,
        .rating:not(:checked) label:hover~label {
            color: #ffc107;
        }

        .review-btn {
            background-color: var(--fender-red);
            color: white;
            border: none;
            transition: all 0.3s;
        }

        .review-btn:hover {
            background-color: #c81e1e;
            color: white;
        }

        .rated-badge {
            background-color: #28a745;
            color: white;
            padding: 0.3rem 0.6rem;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        /* Menyesuaikan layout untuk layar kecil */
        @media (max-width: 576px) {
            .modal-product-image {
                width: 80px;
                height: 80px;
            }

            .product-image-container {
                width: 80px;
                height: 80px;
            }

            .modal .order-item .col-2 {
                width: 90px;
                min-width: 90px;
            }
        }
    </style>
</head>

<body>
    <header class="py-2">
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

    <div class="order-history-section">
        <div class="container">
            <h2 class="text-center mb-4">Order History</h2>

            <?php if (empty($orders)): ?>
                <div class="empty-orders">
                    <i class="fas fa-shopping-bag"></i>
                    <h3>No Orders Yet</h3>
                    <p>Start shopping to see your orders here!</p>
                    <a href="shop.php" class="btn btn-primary mt-3">Shop Now</a>
                </div>
            <?php else: ?>
                <!-- Active Orders Section -->
                <h3 class="mb-3">Active Orders</h3>
                <?php
                $hasActiveOrders = false;
                foreach ($orders as $order):
                    if ($order['status'] == 'pending'):
                        $hasActiveOrders = true;
                ?>
                        <div class="order-card card" data-bs-toggle="modal" data-bs-target="#orderModal<?php echo $order['id']; ?>">
                            <div class="order-header d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0">Order #<?php echo $order['id']; ?></h5>
                                    <small><?php echo date('F j, Y', strtotime($order['created_at'])); ?></small>
                                </div>
                                <span class="status-badge status-<?php echo $order['status']; ?>">
                                    <?php echo ucfirst($order['status']); ?>
                                </span>
                            </div>
                            <div class="order-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Shipping Address:</h6>
                                        <p>
                                            <?php echo htmlspecialchars($order['shipping_address']); ?><br>
                                            <?php echo htmlspecialchars($order['shipping_city']); ?><br>
                                            <?php echo htmlspecialchars($order['shipping_postal_code']); ?>
                                        </p>
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        <h6>Total Amount:</h6>
                                        <p class="price">Rp <?php echo number_format($order['total_price'], 0, ',', '.'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for this order -->
                        <div class="modal fade" id="orderModal<?php echo $order['id']; ?>" tabindex="-1" aria-labelledby="orderModalLabel<?php echo $order['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="orderModalLabel<?php echo $order['id']; ?>">
                                            Order Details #<?php echo $order['id']; ?>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="order-info mb-4">
                                            <h6>Order Information</h6>
                                            <p>Date: <?php echo date('F j, Y', strtotime($order['created_at'])); ?></p>
                                            <p>Status: <span class="status-badge status-<?php echo $order['status']; ?>"><?php echo ucfirst($order['status']); ?></span></p>
                                            <p>Shipping Address:<br>
                                                <?php echo htmlspecialchars($order['shipping_address']); ?><br>
                                                <?php echo htmlspecialchars($order['shipping_city']); ?><br>
                                                <?php echo htmlspecialchars($order['shipping_postal_code']); ?>
                                            </p>
                                        </div>

                                        <h6>Ordered Items</h6>
                                        <?php foreach ($order['items'] as $item): ?>
                                            <div class="order-item">
                                                <div class="row align-items-center">
                                                    <div class="col-2">
                                                        <img src="uploads/<?php echo htmlspecialchars($item['product_image']); ?>"
                                                            alt="<?php echo htmlspecialchars($item['product_name']); ?>"
                                                            class="modal-product-image">
                                                    </div>
                                                    <div class="col-6">
                                                        <h6><?php echo htmlspecialchars($item['product_name']); ?></h6>
                                                        <p class="mb-0">Quantity: <?php echo $item['quantity']; ?></p>
                                                    </div>
                                                    <div class="col-4 text-end">
                                                        <p class="price mb-0">Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                        <div class="total-section mt-4 text-end">
                                            <h5>Total Amount: <span class="price">Rp <?php echo number_format($order['total_price'], 0, ',', '.'); ?></span></h5>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

                <?php if (!$hasActiveOrders): ?>
                    <div class="alert alert-info">You don't have any active orders at the moment.</div>
                <?php endif; ?>

                <!-- Completed Orders Section -->
                <h3 class="mb-3 mt-5">Order History</h3>
                <?php
                $hasCompletedOrders = false;
                foreach ($orders as $order):
                    if ($order['status'] != 'pending'):
                        $hasCompletedOrders = true;
                ?>
                        <div class="order-card card" data-bs-toggle="modal" data-bs-target="#orderModal<?php echo $order['id']; ?>">
                            <div class="order-header d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0">Order #<?php echo $order['id']; ?></h5>
                                    <small><?php echo date('F j, Y', strtotime($order['created_at'])); ?></small>
                                </div>
                                <div>
                                    <span class="status-badge status-<?php echo $order['status']; ?>">
                                        <?php echo ucfirst($order['status']); ?>
                                    </span>
                                    <?php if ($order['status'] == 'completed' && $order['rated']): ?>
                                        <span class="rated-badge ms-2">
                                            <i class="fas fa-star"></i> Rated
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="order-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Shipping Address:</h6>
                                        <p>
                                            <?php echo htmlspecialchars($order['shipping_address']); ?><br>
                                            <?php echo htmlspecialchars($order['shipping_city']); ?><br>
                                            <?php echo htmlspecialchars($order['shipping_postal_code']); ?>
                                        </p>
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        <h6>Total Amount:</h6>
                                        <p class="price">Rp <?php echo number_format($order['total_price'], 0, ',', '.'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for this order -->
                        <div class="modal fade" id="orderModal<?php echo $order['id']; ?>" tabindex="-1" aria-labelledby="orderModalLabel<?php echo $order['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="orderModalLabel<?php echo $order['id']; ?>">
                                            Order Details #<?php echo $order['id']; ?>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="order-info mb-4">
                                            <h6>Order Information</h6>
                                            <p>Date: <?php echo date('F j, Y', strtotime($order['created_at'])); ?></p>
                                            <p>Status: <span class="status-badge status-<?php echo $order['status']; ?>"><?php echo ucfirst($order['status']); ?></span></p>
                                            <p>Shipping Address:<br>
                                                <?php echo htmlspecialchars($order['shipping_address']); ?><br>
                                                <?php echo htmlspecialchars($order['shipping_city']); ?><br>
                                                <?php echo htmlspecialchars($order['shipping_postal_code']); ?>
                                            </p>
                                        </div>

                                        <h6>Ordered Items</h6>
                                        <?php foreach ($order['items'] as $item): ?>
                                            <div class="order-item">
                                                <div class="row align-items-center">
                                                    <div class="col-2">
                                                        <img src="uploads/<?php echo htmlspecialchars($item['product_image']); ?>"
                                                            alt="<?php echo htmlspecialchars($item['product_name']); ?>"
                                                            class="modal-product-image">
                                                    </div>
                                                    <div class="col-6">
                                                        <h6><?php echo htmlspecialchars($item['product_name']); ?></h6>
                                                        <p class="mb-0">Quantity: <?php echo $item['quantity']; ?></p>
                                                    </div>
                                                    <div class="col-4 text-end">
                                                        <p class="price mb-0">Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                        <div class="total-section mt-4 text-end">
                                            <h5>Total Amount: <span class="price">Rp <?php echo number_format($order['total_price'], 0, ',', '.'); ?></span></h5>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <?php if ($order['status'] == 'completed' && !$order['rated']): ?>
                                            <button type="button" class="btn review-btn" data-bs-toggle="modal" data-bs-target="#reviewModal<?php echo $order['id']; ?>">
                                                <i class="fas fa-star"></i> Rate & Review
                                            </button>
                                        <?php elseif ($order['status'] == 'completed' && $order['rated']): ?>
                                            <span class="rated-badge">
                                                <i class="fas fa-check-circle"></i> Order Rated
                                            </span>
                                        <?php endif; ?>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if ($order['status'] == 'completed' && !$order['rated']): ?>
                            <!-- Review Modal -->
                            <div class="modal fade" id="reviewModal<?php echo $order['id']; ?>" tabindex="-1" aria-labelledby="reviewModalLabel<?php echo $order['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="reviewModalLabel<?php echo $order['id']; ?>">
                                                Rate Your Order #<?php echo $order['id']; ?>
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Please select an item to review:</p>
                                            <form id="reviewForm<?php echo $order['id']; ?>" action="php/submit-review.php" method="post">
                                                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                                                <div class="mb-3">
                                                    <label class="form-label">Product</label>
                                                    <select class="form-select" name="product_id" required>
                                                        <option value="">Select Product to Review</option>
                                                        <?php foreach ($order['items'] as $item): ?>
                                                            <option value="<?php echo $item['product_id']; ?>">
                                                                <?php echo htmlspecialchars($item['product_name']); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="mb-3 text-center">
                                                    <label class="form-label">Your Rating</label>
                                                    <div class="rating">
                                                        <input type="radio" id="star5<?php echo $order['id']; ?>" name="rating" value="5" required />
                                                        <label for="star5<?php echo $order['id']; ?>"></label>
                                                        <input type="radio" id="star4<?php echo $order['id']; ?>" name="rating" value="4" />
                                                        <label for="star4<?php echo $order['id']; ?>"></label>
                                                        <input type="radio" id="star3<?php echo $order['id']; ?>" name="rating" value="3" />
                                                        <label for="star3<?php echo $order['id']; ?>"></label>
                                                        <input type="radio" id="star2<?php echo $order['id']; ?>" name="rating" value="2" />
                                                        <label for="star2<?php echo $order['id']; ?>"></label>
                                                        <input type="radio" id="star1<?php echo $order['id']; ?>" name="rating" value="1" />
                                                        <label for="star1<?php echo $order['id']; ?>"></label>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="review<?php echo $order['id']; ?>" class="form-label">Your Review</label>
                                                    <textarea class="form-control" id="review<?php echo $order['id']; ?>" name="review" rows="4" required placeholder="Tell us about your experience with this product..."></textarea>
                                                </div>

                                                <div class="d-grid gap-2">
                                                    <button type="submit" class="btn btn-primary">Submit Review</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                <?php if (!$hasCompletedOrders): ?>
                    <div class="alert alert-info">You don't have any completed or canceled orders yet.</div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Perbaikan pada event handler form review
        document.addEventListener('DOMContentLoaded', function() {
            // Close review modal and refresh page after submission
            const reviewForms = document.querySelectorAll('form[id^="reviewForm"]');
            reviewForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);

                    fetch(this.action, {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => {
                            // Tambahkan penanganan respons non-200
                            if (!response.ok) {
                                throw new Error('Server responded with status ' + response.status);
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Close all modals
                                const modals = document.querySelectorAll('.modal');
                                modals.forEach(modal => {
                                    const modalInstance = bootstrap.Modal.getInstance(modal);
                                    if (modalInstance) {
                                        modalInstance.hide();
                                    }
                                });

                                // Show success message and reload page
                                alert('Thank you for your review!');
                                window.location.reload();
                            } else {
                                // Tampilkan pesan error dari server
                                alert('Error: ' + (data.message || 'Unknown error'));
                            }
                        })
                        .catch(error => {
                            // Tambahkan logging untuk debugging
                            console.error('Error details:', error);
                            alert('An error occurred while submitting your review. Please try again.');
                        });
                });
            });
        });
    </script>
</body>

</html>