<?php 
    echo $this->extend('templates/main');
    echo $this->section('page-content'); 
?>
<main id="main-content"> 
    <div class="container-fluid mx-0 px-1">
        <div class="pl-3 py-1 mt-4" style="border-bottom: 2px solid rgba(0,0,0,0.3);">
            <span class="text-dark fw-bold fs-5">Pengaturan</span><br/>
            <span class="fs-5"><i>Data Server E-PRESAL</i></span>
        </div> 
        <?php 
        if(session()->getFlashdata('error')) {?>
            <div class="alert alert-danger mt-2 mx-2" role="alert">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php }?>

            <div class="row mx-0 my-4 mt-4">
                <div class="col py-2 mt-2 mx-2" style="box-shadow: 1px 1px 8px 2px rgba(0,0,0,0.2) !important; min-width: 360px;
                    background: rgb(12,193,241);
                    background: linear-gradient(28deg, rgba(12,193,241,1) 0%, rgba(4,209,222,1) 53%, rgba(0,194,233,1) 100%);
                    ">
                        <div class="fs-4 text-white fw-bold">Backup Database</div>
                        <div class="row py-2">
                            <div class="col-lg-3 text-center" style="font-size: 40pt;">
                                <i class="fas fa-database text-white"></i>
                            </div>
                        <button id="backupdata" class="col btn btn-light mx-3 fs-3 fw-bold" style="color: rgb(12,193,241);" data-bs-toggle="modal" data-bs-target="#backupDBModal">Buat Cadangan</button>
                
                        </div>
                </div>
                <div class="col py-2 mt-2 mx-2" style="box-shadow: 1px 1px 8px 2px rgba(0,0,0,0.2) !important; min-width: 360px;
                    background: rgb(15,167,66);
                    background: linear-gradient(28deg, rgba(15,167,66,1) 0%, rgba(0,201,30,1) 53%, rgba(11,166,55,1) 100%);
                    ">
                        <div class="fs-4 text-white fw-bold">Tahun Ajaran Baru</div>
                        <div class="row py-2">
                            <div class="col-lg-3 text-center" style="font-size: 40pt;">
                                <i class="fas fa-calendar-alt text-white"></i>
                            </div>
                        <button id="tabaru" class="col btn btn-light mx-3 fs-3 fw-bold" style="color: rgb(15,167,66);"  data-bs-toggle="modal" data-bs-target="#taBaruModal">Ganti Tahun Ajaran</button>
                        </div>
                </div>
            </div>
    </div>
</main>

<div class="modal fade mt-4" id="backupDBModal" tabindex="-1" aria-labelledby="BackupDBForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h5 class="modal-title">Buat Cadangan</h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url()?>/admin/pengaturan/backupdb" method="post">
        <?= csrf_field(); ?>
          <div class="form-group">
            <h3 class="text-dark">Buat Cadangan Data?</h3>
            <div class="form-group mt-1">
                <div class="alert alert-success mt-3 px-2" role="alert">
                    <ul class="mb-1 px-3">
                        <li>Buat cadangan (dump) semua data terbaru dalam bentuk file (.sql)</li>
                        <li>Untuk melakukan restore, silakan import file (.sql) ke server database </li>
                        <li>Secara default, file cadangan akan tersimpan di direktori <i>epresal/backup_db/</i> dengan nama : <br/><b><i> backup_dd-mm-yyyy_hh-mm.sql </i></b><br/>Ket : <br/>(dd-mm-yyyy) = tanggal,<br/> (hh-mm) = jam-menit</li>
                    </ul>
                </div>
            </div>
            <label for="inputNip" class="col-form-label">Konfirmasi Password Admin :</label>
            <input type="password" class="form-control" name="confirmpsswd" required>
          </div>
          <div class="modal-footer px-0 py-0 pt-1">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-danger"><i class="fas fa-download mr-3"></i>UNDUH CADANGAN</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade mt-0" id="taBaruModal" tabindex="-1" aria-labelledby="BackupDBForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-1">
        <h5 class="modal-title">Ganti Tahun Ajaran</h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url()?>/admin/pengaturan/tabaru" method="post">
        <?= csrf_field(); ?>
          <div class="form-group">
            <h3 class="text-dark py-0 fs-5 my-0">Konfirmasi Ganti Tahun Ajaran</h3>
            <div class="form-group py-0 my-0">
                <div class="alert alert-success px-2 my-0" role="alert">
                    <ul class="px-3 my-0 py-0">
                        <li>Fitur Ganti Tahun Ajaran akan melakukan backup (dump) seluruh tabel pada database, dan disimpan pada direktori <i>epresal/backup_db</i>
                        dengan nama : <br/><b><i> backup_dd-mm-yyyy_hh-mm.sql </i></b><br/>Ket : <br/>(dd-mm-yyyy) = tanggal,<br/> (hh-mm) = jam-menit</li>
                        <li>Selanjutnya dilakukan drop keseluruhan data pada : </li>
                        <ol>
                            <li>Absensi</li>
                            <li>Jurnal</li>
                            <li>Mata Pelajaran</li>
                            <li>Siswa (Kelas 12)</li>
                        </ol>
                        <li>dan modifikasi untuk data : </li>
                        <ul>
                            <li>Siswa (Kelas 10) <i class="fas fa-arrow-right"></i> (Kelas 11)</li>
                            <li>Siswa (Kelas 11) <i class="fas fa-arrow-right"></i> (Kelas 12)</li>
                        </ul>
                    </ul>
                </div>
            </div>
            <label for="inputNip" class="col-form-label">Konfirmasi Password Admin :</label>
            <input type="password" class="form-control" name="confirmpsswd" required>
          </div>
          <div class="modal-footer px-0 py-0 pt-1 my-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-danger">GANTI TAHUN AJARAN</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    document.getElementById("ad-pengaturan").className = "nav-link nav-link-activated";
    document.getElementById("ad-pengaturan-icon").className = "sb-nav-link-icon sb-nav-link-icon-activated";
</script>
<?=$this->include('templates/footer')?>
<?=$this->endSection()?>


    