<?php

$nama = "Daniel Bintang Pratama";
$profession = "PROGRAMMER";

$profil = "Saya bersekolah di SMK Negeri 2 Buduran, saya mengambil 
jurusan Rekayasa Perangkat Lunak, 
saya ingin mendalami dunia Komputer beserta Perangkat Lunak 
yang ada di dalam Komputer sehingga saya bukan hanya menggunakan suatu Aplikasi, 
namun juga dapat Membuat Aplikasi Tersebut";

$educations = [
    "Hangtuah 3 Surabaya (2013-2014)",
    "Negeri Tebel (2014-2020)",
    "Negeri 1 Gedangan (2020-2023)",
    "Negeri 2 Buduran (present)"
];



$telephone = "+62-877-6260-4297";
$email = "danielbintangpratamagoni@gmail.com";
$adress = "Jl. Senatana Kali III RT009/RW005 No.20 Gedangan, Sidoarjo";

$skills = [
    "C++, C#, Java Language Expert",
    "PHP, JavaScript Intermediate",
    "SQL, Ruby, Python Newbie"
];

$languages = [
    "Prancis    <br>",
    "Inggris    <br>",
    "Indonesia  <br>",
    "Jerman     <br>",
    "Jawa       <br>"
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="img">
                    <img src="images/9cfd6324-be2c-4f0c-9586-b5a06d9a7d18.jpeg" alt="">
                </div>
            </div>
            <div class="col-6 mt-4 d-flex align-items-center">
                <div class="row">
                    <div class="col-8">
                        <h1><b> <?= $nama ?> </b></h1>
                    </div>
                    <div class="col-7">
                        <p><?= $profession ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div id="deskripsi" class="row ">
            <div class="isi d-flex justify-content-center">
                <div id="inti" class="row d-flex">
                    <div class="col-6">
                        <div class="kiri mt-4">
                            <h3>PROFIL</h3>
                            <div class="profil mt-3">
                                <p><?= $profil ?></p>
                            </div>
                            <div class="edukasi mt-4">
                                <h3>EDUKASI</h3>
                                <table style="width : 40rem ;">
                                    <tbody>
                                        <tr>
                                            <td>TK </td>
                                            <td>: <b><?= $educations[0] ?></b></td>
                                        </tr>
                                        <tr>
                                            <td>SD</td>
                                            <td>: <b><?= $educations[1] ?></td>
                                        </tr>
                                        <tr>
                                            <td>SMP</td>
                                            <td>: <b><?= $educations[2] ?></td>
                                        </tr>
                                        <tr>
                                            <td>SMK</td>
                                            <td> : <b><?= $educations[3] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="contact mt-3">
                                <div class="telp flex">
                                    <img src="images/telephone-and-mobile-phone-icon-calling-icon-transparent-background-free.png" alt="">
                                    <div class="flex mx-2">
                                        <p>
                                            <b>Telepon</b> <br>
                                            <?= $telephone ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="email flex">
                                    <img src="images/email-confirmation-app-icon-email-icon-free.png" alt="">
                                    <div class="flex mx-2">
                                        <p>
                                            <b>Email</b> <br>
                                            <?= $email ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="alamat flex">
                                    <img src="images/images.png" alt="">
                                    <div class="flex mx-2">
                                        <p>
                                            <b>Alamat</b> <br>
                                            <?= $adress ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="kanan mt-4">
                            <div class="pengalaman">
                                <h3>PENGALAMAN</h3>
                                <div class="list">
                                    <div class="line"></div>
                                    <ul>
                                        <li><b>Software Engineer</b></li>
                                        <?= $skills[0] ?>
                                        <br> <br>
                                        <li><b>Backend Developer</b></li>
                                        <?= $skills[1] ?>

                                        <br> <br>
                                        <li><b>Cyber Security</b></li>
                                        <?= $skills[2] ?>
                                    </ul>
                                </div>
                            </div>
                            <br>
                            <h3>BAHASA</h3>
                            <div class="bahasa mx-2">
                                <?= $languages[0] ?>
                                <?= $languages[1] ?>
                                <?= $languages[2] ?>
                                <?= $languages[3] ?>
                                <?= $languages[4] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>