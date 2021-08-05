<?php 
    echo $this->extend('templates/main');
    echo $this->section('page-content'); 
    include("templates/hariTanggalIndo.php");
?>
    <main id="main-content">
        <div class="container-fluid mx-0 my-0 px-2 mt-5">
            <?php
            if(isset($pesan)){
                    foreach($pesan as $p) : 
                    if($p['kind'] == 1) {?>
                    <div class="alert alert-warning px-2 py-2 mb-2 mx-2">
                    <?php } else if($p['kind'] == 2) {?>
                    <div class="alert alert-danger px-2 py-2 mb-2 mx-2">
                    <?php } ?>
                        <span style="font-size: 8pt;"><?=format_hari_tanggal_lengkap($p['waktu'])?></span><br/>
                        <span><b><?=$p['judul']?></b></span><br/>
                        <span><?=$p['pesan']?></span>
                    </div>
            <?php endforeach; }
		if((isset($keluhan))&&($keluhan > 0)) {?>
		<div class="alert alert-warning px-2 py-2 mb-2 mx-2">
			<div class="row">
			<div class="col-auto">
                	    <span><b>Notifikasi</b></span><br/>
                	    <span>Ada <?=$keluhan?> keluhan aktif dari guru</span></br>
			</div>
			<div class="col-auto">
			<a href="<?=base_url()?>/guru/keluhan" class="btn btn-primary px-2 my-1">Lihat Keluhan</a>
			</div>
			</div>
                </div>
		<?php } ?>
            <div class="row mx-0 my-2">
                <div class="col mt-2 mx-2 py-3 px-3" style="box-shadow: 1px 2px 5px 1px rgba(0,0,0,0.2) !important;">
                    <div class="row">
                        <div class="col text-center px-0">
                            <img class="mx-3" src="<?=base_url()?>/assets/img/logo-smk.jpg" style="width: 90px">
                        </div>
                        <table class="col text-dark text-center mx-2">
                            <tr>
                                <td>
                                    <span class="fs-3 fw-bolder"><?=session()->get('nama')?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fw-bolder badge fs-5" style="background-color: rgba(12,180,220,1); min-width: 50px;"><?="NIP / NUPTK. " . session()->get('nip')?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mx-0 py-0 my-0">
                <div class="col py-2 mt-2 mx-2" style="box-shadow: 1px 1px 8px 2px rgba(0,0,0,0.2) !important; min-width: 300px;
                    background: rgb(12,193,241);
                    background: linear-gradient(28deg, rgba(12,193,241,1) 0%, rgba(4,209,222,1) 53%, rgba(0,194,233,1) 100%);
                    ">
                        <div class="row">
                            <div class="col fs-4 text-white fw-bold">Presensi</div>
                            <div class="col">
                                <a href="<?=base_url()?>/guru/presensi" class="btn btn-light mx-2 px-3 py-2 my-0 fw-bold float-right"><i class="fas fa-plus mr-3"></i>Tambah</a>
                            </div>
                        </div>
                        <div class="row mx-0">
                            <table class="col mx-0 text-white">
                                <tr class="px-0 py-0" style="vertical-align: text-bottom;">
                                    <td class="py-0" style="min-width: 220px;">
                                        <span class="fw-bold">Presensi Hari Ini</span>
                                        <span class="fw-bolder ml-3 badge fs-5" style="background-color: rgba(12,180,220,1); min-width: 30px;"><?=$jmlPres?></span>
                                    </td>
                                    <td rowspan="3" style="font-size: 60pt; vertical-align: middle; max-width: 50px; text-align: right;">
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <ul class="px-0 pl-3">
                                            <?php foreach ($prestoday as $dat) :?>
                                                <li><b><?=$dat['kelas']?> | <?=$dat['jam']?> <?="<br/>(" . $dat['mapel']?>)</b><br/><span style="font-size: 10pt;"><i><?=$dat['time']?></i></span></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </div>
                </div>
                <div class="col py-2 mt-2 mx-2" style="box-shadow: 1px 1px 8px 2px rgba(0,0,0,0.2) !important; min-width: 300px;
                    background: rgb(15,167,66);
                    background: linear-gradient(28deg, rgba(15,167,66,1) 0%, rgba(0,201,30,1) 53%, rgba(11,166,55,1) 100%);
                    ">
                        <div class="row">
                            <div class="col fs-4 text-white fw-bold">Jurnal</div>
                            <div class="col">
                                <a href="<?=base_url()?>/guru/jurnal" class="btn btn-light mx-2 px-4 py-2 my-0 fw-bold float-right"><i class="fas fa-eye mr-3"></i>Lihat</a>
                            </div>
                        </div>
                        <div class="row mx-0">
                            <table class="col mx-0 text-white">
                                <tr class="px-0 py-0" style="vertical-align: text-bottom;">
                                    <td class="py-0" style="min-width: 220px;">
                                        <span class="fw-bold">Jurnal Hari Ini</span>
                                        <span class="fw-bolder ml-3 badge fs-5" style="background-color: rgba(15,150,50,0.8); min-width: 30px;"><?=$jmlJurnal?></span>
                                    </td>
                                    <td rowspan="3" style="font-size: 60pt; vertical-align: middle; max-width: 50px; text-align: right;">
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <ul class="px-0 pl-3">
                                            <?php foreach ($jrnltoday as $dat) :?>
                                                <li><b><?=$dat['kelas']?> | <?=$dat['jam']?> <?="<br/>(" . $dat['mapel']?>)</b><br/><span style="font-size: 10pt;"><i><?=$dat['time']?></i></span></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </div>
                </div>
            </div>  
        </div>    
    </main>
    <!-- this is footer -->
    <?=$this->include('templates/footer')?>
<?=$this->endSection()?>
<?=$this->section('script')?>
<script>
        $(document).ready(function() {
            document.getElementById("menutama").className="nav-link nav-link-activated";
            document.getElementById("menutama-icon").className="sb-nav-link-icon sb-nav-link-icon-activated";
        } );
</script>
<?=$this->endSection()?>
    