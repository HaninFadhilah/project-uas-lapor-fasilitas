<?php
if (!defined('MY_APP')) {
    die('Akses langsung tidak diperbolehkan!');
}

$admin_id = $_SESSION['admin_id'];

$admin = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT nama_lengkap FROM admin WHERE id_admin = $admin_id")
);

$fasilitas = mysqli_query($koneksi, "SELECT * FROM facilities");

if (isset($_POST['simpan'])) {
    $facility_id   = (int) $_POST['facility_id'];
    $deskripsi     = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $nama_pelapor  = mysqli_real_escape_string($koneksi, $admin['nama_lengkap']);

    $insert = mysqli_query($koneksi, "
        INSERT INTO reports 
        (nama_pelapor, admin_id, facility_id, deskripsi, status, tanggal)
        VALUES 
        ('$nama_pelapor', $admin_id, $facility_id, '$deskripsi', 'menunggu', NOW())
    ");

    if ($insert) {
        echo "<script>
            alert('Laporan berhasil ditambahkan');
            window.location='index.php?hal=daftar_laporan';
        </script>";
        exit;
    } else {
        die(mysqli_error($koneksi));
    }
}
?>


<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Laporan</h1>

    <div class="card">
        <div class="card-body">
            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Nama Pelapor</label>
                    <input type="text" class="form-control"
                           value="<?= htmlspecialchars($admin['nama_lengkap']); ?>"
                           readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fasilitas</label>
                    <select name="facility_id" class="form-control" required>
                        <option value="">-- Pilih Fasilitas --</option>
                        <?php while ($f = mysqli_fetch_assoc($fasilitas)) { ?>
                            <option value="<?= $f['id'] ?>">
                                <?= htmlspecialchars($f['nama_fasilitas']) ?> - <?= htmlspecialchars($f['lokasi']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Kerusakan</label>
                    <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
                </div>

                <button type="submit" name="simpan" class="btn btn-primary">
                    Simpan
                </button>
                <a href="index.php?hal=daftar_laporan" class="btn btn-secondary">
                    Kembali
                </a>

            </form>
        </div>
    </div>
</div>
