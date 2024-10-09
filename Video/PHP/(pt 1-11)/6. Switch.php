<?php
    $hari = 2;

    switch ($hari) {
        case 1 : // case adalah pengganti dari If dan elseif
            echo "Hari ini, Hari Senin.";
            break;
        case 2 :
            echo "Hari ini, Hari Selasa.";
            break;
        case 3 :
            echo "Hari ini, Hari Rabu.";
            break;
        case 4 :
            echo "Hari ini, Hari Kamis.";
            break;
        case 5 :
            echo "Hari ini, Hari Jumat.";
            break;
        case 6 :
            echo "Hari ini, Hari Sabtu.";
            break;
        case 7 :
            echo "Hari ini, Hari Minggu.";
            break;
        default :
            echo "Mohon Masukan angka diantara 1 - 7.";
            break;
    }

    echo '<br>';

    // Contoh lain.
    $pilihan = '';

    switch ($pilihan) {
        case 'tambah':
            echo 'Anda memilih tambah.';
            break;
        case 'ubah':
            echo 'Anda memilih ubah.';
            break;
        case 'hapus':
            echo 'Anda memilih hapus.';
            break;
        
        default:
            echo 'Anda belum memasukan pilihan.';
            break;
    }

?>