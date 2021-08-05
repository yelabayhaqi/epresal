<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no">
    <meta name="description" content="epresal-for_smkn_1_nganjuk-activation_id-120845327768.https://epresal.site-yels.com/120845327768">
    <meta name="author" content="bayhaqi-software">

    <title>E-JURNAL SMEKSA</title>

    <!-- Custom fonts for this template-->
    <link href="<?=base_url()?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=base_url()?>/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?=base_url()?>/css/login.css" rel="stylesheet">
</head>

<body style="background: linear-gradient(45deg, #115174 10%, #6ac1fc 90%);">

<div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card my-5 shadow bg-body rounded">
                    <div class="card-body p-3">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="pt-3">
                                    <div class="text-center">
                                        <div>
                                            <img src="<?=base_url()?>/assets/img/logo-smk.jpg" style="max-width: 50px;">
                                        </div>
                                        <h1 class="h4 text-gray-900 mb-0">E-JURNAL</h1>
                                        <span class="h6">Sistem Rekap jurnal dan Presensi</span><br/>
                                    </div>
                                    <div class="text-center my-3 mb-4">
                                        <span class="h3 text-gray-900 fw-bold">SMK Negeri 1 Nganjuk</span>
                                    </div>
                                    <hr class="sidebar-divider mx-3">
                                    <form class="user" action="<?=base_url()?>/login" method="post">
                                        <?= csrf_field() ?>
                                        <?php if(!empty(session()->getFlashdata('pesan'))){ ?>
                                            <div class="alert alert-danger mx-3" role="alert">
                                                <?= session()->getFlashData('pesan')?>
                                            </div>
                                        <?php } ?>
                                        <?php if(!empty(session()->getFlashdata('yarn'))){ ?>
                                            <div class="alert alert-success mx-3" role="alert">
                                                <?= session()->getFlashData('yarn')?>
                                            </div>
                                        <?php } ?>
                                        <div class="form-group px-3 my-1">
                                            <input type="text" name="username" class="form-control form-control-user fs-4 text-center" style="font-size: 20px;" placeholder="Username" required>
                                        </div>

                                        <div class="form-group px-3 my-1">
                                            <input type="password" name="password" class="form-control form-control-user fs-4 text-center" style="font-size: 20px;"placeholder="Password" required>
                                        </div>
                                        <div class="form-group px-3 mt-3">
                                            <button type="submit" class="btn btn-primary btn-user btn-block" style="font-size: 20px;">Login</button>
                                        </div>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?=base_url()?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?=base_url()?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=base_url()?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=base_url()?>/js/sb-admin-2.min.js"></script>

</body>

</html>