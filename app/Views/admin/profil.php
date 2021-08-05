<?php 
    echo $this->extend('templates/main');
    echo $this->section('page-content'); 
?>
<?= $this->include('guru/templates/modalEditUname')?>
<main id="main-content"> 
    <div class="container-fluid px-1">
        <div class="pl-3 py-1 mt-4" style="border-bottom: 2px solid rgba(0,0,0,0.3);">
            <span class="text-dark fw-bold fs-5">Profil</span><br/>
            <span class="fs-5"><i>Edit Profil Admin</i></span>
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
                <table class="text-white">
                    <tr>
                        <td rowspan="3" style="font-size: 100px">
                            <i class="fas fa-user mr-2"></i>
                        </td>
                        <td>
                            <span class="fs-3 fw-bolder"><?=session()->get('nama')?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="mr-2">Username</span>
                            <span class="fw-bolder badge fs-5" style="background-color: rgba(12,180,220,1); min-width: 50px;"><?=session()->get('username')?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button class="btn btn-light fw-bold mt-3" data-bs-toggle="modal" data-bs-target="#editUnameModal">Ubah Username / Password</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</main>
<script>
    document.getElementById("user-profile").className = "nav-link nav-link-activated";
    document.getElementById("user-profile-icon").className = "sb-nav-link-icon sb-nav-link-icon-activated";
</script>
<?=$this->include('templates/footer')?>
<?=$this->endSection()?>


    