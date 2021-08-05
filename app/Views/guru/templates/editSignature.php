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
session()->set('ttd',$filename)
?>
<label class="mx-0 my-1 px-0 pt-3 text-light" style="font-size: 10pt; font-weight: bolder;">TANDA TANGAN</label><br/>
<img style="border: 1px solid black;" src="<?=base_url()?>/assets/img/signature/<?=session()->get('ttd')?>" width="200px"></img>
<button class="btn btn-primary mx-2" onclick="edit()"><i class="fas fa-edit"></i> edit</button>









