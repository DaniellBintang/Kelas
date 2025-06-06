<?php
session_start();
require_once '../crud/db_connection.php';

class GuitarManager
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllGuitars()
    {
        $sql = "SELECT g.*, gd.description, gd.specifications, gd.stock FROM guitars g LEFT JOIN guitar_details gd ON g.id = gd.id";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addGuitar($name, $price, $image, $description, $specifications, $stock)
    {
        if (empty($name) || empty($price) || empty($description) || empty($specifications) || empty($stock)) {
            return "All fields must be filled.";
        }

        $sql = "INSERT INTO guitars (guitar_name, guitar_price, guitar_image) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sds", $name, $price, $image);
        if ($stmt->execute()) {
            $guitar_id = $this->conn->insert_id;
            $sqlDetails = "INSERT INTO guitar_details (id, description, specifications, stock) VALUES (?, ?, ?, ?)";
            $stmtDetails = $this->conn->prepare($sqlDetails);
            $stmtDetails->bind_param("issi", $guitar_id, $description, $specifications, $stock);
            $stmtDetails->execute();
            return "Guitar added successfully.";
        }
        return "Error adding guitar.";
    }

    public function updateGuitar($id, $name, $price, $image, $description, $specifications, $stock)
    {
        $sql = "UPDATE guitars SET guitar_name = ?, guitar_price = ?, guitar_image = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return "Prepare failed (guitars): " . $this->conn->error;
        }

        $stmt->bind_param("sdsi", $name, $price, $image, $id);
        $stmt->execute();

        $guitarUpdated = $stmt->affected_rows > 0;

        $sqlCheck = "SELECT id FROM guitar_details WHERE id = ?";
        $stmtCheck = $this->conn->prepare($sqlCheck);
        $stmtCheck->bind_param("i", $id);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();

        if ($resultCheck->num_rows > 0) {
            $sqlDetails = "UPDATE guitar_details SET description = ?, specifications = ?, stock = ? WHERE id = ?";
            $stmtDetails = $this->conn->prepare($sqlDetails);
            if (!$stmtDetails) {
                return "Prepare failed (details): " . $this->conn->error;
            }

            $stmtDetails->bind_param("ssii", $description, $specifications, $stock, $id);
            $stmtDetails->execute();

            $detailsUpdated = $stmtDetails->affected_rows > 0;
        } else {
            $sqlDetails = "INSERT INTO guitar_details (id, description, specifications, stock) VALUES (?, ?, ?, ?)";
            $stmtDetails = $this->conn->prepare($sqlDetails);
            if (!$stmtDetails) {
                return "Prepare failed (insert details): " . $this->conn->error;
            }

            $stmtDetails->bind_param("issi", $id, $description, $specifications, $stock);
            $stmtDetails->execute();

            $detailsUpdated = $stmtDetails->affected_rows > 0;
        }

        if ($guitarUpdated || $detailsUpdated) {
            return "Guitar updated successfully.";
        }
        return "No changes made to guitars or guitar_details table.";
    }

    public function deleteGuitar($id)
    {
        $sqlDetails = "DELETE FROM guitar_details WHERE id = ?";
        $stmtDetails = $this->conn->prepare($sqlDetails);
        $stmtDetails->bind_param("i", $id);
        $stmtDetails->execute();

        $sql = "DELETE FROM guitars WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return "Guitar deleted successfully.";
        }
        return "Error deleting guitar.";
    }
}

$conn = openConnection();
$guitarManager = new GuitarManager($conn);

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $message = $guitarManager->addGuitar($_POST['name'], $_POST['price'], $_POST['image'], $_POST['description'], $_POST['specifications'], $_POST['stock']);
    } elseif (isset($_POST['edit'])) {
        $message = $guitarManager->updateGuitar($_POST['id'], $_POST['name'], $_POST['price'], $_POST['image'], $_POST['description'], $_POST['specifications'], $_POST['stock']);
    } elseif (isset($_POST['delete'])) {
        $message = $guitarManager->deleteGuitar($_POST['id']);
    }
}

$guitars = $guitarManager->getAllGuitars();
closeConnection($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Guitars</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="admin-container">
        <nav class="admin-nav">
            <a href="index.php">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="manage_orders.php">
                <i class="fas fa-shopping-cart"></i> Manage Orders
            </a>
            <a href="manage_reviews.php">
                <i class="fas fa-comment-dots"></i> Manage Reviews
            </a>
            <a href="logout.php" class="btn btn-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </nav>

        <?php if (!empty($message)): ?>
            <div class="alert <?= strpos($message, 'successfully') !== false ? 'alert-success' : 'alert-danger' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <div class="guitar-management">
            <h1>Manage Guitars</h1>

            <div class="admin-form" id="guitar-form">
                <h2>Add/Edit Guitar</h2>
                <form method="POST" id="guitarForm">
                    <input type="hidden" name="id" id="guitar_id">

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Guitar Name</label>
                            <input type="text" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price ($)</label>
                            <input type="number" step="0.01" name="price" id="price" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="image">Image URL</label>
                            <input type="text" name="image" id="image" required>
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock Quantity</label>
                            <input type="number" name="stock" id="stock" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="specifications">Specifications</label>
                        <textarea name="specifications" id="specifications" rows="4" required></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="add" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Guitar
                        </button>
                        <button type="submit" name="edit" class="btn btn-secondary" style="display:none;" id="editButton">
                            <i class="fas fa-edit"></i> Update Guitar
                        </button>
                        <button type="reset" class="btn btn-danger" id="cancelEdit" style="display:none;">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </form>
            </div>

            <div class="guitar-list">
                <h2>Guitar Inventory</h2>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($guitars as $guitar) : ?>
                            <tr>
                                <td><?= htmlspecialchars($guitar['id']); ?></td>
                                <td><?= htmlspecialchars($guitar['guitar_name']); ?></td>
                                <td>$<?= htmlspecialchars(number_format($guitar['guitar_price'], 2)); ?></td>
                                <td>
                                    <img src="../crud/<?= htmlspecialchars($guitar['guitar_image']); ?>"
                                        alt="Guitar Image" class="admin-image">
                                </td>
                                <td><?= htmlspecialchars($guitar['stock']); ?></td>
                                <td>
                                    <button onclick="editGuitar(<?= htmlspecialchars(json_encode($guitar)) ?>)" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $guitar['id'] ?>">
                                        <button type="submit" name="delete" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this guitar?');">
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

    <script>
        function editGuitar(guitar) {
            document.getElementById('guitar_id').value = guitar.id;
            document.getElementById('name').value = guitar.guitar_name;
            document.getElementById('price').value = guitar.guitar_price;
            document.getElementById('image').value = guitar.guitar_image;
            document.getElementById('description').value = guitar.description;
            document.getElementById('specifications').value = guitar.specifications;
            document.getElementById('stock').value = guitar.stock;

            // Show edit and cancel buttons, hide add button
            document.querySelector('button[name="add"]').style.display = 'none';
            document.getElementById('editButton').style.display = 'inline-block';
            document.getElementById('cancelEdit').style.display = 'inline-block';

            // Scroll to form
            document.getElementById('guitar-form').scrollIntoView({
                behavior: 'smooth'
            });
        }

        // Cancel edit functionality
        document.getElementById('cancelEdit').addEventListener('click', function() {
            // Reset form
            document.getElementById('guitarForm').reset();

            // Restore original button states
            document.querySelector('button[name="add"]').style.display = 'inline-block';
            document.getElementById('editButton').style.display = 'none';
            this.style.display = 'none';
        });
    </script>

    <style>
        .guitar-management {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 0.8rem;
        }
    </style>
</body>

</html>