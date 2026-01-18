<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// defined('BASEPATH') or exit('No direct script access allowed');
$route['masuk'] = "Login/proses";
$route['default_controller'] = 'Login';
$route['logout'] = 'Login/logout';
$route['simetri'] = 'Simetri';
$route['loginuser'] = 'LoginUser';
$route['loginuser/proses'] = 'LoginUser/proses';
$route['loginuser/logout'] = 'LoginUser/logout';
$route['dashboard_user'] = 'DashboardUser';
$route['dashboard_user/index'] = 'DashboardUser/index';
$route['notifikasiuser'] = 'NotifikasiUser';
$route['notifikasiuser/index'] = 'NotifikasiUser/index';

//administrator
$route['administrator'] = 'administrator/log_aktivitas/index';
$route['administrator/log_aktivitas'] = 'administrator/log_aktivitas/index';
$route['administrator/log-aktivitas'] = 'administrator/log_aktivitas/index';
$route['translate_uri_dashes'] = FALSE;

// Ruangan routes
$route['ruangan'] = 'Ruangan';
$route['ruangan/index'] = 'Ruangan/index';
$route['ruangan/add'] = 'Ruangan/add';
$route['ruangan/edit/(:num)'] = 'Ruangan/edit/$1';
$route['ruangan/delete/(:num)'] = 'Ruangan/delete/$1';
$route['ruangan/get_ruangan/(:num)'] = 'Ruangan/get_ruangan/$1';
$route['ruangan/get_statistics'] = 'Ruangan/get_statistics';

// Pengerjaan routes
$route['pengerjaan'] = 'Pengerjaan';
$route['pengerjaan/index'] = 'Pengerjaan/index';

// Detail Tugas routes
$route['detailtugas'] = 'DetailTugas';
$route['detailtugas/detail'] = 'DetailTugas/index';
$route['detailtugas/update_status'] = 'DetailTugas/update_status';

// Submit Tugas routes
$route['submittugas'] = 'SubmitTugas';
$route['submittugas/index'] = 'SubmitTugas/index';
$route['submittugas/complete'] = 'SubmitTugas/complete';
$route['submittugas/(:any)'] = 'SubmitTugas/index/$1';

// Tugas dan Standar routes
$route['tugas_standar'] = 'Tugasandstandar';
$route['tugas_standar/index'] = 'Tugasandstandar/index';

// Cetak Laporan Rekap
$route['cetak-rekap'] = 'CetakLaporanRekap/index';
$route['cetak-rekap/preview'] = 'CetakLaporanRekap/preview';
$route['cetak-rekap/pdf'] = 'CetakLaporanRekap/pdf';
$route['cetak-rekap/print'] = 'CetakLaporanRekap/print';

// Statistik Kinerja TU
$route['statistik-kinerja'] = 'StatistikKinerjaTu/index';

// $route['404_override'] = '';
// $route['translate_uri_dashes'] = FALSE;

