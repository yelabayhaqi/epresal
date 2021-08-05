1. pastikan home directory adalah epresal/public
2. pastikan php menggunakan versi >= 7.0 dan ekstensi intl sudah diaktifkan
3. buat database baru dan import database db_epresal.sql yang ada pada epresal/backup_db
4. konfigurasi file epresal/.env (cari bagian setting seperti dibawah ini)

########################## SETTING DATABASE #########################

database.default.hostname = localhost
database.default.database = db_epresal
database.default.username = root
database.default.password = root
database.default.DBDriver = MySQLi
# database.default.DBPrefix =

database.tests.hostname = localhost
database.tests.database = db_epresal
database.tests.username = root
database.tests.password = root
database.tests.DBDriver = MySQLi
# database.tests.DBPrefix =

########################## SETTING DATABASE #########################

5. setting database pada /epresal/app/Controllers/AdminController.php
edit pada bagian ini : 

//////////// Edit value variabel dibawah ini //////////////
private $username_database = "root";
private $password_database = "root";
private $nama_database = "db_epresal";
///////////////////////////////////////////////////////////

6. ujicoba akses aplikasi, jika berhasil akan mengarah ke halaman setup
