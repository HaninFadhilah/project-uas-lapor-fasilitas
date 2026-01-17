<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
include "config.php";

$facility_id = $_POST['facility_id'] ?? null;
$deskripsi   = $_POST['deskripsi'] ?? null;

if (!$facility_id || !$deskripsi) {
    echo json_encode([
        "status" => false,
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

$sql = "INSERT INTO reports (facility_id, deskripsi, status, tanggal)
        VALUES (?, ?, 'menunggu', NOW())";

$stmt = $koneksi->prepare($sql);
$stmt->bind_param("is", $facility_id, $deskripsi);

if ($stmt->execute()) {
    echo json_encode([
        "status" => true,
        "message" => "Laporan berhasil dikirim"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => $stmt->error
    ]);
}

