<?php
    echo $this->extend('templates/main');
    echo $this->section('page-content');
    include("templates/hariTanggalIndo.php");
    $this->db = \Config\Database::connect();
?>
<main id="main-content">
    <div class="container-fluid px-1 mt-4">
        <?php if(session()->getFlashdata('pesan')) {?>
            <div class="alert alert-success my-2 mx-2" role="alert">
                <?= session()->getFlashdata('pesan') ?>
            </div>
        <?php }?>
        <div class="mx-2 my-2 px-0" style="box-shadow: 2px 1px 8px 1px rgba(0,0,0,0.2) !important;">
            <div class="text-light fw-bold py-2 bg-secondary">
                <i class="fas fa-scroll mr-3 ml-3"></i>Daftar Keluhan Guru
            </div>
            <select id="pilihkelas" name="pilihkelas" class="form-select form-select-sm col-auto pr-5 mt-2 mx-2" aria-label="select kelas">
                <option value="semua" selected>Semua</option>
            <?php $i = 0; foreach ($kelas as $dat) :?>
                <option value="<?=$dat['nama_kelas']?>"><?=$dat['nama_kelas']?></option>
            <?php $i++; endforeach; ?>
            </select>
            <div class="px-2 py-2">
                <div class="row mx-0 my-2 fw-bold text-dark">Laporan Aktif</div>
                <?php if($aduAktif == NULL){?>
                    <div class="text-center">Laporan Kosong</div>
                <?php } else { $jml = 0;
                        foreach($aduAktif as $act){
                            $siswaAdu = $this->db->table('detail_aduan')->select()->where('id_pengaduan',$act['id'])->get()->getRowArray();
                            $kelas = $this->db->table('siswa')->select('kelas')->where('id',$siswaAdu['id_siswa'])->get()->getRowArray()['kelas'];
                            if($kelas == NULL){?>
                                <div class="text-center">Laporan Kosong</div>
                            <?php }
                            if(($kelaspilih == "semua")||($kelas == $kelaspilih)){ $jml++;?>
                <div class="alert alert-danger px-2 py-2 my-2">
                    <div class="row">
                        <div class="col">
                            <span><b>Tanggal Aduan : </b><?=format_hari_tanggal($act['tgllapor'])?></span><br/>
                            <span><b>Pembuat Laporan : </b><br/><?=$this->db->table('users')->select('nama')->where('id',$act['pelapor'])->get()->getRowArray()['nama']?></span><br/>
                            <span><b><?="Siswa Yang Dilaporkan : "?></b></span>
                            <div class="my-0">
                                <?php $daftarSiswa = "";
                                $siswaAdu = $this->db->table('detail_aduan')->select()->where('id_pengaduan',$act['id'])->get()->getResultArray();
                                    foreach($siswaAdu as $sa){
                                        if($sa['status']=='0'){?>
                                <div class="ml-2">
                                    <i class="mr-2 fas fa-times"></i>
                                    <?=$this->db->table('siswa')->select('nama')->where('id',$sa['id_siswa'])->get()->getRowArray()['nama']?>
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
                    </div>
                    <span><b><?="Keterangan Laporan : "?></b></span><br/>
                    <span><?=$act['aduan']?></span><br/>
                    <div class="mt-2">
                        <span><b><?="Status "?></b></span>
                        <span style="font-size: 10pt;" class="bg-primary text-white px-3 py-1 rounded-3 ml-1">Laporan Aktif <i class="ml-1 fas fa-comments"></i></span>
                    </div>
                </div>
                <?php } } 
                    if($jml == 0){?>
                        <div class="text-center">Laporan Kosong</div>
                <?php }} ?>
                <div class="row mx-0 my-2 fw-bold text-dark">Laporan Selesai</div>
                <?php if($aduSelesai == NULL){?>
                    <div class="text-center">Laporan Kosong</div>
                <?php } else { $jml = 0;
                    foreach($aduSelesai as $asl){
                        $siswaAdu = $this->db->table('detail_aduan')->select()->where('id_pengaduan',$asl['id'])->get()->getRowArray();
                        $kelas = $this->db->table('siswa')->select('kelas')->where('id',$siswaAdu['id_siswa'])->get()->getRowArray()['kelas'];
                        if(($kelaspilih == "semua")||($kelas == $kelaspilih)){ $jml++;
                        ?>
                <div class="alert alert-success px-2 py-2 my-2">
                    <div class="row">
                        <div class="col">
                            <span><b>Tanggal Aduan : </b><?=format_hari_tanggal($asl['tgllapor'])?></span><br/>
                            <span><b>Tanggal Selesai : </b><?=format_hari_tanggal($asl['tglselesai'])?></span><br/>
                            <span><b>Pembuat Laporan : </b><br/><?=$this->db->table('users')->select('nama')->where('id',$asl['pelapor'])->get()->getRowArray()['nama']?></span><br/>
                            <span><b><?="Siswa Yang Dilaporkan : "?></b></span>
                            <ul class="my-0">
                                <?php 
                                $siswaAdu = $this->db->table('detail_aduan')->select()->where('id_pengaduan',$asl['id'])->get()->getResultArray();
                                foreach($siswaAdu as $sa){?>
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
                <?php } } 
                    if($jml == 0){?>
                        <div class="text-center">Laporan Kosong</div>
                <?php }} ?>


            </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function() {
        document.getElementById("bk-keluh").className = "nav-link nav-link-activated";
        document.getElementById("bk-keluh-icon").className = "sb-nav-link-icon sb-nav-link-icon-activated";
        $('#pilihkelas').val("<?=$kelaspilih?>");
        $('#pilihkelas').on('change', function() {
            var kelas = this.value;
            window.location.href = "<?= base_url() ?>/bk/keluhan/" + kelas;
        });
    });
</script>
<?= $this->include('templates/footer') ?>
<?= $this->endSection() ?>