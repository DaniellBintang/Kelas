<?php
    
//                                                  Array Dimensi
    $nama = array ("John ", "Rudy ", "Robert ", "Mia");
    var_dump($nama);

    echo "<br>";

    //memanggil value Array
    echo $nama[0];

    echo '<br>';
    
    //menampilkan semua value Menggunakan Looping
    for ($i=0; $i < 4; $i++) { 
        echo $nama[$i];
    }

    echo '<br>';

    // Menggunakan foreach
    foreach ($nama as $key) {
        echo $key;
    }

    echo '<br>';

//                                              Array Asosiatif
    $nama1= array (
        "John"      => "Surabaya ",
        "Rudy"      => "Jombang ",
        "Robert"    => "Nganjuk ",
        "Mia"       => "Tegal"
    );

    //Penulisannya juga dapat seperti dibawah ini :
    /*
    $nama["John"]=["Surabaya"]
    $nama["Rudi"]=["Jombang"]
    $nama["Robert"]=["Nganjuk"]
    $nama["Mia"]=["Tegal"]
    */

    var_dump($nama1);
    echo '<br>';

    //menampilkan Array Asosiatif
    echo $nama1["John"]. ' ';
    echo $nama1["Rudy"] . ' ';
    echo $nama1["Robert"] . ' ';
    echo $nama1["Mia"];

    echo '<br>';

    //Menampilkan semua value Array
    foreach ($nama1 as $key => $value) {
        echo $key . ' ' . $value;
    }

?>