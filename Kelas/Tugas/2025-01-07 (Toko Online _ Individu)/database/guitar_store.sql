-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Feb 2025 pada 13.24
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
-- Database: `guitar_store`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`) VALUES
(2, 'admin@example.com', '$2y$10$j8wx7i1d2F.vKtPXCQtFL.67VQS34Hfi2eQqil.fPu8SUo.J1oHDi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guitars`
--

CREATE TABLE `guitars` (
  `id` int(11) NOT NULL,
  `guitar_name` varchar(255) DEFAULT NULL,
  `guitar_image` varchar(255) DEFAULT NULL,
  `guitar_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `guitars`
--

INSERT INTO `guitars` (`id`, `guitar_name`, `guitar_image`, `guitar_price`) VALUES
(4, 'American Professional II Jazzmaster®', 'uploads/electric2.jpg', 24000),
(5, 'American Professional II Precision Bass® V', 'uploads/bass1.jpg', 12000),
(6, 'American Professional II Stratocaster®', 'uploads/electric1.jpg', 20000),
(7, 'American Ultra Stratocaster®', 'uploads/0118010781_gtr_frt_001_rr.jpg', 32000),
(8, 'Limited Edition Mike Kerr Jaguar® Bass', 'uploads/0149460382_fen_ins_frt_1_rr.jpg', 51000),
(10, 'Redondo Player', 'uploads/acoustic1.jpg', 7000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `guitar_details`
--

CREATE TABLE `guitar_details` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `specifications` text NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `guitar_details`
--

INSERT INTO `guitar_details` (`id`, `description`, `specifications`, `stock`) VALUES
(4, 'The American Professional II Stratocaster® draws from more than sixty years of innovation, inspiration and evolution to meet the demands of today\'s working player.\r\n\r\nOur popular Deep \"C\" neck now sports smooth rolled fingerboard edges, a \"Super-Natural\" satin finish and a newly sculpted neck heel for a supremely comfortable feel and easy access to the upper register. New V-Mod II Stratocaster single-coil pickups are more articulate than ever while retaining bell-like chime and warmth. An upgraded 2-point tremolo with a cold-rolled steel block increases sustain, clarity and high-end sparkle.\r\n\r\nThe American Pro II Stratocaster delivers instant familiarity and sonic versatility you\'ll feel and hear right away, with broad ranging improvements that add up to nothing less than a new standard for professional instruments.', 'Top: Spruce \r\nBack & Sides: Mahogany\r\nNeck: Maple\r\nStrings: Steel\r\nBridge Pickup : V-Mod II Single-Coil Jazzmaster®\r\nNeck Pickup : V-Mod II Single-Coil Jazzmaster®\r\nControls : Lead Circuit Controls (Slide Switch Down): Master Volume, Master Tone; Rhythm Circuit Controls (Slide Switch Up): Thumbwheel Volume and Tone Controls for Series Rhythm Mode', 50),
(5, 'The American Professional II Precision Bass® V draws from more than sixty years of innovation, inspiration and evolution to meet the demands of today\'s working player.\r\n\r\nThe \'63 P Bass® profile neck now sports smooth rolled fingerboard edges, a \"Super-Natural\" satin finish and a newly sculpted neck heel for a supremely comfortable feel and easy access to the upper register. The new V-Mod II Precision Bass V split-coil pickup is more articulate than ever while delivering the punch and growl the P Bass® is known for.\r\n\r\nThe American Pro II Precision Bass V delivers instant familiarity and sonic versatility you\'ll feel and hear right away, with broad ranging improvements that add up to nothing less than a new standard for professional instruments.', 'Body Material : Alder\r\nBody Finish   : Gloss Urethane\r\nBody Shape    : Precision Bass®\r\nMiddle Pickup : V-Mod II Split Single-Coil Precision Bass®\r\nControls      : Master Volume, Master Tone\r\nSwitching     : None', 28),
(6, 'The American Professional II Stratocaster® draws from more than sixty years of innovation, inspiration and evolution to meet the demands of today\'s working player.\r\n\r\nOur popular Deep \"C\" neck now sports smooth rolled fingerboard edges, a \"Super-Natural\" satin finish and a newly sculpted neck heel for a supremely comfortable feel and easy access to the upper register. New V-Mod II Stratocaster single-coil pickups are more articulate than ever while retaining bell-like chime and warmth. An upgraded 2-point tremolo with a cold-rolled steel block increases sustain, clarity and high-end sparkle.\r\n\r\nThe American Pro II Stratocaster delivers instant familiarity and sonic versatility you\'ll feel and hear right away, with broad ranging improvements that add up to nothing less than a new standard for professional instruments.', 'Body Material : Alder\r\nBody Finish   : Gloss Urethane\r\nBody Shape    : Stratocaster®\r\nBridge Pickup : V-Mod II Single-Coil Strat®\r\nMiddle Pickup : V-Mod II Single-Coil Strat®\r\nNeck Pickup   : V-Mod II Single-Coil Strat®\r\nControls      : Master Volume, Tone 1. (Neck/Middle Pickups), Tone 2. (Bridge Pickup)', 80);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address`, `total_price`, `created_at`) VALUES
(3, 1, 'Jl. Sentana III NO.20 RT/RW 009/005 Gedangan, Sidoarjo, Jawa Timur', 20000.00, '2025-02-02 12:16:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `review` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `reviews`
--

INSERT INTO `reviews` (`id`, `email`, `item_name`, `review`, `photo`, `created_at`) VALUES
(2, 'danelbintang@gmail.com', 'American Professional II Jazzmaster', 'This Thing\'s send perfectly into my Crib yo, and its working so fineeee', 'crud/uploads/shopping.png', '2025-01-11 15:29:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `password`, `created_at`) VALUES
(1, 'Daniel Bintang', 'danelbintang@gmail.com', 'Jl. Sentana III NO.20 RT/RW 009/005 Gedangan, Sidoarjo, Jawa Timur', '$2y$10$iSxYd0.xkkzpEn2VvSH3s.6bWLaJz8mflzmZ8M8tFhpunbr8jyY3i', '2025-01-18 17:42:45');

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
-- Indeks untuk tabel `guitars`
--
ALTER TABLE `guitars`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `guitar_details`
--
ALTER TABLE `guitar_details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `guitars`
--
ALTER TABLE `guitars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `guitar_details`
--
ALTER TABLE `guitar_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `guitar_details`
--
ALTER TABLE `guitar_details`
  ADD CONSTRAINT `guitar_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `guitars` (`id`);

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
