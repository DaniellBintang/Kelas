<?php
        // Foreach akan sering digunakan saat berhadapan dengan database (Array adalah salah satu contohnya).

    $nama = array ("John ", "Rudy ", "Robert ", "Mia");

    echo "<br>";

    foreach ($nama as $key) {
        echo $key;
    }$nama = array ("John ", "Rudy ", "Robert ", "Mia");

    echo "<br>";

    $nama1= array (
        "John"      => "Surabaya ",
        "Rudy"      => "Jombang ",
        "Robert"    => "Nganjuk ",
        "Mia"       => "Tegal"
    );

    foreach ($nama1 as $a => $b) {
        echo $a . '-' . $b;
    }

?>