<?php
echo $this->extend('templates/main');
echo $this->section('page-content');
include("hariTanggalIndo.php");
?>
<!-- main content from ajax -->
<main id="main-content">
    <div class="container-fluid px-1 mt-4">
        <div class="row mx-0">
            <div class="col-auto back-hide"><a href="<?=base_url()?>/bk" type="button" class="btn btn-light px-3 mx-1 back-hide"><i class="fas fa-arrow-left mr-2 back-hide"></i>Kembali</a></div>
            <div class="col">
                <div class="row mx-0" style="border-bottom: 1px solid gray; min-width: 270px;">
                    <a id="presmenu" class="col text-center menu-link menu-link-activated my-0 px-1 py-1"><span>Presensi Siswa</span></a>
                    <a href="<?=base_url()?>/bk/jurnal" id="jrnlmenu" class="col text-center menu-link my-0 px-1 py-1"><span>Jurnal Harian Kelas</span></a>
                </div>
            </div>
        </div>
        <div class="row mx-0">
            <div class="col pb-3 mt-2 mx-2 mt-3" style="box-shadow: 1px 1px 8px 2px rgba(0,0,0,0.2) !important; min-width: 300px;">
                <div class="row">
                    <div class="col fs-5 py-2 bg-secondary text-light fw-bold"><i class="fas fa-print text-light mr-2"></i>Cetak Rekap Presensi Siswa</div>
                </div>
                    <div class="row my-2">
                        <div class="col ml-2">
                            <div>Tanggal awal : </div>
                            <input class="form-control" id="bln1" name="bln1" type="date" min="2021-07-01" value="<?=date('Y-m-d')?>" max="<?=date('d/m/Y')?>">
                        </div>
                        <div class="col mr-2">
                            <div>Tanggal akhir : </div>
                            <input class="form-control" id="bln2" name="bln2" type="date" min="2021-07-01" value="<?=date('Y-m-d')?>" >
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col mx-2">
                            Kelas :
                            <select id="pilihkelascetak" name="pilihkelascetak" class="form-select" aria-label="select kelas">
                                <?php $i = 0; foreach ($kelas as $dat) :?>
                                    <option value="<?=$dat['nama_kelas']?>"><?=$dat['nama_kelas']?></option>
                                <?php $i++; endforeach;?>
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
        <div class="mx-2 my-3 px-0" style="box-shadow: 2px 1px 8px 1px rgba(0,0,0,0.2) !important;">
            <div class="text-light fw-bold py-2 bg-secondary">
                <i class="fas fa-list-ol mr-3 ml-3"></i>Rekap Presensi
            </div>
            <div class="px-2 py-2">

                <div class="row mx-2">
                    <select id="pilihkelas" name="pilihkelas" class="form-select form-select-sm col-auto pr-5 mr-2" aria-label="select kelas">
                                <option value="semua" selected>Semua</option>
                            <?php $i = 0; foreach ($kelas as $dat) :?>
                                <option value="<?=$dat['nama_kelas']?>"><?=$dat['nama_kelas']?></option>
                            <?php $i++; endforeach; ?>
                    </select>
                    <input class="col-auto" type="date" name="pilihtgl" id="pilihtgl">
                </div>

                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th style="min-width: 143px !important;" >Tanggal</th>
                            <th class="text-center" style="min-width: 120px !important;" >Nama Guru</th>
                            <th style="min-width: 80px !important;" class="text-center">Kelas</th>
                            <th class="text-center">Mapel</th>
                            <th style="min-width: 50px !important;" class="text-center">Jam</th>
                            <th class="text-center">H</th>
                            <th class="text-center">S</th>
                            <th class="text-center">I</th>
                            <th class="text-center">A</th>
                            <th class="text-center px-0 py-0" style="vertical-align: middle !important; width: 40px !important;" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        foreach ($presensi as $dat) : $i++; ?>
                            <tr>
                                <td class="text-center"><?= $i ?></td>
                                <td><?= format_hari_tanggal($dat['tgl']) ?></td>
                                <td class="text-center"><?= $dat['nama'] ?></td>
                                <td class="text-center"><?= $dat['kelas'] ?></td>
                                <td><?= $dat['mapel'] ?></td>
                                <td  class="text-center"><?= $dat['jam'] ?></td>
                                <td  class="text-center"><?= $dat['H'] ?></td>
                                <td  class="text-center"><?= $dat['S'] ?></td>
                                <td  class="text-center"><?= $dat['I'] ?></td>
                                <td  class="text-center"><?= $dat['A'] ?></td>
                                <td class="text-center px-0 py-0">
                                    <?php
                                    echo "
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
        document.getElementById("bk-presensi").className = "nav-link nav-link-activated";
        document.getElementById("bk-presensi-icon").className = "sb-nav-link-icon sb-nav-link-icon-activated";
        $("#pilihtgl").val("<?=$tgll?>");
        $("#pilihkelas").val("<?= $kelaspilih ?>");
        $('#pilihkelas').on('change', function() {
            var kelas = this.value;
            var tgll = $('#pilihtgl').val();
            window.location.href = "<?= base_url() ?>/bk/presensi/show/" + kelas + "/" + tgll;
        });
        $('#pilihtgl').on('change', function() {
            var kelas = $('select[name=pilihkelas]').val();
            var tgll = this.value;
            window.location.href = "<?= base_url() ?>/bk/presensi/show/" + kelas + "/" + tgll;
        });
        $('#cetakRange').on('click', function() {
            var bln1 = $("#bln1").val();
            var bln2 = $("#bln2").val();
            var kelas = $('select[name=pilihkelascetak]').val();
            window.location.href = "<?= base_url() ?>/bk/presensi/cr/" + bln1 + "/" + bln2 + "/" + kelas;
        });
    });
</script>
<!-- this is footer -->
<?= $this->include('templates/footer') ?>
<?= $this->endSection() ?>