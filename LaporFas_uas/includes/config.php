<?php
$koneksi = mysqli_connect("localhost", "root", "", "uas_2411500033");

if (!$koneksi) {
    die("Koneksi database gagal!");
}

