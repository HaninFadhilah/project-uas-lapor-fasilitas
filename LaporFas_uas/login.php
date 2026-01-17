<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "includes/config.php";


if (isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}

$error = '';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = md5($_POST['password']);

    $query = mysqli_query($koneksi, "
        SELECT * FROM admin 
        WHERE username='$username' OR email='$username'
        LIMIT 1
    ");

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);

        if ($data['password'] == $password) {
            $_SESSION['admin_id'] = $data['id_admin'];
            $_SESSION['nama_admin'] = $data['nama_lengkap'];
            $_SESSION['admin_logged_in'] = true;

            header("Location: index.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username / Email tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-4">

            <div class="card shadow">
                <div class="card-header text-center">
                    <h4>Login Admin</h4>
                </div>

                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <form method="post">
                        <div class="mb-3">
                            <label>Username / Email</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" name="login" class="btn btn-primary w-100">
                            Login
                        </button>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

</body>
</html>
