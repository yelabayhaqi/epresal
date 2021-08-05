<?php

function downloadFiles($file){
    header('Content-Description: File Transfer');
	header('Content-Type: application/force-download');
	header("Content-Disposition: attachment; filename=\"" . basename($file) . "\";");
	header('Content-Transfer-Encoding: binary');
	// header('Pragma: public');
    readfile("..\\backup_db\\" . basename($file));
	return redirect()->to('admin/pengaturan');
}

downloadFiles($namafile);
return redirect()->to('admin/pengaturan');