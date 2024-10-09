<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM tblkategori WHERE idkategori = $id";

    $db->runSql($sql);

    header('location:?f=Kategori&m=select');
}
