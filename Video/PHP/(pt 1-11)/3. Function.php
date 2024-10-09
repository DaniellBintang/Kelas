<?php
    echo "saya belajar PHP";

    function belajar () {
        echo "Ini di dalam function"; //isi dari function
    }

    echo '<br>';
    belajar (); // menampilkan function
    echo '<br>';

    //Statis
    function luasPersegi () {
    $p = 5;
    $l = 12;
    $luas = $p * $l;

    echo "Panjang persegi = ".$p."cm";
    echo '<br>';
    echo "Lebar persegi = ".$l."cm";
    echo '<br>';
    echo "Luas Persegi Panjang adalah = ".$luas."cm";
    }

    luasPersegi(); // menampilkan function

    echo '<br>';

    //Dinamis
    function luasPersegi1 ($l = 15, $p = 12) {
        $luas = $l * $p;

        echo "Lebar persegi adalah : " . $l . '<br>';
        echo "Panjang persegi adalah : " . $p . '<br>';
        echo "Luas Persegi adalah : " . $luas;
    }

    luasPersegi1(5, 8); //nilai dari l dan p dapat diganti di dalam kurung.

    echo '<br>';

    //menggunakan return
    function output () {
        return 'Belajar Function.';
    }

    echo '<h1>'.output().'</h1>'; //wajib menyertakan echo untuk menampilkan function return

    function luas ($l = 5, $p = 7) {
        $luas = $p * $l;

        return $luas;
    }

    echo luas(10, 2) * 5;

?>