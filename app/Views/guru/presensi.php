<?php
    echo $this->extend('templates/main');
    echo $this->section('page-content');
    include("templates/hariTanggalIndo.php");
?>
<main id="main-content">
    <?= $this->include('guru/templates/modalAddPresensi') ?>
    <div class="container-fluid px-1 mt-4">
        <div class="row mx-0">
            <div class="col-auto back-hide"><a href="<?=base_url()?>/guru" type="button" class="btn btn-light px-3 mx-1 back-hide"><i class="fas fa-arrow-left mr-2 back-hide"></i>Kembali</a></div>
            <div class="col">
                <div class="row mx-0" style="border-bottom: 1px solid gray; min-width: 270px;">
                    <a id="presmenu" class="col text-center menu-link menu-link-activated my-0 px-1 py-1"><span>Presensi Siswa</span></a>
                    <a href="<?=base_url()?>/guru/jurnal" id="jrnlmenu" class="col text-center menu-link my-0 px-1 py-1"><span>Jurnal Mengajar</span></a>
                </div>
            </div>
        </div>
        <?php if(session()->getFlashdata('pesan')) {?>
            <div class="alert alert-success my-2 mx-2" role="alert">
                <?= session()->getFlashdata('pesan') ?>
            </div>
        <?php }?>
        <div class="row mx-0 mb-3 py-0">
            <div class="col py-1 pb-3 mt-2 mx-2 mt-2" style="box-shadow: 1px 1px 8px 2px rgba(0,0,0,0.2) !important; min-width: 300px;
                background: rgb(12,193,241);
                background: linear-gradient(28deg, rgba(12,193,241,1) 0%, rgba(4,209,222,1) 53%, rgba(0,194,233,1) 100%);
                ">
                <div class="row">
                    <div class="col fs-5 py-2 text-white fw-bold"><i class="fas fa-list-ol text-white mr-2"></i>Data Presensi Siswa</div>
                </div>
                <div class="row mx-0">
                    <table class="col mx-0 text-white" style="line-height: 1.5;">
                        <tr class="my-2">
                            <td class="py-0" style="min-width: 140px;">
                                <span class="fw-bold">Data Hari Ini</span>
                            </td>
                            <td class="px-0 py-0">
                                <span class="ml-1 badge fs-5 mt-1 float-right me-3" style="background-color: rgba(12,180,220,1); min-width: 50px;"><?=$prestoday?></span>
                            </td>
                        </tr>
                        <tr class="my-2">
                            <td class="py-0" style="width: 140px;">
                                <span class="fw-bold">Data Bulan Ini</span>
                            </td>
                            <td class="px-0 py-0">
                                <span class="ml-1 badge fs-5 mt-1 float-right me-3" style="background-color: rgba(12,180,220,1); min-width: 50px;"><?=$presmnth?></span>
                            </td>
                        </tr>
                        <tr class="my-2">
                            <td class="py-0" style="width: 140px;">
                                <span class="fw-bold">Total</span>
                            </td>
                            <td class="px-0 py-0">
                                <span class="ml-1 badge fs-5 mt-1 float-right me-3" style="background-color: rgba(12,180,220,1); min-width: 50px;"><?=$prestotal?></span>
                            </td>
                        </tr>
                    </table>
                    <div class="text-center" >
                        <button type="button" style="min-width: 200px; width: 100%;" class="btn btn-light mr-2 px-4 py-2 fs-3 mt-3 fw-bold" data-bs-toggle="modal" data-bs-target="#addPresensiModal">
                            <i class="fas fa-plus mr-3"></i>
                            Tambah
                        </button>
                    </div>
                </div>
            </div>
            <div class="col pb-3 mt-2 mx-2 mt-2" style="box-shadow: 1px 1px 8px 2px rgba(0,0,0,0.2) !important; min-width: 300px;">
                <div class="row">
                    <div class="col fs-5 py-2 bg-secondary text-light fw-bold"><i class="fas fa-print text-light mr-2"></i>Cetak Rekap Presensi Siswa</div>
                </div>
                    <div class="row my-1">
                        <div class="col mx-1">
                            <div>Tanggal awal : </div>
                            <input class="form-control" id="bln1" name="bln1" type="date" min="2021-07-01" value="<?=date('Y-m-d')?>" max="<?=date('d/m/Y')?>">
                        </div>
                        <div class="col mx-1">
                            <div>Tanggal akhir : </div>
                            <input class="form-control" id="bln2" name="bln2" type="date" min="2021-07-01" value="<?=date('Y-m-d')?>" >
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col mx-1">
                            Kelas :
                            <select id="pilihkelas" name="pilihkelas" class="form-select form-select-sm" aria-label="select kelas">
                                <?php $i = 0; foreach ($kelas as $k) :?>
                                    <option value="<?=$k['kelas']?>"><?=$k['kelas']?></option>
                                <?php $i++; endforeach;?>
                            </select>
                        </div>
                        <div class="col mx-1">
                            Mapel :
                            <select id="pilihmapel" name="pilihmapel" class="form-select form-select-sm" aria-label="select kelas">
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3 mx-2">
                        <button id="cetakRange" class="btn btn-primary fw-bold col py-2" style="width: 100%;" title="Cetak Data" >Cetak Data <i class="ml-1 fas fa-file-pdf"></i></button>
                    <div>
                </div>
            </div>
        </div>
        </div>

        <div class="mx-2 my-2 px-0" style="box-shadow: 2px 1px 8px 1px rgba(0,0,0,0.2) !important;">
            <div class="text-light fw-bold py-2 bg-secondary">
                <i class="fas fa-list-ol mr-3 ml-3"></i>Presensi Siswa
            </div>
            <div class="px-2 py-2">
                <div class="row mx-2">
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

                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th style="min-width: 143px !important;" >Tanggal</th>
                            <th style="min-width: 80px !important;" class="text-center">Kelas</th>
                            <th class="text-center">Mapel</th>
                            <th style="min-width: 50px !important;" class="text-center">Jam</th>
                            <th class="text-center">H</th>
                            <th class="text-center">S</th>
                            <th class="text-center">I</th>
                            <th class="text-center">A</th>
                            <th class="text-center px-0 py-0"  style="width: 90px !important; min-width: 90px !important; vertical-align: middle;" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        foreach ($presensi as $dat) : $i++; ?>
                            <tr>
                                <td class="text-center"><?= $i ?></td>
                                <td><?= format_hari_tanggal($dat['tgl']) ?></td>
                                <td class="text-center"><?= $dat['kelas'] ?></td>
                                <td><?= $dat['mapel'] ?></td>
                                <td  class="text-center"><?= $dat['jam'] ?></td>
                                <td  class="text-center"><?= $dat['H'] ?></td>
                                <td  class="text-center"><?= $dat['S'] ?></td>
                                <td  class="text-center"><?= $dat['I'] ?></td>
                                <td  class="text-center"><?= $dat['A'] ?></td>
                                <td class="text-center px-0 py-0" style="width: 90px !important; min-width: 90px !important; vertical-align: middle;">
                                    <?php
                                    echo "
                                <a class=\"btn btn-warning px-2 py-0 mx-0 mt-1\" title=\"Edit Data\" href=\"" . base_url() . "/guru/presensi/edit/" . $dat['id'] . "\"><i class=\"fas fa-edit py-0\" style=\"max-width:12px;\"></i></a>
                                <a class=\"btn btn-primary px-2 py-0 mx-0 mt-1\" title=\"Cetak Data\" href=\"" . base_url() . "/guru/presensi/cetak/" . $dat['id'] . "\"><i class=\"fas fa-file-pdf px-0\" style=\"max-width:12px;\"></i></a>
                                ";
                                    ?>

                                </td>
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
        document.getElementById("bln2").disabled = true;
        document.getElementById("gu-presensi").className = "nav-link nav-link-activated";
        document.getElementById("gu-presensi-icon").className = "sb-nav-link-icon sb-nav-link-icon-activated";
        dt = "kelas="+$("#pilihkelas").val();
        $.ajax({
			type: 'POST',
			url: "/guru/templates/getmapelrange",
			data: dt,
			success: function(hasil) {
                console.log(hasil);
				$("#pilihmapel").html(hasil);
			}
    	});
        $('#pilihkelas').on('change', function() {
            var kelas = this.value;
            $.ajax({
			type: 'POST',
			url: "/guru/templates/getmapelrange",
			data: "kelas="+kelas,
			success: function(hasil) {
				$("#pilihmapel").html(hasil);
			}
    	    });
        });
        $('#inputKelas').on('change', function() {
            var kelas = this.value;
            $.ajax({
			type: 'POST',
			url: "/guru/templates/getlist",
			data: "kelas="+kelas,
			success: function(hasil) {
				$("#inputMapel").html(hasil);
			}
    	    });
        });
        $('#jam1').on('change', function() {
            var pilihan = "";
            if(this.value == "") $("#jam2").html("<option value=\"-\">-</option>");
            else {
                var jam1 = this.value;
                for(;jam1<=12;jam1++){
                    pilihan += "<option value=\""+jam1+"\">"+jam1+"</option>";
                }
			    $("#jam2").html(pilihan);
            }
        });
        $("#pilihBulan").val("<?= $bulan ?>");
        $("#pilihTahun").val("<?= $tahun ?>");
        $('#pilihBulan').on('change', function() {
            var bulan = this.value;
            var tahun = $('select[name=pilihTahun]').val();
            window.location.href = "<?= base_url() ?>/guru/presensi/show/" + bulan + "/" + tahun;
        });
        $('#pilihTahun').on('change', function() {
            var tahun = this.value;
            var bulan = $('select[name=pilihBulan]').val();
            window.location.href = "<?= base_url() ?>/guru/presensi/show/" + bulan + "/" + tahun;
        });
        $('#cetakRange').on('click', function() {
            var bln1 = $("#bln1").val();
            var bln2 = $("#bln2").val();
            var kelas = $('select[name=pilihkelas]').val();
            var mapel = $('select[name=pilihmapel]').val();
            window.location.href = "<?= base_url() ?>/guru/presensi/cr/" + bln1 + "/" + bln2 + "/" + kelas + "/" + mapel;
        });

        $(function(){
            $('#bln1').on('change', function() {
                var minval = $("#bln1").val();
                document.getElementById("bln2").min = minval;
                if(minval > $("#bln2").val()){
                    document.getElementById("bln2").value = minval;
                }
                document.getElementById("bln2").disabled = false;
            });
        });

    });
</script>
<?= $this->include('templates/footer') ?>
<?= $this->endSection() ?>