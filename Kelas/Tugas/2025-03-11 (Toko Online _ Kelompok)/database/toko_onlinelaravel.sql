-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jun 2025 pada 17.29
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_onlinelaravel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@guitarshop.com', '$2y$12$ktxMB1PBeKQxnq0.OeTy9.Fr3Kg2S5MYEq62Kuy4uG.9VfkqGUgUe', 'dE8SfEBYubrSS8vEk0ziWjqAvcoO56tdbCsCv9ii8YamK46ODkFMN4ItjRHK', '2025-06-06 03:57:46', '2025-06-06 03:57:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) NOT NULL,
  `type` enum('static','dynamic') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `banners`
--

INSERT INTO `banners` (`id`, `image`, `type`, `created_at`, `updated_at`) VALUES
(7, '1749183195.jpg', 'static', '2025-06-05 21:13:15', '2025-06-05 21:13:15'),
(8, '1749183249.jpg', 'static', '2025-06-05 21:14:09', '2025-06-05 21:14:09'),
(9, '1749183256.png', 'dynamic', '2025-06-05 21:14:16', '2025-06-05 21:14:16'),
(10, '1749183264.jpg', 'dynamic', '2025-06-05 21:14:24', '2025-06-05 21:14:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(191) NOT NULL,
  `owner` varchar(191) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(191) NOT NULL,
  `city` varchar(191) NOT NULL,
  `postal_code` varchar(191) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customer_addresses`
--

INSERT INTO `customer_addresses` (`id`, `user_id`, `address`, `city`, `postal_code`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 23, 'Apartemen Sudirman Park Tower A-12-05, Jl. KH Mas Mansyur', 'Jakarta Pusat', '10220', 0, '2025-02-17 07:49:20', NULL),
(2, 23, 'Jl. Gatot Subroto No. 123, Kuningan', 'Jakarta Selatan', '12930', 0, '2025-02-17 07:49:20', NULL),
(3, 24, 'Green Garden Residence Blok A2 No. 15', 'Jakarta Barat', '11520', 0, '2025-02-17 07:49:20', NULL),
(4, 25, 'Apartemen Casablanca East Residence Unit 1807', 'Jakarta Timur', '13960', 0, '2025-02-17 07:49:20', NULL),
(5, 25, 'Jl. Bendungan Hilir Raya No. 45', 'Jakarta Pusat', '10210', 0, '2025-02-17 07:49:20', NULL),
(6, 26, 'Kompleks BSD City, Cluster Green Park B-8', 'Tangerang Selatan', '15310', 0, '2025-02-17 07:49:20', NULL),
(7, 27, 'Jl. Kemang Raya No. 58, Bangka', 'Jakarta Selatan', '12730', 0, '2025-02-17 07:49:20', NULL),
(8, 41, 'Apartemen Taman Anggrek Tower 1 Unit 15A', 'Jakarta Barat', '11470', 0, '2025-02-17 07:49:20', NULL),
(9, 41, 'Jl. Pluit Sakti Raya No. 28, Penjaringan', 'Jakarta Utara', '14450', 0, '2025-02-17 07:49:20', NULL),
(10, 42, 'Gading Serpong Cluster Florence No. 17', 'Tangerang', '15810', 0, '2025-02-17 07:49:20', NULL),
(11, 41, 'adadeh', 'Sidoarjo', '181819', 0, '2025-05-21 19:52:39', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_06_06_030844_create_order_items_table', 1),
(4, '2025_06_06_030844_create_orders_table', 1),
(5, '2025_06_06_030844_create_products_table', 1),
(6, '2025_06_06_030844_create_users_table', 1),
(7, '2025_06_06_030845_create_banners_table', 1),
(8, '2025_06_06_030845_create_contact_messages_table', 1),
(9, '2025_06_06_030845_create_ratings_table', 1),
(10, '2025_06_06_030846_create_admins_table', 1),
(11, '2025_06_06_030846_create_customer_addresses_table', 1),
(12, '2025_06_06_033246_create_sessions_table', 2),
(13, '2025_06_06_104440_create_admins_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('Pending','Processing','Completed','Cancelled') NOT NULL DEFAULT 'Pending',
  `shipping_address` varchar(191) NOT NULL,
  `shipping_city` varchar(191) NOT NULL,
  `shipping_postal_code` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `status`, `shipping_address`, `shipping_city`, `shipping_postal_code`, `created_at`) VALUES
(3, 23, 1200000.00, 'Completed', 'Jl. Kenanga No. 45, Kecamatan Menteng', 'Jakarta Pusat', '10310', '2025-02-03 18:16:48'),
(4, 24, 650000.00, 'Cancelled', 'Jl. Mawar No. 12, Kecamatan Kebayoran Baru', 'Jakarta Selatan', '12160', '2025-02-03 18:16:48'),
(5, 25, 2300000.00, 'Pending', 'Jl. Melati No. 78, Kecamatan Kemang', 'Jakarta Selatan', '12730', '2025-02-03 18:16:48'),
(6, 26, 450000.00, 'Completed', 'Jl. Anggrek No. 23, Kecamatan Senayan', 'Jakarta Selatan', '12190', '2025-02-03 18:16:48'),
(7, 27, 1800000.00, 'Pending', 'Jl. Dahlia No. 56, Kecamatan Kuningan', 'Jakarta Selatan', '12940', '2025-02-03 18:16:48'),
(8, 28, 3400000.00, 'Completed', 'Jl. Teratai No. 89, Kecamatan Setiabudi', 'Jakarta Selatan', '12910', '2025-02-03 18:16:48'),
(9, 29, 210000.00, 'Pending', 'Jl. Flamboyan No. 34, Kecamatan Permata Hijau', 'Jakarta Selatan', '12210', '2025-02-03 18:16:48'),
(10, 30, 890000.00, 'Completed', 'Jl. Bougenville No. 67, Kecamatan Pondok Indah', 'Jakarta Selatan', '12310', '2025-02-03 18:16:48'),
(11, 31, 1250000.00, 'Cancelled', 'Jl. Kamboja No. 90, Kecamatan Cipete', 'Jakarta Selatan', '12410', '2025-02-03 18:16:48'),
(12, 32, 980000.00, 'Completed', 'Jl. Tulip No. 43, Kecamatan Cilandak', 'Jakarta Selatan', '12430', '2025-02-03 18:16:48'),
(13, 33, 150000.00, 'Pending', 'Jl. Sakura No. 21, Kecamatan Lebak Bulus', 'Jakarta Selatan', '12440', '2025-02-03 18:16:48'),
(14, 34, 2500000.00, 'Completed', 'Jl. Lily No. 54, Kecamatan Fatmawati', 'Jakarta Selatan', '12450', '2025-02-03 18:16:48'),
(15, 35, 320000.00, 'Pending', 'Jl. Iris No. 87, Kecamatan Blok M', 'Jakarta Selatan', '12120', '2025-02-03 18:16:48'),
(16, 36, 700000.00, 'Completed', 'Jl. Violet No. 32, Kecamatan Senopati', 'Jakarta Selatan', '12190', '2025-02-03 18:16:48'),
(17, 37, 990000.00, 'Completed', 'Jl. Daisy No. 65, Kecamatan Gunawarman', 'Jakarta Selatan', '12180', '2025-02-03 18:16:48'),
(18, 38, 450000.00, 'Pending', 'Jl. Jasmine No. 98, Kecamatan Wijaya', 'Jakarta Selatan', '12170', '2025-02-03 18:16:48'),
(19, 39, 1350000.00, 'Completed', 'Jl. Lotus No. 41, Kecamatan Panglima Polim', 'Jakarta Selatan', '12160', '2025-02-03 18:16:48'),
(20, 40, 760000.00, 'Pending', 'Jl. Aster No. 74, Kecamatan Mahakam', 'Jakarta Selatan', '12150', '2025-02-03 18:16:48'),
(21, 42, 1800000.00, 'Pending', 'Jl. Pelangi No. 28, Kecamatan Senayan', 'Jakarta Selatan', '12190', '2025-02-10 11:02:22'),
(22, 42, 7500000.00, 'Pending', 'Jl. Pelangi No. 28, Kecamatan Senayan', 'Jakarta Selatan', '12190', '2025-02-10 11:04:06'),
(25, 41, 9500000.00, 'Completed', 'Jl. Matahari No. 15, Kecamatan Dharmawangsa', 'Jakarta Selatan', '12140', '2025-02-10 17:46:39'),
(27, 41, 9500000.00, 'Pending', 'Jl. Matahari No. 15, Kecamatan Dharmawangsa', 'Jakarta Selatan', '12140', '2025-02-10 18:53:03'),
(28, 41, 2200000.00, 'Pending', 'Jl. Matahari No. 15, Kecamatan Dharmawangsa', 'Jakarta Selatan', '12140', '2025-02-10 18:53:27'),
(29, 41, 19000000.00, 'Completed', 'Jl. Matahari No. 15, Kecamatan Dharmawangsa', 'Jakarta Selatan', '12140', '2025-02-17 07:50:37'),
(30, 41, 11300000.00, 'Completed', 'Jl. Matahari No. 15, Kecamatan Dharmawangsa', 'Jakarta Selatan', '12140', '2025-02-17 08:10:44'),
(31, 41, 28500000.00, 'Completed', 'Jalan Tebel', 'Sidoarjo', '12873', '2025-02-17 17:14:38'),
(32, 41, 11200000.00, 'Completed', 'Desa Gemurung ', 'Sidoarjo', '67246', '2025-02-17 18:02:30'),
(33, 41, 1600000.00, 'Completed', 'Apartemen Taman Anggrek Tower 1 Unit 15A', 'Jakarta Barat', '11470', '2025-02-17 18:04:01'),
(34, 41, 9500000.00, 'Completed', 'Jl. Matahari No. 15, Kecamatan Dharmawangsa', 'Jakarta Selatan', '12140', '2025-02-17 18:04:34'),
(37, 41, 16200000.00, 'Processing', 'adadeh', 'Sidoarjo', '181819', '2025-05-21 19:52:39'),
(39, 41, 35000000.00, 'Pending', 'Jl. Matahari No. 15, Kecamatan Dharmawangsa', 'Jakarta Selatan', '12140', '2025-06-06 08:23:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(3, 3, 12, 1, 1200000.00, NULL, NULL),
(4, 4, 1, 2, 325000.00, NULL, NULL),
(5, 5, 9, 1, 2300000.00, NULL, NULL),
(6, 6, 15, 3, 150000.00, NULL, NULL),
(7, 7, 2, 1, 1800000.00, NULL, NULL),
(8, 8, 8, 2, 1700000.00, NULL, NULL),
(9, 9, 10, 1, 210000.00, NULL, NULL),
(10, 10, 4, 1, 890000.00, NULL, NULL),
(11, 11, 6, 2, 625000.00, NULL, NULL),
(12, 12, 14, 1, 980000.00, NULL, NULL),
(13, 13, 20, 3, 50000.00, NULL, NULL),
(14, 14, 17, 2, 1250000.00, NULL, NULL),
(15, 15, 5, 1, 320000.00, NULL, NULL),
(16, 16, 11, 1, 700000.00, NULL, NULL),
(17, 17, 19, 2, 495000.00, NULL, NULL),
(18, 18, 16, 1, 450000.00, NULL, NULL),
(19, 19, 13, 2, 675000.00, NULL, NULL),
(20, 20, 18, 1, 760000.00, NULL, NULL),
(21, 21, 3, 1, 1800000.00, NULL, NULL),
(22, 22, 2, 1, 7500000.00, NULL, NULL),
(25, 25, 2, 1, 9500000.00, NULL, NULL),
(29, 27, 2, 1, 9500000.00, NULL, NULL),
(30, 28, 17, 1, 2200000.00, NULL, NULL),
(31, 29, 2, 2, 9500000.00, NULL, NULL),
(32, 30, 2, 1, 9500000.00, NULL, NULL),
(33, 30, 3, 1, 1800000.00, NULL, NULL),
(34, 31, 2, 3, 9500000.00, NULL, NULL),
(35, 32, 2, 1, 9500000.00, NULL, NULL),
(36, 32, 1, 1, 1700000.00, NULL, NULL),
(37, 33, 11, 1, 1600000.00, NULL, NULL),
(38, 34, 2, 1, 9500000.00, NULL, NULL),
(41, 37, 3, 9, 1800000.00, NULL, NULL),
(42, 39, 9, 1, 35000000.00, '2025-06-06 08:23:35', '2025-06-06 08:23:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(191) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'Gitar Akustik Yamaha F310', 'Gitar akustik Yamaha F310 dengan kualitas suara yang jernih dan nyaman dimainkan. Cocok untuk pemula hingga menengah.', 1700000.00, 'gitar1.png', 8, '2025-06-05 21:43:37', '2025-06-05 21:43:37'),
(2, 'Gitar Elektrik Fender Stratocaster', 'Gitar elektrik legendaris dengan tone yang khas, sangat cocok untuk berbagai genre musik dari blues hingga rock.', 9500000.00, 'gitar2.png', 10, '2025-06-05 21:43:37', '2025-06-05 21:43:37'),
(3, 'Gitar Akustik Cort AD810', 'Gitar akustik Cort AD810 dengan body spruce solid dan nyaman dipegang, ideal untuk pemula.', 1800000.00, 'gitar3.png', 18, '2025-06-05 21:43:37', '2025-06-05 21:43:37'),
(4, 'Gitar Klasik Yamaha C40', 'Gitar klasik dengan senar nilon yang nyaman dan cocok untuk pemula yang ingin belajar fingerpicking.', 1200000.00, 'gitar4.png', 18, '2025-06-05 21:43:37', '2025-06-05 21:43:37'),
(5, 'Gitar Elektrik Gibson Les Paul', 'Gibson Les Paul dengan pickup humbucker yang menghasilkan suara tebal dan sustain panjang, ikon dalam dunia gitar.', 15000000.00, 'gitar5.png', 14, '2025-06-05 21:43:37', '2025-06-05 21:43:37'),
(6, 'Gitar Akustik Taylor 114ce', 'Gitar akustik premium dengan pickup built-in dan finish yang apik, suara crisp yang presisi.', 10000000.00, 'gitar6.png', 14, '2025-06-05 21:43:37', '2025-06-05 21:43:37'),
(7, 'Gitar Bass Ibanez GSR200', 'Bass 4 senar dengan neck yang nyaman dan tone yang versatile untuk berbagai genre musik.', 3500000.00, 'gitar7.png', 7, '2025-06-05 21:43:37', '2025-06-05 21:43:37'),
(8, 'Gitar Elektrik PRS SE Custom 24', 'Gitar elektrik dengan 24 fret dan pickup yang versatile, cocok untuk lead maupun rhythm.', 9500000.00, 'gitar8.png', 18, '2025-06-05 21:43:37', '2025-06-05 21:43:37'),
(9, 'Gitar Akustik Martin D-28', 'Gitar akustik high-end dengan konstruksi premium dan suara yang luar biasa jernih dan kaya.', 35000000.00, 'gitar9.png', 12, '2025-06-05 21:43:37', '2025-06-05 21:43:37'),
(10, 'Gitar Klasik Cordoba C5', 'Gitar klasik dengan solid cedar top dan mahogany back & sides, suara yang hangat dan resonant.', 2500000.00, 'gitar10.png', 19, '2025-06-05 21:43:37', '2025-06-05 21:43:37'),
(11, 'Gitar Akustik Epiphone DR-100', 'Gitar akustik entry-level dengan kualitas build yang baik dan suara yang konsisten.', 1600000.00, 'gitar11.png', 5, '2025-06-05 21:43:37', '2025-06-05 21:43:37'),
(12, 'Gitar Elektrik ESP LTD EC-256', 'Gitar dengan design les paul modern dan pickup aktif yang powerful untuk musik beraliran keras.', 7000000.00, 'gitar12.png', 15, '2025-06-05 21:43:37', '2025-06-05 21:43:37'),
(13, 'Gitar Bass Fender Precision', 'Bass klasik dengan tone yang legendaris, standard industri untuk musik rock dan jazz.', 12000000.00, 'gitar13.png', 9, '2025-06-05 21:43:37', '2025-06-05 21:43:37'),
(14, 'Gitar Akustik Seagull S6', 'Gitar akustik made in Canada dengan solid cedar top dan cherry sides, kualitas premium.', 5000000.00, 'gitar14.png', 16, '2025-06-05 21:43:37', '2025-06-05 21:43:37'),
(15, 'Gitar Klasik Alhambra 3C', 'Gitar klasik Spanyol dengan tradisi craftsmanship yang tinggi, cocok untuk konser klasikal.', 4500000.00, 'gitar15.png', 8, '2025-06-05 21:43:37', '2025-06-05 21:43:37'),
(16, 'Gitar Elektrik Ibanez RG450DX', 'Gitar elektrik dengan neck yang tipis dan cepat, ideal untuk teknik shredding dan soloing.', 6800000.00, 'gitar16.png', 9, '2025-06-05 21:43:37', '2025-06-05 21:43:37'),
(17, 'Gitar Akustik Fender CD-60', 'Gitar akustik Fender dengan solid spruce top dan mahogany back & sides, suara yang balance.', 2200000.00, 'gitar17.png', 13, '2025-06-05 21:43:37', '2025-06-05 21:43:37'),
(18, 'Gitar Elektrik Schecter Omen-6', 'Gitar elektrik dengan konstruksi mahogany dan maple, cocok untuk aliran metal dan rock keras.', 5500000.00, 'gitar18.png', 5, '2025-06-05 21:43:37', '2025-06-05 21:43:37'),
(19, 'Gitar Bass Yamaha TRBX174', 'Bass 4 string dengan body ergonomis dan harga terjangkau, cocok untuk pemula.', 2700000.00, 'gitar19.png', 7, '2025-06-05 21:43:37', '2025-06-05 21:43:37'),
(20, 'Gitar Akustik Takamine GD302', 'Gitar akustik solid spruce dengan elektronik built-in, tone yang kaya dan projesi suara yang bagus.', 8300000.00, '67cf8d093abf7_1741655305.png', 11, '2025-06-05 21:43:37', '2025-06-05 21:43:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `product_id`, `order_id`, `rating`, `review`, `created_at`, `updated_at`) VALUES
(1, 23, 12, 3, 4, 'Gitar bagus sekali, suaranya jernih. Pengiriman cepat dan aman.', '2025-02-05 20:15:23', NULL),
(2, 26, 15, 6, 5, 'Kualitas terbaik! Sangat cocok untuk pemula seperti saya.', '2025-02-07 00:22:45', NULL),
(3, 28, 8, 8, 3, 'Cukup bagus, tapi ada sedikit goresan di bagian belakang. Suara bagus.', '2025-02-08 19:35:12', NULL),
(4, 41, 11, 33, 5, 'Mantap', '2025-02-24 09:38:11', NULL),
(5, 41, 2, 25, 5, 'Sangat Amat Oke', '2025-02-24 09:38:23', NULL),
(6, 34, 17, 14, 5, 'Fender CD-60 adalah gitar akustik terbaik di kelasnya. Sangat recommended!', '2025-02-14 23:27:36', NULL),
(7, 36, 11, 16, 4, 'Epiphone DR-100 punya suara yang bagus untuk harganya. Saya puas.', '2025-02-16 18:55:41', NULL),
(8, 39, 13, 19, 5, 'Fender Precision bass ini luar biasa! Sudah lama saya inginkan.', '2025-02-19 22:44:53', NULL),
(9, 41, 2, 25, 5, 'Stratocaster yang sempurna, tidak ada cacat. Bunyi khas Fender yang dicari.', '2025-02-21 20:33:18', NULL),
(10, 41, 11, 33, 4, 'Gitar akustik yang nyaman dimainkan, harga bersahabat kualitas bagus.', '2025-02-22 19:15:44', NULL),
(11, 28, 8, 8, 5, 'Update review: setelah saya gunakan beberapa hari, ternyata sangat bagus!', '2025-02-15 02:42:19', NULL),
(12, 30, 4, 10, 4, 'Gitar klasik yang worth it untuk dibeli, meskipun ada sedikit cacat di pengiriman.', '2025-02-15 19:33:51', NULL),
(13, 32, 14, 12, 5, 'Tone-nya sangat clear dan bright. Cocok untuk fingerstyle.', '2025-02-18 00:27:06', NULL),
(14, 42, 3, 21, 4, 'Cort AD810 suaranya mantap dan nyaman dipegang.', '2025-02-23 18:15:47', NULL),
(15, 39, 13, 19, 4, 'Update: Setelah pakai sebulan, masih puas dengan bass ini.', '2025-02-28 20:22:36', NULL),
(16, 37, 19, 17, 4, 'Update review: Setelah beradaptasi, bass ini sangat nyaman dimainkan.', '2025-03-02 02:43:19', NULL),
(17, 23, 12, 3, 5, 'Update: Semakin lama dipakai, ESP LTD EC-256 ini semakin enak dimainkan!', '2025-03-02 23:54:28', NULL),
(18, 26, 15, 6, 5, 'Gitar klasik terbaik yang pernah saya miliki, sangat worth it!', '2025-03-04 19:17:42', NULL),
(19, 24, 1, 4, 2, 'Kurang puas, ada beberapa masalah di fret board dan senar cepat kendor.', '2025-02-07 21:25:33', NULL),
(20, 41, 3, 37, 2, 'gitarnya rusak, tidak sesuai pesanan\\', '2025-05-21 19:54:30', NULL),
(21, 41, 2, 38, 3, 'Keren bang', '2025-06-05 19:05:03', NULL),
(22, 41, 2, 34, 5, 'Gitar nya sampai dengan selamat', '2025-06-05 19:05:22', NULL),
(23, 41, 2, 29, 5, 'Mantap man', '2025-06-06 08:09:37', '2025-06-06 08:09:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('xXOjlzwSWY7v0zZ7obDyRDDLtRReAv7UpYqsmKo4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZkhsSVhWWFJsMzFvNkRERzc3VDRyOGF5cnNwc3h6MjNLSzM0bFR6RSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1749223722);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `address` varchar(191) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `postal_code` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `address`, `city`, `postal_code`, `phone`, `created_at`) VALUES
(23, 'Citra Lestari', 'citra.lestari@example.com', 'password123', 'Jl. Kenanga No. 45, Kecamatan Menteng', 'Jakarta Pusat', '10310', '081234567890', '2025-02-03 18:05:31'),
(24, 'Dewi Kumalasari', 'dewi.kumalasari@example.com', 'password123', 'Jl. Mawar No. 12, Kecamatan Kebayoran Baru', 'Jakarta Selatan', '12160', '081234567891', '2025-02-03 18:05:31'),
(25, 'Eka Wijaya', 'eka.wijaya@example.com', 'password123', 'Jl. Melati No. 78, Kecamatan Kemang', 'Jakarta Selatan', '12730', '081234567892', '2025-02-03 18:05:31'),
(26, 'Fajar Pratama', 'fajar.pratama@example.com', 'password123', 'Jl. Anggrek No. 23, Kecamatan Senayan', 'Jakarta Selatan', '12190', '081234567893', '2025-02-03 18:05:31'),
(27, 'Gita Pertiwi', 'gita.pertiwi@example.com', 'password123', 'Jl. Dahlia No. 56, Kecamatan Kuningan', 'Jakarta Selatan', '12940', '081234567894', '2025-02-03 18:05:31'),
(28, 'Hadi Saputro', 'hadi.saputro@example.com', 'password123', 'Jl. Teratai No. 89, Kecamatan Setiabudi', 'Jakarta Selatan', '12910', '081234567895', '2025-02-03 18:05:31'),
(29, 'Indah Sari', 'indah.sari@example.com', 'password123', 'Jl. Flamboyan No. 34, Kecamatan Permata Hijau', 'Jakarta Selatan', '12210', '081234567896', '2025-02-03 18:05:31'),
(30, 'Joko Widodo', 'joko.widodo@example.com', 'password123', 'Jl. Bougenville No. 67, Kecamatan Pondok Indah', 'Jakarta Selatan', '12310', '081234567897', '2025-02-03 18:05:31'),
(31, 'Kartika Dewi', 'kartika.dewi@example.com', 'password123', 'Jl. Kamboja No. 90, Kecamatan Cipete', 'Jakarta Selatan', '12410', '081234567898', '2025-02-03 18:05:31'),
(32, 'Lukman Hakim', 'lukman.hakim@example.com', 'password123', 'Jl. Tulip No. 43, Kecamatan Cilandak', 'Jakarta Selatan', '12430', '081234567899', '2025-02-03 18:05:31'),
(33, 'Maya Anggraini', 'maya.anggraini@example.com', 'password123', 'Jl. Sakura No. 21, Kecamatan Lebak Bulus', 'Jakarta Selatan', '12440', '081234567800', '2025-02-03 18:05:31'),
(34, 'Nugroho Adi', 'nugroho.adi@example.com', 'password123', 'Jl. Lily No. 54, Kecamatan Fatmawati', 'Jakarta Selatan', '12450', '081234567801', '2025-02-03 18:05:31'),
(35, 'Olivia Salsabila', 'olivia.salsabila@example.com', 'password123', 'Jl. Iris No. 87, Kecamatan Blok M', 'Jakarta Selatan', '12120', '081234567802', '2025-02-03 18:05:31'),
(36, 'Pandu Setiawan', 'pandu.setiawan@example.com', 'password123', 'Jl. Violet No. 32, Kecamatan Senopati', 'Jakarta Selatan', '12190', '081234567803', '2025-02-03 18:05:31'),
(37, 'Qory Anindita', 'qory.anindita@example.com', 'password123', 'Jl. Daisy No. 65, Kecamatan Gunawarman', 'Jakarta Selatan', '12180', '081234567804', '2025-02-03 18:05:31'),
(38, 'Rizky Ramadhan', 'rizky.ramadhan@example.com', 'password123', 'Jl. Jasmine No. 98, Kecamatan Wijaya', 'Jakarta Selatan', '12170', '081234567805', '2025-02-03 18:05:31'),
(39, 'Siti Aminah', 'siti.aminah@example.com', 'password123', 'Jl. Lotus No. 41, Kecamatan Panglima Polim', 'Jakarta Selatan', '12160', '081234567806', '2025-02-03 18:05:31'),
(40, 'Taufik Hidayat', 'taufik.hidayat@example.com', 'password123', 'Jl. Aster No. 74, Kecamatan Mahakam', 'Jakarta Selatan', '12150', '081234567807', '2025-02-03 18:05:31'),
(41, 'Daniel Bintang Pratama Goni', 'danelbintang@gmail.com', '$2y$12$p7aJ/lmMkMqRibulItb1Guu9D0BQ1adu0GpyQibheEpweHaZ3JDlm', 'Jl. Matahari No. 15, Kecamatan Dharmawangsa', 'Jakarta Selatan', '12140', '081234567808', '2025-02-09 08:41:12'),
(42, 'Aldo Ganteng', 'aldokeren@gmail.com', '$2y$12$9mhcIb/Pt3sFB9CWLhOTxeU1ULLQno.djdpfF3dC6o9iGZVS6p27a', 'Jl. Pelangi No. 28, Kecamatan Senayan', 'Jakarta Selatan', '12190', '081234567809', '2025-02-10 05:12:53'),
(43, 'Calysta Chika Gracianaa', 'calystachikagraciana@gmail.com', '$2y$12$J9OjVr73Do51Y8EzLRJUoOD2AFUVExXPCfr0IL0fO5ARoFsZSif1O', 'Perumahan Permata Alam Permai', 'Sidoarjo', '61254', '0895338157759', '2025-02-17 08:37:16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indeks untuk tabel `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_addresses_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_user_id_foreign` (`user_id`),
  ADD KEY `ratings_product_id_foreign` (`product_id`),
  ADD KEY `ratings_order_id_foreign` (`order_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD CONSTRAINT `customer_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Ketidakleluasaan untuk tabel `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
