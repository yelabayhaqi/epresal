<?php 
    echo $this->extend('templates/main');
    echo $this->section('page-content'); 
?>
<main id="main-content"> 
<?=$this->include('admin/templates/addTugasModal')?>
<?=$this->include('admin/templates/editTugasModal')?>
<?=$this->include('admin/templates/modalDelTugas')?>
<?=$this->include('admin/templates/importTugasModal')?>
    <div class="container-fluid px-1 mt-4">
        <div class="row mx-0">
            <div class="col">
                <div class="row mx-0" style="border-bottom: 1px solid gray; min-width: 270px;">
                    <a id="presmenu" class="col text-center menu-link menu-link-activated my-0 px-1 py-1"><span>Tugas Tambahan</span></a>
                    <a href="<?=base_url()?>/admin/wali" id="jrnlmenu" class="col text-center menu-link my-0 px-1 py-1"><span>Wali Kelas</span></a>
                </div>
            </div>
        </div>
        <?php if(session()->getFlashdata('pesan')) {?>
            <div class="alert alert-success my-1 mx-2" role="alert">
                <?= session()->getFlashdata('pesan') ?>
            </div>
        <?php 
        } else if(session()->getFlashdata('error')) {?>
            <div class="alert alert-danger my-1 mx-2" role="alert">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php }?>
        <div class="mx-2 my-2" style="box-shadow: 2px 1px 8px 1px rgba(0,0,0,0.2) !important;">
            <div class="text-light fw-bold py-2 pl-3 bg-secondary">
                <i class="fas fa-table me-1"></i>
                Tugas Tambahan
            </div>
            <div class="h5 fw-bold row py-2 mx-2 my-0">
                <button type="button" class="col btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#addTugasModal"><i class="fas fa-plus mr-2"></i>Tambah Tugas</button>
                <button type="button" class="col btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#importTugasModal"><i class="fas fa-file-excel mr-2"></i>Import Tugas</button>
                <button type="button" class="col btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#delTugasModal"><i class="fas fa-trash mr-2"></i>Hapus Semua Tugas</button>
            </div>
            <div class="row mx-2">
                        <?php 
                        if($tugas == NULL){?>
                            <label class="text-center fs-5">Data Tugas Tambahan Kosong</label>
                        <?php } 
                        $recent = '-';
                        foreach ($tugas as $dat) :
                            if($dat['kategori'] == "wali kelas") continue;
                            $this->db = \Config\Database::connect();
                            $guru = $this->db->table('tugas_guru')->select()
                            ->join('tugas','tugas_guru.id_tugas = tugas.id', 'left')
                            ->join('users','tugas_guru.id_guru = users.id','left')
                            ->where('tugas.id',$dat['id'])
                            ->orderBy('users.nama','asc')
                            ->get()->getResultArray();
                            if($dat['kategori'] != $recent){ $recent = $dat['kategori'];?>
                                <span style="color: black;" class="mx-0 px-0 fw-bold">- <?=$recent?></span>
                            <?php } ?>
                            <div class="modal fade mt-4" id="delTugasSingle<?=$dat['id']?>" tabindex="-1" aria-labelledby="delTugasFormSingle<?=$dat['id']?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header py-2">
                                            <h5 class="modal-title">Konfirmasi</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <h3 class="text-dark fs-6">Hapus Data Tugas Tambahan?</h3>
                                            </div>
                                            <div class="modal-footer px-0 py-0 pt-1">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                                <a href="<?=base_url()?>/admin/tugas/deltugas/<?=$dat['id']?>" type="submit" class="btn btn-danger">HAPUS DATA</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card px-1 py-1 mb-1 pl-2 fw-bold" style="color: black; min-width: 300px;">
                                <div class="row mx-0">
                                    <?php if ($guru != NULl){?>
                                    <div class="col-auto px-0" id="chev<?=$dat['id']?>">
                                        <div id="show-icondown-<?=$dat['id']?>" class="col show-icon hov-mapel mx-0 px-0 pr-1" onclick="show<?=$dat['id']?>()">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                        <div id="show-iconup-<?=$dat['id']?>" class="col hide-icon hov-mapel mx-0 px-0 pr-1" onclick="show<?=$dat['id']?>()">
                                            <i class="fas fa-chevron-up"></i>
                                        </div>
                                    </div>
                                    <?php }  else {?>
                                    <div class="col-auto px-0">
                                        <div class="col show-icon hov-mapel mx-0 px-0 pr-1">
                                            <i class="fas fa-chevron-down text-white"></i>
                                        </div>
                                        <div class="col hide-icon hov-mapel mx-0 px-0 pr-1">
                                            <i class="fas fa-chevron-up text-white"></i>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div onclick="show<?=$dat['id']?>()" class="col pl-1 hov-mapel"><?=$dat['nama_tugas']?></div>
                                    <div class="col-auto px-0 mx-0">
                                        <button type="button" class="btn btn-primary px-2 py-0" onclick="editTugas<?=$dat['id']?>()">
                                            <i class="fas fa-pen text-white"></i>
                                        </button>
                                        <a data-bs-toggle="modal" data-bs-target="#delTugasSingle<?=$dat['id']?>" class="btn btn-danger px-2 py-0">
                                            <i class="fas fa-trash text-white"></i>
                                        </a>
                                    </div>
                                </div>
                                <div id="listmapel-<?=$dat['id']?>" class="row hide-mapel">
                                    <div class="mx-0">
                                        <div class="list-group list-group-flush ml-2 pr-0">
                                            <?php 
                                            foreach ($guru as $g) :?>
                                                <div class="list-group-item text-dark fs-6 fw-normal px-1 py-1 ml-3 me-5">
                                                    <?=$g['nama']?>
                                                </div>
                                            <?php endforeach;
                                        ?> 
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    var toogle<?=$dat['id']?> = false;
                                    var ischeck<?=$dat['id']?> = false;
                                    function show<?=$dat['id']?>(){
                                        if (toogle<?=$dat['id']?> == false){
                                            document.getElementById("listmapel-<?=$dat['id']?>").className = "row show-mapel";
                                            document.getElementById("show-iconup-<?=$dat['id']?>").className = "col show-icon hov-mapel mx-0 px-0 pr-1";
                                            document.getElementById("show-icondown-<?=$dat['id']?>").className = "col hide-icon hov-mapel mx-0 px-0 pr-1";
                                            toogle<?=$dat['id']?> = true;
                                        } else {
                                            document.getElementById("listmapel-<?=$dat['id']?>").className = "row hide-mapel";
                                            document.getElementById("show-iconup-<?=$dat['id']?>").className = "col hide-icon hov-mapel mx-0 px-0 pr-1";
                                            document.getElementById("show-icondown-<?=$dat['id']?>").className = "col show-icon hov-mapel mx-0 px-0 pr-1";
                                            toogle<?=$dat['id']?> = false;
                                        }
                                    }
                                    function editTugas<?=$dat['id']?>(){
                                        $('#editTugas').val('<?=$dat['nama_tugas']?>');
                                        $('#editKtg').val('<?=$dat['kategori']?>');
                                        $('#idTugas').val('<?=$dat['id']?>');
                                        modalEdit.toggle();
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


    