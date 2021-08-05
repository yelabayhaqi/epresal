<?php
    echo $this->extend('templates/main');
    echo $this->section('page-content');
    include ("templates/hariTanggalIndo.php");
?>
<main id="main-content">
<?=$this->include('guru/templates/modalAddTugasTambahan')?>
<?=$this->include('guru/templates/modalEditTugasTambahan')?>
    <div class="container-fluid mx-0 px-1 mt-4">
        <div class="back-hide"><a href="<?=base_url()?>/guru" type="button" class="btn btn-light px-3 mx-1 back-hide"><i class="fas fa-arrow-left mr-2 back-hide"></i>Kembali</a></div>
        <?php if(session()->getFlashdata('pesan')) {?>
            <div class="alert alert-success mx-2 my-2" role="alert">
                <?= session()->getFlashdata('pesan') ?>
            </div>
        <?php }?>
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
                    <div class="col-auto pr-1">
                        <button type="button" class="btn btn-light mt-1 float-right" data-bs-toggle="modal" data-bs-target="#addTugasModal">
                            <i class="fas fa-plus"></i>
                             Tambah Tugas
                        </button>
                    </div>
                </div>
                <div class="row mx-0">
                    <div class="row text-white pr-0">
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
                                                <td class="px-2" style="width: 30px; vertical-align: middle;">
                                                    <a href="<?=base_url()?>/guru/tugas/drop/<?=$t['id']?>" class="btn btn-light float-right"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                    <?php } ?>
                            </table>
                        </div>
                    </div>
                    <div class="col text-center" >
                        <button type="button" style="min-width: 185px; width: 100%" class="btn btn-light mr-2 fs-3 mt-2 fw-bold" data-bs-toggle="modal" data-bs-target="#addKegiatanModal">
                            <i class="fas fa-plus mr-3"></i>
                            Tambah Kegiatan
                        </button>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <div class="col pb-3 mt-2 mx-2 mt-2" style="box-shadow: 1px 1px 8px 2px rgba(0,0,0,0.2) !important; min-width: 300px;">
                <form action="<?= base_url()?>/guru/tugas/cetak" method="post">
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
                    <table id="datatablesSimple" class="mx-0">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle;" class="text-center">No</th>
                                <th style="min-width: 100px !important; vertical-align: middle;" >Tanggal</th>
                                <th style="vertical-align: middle; min-width: 150px;" class="text-center">Tugas</th>
                                <th style="vertical-align: middle; min-width: 250px;" class="text-center">Kegiatan</th>
                                <th style="max-width: 90px !important; vertical-align: middle;" class="text-center">Jumlah<br/>(menit)</th>
                                <th style="vertical-align: middle;"style="width: 90px !important; min-width: 90px !important;" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $n=0; foreach ($kegiatan as $kg) : $n++;?>
                            <tr>
                                <td class="text-center"><?=$n?></td>
                                <td><?=format_hari_tanggal_jrnl($kg['tgl'])?></td>
                                <td><?=$kg['tugas']?></td>
                                <td id="kegiatan-<?=$kg['id']?>"><?=$kg['kegiatan']?></td>
                                <td class="text-center"><?=$kg['jml']?></td>
                                <td class="text-center">
                                    <?php
                                    echo "
                                    <button class=\"btn btn-warning px-2 py-0 mx-1 mt-1\" title=\"Edit Data\" onclick=\"editfunc" . $kg['id'] . "()\"><i class=\"fas fa-edit py-0\" style=\"max-width:12px;\"></i></button>
                                    ";
                                    echo "
                            <script>
                                var modalEdit = new bootstrap.Modal(document.getElementById('editKegiatanModal'));
                                    function editfunc" . $kg['id'] . "(){
                                        $('#editTugas').val(\"" . $kg['tugas'] . "\");
                                        $('#idKegiatan').val(\"" . $kg['id'] . "\");
                                        $('#editbln').val(\"" . $kg['tgl'] . "\");
					$('#editKegiatan').html($('#kegiatan-" . $kg['id'] . "').html());
                                        $('#editJml').val(\"" . $kg['jml'] . "\");
                                        modalEdit.toggle();
                                    };
                            </script>
                            ";?>
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

<div class="modal fade mt-2" id="addTugasModal" tabindex="-1" aria-labelledby="addTugasForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h5 class="modal-title">Tambah Tugas</h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body py-0">
        <form action="<?= base_url()?>/guru/tugas/save" method="post">
        <?= csrf_field(); ?>
          <div class="form-group">
            <label for="inputTugas" class="col-form-label">Nama Tugas :</label>
            <select name="inputTugas" class="col custom-select mr-3" id="pilihTugas" required>
                <option value="">-</option>
                <?php foreach ($tugasall as $ta) :?>
		<?php if($ta['kategori']!="wali kelas"){?>
                <option value="<?=$ta['id']?>"><?=$ta['nama_tugas']?></option>
                <?php } endforeach; ?>
            </select>
          </div>
          <div class="modal-footer px-0 py-0 pt-1">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        document.getElementById("gu-jurnal").className="nav-link nav-link-activated";
        document.getElementById("gu-jurnal-icon").className="sb-nav-link-icon sb-nav-link-icon-activated";
        $("#pilihBulanCetak").val("<?= $bulan ?>");
        $("#pilihTahunCetak").val("<?= $tahun ?>");
        $("#pilihBulan").val("<?= $bulan ?>");
        $("#pilihTahun").val("<?= $tahun ?>");
        $('#pilihBulan').on('change', function() {
            var bulan = this.value;
            var tahun = $('select[name=pilihTahun]').val();
            window.location.href = "<?= base_url() ?>/guru/tugas/show/" + bulan + "/" + tahun;
        });
        $('#pilihTahun').on('change', function() {
            var tahun = this.value;
            var bulan = $('select[name=pilihBulan]').val();
            window.location.href = "<?= base_url() ?>/guru/tugas/show/" + bulan + "/" + tahun;
        });
    });
</script>
<?=$this->include('templates/footer')?>
<?=$this->endSection()?>


