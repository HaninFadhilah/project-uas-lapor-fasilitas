<?php
if (!defined('MY_APP')) {
    die('Akses langsung tidak diperbolehkan!');
}

if (isset($_POST['simpan'])) {
    $nama   = mysqli_real_escape_string($koneksi, $_POST['nama_fasilitas']);
    $lokasi = mysqli_real_escape_string($koneksi, $_POST['lokasi']);

    $insert = mysqli_query($koneksi, "
        INSERT INTO facilities (nama_fasilitas, lokasi)
        VALUES ('$nama', '$lokasi')
    ");

    if ($insert) {
        echo "<script>
            alert('Fasilitas berhasil ditambahkan');
            window.location='index.php?hal=daftar_fasilitas';

        </script>";
        exit;
    } else {
        echo "<div class='alert alert-danger'>Gagal menambah fasilitas</div>";
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Fasilitas</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php?hal=fasilitas">Fasilitas</a></li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>

    <div class="card">
        <div class="card-body">
            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Nama Fasilitas</label>
                    <input type="text" name="nama_fasilitas" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" required>
                </div>

                <button type="submit" name="simpan" class="btn btn-primary">
                    Simpan
                </button>
                <a href="index.php?hal=fasilitas" class="btn btn-secondary">
                    Kembali
                </a>

            </form>
        </div>
    </div>
</div>
