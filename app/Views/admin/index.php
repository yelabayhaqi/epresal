<?php 
    echo $this->extend('templates/main');
    echo $this->section('page-content'); 
    include("templates/hariTanggalIndo.php");
?>
    <?=$this->include('admin/templates/modalTambahPesan')?>
    <?=$this->include('admin/templates/modalDelPesan')?>
    <?=$this->include('admin/templates/modalEditPesan')?>
    <main id="main-content">
        <div class="container-fluid mx-0 px-1">
            <div class="row mx-0 my-4 mt-4">
                <div class="col py-2 mt-2 mx-2" style="box-shadow: 1px 1px 8px 2px rgba(0,0,0,0.2) !important; min-width: 360px;
                    background: rgb(12,193,241);
                    background: linear-gradient(28deg, rgba(12,193,241,1) 0%, rgba(4,209,222,1) 53%, rgba(0,194,233,1) 100%);
                    ">
                        <div class="fs-4 text-white fw-bold">Data Report</div>
                        <div class="row mx-0">
                            <table class="col mx-0 text-white">
                                <tr class="px-0 py-0" style="vertical-align: text-bottom;">
                                    <td class="pl-2 py-0" style="min-width: 200px;">
                                        <span class="fw-bold">Jumlah Guru Mapel</span>
                                    </td>
                                    <td class="px-0 py-0">
                                        <span class="fs-3 fw-bolder"><?=$guru?></span>
                                    </td>
                                    <td rowspan="3" style="font-size: 60pt; vertical-align: middle; width: 100%; text-align: right;">
                                        <i class="fas fa-database text-white pr-3 mr-2"></i>
                                    </td>
                                </tr>
                                <tr style="vertical-align: text-bottom;">
                                    <td class="pl-2 py-0" style="width: 200px;">
                                        <span class="fw-bold">Jumlah Guru BK</span>
                                    </td>
                                    <td class="px-0 py-0">
                                        <span class="fs-3 fw-bolder"><?=$bk?></span>
                                    </td>
                                </tr>
                                <tr style="vertical-align: text-bottom;">
                                    <td class="pl-2 py-0" style="width: 200px;">
                                        <span class="fw-bold">Jumlah Siswa</span>
                                    </td>
                                    <td class="px-0 py-0">
                                        <span class="fs-3 fw-bolder"><?=$siswa?></span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="row mx-0 mt-2 mb-1 text-center">
                            <div class="col fw-bold text-light pl-0">Kelas 10 <span class="fw-bolder ml-1 badge fs-4" style="background-color: rgba(12,180,220,1); min-width: 50px;"><?=$siswa10?></span></div>
                            <div class="col fw-bold text-light">Kelas 11 <span class="fw-bolder ml-1 badge fs-4" style="background-color: rgba(12,180,220,1); min-width: 50px;"><?=$siswa11?></span></div>
                            <div class="col fw-bold text-light pr-0">Kelas 12 <span class="fw-bolder ml-1 badge fs-4" style="background-color: rgba(12,180,220,1); min-width: 50px;"><?=$siswa12?></span></div>
                        </div>
                </div>
                <div class="col py-2 mt-2 mx-2" style="box-shadow: 1px 1px 8px 2px rgba(0,0,0,0.2) !important; min-width: 360px;
                    background: rgb(15,167,66);
                    background: linear-gradient(28deg, rgba(15,167,66,1) 0%, rgba(0,201,30,1) 53%, rgba(11,166,55,1) 100%);
                    ">
                    <div class="fs-4 text-white fw-bold">Data Entri</div>
                        <div class="row mx-0">


                            <table class="col mx-0 text-white" style="line-height: 1.2;">
                                <tr class="py-0 my-0">
                                    <td><i>Hari ini</i></td>
                                    <td></td>
                                    <td rowspan="3" style="font-size: 60pt; vertical-align: middle; width: 100%; text-align: right;">
                                        <i class="fas fa-download text-white pr-3 mr-2"></i>
                                    </td>
                                </tr>
                                <tr class="px-0 py-0" style="vertical-align: text-bottom;">
                                    <td class="pl-4 py-0" style="min-width: 200px;">
                                        <span class="fw-bold">Presensi</span>
                                    </td>
                                    <td class="px-0 py-0">
                                        <span class="fs-3 fw-bolder"><?=$prestoday?></span>
                                    </td>
                                </tr>
                                <tr style="vertical-align: text-bottom;">
                                    <td class="pl-4 py-0" style="width: 200px;">
                                        <span class="fw-bold">Jurnal</span>
                                    </td>
                                    <td class="px-0 py-0">
                                        <span class="fs-3 fw-bolder"><?=$jrnltoday?></span>
                                    </td>
                                </tr>
                            </table>

                            <table class="mx-0 text-white mt-2 mb-0">
                                <tr class="py-0 my-0">
                                    <td><i>Total</i></td>
                                </tr>
                            </table>  
                            <div class="row mx-0 mb-1 text-center">
                                <div class="col fw-bold text-light pl-0">Presensi <span class="fw-bolder ml-1 badge fs-4" style="background-color: rgba(15,150,50,0.8); min-width: 50px;"><?=$prestotal?></span></div>
                                <div class="col fw-bold text-light pr-0">Jurnal <span class="fw-bolder ml-1 badge fs-4" style="background-color: rgba(15,150,50,0.8); min-width: 50px;"><?=$jrnltotal?></span></div>
                            </div>
                        </div>
                </div>
            </div>

            <div class="mx-2 my-4" style="box-shadow: 2px 1px 8px 1px rgba(0,0,0,0.2) !important;">
                <div class="text-light fw-bold py-2 bg-secondary">
                    <i class="fas fa-bullhorn mr-3 ml-3"></i>Pesan Siaran
                    <div class="float-right">
                        <button class="btn btn-light mx-3 py-0 my-0 fw-bold" data-bs-toggle="modal" data-bs-target="#addPesanModal"><i class="fas fa-plus mr-3"></i>Tambah</button>
                    </div>
                </div>
                <div class="mx-3 px-2 py-2">
                    <div class="row">
                                <?php 
                                if($pesan){
                                    foreach ($pesan as $p) :
                                        if($p['kind'] == 1){?>
                                        <div class="alert alert-warning px-2 py-2 my-1">
                                        <?php } 
                                        else if($p['kind'] == 2){ ?>
                                        <div class="alert alert-danger px-2 py-2 my-1">
                                        <?php } ?>
                                            <div class="row">
                                                <div class="col">
                                                    <span style="font-size: 8pt;"><?=format_hari_tanggal_lengkap($p['waktu'])?></span><br/>
                                                    <span><b><?=$p['judul']?></b></span><br/>
                                                </div>
                                                <div class="col-auto float-right">

                                                    <?php 
                                                    echo "
                                                    <button style=\"font-size: 10pt;\" class=\"btn btn-warning mr-1 px-2 py-1\" onclick=\"editfunc" . $p['id'] . "()\"><i class=\"fas fa-edit\"></i></button>
                                                    <button style=\"font-size: 10pt;\" class=\"btn btn-danger px-2 py-1\" onclick=\"delfunc" . $p['id'] . "()\"><i class=\"fas fa-trash\"></i></button>
                                                    
                                                    <script>
                                                    var modalDelete = new bootstrap.Modal(document.getElementById('delPesanModal'));
                                                    var modalEdit = new bootstrap.Modal(document.getElementById('editPesanModal'));
                                                        function delfunc" . $p['id'] . "(){
                                                            $('#cnfIdDel').val('" . $p['id'] . "'); 
                                                            modalDelete.toggle();
                                                        };
                                                        function editfunc" . $p['id'] . "(){
                                                            $('#editId').val('" . $p['id'] . "'); 
                                                            $('#editInputWaktu').val('" . format_hari_tanggal_lengkap($p['waktu']) . "'); 
                                                            $('#editJudul').val('" . $p['judul'] . "'); 
                                                            $('#editIsi').val('" . $p['pesan'] . "'); 
                                                            if('" . $p['kind'] . "' == '1'){
                                                                $('#editTypeWarning').prop('checked', true);
                                                                $('#editTypeDanger').prop('checked', false);
                                                                document.getElementById(\"edit-box-pesan\").className = \"alert alert-warning\";
                                                                document.getElementById(\"editInputWaktu\").className = \"alert-warning\";
                                                            } else if('" . $p['kind'] . "' == '2') {
                                                                $('#editTypeWarning').prop('checked', false);
                                                                $('#editTypeDanger').prop('checked', true);
                                                                document.getElementById(\"edit-box-pesan\").className = \"alert alert-danger\";
                                                                document.getElementById(\"editInputWaktu\").className = \"alert-danger\";
                                                            }
                                                            if('" . $p['shw'] . "' == '0'){
                                                                $('#editTampilGuru').prop('checked', false);
                                                                $('#editTampilBK').prop('checked', false);
                                                            } else if('" . $p['shw'] . "' == '1') {
                                                                $('#editTampilGuru').prop('checked', true);
                                                                $('#editTampilBK').prop('checked', false);
                                                            } else if('" . $p['shw'] . "' == '2') {
                                                                $('#editTampilGuru').prop('checked', false);
                                                                $('#editTampilBK').prop('checked', true);
                                                            } else if('" . $p['shw'] . "' == '3') {
                                                                $('#editTampilGuru').prop('checked', true);
                                                                $('#editTampilBK').prop('checked', true);
                                                            }
                                                            modalEdit.toggle();
                                                        };
                                                    </script>
                                                    ";
                                                    ?>

                                                </div>
                                            </div>
                                            <span><?=$p['pesan']?></span><br/>
                                            <div class="mt-2">
                                                <?php
                                                if($p['shw'] == 0){?>
                                                    <span style="font-size: 10pt;" class="bg-danger text-white px-2 py-1 rounded-3 mr-1">Guru Mapel <i class="fas fa-eye-slash"></i></span><span style="font-size: 10pt;" class="bg-danger text-white px-3 py-1 rounded-3 ml-1">Guru BK <i class="fas fa-eye-slash"></i></span>
                                                <?php } 
                                                else if($p['shw'] == 1){ ?>
                                                    <span style="font-size: 10pt;" class="bg-primary text-white px-2 py-1 rounded-3 mr-1">Guru Mapel <i class="fas fa-eye"></i></span><span style="font-size: 10pt;" class="bg-danger text-white px-3 py-1 rounded-3 ml-1">Guru BK <i class="fas fa-eye-slash"></i></span>
                                                <?php }
                                                else if($p['shw'] == 2){ ?>
                                                    <span style="font-size: 10pt;" class="bg-danger text-white px-2 py-1 rounded-3 mr-1">Guru Mapel <i class="fas fa-eye-slash"></i></span><span style="font-size: 10pt;" class="bg-primary text-white px-3 py-1 rounded-3 ml-1">Guru BK <i class="fas fa-eye"></i></span>
                                                <?php }
                                                else if($p['shw'] == 3){ ?>
                                                    <span style="font-size: 10pt;" class="bg-primary text-white px-2 py-1 rounded-3 mr-1">Guru Mapel <i class="fas fa-eye"></i></span><span style="font-size: 10pt;" class="bg-primary text-white px-3 py-1 rounded-3 ml-1">Guru BK <i class="fas fa-eye"></i></span>
                                                <?php } ?>
                                            </div>

                                        </div>
                                    <?php
                                    endforeach;
                                } else {
                                    echo "<p class=\"text-center\">Pesan Kosong</p>";
                                }
                                ?>
                    </div>
                </div>
            </div>

            <div class="mx-2 my-4" style="box-shadow: 2px 1px 8px 1px rgba(0,0,0,0.2) !important;">
                <div class="text-light fw-bold py-2 bg-secondary">
                    <i class="fas fa-chalkboard-teacher mr-3 ml-3"></i>Aktivitas User
                </div>
                <div class="px-2 py-2">
                    <div class="row mx-0 mb-2">
                            Kelas :
                            <select id="pilihKelas" name="pilihKelas" class="form-select form-select-sm" aria-label="select kelas">
                                <option value="semua" selected>Semua</option>
                                <?php $i = 0; foreach ($kelas as $dat) :?>
                                    <option value="<?=$dat['kelas']?>"><?=$dat['kelas']?></option>
                                <?php $i++; endforeach;?>
                            </select>
                    </div>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th style="min-width: 160px !important; text-align: center;">Waktu</th>
                                <th style="min-width: 180px !important; text-align: center;">Nama</th>
                                <th style="min-width: 80px !important; text-align: center;">Kelas</th>
                                <th style="min-width: 150px !important; text-align: center;">Mapel</th>
                                <th style="min-width: 250px !important; text-align: center;">Materi Ajar</th>
                                <th style="text-align: center;">Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($aktivitas as $act) :?>
                            <tr>
                                <td><?=format_hari_tanggal_piket($act['time'])?></td>
                                <td><?=$act['nama']?></td>
                                <td style="text-align: center;"><?=$act['kelas']?></td>
                                <td><?=$act['mapel']?></td>
                                <td><?=$act['kegiatan']?></td>
                                <td style="text-align: center;"><?=$act['jam']?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>    
    </main>
    <!-- this is footer -->
    <?=$this->include('templates/footer')?>
<?=$this->endSection()?>
<?=$this->section('script')?>
<script>
    $(document).ready(function() {
        document.getElementById("menutama").className = "nav-link nav-link-activated";
        document.getElementById("menutama-icon").className = "sb-nav-link-icon sb-nav-link-icon-activated";
    });
    $('input[name="inputType"]').on('change', function() {
        var tipe = this.value;
        if(tipe == 1){
            document.getElementById("box-pesan").className = "alert alert-warning";
        } else if(tipe == 2){
            document.getElementById("box-pesan").className = "alert alert-danger";
        }
    });
    $('input[name="editInputType"]').on('change', function() {
        var tipe = this.value;
        if(tipe == 1){
            document.getElementById("edit-box-pesan").className = "alert alert-warning";
            document.getElementById("editInputWaktu").className = "alert-warning";
        } else if(tipe == 2){
            document.getElementById("edit-box-pesan").className = "alert alert-danger";
            document.getElementById("editInputWaktu").className = "alert-danger";
        }
    });
    $("#pilihKelas").val("<?=$selectedKelas?>");
        $('#pilihKelas').on('change', function() {
            var kelas = this.value;
            window.location.href = "<?= base_url() ?>/admin/shw/" + kelas;
        });
</script>
<?=$this->endSection()?>
    