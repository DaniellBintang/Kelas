<div class="row">
    <div class="col-4 mx-auto mt-4">
        <div class="form-group">

            <form action="" method="post">
                <div>
                    <h3>Log-In Pelanggan</h3>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" required placeholder="Masukan Email" class="form-control">
                </div>

                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" required placeholder="Masukan Password" class="form-control">
                    </div>

                    <div>

                        <input type="submit" name="login" value="LogIn" class="btn btn-primary">

                    </div>

                </form>
        </div>
    </div>
</div>

<?php

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM tblpelanggan WHERE email = '$email' AND password = '$password' AND aktif = 1";

    $count = $db->rowCount($sql);

    if ($count == 0) {
        echo '<h3 style = "text-align : center;">Email / Password Salah</h3>';
    } else {
        $sql = "SELECT * FROM tblpelanggan WHERE email = '$email' AND password = '$password'";
        $row = $db->getItem($sql);

        $_SESSION['pelanggan'] = $row['email'];
        $_SESSION['idpelanggan'] = $row['idpelanggan'];

        header("location:index.php");
    }
}
