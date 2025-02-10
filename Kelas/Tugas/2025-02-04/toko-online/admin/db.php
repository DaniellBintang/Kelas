<?php
// config.php - Koneksi ke Database
$host = "localhost";
$username = "root";
$password = "";
$database = "toko-online";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
