<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'LoginController::index');
$routes->post('/login', 'LoginController::login');
$routes->get('/setup', 'LoginController::setup');
$routes->post('/setup/setupadmin', 'LoginController::setupadmin');
$routes->get('/logout', 'LoginController::logout');
$routes->get('/user/profil', 'LoginController::profil');
$routes->post('/user/edit/save', 'LoginController::profilsave');

//routing admin
$routes->get('/admin', 'AdminController::menu');
$routes->get('/admin/shw/(:any)', 'AdminController::menu/$1');

//routing piket
$routes->get('/piket', 'PiketController::menu');
$routes->get('/piket/(:any)', 'PiketController::menu/$1');

//pesan
$routes->post('/admin/pesan/save', 'AdminController::pesansave');
$routes->post('/admin/pesan/edit/save', 'AdminController::editpesan');
$routes->post('/admin/pesan/drop', 'AdminController::droppesan');

//dataguru
$routes->get('/admin/dataguru', 'AdminController::guru');
$routes->post('/admin/dataguru/save', 'AdminController::gurusave');
$routes->post('/admin/dataguru/import', 'AdminController::guruimport');
$routes->post('/admin/dataguru/drop', 'AdminController::gurudrop');
$routes->post('/admin/dataguru/dropsingle', 'AdminController::gurudropsingle');
$routes->post('/admin/dataguru/reset', 'AdminController::gurureset');
$routes->post('/admin/dataguru/edit', 'AdminController::guruedit');
$routes->post('/admin/dataguru/editpiket', 'AdminController::piketedit');

//datasiswa
$routes->get('/admin/datasiswa', 'AdminController::siswa');
$routes->post('/admin/datasiswa/save', 'AdminController::siswasave');
$routes->post('/admin/datasiswa/import', 'AdminController::siswaimport');
$routes->post('/admin/datasiswa/drop', 'AdminController::siswadrop');
$routes->post('/admin/datasiswa/dropsingle', 'AdminController::siswadropsingle');
$routes->post('/admin/datasiswa/edit', 'AdminController::siswaedit');
//datamapel
$routes->get('/admin/datamapel', 'AdminController::mapel');
$routes->get('/admin/datamapel/editmapel', 'AdminController::editmapel');
$routes->post('/admin/datamapel/savemapel', 'AdminController::savemapel');
$routes->post('/admin/datamapel/dropall', 'AdminController::dropallmapel');
$routes->post('/admin/datamapel/editmapel/addkelas', 'AdminController::addkelas');
$routes->post('/admin/datamapel/editmapel/importkelas', 'AdminController::importkelas');
$routes->post('/admin/datamapel/editmapel/delkelas', 'AdminController::delkelas');
$routes->post('/admin/datamapel/editmapel/addmapel', 'AdminController::addmapel');
$routes->post('/admin/datamapel/editmapel/importmapel', 'AdminController::importmapel');
$routes->post('/admin/datamapel/editmapel/delmapel', 'AdminController::delmapel');

$routes->post('/admin/templates/listmapel', 'AdminController::listmapel');
$routes->post('/admin/templates/getmapel', 'AdminController::getmapel');
$routes->post('/admin/templates/mapeldelsingle', 'AdminController::delsinglemapel');
$routes->post('/admin/templates/mapeldelall', 'AdminController::delallmapel');
$routes->post('/admin/datamapel/import', 'AdminController::mapelimport');
$routes->post('/admin/datamapel/drop', 'AdminController::mapeldrop');

//tugas tambahan
$routes->get('/admin/tugas', 'AdminController::tugas');
$routes->post('/admin/tugas/savetugas', 'AdminController::savetugas');
$routes->post('/admin/tugas/drop', 'AdminController::droptugas');
$routes->post('/admin/tugas/importtugas', 'AdminController::importtugas');
$routes->post('/admin/tugas/edittugas', 'AdminController::edittugas');
$routes->get('/admin/tugas/deltugas/(:num)', 'AdminController::deltugas/$1');
$routes->get('/admin/wali', 'AdminController::wali');
$routes->post('/admin/wali/savewali', 'AdminController::savewali');
$routes->post('/admin/wali/drop', 'AdminController::dropwali');
$routes->post('/admin/wali/importwali', 'AdminController::importwali');

//arsip
$routes->get('/admin/arsip/presensi', 'AdminController::presensi');
$routes->get('/admin/arsip/jurnal/show/(:num)/(:num)/(:num)', 'AdminController::showjurnal/$1/$2/$3');
$routes->get('/admin/arsip/presensi/show/(:num)/(:num)/(:num)', 'AdminController::showpresensi/$1/$2/$3');
$routes->get('/admin/arsip/presensi/cetak/(:num)', 'AdminController::cetakpresensi/$1');
$routes->get('/admin/arsip/presensi/cr/(:any)/(:any)/(:any)/(:any)/(:any)', 'AdminController::cetakrange/$1/$2/$3/$4/$5');
$routes->post('/admin/templates/getmapelrange', 'AdminController::getmapelrange');
$routes->get('/admin/arsip/jurnal/cetak/(:num)/(:num)/(:num)', 'AdminController::cetakjurnal/$1/$2/$3');
$routes->get('/admin/arsip/jurnal', 'AdminController::jurnal');
$routes->get('/admin/arsip/jurnalkegiatan/show/(:num)/(:num)/(:num)', 'AdminController::showtugas/$1/$2/$3');
$routes->post('/admin/arsip/jurnalkegiatan/cetak', 'AdminController::cetaktugas');

