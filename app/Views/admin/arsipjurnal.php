<?php 
    echo $this->extend('templates/main');
    echo $this->section('page-content'); 
?>
<main id="main-content">
    <div class="container-fluid px-1">
        <div class="pl-3 py-1 mt-4" style="border-bottom: 2px solid rgba(0,0,0,0.3);">
            <span class="text-dark fw-bold fs-5">Arsip Jurnal Kegiatan</span><br/>
            <span class="fs-5"><i>Jurnal Kegiatan / Tugas Tambahan Guru</i></span>
        </div> 
        <div class="mx-2 my-4" style="box-shadow: 2px 1px 8px 1px rgba(0,0,0,0.2) !important;">
            <div class="text-light fw-bold py-2 pl-3 bg-secondary">
                <i class="fas fa-chalkboard-teacher me-1"></i>
                Data Guru
            </div>
            <div class="px-2 py-2">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th style="min-width: 160px !important;">Nama</th>
                            <th class="text-center" style="width: 130px !important; min-width: 130px !important;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?=$user['nip']?></td>
                            <td><?=$user['nama']?></td>
                            <td class="text-center px-0 py-0" style="vertical-align: middle; max-width: 130px !important;">
                            <a href="<?=base_url()?>/admin/arsip/jurnalkegiatan/show/<?=$user['id']?>/<?=date("m",time ())?>/<?=date("Y",time ())?>" class="btn btn-primary px-2 my-1"><i class="fas fa-folder me-3"></i>Lihat Data</a>
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
        document.getElementById("ad-jurnal").className="nav-link nav-link-activated";
        document.getElementById("ad-jurnal-icon").className="sb-nav-link-icon sb-nav-link-icon-activated";
        $("#btnReset").click(function(){
                modalEdit.toggle();
                modalReset.toggle();
        });
    } );
</script>
<?=$this->include('templates/footer')?>
<?=$this->endSection()?>


    