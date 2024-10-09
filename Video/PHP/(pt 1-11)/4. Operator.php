<?php

        echo "<h1>Operasi Aritmatika</h1>";

    //                      Operator Aritmatika.
    $a = 5;
    $b = 2;

    //Penjumlahan
    $c = $a + $b;
    echo $c.'<br>';

    //pengurangan
    $c = $a - $b;
    echo $c. '<br>' ;
    
    //perkalian 
    $c = $a * $b;
    echo $c . '<br>';

    //pembagian
    $c = $a / $b;
    echo floor($c). '<br>'; // membulatkan kebawah
    echo ceil($c) . '<br>'; // membulatkan keatas
    echo round($c) . '<br>'; // membulatkan terdekat

    //modulus atau sisa dari suatu pembagian.
    $c = $a % $b;
    echo $c.'<br>';

    //                          Operator Logika
    echo '<h1>Operator Logika</h1>';
    $c = $a < $b; // Jika tampil, maka value nya "False, jika tampil angka "1" maka value nya "True"
    echo $c. '<br>';

    $c = $a > $b;
    echo $c. '<br>';

    $c = $a == $b; // Sama Dengan
    echo $c. "<br>";

    $c = $a != $b; // tidak sama dengan
    echo $c.'<br>';

    //                  Increment / increasement
    echo "<h1>Increment</h1>";
    

    // melalui proses terlebih dahulu
    echo "<h2>Melalui proses</h2>";
    echo "Nilai sebelum : " . $a . '<br>' ;
    $a++; 
    echo "Nilai sesudah : " . $a; // untuk melihat perubahan, panggil variabel setelah melakukan Increment pada variabel.

    echo '<br>';

    // tanpa proses
    echo '<h2>Tanpa proses</h2>';
    echo "Nilai sebelum : " . $a . '<br>';
    echo "Nilai sesudah : " . ++$a;

    echo '<br>';

    //                  Operator String.
    $awal = "Sura";
    $akhir = "baya"; // value awal.
    $akhir .= " Adalah Kota Pahlawan"; // menambahkan value yang sudah tersedia.

    $hasil = $awal.$akhir; 

    echo $hasil;

?>