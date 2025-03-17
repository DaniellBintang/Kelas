<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

class Banner
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllBanners()
    {
        return mysqli_query($this->conn, "SELECT * FROM banners");
    }

    public function addBanner($image, $type)
    {
        $target = "images/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);

        $query = "INSERT INTO banners (image, type) VALUES (?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $image, $type);
        return mysqli_stmt_execute($stmt);
    }

    public function deleteBanner($id)
    {
        $query = "DELETE FROM banners WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }

    public function updateBanner($id, $image = null, $type)
    {
        if ($image) {
            $target = "images/" . basename($image);
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $query = "UPDATE banners SET image=?, type=? WHERE id=?";
            $stmt = mysqli_prepare($this->conn, $query);
            mysqli_stmt_bind_param($stmt, "ssi", $image, $type, $id);
        } else {
            $query = "UPDATE banners SET type=? WHERE id=?";
            $stmt = mysqli_prepare($this->conn, $query);
            mysqli_stmt_bind_param($stmt, "si", $type, $id);
        }
        return mysqli_stmt_execute($stmt);
    }
}



$bannerObj = new Banner($conn);

if (isset($_POST['add_banner'])) {
    $image = $_FILES['image']['name'];
    $target_dir = "../images/";
    $target_file = $target_dir . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $bannerObj->addBanner($image, $_POST['type']);
        header('Location: manage_banners.php');
        exit();
    } else {
        echo "<script>alert('Gagal mengunggah gambar!');</script>";
    }
}

if (isset($_POST['update_banner'])) {
    $image = $_FILES['image']['name'] ? $_FILES['image']['name'] : null;
    if ($image) {
        $target_dir = "../images/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    }
    $bannerObj->updateBanner($_POST['id'], $image, $_POST['type']);
    header('Location: manage_banners.php');
    exit();
}

if (isset($_GET['delete'])) {
    $bannerObj->deleteBanner($_GET['delete']);
    header('Location: manage_banners.php');
    exit();
}

$banners = $bannerObj->getAllBanners();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Banners</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        table img {
            width: 120px;
            height: 80px;
            object-fit: contain;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        #current_banner_image {
            width: 280px;
            height: 220px;
            object-fit: contain;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Manage Banners</h2>

        <form method="POST" enctype="multipart/form-data" class="mb-4">
            <input type="hidden" name="id" id="banner_id">
            <div class="mb-3">
                <label class="form-label">Banner Image</label>
                <input type="file" class="form-control" name="image" id="banner_image">
                <small class="text-muted">Leave empty to keep current image when updating</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Banner Type</label>
                <select name="type" class="form-control" id="banner_type" required>
                    <option value="static">Static</option>
                    <option value="dynamic">Dynamic</option>
                </select>
            </div>
            <button type="submit" name="add_banner" class="btn btn-primary" id="add_button">Add Banner</button>
            <button type="submit" name="update_banner" class="btn btn-warning d-none" id="update_button">Update Banner</button>
        </form>

        <div class="mb-3">
            <label class="form-label">Current Banner Image</label>
            <img src="" id="current_banner_image" width="100" class="d-none">
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($banners)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><img src="../images/<?= $row['image'] ?>" width="100"></td>
                        <td><?= ucfirst($row['type']) ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editBanner(<?= $row['id'] ?>, '<?= $row['image'] ?>', '<?= $row['type'] ?>')">Edit</button>
                            <a href="manage_banners.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        function editBanner(id, image, type) {
            document.getElementById('banner_id').value = id;
            document.getElementById('banner_type').value = type;
            document.getElementById('banner_image').required = false;

            // Show update button, hide add button
            document.getElementById('update_button').classList.remove('d-none');
            document.getElementById('add_button').classList.add('d-none');

            // Show current image
            const currentImage = document.getElementById('current_banner_image');
            currentImage.src = "../images/" + image;
            currentImage.classList.remove('d-none');
        }
    </script>
</body>

</html>