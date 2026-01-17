<?php
header("Content-Type: application/json");
include "config.php";

$sql = "SELECT id, nama_fasilitas, lokasi FROM facilities";
$query = mysqli_query($koneksi, $sql);

if (!$query) {
    echo json_encode([
        "status" => false,
        "error" => mysqli_error($koneksi)
    ]);
    exit;
}


$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

echo json_encode([
    "status" => true,
    "data" => $data
]);
