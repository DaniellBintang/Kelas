<h3>Detail Pembelian</h3>

<div class="form-group">

    <form action="" method="post">
        <div class="form-group w-50 float-left">
            <label for="">Tanggal Awal</label>
            <input type="date" name="dawal" required class="form-control">
        </div>
        <div class="form-group w-50 float-left">
            <label for="">Tanggal Akhir</label>
            <input type="date" name="dakhir" required class="form-control">
        </div>
        <div>

            <input type="submit" name="simpan" value="Cari" class="btn btn-primary">

        </div>

    </form>
</div>

<?php


$jumlahdata = $db->rowCount("SELECT idorderdetail FROM vorderdetail");

$banyak = 3;

$halaman = ceil($jumlahdata / $banyak);

if (isset($_GET['p'])) {
    $p = $_GET['p'];
    $mulai = ($p * $banyak) - $banyak;
} else {
    $mulai = 0;
}

$sql = "SELECT * FROM vorderdetail ORDER BY idorderdetail DESC LIMIT $mulai, $banyak";
$row = $db->getAll($sql);

if (isset($_POST['simpan'])) {
    $dawal = $_POST['dawal'];
    $dakhir = $_POST['dakhir'];
    $sql = "SELECT * FROM vorderdetail WHERE tglorder BETWEEN '$dawal' AND '$dakhir' ";
}

$no = 1 + $mulai;

$total = 0;

?>

<table class="table table-bordered w-70">
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Menu</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($row)) { ?>
            <?php foreach ($row as $r) : ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $r['pelanggan'] ?></td>
                    <td><?php echo $r['tglorder'] ?></td>
                    <td><?php echo $r['menu'] ?></td>
                    <td><?php echo $r['harga'] ?></td>
                    <td><?php echo $r['jumlah'] ?></td>
                    <td><?php echo $r['jumlah'] * $r['harga'] ?></td>
                    <td><?php echo $r['alamat'] ?></td>
                    <?php
                    $total = $total + ($r['jumlah'] * $r['harga']);
                    ?>
                </tr>
            <?php endforeach ?>
        <?php } ?>
        <tr>
            <td colspan="6">
                <h3>Grand Total :</h3>
            </td>
            <td colspan="2">
                <h4>Rp. <?php echo $total ?></h4>
            </td>
        </tr>
    </tbody>
</table>

<?php

for ($i = 1; $i <= $halaman; $i++) {
    echo '<a href ="?f=OrderDetail&m=select&p=' . $i . '">' . $i . '</a>';
    echo '&nbsp &nbsp &nbsp';
}

?>