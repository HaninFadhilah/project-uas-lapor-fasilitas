<?php
if (!defined('MY_APP')) {
    die('Akses langsung tidak diperbolehkan!');
}


if (!isset($_GET['id'])) {
    echo "<script>
        alert('ID fasilitas tidak ditemukan');
        window.location='index.php?hal=daftar_fasilitas';
    </script>";
    exit;
}

$id = (int) $_GET['id'];


$hapus = mysqli_query($koneksi, "DELETE FROM facilities WHERE id = $id");

if ($hapus) {
    echo "<script>
        alert('Fasilitas berhasil dihapus');
        window.location='index.php?hal=daftar_fasilitas';
    </script>";
} else {
    echo "<script>
        alert('Gagal menghapus fasilitas');
        window.location='index.php?hal=daftar_fasilitas';
    </script>";
}
