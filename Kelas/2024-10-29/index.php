<?php

$sekolah = [
    "TK Hangtuah 3 Surabaya", // Array satu Dimensi
    "SD Negeri Tebel",
    "SMP Negeri 1 Gedangan",
    "SMK Negeri 2 Buduran"
];
$sekolahs = [
    "TK" => "TK Hangtuah 3 Surabaya", // Array associative
    "SD" => "SD Negeri Tebel",
    "SMP" => "SMP Negeri 1 Gedangan",
    "SMK" => "SMK Negeri 2 Buduran",
    "PT" => "Universitas Negeri Surabaya"
];

$skills = [
    "C++" => "Expert",
    "HTML" => "Newbie",
    "CSS" => "Intermediate",
    "PHP" => "Intermediate",
    "JavaScript" => "Intermediate"
];

$identitas = [
    "Nama" => "Daniel Bintang",
    "Alamat" => "Jl. Sentana Kali Tebel Tengah Sidoarjo",
    "Email" => "danielbintangpratamagoni@gmail.com",
    "FB" => "@DanielBintang",
    "TikTok" => "-",
    "IG" => "@staarzt__"
];

$hobi = [
    "Coding",
    "Musik",
    "Masak",
    "Membaca"
];

// //Memanggil Array
// echo $sekolah[0];       // Array satu Dimensi
// echo "<br>";
// echo $sekolahs["TK"];   // Arra Associative
// echo "<br>";
// echo $sekolah[1];
// echo "<br>";
// echo $sekolahs["SD"];

// echo "<br>";

// // Menampilkan semua value Array

// // menggunakan for loop
// for ($i = 0; $i < 4; $i++) {
//     echo $sekolah[$i];
//     echo "<br>";
// }

// echo "<br>";

// // Menggunakan foreach loop
// foreach ($sekolah as $key) {
//     echo $key;
//     echo "<br>";
// }

// echo "<br>";

// foreach ($sekolahs as $key => $value) {
//     echo $key;
//     echo "=";
//     echo $value;
//     echo "<br>";
// }

// echo "<br>";

// foreach ($skills as $key => $value) {
//     echo $key;
//     echo " = ";
//     echo $value;
//     echo "<br>";
// }

if (isset($_GET["menu"])) {
    $menu = $_GET["menu"];
    echo $menu;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <hr>
    <ul>
        <li><a href="?menu=home">Home</a></li>
        <li><a href="?menu=cv">CV</a> </li>
        <li><a href="?menu=project">Project</a></li>
        <li><a href="?menu=contact">Contact</a></li>
    </ul>
    <h2>Identitas</h2>
    <table border="1px">
        <thead>
            <tr>
                <th>Identitas</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($identitas as $key => $value) {
            ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $value ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <hr>
    <h2>Riwayat Sekolah</h2>
    <table border="1px">
        <thead>
            <tr>
                <th>Jenjang</th>
                <th>Nama Sekolah</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($sekolahs as $key => $value) {
                echo "<tr>";
                echo "<td>";
                echo $key;
                echo "</td>";
                echo "<td>";
                echo $value;
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <hr>
    <h2>Skills</h2>
    <table border="1px">
        <thead>
            <tr>
                <th>Skill</th>
                <th>Level</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($skills as $key => $value) {
            ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $value ?></td>
                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>
    <hr>
    <h2>Hobi</h2>
    <ul>
        <?php
        foreach ($hobi as $key) {
        ?>
            <li><?= $key ?></li>
        <?php
        }
        ?>
    </ul>
</body>

</html>