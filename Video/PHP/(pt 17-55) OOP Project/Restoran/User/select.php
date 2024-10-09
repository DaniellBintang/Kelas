<?php

$jumlahdata = $db->rowCount('SELECT iduser FROM tbluser');

$banyak = 4;

$halaman = ceil($jumlahdata / $banyak);

if (isset($_GET['p'])) {
    $p = $_GET['p'];
    $mulai = ($p * $banyak) - $banyak;
} else {
    $mulai = 0;
}

$sql = "SELECT * FROM tbluser ORDER BY user ASC LIMIT $mulai, $banyak";
$row = $db->getAll($sql);

$no = 1 + $mulai;

?>

<div class="float-left mr-4">
    <a class="btn btn-primary" href="?f=User&m=insert" role="button">Tambah Data</a>
</div>
<h3>User</h3>
<table style="text-align: center;" class="table table-bordered w-70">
    <thead>
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Email</th>
            <th>Level</th>
            <th>Delete</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($row as $r) : ?>
            <?php
            if ($r['aktif'] == 1) {
                $status = "AKTIF";
            } else {
                $status = "BANNED";
            }
            ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $r['user'] ?></td>
                <td><?php echo $r['email'] ?></td>
                <td><?php echo $r['level'] ?></td>
                <td> <a href="?f=User&m=delete&id=<?php echo $r['iduser'] ?>">Delete</a></td>
                <td> <a href="?f=User&m=update&id=<?php echo $r['iduser'] ?>"><?php echo $status; ?></a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?php

for ($i = 1; $i <= $halaman; $i++) {
    echo '<a href ="?f=User&m=select&p=' . $i . '">' . $i . '</a>';
    echo '&nbsp &nbsp &nbsp';
}

?>