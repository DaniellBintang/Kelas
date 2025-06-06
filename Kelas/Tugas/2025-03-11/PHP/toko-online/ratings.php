<?php
// Database connection
require_once "php/config.php";
require_once "php/auth.php";

function getCartTotalQuantity()
{
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        return 0;
    }
    return array_sum($_SESSION['cart']);
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get product_id from URL parameter, if provided
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

// Function to get average rating for a product
function getAverageRating($conn, $product_id)
{
    $sql = "SELECT AVG(rating) as avg_rating FROM ratings WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    return round($row['avg_rating'], 1);
}

// Function to get star rating HTML
function getStarRating($rating)
{
    $fullStar = '<i class="fas fa-star text-warning"></i>';
    $halfStar = '<i class="fas fa-star-half-alt text-warning"></i>';
    $emptyStar = '<i class="far fa-star text-warning"></i>';

    $output = '';
    $whole = floor($rating);
    $fraction = $rating - $whole;

    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $whole) {
            $output .= $fullStar;
        } elseif ($i == $whole + 1 && $fraction >= 0.5) {
            $output .= $halfStar;
        } else {
            $output .= $emptyStar;
        }
    }

    return $output;
}

// Get all products with their ratings and image information
$sql = "SELECT p.id, p.name, p.image, COUNT(r.id) as review_count, AVG(r.rating) as avg_rating 
        FROM products p 
        LEFT JOIN ratings r ON p.id = r.product_id 
        GROUP BY p.id, p.name, p.image";

if ($product_id > 0) {
    $sql = "SELECT p.id, p.name, p.image, COUNT(r.id) as review_count, AVG(r.rating) as avg_rating 
            FROM products p 
            LEFT JOIN ratings r ON p.id = r.product_id 
            WHERE p.id = $product_id
            GROUP BY p.id, p.name, p.image";
}

$result = $conn->query($sql);

// Get detailed reviews for a specific product
$reviews = [];
if ($product_id > 0) {
    $reviewsSql = "SELECT r.*, c.full_name as customer_name 
                   FROM ratings r 
                   JOIN customers c ON r.user_id = c.id 
                   WHERE r.product_id = ? 
                   ORDER BY r.created_at DESC";
    $stmt = $conn->prepare($reviewsSql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $reviewsResult = $stmt->get_result();

    while ($row = $reviewsResult->fetch_assoc()) {
        $reviews[] = $row;
    }
    $stmt->close();
}

// Get current page filename
$current_page = basename($_SERVER['PHP_SELF']);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Produk - Toko Gitar Online</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .rating-box {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .review-item {
            border-bottom: 1px solid #dee2e6;
            padding: 15px 0;
        }

        .review-item:last-child {
            border-bottom: none;
        }

        .card-body {
            text-align: center;
        }

        .rating-large {
            font-size: 1.5rem;
        }

        .rating-summary {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--fender-red);
        }

        .card {
            border: none;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            height: 100%;
            padding: 20px;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-img-top {
            height: 250px;
            margin-top: 2rem;
            margin-bottom: 2rem;
            object-fit: contain;
        }

        .product-image-large {
            max-height: 300px;
            object-fit: contain;
            margin-bottom: 20px;
        }

        .card-title {
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .btn-primary {
            background-color: var(--fender-red);
            border: none;
            padding: 0.5rem 2rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-red-hover);
            transform: translateY(-2px);
        }

        .btn-outline-secondary {
            color: var(--fender-red);
            border-color: var(--fender-red);
        }

        .btn-outline-secondary:hover {
            background-color: var(--fender-red);
            color: white;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            color: #333;
        }

        /* Star rating color */
        .fa-star,
        .fa-star-half-alt {
            color: var(--fender-red);
        }

        .text-muted {
            color: #6c757d;
        }

        /* Alert styling */
        .alert-info {
            background-color: #f8f9fa;
            border-color: #e9ecef;
            color: #495057;
        }

        .alert-danger {
            background-color: #fff5f5;
            border-color: #ffe3e3;
            color: var(--fender-red);
        }
    </style>
</head>

<body>

    <header class="py-4">
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
                            <a class="nav-link <?php echo ($current_page == 'shop.php') ? 'active' : ''; ?>" href="shop.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'about.php') ? 'active' : ''; ?>" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'ratings.php') ? 'active' : ''; ?>" href="ratings.php">Ratings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link cart-icon <?php echo ($current_page == 'cart.php') ? 'active' : ''; ?>" href="cart.php">
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
                            <a class="nav-link btn btn-login <?php echo ($current_page == 'login.php') ? 'active' : ''; ?>" href="login.php">Login</a>
                            <a class="nav-link btn btn-signup <?php echo ($current_page == 'register.php') ? 'active' : ''; ?>" href="register.php">Sign Up</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container py-5">
        <h1 class="mb-4">Ulasan Produk - Toko Gitar Online</h1>

        <?php if ($product_id === 0): ?>
            <!-- Show list of all products with their average ratings -->
            <div class="row">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100">
                                <?php if (!empty($row['image'])): ?>
                                    <img src="uploads/<?= htmlspecialchars($row['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['name']) ?>">
                                <?php else: ?>
                                    <img src="images/no-image.jpg" class="card-img-top" alt="No image available">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                                    <div class="mb-2">
                                        <?= getStarRating($row['avg_rating'] ?? 0) ?>
                                        <span class="ms-2"><?= number_format($row['avg_rating'] ?? 0, 1) ?>/5</span>
                                    </div>
                                    <p class="card-text"><?= $row['review_count'] ?> ulasan</p>
                                    <a href="?product_id=<?= $row['id'] ?>" class="btn btn-primary">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info">Belum ada produk dengan ulasan.</div>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <!-- Show detailed view for a specific product -->
            <?php
            $product = null;
            if ($result->num_rows > 0) {
                $product = $result->fetch_assoc();
            }

            if ($product): ?>
                <div class="mb-4">
                    <a href="?" class="btn btn-outline-secondary mb-3">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Produk
                    </a>
                    <h2><?= htmlspecialchars($product['name']) ?></h2>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <?php if (!empty($product['image'])): ?>
                            <img src="uploads/<?= htmlspecialchars($product['image']) ?>" class="img-fluid product-image-large" alt="<?= htmlspecialchars($product['name']) ?>">
                        <?php endif; ?>
                        <div class="rating-box text-center">
                            <div class="rating-summary mb-2"><?= number_format($product['avg_rating'] ?? 0, 1) ?></div>
                            <div class="rating-large mb-3">
                                <?= getStarRating($product['avg_rating'] ?? 0) ?>
                            </div>
                            <p class="text-muted"><?= $product['review_count'] ?> ulasan</p>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <h3 class="mb-4">Ulasan Pelanggan</h3>
                        <?php if (count($reviews) > 0): ?>
                            <div class="reviews-container">
                                <?php foreach ($reviews as $review): ?>
                                    <div class="review-item">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h5 class="mb-0"><?= htmlspecialchars($review['customer_name']) ?></h5>
                                            <small class="text-muted">
                                                <?= date('d M Y, H:i', strtotime($review['created_at'])) ?>
                                            </small>
                                        </div>
                                        <div class="mb-2">
                                            <?= getStarRating($review['rating']) ?>
                                        </div>
                                        <p><?= nl2br(htmlspecialchars($review['review'])) ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info">Belum ada ulasan untuk produk ini.</div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-danger">Produk tidak ditemukan.</div>
                <a href="?" class="btn btn-outline-secondary">Kembali ke Daftar Produk</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$conn->close();
?>