<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<?php
require 'barang.php';

echo "<br>";

$barang = new Barang("localhost", "root", "", "dbgpt");

// Menangani form tambah/ubah data
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $nama_barang = $_POST["nama_barang"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];

    // Upload file gambar jika ada
    $gambar = $_FILES["gambar"]["name"];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($gambar);

    if ($gambar) {
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
    }

    if ($id) {
        // Update data menggunakan method edit
        $update_gambar = $gambar ? $target_file : null; // Gunakan gambar baru jika diunggah
        if ($barang->update($id, $nama_barang, $harga, $stok, $update_gambar)) {
            echo "Barang berhasil diubah!<br>";
        } else {
            echo "Gagal mengubah barang.<br>";
        }
    } else {
        // Tambah data baru
        if ($barang->create($nama_barang, $harga, $stok, $target_file)) {
            echo "Barang berhasil ditambahkan!<br>";
        } else {
            echo "Gagal menambahkan barang.<br>";
        }
    }
}

// Menangani penghapusan data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if ($barang->delete($id)) {
        echo "Barang berhasil dihapus!<br>";
    } else {
        echo "Gagal menghapus barang.<br>";
    }
}

// Menampilkan isi tabel barang
$data = $barang->read();

if (empty($data)) {
    // Redirect ke index.html jika tidak ada data
    header("Location:../index.html");
    exit(); // Pastikan script berhenti setelah redirect
} else {
?>
    <h2 class="head">Daftar Barang</h2>
    <table class="tcenter" border='1' cellpadding='10' cellspacing='0'>
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>


        <?php
        foreach ($data as $row) {
        ?>

            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nama_barang'] ?></td>
                <td><?= $row['harga'] ?></td>
                <td><?= $row['stok'] ?></td>
                <td><img class="border" src="<?= $row['gambar'] ?>" alt="<?= $row['nama_barang'] ?>" width='100'></td>
                <td>
                    <a class="action" href='?edit=<?= $row['id'] ?>'>Ubah</a> /
                    <a class="action" href='?delete=<?= $row['id'] ?>' onclick='return confirm(\"Yakin ingin menghapus barang ini?"\)'>Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php } ?>

<?php
// Menampilkan form tambah/ubah data
$update = isset($_GET['edit']) ? $_GET['edit'] : null;

if ($update) {
    $barang_update = array_filter($data, fn($row) => $row['id'] == $update); // Cari data barang berdasarkan ID
    $barang_update = reset($barang_update); // Ambil elemen pertama dari array hasil filter
    if ($barang_update) {
        echo "<h2 class='head' >Ubah Barang</h2>";
    }
} else {
    $barang_update = null;
    echo "<h2 class='head' >Tambah Barang</h2>";
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $barang_update['id'] ?? ''; ?>">
    <label for="nama_barang">Nama Barang:</label><br>
    <input class="center" type="text" name="nama_barang" id="nama_barang" value="<?php echo $barang_update['nama_barang'] ?? ''; ?>" required><br>
    <label for="harga">Harga:</label><br>
    <input class="center" type="number" name="harga" id="harga" value="<?php echo $barang_update['harga'] ?? ''; ?>" required><br>
    <label for="stok">Stok:</label><br>
    <input class="center" type="number" name="stok" id="stok" value="<?php echo $barang_update['stok'] ?? ''; ?>" required><br>
    <label for="gambar">Gambar:</label><br>
    <?php if (!empty($barang_update['gambar'])): ?>
        <div class="images">
            <img class="center border" width="200" src="<?php echo $barang_update['gambar']; ?>" alt="Gambar"><br>
        </div>
    <?php endif; ?>
    <input class="center" type="file" name="gambar" id="gambar"><br><br>
    <div class="button center">
        <button type="submit"><?php echo $update ? 'Ubah' : 'Tambah'; ?></button>
    </div>
</form>

<a href="../index.html" class="back-button"><img src="uploads/home.png" width="40" alt=""></a>

</html>