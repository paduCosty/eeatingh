<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['user'] = 'user/';
$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'user/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
