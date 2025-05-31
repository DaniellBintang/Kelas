<h3>Insert Kategori</h3>
<div class="form-group">

    <form action="" method="post">
        <div class="form-group w-50">
            <label for="">Kategori</label>
            <input type="text" name="Kategori" required placeholder="Isi Kategori" class="form-control">
        </div>
        <div>

            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

        </div>

    </form>
</div>

<?php

if (isset($_POST['simpan'])) {
    $kategori = $_POST['Kategori'];

    $sql = "INSERT INTO tblkategori VALUES ('', '$kategori')";

    $db->runSql($sql);

    header('location:?f=Kategori&m=select');
}

?>