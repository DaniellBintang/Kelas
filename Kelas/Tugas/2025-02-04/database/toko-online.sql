-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Feb 2025 pada 19.22
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko-online`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `created_at`) VALUES
(1, 'admin1@example.com', 'password123', '2025-02-10 15:39:23'),
(2, 'admin2@example.com', 'password123', '2025-02-10 15:39:23'),
(3, 'admin3@example.com', 'password123', '2025-02-10 15:39:23'),
(4, 'adminkeren@gmail.com', '$2y$10$.j8nG9.zeUSpK5oRvZjcsOZp20T.zvdXN4bwDQUnm9zvUmoGsGbmq', '2025-02-10 16:01:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` enum('static','dynamic') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `banners`
--

INSERT INTO `banners` (`id`, `image`, `type`, `created_at`) VALUES
(1, 'banner1.png', 'static', '2025-02-04 01:06:47'),
(2, 'banner2.png', 'static', '2025-02-04 01:06:47'),
(4, 'banner4.png', 'static', '2025-02-04 01:06:47'),
(5, 'banner5.png', 'static', '2025-02-04 01:06:47'),
(6, 'banner6.jpg', 'dynamic', '2025-02-04 01:06:47'),
(7, 'banner7.jpg', 'dynamic', '2025-02-04 01:06:47'),
(9, 'banner9.jpg', 'dynamic', '2025-02-04 01:06:47'),
(10, 'banner10.jpg', 'dynamic', '2025-02-04 01:06:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`id`, `customer_id`, `product_id`, `quantity`, `created_at`) VALUES
(21, 21, 5, 1, '2025-02-04 01:13:01'),
(22, 22, 10, 2, '2025-02-04 01:13:01'),
(23, 23, 15, 1, '2025-02-04 01:13:01'),
(24, 24, 7, 3, '2025-02-04 01:13:01'),
(25, 25, 12, 2, '2025-02-04 01:13:01'),
(26, 26, 3, 1, '2025-02-04 01:13:01'),
(27, 27, 9, 2, '2025-02-04 01:13:01'),
(28, 28, 14, 1, '2025-02-04 01:13:01'),
(29, 29, 1, 4, '2025-02-04 01:13:01'),
(30, 30, 6, 2, '2025-02-04 01:13:01'),
(31, 31, 11, 1, '2025-02-04 01:13:01'),
(32, 32, 2, 3, '2025-02-04 01:13:01'),
(33, 33, 8, 1, '2025-02-04 01:13:01'),
(34, 34, 13, 2, '2025-02-04 01:13:01'),
(35, 35, 4, 1, '2025-02-04 01:13:01'),
(36, 36, 17, 2, '2025-02-04 01:13:01'),
(37, 37, 20, 1, '2025-02-04 01:13:01'),
(38, 38, 19, 3, '2025-02-04 01:13:01'),
(39, 39, 16, 2, '2025-02-04 01:13:01'),
(40, 40, 18, 1, '2025-02-04 01:13:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'Customer 21', 'customer21@example.com', 'Saya tertarik dengan produk Anda.', '2025-02-04 01:16:48'),
(2, 'Customer 22', 'customer22@example.com', 'Apakah ada garansi untuk produk ini?', '2025-02-04 01:16:48'),
(3, 'Customer 23', 'customer23@example.com', 'Saya ingin mengetahui lebih lanjut tentang pembayaran.', '2025-02-04 01:16:48'),
(4, 'Customer 24', 'customer24@example.com', 'Bagaimana cara mengembalikan barang jika ada kerusakan?', '2025-02-04 01:16:48'),
(5, 'Customer 25', 'customer25@example.com', 'Apakah ada diskon untuk pembelian dalam jumlah besar?', '2025-02-04 01:16:48'),
(6, 'Customer 26', 'customer26@example.com', 'Apakah produk ini tersedia dalam warna lain?', '2025-02-04 01:16:48'),
(7, 'Customer 27', 'customer27@example.com', 'Berapa lama waktu pengiriman ke kota saya?', '2025-02-04 01:16:48'),
(8, 'Customer 28', 'customer28@example.com', 'Saya mengalami masalah saat checkout.', '2025-02-04 01:16:48'),
(9, 'Customer 29', 'customer29@example.com', 'Saya ingin menjadi reseller produk ini.', '2025-02-04 01:16:48'),
(10, 'Customer 30', 'customer30@example.com', 'Apakah ada layanan pengiriman cepat?', '2025-02-04 01:16:48'),
(11, 'Customer 31', 'customer31@example.com', 'Bagaimana cara melacak pesanan saya?', '2025-02-04 01:16:48'),
(12, 'Customer 32', 'customer32@example.com', 'Saya ingin mengetahui cara penggunaan produk ini.', '2025-02-04 01:16:48'),
(13, 'Customer 33', 'customer33@example.com', 'Apakah ada produk terbaru yang belum ditampilkan di website?', '2025-02-04 01:16:48'),
(14, 'Customer 34', 'customer34@example.com', 'Saya ingin mengubah alamat pengiriman saya.', '2025-02-04 01:16:48'),
(15, 'Customer 35', 'customer35@example.com', 'Apakah bisa membayar dengan metode cicilan?', '2025-02-04 01:16:48'),
(16, 'Customer 36', 'customer36@example.com', 'Berapa biaya pengiriman ke luar negeri?', '2025-02-04 01:16:48'),
(17, 'Customer 37', 'customer37@example.com', 'Saya ingin membatalkan pesanan saya.', '2025-02-04 01:16:48'),
(18, 'Customer 38', 'customer38@example.com', 'Bagaimana cara mendapatkan kode promo?', '2025-02-04 01:16:48'),
(19, 'Customer 39', 'customer39@example.com', 'Apakah ada program loyalitas untuk pelanggan tetap?', '2025-02-04 01:16:48'),
(20, 'Customer 40', 'customer40@example.com', 'Saya ingin meminta rekomendasi produk yang sesuai dengan kebutuhan saya.', '2025-02-04 01:16:48'),
(23, 'American Ultra Stratocaster®', 'danelbintang@gmail.com', 'Mantep lur', '2025-02-07 11:40:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `full_name`, `email`, `password`, `created_at`) VALUES
(21, 'Andi Saputra', 'andi.saputra@example.com', 'password123', '2025-02-04 01:05:31'),
(22, 'Budi Santoso', 'budi.santoso@example.com', 'password123', '2025-02-04 01:05:31'),
(23, 'Citra Lestari', 'citra.lestari@example.com', 'password123', '2025-02-04 01:05:31'),
(24, 'Dewi Kumalasari', 'dewi.kumalasari@example.com', 'password123', '2025-02-04 01:05:31'),
(25, 'Eka Wijaya', 'eka.wijaya@example.com', 'password123', '2025-02-04 01:05:31'),
(26, 'Fajar Pratama', 'fajar.pratama@example.com', 'password123', '2025-02-04 01:05:31'),
(27, 'Gita Pertiwi', 'gita.pertiwi@example.com', 'password123', '2025-02-04 01:05:31'),
(28, 'Hadi Saputro', 'hadi.saputro@example.com', 'password123', '2025-02-04 01:05:31'),
(29, 'Indah Sari', 'indah.sari@example.com', 'password123', '2025-02-04 01:05:31'),
(30, 'Joko Widodo', 'joko.widodo@example.com', 'password123', '2025-02-04 01:05:31'),
(31, 'Kartika Dewi', 'kartika.dewi@example.com', 'password123', '2025-02-04 01:05:31'),
(32, 'Lukman Hakim', 'lukman.hakim@example.com', 'password123', '2025-02-04 01:05:31'),
(33, 'Maya Anggraini', 'maya.anggraini@example.com', 'password123', '2025-02-04 01:05:31'),
(34, 'Nugroho Adi', 'nugroho.adi@example.com', 'password123', '2025-02-04 01:05:31'),
(35, 'Olivia Salsabila', 'olivia.salsabila@example.com', 'password123', '2025-02-04 01:05:31'),
(36, 'Pandu Setiawan', 'pandu.setiawan@example.com', 'password123', '2025-02-04 01:05:31'),
(37, 'Qory Anindita', 'qory.anindita@example.com', 'password123', '2025-02-04 01:05:31'),
(38, 'Rizky Ramadhan', 'rizky.ramadhan@example.com', 'password123', '2025-02-04 01:05:31'),
(39, 'Siti Aminah', 'siti.aminah@example.com', 'password123', '2025-02-04 01:05:31'),
(40, 'Taufik Hidayat', 'taufik.hidayat@example.com', 'password123', '2025-02-04 01:05:31'),
(41, 'Daniel Bintang Pratama', 'danelbintang@gmail.com', 'Daniel321', '2025-02-09 15:41:12'),
(42, 'Aldo Ganteng', 'aldokeren@gmail.com', '123', '2025-02-10 12:12:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','canceled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `total_price`, `status`, `created_at`) VALUES
(1, 21, 500000.00, 'completed', '2025-02-04 01:16:48'),
(2, 22, 750000.00, 'pending', '2025-02-04 01:16:48'),
(3, 23, 1200000.00, 'completed', '2025-02-04 01:16:48'),
(4, 24, 650000.00, 'canceled', '2025-02-04 01:16:48'),
(5, 25, 2300000.00, 'pending', '2025-02-04 01:16:48'),
(6, 26, 450000.00, 'completed', '2025-02-04 01:16:48'),
(7, 27, 1800000.00, 'pending', '2025-02-04 01:16:48'),
(8, 28, 3400000.00, 'completed', '2025-02-04 01:16:48'),
(9, 29, 210000.00, 'pending', '2025-02-04 01:16:48'),
(10, 30, 890000.00, 'completed', '2025-02-04 01:16:48'),
(11, 31, 1250000.00, 'canceled', '2025-02-04 01:16:48'),
(12, 32, 980000.00, 'completed', '2025-02-04 01:16:48'),
(13, 33, 150000.00, 'pending', '2025-02-04 01:16:48'),
(14, 34, 2500000.00, 'completed', '2025-02-04 01:16:48'),
(15, 35, 320000.00, 'pending', '2025-02-04 01:16:48'),
(16, 36, 700000.00, 'completed', '2025-02-04 01:16:48'),
(17, 37, 990000.00, 'completed', '2025-02-04 01:16:48'),
(18, 38, 450000.00, 'pending', '2025-02-04 01:16:48'),
(19, 39, 1350000.00, 'completed', '2025-02-04 01:16:48'),
(20, 40, 760000.00, 'pending', '2025-02-04 01:16:48'),
(21, 42, 1800000.00, 'pending', '2025-02-10 18:02:22'),
(22, 42, 7500000.00, 'pending', '2025-02-10 18:04:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 3, 1, 500000.00),
(2, 2, 7, 2, 375000.00),
(3, 3, 12, 1, 1200000.00),
(4, 4, 1, 2, 325000.00),
(5, 5, 9, 1, 2300000.00),
(6, 6, 15, 3, 150000.00),
(7, 7, 2, 1, 1800000.00),
(8, 8, 8, 2, 1700000.00),
(9, 9, 10, 1, 210000.00),
(10, 10, 4, 1, 890000.00),
(11, 11, 6, 2, 625000.00),
(12, 12, 14, 1, 980000.00),
(13, 13, 20, 3, 50000.00),
(14, 14, 17, 2, 1250000.00),
(15, 15, 5, 1, 320000.00),
(16, 16, 11, 1, 700000.00),
(17, 17, 19, 2, 495000.00),
(18, 18, 16, 1, 450000.00),
(19, 19, 13, 2, 675000.00),
(20, 20, 18, 1, 760000.00),
(21, 21, 3, 1, 1800000.00),
(22, 22, 2, 1, 7500000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `created_at`) VALUES
(1, 'Gitar Akustik Yamaha F310', 'gitar1.png', 1200000.00, '2025-02-04 01:01:42'),
(2, 'Gitar Elektrik Fender Stratocaster', 'gitar2.png', 7500000.00, '2025-02-04 01:01:42'),
(3, 'Gitar Akustik Cort AD810', 'gitar3.png', 1800000.00, '2025-02-04 01:01:42'),
(4, 'Gitar Klasik Yamaha C40', 'gitar4.png', 1200000.00, '2025-02-04 01:01:42'),
(5, 'Gitar Elektrik Gibson Les Paul', 'gitar5.png', 15000000.00, '2025-02-04 01:01:42'),
(6, 'Gitar Akustik Taylor 114ce', 'gitar6.png', 10000000.00, '2025-02-04 01:01:42'),
(7, 'Gitar Bass Ibanez GSR200', 'gitar7.png', 3500000.00, '2025-02-04 01:01:42'),
(8, 'Gitar Elektrik PRS SE Custom 24', 'gitar8.png', 9500000.00, '2025-02-04 01:01:42'),
(9, 'Gitar Akustik Martin D-28', 'gitar9.png', 35000000.00, '2025-02-04 01:01:42'),
(10, 'Gitar Klasik Cordoba C5', 'gitar10.png', 2500000.00, '2025-02-04 01:01:42'),
(11, 'Gitar Akustik Epiphone DR-100', 'gitar11.png', 1600000.00, '2025-02-04 01:01:42'),
(12, 'Gitar Elektrik ESP LTD EC-256', 'gitar12.png', 7000000.00, '2025-02-04 01:01:42'),
(13, 'Gitar Bass Fender Precision', 'gitar13.png', 12000000.00, '2025-02-04 01:01:42'),
(14, 'Gitar Akustik Seagull S6', 'gitar14.png', 5000000.00, '2025-02-04 01:01:42'),
(15, 'Gitar Klasik Alhambra 3C', 'gitar15.png', 4500000.00, '2025-02-04 01:01:42'),
(16, 'Gitar Elektrik Ibanez RG450DX', 'gitar16.png', 6800000.00, '2025-02-04 01:01:42'),
(17, 'Gitar Akustik Fender CD-60', 'gitar17.png', 2200000.00, '2025-02-04 01:01:42'),
(18, 'Gitar Elektrik Schecter Omen-6', 'gitar18.png', 5500000.00, '2025-02-04 01:01:42'),
(19, 'Gitar Bass Yamaha TRBX174', 'gitar19.png', 2700000.00, '2025-02-04 01:01:42'),
(20, 'Gitar Akustik Takamine GD30', 'gitar20.png', 4300000.00, '2025-02-04 01:01:42');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
