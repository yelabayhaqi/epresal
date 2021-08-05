<?php 
    echo $this->extend('templates/main');
    echo $this->section('page-content'); 
?>
<main id="main-content"> 
    <?=$this->include('admin/templates/modalImportSiswa')?>
    <?=$this->include('admin/templates/modalTambahSiswa')?>
    <?=$this->include('admin/templates/modalDelSiswa')?>
    <?=$this->include('admin/templates/modalDelSiswaSingle')?>
    <?=$this->include('admin/templates/modalEditSiswa')?>
    <div class="container-fluid px-1">
        <div class="pl-3 py-1 mt-4" style="border-bottom: 2px solid rgba(0,0,0,0.3);">
            <span class="text-dark fw-bold fs-5">Data Siswa</span><br/>
            <span class="fs-5"><i>SMK Negeri 1 Nganjuk</i></span>
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
                <button type="button" class="mx-1 my-1 btn btn-primary col" style="min-width: 210px" data-bs-toggle="modal" data-bs-target="#addSiswaModal"><i class="fas fa-plus me-2"></i>Tambah Data Manual</button>
                <button type="button" class="mx-1 my-1 btn btn-success col" style="min-width: 210px" data-bs-toggle="modal" data-bs-target="#insertSiswaModal"><i class="fas fa-file-excel me-2"></i>Import File (.xls, .xlsx)</button>
                <button type="button" class="mx-1 my-1 btn btn-danger col" style="min-width: 210px" data-bs-toggle="modal" data-bs-target="#delSiswaModal"><i class="fas fa-trash me-2"></i>Hapus Data</button>
            </div>
        </div>
        <div class="mx-2 my-4" style="box-shadow: 2px 1px 8px 1px rgba(0,0,0,0.2) !important;">
            <div class="text-light fw-bold py-2 pl-3 bg-secondary">
                <i class="fas fa-users me-1"></i>
                List Siswa (<?=count($siswa)?>)
            </div>
            <div class="px-2 py-2">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px !important; min-width: 60px !important;">NIS</th>
                            <th class="text-center" style="width: 100px !important; min-width: 100px !important;">NISN</th>
                            <th style="min-width: 160px !important;">Nama</th>
                            <th class="text-center" style="min-width: 80px !important;">Kelas</th>
                            <th class="text-center" style="width: 90px !important; min-width: 90px !important;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($siswa as $dat) : ?>
                        <tr>
                            <td class="text-center px-1" style="width: 60px !important; min-width: 60px !important;"><?=$dat['nis']?></td>
                            <td class="text-center px-1" style="width: 100px !important; min-width: 100px !important;"><?=$dat['nisn']?></td>
                            <td class="px-1" style="min-width: 160px !important;"><?=$dat['nama']?></td>
                            <td class="px-1 text-center" style="min-width: 80px !important;"><?=$dat['kelas']?></td>
                            <td class="text-center px-0 py-0" style="vertical-align: middle; width: 90px !important; min-width: 90px !important;">
                                <button class="btn btn-warning px-2 py-0 mx-1 mt-1" onclick="editfunc<?=$dat['id']?>()"><i class="fas fa-edit py-0" style="max-width:12px;"></i></button>
                                <button class="btn btn-danger px-2 py-0 mx-1 mt-1" onclick="delfunc<?=$dat['id']?>()"><i class="fas fa-trash px-0" style="max-width:12px;"></i></button>
                                <script>
                                    var modalDelete = new bootstrap.Modal(document.getElementById('delSiswaSingle'));
                                    var modalEdit = new bootstrap.Modal(document.getElementById('editSiswaModal'));
                                    function delfunc<?=$dat['id']?>(){
                                        $('#cnfNisnDel').val('<?=$dat['nisn']?>'); 
                                        $('#cnfNisDel').val('<?=$dat['nis']?>'); 
                                        $('#cnfNama').val('<?=$dat['nama']?>'); 
                                        $('#cnfKelas').val('<?=$dat['kelas']?>'); 
                                        $('#idswap').val('<?=$dat['id']?>'); 
                                        modalDelete.toggle();
                                    };
                                    function editfunc<?=$dat['id']?>(){
                                        $('#editNis').val('<?=$dat['nis']?>'); 
                                        $('#editNisn').val('<?=$dat['nisn']?>'); 
                                        $('#editNama').val('<?=$dat['nama']?>'); 
                                        $('#editKelas').val('<?=$dat['kelas']?>'); 
                                        $('#idswapedit').val('<?=$dat['id']?>'); 
                                        modalEdit.toggle();
                                    };
                                </script>
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
        document.getElementById("ad-datasiswa").className="nav-link nav-link-activated";
        document.getElementById("ad-datasiswa-icon").className="sb-nav-link-icon sb-nav-link-icon-activated";
    } );
</script>
<?=$this->include('templates/footer')?>
<?=$this->endSection()?>
<?=$this->section('script')?>
<?=$this->endSection()?>


    