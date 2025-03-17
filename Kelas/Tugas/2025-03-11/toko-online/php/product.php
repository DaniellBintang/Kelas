<?php
// Koneksi ke database
require_once "config.php";

// Query untuk mengambil data produk
$sql = "SELECT id, name, image, price FROM products";
$result = $conn->query($sql);

// Tampilkan data produk
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID Produk: " . $row["id"] . "<br>";
        echo "Nama Produk: " . $row["name"] . "<br>";
        echo "Gambar: <img src='images/" . $row["image"] . "' width='100'><br>";
        echo "Harga: Rp " . number_format($row["price"], 0, ',', '.') . "<br><br>";
    }
} else {
    echo "Tidak ada produk yang tersedia.";
}

// Tutup koneksi
$conn->close();
