<?php
if (!defined('MY_APP')) {
    die('Akses langsung tidak diperbolehkan!');
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;


$laporan = mysqli_query($koneksi, "
    SELECT * FROM reports WHERE id = $id
");

$data = mysqli_fetch_assoc($laporan);
if (!$data) {
    echo "<div class='alert alert-danger'>Data tidak ditemukan</div>";
    exit;
}


$fasilitas = mysqli_query($koneksi, "SELECT * FROM facilities");


if (isset($_POST['update'])) {
    $facility_id = (int) $_POST['facility_id'];
    $deskripsi   = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $status      = $_POST['status'];

    $update = mysqli_query($koneksi, "
        UPDATE reports SET
            facility_id = $facility_id,
            deskripsi   = '$deskripsi',
            status      = '$status'
        WHERE id = $id
    ");

    if ($update) {
        echo "<script>
            alert('Laporan berhasil diubah');
            window.location='index.php?hal=laporan';
        </script>";
        exit;
    } else {
        die(mysqli_error($koneksi));
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Ubah Laporan</h1>

    <div class="card">
        <div class="card-body">
            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Fasilitas</label>
                    <select name="facility_id" class="form-control" required>
                        <?php while ($f = mysqli_fetch_assoc($fasilitas)) { ?>
                            <option value="<?= $f['id'] ?>"
                                <?= $f['id'] == $data['facility_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($f['nama_fasilitas']) ?> - 
                                <?= htmlspecialchars($f['lokasi']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4" required><?= htmlspecialchars($data['deskripsi']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="menunggu" <?= $data['status']=='menunggu'?'selected':'' ?>>Menunggu</option>
                        <option value="diproses" <?= $data['status']=='diproses'?'selected':'' ?>>Diproses</option>
                        <option value="selesai" <?= $data['status']=='selesai'?'selected':'' ?>>Selesai</option>
                    </select>
                </div>

                <button type="submit" name="update" class="btn btn-primary">
                    Simpan Perubahan
                </button>
                <a href="index.php?hal=laporan" class="btn btn-secondary">
                    Kembali
                </a>

            </form>
        </div>
    </div>
</div>
