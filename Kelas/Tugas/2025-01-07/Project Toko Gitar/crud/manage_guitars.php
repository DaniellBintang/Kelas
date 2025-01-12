<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    // Redirect to login page if not authenticated
    header("Location:admin-login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Guitars</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="navbar">
        <img
            alt="Logo"
            height="40"
            src="../Fender_guitars_logo.svg.png"
            width="100" />
        <div class="nav-links">
            <a href="manage-orders.php"> Order </a>
            <a href="admin-review.php"> Review </a>
            <a href="logout-admin.php">Logout</a>
        </div>
    </div>

    <?php
    include 'db_connection.php';
    $conn = openConnection();

    // Handle form submissions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add_guitar'])) {
            $guitar_name = $_POST['guitar_name'];
            $guitar_price = $_POST['guitar_price'];

            // Handle file upload
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["guitar_image"]["name"]);
            $upload_ok = 1;
            $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if file is an image
            $check = getimagesize($_FILES["guitar_image"]["tmp_name"]);
            if ($check !== false) {
                $upload_ok = 1;
            } else {
                $_SESSION['message'] = "File is not an image.";
                $upload_ok = 0;
            }

            // Check file size
            if ($_FILES["guitar_image"]["size"] > 500000) {
                $_SESSION['message'] = "Sorry, your file is too large.";
                $upload_ok = 0;
            }

            // Allow certain file formats
            if (!in_array($image_file_type, ["jpg", "jpeg", "png", "gif"])) {
                $_SESSION['message'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $upload_ok = 0;
            }

            // Check if $upload_ok is set to 0 by an error
            if ($upload_ok == 0) {
                $_SESSION['message'] = "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["guitar_image"]["tmp_name"], $target_file)) {
                    $stmt = $conn->prepare("INSERT INTO guitars (guitar_name, guitar_price, guitar_image) VALUES (?, ?, ?)");
                    $stmt->bind_param("sis", $guitar_name, $guitar_price, $target_file);

                    if ($stmt->execute()) {
                        $_SESSION['message'] = "Guitar added successfully!";
                    } else {
                        $_SESSION['message'] = "Error adding guitar: " . $conn->error;
                    }

                    $stmt->close();
                } else {
                    $_SESSION['message'] = "Sorry, there was an error uploading your file.";
                }
            }
        } elseif (isset($_POST['delete_guitar'])) {
            $guitar_id = $_POST['guitar_id'];

            $stmt = $conn->prepare("DELETE FROM guitars WHERE id = ?");
            $stmt->bind_param("i", $guitar_id);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Guitar deleted successfully!";
            } else {
                $_SESSION['message'] = "Error deleting guitar: " . $conn->error;
            }

            $stmt->close();
        }

        // Redirect to avoid form re-submission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Fetch all guitars
    $sql = "SELECT * FROM guitars";
    $result = $conn->query($sql);
    ?>

    <main>
        <h1 style="text-align: center;">Welcome, Admin!</h1>
        <section id="add-guitar">
            <h2>Add New Guitar</h2>
            <?php
            if (isset($_SESSION['message'])) {
                echo "<p>" . htmlspecialchars($_SESSION['message']) . "</p>";
                unset($_SESSION['message']); // Clear the message after displaying
            }
            ?>
            <form method="POST" action="" enctype="multipart/form-data">
                <label for="guitar_name">Guitar Name:</label>
                <input type="text" id="guitar_name" name="guitar_name" required>

                <label for="guitar_price">Guitar Price:</label>
                <input type="number" id="guitar_price" name="guitar_price" required>

                <label for="guitar_image">Guitar Image:</label>
                <input type="file" id="guitar_image" name="guitar_image" accept="image/*" required>

                <button type="submit" name="add_guitar">Add Guitar</button>
            </form>
        </section>

        <section id="guitar-list">
            <h2>Current Guitars</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['guitar_name']) . "</td>";
                            echo "<td>$" . htmlspecialchars($row['guitar_price']) . "</td>";
                            echo "<td><img src='" . htmlspecialchars($row['guitar_image']) . "' alt='" . htmlspecialchars($row['guitar_name']) . "' width='50'></td>";
                            echo "<td>";
                            echo "<form method='POST' action='' style='display:inline;'>";
                            echo "<input type='hidden' name='guitar_id' value='" . $row['id'] . "'>";
                            echo "<button type='submit' name='delete_guitar'>Delete</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No guitars found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>

</html>
<?php
closeConnection($conn);
?>