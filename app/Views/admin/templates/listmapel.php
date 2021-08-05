<?php 
$show =  $_POST['kelas'];
$this->db = \Config\Database::connect();
if ($show == "semua"){
    if($kelas == NULL){?>
    <tr>
        <td colspan="2" class="table-light text-center" >Data Kosong</td>
    </tr>
    <?php
    } else {
    foreach ($kelas as $jadwal) : 
        $mapel = $this->db->table('kelas_has_mapel')->select('nama_mapel')
        ->join('mapel','kelas_has_mapel.mapel = mapel.id', 'left')
        ->where('kelas_has_mapel.kelas',$jadwal['id'])
        ->get()->getResultArray();
        if($mapel != NULL){
            $i = 0; foreach ($mapel as $dat) : $i++; endforeach; 
            ?>
            <tr>
                <td colspan="2" class="table-light" ></td>
            </tr>
            <tr>
                <td rowspan="<?=$i?>" class="text-center table-primary align-middle"><?=$jadwal['nama_kelas']?></td>
            <?php $i=0;
            foreach ($mapel as $dat) :
                if($i == 0){ ?>
                    <td class="text-center"><?=$dat['nama_mapel']?></td>
                </tr>
            <?php
                } else {?>
                <tr>
                    <td class="text-center"><?=$dat['nama_mapel']?></td>
                </tr>
            <?php
            }
            $i++; endforeach;
        } else {?>
            <tr>
                <td colspan="2" class="table-light" ></td>
            </tr>
            <tr>
                <td class="text-center table-primary align-middle"><?=$jadwal['nama_kelas']?></td>
                <td></td>
            </tr>
        <?php }
    endforeach;}
} else {
    $mapel = $this->db->table('kelas_has_mapel')->select('nama_mapel')
    ->join('mapel','kelas_has_mapel.mapel = mapel.id', 'left')
    ->join('kelas','kelas_has_mapel.kelas = kelas.id', 'left')
    ->where('kelas.nama_kelas', $show)
    ->get()->getResultArray();
    $i = 0; foreach ($mapel as $dat) : $i++; endforeach; 
    ?>
    <tr>
        <td colspan="2" class="table-light" ></td>
    </tr>
    <tr>
        <td rowspan="<?=$i?>" class="text-center table-primary align-middle"><?=$show?></td>
    <?php $i=0;
    foreach ($mapel as $dat) :
        if($i == 0){ ?>
            <td class="text-center"><?=$dat['nama_mapel']?></td>
        </tr>
    <?php
        } else {?>
        <tr>
            <td class="text-center"><?=$dat['nama_mapel']?></td>
        </tr>
    <?php
        }
        $i++; endforeach;
}
