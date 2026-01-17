<?php
if (!defined('MY_APP')) {
    die('Akses ditolak!');
}

$id     = (int) $_GET['id'];
$status = $_GET['status'];

$allowed = ['menunggu','diproses','selesai'];
if (!in_array($status, $allowed)) {
    die('Status tidak valid');
}

$update = mysqli_query($koneksi, "
    UPDATE reports SET status = '$status' WHERE id = $id
");


if ($update) {
    echo "<script>
        window.location='index.php?hal=daftar_laporan';
    </script>";
    exit;
} else {
    die(mysqli_error($koneksi));
}
