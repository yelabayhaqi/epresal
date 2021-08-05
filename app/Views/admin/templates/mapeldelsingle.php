<?php
$kelas = $_POST['kelas'];
$mapel = $_POST['mapel'];
$this->db = \Config\Database::connect();
$this->db->table('kelas_has_mapel')->where('kelas',$kelas)->where('mapel',$mapel)->delete();
$mapel = $this->db->table('kelas_has_mapel')->select()
->join('mapel','kelas_has_mapel.mapel = mapel.id', 'left')
->where('kelas_has_mapel.kelas', $kelas)->orderBy('kategori','asc')->orderBy('nama_mapel','asc')
->get()->getResultArray();
if($mapel != NULL){?>
<div class="mx-0">
<div class="list-group list-group-flush ml-2 pr-0">
        <?php 
        $kat = "-";          
        foreach ($mapel as $mp) :
        if($mp['kategori'] != $kat){?>
            <label class="fw-normal text-center py-0 my-0"><i><?=$mp['kategori']?></i></label>
        <?php $kat = $mp['kategori']; }?>
            <div class="list-group-item text-dark fs-6 fw-normal px-1 py-1 ml-3 me-5">
                <?=$mp['nama_mapel']?>
                <button type="button" class="btn btn-danger float-right px-2 py-0" onclick="delSingle(<?=$kelas?>,<?=$mp['id']?>)">
                    <i class="fas fa-trash text-white"></i>
                </button>
            </div>
        <?php endforeach;
    ?> 
    </div>
</div>
<div class="mx-0 text-center">
    <button type="button" class="btn btn-secondary mx-4 px-3 py-0" onclick="delAll(<?=$kelas?>)"><i class="fas fa-trash me-3"></i>Hapus Semua</button>
</div>
<?php } else{?>
    <script> 
        $('#chev<?=$kelas?>').hide(); 
    </script>
<?php } ?>


