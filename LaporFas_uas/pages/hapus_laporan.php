<?php
if (!defined('MY_APP')) die('Akses ditolak!');


if (!isset($_GET['id'])) {
    header("Location: index.php?hal=daftar_laporan&msg=error");
    exit;
}

$id = (int) $_GET['id'];


$hapus = mysqli_query($koneksi, "DELETE FROM reports WHERE id=$id");

if ($hapus) {
    
    header("Location: index.php?hal=daftar_laporan&msg=success");
    exit;
} else {
    
    header("Location: index.php?hal=daftar_laporan&msg=error");
    exit;
}
