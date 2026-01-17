<?php
header("Content-Type: application/json");
include "config.php";

$sql = "
    SELECT 
        r.id,
        r.nama_pelapor,
        f.nama_fasilitas,
        r.deskripsi,
        r.tanggal,
        r.status
    FROM reports r
    JOIN facilities f ON r.facility_id = f.id
    ORDER BY r.tanggal DESC
";

$query = mysqli_query($koneksi, $sql);

$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

echo json_encode([
    "status" => true,
    "data" => $data
]);