//pengaturan
$routes->get('/admin/pengaturan', 'AdminController::pengaturan');
$routes->post('/admin/pengaturan/backupdb', 'AdminController::backupdb');
$routes->post('/admin/pengaturan/tabaru', 'AdminController::tabaru');

//keluhan
$routes->get('/admin/keluhan', 'AdminController::keluhan');
$routes->get('/admin/keluhan/(:any)', 'AdminController::keluhan/$1');

//routing guru
$routes->get('/guru', 'GuruController::menu');
$routes->get('/guru/aktivasi', 'GuruController::aktivasi');

//presensi
$routes->get('/guru/presensi', 'GuruController::gurupresensi');
$routes->get('/guru/presensi/show/(:any)/(:any)', 'GuruController::gurupresensi/$1/$2');
$routes->post('/guru/presensi/new', 'GuruController::newpresensi');
$routes->post('/guru/templates/getlist', 'GuruController::listmapel');
$routes->post('/guru/templates/getmapelrange', 'GuruController::getmapelrange');
$routes->post('/guru/presensi/save', 'GuruController::savepresensi');
$routes->get('/guru/presensi/edit/(:num)', 'GuruController::editpresensi/$1');
$routes->get('/guru/presensi/cetak/(:num)', 'GuruController::cetakpresensi/$1');
$routes->get('/guru/presensi/cr/(:any)/(:any)/(:any)/(:any)', 'GuruController::cetakrange/$1/$2/$3/$4');
$routes->post('/guru/templates/savesignature', 'GuruController::savesignature');
$routes->post('/guru/templates/editsignature', 'GuruController::editsignature');
$routes->post('/guru/aktivasi', 'GuruController::aktivasi');

//jurnal
$routes->get('/guru/jurnal', 'GuruController::gurujurnal');
$routes->post('/guru/jurnal/new', 'GuruController::newjurnal');
$routes->post('/guru/jurnal/edit', 'GuruController::editjurnal');
$routes->get('/guru/jurnal/show/(:any)/(:any)', 'GuruController::gurujurnal/$1/$2');
$routes->get('/guru/jurnal/cetak/(:any)/(:any)', 'GuruController::cetakjurnal/$1/$2');

//tugastambahan
$routes->get('/guru/tugastambahan', 'GuruController::tugastambahan');
$routes->post('/guru/tugas/save', 'GuruController::savetugas');
$routes->get('/guru/tugas/drop/(:num)', 'GuruController::droptugas/$1');
$routes->post('/guru/kegiatan/new', 'GuruController::savekegiatan');
$routes->post('/guru/kegiatan/edit', 'GuruController::editkegiatan');
$routes->get('/guru/tugas/show/(:num)/(:num)', 'GuruController::tugastambahan/$1/$2');
$routes->post('/guru/tugas/cetak', 'GuruController::cetaktugas');

//keluhan
$routes->get('/guru/pengaduan', 'GuruController::pengaduan');
$routes->post('/guru/pengaduan/buataduan', 'GuruController::aduanbaru');
$routes->post('/guru/pengaduan/saveaduan', 'GuruController::saveaduan');
$routes->post('/guru/pengaduan/editaduan', 'GuruController::editaduan');
$routes->get('/guru/pengaduan/setactive/(:num)', 'GuruController::setactive/$1');
$routes->get('/guru/pengaduan/setselesai/(:num)', 'GuruController::setselesai/$1');
$routes->get('/guru/keluhan', 'GuruController::keluhan');

//bk
$routes->get('/bk', 'BkController::menu');
$routes->get('/bk/presensi', 'BkController::bkpresensi');
$routes->get('/bk/presensi/show/(:any)/(:any)', 'BkController::bkpresensi/$1/$2');
$routes->get('/bk/jurnal', 'BkController::bkjurnal');
$routes->get('/bk/jurnal/show/(:any)/(:any)', 'BkController::bkjurnal/$1/$2');
$routes->get('/bk/jurnal/cetak/(:any)/(:any)', 'BkController::cetakjurnal/$1/$2');
$routes->get('/bk/presensi/cr/(:any)/(:any)/(:any)', 'BkController::cetakrange/$1/$2/$3');
$routes->get('/bk/tugastambahan', 'BkController::tugastambahan');
$routes->post('/bk/tugas/cetak', 'BkController::cetaktugas');
$routes->get('/bk/keluhan', 'BkController::keluhan');
$routes->get('/bk/keluhan/(:any)', 'BkController::keluhan/$1');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
