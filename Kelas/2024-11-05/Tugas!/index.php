<?php

$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "smpn";
$koneksi = mysqli_connect($host, $user, $password, $database);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="ikon.ico" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="navbar mt-4 sticky-top bg-white">
        <div class="container">
            <!-- Nav -->
            <div class="logo float-start">
                <div class="row">
                    <div class="col-4">
                        <a href="index.php"><img src="images/9368759IMG_20221201_194225_954(1)-300x294.png" width="90px" alt=""></a>
                    </div>
                    <div class="col-5 mt-3">
                        <h5><b>SMP NEGERI 1 GEDANGAN</b></h4>
                    </div>
                </div>
            </div>
            <div class="menu">
                <nav class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="?pages=home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdwn">
                            <a href="#" class="nav-link dropbtn">Tentang</a>
                            <div class="dropdown-conten">
                                <a href="?pages=visimisi">Visi & Misi</a>
                                <a href="?pages=denah">Denah Sekolah</a>
                                <a href="?pages=fasilitas">Fasilitas</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?pages=history">Sejarah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?pages=contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?pages=ekstra">Ektrakurikuler</a>
                    </li>
                    </li>
                </nav>
            </div>
        </div>
    </div>

    <hr style="color: gray;">

    <div class="container">
        <div class="content mt-5 mb-5">
            <!-- Nah, Ini isinya -->
            <?php
            if (isset($_GET["pages"])) {
                $pages = $_GET["pages"];
                if ($pages == "home") {
                    require_once("pages/home.php");
                }
                if ($pages == "contact") {
                    require_once("pages/contact.php");
                }
                if ($pages == "visimisi") {
                    require_once("pages/visimisi.php");
                }
                if ($pages == "denah") {
                    require_once("pages/denah.php");
                }
                if ($pages == "history") {
                    require_once("pages/history.php");
                }
                if ($pages == "fasilitas") {
                    require_once("pages/fasilitas.php");
                }
                if ($pages == "ekstra") {
                    require_once("pages/ekstra.php");
                }
            } else {
                require_once("pages/home.php");
            }
            ?>


        </div>

        <div class="footer mt-5 mb-5 text-center text-secondary"> Copyrights - Daniel Bintang Pratama (November 2024)</div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>