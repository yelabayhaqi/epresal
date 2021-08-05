<?php 
    echo $this->extend('templates/main');
    echo $this->section('page-content'); 
?>
<main id="main-content"> 
<?=$this->include('admin/templates/modalImportGuru')?>
<?=$this->include('admin/templates/modalTambahGuru')?>
<?=$this->include('admin/templates/modalDelGuru')?>
<?=$this->include('admin/templates/modalDelSingle')?>
<?=$this->include('admin/templates/modalEditGuru')?>
<?=$this->include('admin/templates/modalEditPiket')?>
<?=$this->include('admin/templates/modalShowAdmin')?>
    <div class="container-fluid px-1">
        <div class="pl-3 py-1 mt-4" style="border-bottom: 2px solid rgba(0,0,0,0.3);">
            <span class="text-dark fw-bold fs-5">Data User</span><br/>
            <span class="fs-5"><i>Guru Mapel dan BK</i></span>
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
        <div class="mx-2 my-4" style="box-shadow: 2px 1px 8px 1px rgba(0,0,0,0.2) !important;">
            <div class="text-light fw-bold py-2 pl-3 bg-secondary">
                <i class="fas fa-edit me-1"></i>
                Kelola Data
            </div>
            <div class="row mx-0 px-3 py-3">
                <button type="button" class="mx-1 my-1 btn btn-primary col" style="min-width: 210px" data-bs-toggle="modal" data-bs-target="#addGuruModal"><i class="fas fa-plus me-2"></i>Tambah Data</button>
                <button type="button" class="mx-1 my-1 btn btn-success col" style="min-width: 210px" data-bs-toggle="modal" data-bs-target="#insertGuruModal"><i class="fas fa-file-excel me-2"></i>Import File (.xls, .xlsx)</button>
                <button type="button" class="mx-1 my-1 btn btn-danger col" style="min-width: 210px" data-bs-toggle="modal" data-bs-target="#delGuruModal"><i class="fas fa-trash me-2"></i>Hapus Data</button>
            </div>
        </div>
        <div class="mx-2 my-4" style="box-shadow: 2px 1px 8px 1px rgba(0,0,0,0.2) !important;">
            <div class="text-light fw-bold py-2 pl-3 bg-secondary">
                <i class="fas fa-chalkboard-teacher me-1"></i>
                List User (<?=count($users)?>)
            </div>
            <div class="px-2 py-2">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th style="min-width: 160px !important;">Nama</th>
                            <th class="text-center" style="width: 60px !important;">Role</th>
                            <th class="text-center" style="width: 80px !important;">Status</th>
                            <th class="text-center" style="width: 90px !important; min-width: 90px !important;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?=$user['nip']?></td>
                            <td><?=$user['nama']?></td>
                            <td class="text-center" style="vertical-align: middle; width: 60px !important;">
                                <?php 
                                if($user['level'] == 1) echo "<span class=\"badge badge-danger\">Admin</span>";
                                else if($user['level'] == 2) echo "<span class=\"badge badge-success\">Guru</span>";
                                else if($user['level'] == 3) echo "<span class=\"badge badge-warning px-2\">BK</span>";
                                else if($user['level'] == 4) echo "<span class=\"badge badge-secondary px-2\">Piket</span>";
                                ?>
                            </td>
                            <td class="text-center" style="vertical-align: middle; width: 80px !important;">
                            <?php
                                if($user['active'] == 1) echo "<span class=\"badge bg-info rounded-pill\">active</span>";
                                else if($user['active'] == 0) echo "<span class=\"badge bg-danger rounded-pill\">non-active</span>";
                            ?>
                            </td>
                            <td class="text-center px-0 py-0" style="vertical-align: middle; width: 90px !important; min-width: 90px !important;">
                                <?php 
                                if($user['level'] == 1) echo "<button class=\"btn btn-secondary px-2 py-0 mx-1 mt-1\" onclick=\"swfunc" . $user['id'] . "()\"><i class=\"fas fa-eye py-0\" style=\"max-width:12px;\"></i></button>
                                <script>
                                var modalSw = new bootstrap.Modal(document.getElementById('showAdminModal'));
                                function swfunc" . $user['id'] . "(){
                                    $('#swNip').val('" . $user['nip'] . "'); 
                                    $('#swNama').val('" . $user['nama'] . "'); 
                                    $('#swUname').val('" . $user['username'] . "'); 
                                    modalSw.toggle();
                                };
                                </script>
                                ";
                                else if($user['level'] == 4) echo "
                                <button class=\"btn btn-warning px-2 py-0 mx-1 mt-1\" onclick=\"editfunc" . $user['id'] . "()\"><i class=\"fas fa-edit py-0\" style=\"max-width:12px;\"></i></button>
                                <script>
                                var modalPiket = new bootstrap.Modal(document.getElementById('editPiketModal'));
                                    function editfunc" . $user['id'] . "(){
                                        $('#editNipP').val('" . $user['nip'] . "'); 
                                        $('#editNamaP').val('" . $user['nama'] . "'); 
                                        $('#editUnameP').val('" . $user['username'] . "'); 
                                        $('#idswapeditP').val('" . $user['id'] . "'); 
                                        modalPiket.toggle();
                                    };
                                </script>
                                ";
                                else echo "
                                <button class=\"btn btn-warning px-2 py-0 mx-1 mt-1\" onclick=\"editfunc" . $user['id'] . "()\"><i class=\"fas fa-edit py-0\" style=\"max-width:12px;\"></i></button>
                                <button class=\"btn btn-danger px-2 py-0 mx-1 mt-1\" onclick=\"delfunc" . $user['id'] . "()\"><i class=\"fas fa-trash px-0\" style=\"max-width:12px;\"></i></button>
                                
                                <script>
                                var modalDelete = new bootstrap.Modal(document.getElementById('delGuruSingle'));
                                var modalEdit = new bootstrap.Modal(document.getElementById('editGuruModal'));
                                var modalReset = new bootstrap.Modal(document.getElementById('cnfReset'));
                                    function delfunc" . $user['id'] . "(){
                                        $('#cnfNipDel').val('" . $user['nip'] . "'); 
                                        $('#cnfNama').val('" . $user['nama'] . "'); 
                                        $('#idswap').val('" . $user['id'] . "'); 
                                        modalDelete.toggle();
                                    };
                                    function editfunc" . $user['id'] . "(){
                                        $('#editNip').val('" . $user['nip'] . "'); 
                                        $('#editNama').val('" . $user['nama'] . "'); 
                                        $('#editUname').val('" . $user['username'] . "'); 
                                        $('#idswapedit').val('" . $user['id'] . "'); 
                                        $('#idswapreset').val('" . $user['id'] . "');
                                        $('#nipswapreset').val('" . $user['nip'] . "'); 
                                        modalEdit.toggle();
                                    };
                                </script>
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
        document.getElementById("ad-dataguru").className="nav-link nav-link-activated";
        document.getElementById("ad-dataguru-icon").className="sb-nav-link-icon sb-nav-link-icon-activated";
        $("#btnReset").click(function(){
                modalEdit.toggle();
                modalReset.toggle();
        });
    } );
</script>
<?=$this->include('templates/footer')?>
<?=$this->endSection()?>


    