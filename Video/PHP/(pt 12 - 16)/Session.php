<nav>
    <ul>
        <li><a href="?menu=isi">isi</a></li>
        <li><a href="?menu=hapus">hapus</a></li>
        <li><a href="?menu=hancur">hancur</a></li>
    </ul>
</nav>

<?php

    session_start();

        var_dump($_SESSION);

        echo '<br>';

    if (isset($_GET['menu'])) {
        $menu = $_GET['menu'];

        echo $menu;

        switch ($menu) {
            case 'isi':
                isiSession();
                break;
            case 'hapus':
                unset($_SESSION['user']);
                break;
            case 'hancur':
                session_destroy();
                break;
            
            default:
                
                break;
        }
    }

    function isiSession() {
        $_SESSION['user'] = 'John';
        $_SESSION['nama'] = "John Doe";
        $_SESSION['alamat'] = 'Sidoarjo';
    }

?>