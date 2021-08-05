<?php 
$kelas =  $_POST['kelas'];
$this->db = \Config\Database::connect();
if (($kelas != "")||(!isset($kelas))||($kelas != NULL)){
    $mapel = $this->db->table('kelas_has_mapel')->select('nama_mapel')
    ->join('mapel','mapel.id = kelas_has_mapel.mapel')
    ->join('kelas','kelas.id = kelas_has_mapel.kelas')
    ->where("kelas.nama_kelas", $kelas)->get()->getResultArray();
    ?><option value="">-</option><?php
    foreach ($mapel as $dat) :?>
        <option value="<?=$dat['nama_mapel']?>"><?=$dat['nama_mapel']?></option>
    <?php endforeach;
} else {
    ?>
    <option value="">-</option>
    <?php
}
