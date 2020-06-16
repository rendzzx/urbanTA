<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$active_group = 'IFCA';
$active_record = TRUE;

// if (base_url() == 'http://192.168.1.147:2121/urbanTA/') {
if (base_url() == 'http://35.197.137.111:2121/urbanTA/') {
	$db['IFCA']['hostname'] = '35.198.219.220\SQL2016';
	$db['IFCA']['username'] = 'mgr';
	$db['IFCA']['password'] = 'mgr';
	$db['IFCA']['database'] = 'urbanTA'; 
	$db['IFCA']['dbdriver'] = 'sqlsrv';
	$db['IFCA']['dbprefix'] = '';
	$db['IFCA']['pconnect'] = FALSE;
	$db['IFCA']['db_debug'] = FALSE;
	$db['IFCA']['cache_on'] = FALSE;
	$db['IFCA']['cachedir'] = '';
	$db['IFCA']['char_set'] = 'utf8';
	$db['IFCA']['dbcollat'] = 'utf8_general_ci';
	$db['IFCA']['swap_pre'] = '';
	$db['IFCA']['autoinit'] = TRUE;
	$db['IFCA']['stricton'] = FALSE;
}
elseif (base_url() == 'http://localhost:2121/urbanTA/' || base_url() == 'http://192.168.1.147:2121/urbanTA/') {
	$db['IFCA']['hostname'] = 'RENDY-NB\SQL2016';
	$db['IFCA']['username'] = 'mgr';
	$db['IFCA']['password'] = 'mgr';
	$db['IFCA']['database'] = 'urbanTA'; 
	$db['IFCA']['dbdriver'] = 'sqlsrv';
	$db['IFCA']['dbprefix'] = '';
	$db['IFCA']['pconnect'] = FALSE;
	$db['IFCA']['db_debug'] = FALSE;
	$db['IFCA']['cache_on'] = FALSE;
	$db['IFCA']['cachedir'] = '';
	$db['IFCA']['char_set'] = 'utf8';
	$db['IFCA']['dbcollat'] = 'utf8_general_ci';
	$db['IFCA']['swap_pre'] = '';
	$db['IFCA']['autoinit'] = TRUE;
	$db['IFCA']['stricton'] = FALSE;
}