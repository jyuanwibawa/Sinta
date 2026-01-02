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

// $route['404_override'] = '';
// $route['translate_uri_dashes'] = FALSE;

