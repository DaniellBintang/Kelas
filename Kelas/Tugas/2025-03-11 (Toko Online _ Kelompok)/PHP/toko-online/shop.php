<?php
session_start();
require 'php/config.php';
require_once "php/auth.php";

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

function getCartTotalQuantity()
{
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        return 0;
    }
    return array_sum($_SESSION['cart']);
}

// Menambahkan produk ke cart
$added_to_cart = false;
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = 1;

    if (!isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] = $quantity;
    } else {
        $_SESSION['cart'][$product_id] += $quantity;
    }

    $added_to_cart = true;
}

// Add sorting functionality
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'name_asc';
$where = "1=1";

switch ($sort) {
    case 'price_asc':
        $order_by = "price ASC";
        break;
    case 'price_desc':
        $order_by = "price DESC";
        break;
    case 'name_desc':
        $order_by = "name DESC";
        break;
    default:
        $order_by = "name ASC";
}

$sql = "SELECT * FROM products WHERE $where ORDER BY $order_by";
$result = $conn->query($sql);

// Get current page filename
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Guitar Store</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .shop-container {
            padding: 2rem 0;
            margin-top: 5rem;
            background-color: #f8f9fa;
        }

        .shop-header {
            background-color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .filter-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .sort-select {
            padding: 0.5rem;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            padding: 1rem;
        }

        .product-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image-container {
            position: relative;
            padding-top: 100%;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        .product-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 1rem;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .product-details {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #333;
            height: 2.8em;
            /* Fixed height for title, approximately 2 lines */
            overflow: hidden;
        }

        .product-price {
            font-size: 1.2rem;
            color: var(--fender-red);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .add-to-cart-btn {
            width: 100%;
            padding: 0.8rem;
            background-color: var(--fender-red);
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: auto;
            /* Push button to bottom */
        }

        .add-to-cart-btn:hover {
            background-color: #c41820;
            transform: translateY(-2px);
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .cart-badge {
            position: absolute;
            top: -12px;
            right: -8px;
        }

        .cart-icon {
            bottom: -1px;
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
    <!-- Include your navbar here -->

    <div class="shop-header mt-4">
        <div class="container">
            <h1 class="text-center mt-4 mb-4">Our Guitar Collection</h1>
            <div class="filter-section">
                <div class="sort-dropdown">
                    <select class="sort-select" id="sortSelect">
                        <option value="name_asc" <?= $sort == 'name_asc' ? 'selected' : '' ?>>Name (A-Z)</option>
                        <option value="name_desc" <?= $sort == 'name_desc' ? 'selected' : '' ?>>Name (Z-A)</option>
                        <option value="price_asc" <?= $sort == 'price_asc' ? 'selected' : '' ?>>Price (Low to High)</option>
                        <option value="price_desc" <?= $sort == 'price_desc' ? 'selected' : '' ?>>Price (High to Low)</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="shop-container">
        <div class="container">
            <?php if ($result->num_rows > 0): ?>
                <div class="product-grid">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="product-card">
                            <div class="product-image-container">
                                <img src="uploads/<?= $row['image']; ?>"
                                    alt="<?= $row['name']; ?>"
                                    class="product-image">
                            </div>
                            <div class="product-details">
                                <h3 class="product-name"><?= $row['name']; ?></h3>
                                <p class="product-price">Rp <?= number_format($row['price'], 0, ',', '.'); ?></p>
                                <form action="" method="post" class="add-to-cart-form">
                                    <input type="hidden" name="product_id" value="<?= $row['id']; ?>">
                                    <button type="submit" name="add_to_cart" class="add-to-cart-btn">
                                        <i class="fas fa-shopping-cart"></i>
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-guitar fa-3x mb-3"></i>
                    <h3>No Products Found</h3>
                    <p>We're currently restocking our inventory. Please check back later.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal Pemberitahuan -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Produk Ditambahkan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
                        <p>Produk berhasil ditambahkan ke keranjang!</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="cart.php" class="btn btn-primary">Lihat Keranjang</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Lanjut Belanja</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Navbar scroll effect
            const navbar = document.querySelector('.navbar');
            const navLinks = document.querySelectorAll('.nav-link');

            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.style.padding = '0.5rem 0';
                    navbar.style.backgroundColor = 'rgba(33, 37, 41, 0.98)';
                    navbar.classList.add('scrolled');
                } else {
                    navbar.style.padding = '1rem 0';
                    navbar.style.backgroundColor = 'rgba(33, 37, 41, 0.98)';
                    navbar.classList.remove('scrolled');
                }
            });

            // Smooth highlight effect for navbar items
            navLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    if (!this.classList.contains('active')) {
                        this.style.color = 'var(--fender-red)';
                    }
                });

                link.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('active')) {
                        this.style.color = '';
                    }
                });
            });

            // Sort select with animation
            const sortSelect = document.getElementById('sortSelect');
            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    window.location.href = '?sort=' + this.value;
                });
            }

            // Add to cart animation
            const addToCartForms = document.querySelectorAll('.add-to-cart-form');
            addToCartForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const button = this.querySelector('.add-to-cart-btn');
                    button.innerHTML = '<i class="fas fa-check"></i> Added!';
                    button.style.backgroundColor = '#28a745';

                    // We're not preventing default because we want the form to submit
                    // This is just for visual feedback before the page reloads
                });
            });

            // Show modal with animation if product was added to cart
            <?php if ($added_to_cart): ?>
                const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
                cartModal.show();

                // Update cart badge with animation
                const cartBadge = document.querySelector('.cart-badge');
                if (cartBadge) {
                    cartBadge.classList.add('cart-animation');
                }
            <?php endif; ?>
        });
    </script>
</body>

</html>

<?php $conn->close(); ?>