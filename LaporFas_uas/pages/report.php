<?php
if (!defined('MY_APP')) {
    die('Akses langsung tidak diperbolehkan!');
}


$query = mysqli_query($koneksi, "
    SELECT 
        r.id,
        r.deskripsi,
        r.status,
        r.tanggal,
        f.nama_fasilitas,
        f.lokasi,
        a.nama_lengkap AS nama_admin
    FROM reports r
    LEFT JOIN facilities f ON r.facility_id = f.id
    LEFT JOIN admin a ON r.admin_id = a.id_admin
    ORDER BY r.tanggal DESC
");

if (!$query) {
    die(mysqli_error($koneksi));
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Daftar Laporan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Laporan</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-file-alt me-1"></i>
            Data Laporan
            <a href="index.php?hal=tambah_laporan" class="btn btn-primary btn-sm float-end">
                + Tambah Laporan
            </a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped" id="datatablesSimple">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Fasilitas</th>
                        <th>Lokasi</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Admin</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama_fasilitas'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['lokasi'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                        <td>
                            <span class="badge 
                                <?= $row['status']=='menunggu' ? 'bg-danger' :
                                    ($row['status']=='diproses' ? 'bg-warning' : 'bg-success') ?>">
                                <?= ucfirst($row['status']) ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($row['nama_admin'] ?? '-') ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($row['tanggal'])) ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
