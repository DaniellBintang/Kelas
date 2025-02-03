<?php
session_start();
require_once '../crud/db_connection.php'; // Koneksi database

// Pastikan admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

class OrderManager
{
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    public function getOrders()
    {
        $sql = "SELECT o.*, u.email 
                FROM orders o
                LEFT JOIN users u ON o.user_id = u.id
                ORDER BY o.created_at DESC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrderDetails($orderId)
    {
        $sql = "SELECT oi.*, g.guitar_name, g.guitar_price, g.guitar_image
                FROM order_items oi
                JOIN guitars g ON oi.guitar_id = g.id
                WHERE oi.order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteOrder($orderId)
    {
        // First, delete order items
        $stmt1 = $this->conn->prepare("DELETE FROM order_items WHERE order_id = ?");
        $stmt1->bind_param("i", $orderId);
        $stmt1->execute();

        // Then delete the order
        $stmt2 = $this->conn->prepare("DELETE FROM orders WHERE id = ?");
        $stmt2->bind_param("i", $orderId);
        return $stmt2->execute();
    }

    public function updateOrderStatus($orderId, $status)
    {
        $stmt = $this->conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $orderId);
        return $stmt->execute();
    }
}

$conn = openConnection();
$orderManager = new OrderManager($conn);

// Handle order actions
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_order'])) {
        $orderId = intval($_POST['order_id']);
        if ($orderManager->deleteOrder($orderId)) {
            $message = "Order deleted successfully!";
            $messageType = 'success';
        } else {
            $message = "Failed to delete order.";
            $messageType = 'danger';
        }
    }

    if (isset($_POST['update_status'])) {
        $orderId = intval($_POST['order_id']);
        $status = $_POST['status'];
        if ($orderManager->updateOrderStatus($orderId, $status)) {
            $message = "Order status updated successfully!";
            $messageType = 'success';
        } else {
            $message = "Failed to update order status.";
            $messageType = 'danger';
        }
    }
}

$orders = $orderManager->getOrders();
closeConnection($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="admin-container">
        <nav class="admin-nav">
            <a href="index.php">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="manage_guitars.php">
                <i class="fas fa-guitar"></i> Manage Guitars
            </a>
            <a href="manage_reviews.php">
                <i class="fas fa-comment-dots"></i> Manage Reviews
            </a>
            <a href="logout.php" class="btn btn-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </nav>

        <?php if (!empty($message)): ?>
            <div class="alert alert-<?= $messageType ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <div class="orders-management">
            <h1>Manage Orders</h1>

            <div class="order-summary">
                <div class="summary-card">
                    <div class="card-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-content">
                        <h3>Total Orders</h3>
                        <p><?= count($orders) ?></p>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="card-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-content">
                        <h3>Total Revenue</h3>
                        <p>$<?= number_format(array_sum(array_column($orders, 'total_price')), 2) ?></p>
                    </div>
                </div>
            </div>

            <div class="order-list">
                <h2>Order Inventory</h2>
                <table class="admin-table" id="ordersTable">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Email</th>
                            <th>Total Price</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?= htmlspecialchars($order['id']) ?></td>
                                <td><?= htmlspecialchars($order['email'] ?? 'N/A') ?></td>
                                <td>$<?= number_format($order['total_price'], 2) ?></td>
                                <td><?= htmlspecialchars($order['created_at']) ?></td>
                                <td>
                                    <span class="order-status 
                                        <?= match ($order['status'] ?? 'pending') {
                                            'completed' => 'status-success',
                                            'cancelled' => 'status-danger',
                                            'processing' => 'status-warning',
                                            default => 'status-info'
                                        } ?>">
                                        <?= htmlspecialchars(ucfirst($order['status'] ?? 'Pending')) ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-secondary btn-sm view-details"
                                        data-order-id="<?= $order['id'] ?>">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-primary btn-sm update-status"
                                        data-order-id="<?= $order['id'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                        <button type="submit" name="delete_order"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this order?');">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Order Details Modal -->
    <div id="orderDetailsModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Order Details</h2>
            <div id="orderDetailsContent"></div>
        </div>
    </div>

    <!-- Update Status Modal -->
    <div id="updateStatusModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Update Order Status</h2>
            <form method="POST">
                <input type="hidden" name="order_id" id="statusOrderId">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <button type="submit" name="update_status" class="btn btn-primary">Update Status</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // View Order Details
            const viewDetailsButtons = document.querySelectorAll('.view-details');
            const orderDetailsModal = document.getElementById('orderDetailsModal');
            const orderDetailsContent = document.getElementById('orderDetailsContent');
            const modalCloseButtons = document.querySelectorAll('.modal .close');

            viewDetailsButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.dataset.orderId;

                    // Fetch order details via AJAX
                    fetch(`get_order_details.php?order_id=${orderId}`)
                        .then(response => response.text())
                        .then(html => {
                            orderDetailsContent.innerHTML = html;
                            orderDetailsModal.style.display = 'block';
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Failed to fetch order details');
                        });
                });
            });

            // Update Status
            const updateStatusButtons = document.querySelectorAll('.update-status');
            const updateStatusModal = document.getElementById('updateStatusModal');
            const statusOrderIdInput = document.getElementById('statusOrderId');

            updateStatusButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.dataset.orderId;
                    statusOrderIdInput.value = orderId;
                    updateStatusModal.style.display = 'block';
                });
            });

            // Close Modals
            modalCloseButtons.forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('.modal').style.display = 'none';
                });
            });

            // Close modal if clicked outside
            window.addEventListener('click', function(event) {
                if (event.target.classList.contains('modal')) {
                    event.target.style.display = 'none';
                }
            });
        });
    </script>

    <style>
        /* Order Summary Styles */
        .order-summary {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .summary-card {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            display: flex;
            align-items: center;
            width: 48%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .order-status {
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
        }

        .status-success {
            background-color: #d4edda;
            color: #155724;
        }

        .status-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 600px;
            position: relative;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: black;
        }
    </style>
</body>

</html>