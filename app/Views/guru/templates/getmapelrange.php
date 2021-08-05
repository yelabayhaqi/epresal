<?php 
$kelas =  $_POST['kelas'];
$this->db = \Config\Database::connect();
if (($kelas != "")||(!isset($kelas))||($kelas != NULL)){
    $mapel = $this->db->table('presensi')->select('mapel')
    ->where('id_guru',session()->get('id'))
    ->where("kelas", $kelas)
    ->distinct()->get()->getResultArray();
    foreach ($mapel as $dat) :?>
        <option value="<?=$dat['mapel']?>"><?=$dat['mapel']?></option>
    <?php endforeach;
} else {
    ?>
    <option value="">-</option>
    <?php
}
