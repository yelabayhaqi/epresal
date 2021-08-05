<?php 
    echo $this->extend('templates/main');
    echo $this->section('page-content'); 
?>
<main id="main-content"> 
<?=$this->include('admin/templates/addKelasModal')?>
<?=$this->include('admin/templates/importKelasModal')?>
<?=$this->include('admin/templates/delKelasModal')?>
<?=$this->include('admin/templates/addMapelModal')?>
<?=$this->include('admin/templates/importMapelModal')?>
<?=$this->include('admin/templates/delMapelModal')?>
<script>
    var selected = "";
    var kelasAll = false;
    $(document).ready(function() {
        document.getElementById("ad-datamapel").className="nav-link nav-link-activated";
        document.getElementById("ad-datamapel-icon").className="sb-nav-link-icon sb-nav-link-icon-activated";
        $('#selAll').on('change', function() {
            kelasAll = !kelasAll;
            selected = "";
            $('[id="kelascheck"]').prop('checked',kelasAll);
            if(kelasAll) {
                selMapel = allMapel;
                <?php foreach($kelas as $k){?>
                    selected += "<div class=\"badge bg-success px-1 py-1 mx-1 my-1\"> <?=$k['nama_kelas']?> </div>";
                <?php } ?>
                <?php foreach($kelas as $k){?>
                    ischeck<?=$k['id']?> = true;
                <?php } ?>
            } else {
                selMapel = [];
                selected = "";
                <?php foreach($kelas as $k){?>
                    ischeck<?=$k['id']?> = false;
                <?php } ?>
            }
            $("#daftarpilih").html(selected);
            updateTampil();
        });
    });
    var selKelas = [];
    var allMapel = [];
    var sAllMapel = [];
    var selMapel = [];
    var selTampil = [];
    function addCheck(){
        var mapswap = [];
        for(var x=0; x<allMapel.length;x++){
            if(selKelas[selKelas.length-1] == allMapel[x][0]){
                var mapswap = allMapel[x][1];
                break;
            }
        }
        if(mapswap.length > 0){
            selMapel.push([[selKelas[selKelas.length-1]],mapswap]);
        } else {
            selMapel.push([[selKelas[selKelas.length-1]],['0']]);
        }
        updateTampil();
    }
    function remCheck(idKel){
        for(var i=0;i<selMapel.length;i++){
            if(selMapel[i][0] == idKel){
                selMapel.splice(i,1);
            }
        }
        updateTampil();
    }
    function count_duplicate(a){
        let counts = {}
        let swparr = [];
        for(let i =0; i < a.length; i++){ 
            if (counts[a[i]]){
            counts[a[i]] += 1
            } else {
            counts[a[i]] = 1
            }
            }  
            for (let prop in counts){
                if (counts[prop] == selMapel.length){
                    swparr.push(prop);
                }
        }
        return swparr;
    }
    function updateTampil(){
        var data = [];
        $('.selMap').prop('checked', false);
        for(var i=0;i<selMapel.length;i++){
            var s = selMapel[i][1];
            for(var n=0;n<s.length;n++){
                data.push(s[n]);
            }
        }
        if(selMapel.length > 1){
            selTampil = count_duplicate(data);
        } else {
            selTampil = data;
        }
        for(var i=0;i<selTampil.length;i++){
            $("#selMap"+selTampil[i]).prop('checked', true);
        }
    }
    function delSingle(kelas,mapel){
        $.ajax({
			type: 'POST',
			url: "/admin/templates/mapeldelsingle",
			data: "kelas="+kelas+"&mapel="+mapel,
			success: function(hasil) {
                $("#listmapel-"+kelas).html(hasil);
			}
    	});
        for(var i=0;i < allMapel.length;i++){
            if(allMapel[i][0] == kelas){
                allMapel[i][1].splice(allMapel[i][1].indexOf(mapel),1);
            }
        }
    }
    function delAll(kelas){
        $.ajax({
			type: 'POST',
			url: "/admin/templates/mapeldelall",
			data: "kelas="+kelas,
			success: function(hasil) {
                $("#listmapel-"+kelas).html(hasil);
			}
    	});
        for(var i=0;i < allMapel.length;i++){
            if(allMapel[i][0] == kelas){
                allMapel[i][1] = [];
            }
        }
    }
