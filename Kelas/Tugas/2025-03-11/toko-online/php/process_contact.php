<?php
session_start();
require 'config.php'; // Koneksi database
require 'contactModel.php'; // Model kontak

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tangkap data dari form
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$message = trim($_POST['message']);

// Validasi sederhana
if (empty($name) || empty($email) || empty($message)) {
    $_SESSION['message'] = "Semua kolom wajib diisi!";
} else {
    // Simpan ke database
    $contactModel = new ContactModel($conn);
    if ($contactModel->saveMessage($name, $email, $message)) {
        $_SESSION['message'] = "Pesan Anda telah dikirim!";
    } else {
        $_SESSION['message'] = "Terjadi kesalahan. Coba lagi!";
    }
}

// Tutup koneksi
$conn->close();
header("Location: ../contact.php");
exit();
