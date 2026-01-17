<?php
if (!defined('MY_APP')) {
    die('Akses langsung tidak diizinkan!');
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Daftar Laporan</h1>

    <div class="card mb-4">
        <div class="card-header"> <a href="pages/cetak_laporan.php" target="_blank" class="btn btn-success btn-sm float-end me-2">
    <i class="fas fa-print"></i> Cetak Laporan
</a>

            Data Laporan Fasilitas
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Pelapor</th>
                        <th>Fasilitas</th>
                        <th>Deskripsi</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                $no = 1;
                $query = mysqli_query($koneksi, "
                    SELECT r.*, f.nama_fasilitas
                    FROM reports r
                    JOIN facilities f ON r.facility_id = f.id
                    ORDER BY r.tanggal DESC
                ");

                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nama_pelapor']); ?></td>
                        <td><?= htmlspecialchars($row['nama_fasilitas']); ?></td>
                        <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                        <td><?= $row['tanggal']; ?></td>

                        
                        <td>
                            <?php
                            if ($row['status'] == 'menunggu') {
                                echo "<span class='badge bg-secondary'>Menunggu</span>";
                            } elseif ($row['status'] == 'diproses') {
                                echo "<span class='badge bg-warning text-dark'>Diproses</span>";
                            } else {
                                echo "<span class='badge bg-success'>Selesai</span>";
                            }
                            ?>
                        </td>

                        
                        <td>
                            <?php if ($row['status'] != 'selesai') { ?>
                                <a href="index.php?hal=ubah_status&id=<?= $row['id']; ?>&status=diproses"
                                   class="btn btn-warning btn-sm mb-1">
                                   Proses
                                </a>

                                <a href="index.php?hal=ubah_status&id=<?= $row['id']; ?>&status=selesai"
                                   class="btn btn-success btn-sm mb-1">
                                   Selesai
                                </a>
                            <?php } ?>

                            <a href="index.php?hal=hapus_laporan&id=<?= $row['id']; ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin ingin menghapus laporan ini?')">
                               Hapus
                            </a>
                        </td>
                    </tr>
                <?php
                    }
                } else {
                    echo "<tr>
                        <td colspan='7' class='text-center'>Data laporan belum ada</td>
                    </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
