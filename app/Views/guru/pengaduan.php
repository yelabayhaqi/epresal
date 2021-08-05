<?php
    echo $this->extend('templates/main');
    echo $this->section('page-content');
    include("templates/hariTanggalIndo.php");
    $this->db = \Config\Database::connect();
?>
<?= $this->include('guru/templates/modalEditAduan') ?>
<main id="main-content">
    <div class="container-fluid px-1 mt-4">
        <?php if(session()->getFlashdata('pesan')) {?>
            <div class="alert alert-success my-2 mx-2" role="alert">
                <?= session()->getFlashdata('pesan') ?>
            </div>
        <?php }?>
        <div class="mx-2 my-2 px-0" style="box-shadow: 2px 1px 8px 1px rgba(0,0,0,0.2) !important;">
            <div class="text-light fw-bold py-2 bg-secondary">
                <i class="fas fa-list-ol mr-3 ml-3"></i>Daftar Aduan
            </div>
            <div class="px-2 py-2">
                <button class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#addAduModal"><i class="fas fa-plus mr-2"></i>Tambah Aduan Baru</button>
                <div class="row mx-0 my-2 fw-bold text-dark">Laporan Aktif</div>
                <?php if($aduAktif == NULL){?>
                    <div class="text-center">Laporan Kosong</div>
                <?php } else {
                        foreach($aduAktif as $act){?>
                <div class="alert alert-danger px-2 py-2 my-2">
                    <div class="row">
                        <div class="col">
                            <span><b>Tanggal Aduan : </b><?=format_hari_tanggal($act['tgllapor'])?></span><br/>
                            <span><b><?="Siswa Yang Dilaporkan : "?></b></span>
                            <div class="my-0">
                                <?php $daftarSiswa = "";
                                $siswaAdu = $this->db->table('detail_aduan')->select()->where('id_pengaduan',$act['id'])->get()->getResultArray();
                                    foreach($siswaAdu as $sa){ $kelas = ""; $daftarSiswa .= "<div class=\\\"row\\\">- ".$this->db->table('siswa')->select('nama')->where('id',$sa['id_siswa'])->get()->getRowArray()['nama']."</div>";
                                        if($sa['status']=='0'){?>
                                <div class="ml-2">
                                    <i class="mr-2 fas fa-times"></i>
                                    <?=$this->db->table('siswa')->select('nama')->where('id',$sa['id_siswa'])->get()->getRowArray()['nama']?>
                                    <?php $kelas = $this->db->table('siswa')->select('kelas')->where('id',$sa['id_siswa'])->get()->getRowArray()['kelas']?>
                                    <a href="<?=base_url()?>/guru/pengaduan/setactive/<?=$sa['id']?>" class="btn btn-primary px-1 py-0 mx-1 my-0"><i class="fas fa-check"></i></a>
                                </div>
                                <?php } else {?>
                                <div class="ml-2">
                                    <i class="mr-1 fas fa-check"></i>
                                    <?=$this->db->table('siswa')->select('nama')->where('id',$sa['id_siswa'])->get()->getRowArray()['nama']?>
                                </div>
                                <?php } } ?>
                            </div>
                            <span><?=$kelas." | Wali Kelas : ".$this->db->table('users')->select('nama')->where('id',$act['tujuan'])->get()->getRowArray()['nama']?></span>
                        </div>
                        <div class="col-auto float-right">
                            <button style="font-size: 10pt;" class="btn btn-warning mr-1 px-2 py-1" onclick="editfunc<?=$act['id']?>()" data-bs-toggle="modal" data-bs-target="#editAduanModal"><i class="fas fa-edit"></i></button>
                        </div>
                    </div>
                    <span><b><?="Keterangan Laporan : "?></b></span><br/>
                    <span><?=$act['aduan']?></span><br/>
                    <div class="mt-2">
                        <span><b><?="Status "?></b></span>
                        <span style="font-size: 10pt;" class="bg-primary text-white px-3 py-1 rounded-3 ml-1">Laporan Aktif <i class="ml-1 fas fa-comments"></i></span>
                    </div>
                    <a href="<?=base_url()?>/guru/pengaduan/setselesai/<?=$act['id']?>" class="col btn btn-primary text-white px-3 py-1 text-center mt-2">Selesai<i class="ml-2 fas fa-check"></i></a>
                </div>
                <script>
                    var modalEdit = new bootstrap.Modal(document.getElementById('editAduanModal'));
                    function editfunc<?=$act['id']?>(){
                        $('#namakelas').val("<?=$kelas?>");
                        $('#datasiswa').html("<?=$daftarSiswa?>");
                        $('#namawali').val("<?=$this->db->table('users')->select('nama')->where('id',$act['tujuan'])->get()->getRowArray()['nama']?>");
                        $('#tglAdu').val("<?=format_hari_tanggal($act['tgllapor'])?>");
                        $('#editAduan').val("<?=$act['aduan']?>");
                        $('#idAduan').val("<?=$act['id']?>");
                    }
                </script>
                <?php } } ?>
                <div class="row mx-0 my-2 fw-bold text-dark">Laporan Selesai</div>
                <?php if($aduSelesai == NULL){?>
                    <div class="text-center">Laporan Kosong</div>
                <?php } else {
                        foreach($aduSelesai as $asl){?>
                <div class="alert alert-success px-2 py-2 my-2">
                    <div class="row">
                        <div class="col">
                            <span><b>Tanggal Aduan : </b><?=format_hari_tanggal($asl['tgllapor'])?></span><br/>
                            <span><b>Tanggal Selesai : </b><?=format_hari_tanggal($asl['tglselesai'])?></span><br/>
                            <span><b><?="Siswa Yang Dilaporkan : "?></b></span>
                            <ul class="my-0">
                                <?php 
                                $siswaAdu = $this->db->table('detail_aduan')->select()->where('id_pengaduan',$asl['id'])->get()->getResultArray();
                                foreach($siswaAdu as $sa){ $kelas = "";
                                $kelas = $this->db->table('siswa')->select('kelas')->where('id',$sa['id_siswa'])->get()->getRowArray()['kelas']?>
                                <li><?=$this->db->table('siswa')->select('nama')->where('id',$sa['id_siswa'])->get()->getRowArray()['nama']?></li>
                                <?php } ?>
                            </ul>
                            <span><?=$kelas." | Wali Kelas : ".$this->db->table('users')->select('nama')->where('id',$asl['tujuan'])->get()->getRowArray()['nama']?></span>
                        </div>
                    </div>
                    <span><b><?="Keterangan Laporan : "?></b></span><br/>
                    <span><?=$asl['aduan']?></span><br/>
                    <div class="mt-2">
                        <span><b><?="Status "?></b></span>
                        <span style="font-size: 10pt;" class="bg-warning text-white px-3 py-1 rounded-3 ml-1">Laporan Selesai <i class="ml-1 fas fa-check"></i></span>
                    </div>
                </div>
                <?php } } ?>


            </div>
        </div>
    </div>
