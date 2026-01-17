<?php
include "../includes/config.php";


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
    die("Query error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan</title>

    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; margin-bottom: 5px; }
        p { text-align: center; margin-top: 0; margin-bottom: 20px; }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th {
            background: #f2f2f2;
            text-align: center;
        }
        th, td {
            padding: 8px;
        }
        .text-center { text-align: center; }

        .ttd {
            margin-top: 50px;
            width: 100%;
        }
        .ttd div {
            width: 30%;
            float: right;
            text-align: center;
        }

        @media print {
            button { display: none; }
        }
    </style>
</head>

<body>

<button onclick="window.print()">🖨 Cetak</button>

<h2>LAPORAN PENGADUAN FASILITAS</h2>
<p>Dicetak pada: <?= date('d-m-Y') ?></p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Fasilitas</th>
            <th>Deskripsi</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama_fasilitas'] ?? '-') ?></td>
            <td><?= htmlspecialchars($row['lokasi'] ?? '-') ?></td>
            <td><?= htmlspecialchars($row['deskripsi']) ?></td>
            <td class="text-center"><?= htmlspecialchars($row['status']) ?></td>
            <td class="text-center">
                <?= date('d-m-Y', strtotime($row['tanggal'])) ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<div class="ttd">
    <div>
        <p><?= date('d F Y') ?></p>
        <p>Admin</p>
        <br><br><br>
        <p><b>( __________________ )</b></p>
    </div>
</div>

</body>
</html>
