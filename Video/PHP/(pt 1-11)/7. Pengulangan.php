<?php
//                  For Looping

// Pengulangan bertambah / naik
    //Naik satu per satu
    for ($i= 1; $i <= 12 ; ++$i) { 
        echo $i.', ';
    }

    echo '<br>';

    //Meloncati satu angka
    for ($i= 1; $i <= 13 ; $i += 2) { 
        echo $i . ", ";
    }

    echo '<br>';

// Pengulangan berkurang / turun
    //Turun satu per satu
    for ($i= 12; $i >= 1 ; --$i) { 
        echo $i . ", ";
    }

    echo '<br>';

    //Turun meloncati satu angka
    for ($i= 12; $i >= 1 ; $i -= 2) { 
        echo $i . ", ";
    }

    echo '<br>';

//                  While Loop

    $a = 1;

    while ($a <= 10) {
        echo $a . ", ";

        ++$a;
    }

    echo '<br>';

    // Do While
    $a = 1;
    do {
        echo $a . ', ';
        ++$a;
    } while ($a <= 100);

?>