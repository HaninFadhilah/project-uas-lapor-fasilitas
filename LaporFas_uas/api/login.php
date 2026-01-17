<?php
header("Content-Type: application/json");
include "../includes/config.php";

$username = $_POST['username'] ?? '';
$password = md5($_POST['password'] ?? '');

if ($username == '' || $password == '') {
    echo json_encode([
        "success" => false,
        "message" => "Username dan password wajib diisi"
    ]);
    exit;
}

$query = mysqli_query($koneksi, "
    SELECT id_admin, username, nama_lengkap 
    FROM admin
    WHERE (username='$username' OR email='$username')
    AND password='$password'
    LIMIT 1
");

if (mysqli_num_rows($query) > 0) {
    $admin = mysqli_fetch_assoc($query);

    echo json_encode([
        "success" => true,
        "id_admin" => $admin['id_admin'],
        "username" => $admin['username'],
        "nama_lengkap" => $admin['nama_lengkap'],
        "role" => "admin"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Login gagal"
    ]);
}

