<?php
if (!defined('MY_APP')) {
    die('Akses langsung tidak diperbolehkan!');
}




$query = mysqli_query($koneksi, "SELECT * FROM facilities");
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Data Fasilitas</h1>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-building me-1"></i>
            Daftar Fasilitas
            <a href="index.php?hal=tambah_fasilitas" class="btn btn-primary btn-sm float-end">
                + Tambah Fasilitas
            </a>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Fasilitas</th>
                        <th>Lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while($row = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama_fasilitas']) ?></td>
                        <td><?= htmlspecialchars($row['lokasi']) ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
