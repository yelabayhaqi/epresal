<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
    	<meta name="description" content="epresal-for_smkn_1_nganjuk-activation_id-120845327768.https://epresal.site-yels.com/120845327768">
    	<meta name="author" content="bayhaqi-software">
        <title><?=$title?></title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="<?=base_url()?>/css/styles.css" rel="stylesheet" />
        <link href="<?=base_url()?>/css/sb-admin-2.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet"/>
        <link href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css" rel="stylesheet"/>
        <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- <script src="<?=base_url()?>/vendor/jquery/jquery.min.js"></script> -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <!-- <script src="<?=base_url()?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

        <script src="<?=base_url()?>/js/datatables-simple-demo.js"></script> 
        
        <?php if(session()->get('level') == 1){?>
        <script src="<?=base_url()?>/js/simple-datatables.js"></script> 
        <?php } else {?>
        <script src="<?=base_url()?>/js/simple-datatables-fg.js"></script> 
        <?php } ?>

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-sky bg-sky pr-0">
            <a class="d-flex align-items-center justify-content-center pl-0">
                <div>
                    <img src="<?=base_url()?>/assets/img/logo-smk-sm.jpg" style="max-height: 40px; border-radius: 15%;">
                </div>
                <div class="fw-bold sidebar-brand-text mx-2 text-white" style="font-size: 20px;">E-JURNAL</div>
            </a>
            <button class="btn btn-link order-1 order-lg-0 me-2 ml-2 me-lg-0 px-3" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
            </button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav mt-4">
                            <a class="nav-link" id="menutama" href="<?=base_url()?>/">
                                <div id="menutama-icon" class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                Menu Utama
                            </a>
                            <!-- filtering access -->
                            <?php 
                            $loginas = session()->get('level');
                            if($loginas == 1) {?>
                                <div class="sb-sidenav-menu-heading my-1">DATA MASTER</div>
                                <a class="nav-link" href="<?=base_url()?>/admin/dataguru" id="ad-dataguru">
                                    <div id="ad-dataguru-icon" class="sb-nav-link-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                                    Data Guru
                                </a>
                                <a class="nav-link" href="<?=base_url()?>/admin/datasiswa" id="ad-datasiswa">
                                    <div id="ad-datasiswa-icon" class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Data Siswa
                                </a>
                                <a class="nav-link" href="<?=base_url()?>/admin/datamapel" id="ad-datamapel">
                                    <div id="ad-datamapel-icon" class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                    Mata Pelajaran
                                </a>
                                <a class="nav-link" href="<?=base_url()?>/admin/tugas" id="ad-datatugas">
                                    <div id="ad-datatugas-icon" class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>
                                    Tugas Tambahan
                                </a>
                                <div class="sb-sidenav-menu-heading my-1">ARSIP</div>
                                <a class="nav-link" href="<?=base_url()?>/admin/arsip/presensi" id="ad-presensi">
                                    <div id="ad-presensi-icon" class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                                    Presensi & Jurnal
                                </a>
                                <a class="nav-link" href="<?=base_url()?>/admin/arsip/jurnal" id="ad-jurnal">
                                    <div id="ad-jurnal-icon" class="sb-nav-link-icon"><i class="fas fa-copy"></i></div>
                                    Jurnal Kegiatan
                                </a>
                                <a class="nav-link" href="<?=base_url()?>/admin/keluhan" id="ad-keluh">
                                    <div id="ad-keluh-icon" class="sb-nav-link-icon"><i class="fas fa-scroll"></i></div>
                                    Keluhan Guru
                                </a>
                                <div class="sb-sidenav-menu-heading my-1">SERVER</div>
                                <a class="nav-link" href="<?=base_url()?>/admin/pengaturan" id="ad-pengaturan">
                                    <div id="ad-pengaturan-icon" class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                                    Pengaturan
                                </a>
                            <?php 
                            } else if($loginas == 2) {?>
                                <div class="sb-sidenav-menu-heading my-1">ENTRI DATA</div>
                                <a class="nav-link" href="<?=base_url()?>/guru/presensi" id="gu-presensi">
                                    <div id="gu-presensi-icon" class="sb-nav-link-icon"><i class="fas fa-list-ol"></i></div>
                                    Jurnal & Presensi
                                </a>
                                <a class="nav-link" href="<?=base_url()?>/guru/tugastambahan" id="gu-jurnal">
                                    <div id="gu-jurnal-icon" class="sb-nav-link-icon"><i class="fas fa-file-invoice"></i></div>
                                    Tugas Tambahan
                                </a>
                                <div class="sb-sidenav-menu-heading my-1">LAINYA</div>
                                <a class="nav-link" href="<?=base_url()?>/guru/pengaduan" id="gu-adu">
                                    <div id="gu-adu-icon" class="sb-nav-link-icon"><i class="fas fa-comment-dots"></i></div>
                                    Buat Pengaduan
                                </a>
                                <?php 
                                    $this->db = \Config\Database::connect();
                                    $cek = $this->db->table('tugas_guru')->join('tugas','tugas_guru.id_tugas = tugas.id')
                                    ->where('tugas_guru.id_guru',session()->get('id'))
                                    ->where('tugas.kategori','wali kelas')->get()->getResultArray();
                                    if($cek != NULL){?>
                                    <a class="nav-link" href="<?=base_url()?>/guru/keluhan" id="gu-keluh">
                                        <div id="gu-keluh-icon" class="sb-nav-link-icon"><i class="fas fa-scroll"></i></div>
                                        Keluhan Guru
                                    </a>
                                <?php } ?>
                            <?php
                            } else if($loginas == 3) {?>
                                <div class="sb-sidenav-menu-heading my-1">REKAP</div>
                                <a class="nav-link" href="<?=base_url()?>/bk/presensi" id="bk-presensi">
                                    <div id="bk-presensi-icon" class="sb-nav-link-icon"><i class="fas fa-list-ol"></i></div>
                                    Presensi & Jurnal
                                </a>
                                <div class="sb-sidenav-menu-heading my-1">ENTRI DATA</div>
                                <a class="nav-link" href="<?=base_url()?>/bk/tugastambahan" id="bk-jurnal">
                                    <div id="bk-jurnal-icon" class="sb-nav-link-icon"><i class="fas fa-file-invoice"></i></div>
                                    Jurnal Kegiatan
                                </a>
                                <div class="sb-sidenav-menu-heading my-1">LAINYA</div>
                                <a class="nav-link" href="<?=base_url()?>/bk/keluhan" id="bk-keluh">
                                    <div id="bk-keluh-icon" class="sb-nav-link-icon"><i class="fas fa-scroll"></i></div>
                                    Keluhan Guru
                                </a>
                            <?php } ?>
                        </div>
                        
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading my-1">USER</div>
                            <a class="nav-link" href="<?=base_url()?>/user/profil" id="user-profile">
                                <div id="user-profile-icon" class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
                                Profil
                            </a>
                            <a href="<?=base_url()?>/logout" class="nav-link" id="user-logout">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                                Logout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php 
                            $loginas = session()->get('level');
                            if($loginas == 1) echo "Administrator";
                            else if($loginas == 2) echo "Guru SMKN 1 Nganjuk";
                            else if($loginas == 3) echo "BK SMKN 1 Nganjuk";
                        ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <?=$this->renderSection('page-content')?>
            </div>
        </div>
        <script src="<?=base_url()?>/js/scripts.js"></script>
        <!--<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>-->
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <?=$this->renderSection('script')?>
    </body>
</html>
