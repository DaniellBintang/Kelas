<?php

// Kondisi ada di luar If.
    $usia = 20;
    $batas = $usia >= 18;

    if ($batas){
        echo "Anda Boleh Masuk.";
    } else {
        echo "Anda Tidak bisa masuk.";
    }

    echo '<br>';

// Kondisi ada di dalam If.
    $usia = 12;

    if ($usia >= 18) {
        echo "Anda Boleh Masuk";
    } else {
        echo "Anda Tidak Bisa Masuk.";
    }

    echo '<br>';

// Kondisi bersarang.
    $usia = 120;

    if ($usia < 19) {
        if ($usia == 18) { //Jika value dibawah 19, akan dilanjutkan kedalam pengujian selanjutnya.
            echo "Anda cukup Umur";
        } elseif ($usia < 18 ) { //jika value dibawah 18 akan masuk kedalam pengujian ini.
            echo "Anda dibawah umur";
        }
    } else { // jika value 19 dan selebihnya, akan masuk kedalam pengujian else.
        echo "Anda di luar jangkauan.";
    }

    echo "<br>";

//Contoh lain
    $nilai = 10;

    if ($nilai <= 100){
        if ($nilai >= 0) {
            echo "Nilai benar";
        }else
        echo "Nilai salah";
    }else {
        echo "Nilai salah.";
    }
//atau juga bisa ditulis seperti dibawah ini.

    echo "<br>";

// Pengujian dengan 2 Kondisi.
    //pengujian dengan operator "And"
    if ($nilai <= 100 && $nilai >= 0) {
        echo "Nilai benar";
    } else {
        echo "Nilai salah";
    }

    echo "<br>";

    //Pengujian dengan operator "or" (dibalik)
    if ($nilai >= 100 || $nilai <= 0) {
        echo "Nilai salah";
    } else {
        echo "Nilai Benar";
    }

?>