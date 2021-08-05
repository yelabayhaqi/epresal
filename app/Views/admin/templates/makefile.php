<?php 
$fname = "backup_" . date("d-m-Y_H-i-s");
exec("mysqldump -u root --password=\"root\" db_epresal > " . $fname);
// header("Content-Disposition: attachment; filename=" . $fname);
// readfile($fname);
echo $fname;
?>