<?php
include 'db.php';

// Dummy data
$admins = [
    ['email' => 'admin1@example.com', 'password' => password_hash('password123', PASSWORD_DEFAULT)],
    ['email' => 'admin2@example.com', 'password' => password_hash('password123', PASSWORD_DEFAULT)],
    ['email' => 'admin3@example.com', 'password' => password_hash('password123', PASSWORD_DEFAULT)]
];

foreach ($admins as $admin) {
    $email = $admin['email'];
    $password = $admin['password'];

    $query = "INSERT INTO admins (email, password) VALUES ('$email', '$password')";
    if (mysqli_query($conn, $query)) {
        echo "Admin $email berhasil ditambahkan.<br>";
    } else {
        echo "Gagal menambahkan $email: " . mysqli_error($conn) . "<br>";
    }
}

mysqli_close($conn);
