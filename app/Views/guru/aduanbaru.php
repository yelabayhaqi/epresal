<?php
    echo $this->extend('templates/main');
    echo $this->section('page-content');
    include("templates/hariTanggalIndo.php");
?>
<main id="main-content">
    <form id="form-adu" action="<?=base_url()?>/guru/pengaduan/saveaduan" method="post">
        <div class="container-fluid px-1 mt-4">
            <?php if(session()->getFlashdata('pesan')) {?>
                <div class="alert alert-success my-2 mx-2" role="alert">
                    <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php }?>
            <div class="col-auto"><a href="<?=base_url()?>/guru/pengaduan" type="button" class="btn btn-light px-3 mx-1"><i class="fas fa-arrow-left mr-2"></i>Kembali</a></div>
            <div class="mx-2 my-2 px-0" style="box-shadow: 2px 1px 8px 1px rgba(0,0,0,0.2) !important;">
                <div class="text-light fw-bold py-2 bg-primary text-center">
                    <i class="fas fa-file-signature mr-3 ml-3"></i>Buat Laporan Pengaduan
                </div>
                <div class="px-2 py-2">
                    <div class="alert alert-warning px-2 py-2 my-1">
                        <div class="row">
                            <div class="col">
                                <span><b>Laporan untuk wali kelas <?=$namakelas?></b><span><br/>
                                <input type="hidden" name="wali" value="<?=$namawali?>"></input>
                                <input type="hidden" name="kelas" value="<?=$namakelas?>"></input>
                                <span><b>Siswa Yang Dilaporkan :</b></span><br/>
                                <div id="siswaAdu" class="my-0"></div>
                                <button type="button" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#addSiswaAduModal"><i class="fas fa-edit mr-2"></i>Tambah / Edit Siswa yang Dilaporkan</button>
                            </div>
                        </div>
                        <span><b><?="Keterangan Laporan : "?></b></span><br/>
                        <textarea class="form-control" placeholder="keterangan aduan" name="keterangan" required></textarea>
                        <div id="sbmact">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade mt-2" id="addSiswaAduModal" tabindex="-1" aria-labelledby="addSiswaAduForm" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buat </h5>
                    <button type="button" class="close" data-bs-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="form-group my-0">
                            <div class="col text-center fw-bold">Pilih Siswa yang Dilaporkan</div>
                            <div class="card overflow-auto" style="max-height: 300px">
                                <?php foreach ($siswa as $s) :?>
                                    <div class="form-check mx-2">
                                        <input class="form-check-input" type="checkbox" value="1" id="check<?=$s['id']?>" name="siswa<?=$s['id']?>">
                                        <label class="form-check-label" for="check<?=$s['id']?>">
                                            <?=$s['nama']?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <input type="hidden" id="idKelas">
                        <div class="modal-footer px-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="button" id="addbtn" class="btn btn-primary" data-bs-dismiss="modal" onclick="updateSiswa()">Buat</button>
                        </div>
                </div>
                </div>
            </div>
        </div>
    </form>
</main>

<script>
    var selectedSiswa = [];
    $(document).ready(function() {
        document.getElementById("gu-adu").className = "nav-link nav-link-activated";
        document.getElementById("gu-adu-icon").className = "sb-nav-link-icon sb-nav-link-icon-activated";
    });
    function updateSiswa(){
        updateHtml = "";
        <?php foreach($siswa as $s){?>
            if($('#check<?=$s['id']?>').prop("checked") == true){
                updateHtml += "<div class=\"col\"> - <?=$s['nama']?></div>";
            }
        <?php } ?>
        $('#siswaAdu').html(updateHtml);
        if(updateHtml != ""){
            $('#sbmact').html("<div type=\"submit\" class=\"col btn btn-primary text-white px-3 py-1 text-center mt-2\" onclick=\"sendAduan()\">Kirim Laporan Pengaduan<i class=\"ml-2 fas fa-paper-plane\"></i></div>");
        } else {
            $('#sbmact').html("");
        }
    }
    function sendAduan(){
        $( "#form-adu" ).submit();
    }
</script>
<?= $this->include('templates/footer') ?>
<?= $this->endSection() ?>