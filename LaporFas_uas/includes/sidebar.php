<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link <?= ($page == "dashboard") ? 'active' : ''; ?>" 
                   href="index.php?hal=dashboard">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    Dashboard
                </a>

                <!-- MANAJEMEN DATA -->
                <div class="sb-sidenav-menu-heading">Manajemen</div>

                <!-- DATA FASILITAS -->
                <a class="nav-link <?= in_array($page, ['daftar_fasilitas','tambah_fasilitas']) ? 'active' : 'collapsed'; ?>" 
                    href="#" data-bs-toggle="collapse" data-bs-target="#collapseFasilitas"
                    aria-expanded="false" aria-controls="collapseFasilitas">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        Fasilitas
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>

                    <div class="collapse <?= in_array($page, ['daftar_fasilitas','tambah_fasilitas']) ? 'show' : ''; ?>" 
                        id="collapseFasilitas" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">

                            <a class="nav-link <?= ($page == "daftar_fasilitas") ? 'active' : ''; ?>" 
                            href="index.php?hal=daftar_fasilitas">
                                Daftar Fasilitas
                            </a>

                            <a class="nav-link <?= ($page == "tambah_fasilitas") ? 'active' : ''; ?>" 
                            href="index.php?hal=tambah_fasilitas">
                                Tambah Fasilitas
                            </a>

                        </nav>
                    </div>

                <!-- LAPORAN -->
                <a class="nav-link <?= in_array($page, ['daftar_laporan','detail_laporan']) ? 'active' : 'collapsed'; ?>" 
                   href="#" data-bs-toggle="collapse" data-bs-target="#collapseLaporan"
                   aria-expanded="false" aria-controls="collapseLaporan">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    Laporan
                    <div class="sb-sidenav-collapse-arrow">
                        <i class="fas fa-angle-down"></i>
                    </div>
                </a>

                

                <div class="collapse <?= in_array($page, ['daftar_laporan','detail_laporan']) ? 'show' : ''; ?>" 
                     id="collapseLaporan" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= ($page == "daftar_laporan") ? 'active' : ''; ?>" 
                            href="index.php?hal=daftar_laporan">
                                Daftar Laporan
                            </a>

                        <a class="nav-link <?= ($page == "tambah_laporan") ? 'active' : ''; ?>" 
                           href="index.php?hal=tambah_laporan">
                            Tambah Laporan
                        </a>
                    </nav>
                </div>

                <!-- ADMIN -->
                <a class="nav-link <?= in_array($page, ['daftar_admin','tambah_admin','ubah_admin']) ? 'active' : ''; ?>" 
                   href="index.php?hal=daftar_admin">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    Admin
                </a>

                <!-- LOGOUT -->
                <div class="sb-sidenav-menu-heading">Akun</div>
                <a class="nav-link" href="logout.php">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                    Logout
                </a>

            </div>
        </div>

        <!-- FOOTER SIDEBAR -->
        <div class="sb-sidenav-footer">
            <div class="small">Login sebagai:</div>
            <?= $_SESSION['nama_admin']; ?>
        </div>
    </nav>
</div>
