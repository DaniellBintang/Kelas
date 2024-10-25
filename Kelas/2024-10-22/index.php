<<<<<<< HEAD
<?php

$data = "Saya belajar PHP di SMKN 2 Buduran";
$isi = "Hari ini saya Belajar PHP";
$materi = "Materi belajar PHP";
$sekolahs = [
    "TK Hangtuah",
    "SD Negeri ABC",
    "SMP Negeri 1 Gedangan",
    "SMK Negeri 2 Buduran"
];
$identitases = [
    "Daniel Bintang",
    "Jl. Sentana III No. 20",
    "danielbintangpratamagoni@gmail.com",
    "@bintang"
];

$judul = "Curriculum Vitae";
$hobies = [
    "Bersepeda",
    "Main Musik",
    "Sepak Bola"
];

$skills = [
    "HTML Expert",
    "CSS Expert",
    "PHP Intermediate",
    "JavaScript Newbie"
];

$list1 = "Variabel";
$list2 = "Array";
$list3 = "Pengujian";
$list4 = "Pengulangan";
$list5 = "Function";
$list6 = "Class";
$list7 = "Object";
$list8 = "Framework";
$list9 = "PHP dan MySql";

$lists = [
    "Variabel",     // 0
    "Array",        // 1
    "Pengujian",    // 2
    "Pengulangan",  // 3
    "Function",     // 4
    "Class",        // 5
    "Object",       // 6
    "Framework",    // 7
    "PHP dan MySql" // 8
];

echo $data;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="header">
        <h1><?= $judul ?></h1>
    </div>
    <div class="identitas">
        <table>
            <thead>
                <tr>
                    <th>Identita</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nama</td>
                    <td><?= $identitases[0] ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><?= $identitases[1] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="kamar">
        <h1><?php echo $data; ?></h1>
        <p><?php echo $isi; ?></p>
        <h2><?= $materi; ?></h2>
        <div class="list">
            <ol>
                <li><?= $lists[0] ?></li>
                <p>Variabel adalah wadah atau tempat untuk menyipan data.</p>
                <p>Data bisa berupa text atau string, bisa juga berupa angka atau numerik,
                    Data juga bisa gabungan antara text, angka, dan simbol</p>
                <li><?= $lists[1] ?></li>
                <li><?= $lists[2] ?></li>
                <li><?= $lists[3] ?> </li>
                <li><?= $lists[4] ?> </li>
                <li><?= $lists[5] ?> </li>
                <li><?= $lists[6] ?> </li>
                <li><?= $lists[7] ?> </li>
                <li><?= $lists[8] ?> </li>
            </ol>
        </div>
    </div>
</body>

=======
<?php

$data = "Saya belajar PHP di SMKN 2 Buduran";
$isi = "Hari ini saya Belajar PHP";
$materi = "Materi belajar PHP";
$sekolahs = [
    "TK Hangtuah",
    "SD Negeri ABC",
    "SMP Negeri 1 Gedangan",
    "SMK Negeri 2 Buduran"
];
$identitases = [
    "Daniel Bintang",
    "Jl. Sentana III No. 20",
    "danielbintangpratamagoni@gmail.com",
    "@bintang"
];

$judul = "Curriculum Vitae";
$hobies = [
    "Bersepeda",
    "Main Musik",
    "Sepak Bola"
];

$skills = [
    "HTML Expert",
    "CSS Expert",
    "PHP Intermediate",
    "JavaScript Newbie"
];

$list1 = "Variabel";
$list2 = "Array";
$list3 = "Pengujian";
$list4 = "Pengulangan";
$list5 = "Function";
$list6 = "Class";
$list7 = "Object";
$list8 = "Framework";
$list9 = "PHP dan MySql";

$lists = [
    "Variabel",     // 0
    "Array",        // 1
    "Pengujian",    // 2
    "Pengulangan",  // 3
    "Function",     // 4
    "Class",        // 5
    "Object",       // 6
    "Framework",    // 7
    "PHP dan MySql" // 8
];

echo $data;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="header">
        <h1><?= $judul ?></h1>
    </div>
    <div class="identitas">
        <table>
            <thead>
                <tr>
                    <th>Identita</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nama</td>
                    <td><?= $identitases[0] ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><?= $identitases[1] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="kamar">
        <h1><?php echo $data; ?></h1>
        <p><?php echo $isi; ?></p>
        <h2><?= $materi; ?></h2>
        <div class="list">
            <ol>
                <li><?= $lists[0] ?></li>
                <p>Variabel adalah wadah atau tempat untuk menyipan data.</p>
                <p>Data bisa berupa text atau string, bisa juga berupa angka atau numerik,
                    Data juga bisa gabungan antara text, angka, dan simbol</p>
                <li><?= $lists[1] ?></li>
                <li><?= $lists[2] ?></li>
                <li><?= $lists[3] ?> </li>
                <li><?= $lists[4] ?> </li>
                <li><?= $lists[5] ?> </li>
                <li><?= $lists[6] ?> </li>
                <li><?= $lists[7] ?> </li>
                <li><?= $lists[8] ?> </li>
            </ol>
        </div>
    </div>
</body>

>>>>>>> 4e8608c10c0c11ebc844d6ed0d9513198a9860d8
</html>