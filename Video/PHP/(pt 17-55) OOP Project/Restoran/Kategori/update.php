<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM tblkategori WHERE idkategori = $id";

    $row = $db->getItem($sql);
}

?>

<h3>Update Kategori</h3>
<div class="form-group">

    <form action="" method="post">
        <div class="form-group w-50">
            <label for="">Kategori</label>
            <input type="text" name="Kategori" required value="<?php echo $row['kategori'] ?>" class="form-control">
        </div>
        <div>

            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

        </div>

    </form>
</div>

<?php

if (isset($_POST['simpan'])) {
    $kategori = $_POST['Kategori'];

    $sql = "UPDATE tblkategori SET kategori = '$kategori' WHERE idkategori = $id";

    echo $sql;

    $db->runSql($sql);

    header('location:?f=Kategori&m=select');
}

?>