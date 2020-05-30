<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



/**
 * Routes Buatan Sendiri
 */

$route['/'] = 'auth/login';

// Dashboard Petugas
$route['petugas/dashboard'] = 'petugas/dashboard_petugas';
$route['petugas/dashboard/pengumuman'] = 'petugas/dashboard_petugas/pengumuman';
$route['petugas/dashboard/pengumuman/submit'] = 'petugas/dashboard_petugas/postPengumuman';

// Daftar Permohonan Petugas
//pagenation permohonan baru
$route['petugas/monitoring/baru'] = 'petugas/list_permohonan/lihatList';
$route['petugas/monitoring/baru/:num'] = 'petugas/list_permohonan/lihatList';

//pagenation permohonan sedang di proses
$route['petugas/monitoring/sedangProses'] = 'petugas/list_permohonan/lihatList';
$route['petugas/monitoring/sedangProses/:num'] = 'petugas/list_permohonan/lihatList';

//pagenation permohonan selesai
$route['petugas/monitoring/selesai'] = 'petugas/list_permohonan/lihatList';
$route['petugas/monitoring/'] = 'petugas/list_permohonan/lihatList';

//Read Detail Permohonan
$route['petugas/monitoring/read/:num'] = 'petugas/monitoring_petugas/lihatStatus';
$route['petugas/download/surat/:num'] = 'petugas/monitoring_petugas/downloadSurat';
$route['petugas/monitoring/read/post'] = 'petugas/monitoring_petugas/post';

// $route['petugas/monitoring/surat'] = 'petugas/list_permohonan/downloadSurat';
$route['petugas/arsip'] = 'petugas/arsip_petugas/surat';
$route['petugas/arsip/cari'] = 'petugas/arsip_petugas/cariSurat';
$route['petugas/arsip/save/:num'] = 'petugas/arsip_petugas/download';













// Dashboard Pemohon
$route['pemohon/dashboard'] = 'pemohon/dashboard_pemohon';
$route['pemohon/monitoring'] = 'pemohon/dashboard_pemohon/monitoring';
$route['pemohon/legalisir'] = 'pemohon/dashboard_pemohon/legalisir';
$route['pemohon/pengambilan'] = 'pemohon/dashboard_pemohon/pengambilan';
$route['pemohon/lainnya'] = 'pemohon/dashboard_pemohon/lainnya';

//Download Dokumen Selesai
$route['pemohon/download/dokumen/:num'] = 'pemohon/dashboard_pemohon/downloadDokumen';

//konfirmasi Sampai
$route['pemohon/konfirmasi/sampai/:num'] = 'pemohon/dashboard_pemohon/konfirmasi';

//konfirmasi selesai
$route['pemohon/konfirmasi/selesai/:num'] = 'pemohon/dashboard_pemohon/konfirmasi';

// Legalisir Pemohon
$route['pemohon/legalisir/pengajuan'] = 'pemohon/legalisir_pemohon/showForm';
$route['pemohon/legalisir/submit'] = 'pemohon/legalisir_pemohon/postForm';

//Download Surat
$route['pemohon/legalisir/download/:any'] = 'pemohon/legalisir_pemohon/downloadSurat/';


// Pengambilan Pemohon
$route['pemohon/pengambilan/pengajuan'] = 'pemohon/pengambilan_pemohon/showForm';
$route['pemohon/pengambilan/submit'] = 'pemohon/pengambilan_pemohon/postForm';

// Lainnya Pemohon
$route['pemohon/lainnya/submit'] = 'pemohon/lainnya_pemohon/submit';
