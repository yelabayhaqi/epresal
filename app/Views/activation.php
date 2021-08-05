<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="epresal-for_smkn_1_nganjuk-activation_id-120845327768.https://epresal.site-yels.com/120845327768">
    <meta name="author" content="bayhaqi-software">
    <link href="<?=base_url()?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?=base_url()?>/css/styles.css" rel="stylesheet">
    <link href="<?=base_url()?>/css/sb-admin-2.min.css" rel="stylesheet">
    <title>E-PRESAL | Aktivasi</title>
  </head>
  <body class="font-set bg-activation">
    <div class="container py-3">
        <div class="row bg-light my-2 py-2">
            <div class="text-center">
                <div class="sidebar-brand-icon rotate-n-15" style="font-size: 35px;">
                    <i class="fas fa-journal-whills"></i>
                </div>
                <h1 class="h4 text-gray-900 mb-0">E-PRESAL</h1>
                <span class="h6">Sistem Rekap Presensi dan Jurnal</span><br/>
            </div>
            <div class="text-center my-1 mb-2">
                <span class="h3 text-gray-900 fw-bolder">SMK Negeri 1 Nganjuk</span>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-lg-5 text-white bg-new py-2 px-2 pr-5">
                <span class="fs-5">Selamat Datang,</span><br/>
                <span class="fs-3"><?=session()->get('nama')?></span>
                <div style="width:100%; border-bottom: 2px solid white;"></div>
                <span class="fs-3">NIP.<?=session()->get('nip')?></span>
            </div>
            <div class="col-lg bg-light px-2 py-2">
                <p class="fs-6 fw-bold mb-1 text-center">Anda wajib melakukan aktivasi untuk menggunakan akun ini.</p>
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
                <form action="<?= base_url()?>/guru/aktivasi" method="post">
                    <div class="form-group px-3 mt-2">
                        <label for="inputUname" class="mx-0 my-0 px-0 py-0" style="font-size: 10pt; font-weight: bolder; color: #4197d1;">BUAT USERNAME</label>
                        <div class="row mx-0 my-0 px-0 py-0">
                        <input type="text" class="col form-control" name="inputUname" style="height: 50px; width: 250px;" placeholder="username" required>
                            <div class="col-2">
                            </div>
                        </div>
                    </div>
                    <div class="form-group px-3">
                        <label for="inputPsswd" class="mx-0 my-0 px-0 py-0" style="font-size: 10pt; font-weight: bolder; color: #4197d1;">BUAT PASSWORD</label>
                        <div class="row mx-0 my-0 px-0 py-0">
                            <input type="password" class="col form-control mb-1" name="inputPsswd" id="inputPsswd" style="height: 50px; width: 250px;" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimal 6 Karakter' : ''); if(this.checkValidity()) form.cnfrmPsswd.pattern = this.value;" placeholder="password" required>
                            <div class="col-2">
                                <button id="show-hide" class="btn btn-primary px-2 my-1" type="button">
                                    <i id="icons" class="fas fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row mx-0 my-0 px-0 py-0">
                            <input type="password" class="col form-control mb-1" name="cnfrmPsswd" id="cnfrmPsswd" style="height: 50px; width: 250px;" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Masukkan Password Yang Sama' : '');" placeholder="konfirmasi password" required>
                            <div class="col-2">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary my-3" id="btnAddSgn" style="width:auto" data-bs-toggle="modal" data-bs-target="#addSgnModal"><i class="fas fa-plus mr-2"></i>Tambah Tanda Tangan</button>
                        <div id="signature"></div>
                    </div>    
                    <div class="form-group px-3 row">
                        <div class="float-right px-2 col my-0 py-0">
                            <button id="aktivasi" type="submit" class="btn btn-primary px-4">Aktivasi Akun</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>


<div class="modal fade mt-2" id="addSgnModal" tabindex="-1" aria-labelledby="addSgnForm" aria-hidden="true">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
    <script>
        $("#aktivasi").hide();
        var modalSave = new bootstrap.Modal(document.getElementById('addSgnModal'));
        var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            backgroundColor: 'rgb(255, 255, 255)',
            penColor: 'rgb(0, 0, 0)'
        });
        var saveButton = document.getElementById('save');
        var cancelButton = document.getElementById('clear');
        var clrButton = document.getElementById('hapus');
        saveButton.addEventListener('click', function (event) {
        var data = signaturePad.toDataURL("image/jpeg",1.0);
        var signature = "image=" + data;
            $.ajax({
                type: 'POST',
                url: "/guru/templates/savesignature",
                data: signature,
                success: function(hasil) {
                    $("#signature").html(hasil);
                }
            });
        $("#aktivasi").show();
        $("#btnAddSgn").hide();
        modalSave.toggle();
        });
        function hapus() {
            $("#btnAddSgn").show();
            $("#signature").html("");
            signaturePad.clear();
            $("#aktivasi").hide();
        };

        cancelButton.addEventListener('click', function (event) {
        signaturePad.clear();
        });

        $("#show-hide").click(function () {
            $('#icons').toggleClass("fa-eye-slash fa-eye");
            var input1 = $("#inputPsswd");
            var input2 = $("#cnfrmPsswd");
            if (input1.attr("type") == "password") {
                input1.attr("type", "text");
                input2.attr("type", "text");
            } else {
                input1.attr("type", "password");
                input2.attr("type", "password");
            }
        });
    </script>
  </body>
</html>