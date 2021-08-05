<?php 
    echo $this->extend('templates/main');
    echo $this->section('page-content'); 
?>
<?= $this->include('guru/templates/modalEditUname')?>
<main id="main-content"> 
    <div class="container-fluid px-1">
        <div class="px-0 py-1 mx-0 mt-4" style="border-bottom: 2px solid rgba(0,0,0,0.3);">
            <div class="row mx-0 px-0">
                <div class="col-auto back-hide" style="width: 120px; border-right: 2px solid rgba(0,0,0,0.3);"><a href="<?=base_url()?>/" type="button" class="col-auto btn btn-light back-hide"><i class="fas fa-arrow-left mr-2 back-hide"></i>Kembali</a></div>
                <div class="col">
                    <span class="text-dark fw-bold fs-5">Profil</span><br/>
                    <span class="fs-5"><i>Edit Profil Guru</i></span>
                </div>
            </div>
        </div> 
        <?php if(session()->getFlashdata('pesan')) {?>
            <div class="alert alert-success my-2 mx-2" role="alert">
                <?= session()->getFlashdata('pesan') ?>
            </div>
        <?php 
        } else if(session()->getFlashdata('error')) {?>
            <div class="alert alert-danger my-2 mx-2" role="alert">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php }?>
        <div class="row mx-1 my-4 mt-4">
            <div class="col py-2 mt-2 mx-2" style="box-shadow: 1px 1px 8px 2px rgba(0,0,0,0.2) !important;;
                background: rgb(12,193,241);
                background: linear-gradient(28deg, rgba(12,193,241,1) 0%, rgba(4,209,222,1) 53%, rgba(0,194,233,1) 100%);
                ">
                <div class="row text-white text-center">
                    <div class="col" style="font-size: 100px;">
                        <i class="fas fa-user mr-2"></i>
                    </div>
                    <table class="col">
                        <tr>
                            <td class="text-center">
                                <span class="fs-3 fw-bolder"><?=session()->get('nama')?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <span class="fw-bolder badge fs-5 mx-2 mb-2" style="background-color: rgba(12,180,220,1); min-width: 50px;"><?="NIP / NUPTK. " . session()->get('nip')?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <span class="mr-2">Username</span>
                                <span class="fw-bolder badge fs-5" style="background-color: rgba(12,180,220,1); min-width: 50px;"><?=session()->get('username')?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <button class="btn btn-light fw-bold mt-2" data-bs-toggle="modal" data-bs-target="#editUnameModal">Ubah Username / Password</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="signature">
                    <label class="mx-0 my-1 px-0 pt-3 text-light" style="font-size: 10pt; font-weight: bolder;">TANDA TANGAN</label><br/>
                    <img style="border: 1px solid black;" src="<?=base_url()?>/assets/img/signature/<?=session()->get('ttd')?>" width="200px"></img>
                    <button class="btn btn-primary mx-2" onclick="edit()"><i class="fas fa-edit"></i> edit</button>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade mt-2" id="editSgnModal" tabindex="-1" aria-labelledby="editSgnForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Buat Tanda Tangan</h6>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body row">
            <div class="wrapper-sp col">
                <canvas id="signature-pad" class="signature-pad card" style="border: 2px solid black;" width=300 height=200></canvas>
                <button id="clear" class="btn btn-danger px-4 my-1" >Clear</button>
            </div>
      </div>
      <div class="modal-footer px-2 col my-0 py-2">
            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
            <button id="save" type="submit" class="btn btn-primary px-4">Simpan</button>
       </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script>
    document.getElementById("user-profile").className = "nav-link nav-link-activated";
    document.getElementById("user-profile-icon").className = "sb-nav-link-icon sb-nav-link-icon-activated";
    var modalSave = new bootstrap.Modal(document.getElementById('editSgnModal'));
        var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            backgroundColor: 'rgb(255, 255, 255)',
            penColor: 'rgb(0, 0, 0)'
        });
        var saveButton = document.getElementById('save');
        var cancelButton = document.getElementById('clear');
        var clrButton = document.getElementById('hapus');

        saveButton.addEventListener('click', function (event) {
        var data = signaturePad.toDataURL("image/jpeg",1.0);
        console.log(data);
        var signature = "image=" + data;
            $.ajax({
                type: 'POST',
                url: "/guru/templates/editsignature",
                data: signature,
                success: function(hasil) {
                    console.log("sukses");
                    $("#signature").html(hasil);
                }
            });
        $("#aktivasi").show();
        $("#btnAddSgn").hide();
        modalSave.toggle();
        });
        function edit() {
            modalSave.toggle();
        };
        cancelButton.addEventListener('click', function (event) {
            signaturePad.clear();
        });
</script>
    <!-- this is footer -->
    <?=$this->include('templates/footer')?>
<?=$this->endSection()?>


    