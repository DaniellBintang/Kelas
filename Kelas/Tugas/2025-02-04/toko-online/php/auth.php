<?php
// Mulai session di awal file
session_start();

function verifyCustomerLogin()
{
    // Cek apakah user_id ada di session
    if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
        // Redirect ke halaman login jika belum login
        header("Location: login.php");
        exit();
    }

    // Opsional: Tambahan keamanan dengan mengecek informasi user di database
    if (isset($conn)) {  // Pastikan koneksi database tersedia
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT id FROM customers WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            // Jika user tidak ditemukan di database, hapus session dan redirect
            session_unset();
            session_destroy();
            header("Location: login.php");
            exit();
        }
    }

    // Return true jika verifikasi berhasil
    return true;
}

// Contoh penggunaan di halaman yang membutuhkan login
require_once "php/config.php";  // Pastikan file config.php sudah di-include
verifyCustomerLogin();

// Sekarang bisa mengakses informasi user yang login
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
