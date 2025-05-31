<?php

require_once "../function.php";

$sql = "SELECT * FROM tblkategori WHERE idkategori = $id";
$result = mysqli_query($koneksi, $sql);

$row = mysqli_fetch_assoc($result);

// $kategori = 'Jelly Bean';
// $id = 14;
// $sql = "UPDATE tblkategori SET kategori='$kategori' WHERE idkategori=$id";

// $result = mysqli_query($koneksi, $sql);

// echo $sql;

?>

<form action="" method="post">
    Kategori :
    <input type="text" name="kategori" value="<?php echo $row['kategori'] ?>">
    <br>
    <input type="submit" name="simpan" value="Simpan">
</form>

<?php

if (isset($_POST['simpan'])) {
    $kategori = $_POST['kategori'];
    $sql = "UPDATE tblkategori SET kategori='$kategori' WHERE idkategori=$id";

    $result = mysqli_query($koneksi, $sql);

    header("location:http://localhost/(pt%2017-22)/Restoran/Kategori/select.php");
}

?>