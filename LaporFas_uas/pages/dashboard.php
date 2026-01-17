<?php


if(!defined('MY_APP')) {
    die('Akses langsung tidak diperbolehkan!');
}


$qLaporan = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM reports");
$totalLaporan = mysqli_fetch_assoc($qLaporan)['total'];


$qFasilitas = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM facilities");
$totalFasilitas = mysqli_fetch_assoc($qFasilitas)['total'];


$qMenunggu = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM reports WHERE status='menunggu'");
$totalMenunggu = mysqli_fetch_assoc($qMenunggu)['total'];
?>


<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <div class="row">
      
        <div class="col-xl-4 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="h2 font-weight-bold"><?= $totalLaporan ?></div>
                            <div class="text-uppercase font-weight-bold small">Total Laporan</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="h2 font-weight-bold"><?= $totalFasilitas ?></div>
                            <div class="text-uppercase font-weight-bold small">Total Fasilitas</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       
        <div class="col-xl-4 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="h2 font-weight-bold"><?= $totalMenunggu ?></div>
                            <div class="text-uppercase font-weight-bold small">Laporan Menunggu</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Laporan Terbaru
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Fasilitas</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $data = mysqli_query($koneksi, "
                    SELECT r.*, f.nama_fasilitas 
                    FROM reports r
                    JOIN facilities f ON r.facility_id = f.id
                    ORDER BY r.tanggal DESC
                ");

                while($row = mysqli_fetch_assoc($data)) {
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama_fasilitas']) ?></td>
                        <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                        <td>
                            <span class="badge 
                                <?= $row['status']=='menunggu'?'bg-warning':
                                    ($row['status']=='diproses'?'bg-info':'bg-success') ?>">
                                <?= ucfirst($row['status']) ?>
                            </span>
                        </td>
                        <td><?= $row['tanggal'] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
