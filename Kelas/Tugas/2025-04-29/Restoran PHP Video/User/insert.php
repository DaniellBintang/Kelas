<h3>Insert User</h3>
<div class="form-group">

    <form action="" method="post">
        <div class="form-group w-50">
            <label for="">Nama User</label>
            <input type="text" name="user" required placeholder="Isi User" class="form-control">
        </div>
        <div class="form-group w-50">
            <label for="">Email</label>
            <input type="email" name="email" required placeholder="Masukan Email" class="form-control">
        </div>
        <div class="form-group w-50">
            <label for="">Password</label>
            <input type="password" name="password" required placeholder="Masukan Password" class="form-control">
        </div>
        <div class="form-group w-50">
            <label for="">Konfirmasi Password</label>
            <input type="password" name="konfirmasi" required placeholder="Masukan Password Kembali" class="form-control">
        </div>
        <div class="form-group w-50">
            <label for="">Level</label> <br>
            <select name="level" id="">
                <option value="admin">Admin</option>
                <option value="koki">Koki</option>
                <option value="kasir">Kasir</option>
            </select>
        </div>
        <div>

            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

        </div>

    </form>
</div>

<?php

if (isset($_POST['simpan'])) {
    $user = $_POST['user'];
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']);
    $konfirmasi = hash('sha256', $_POST['konfirmasi']);
    $level = $_POST['level'];

    if ($password === $konfirmasi) {
        $sql = "INSERT INTO tbluser VALUES ('', '$user', '$email', '$password', '$level', 1)";
        $db->runSql($sql);
        header('location:?f=User&m=select');
    } else {
        echo '<h2>Password Tidak Sama</h2>';
    }
}

?>