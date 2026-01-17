<?php
if (!defined('MY_APP')) {
    die('Akses langsung tidak diperbolehkan!');
}


$query = mysqli_query($koneksi, "SELECT * FROM facilities ORDER BY id DESC");

if (!$query) {
    die(mysqli_error($koneksi));
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Data Fasilitas</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Fasilitas</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">


                <a href="pages/cetak_fasilitas.php" target="_blank" class="btn btn-success btn-sm float-end me-2">
    <i class="fas fa-print"></i> Cetak Laporan
</a>


            <i class="fas fa-building me-1"></i>
            Daftar Fasilitas
            <a href="index.php?hal=tambah_fasilitas" class="btn btn-primary btn-sm float-end">
                + Tambah Fasilitas
            </a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped" id="datatablesSimple">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Fasilitas</th>
                        <th>Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($query)) {
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama_fasilitas']) ?></td>
                        <td><?= htmlspecialchars($row['lokasi']) ?></td>
                        <td width="160">
                            <a href="index.php?hal=edit_fasilitas&id=<?= $row['id'] ?>" 
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>
                            <a href="index.php?hal=hapus_fasilitas&id=<?= $row['id'] ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin ingin menghapus data ini?')">
                                Hapus
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
