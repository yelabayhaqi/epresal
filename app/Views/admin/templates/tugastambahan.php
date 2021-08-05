<?php
    echo $this->extend('templates/main');
    echo $this->section('page-content');
    include ("hariTanggalIndo.php");
?>
<main id="main-content">
    <div class="container-fluid mx-0 px-1 mt-4">
        <div><a href="<?=base_url()?>/admin/arsip/jurnal" type="button" class="btn btn-light px-4 mx-2"><i class="fas fa-arrow-left mr-2"></i>Kembali</a></div>
        <div class="row mx-0 my-3 py-0">
            <div class="col py-1 pb-3 mt-2 mx-2 mt-2" style="box-shadow: 1px 1px 8px 2px rgba(0,0,0,0.2) !important; min-width: 300px;
                    background: rgb(15,167,66);
                    background: linear-gradient(28deg, rgba(15,167,66,1) 0%, rgba(0,201,30,1) 53%, rgba(11,166,55,1) 100%);
                    ">
                <div class="row">
                    <div class="col fs-5 py-2 text-white fw-bold">
                        <i class="fas fa-file-invoice text-white mr-1"></i>
                        Tugas Tambahan
                    </div>
                </div>
                <div class="row mx-0 text-white">
                    <div class="col text-center" style="font-size: 100px; line-height: 1;">
                        <i class="fas fa-user mr-2"></i>
                    </div>
                    <table class="col my-0 py-0">
                        <tr>
                            <td class="text-center">
                                <span class="fs-3 fw-bolder"><?=$guru['nama']?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <span class="fw-bolder badge fs-5 mx-0 my-0" style="background-color: rgba(15,150,50,0.8); min-width: 50px;"><?="NUPTK / NIP. " . $guru['nip']?></span>
                            </td>
                        </tr>
                    </table>
                    <div class="row text-white pr-0 mt-2">
                        <div class="pr-0">
                            <b>Daftar Tugas : </b>
                            <table style="width: 100%;">
                                <?php 
                                    if($tugas == NULL){?>
                                        <tr>
                                            <td class="text-center">Daftar Tugas Kosong</td>
                                        </tr>
                                    </table></div></div>
                                    <?php } else {
                                        foreach($tugas as $t){?>
                                            <tr>
                                                <td>
                                                    <li></li>
                                                </td>
                                                <td>
                                                    <?=$t['nama_tugas']?>
                                                </td>
                                            </tr>
                                    <?php } ?>
                            </table>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <div class="col pb-3 mt-2 mx-2 mt-2" style="box-shadow: 1px 1px 8px 2px rgba(0,0,0,0.2) !important; min-width: 300px;">
                <form action="<?= base_url()?>/admin/arsip/jurnalkegiatan/cetak" method="post">
                    <div class="row">
                        <div class="col fs-5 py-2 bg-secondary text-light fw-bold"><i class="fas fa-print text-light mr-2"></i>Cetak Rekap Tugas Tambahan</div>
                    </div>
                        <div class="row my-1 mr-2">
                            <div class="col py-2" style="max-width: 120px;">Pilih Tugas</div>
                            <select name="pilihTugasCetak" class="col custom-select" id="pilihTugasCetak" required>
                                <?php foreach ($tugascetak as $t) :?>
                                <option value="<?=$t['tugas']?>"><?=$t['tugas']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row my-1">
                            <div class="col">
                                Bulan :
                                <select class="col form-select py-1 fs-5" id="pilihBulanCetak" name="pilihBulanCetak" aria-label="Default select example">
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="col">
                                Tahun :
                                <select class="col form-select py-1 fs-5" id="pilihTahunCetak" name="pilihTahunCetak" aria-label="Default select example">
                                    <option value="<?= (date("Y", time()) - 1) ?>"><?= (date("Y", time()) - 1) ?></option>
                                    <option value="<?= date("Y", time()) ?>"><?= date("Y", time()) ?></option>
                                    <option value="<?= (date("Y", time()) + 1) ?>"><?= (date("Y", time()) + 1) ?></option>
                                </select>
                            </div>
                            <input type="hidden" value="<?=$guru['id']?>" name="idGuru"/>
                        </div>
                        <div class="row mt-3 mx-0">
                            <button type="submit" id="cetakRange" class="btn btn-primary fw-bold col py-2" style="width: 100%;" title="Cetak Data" >Cetak Data <i class="ml-1 fas fa-file-pdf"></i></button>
                        <div>
                    </div>
                </form>
            </div>
        </div>
        </div>
        <div class="mx-2 my-2 px-0" style="box-shadow: 2px 1px 8px 1px rgba(0,0,0,0.2) !important;">
            <div class="text-light fw-bold py-2 bg-secondary">
                <i class="fas fa-list mr-3 ml-3"></i>Kegiatan 
            </div>
            <div class="px-2 py-2">
                    <div class="row mx-0 mb-2">
                        <select class="form-select form-select-sm col-auto pr-5 mr-2" id="pilihBulan" name="pilihBulan" aria-label="Default select example">
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        <select class="form-select form-select-sm col-auto pr-5" id="pilihTahun" name="pilihTahun" aria-label="Default select example">
                            <option value="<?= (date("Y", time()) - 1) ?>"><?= (date("Y", time()) - 1) ?></option>
                            <option value="<?= date("Y", time()) ?>"><?= date("Y", time()) ?></option>
                            <option value="<?= (date("Y", time()) + 1) ?>"><?= (date("Y", time()) + 1) ?></option>
                        </select>
                    </div>
                    <table id="datatablesSimple" class="mx-0">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle;" class="text-center">No</th>
                                <th style="min-width: 100px !important; vertical-align: middle;" >Tanggal</th>
                                <th style="vertical-align: middle; min-width: 150px;" class="text-center">Tugas</th>
                                <th style="vertical-align: middle; min-width: 250px;" class="text-center">Kegiatan</th>
                                <th style="max-width: 90px !important; vertical-align: middle;" class="text-center">Jumlah<br/>(menit)</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $n=0; foreach ($kegiatan as $kg) : $n++;?>
                            <tr>
                                <td class="text-center"><?=$n?></td>
                                <td><?=format_hari_tanggal_jrnl($kg['tgl'])?></td>
                                <td><?=$kg['tugas']?></td>
                                <td><?=$kg['kegiatan']?></td>
                                <td class="text-center"><?=$kg['jml']?></td>
                            </tr>
                            <?php
                        endforeach; ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function() {
        document.getElementById("ad-jurnal").className="nav-link nav-link-activated";
        document.getElementById("ad-jurnal-icon").className="sb-nav-link-icon sb-nav-link-icon-activated";
        $("#pilihBulanCetak").val("<?= $bulan ?>");
        $("#pilihTahunCetak").val("<?= $tahun ?>");
        $("#pilihBulan").val("<?= $bulan ?>");
        $("#pilihTahun").val("<?= $tahun ?>");
        $('#pilihBulan').on('change', function() {
            var bulan = this.value;
            var tahun = $('select[name=pilihTahun]').val();
            window.location.href = "<?= base_url() ?>/admin/arsip/jurnalkegiatan/show/<?=$guru['id']?>/" + bulan + "/" + tahun;
        });
        $('#pilihTahun').on('change', function() {
            var tahun = this.value;
            var bulan = $('select[name=pilihBulan]').val();
            window.location.href = "<?= base_url() ?>/admin/arsip/jurnalkegiatan/show/<?=$guru['id']?>/" + bulan + "/" + tahun;
        });
        $('#inputKelas').on('change', function() {
            var pilihan = "kelas="+this.value;
            $.ajax({
	        type: 'POST',
	        url: "/guru/templates/getlist",
	        data: pilihan,
	        success: function(hasil) {
	        	$("#inputMapel").html(hasil);
	        	console.log(hasil);
	        }
            });
        });
    });
</script>
<?=$this->include('templates/footer')?>
<?=$this->endSection()?>


