<?php 
    include ("hariTanggalIndo.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?=$title?></title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="<?=base_url()?>/css/styles.css" rel="stylesheet" />
        <link href="<?=base_url()?>/css/sb-admin-2.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet"/>
        <link href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css" rel="stylesheet"/>
        <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?=base_url()?>/js/datatables-simple-demo.js"></script> 
        
        <script src="<?=base_url()?>/js/simple-datatables-pk.js"></script> 

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-sky bg-sky pr-0">
            <!-- Navbar Brand-->
            <div class="row" style="width: 100%;">
                <div class="col-auto">
                    <a class="d-flex align-items-center justify-content-center pl-3 py-4">
                        <div class="rotate-n-15 text-white">
                            <i class="fas fa-journal-whills" style="font-size: 20px;"></i>
                        </div>
                        <div class="fw-bold sidebar-brand-text mx-3 text-white" style="font-size: 20px;">E-JURNAL</div>
                    </a>
                </div>
                <div class="col float-right">
                    <a href="<?=base_url()?>/logout" class="text-white float-right fw-bold py-4"><i class="fas fa-sign-out-alt mx-2"></i>LOGOUT</a>
                </div>
            </div>


        </nav>

        <main id="main-content" class="pt-3">
        <div class="container-fluid px-3 mt-5">
            <div class="px-2 py-2 mb-2" style="box-shadow: 1px 2px 5px 1px rgba(0,0,0,0.2) !important;">
                <div class="text-center fs-3">
                    <span style="border-bottom: 2px solid grey; padding-bottom: 5px;">Guru Piket</span>
                </div>
            </div>  

            <div class="card mt-1">
                <div class="card-header">
                    <div class="row">
                        <div class="col-auto py-0">
                            <i class="fas fa-chalkboard-teacher me-1"></i>
                            Aktivitas User
                        </div>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <div class="row mx-0 mb-2">
                            Kelas :
                            <select id="pilihKelas" name="pilihKelas" class="form-select form-select-sm" aria-label="select kelas">
                                <option value="semua" selected>Semua</option>
                                <?php $i = 0; foreach ($kelas as $dat) :?>
                                    <option value="<?=$dat['kelas']?>"><?=$dat['kelas']?></option>
                                <?php $i++; endforeach;?>
                            </select>
                    </div>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th style="min-width: 170px !important; text-align: center;">Waktu</th>
                                <th style="min-width: 180px !important; text-align: center;">Nama</th>
                                <th style="min-width: 80px !important; text-align: center;">Kelas</th>
                                <th style="min-width: 150px !important; text-align: center;">Mapel</th>
                                <th style="min-width: 250px !important; text-align: center;">Materi Ajar</th>
                                <th style="min-width: 80px !important; text-align: center;">Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($aktivitas as $act) :?>
                            <tr>
                                <td><?=format_hari_tanggal_lengkap($act['time'])?></td>
                                <td><?=$act['nama']?></td>
                                <td style="text-align: center;"><?=$act['kelas']?></td>
                                <td><?=$act['mapel']?></td>
                                <td><?=$act['kegiatan']?></td>
                                <td style="text-align: center;"><?=$act['jam']?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>    
    </main>

<script>
    $(document).ready(function() {
        $("#pilihKelas").val("<?=$selectedKelas?>");
        $('#pilihKelas').on('change', function() {
            var kelas = this.value;
            window.location.href = "<?= base_url() ?>/piket/" + kelas;
        });
    });
</script>

    <!-- this is footer -->
    <?=$this->include('templates/footer')?>

        <script src="<?=base_url()?>/js/scripts.js"></script>
        <!--<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>-->
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <?=$this->renderSection('script')?>
    </body>
</html>
    