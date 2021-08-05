<?php 
    echo $this->extend('templates/main');
    echo $this->section('page-content'); 

    include ("templates/hariTanggalIndo.php");
    $date=date('Y-m-d');
    $tanggal = format_hari_tanggal($date);
    if($edit == '1'){
        $tanggal = format_hari_tanggal($tgl);
    }
?>
<!-- main content from ajax -->
<main id="main-content"> 
<form action="<?= base_url()?>/guru/presensi/save" method="post">
        <?= csrf_field(); ?>
    <div class="container-fluid px-3">
        <h3 class="mt-4">
            <?php if($edit == '0') echo "Buat Daftar Hadir Baru"; else echo "Edit Daftar Hadir"; ?>
        </h3>
        <?php if(session()->getFlashdata('pesan')) {?>
            <div class="alert alert-success my-2" role="alert">
                <?= session()->getFlashdata('pesan') ?>
            </div>
        <?php }?>
        <div class="card mt-3">
            <div class="pl-3 py-2" style="width: 100% !important;">
            <div class="row" style="width: 100%;">
                <div class="col-5 fs-6" style="max-width:110px;">Nama</div> : 
                <div class="col fs-6" style="width: 100% !important;">
                    <?=session()->get('nama')?>
                </div>
            </div>
            <div class="row" style="width: 100%;">
                <div class="col-5 fs-6" style="max-width:110px;">NUPTK/NIP</div> :
                <div class="col fs-6" style="width: 100% !important;">
                    <?=session()->get('nip')?>
                </div>
            </div>
            <div class="row" style="width: 100%;">
                <div class="col-5 fs-6" style="max-width:110px;">Mapel</div> :
                <div class="col fs-6" style="width: 100% !important;">
                    <?=$mapel?>
                </div>
            </div>
            <div class="row" style="width: 100%;">
                <div class="col-5 fs-6" style="max-width:110px;">Kelas</div>:
                <div class="col fs-6" style="width: 100% !important;">
                    <?=$kelas?>
                </div>
            </div>
            <div class="row" style="width: 100%;">
                <div class="col-5 fs-6" style="max-width:110px;">Tanggal</div> :
                <div class="col fs-6" style="width: 100% !important;">
                    <?=$tanggal?>
                </div>
            </div> 
            <?php if($edit == '0') { ?>           
                <div class="row" style="width: 100%;">
                    <div class="col-5 fs-6" style="max-width:110px;">Jam</div> :
                    <div class="col fs-6" style="width: 100% !important;">
                        <?=$jam?>
                    </div>
                </div>
            <?php } else { ?>
            <div class="row" style="width: 100%;">
                <div class="col-5 fs-6 py-2 my-0" style="max-width:110px;"><span style="vertical-align: middle">Jam</span></div> 
                <div class="col-auto px-0 py-2 my-0"><span style="vertical-align: middle">:</span></div> 
                <div class="col mx-0">
                    <span>
                    <select id="jam1" name="inputJam1" class="col custom-select px-2 py-0" style="min-width: 60px; max-width: 70px;" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                    </span>
                    <span class="col fs-2 px-0"  style="vertical-align: middle"> - </span>
                    <select id="jam2" name="inputJam2" class="col custom-select px-2 py-0" style="min-width: 60px; max-width: 70px;" required>
                    </select>
                </div>
            </div>
            <script>
                var arpas = "<?=$jam?>";
                var tanda=0;
                for(var i=0;i<=arpas.length;i++){
                    if(arpas[i]=="-") {
                    break;
                    }
                    else tanda++;
                };
                var angka1 = arpas.substr(0,tanda-1);
                var angka2 = arpas.substr(tanda+2,arpas.length);
                var pilihan = "";
                $("#jam1").val(angka1);
                for(var swap = angka1;swap<=12;swap++){
                    pilihan += "<option value="+swap+">"+swap+"</option>";
                }
                $("#jam2").html(pilihan);
                $("#jam2").val(angka2);
            </script>
            <?php } ?>
            </div>
            <button type="button" class="btn btn-primary mx-3" id="selAll"><i class="fas fa-check mr-3"></i>Hadir Semua</button>
            <div class="card-body px-1 pb-0">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th class="text-center" >NO</th>
                            <th>NAMA</th>
                            <th class="text-center" style="width: 8%;">H</th>
                            <th class="text-center" style="width: 8%;">S</th>
                            <th class="text-center" style="width: 8%;">I</th>
                            <th class="text-center" style="width: 8%;">A</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; foreach ($siswa as $dat) : $i++;?>
                        <tr>
                            <td class="text-center"><?=$i?></td>
                            <td><?=$dat['nama']?>
                                <input type="text" name="id<?=$i?>" value="
                                <?php if($edit == '0') { echo $dat['id']; } else { echo $dat['id_siswa']; } ?>
                                " style="opacity: 0.0; width: 1px;"/>
                            </td>
                            <td class="text-center px-0 align-middle" style="width: 8%;">
                                <div class="form-check form-check-inline mx-0">
                                    <input class="form-check-input mx-0 px-0" type="radio" id="Hcb<?=$i?>" name="inrad<?=$i?>" value="H" <?php if($edit == '1'){if($dat['H']==1){echo "checked=\"checked\"";}}?> required>
                                    <label class="form-check-label" for="inrad<?=$i?>"></label>
                                </div>
                            </td>
                            <td class="text-center px-0 align-middle" style="width: 8%;">
                                <div class="form-check form-check-inline mx-0">
                                    <input class="form-check-input mx-0 px-0" type="radio"  id="Scb<?=$i?>" name="inrad<?=$i?>" value="S"<?php if($edit == '1'){if($dat['S']==1){echo "checked=\"checked\"";}}?> required>
                                    <label class="form-check-label" for="inrad<?=$i?>"></label>
                                </div>
                            </td>
                            <td class="text-center px-0 align-middle" style="width: 8%;">
                                <div class="form-check form-check-inline mx-0">
                                    <input class="form-check-input mx-0 px-0" type="radio"  id="Icb<?=$i?>" name="inrad<?=$i?>" value="I"<?php if($edit == '1'){if($dat['I']==1){echo "checked=\"checked\"";}}?> required>
                                    <label class="form-check-label" for="inrad<?=$i?>"></label>
                                </div>
                            </td>
                            <td class="text-center px-0 align-middle" style="width: 8%;">
                                <div class="form-check form-check-inline mx-0">
                                    <input class="form-check-input mx-0 px-0" type="radio"  id="Acb<?=$i?>" name="inrad<?=$i?>" value="A"<?php if($edit == '1'){if($dat['A']==1){echo "checked=\"checked\"";}}?> required>
                                    <label class="form-check-label" for="inrad<?=$i?>"></label>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php if($edit == '0'){?>
            <div>
                <div class="form-check mx-3 mb-1">
                </div>
                <div class="form-group mx-3" id="formShow">
                    <label style="color: black; font-weight: bold;">Data Untuk Jurnal Mengajar</label><br/>
                    <label for="inputKegiatanEdit" class="col-form-label py-0">Materi Ajar :</label>
                    <textarea class="form-control" id="inputKegiatan" name="inputKegiatan" placeholder="Kegiatan Pembelajaran"rows="4" required></textarea>
                </div>
            </div>
            <?php } ?>
            <?php if ($edit == '1'){?>
                <input type="hidden" name="id_pr" value="<?=$id_presensi?>"/>
            <?php }?>
            <input type="hidden" id="editjam" type="hidden" name="jampelajaran" value="<?=$jam?>"/>
            <input type="hidden" name="jumlah" value="<?=$i?>"/>
            <input type="hidden" name="edited" value="<?=$edit?>"/>
            <input type="hidden" name="mapel" value="<?=$mapel?>"/>
            <input type="hidden" name="kelas" value="<?=$kelas?>"/>
            <div class="col px-0 mt-2">
                <button id="oneclick" type="submit" class="col mx-2 mb-2 btn btn-primary float-right" style="max-width: 150px;">Simpan Data</button>
                <button id="cancelpres" type="button" class="col mb-2 btn btn-danger float-right" style="max-width: 100px;" data-bs-toggle="modal" data-bs-target="#cancelPresensi">Batalkan</button>
            </div>
        </div>
    </div>