</main>
<div class="modal fade mt-2" id="addAduModal" tabindex="-1" aria-labelledby="addAduForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Buat </h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="<?=base_url()?>/guru/pengaduan/buataduan" method="post">
                <?php 
                $kelas = $this->db->table('tugas')->select('tugas.nama_tugas,users.nama,kelas.id')
                ->join('tugas_guru','tugas_guru.id_tugas = tugas.id')
                ->join('users','tugas_guru.id_guru = users.id')
                ->join('kelas','nama_kelas = tugas.nama_tugas')
                ->where('tugas.kategori','wali kelas')
                ->orderBy('tugas.nama_tugas','asc')
                ->get()->getResultArray();
                ?>
                    <div class="form-group my-0">
                        <label for="pilihKelas" class="col-form-label">Pilih Wali Kelas </label>
                        <select name="pilihKelas" class="col custom-select mr-3" id="pilihKelas" required>
                        <option value="">-</option>
                        <?php foreach ($kelas as $k) :?>
                            <option value="<?=$k['id']?>"><?=$k['nama_tugas'] . " (" . $k['nama'] . ")"?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" id="idKelas">
                    <div class="modal-footer px-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button id="addbtn" type="submit" class="btn btn-primary">Buat</button>
                    </div>
            </form>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
        document.getElementById("gu-adu").className = "nav-link nav-link-activated";
        document.getElementById("gu-adu-icon").className = "sb-nav-link-icon sb-nav-link-icon-activated";
    });
</script>
<?= $this->include('templates/footer') ?>
<?= $this->endSection() ?>