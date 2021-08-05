<?php
helper('filesystem');
$signature = $_POST['image'];
$filename = uniqid().'-'.session()->get('id').'.jpg';
$signature = str_replace('data:image/jpeg;base64,','',$signature);
$signature = str_replace(' ','+',$signature);
$data = base64_decode($signature);
$destination = 'assets/img/signature/'.$filename;
file_put_contents($destination,$data);

$rep = "";
$db = \Config\Database::connect();
$current = $db->table('users')->select('ttd')->where('id',session()->get('id'))->get()->getRowArray();
if($current['ttd'] != "empty"){
    $rep = $current['ttd'];
    unlink('assets/img/signature/' . $rep);
}
$dataInsert = [
    'ttd' => $filename
];
$iduser = session()->get('id');
$db->table('users')->where('id',$iduser)->update($dataInsert);
?>

<label class="mx-0 my-1 px-0 py-0" style="font-size: 10pt; font-weight: bolder; color: #4197d1;">TANDA TANGAN</label><br/>
<img style="border: 1px solid black;" src="<?=base_url()?>/<?=$destination?>" width="200px"></img>
<button class="btn btn-danger mx-2" onclick="hapus()"><i class="fas fa-trash mx-2 my-2 "></i></button>









