<?php
include "../includes/config.php";


$query = mysqli_query($koneksi, "
    SELECT *
    FROM facilities
    ORDER BY id DESC
");

if (!$query) {
    die("Query error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Data Fasilitas</title>

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

<h2>DATA FASILITAS</h2>
<p>Dicetak pada: <?= date('d-m-Y') ?></p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Fasilitas</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama_fasilitas']) ?></td>
                        <td><?= htmlspecialchars($row['lokasi']) ?></td>
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
