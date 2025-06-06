<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

class ContactManager
{
    private $conn;
    private $table = 'contact_messages';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllMessages()
    {
        try {
            $query = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
            $result = $this->conn->query($query);

            if (!$result) {
                throw new Exception("Error fetching messages: " . $this->conn->error);
            }

            return $result;
        } catch (Exception $e) {
            throw new Exception("Failed to get messages: " . $e->getMessage());
        }
    }

    public function deleteMessage($id)
    {
        try {
            // Validate id
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if (!$id) {
                throw new Exception("Invalid message ID");
            }

            // Prepare statement
            $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
            if (!$stmt) {
                throw new Exception("Prepare statement failed: " . $this->conn->error);
            }

            // Bind parameter and execute
            $stmt->bind_param("i", $id);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed: " . $stmt->error);
            }

            // Check if any row was actually deleted
            if ($stmt->affected_rows === 0) {
                throw new Exception("No message found with ID: $id");
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            throw new Exception("Delete failed: " . $e->getMessage());
        }
    }
}

// Create instance of ContactManager
$contactManager = new ContactManager($conn);

// Handle Delete Request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    try {
        if ($contactManager->deleteMessage($_POST['delete_id'])) {
            $_SESSION['success'] = "Message successfully deleted.";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
    }
    // Redirect to prevent form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Get all messages
try {
    $messages = $contactManager->getAllMessages();
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    $messages = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Contact Messages</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .table-responsive {
            margin-top: 20px;
        }

        .alert {
            margin-top: 20px;
        }

        .delete-form {
            display: inline;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Manage Contact Messages</h2>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['success']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <div class="table-responsive">
            <?php if ($messages && $messages->num_rows > 0): ?>
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $messages->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']) ?></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td><?= htmlspecialchars($row['message']) ?></td>
                                <td><?= htmlspecialchars($row['created_at']) ?></td>
                                <td>
                                    <form method="POST" class="delete-form" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                        <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info">No messages found.</div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>