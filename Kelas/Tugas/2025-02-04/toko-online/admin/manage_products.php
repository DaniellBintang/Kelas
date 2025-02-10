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

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllProducts()
    {
        return mysqli_query($this->conn, "SELECT * FROM products");
    }

    public function addProduct($name, $price, $image)
    {
        $name = mysqli_real_escape_string($this->conn, $name);
        $price = mysqli_real_escape_string($this->conn, $price);
        $target = "images/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);

        $query = "INSERT INTO products (name, image, price) VALUES ('$name', '$image', '$price')";
        return mysqli_query($this->conn, $query);
    }

    public function deleteProduct($id)
    {
        return mysqli_query($this->conn, "DELETE FROM products WHERE id = $id");
    }

    public function updateProduct($id, $name, $price, $image = null)
    {
        $name = mysqli_real_escape_string($this->conn, $name);
        $price = mysqli_real_escape_string($this->conn, $price);

        if ($image) {
            $target = "images/" . basename($image);
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $query = "UPDATE products SET name='$name', price='$price', image='$image' WHERE id=$id";
        } else {
            $query = "UPDATE products SET name='$name', price='$price' WHERE id=$id";
        }
        return mysqli_query($this->conn, $query);
    }
}

$productObj = new Product($conn);

if (isset($_POST['add_product'])) {
    $productObj->addProduct($_POST['name'], $_POST['price'], $_FILES['image']['name']);
    header('Location: manage_products.php');
    exit();
}

if (isset($_POST['update_product'])) {
    $image = $_FILES['image']['name'] ? $_FILES['image']['name'] : null;
    $productObj->updateProduct($_POST['id'], $_POST['name'], $_POST['price'], $image);
    header('Location: manage_products.php');
    exit();
}

if (isset($_GET['delete'])) {
    $productObj->deleteProduct($_GET['delete']);
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
                        <td><img src="../uploads/<?= $row['image'] ?>" width="50"></td>
                        <td><?= $row['price'] ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editProduct(<?= $row['id'] ?>, '<?= $row['name'] ?>', <?= $row['price'] ?>)">Edit</button>
                            <a href="manage_products.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
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