</script>
    <div class="container-fluid px-1">
        <div class="px-0 py-1 mx-0 mt-4" style="border-bottom: 2px solid rgba(0,0,0,0.3);">
            <div class="row mx-0 px-0" style=" vertical-align: middle;">
                <div class="col-auto" style="min-width: 120px; border-right: 2px solid rgba(0,0,0,0.3);"><a href="<?=base_url()?>/admin/datamapel" type="button" class="col-auto btn btn-light "><i class="fas fa-arrow-left mr-2"></i>Kembali</a></div>
                <div class="col">
                    <span class="text-dark fw-bold fs-5">Kelola Mata Pelajaran</span><br/>
                    <span class="fs-5"><i>Ubah Data Mata Pelajaran</i></span>
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

        <div class="mx-2 my-4" style="box-shadow: 2px 1px 8px 1px rgba(0,0,0,0.2) !important;">
            <form action="<?= base_url()?>/admin/datamapel/savemapel" method="post">
            <div class="text-light fw-bold py-2 pl-3 bg-secondary">
                <i class="fas fa-edit me-1"></i>
                Kelola Data
            </div>
            <div class="row mx-0 px-0 py-3">
                <div class="col mx-2" style="box-shadow: 1px 1px 8px 1px rgba(0,0,0,0.2) !important;">
                    <div class="h5 fw-bold bg-primary row py-2 my-0">
                        <span class="text-center text-light col">Data Kelas</span>
                    </div>
                    <div class="h5 fw-bold row py-2 px-2 my-0">
                        <button type="button" class="col btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#addKelasModal"><i class="fas fa-plus mr-2"></i>Tambah manual</button>
                        <button type="button" class="col btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#importKelasModal"><i class="fas fa-file-excel mr-2"></i>Import Excel</button>
                        <button type="button" class="col btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#delKelasModal"><i class="fas fa-trash mr-2"></i>Hapus Data</button>
                    </div>
                    <label class="px-0 py-0 mx-0 my-0 ml-4 mb-2 hov-mapel">
                        <input class="form-check-input me-2" type="checkbox" id="selAll">
                        <span class="ml-2"><i>Pilih Semua</i></span>
                    </label>
                    <div class="row px-3 overflow-auto" style="height: 550px; max-height: 550px;">
                        <?php 
                        if($kelas == NULL){?>
                            <label class="text-center fs-5">Data Kelas Kosong</label>
                        <?php } 
                        foreach ($kelas as $dat) :
                            $this->db = \Config\Database::connect();
                            $mapel = $this->db->table('kelas_has_mapel')->select()
                            ->join('mapel','kelas_has_mapel.mapel = mapel.id', 'left')
                            ->where('kelas_has_mapel.kelas', $dat['id'])->orderBy('kategori','asc')->orderBy('nama_mapel','asc')
                            ->get()->getResultArray();?>
                            <div class="card px-1 py-1 mb-1 pl-2 fw-bold" style="color: black; min-width: 300px;">
                                <div class="row">
                                    <div class="col">
                                    <label class="px-0 py-0 mx-0 my-0 ml-4 hov-mapel">
                                        <input class="form-check-input me-2" type="checkbox" value="1" id="kelascheck" name="selKelas<?=$dat['id']?>">
                                        <span class="ml-2"><?=$dat['nama_kelas']?></span>
                                    </label>
                                    </div>
                                    <?php if ($mapel != NULl){?>
                                    <div class="col-auto hov-mapel" id="chev<?=$dat['id']?>">
                                        <div id="show-icondown-<?=$dat['id']?>" class="col show-icon" onclick="show<?=$dat['id']?>()">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                        <div id="show-iconup-<?=$dat['id']?>" class="col hide-icon" onclick="show<?=$dat['id']?>()">
                                            <i class="fas fa-chevron-up"></i>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div id="listmapel-<?=$dat['id']?>" class="row hide-mapel">
                                    <div class="mx-0">
                                        <div class="list-group list-group-flush ml-2 pr-0">
                                            <?php 
                                            $kat = "-";          
                                            foreach ($mapel as $mp) :
                                            if($mp['kategori'] != $kat){?>
                                                <label class="fw-normal text-center py-0 my-0"><i><?=$mp['kategori']?></i></label>
                                            <?php $kat = $mp['kategori']; } ?>
                                                <script>
                                                    sAllMapel.push(<?=$mp['id']?>);
                                                </script>
                                                <div class="list-group-item text-dark fs-6 fw-normal px-1 py-1 ml-3 me-5">
                                                    <?=$mp['nama_mapel']?>
                                                    <button type="button" class="btn btn-danger float-right px-2 py-0" onclick="delSingle(<?=$dat['id']?>,<?=$mp['id']?>)">
                                                        <i class="fas fa-trash text-white"></i>
                                                    </button>
                                                </div>
                                            <?php endforeach;
                                        ?> 
                                        </div>
                                    </div>
                                    <div class="mx-0 text-center">
                                        <button type="button" class="btn btn-secondary mx-4 px-3 py-0" onclick="delAll(<?=$dat['id']?>)"><i class="fas fa-trash me-3"></i>Hapus Semua</button>
                                    </div>
                                </div>

                                <script>
                                    allMapel.push([[<?=$dat['id']?>],sAllMapel]);
                                    sAllMapel = [];
                                    var toogle<?=$dat['id']?> = false;
                                    var ischeck<?=$dat['id']?> = false;
                                    function show<?=$dat['id']?>(){
                                        if (toogle<?=$dat['id']?> == false){
                                            document.getElementById("listmapel-<?=$dat['id']?>").className = "row show-mapel";
                                            document.getElementById("show-iconup-<?=$dat['id']?>").className = "col show-icon";
                                            document.getElementById("show-icondown-<?=$dat['id']?>").className = "col hide-icon";
                                            toogle<?=$dat['id']?> = true;
                                        } else {
                                            document.getElementById("listmapel-<?=$dat['id']?>").className = "row hide-mapel";
                                            document.getElementById("show-iconup-<?=$dat['id']?>").className = "col hide-icon";
                                            document.getElementById("show-icondown-<?=$dat['id']?>").className = "col show-icon";
                                            toogle<?=$dat['id']?> = false;
                                        }
                                    }
                                    $('input[name="selKelas<?=$dat['id']?>"]').on('change', function() {
                                        ischeck<?=$dat['id']?> = !ischeck<?=$dat['id']?>;
                                        if(ischeck<?=$dat['id']?>){
                                            selected += "<div class=\"badge bg-success px-1 py-1 mx-1 my-1\"> <?=$dat['nama_kelas']?> </div>";
                                            selKelas.push(<?=$dat['id']?>);
                                            addCheck();
                                        } else {
                                            selected = selected.replace("<div class=\"badge bg-success px-1 py-1 mx-1 my-1\"> <?=$dat['nama_kelas']?> </div>","");
                                            if (selKelas.indexOf(<?=$dat['id']?>) > -1) {
                                                selKelas.splice(selKelas.indexOf(<?=$dat['id']?>), 1);
                                            }
                                            remCheck(<?=$dat['id']?>);
                                            kelasAll = false;
                                            $('[id="selAll"]').prop('checked',false);
                                        }
                                        $("#daftarpilih").html(selected);
                                    });
                                </script>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="col mx-2" style="box-shadow: 1px 1px 8px 1px rgba(0,0,0,0.2) !important;">
                    <div class="h5 fw-bold bg-primary row py-2 my-0">
                        <span class="text-center text-light col">Data Mata Pelajaran</span>
                    </div>
                    <div class="h5 fw-bold row py-2 px-2 my-0">
                        <button type="button" class="col btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#addMapelModal"><i class="fas fa-plus mr-2"></i>Tambah manual</button>
                        <button type="button" class="col btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#importMapelModal"><i class="fas fa-file-excel mr-2"></i>Import Excel</button>
                        <button type="button" class="col btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#delMapelModal"><i class="fas fa-trash mr-2"></i>Hapus Data</button>
                    </div>
                    <div class="row px-3">
                        <div class="card px-1 py-1 mt-1 pl-2 overflow-auto" style="min-width: 300px; max-height: 560px;">
                            <?php 
                            $this->db = \Config\Database::connect();
                            $mapel = $this->db->table('mapel')->select()->orderBy('kategori','asc')->orderBy('nama_mapel','asc')
                            ->get()->getResultArray();
                            if($mapel == NULL) echo "<label class=\"text-center fs-5\">Data Mata Pelajaran Kosong</label></div>";
                            else {
                            $kat = "-";
                            foreach ($mapel as $mp) :
                                if($mp['kategori'] == $kat){
                                    ?>
                                    <div class="row">
                                        <div class="col">
                                        <label class="px-0 py-0 mx-0 my-0 ml-5 hov-mapel">
                                            <input class="form-check-input me-2 selMap" type="checkbox" name="selMapel<?=$mp['id']?>" id="selMap<?=$mp['id']?>">
                                            <span class="ml-2"><?=$mp['nama_mapel']?></span>
                                        </label>
                                        </div>
                                    </div>
                                    <?php 
                                } else {
                                    $kat = $mp['kategori'];
                                    ?>
                                    <label class="mx-0 my-0 mt-1 ml-2"><?=$kat?></label>
                                    <div class="row">
                                        <div class="col">
                                        <label class="px-0 py-0 mx-0 my-0 ml-5 hov-mapel">
                                            <input class="form-check-input me-2 selMap" type="checkbox" name="selMapel<?=$mp['id']?>" id="selMap<?=$mp['id']?>">
                                            <span class="ml-2"><?=$mp['nama_mapel']?></span>
                                        </label>
                                        </div>
                                    </div>
                                    <?php 
                                }
                            endforeach; ?>
                        </div>
                        <div class="row mx-0 px-3 py-0 text-center">
                            <span>Terapkan Setting Mata Pelajaran Untuk Kelas : </span><br/>
                            <span id="daftarpilih"></span>
                        </div>
                        <button type="submit" class="col btn btn-primary my-2" onclick="saveconf()"><i class="fas fa-save mr-2"></i>Terapkan</button>
                        <?php } ?>
                    </div>

                </div>

            </div>
            </form>
        </div>
    </div>
</main>
<?=$this->include('templates/footer')?>
<?=$this->endSection()?>


    