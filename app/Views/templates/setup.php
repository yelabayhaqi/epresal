<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="epresal-for_smkn_1_nganjuk-activation_id-120845327768.https://epresal.site-yels.com/120845327768"> <meta name="author" content="bayhaqi-software"> <link href="<?=base_url()?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?=base_url()?>/css/styles.css" rel="stylesheet">
    <link href="<?=base_url()?>/css/sb-admin-2.min.css" rel="stylesheet">
    <title>E-PRESAL | Setup</title>
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
            <div class="col-lg bg-light px-4 py-3">
                <p class="fs-4 fw-bold mb-1 text-center">Buat akun administrator dan Guru Piket (shared user) untuk melanjutkan</p>
                <form action="<?= base_url()?>/setup/setupadmin" style="max-width: 400px;" method="post">
                    <h4><b>Administrator</b></h4>
                    <div class="form-group px-3 mt-2">
                        <label for="inputNama" class="mx-0 my-0 px-0 py-0" style="font-size: 10pt; font-weight: bolder; color: #4197d1;">NAMA</label>
                        <div class="row mx-0 my-0 px-0 py-0">
                        <input type="text" class="col form-control" name="inputNama" style="height: 50px; width: 200px;" placeholder="Nama Administrator" required>
                            <div class="col-2">
                            </div>
                        </div>
                    </div>
                    <div class="form-group px-3 mt-2">
                        <label for="inputUname" class="mx-0 my-0 px-0 py-0" style="font-size: 10pt; font-weight: bolder; color: #4197d1;">BUAT USERNAME</label>
                        <div class="row mx-0 my-0 px-0 py-0">
                        <input type="text" class="col form-control" name="inputUname" style="height: 50px; width: 200px;" placeholder="username" required>
                            <div class="col-2">
                            </div>
                        </div>
                    </div>
                    <div class="form-group px-3">
                        <label for="inputPsswd" class="mx-0 my-0 px-0 py-0" style="font-size: 10pt; font-weight: bolder; color: #4197d1;">BUAT PASSWORD</label>
                        <div class="row mx-0 my-0 px-0 py-0">
                            <input type="password" class="col form-control mb-1" name="inputPsswd" id="inputPsswd" style="height: 50px;" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimal 6 Karakter' : ''); if(this.checkValidity()) form.cnfrmPsswd.pattern = this.value;" placeholder="password" required>
                            <div class="col-2">
                                <button id="show-hide1" class="btn btn-primary px-2 my-1" type="button">
                                    <i id="icons" class="fas fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row mx-0 my-0 px-0 py-0">
                            <input type="password" class="col form-control mb-1" name="cnfrmPsswd" id="cnfrmPsswd" style="height: 50px;" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Masukkan Password Yang Sama' : '');" placeholder="konfirmasi password" required>
                            <div class="col-2">
                            </div>
                        </div>
                    </div>  
                    <h4><b>Guru Piket</b></h4>
                    <div class="form-group px-3 mt-2">
                        <label for="inputUnameP" class="mx-0 my-0 px-0 py-0" style="font-size: 10pt; font-weight: bolder; color: #4197d1;">BUAT USERNAME</label>
                        <div class="row mx-0 my-0 px-0 py-0">
                        <input type="text" class="col form-control" name="inputUnameP" style="height: 50px; width: 250px;" placeholder="username" required>
                            <div class="col-2">
                            </div>
                        </div>
                    </div>
                    <div class="form-group px-3">
                        <label for="inputPsswd" class="mx-0 my-0 px-0 py-0" style="font-size: 10pt; font-weight: bolder; color: #4197d1;">BUAT PASSWORD</label>
                        <div class="row mx-0 my-0 px-0 py-0">
                            <input type="password" class="col form-control mb-1" name="inputPsswdP" id="inputPsswdP" style="height: 50px;" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimal 6 Karakter' : ''); if(this.checkValidity()) form.cnfrmPsswdP.pattern = this.value;" placeholder="password" required>
                            <div class="col-2">
                                <button id="show-hide2" class="btn btn-primary px-2 my-1" type="button">
                                    <i id="icons" class="fas fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row mx-0 my-0 px-0 py-0">
                            <input type="password" class="col form-control mb-1" name="cnfrmPsswdP" id="cnfrmPsswdP" style="height: 50px;" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Masukkan Password Yang Sama' : '');" placeholder="konfirmasi password" required>
                            <div class="col-2">
                            </div>
                        </div>
                    </div>
                    <div class="my-0 py-0">
                        <button type="submit" class="btn btn-primary px-4">Lanjutkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
    <script>
        $("#show-hide1").click(function () {
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
        $("#show-hide2").click(function () {
            $('#icons').toggleClass("fa-eye-slash fa-eye");
            var input1 = $("#inputPsswdP");
            var input2 = $("#cnfrmPsswdP");
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