</form>
</main>

<div class="modal fade mt-2" id="cancelPresensi" tabindex="-1" aria-labelledby="cancel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi</h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url()?>/admin/dataguru/drop" method="post">
        <?= csrf_field(); ?>
          <div class="form-group">
            <?php if($edit == '1'){
                echo "<h3>Batalkan Edit Data?</h3><h6>Data anda tidak akan dirubah</h6>";} 
                else {echo "<h6>Batalkan Tambah Data dan Kembali ke Daftar Presensi?</h6>";}?>
          </div>
          <div class="modal-footer px-0 ">
            <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Tidak</button>
            <a id="first" type="submit" class="btn btn-danger px-4" href="<?=base_url()?>/guru/presensi">YA</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        document.getElementById("gu-presensi").className = "nav-link nav-link-activated";
        document.getElementById("gu-presensi-icon").className = "sb-nav-link-icon sb-nav-link-icon-activated";
        $('#selAll').on('click', function() {
            for(var ck=1;ck<=<?=$i?>;ck++){
                $('#Hcb'+ck).prop('checked', true);
            }
        });
        $('#oneclick').on('click', function() {
            $('#oneclick').hide();
            $('#cancelpres').hide();
            var valid = false;
            for(var ck=1;ck<=<?=$i?>;ck++){
                if($('#Hcb'+ck).is(':checked')||$('#Scb'+ck).is(':checked')||$('#Icb'+ck).is(':checked')||$('#Acb'+ck).is(':checked')){
                    valid = true;
                } else {
                    valid = false;
                    break;
                }
            }
            if($('#inputKegiatan').val() == ""){
                valid = false;
            }
            if(!valid) {
                $('#oneclick').show();
                $('#cancelpres').show();
            }
            if(valid){
                $(window).scrollTop(0);
            }
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
            $("#editjam").val($("#jam1").val()+" - "+$("#jam2").val());
        });
        $('#jam2').on('change', function() {
            $("#editjam").val($("#jam1").val()+" - "+$("#jam2").val());
        });
    });
</script>
<?=$this->include('templates/footer')?>
<?=$this->endSection()?>


    