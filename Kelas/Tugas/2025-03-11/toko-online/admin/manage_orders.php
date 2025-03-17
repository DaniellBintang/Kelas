<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

class Order
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllOrders()
    {
        $query = "SELECT orders.id, customers.full_name, orders.total_price, orders.status, orders.created_at 
                  FROM orders 
                  JOIN customers ON orders.customer_id = customers.id 
                  ORDER BY orders.created_at DESC";
        return mysqli_query($this->conn, $query);
    }

    public function getOrderDetails($order_id)
    {
        $query = "SELECT products.name, products.price as unit_price, order_items.quantity, order_items.price as total_price 
                  FROM order_items 
                  JOIN products ON order_items.product_id = products.id 
                  WHERE order_items.order_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function updateOrderStatus($order_id, $status)
    {
        $query = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $status, $order_id);
        return $stmt->execute();
    }

    public function deleteOrder($order_id)
    {
        $query = "DELETE FROM orders WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $order_id);
        return $stmt->execute();
    }
}

$orderObj = new Order($conn);

if (isset($_POST['update_status'])) {
    $orderObj->updateOrderStatus($_POST['order_id'], $_POST['status']);
    header('Location: manage_orders.php');
    exit();
}

if (isset($_GET['delete'])) {
    $orderObj->deleteOrder($_GET['delete']);
    header('Location: manage_orders.php');
    exit();
}

$orders = $orderObj->getAllOrders();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .order-details {
            display: none;
            background-color: #f8f9fa;
            padding: 15px;
            margin-top: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Manage Orders</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($orders)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['full_name']) ?></td>
                            <td>Rp <?= number_format($row['total_price'], 0, ',', '.') ?></td>
                            <td>
                                <form method="POST" style="display:inline-block;">
                                    <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                                    <select name="status" class="form-select" onchange="this.form.submit()">
                                        <option value="pending" <?= strtolower($row['status']) == 'pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="completed" <?= strtolower($row['status']) == 'completed' ? 'selected' : '' ?>>Completed</option>
                                        <option value="canceled" <?= strtolower($row['status']) == 'canceled' ? 'selected' : '' ?>>Canceled</option>
                                    </select>
                                    <input type="hidden" name="update_status" value="1">
                                </form>
                            </td>
                            <td><?= htmlspecialchars($row['created_at']) ?></td>
                            <td>
                                <button class="btn btn-info btn-sm mb-1" onclick="toggleOrderDetails(<?= $row['id'] ?>)">
                                    View Details
                                </button>
                                <a href="manage_orders.php?delete=<?= $row['id'] ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this order?')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="p-0">
                                <div id="orderDetails<?= $row['id'] ?>" class="order-details">
                                    <h5 class="mb-3">Order Details</h5>
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Unit Price</th>
                                                <th>Quantity</th>
                                                <th>Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $orderDetails = $orderObj->getOrderDetails($row['id']);
                                            while ($detail = mysqli_fetch_assoc($orderDetails)):
                                            ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($detail['name']) ?></td>
                                                    <td>Rp <?= number_format($detail['unit_price'], 0, ',', '.') ?></td>
                                                    <td><?= htmlspecialchars($detail['quantity']) ?></td>
                                                    <td>Rp <?= number_format($detail['total_price'], 0, ',', '.') ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function toggleOrderDetails(orderId) {
            const detailsDiv = document.getElementById('orderDetails' + orderId);
            if (detailsDiv.style.display === 'none' || detailsDiv.style.display === '') {
                detailsDiv.style.display = 'block';
            } else {
                detailsDiv.style.display = 'none';
            }
        }
    </script>
</body>

</html>