<?php
if (!defined('MY_APP')) {
    die('Akses langsung tidak diperbolehkan!');
}


if (!isset($_GET['id'])) {
    echo "<script>
            alert('ID fasilitas tidak ditemukan'); 
            window.location='index.php?hal=daftar_fasilitas';
          </script>";
    exit;
}

$id = (int) $_GET['id'];


$result = mysqli_query($koneksi, "SELECT * FROM facilities WHERE id = $id");

if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}

$fasilitas = mysqli_fetch_assoc($result);

if (!$fasilitas) {
    echo "<script>
            alert('Fasilitas tidak ditemukan'); 
            window.location='index.php?hal=daftar_fasilitas';
          </script>";
    exit;
}


$nama_fasilitas = $fasilitas['nama_fasilitas'] ?? '';
$lokasi = $fasilitas['lokasi'] ?? '';


if (isset($_POST['update'])) {
    $nama_fasilitas = mysqli_real_escape_string($koneksi, $_POST['nama_fasilitas']);
    $lokasi = mysqli_real_escape_string($koneksi, $_POST['lokasi']);

    $query = "UPDATE facilities 
              SET nama_fasilitas='$nama_fasilitas', lokasi='$lokasi' 
              WHERE id=$id";
    $update = mysqli_query($koneksi, $query);

    if ($update) {
        echo "<script>
                alert('Fasilitas berhasil diupdate'); 
                window.location='index.php?hal=daftar_fasilitas';
              </script>";
        exit;
    } else {
        echo "<div style='color:red;'>
                Gagal mengupdate fasilitas.<br>
                Query: $query<br>
                Error MySQL: " . mysqli_error($koneksi) . "
              </div>";
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Fasilitas</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php?hal=daftar_fasilitas">Fasilitas</a></li>
        <li class="breadcrumb-item active">Edit Fasilitas</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            Form Edit Fasilitas
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="nama_fasilitas" class="form-label">Nama Fasilitas:</label>
                    <input type="text" 
                           id="nama_fasilitas" 
                           name="nama_fasilitas" 
                           class="form-control" 
                           value="<?php echo htmlspecialchars($nama_fasilitas); ?>" 
                           required>
                </div>

                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi:</label>
                    <input type="text" 
                           id="lokasi" 
                           name="lokasi" 
                           class="form-control" 
                           value="<?php echo htmlspecialchars($lokasi); ?>" 
                           required>
                </div>

                <button type="submit" name="update" class="btn btn-success">Update Fasilitas</button>
                <a href="index.php?hal=daftar_fasilitas" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
