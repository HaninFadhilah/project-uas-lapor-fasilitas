<?php
header("Content-Type: application/json");
include "../includes/config.php";

$facility_id = $_POST['facility_id'] ?? null;
$deskripsi   = $_POST['deskripsi'] ?? null;

if (!$facility_id || !$deskripsi) {
    echo json_encode([
        "success" => false,
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

$sql = "INSERT INTO reports (facility_id, deskripsi, status, tanggal)
        VALUES (?, ?, 'menunggu', NOW())";

$stmt = $koneksi->prepare($sql);

if (!$stmt) {
    echo json_encode([
        "success" => false,
        "message" => $koneksi->error
    ]);
    exit;
}

$stmt->bind_param("is", $facility_id, $deskripsi);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Laporan berhasil ditambahkan"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Gagal menyimpan laporan"
    ]);
}

$stmt->close();

