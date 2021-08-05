<?php 
$this->db = \Config\Database::connect();
$kelas =  $_POST['kelas'];
$guru =  $_POST['guru'];
$edit = $_POST['edit'];
if($edit == '0'){
    $cek = $this->db->table('tugas')->select()->where('nama_tugas',$kelas)->get()->getRowArray();
    if($cek == NULL) 
        $this->db->table('tugas')->insert([ 
            'nama_tugas' => $kelas, 
            'kategori' => "wali kelas"
        ]);
    $id_tugas = $this->db->table('tugas')->select('id')->where('nama_tugas',$kelas)->get()->getRowArray();
    $cek = $this->db->table('tugas_guru')->select()
    ->where('id_guru',$guru)
    ->where('id_tugas',$id_tugas)
    ->where('nama_tugas',"Wali Kelas".$kelas)
    ->get()->getRowArray();
    if($cek == NULL){
        $this->db->table('tugas_guru')->insert([
            'id_guru' => $guru,
            'id_tugas' => $id_tugas['id'],
            'nama_tugas' => "Wali Kelas ".$kelas
        ]);?>
        <div class="list-group-item text-dark fs-6 fw-normal px-1 py-1 ml-2 me-5">
            <?=$this->db->table('users')->select('nama')->where('id',$guru)->get()->getRowArray()['nama']?>
        </div>  
    <?php }
} else if($edit == '1'){
    $this->db->table('tugas_guru')->select('id')->where('nama_tugas',"Wali Kelas ".$kelas)->delete();
    $id_tugas = $this->db->table('tugas')->select('id')->where('nama_tugas',$kelas)->get()->getRowArray();
    $this->db->table('tugas_guru')->insert([
        'id_guru' => $guru,
        'id_tugas' => $id_tugas['id'],
        'nama_tugas' => "Wali Kelas ".$kelas
    ]);?>
    <div class="list-group-item text-dark fs-6 fw-normal px-1 py-1 ml-2 me-5">
        <?=$this->db->table('users')->select('nama')->where('id',$guru)->get()->getRowArray()['nama']?>
    </div>  
<?php } ?>

