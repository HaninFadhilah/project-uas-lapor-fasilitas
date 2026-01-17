<?php

ob_start();            
session_start();
define('MY_APP', true);
include "includes/config.php";


$page = $_GET['hal'] ?? 'dashboard';
$file = "pages/$page.php";


$flash_msg = $_GET['msg'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
    <?php include "includes/header.php"; ?>

    <body class="sb-nav-fixed">
        <?php include "includes/nav.php"; ?>

        <div id="layoutSidenav">
            <?php include "includes/sidebar.php"; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <?php
                        
                        if ($flash_msg == 'success') {
                            echo '<div class="alert alert-success">Aksi berhasil dilakukan!</div>';
                        } elseif ($flash_msg == 'error') {
                            echo '<div class="alert alert-danger">Terjadi kesalahan!</div>';
                        }

                       
                        if (file_exists($file)) {
                            include $file;
                        } else {
                            echo "<h1 class='text-center mt-5'>Halaman tidak ditemukan!</h1>";
                        }
                        ?>
                    </div>
                </main>
                <?php include "includes/footer.php"; ?>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/datatables-simple-demo.js"></script>
    </body>
</html>

<?php

ob_end_flush();
?>
