<?php 
    echo $this->extend('templates/main');
    echo $this->section('page-content'); 
    include ("hariTanggalIndo.php");
?>
<main id="main-content"> 
    <div class="container-fluid px-1 mt-4">
        <div class="row mx-0">
            <div class="col-auto back-hide"><a href="<?=base_url()?>/bk" type="button" class="btn btn-light px-3 mx-1 back-hide"><i class="fas fa-arrow-left mr-2 back-hide"></i>Kembali</a></div>
            <div class="col">
                <div class="row mx-0" style="border-bottom: 1px solid gray; min-width: 270px;">
                    <a href="<?=base_url()?>/bk/presensi" id="presmenu" class="col text-center menu-link my-0 px-1 py-1"><span>Presensi Siswa</span></a>
                    <a id="jrnlmenu" class="col text-center menu-link menu-link-activated my-0 px-1 py-1"><span>Jurnal Harian Kelas</span></a>
                </div>
            </div>
        </div>
        <?php if(session()->getFlashdata('pesan')) {?>
            <div class="alert alert-success my-2" role="alert">
                <?= session()->getFlashdata('pesan') ?>
            </div>
        <?php }?>

        <div class="mx-2 my-3 px-0" style="box-shadow: 2px 1px 8px 1px rgba(0,0,0,0.2) !important;">
            <div class="text-light fw-bold py-2 bg-secondary">
                <i class="fas fa-list-ol mr-3 ml-3"></i>Rekap Jurnal
            </div>
            <div class="px-2 py-2">
            
            <div class="px-1 pt-2">
                <div class="row mx-1">
                    <select id="pilihkelas" name="pilihkelas" class="form-select form-select-sm col-auto pr-5 mr-2 mb-3" aria-label="select kelas">
                            <?php $i = 0; foreach ($kelas as $dat) :?>
                                <option value="<?=$dat['nama_kelas']?>"><?=$dat['nama_kelas']?></option>
                            <?php $i++; endforeach; ?>
                    </select>
                    <input class="col-auto mr-3 mb-3" type="date" name="pilihtgl" id="pilihtgl">
                    <a class="col btn btn-primary px-2 py-1 mx-0 mb-3 float-right" title="Cetak Jurnal" href="<?=base_url()?>/bk/jurnal/cetak/<?=$kelaspilih?>/<?=$tgll?>"><i class="fas fa-file-pdf px-0" style="max-width:12px;"></i> Cetak</a>
                </div>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th style="min-width: 143px !important;" >Tanggal</th>
                            <th style="min-width: 143px !important;" >Guru</th>
                            <th style="min-width: 80px !important;" class="text-center">Kelas</th>
                            <th class="text-center">Mapel</th>
                            <th style="min-width: 50px !important;" class="text-center">Jam</th>
                            <th class="text-center">Materi Ajar</th>
                            <th style="min-width: 90px !important;" class="text-center">Presensi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; foreach ($jurnal as $dat) : $i++;?>
                        <tr>
                            <td class="text-center"><?=$i?></td>
                            <td><?=format_hari_tanggal($dat['tgl'])?></td>
                            <td><?=$dat['nama']?></td>
                            <td><?=$dat['kelas']?></td>
                            <td><?=$dat['mapel']?></td>
                            <td class="text-center"><?=$dat['jam']?></td>
                            <td><?=$dat['kegiatan']?></td>
                            <td><?php if(($dat['H']!=NULL)&&($dat['S']!=NULL)&&($dat['I']!=NULL)&&($dat['A']!=NULL)){
                                echo "H=" . $dat['H'] . ", S=" . $dat['S'] . ", I=" . $dat['I'] . ", A=" . $dat['A'];   
                            }?>
                            </td>
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
        document.getElementById("bk-presensi").className = "nav-link nav-link-activated";
        document.getElementById("bk-presensi-icon").className = "sb-nav-link-icon sb-nav-link-icon-activated";
        $("#pilihtgl").val("<?=$tgll?>");
        $("#pilihkelas").val("<?= $kelaspilih ?>");
        $('#pilihkelas').on('change', function() {
            var kelas = this.value;
            var tgll = $('input[type="date"]').val();
            window.location.href = "<?= base_url() ?>/bk/jurnal/show/" + kelas + "/" + tgll;
        });
        $('#pilihtgl').on('change', function() {
            var kelas = $('select[name=pilihkelas]').val();
            var tgll = this.value;
            window.location.href = "<?= base_url() ?>/bk/jurnal/show/" + kelas + "/" + tgll;
        });
    });
</script>
    <!-- this is footer -->
    <?=$this->include('templates/footer')?>
<?=$this->endSection()?>


    