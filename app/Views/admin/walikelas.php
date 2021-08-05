<?php 
    echo $this->extend('templates/main');
    echo $this->section('page-content'); 
    $this->db = \Config\Database::connect();
    $swapname = "";
?>
<main id="main-content"> 
<?=$this->include('admin/templates/addWaliModal')?>
<?=$this->include('admin/templates/modalDelWali')?>
<?=$this->include('admin/templates/importWaliModal')?>
    <div class="container-fluid px-1 mt-4">
        <div class="row mx-0">
            <div class="col">
                <div class="row mx-0" style="border-bottom: 1px solid gray; min-width: 270px;">
                    <a href="<?=base_url()?>/admin/tugas" id="tugas" class="col text-center menu-link my-0 px-1 py-1"><span>Tugas Tambahan</span></a>
                    <a id="wali" class="col text-center menu-link menu-link-activated my-0 px-1 py-1"><span>Wali Kelas</span></a>
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
        <div class="mx-2 my-2" style="box-shadow: 2px 1px 8px 1px rgba(0,0,0,0.2) !important;">
            <div class="text-light fw-bold py-2 pl-3 bg-secondary">
                <i class="fas fa-table me-1"></i>
                Data Wali Kelas
            </div>
            <div class="h5 fw-bold row py-2 mx-2 my-0">
                <button type="button" class="col btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#importWaliModal"><i class="fas fa-file-excel mr-2"></i>Import Wali Kelas</button>
                <button type="button" class="col btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#delWaliModal"><i class="fas fa-trash mr-2"></i>Hapus Semua Data Wali Kelas</button>
            </div>
            <div class="row mx-3 px-0">
                        <?php 
                        if($kelas == NULL){?>
                            <label class="text-center fs-5">Data Tugas Tambahan Kosong</label>
                        <?php } 
                        foreach ($kelas as $dat) :
                            $guru = $this->db->table('tugas_guru')->select('users.id,users.nama')
                            ->join('tugas','tugas_guru.id_tugas = tugas.id', 'left')
                            ->join('users','tugas_guru.id_guru = users.id','left')
                            ->where('tugas.nama_tugas',$dat['nama_kelas'])
                            ->get()->getResultArray();?>
                            <div class="card px-1 py-1 mb-1 pl-2 fw-bold" style="color: black; min-width: 300px;">
                                <div class="row mx-0">
                                    <div class="col pl-1"><?=$dat['nama_kelas']?></div>
                                    <div class="col-auto px-0 mx-0">
                                        <?php if($guru == NULL) {?>
                                        <button id="btn-add<?=$dat['id']?>" type="button" class="btn btn-primary px-2 py-0" onclick="addWali<?=$dat['id']?>()">
                                            <i class="fas fa-plus text-white"></i>
                                        </button>
                                        <button id="btn-edit<?=$dat['id']?>" type="button" class="btn btn-primary px-0 py-0 hide-mapel width-zero" onclick="editWali<?=$dat['id']?>()">
                                            <i class="fas fa-pen text-white"></i>
                                        </button>
                                        <?php } else {?>
                                        <button id="btn-edit<?=$dat['id']?>" type="button" class="btn btn-primary px-2 py-0 mr-1" onclick="editWali<?=$dat['id']?>()">
                                            <i class="fas fa-pen text-white"></i>
                                        </button>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div id="listguru-<?=$dat['id']?>" class="row">
                                    <div class="mx-0">
                                        <div id="guruwali<?=$dat['id']?>" class="list-group list-group-flush ml-2 pr-0">
                                            <?php 
                                            foreach ($guru as $g) : $swapname = $g['id'];?>
                                                <div class="list-group-item text-dark fs-6 fw-normal px-1 py-1 ml-2 me-5">
                                                    <?=$g['nama']?>
                                                </div>
                                            <?php endforeach;
                                        ?> 
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="current-wali<?=$dat['id']?>" value="<?=$swapname?>"/>
                                <script>
                                    function addWali<?=$dat['id']?>(){
                                        $('#inputWali').val('-');
                                        $('#inputKelas').val('<?=$dat['nama_kelas']?>');
                                        $('#idKelas').val('<?=$dat['id']?>');
                                        document.getElementById("addbtn").className="btn btn-primary";
                                        document.getElementById("editbtn").className="btn btn-primary hide-mapel width-zero";
                                        modalAdd.toggle();
                                    };
                                    function editWali<?=$dat['id']?>(){
                                        $('#inputWali').val($('#current-wali<?=$dat['id']?>').val());
                                        $('#inputKelas').val('<?=$dat['nama_kelas']?>');
                                        $('#idKelas').val('<?=$dat['id']?>');
                                        document.getElementById("addbtn").className="btn btn-primary hide-mapel width-zero";
                                        document.getElementById("editbtn").className="btn btn-primary";
                                        modalAdd.toggle();
                                    };
                                </script>
                            </div>
                        <?php endforeach; ?>
                    </div>
        </div>
        
    </div>
</main>
<script>
    $(document).ready(function() {
        document.getElementById("ad-datatugas").className="nav-link nav-link-activated";
        document.getElementById("ad-datatugas-icon").className="sb-nav-link-icon sb-nav-link-icon-activated";
    });
</script>
<?=$this->include('templates/footer')?>
<?=$this->endSection()?>


    