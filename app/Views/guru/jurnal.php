<?php 
    echo $this->extend('templates/main');
    echo $this->section('page-content'); 
    include("templates/hariTanggalIndo.php");
?>
<main id="main-content"> 
<?=$this->include('guru/templates/modalEditJurnal')?>
    <div class="container-fluid mx-0 px-1 mt-4">
    <div class="row mx-0">
        <div class="col-auto back-hide"><a href="<?=base_url()?>/guru" type="button" class="btn btn-light px-3 mx-1 back-hide"><i class="fas fa-arrow-left mr-2 back-hide"></i>Kembali</a></div>
        <div class="col">
            <div class="row mx-0" style="border-bottom: 1px solid gray; min-width: 270px;">
                <a href="<?=base_url()?>/guru/presensi" id="presmenu" class="col text-center menu-link my-0 px-1 py-1"><span>Presensi Siswa</span></a>
                <a id="jrnlmenu" class="col text-center menu-link menu-link-activated my-0 px-1 py-1"><span>Jurnal Mengajar</span></a>
            </div>
        </div>
    </div>
        <?php if(session()->getFlashdata('pesan')) {?>
            <div class="alert alert-success my-2" role="alert">
                <?= session()->getFlashdata('pesan') ?>
            </div>
        <?php }?>
        <div class="row mx-0 my-3 py-0">
            <div class="col py-1 pb-3 mt-2 mx-2 mt-2" style="box-shadow: 1px 1px 8px 2px rgba(0,0,0,0.2) !important; min-width: 300px;
                    background: rgb(15,167,66);
                    background: linear-gradient(28deg, rgba(15,167,66,1) 0%, rgba(0,201,30,1) 53%, rgba(11,166,55,1) 100%);
                    ">
                <div class="row">
                    <div class="col fs-5 py-2 text-white fw-bold"><i class="fas fa-file-invoice text-white mr-2"></i>Data Jurnal Mengajar</div>
                </div>
                <div class="row mx-0">
                    <table class="col mx-0 text-white" style="line-height: 1.5;">
                        <tr class="my-2">
                            <td class="py-0" style="min-width: 140px;">
                                <span class="fw-bold">Data Hari Ini</span>
                            </td>
                            <td class="px-0 py-0">
                                <span class="ml-1 badge fs-5 mt-1 me-3 float-right" style="background-color: rgba(15,150,50,0.8); min-width: 50px;"><?=$jrnltoday?></span>
                            </td>
                        </tr>
                        <tr class="my-2">
                            <td class="py-0" style="width: 140px;">
                                <span class="fw-bold">Data Bulan Ini</span>
                            </td>
                            <td class="px-0 py-0">
                                <span class="ml-1 badge fs-5 mt-1 me-3 float-right" style="background-color: rgba(15,150,50,0.8); min-width: 50px;"><?=$jrnlmnth?></span>
                            </td>
                        </tr>
                        <tr class="my-2">
                            <td class="py-0" style="width: 140px;">
                                <span class="fw-bold">Total</span>
                            </td>
                            <td class="px-0 py-0">
                                <span class="ml-1 badge fs-5 mt-1 me-3 float-right" style="background-color: rgba(15,150,50,0.8); min-width: 50px;"><?=$jrnltotal?></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="col pb-3 mt-2 mx-2 mt-2" style="box-shadow: 1px 1px 8px 2px rgba(0,0,0,0.2) !important; min-width: 300px;">
                <div class="row">
                    <div class="col fs-5 py-2 bg-secondary text-light fw-bold"><i class="fas fa-print text-light mr-2"></i>Cetak Rekap Jurnal Mengajar</div>
                </div>
                    <div class="row my-1">
                        <div class="col">
                            Bulan :
                            <select class="col form-select py-1 fs-4" id="pilihBulanCetak" name="pilihBulanCetak" aria-label="Default select example">
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col">
                            Tahun :
                            <select class="col form-select py-1 fs-4" id="pilihTahunCetak" name="pilihTahunCetak" aria-label="Default select example">
                                <option value="<?= (date("Y", time()) - 1) ?>"><?= (date("Y", time()) - 1) ?></option>
                                <option value="<?= date("Y", time()) ?>"><?= date("Y", time()) ?></option>
                                <option value="<?= (date("Y", time()) + 1) ?>"><?= (date("Y", time()) + 1) ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3 mx-0">
                        <button id="cetakRange" class="btn btn-primary fw-bold col py-2" style="width: 100%;" title="Cetak Data" >Cetak Data <i class="ml-1 fas fa-file-pdf"></i></button>
                    <div>
                </div>
            </div>
        </div>
        </div>
        <div class="mx-2 my-2 px-0" style="box-shadow: 2px 1px 8px 1px rgba(0,0,0,0.2) !important;">
            <div class="text-light fw-bold py-2 bg-secondary">
                <i class="fas fa-list mr-3 ml-3"></i>Jurnal Mengajar
            </div>
            <div class="px-2 py-2">
                    <div class="row mx-2">
                        <select class="form-select form-select-sm col-auto pr-5 mr-2" id="pilihBulan" name="pilihBulan" aria-label="Default select example">
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        <select class="form-select form-select-sm col-auto pr-5" id="pilihTahun" name="pilihTahun" aria-label="Default select example">
                            <option value="<?= (date("Y", time()) - 1) ?>"><?= (date("Y", time()) - 1) ?></option>
                            <option value="<?= date("Y", time()) ?>"><?= date("Y", time()) ?></option>
                            <option value="<?= (date("Y", time()) + 1) ?>"><?= (date("Y", time()) + 1) ?></option>
                        </select>
                    </div>
                    <table id="datatablesSimple" class="mx-0">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle;" class="text-center">No</th>
                                <th style="min-width: 100px !important; vertical-align: middle;" >Tanggal</th>
                                <th style="min-width: 80px !important; vertical-align: middle;" class="text-center">Kelas</th>
                                <th style="vertical-align: middle; min-width: 150px;" class="text-center">Mapel</th>
                                <th style="vertical-align: middle; min-width: 250px;" class="text-center">Materi Ajar</th>
                                <th style="min-width: 55px !important; vertical-align: middle;" class="text-center">Jam</th>
                                <th style="max-width: 90px !important; vertical-align: middle;" class="text-center">Jumlah<br/>(menit)</th>
                                <th style="vertical-align: middle;"style="width: 90px !important; min-width: 90px !important;" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $n=0; foreach ($jurnal as $dat) : $n++;?>
                            <tr>
                                <td class="text-center"><?=$n?></td>
                                <td><?=format_hari_tanggal_jrnl($dat['tgl'])?></td>
                                <td><?=$dat['kelas']?></td>
                                <td><?=$dat['mapel']?></td>
                                <td id="kegiatan-<?=$dat['id']?>"><?=$dat['kegiatan']?></td>
                                <td class="text-center"><?=$dat['jam']?></td>
                                <td class="text-center"><?php 
                                $arpas = $dat['jam'];
                                $tanda = 0;
                                            for($i=0;$i<=strlen($arpas);$i++){
                                                if($arpas[$i]=="-") {
                                                break;
                                                }
                                                else $tanda++;
                                            };
                                            $angka1 = substr($arpas,0,$tanda-1);
                                            $angka2 = substr($arpas,$tanda+2,strlen($arpas));
                                            echo (($angka2-$angka1)+1)*45;?>
                                </td>
                                <td class="text-center">
                                    <?php 
                                    echo "
                                    <button class=\"btn btn-warning px-2 py-0 mx-1 mt-1\" title=\"Edit Data\" onclick=\"editfunc" . $dat['id'] . "()\"><i class=\"fas fa-edit py-0\" style=\"max-width:12px;\"></i></button>
                                    ";
                                    echo "
                            <script>
                                    var modalEdit = new bootstrap.Modal(document.getElementById('editJurnalModal'));
                                        function editfunc" . $dat['id'] . "(){
                                            $('#inputKelasEdit').val(\"" . $dat['kelas'] . "\");

                                            var pilihan = \"" . "kelas=" . $dat['kelas'] . "\";
                                            $.ajax({
                                            type: 'POST',
                                            url: \"/guru/templates/getlist\",
                                            data: pilihan,
                                            success: function(hasil) {
                                                $(\"#inputMapelEdit\").html(hasil);
                                                $(\"#inputMapelEdit\").val(\"" . $dat['mapel'] . "\");
                                            }
                                            });
                                            var arpas = \"" . $dat['jam'] . "\";
                                            var tanda=0;
                                            for(var i=0;i<=arpas.length;i++){
                                                if(arpas[i]==\"-\") {
                                                break;
                                                }
                                                else tanda++;
                                            };
                                            var angka1 = arpas.substr(0,tanda-1);
                                            var angka2 = arpas.substr(tanda+2,arpas.length);
                                            var pilihan = \"\";
                                            $(\"#inputJam1Edit\").val(angka1);
                                            for(swap = angka1;swap<=12;swap++){
                                                pilihan += \"<option value=\"+swap+\">\"+swap+\"</option>\";
                                            }
                                            $(\"#inputJam2Edit\").html(pilihan);
                                            $(\"#inputJam2Edit\").val(angka2);
                                            $(\"#idswapjurnal\").val(\"" . $dat['id'] . "\");
                                            $(\"#inputKegiatanEdit\").html($('#kegiatan-" . $dat['id'] . "').html());
                                            modalEdit.toggle();
                                        };
                            </script>
                            ";?>
                                </td>
                            </tr>
                            <?php 
                        endforeach; ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function() {
        document.getElementById("gu-presensi").className="nav-link nav-link-activated";
        document.getElementById("gu-presensi-icon").className="sb-nav-link-icon sb-nav-link-icon-activated";
        $("#pilihBulanCetak").val("<?= $bulan ?>");
        $("#pilihTahunCetak").val("<?= $tahun ?>");
        $("#pilihBulan").val("<?= $bulan ?>");
        $("#pilihTahun").val("<?= $tahun ?>");
        $('#pilihBulan').on('change', function() {
            var bulan = this.value;
            var tahun = $('select[name=pilihTahun]').val();
            window.location.href = "<?= base_url() ?>/guru/jurnal/show/" + bulan + "/" + tahun;
        });
        $('#pilihTahun').on('change', function() {
            var tahun = this.value;
            var bulan = $('select[name=pilihBulan]').val();
            window.location.href = "<?= base_url() ?>/guru/jurnal/show/" + bulan + "/" + tahun;
        });
        $('#cetakRange').on('click', function() {
            var blncr = $("#pilihBulanCetak").val();
            var thncr = $("#pilihTahunCetak").val();
            window.location.href = "<?= base_url() ?>/guru/jurnal/cetak/" + blncr + "/" + thncr;
        });
        $('#inputKelas').on('change', function() {
            var pilihan = "kelas="+this.value;
            $.ajax({
	        type: 'POST',
	        url: "/guru/templates/getlist",
	        data: pilihan,
	        success: function(hasil) {
	        	$("#inputMapel").html(hasil);
	        	console.log(hasil);
	        }
            });
        });
        $('#inputJam1Edit').on('change', function() {
            var pilihan = "";
            if(this.value == "") $("#inputJam2Edit").html("<option value=\"-\">-</option>");
            else {
                var jam1 = this.value;
                for(;jam1<=12;jam1++){
                    pilihan += "<option value=\""+jam1+"\">"+jam1+"</option>";
                }
			    $("#inputJam2Edit").html(pilihan);
            }
        });
    });
</script>
<?=$this->include('templates/footer')?>
<?=$this->endSection()?>


    