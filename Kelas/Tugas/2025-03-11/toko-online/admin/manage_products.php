<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

class Product
{
    private $conn;
    private $upload_dir;

    public function __construct($db)
    {
        $this->conn = $db;
        // Set upload directory path (one level up from admin folder)
        $this->upload_dir = dirname(__DIR__) . '/uploads/';

        // Create uploads directory if it doesn't exist
        if (!file_exists($this->upload_dir)) {
            mkdir($this->upload_dir, 0777, true);
        }
    }

    private function handleFileUpload($file)
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        // Generate unique filename
        $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $new_filename = uniqid() . '_' . time() . '.' . $file_extension;

        // Only allow specific image types
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($file_extension, $allowed_types)) {
            return false;
        }

        // Full path for the new file
        $upload_path = $this->upload_dir . $new_filename;

        // Move uploaded file
        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
            return $new_filename;
        }

        return false;
    }

    public function getAllProducts()
    {
        return mysqli_query($this->conn, "SELECT * FROM products ORDER BY id DESC");
    }

    public function addProduct($name, $price, $image)
    {
        $name = mysqli_real_escape_string($this->conn, $name);
        $price = mysqli_real_escape_string($this->conn, $price);

        // Handle file upload
        $uploaded_filename = $this->handleFileUpload($_FILES['image']);

        if ($uploaded_filename) {
            $query = "INSERT INTO products (name, image, price) VALUES ('$name', '$uploaded_filename', '$price')";
            return mysqli_query($this->conn, $query);
        }
        return false;
    }

    public function updateProduct($id, $name, $price, $image = null)
    {
        $name = mysqli_real_escape_string($this->conn, $name);
        $price = mysqli_real_escape_string($this->conn, $price);

        // Get existing image
        $result = mysqli_query($this->conn, "SELECT image FROM products WHERE id = $id");
        $old_image = mysqli_fetch_assoc($result)['image'];

        if ($image && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Upload new image
            $uploaded_filename = $this->handleFileUpload($_FILES['image']);

            if ($uploaded_filename) {
                // Delete old image if exists
                if ($old_image && file_exists($this->upload_dir . $old_image)) {
                    unlink($this->upload_dir . $old_image);
                }

                $query = "UPDATE products SET name='$name', price='$price', image='$uploaded_filename' WHERE id=$id";
            } else {
                return false;
            }
        } else {
            $query = "UPDATE products SET name='$name', price='$price' WHERE id=$id";
        }

        return mysqli_query($this->conn, $query);
    }

    public function deleteProduct($id)
    {
        // Get image filename before deleting record
        $result = mysqli_query($this->conn, "SELECT image FROM products WHERE id = $id");
        $image = mysqli_fetch_assoc($result)['image'];

        // Delete image file if exists
        if ($image && file_exists($this->upload_dir . $image)) {
            unlink($this->upload_dir . $image);
        }

        return mysqli_query($this->conn, "DELETE FROM products WHERE id = $id");
    }
}

$productObj = new Product($conn);

// Handle form submissions
if (isset($_POST['add_product'])) {
    if ($productObj->addProduct($_POST['name'], $_POST['price'], $_FILES['image']['name'])) {
        $_SESSION['success'] = "Product added successfully!";
    } else {
        $_SESSION['error'] = "Error adding product. Please try again.";
    }
    header('Location: manage_products.php');
    exit();
}

if (isset($_POST['update_product'])) {
    $image = isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK ? $_FILES['image']['name'] : null;
    if ($productObj->updateProduct($_POST['id'], $_POST['name'], $_POST['price'], $image)) {
        $_SESSION['success'] = "Product updated successfully!";
    } else {
        $_SESSION['error'] = "Error updating product. Please try again.";
    }
    header('Location: manage_products.php');
    exit();
}

if (isset($_GET['delete'])) {
    if ($productObj->deleteProduct($_GET['delete'])) {
        $_SESSION['success'] = "Product deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting product. Please try again.";
    }
    header('Location: manage_products.php');
    exit();
}

$products = $productObj->getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .product-image-container {
            width: 100px;
            height: 100px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
        }

        .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Manage Products</h2>

        <form method="POST" enctype="multipart/form-data" class="mb-4">
            <input type="hidden" name="id" id="product_id">
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" class="form-control" name="name" id="product_name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" class="form-control" name="price" id="product_price" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" class="form-control" name="image" id="product_image">
            </div>
            <button type="submit" name="add_product" class="btn btn-primary">Add Product</button>
            <button type="submit" name="update_product" class="btn btn-warning d-none" id="update_button">Update Product</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($products)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td>
                            <div class="product-image-container">
                                <img src="../uploads/<?= $row['image'] ?>"
                                    class="product-image"
                                    alt="<?= htmlspecialchars($row['name']) ?>">
                            </div>
                        </td>
                        <td><?= $row['price'] ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm"
                                onclick="editProduct(<?= $row['id'] ?>, '<?= $row['name'] ?>', <?= $row['price'] ?>)">
                                Edit
                            </button>
                            <a href="manage_products.php?delete=<?= $row['id'] ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        function editProduct(id, name, price) {
            document.getElementById('product_id').value = id;
            document.getElementById('product_name').value = name;
            document.getElementById('product_price').value = price;
            document.getElementById('update_button').classList.remove('d-none');
        }
    </script>
</body>

</html>