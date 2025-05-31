<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $where = "WHERE idkategori = $id";

    $id = "AND idkategori = $id";
} else {
    $where = "";
    $id = "";
}

$jumlahdata = $db->rowCOUNT("SELECT idmenu FROM tblmenu $where");
$banyak = 3;

$halaman = ceil($jumlahdata / $banyak);

if (isset($_GET['p'])) {
    $p = $_GET['p'];
    $mulai = ($p * $banyak) - $banyak;
} else {
    $mulai = 0;
}

$sql = "SELECT * FROM tblmenu $where ORDER BY menu ASC LIMIT $mulai,$banyak";
$row = $db->getALL($sql);

$no = 1 + $mulai;
?>

<h3>Menu</h3>

<div class="mt-4 mb-4">
    <?php
    for ($i = 1; $i <= $halaman; $i++) {
        echo '<a href="?f=Home&m=produk&p=' . $i . '">' . $i . '</a>';
        echo '&nbsp &nbsp &nbsp';
    }
    ?>
</div>

<!-- Mengubah tampilan produk menggunakan card Bootstrap -->
<div class="row g-4">
    <?php if (!empty($row)) { ?>
        <?php foreach ($row as $r) : ?>
            <div class="col-md-4">
                <div class="card">
                   <div class="card-img-container" style="height: 300px; overflow: hidden;">
                        <img src="Upload/<?php echo $r['gambar'] ?>" class="card-img-top" style="object-fit: cover; width: 100%; height: 100%;" alt="<?php echo $r['menu'] ?>">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $r['menu'] ?></h5>
                        <p class="card-text">Rp. <?php echo number_format($r['harga']); ?></p>
                        <a class="btn btn-primary" href="?f=Home&m=beli&id=<?php echo $r['idmenu'] ?>">Beli</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    <?php } ?>
</div>