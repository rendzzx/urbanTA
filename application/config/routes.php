<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Dash';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['login'] = 'Auth';
$route['logout'] = 'Auth/logout';
