<?php 
    echo $this->extend('templates/main');
    echo $this->section('page-content'); 
?>
<main id="main-content"> 
<?=$this->include('admin/templates/modalDelMapel')?>
    <div class="container-fluid px-1">
        <div class="pl-3 py-1 mt-4" style="border-bottom: 2px solid rgba(0,0,0,0.3);">
            <span class="text-dark fw-bold fs-5">Data Mata Pelajaran</span><br/>
            <span class="fs-5"><i>Mata Pelajaran Tiap Kelas</i></span>
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
                <a href="<?=base_url()?>/admin/datamapel/editmapel" type="button" class="mx-1 my-1 btn btn-success col" style="min-width: 210px" ><i class="fas fa-pen me-2"></i>Tambah atau Ubah Data</a>
                <button type="button" class="mx-1 my-1 btn btn-danger col" style="min-width: 210px" data-bs-toggle="modal" data-bs-target="#delMapelModal"><i class="fas fa-trash me-2"></i>Hapus Data</button>
            </div>
        </div>
        <div class="mx-2 my-4" style="box-shadow: 2px 1px 8px 1px rgba(0,0,0,0.2) !important;">
            <div class="text-light fw-bold py-2 pl-3 bg-secondary">
                <i class="fas fa-table me-1"></i>
                Mata Pelajaran
            </div>
            <div class="container px-0">
                <div class="row justify-content-start">
                    <div class="col-md-3">
                        <div class="col py-2">
                            Tampilkan : 
                        </div>
                        <div class="col">
                            <select id="pilihkelas" class="form-select" aria-label="select kelas">
                                <option value="semua" selected>Semua</option>
                            <?php $i = 0; foreach ($kelas as $dat) :?>
                                <option value="<?=$dat['nama_kelas']?>"><?=$dat['nama_kelas']?></option>
                            <?php $i++; endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg px-4">
                        <table class="table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 140px;" >Kelas</td>
                                    <th class="text-center">Mata Pelajaran</td>
                                </tr>  
                            </thead>
                            <tbody id="list"></tbody>
                        </table>            
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function() {
        document.getElementById("ad-datamapel").className="nav-link nav-link-activated";
        document.getElementById("ad-datamapel-icon").className="sb-nav-link-icon sb-nav-link-icon-activated";
        $.ajax({
			type: 'POST',
			url: "/admin/templates/listmapel",
			data: "kelas=semua",
			success: function(hasil) {
				$("#list").html(hasil);
			}
    	});
        $('#pilihkelas').on('change', function() {
            var pilihan = "kelas="+this.value;
            $.ajax({
			type: 'POST',
			url: "/admin/templates/listmapel",
			data: pilihan,
			success: function(hasil) {
				$("#list").html(hasil);
			}
    	    });
        });
    });
</script>
<?=$this->include('templates/footer')?>
<?=$this->endSection()?>


    