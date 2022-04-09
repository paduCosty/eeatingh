<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['products'] = 'products/';
$route['users'] = 'users/';
$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'products/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
