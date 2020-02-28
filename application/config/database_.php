<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'ifca3';
$active_record = TRUE;

// $active_group = 'ifca';
// $active_record = TRUE;

// $pt = "application/config/cf.txt";
//         $data = file_get_contents($pt);
//             // $data = file_get_contents(base_url('/pdf/soa/'.$filename));
//             // $data =base_url();
//         echo $data;

// $db['ifca']['hostname'] = 'IFCASERVER\\SQL2014';
// $db['ifca']['hostname'] = 'IFCASERVER\\SQL2008R2';
// $db['ifca']['hostname'] = 'YANTO\\SQL2014';
// $db['ifca']['hostname'] = 'FAUZI-NB\\SQL2014';
$db['ifca']['hostname'] = '192.168.0.20\\SQL2014';
// $db['ifca']['hostname'] = '35.197.137.111\SQL2014';
// $db['ifca']['hostname'] = 'ANDI-PC\\SQL2014';
// $db['ifca']['username'] = 'ifcacon';
// $db['ifca']['password'] = 'P@ssw0rd';
$db['ifca']['username'] = 'mgr';
$db['ifca']['password'] = 'mgr';
// $db['ifca']['username'] = ''; //utk WA
// $db['ifca']['password'] = '';
$db['ifca']['database'] = 'waskita_pb'; //'energy_mhb';
// $db['ifca']['database'] = 'IFCAWEB';
$db['ifca']['dbdriver'] = 'sqlsrv';
$db['ifca']['dbprefix'] = '';
$db['ifca']['pconnect'] = FALSE;
$db['ifca']['db_debug'] = FALSE;
$db['ifca']['cache_on'] = FALSE;
$db['ifca']['cachedir'] = '';
$db['ifca']['char_set'] = 'utf8';
$db['ifca']['dbcollat'] = 'utf8_general_ci';
$db['ifca']['swap_pre'] = '';
$db['ifca']['autoinit'] = TRUE;
$db['ifca']['stricton'] = FALSE;

// $db['ifca2']['hostname'] = 'IFCASERVER\\SQL2014';
// $db['ifca2']['hostname'] = '35.197.137.111\SQL2014';
$db['ifca2']['hostname'] = '192.168.0.20\\SQL2014';
// $db['ifca2']['hostname'] = '10.201.59.71\\SQL2014';
// $db['ifca2']['hostname'] = 'ANDI-PC\\SQL2014';
// $db['ifca2']['username'] = 'ifcacon';
// $db['ifca2']['password'] = 'P@ssw0rd';
$db['ifca2']['username'] = 'mgr';
$db['ifca2']['password'] = 'mgr';
$db['ifca2']['database'] = 'waskita_pb_file'; //'energy_mhb';
// $db['ifca2']['database'] = 'Property_file_train'; //'energy_mhb';
$db['ifca2']['dbdriver'] = 'sqlsrv';
$db['ifca2']['dbprefix'] = '';
$db['ifca2']['pconnect'] = FALSE;
$db['ifca2']['db_debug'] = FALSE;
$db['ifca2']['cache_on'] = FALSE;
$db['ifca2']['cachedir'] = '';
$db['ifca2']['char_set'] = 'utf8';
$db['ifca2']['dbcollat'] = 'utf8_general_ci';
$db['ifca2']['swap_pre'] = '';
$db['ifca2']['autoinit'] = TRUE;
$db['ifca2']['stricton'] = FALSE;

// $db['ifca3']['hostname'] = 'IFCASERVER\\SQL2014';
// $db['ifca3']['hostname'] = 'IFCASERVER\\SQL2008R2';
// $db['ifca']['hostname'] = 'YANTO\\SQL2014';
// $db['ifca']['hostname'] = 'FAUZI-NB\\SQL2014';
// $db['ifca']['hostname'] = '192.168.0.20\SQL2014';
// $db['ifca3']['hostname'] = '35.197.137.111\SQL2014';
$db['ifca3']['hostname'] = '192.168.0.20\\SQL2014';
// $db['ifca']['hostname'] = '10.201.59.71\\SQL2014';
// $db['ifca']['hostname'] = 'ANDI-PC\\SQL2014';
// $db['ifca']['username'] = 'ifcacon';
// $db['ifca']['password'] = 'P@ssw0rd';
$db['ifca3']['username'] = 'mgr';
$db['ifca3']['password'] = 'mgr';
$db['ifca3']['database'] = 'waskita_ADM'; //'energy_mhb';
// $db['ifca3']['database'] = 'MidWeb'; //'energy_mhb';
// $db['ifca']['database'] = 'IFCAWEB';
$db['ifca3']['dbdriver'] = 'sqlsrv';
$db['ifca3']['dbprefix'] = '';
$db['ifca3']['pconnect'] = FALSE;
$db['ifca3']['db_debug'] = FALSE;
$db['ifca3']['cache_on'] = FALSE;
$db['ifca3']['cachedir'] = '';
$db['ifca3']['char_set'] = 'utf8';
$db['ifca3']['dbcollat'] = 'utf8_general_ci';
$db['ifca3']['swap_pre'] = '';
$db['ifca3']['autoinit'] = TRUE;
$db['ifca3']['stricton'] = FALSE;

// $db['IFCAPB']['hostname'] = '35.197.137.111\SQL2014';
$db['IFCAPB']['hostname'] = '192.168.0.20\\SQL2014';
$db['IFCAPB']['username'] = 'mgr';
$db['IFCAPB']['password'] = 'mgr';
$db['IFCAPB']['database'] = 'Ekatama'; 
$db['IFCAPB']['dbdriver'] = 'sqlsrv';
$db['IFCAPB']['dbprefix'] = '';
$db['IFCAPB']['pconnect'] = FALSE;
$db['IFCAPB']['db_debug'] = FALSE;
$db['IFCAPB']['cache_on'] = FALSE;
$db['IFCAPB']['cachedir'] = '';
$db['IFCAPB']['char_set'] = 'utf8';
$db['IFCAPB']['dbcollat'] = 'utf8_general_ci';
$db['IFCAPB']['swap_pre'] = '';
$db['IFCAPB']['autoinit'] = TRUE;
$db['IFCAPB']['stricton'] = FALSE;

$db['IFCAPB2']['hostname'] = '192.168.0.20\\SQL2014';
// $db['IFCAPB2']['hostname'] = '35.197.137.111\SQL2014';
$db['IFCAPB2']['username'] = 'mgr';
$db['IFCAPB2']['password'] = 'mgr';
$db['IFCAPB2']['database'] = 'Nines'; 
$db['IFCAPB2']['dbdriver'] = 'sqlsrv';
$db['IFCAPB2']['dbprefix'] = '';
$db['IFCAPB2']['pconnect'] = FALSE;
$db['IFCAPB2']['db_debug'] = FALSE;
$db['IFCAPB2']['cache_on'] = FALSE;
$db['IFCAPB2']['cachedir'] = '';
$db['IFCAPB2']['char_set'] = 'utf8';
$db['IFCAPB2']['dbcollat'] = 'utf8_general_ci';
$db['IFCAPB2']['swap_pre'] = '';
$db['IFCAPB2']['autoinit'] = TRUE;
$db['IFCAPB2']['stricton'] = FALSE;

$db['IFCAPB3']['hostname'] = '192.168.0.20\\SQL2014';
// $db['IFCAPB3']['hostname'] = '35.197.137.111\SQL2014';
$db['IFCAPB3']['username'] = 'mgr';
$db['IFCAPB3']['password'] = 'mgr';
$db['IFCAPB3']['database'] = 'yukita'; 
$db['IFCAPB3']['dbdriver'] = 'sqlsrv';
$db['IFCAPB3']['dbprefix'] = '';
$db['IFCAPB3']['pconnect'] = FALSE;
$db['IFCAPB3']['db_debug'] = FALSE;
$db['IFCAPB3']['cache_on'] = FALSE;
$db['IFCAPB3']['cachedir'] = '';
$db['IFCAPB3']['char_set'] = 'utf8';
$db['IFCAPB3']['dbcollat'] = 'utf8_general_ci';
$db['IFCAPB3']['swap_pre'] = '';
$db['IFCAPB3']['autoinit'] = TRUE;
$db['IFCAPB3']['stricton'] = FALSE;


$db['sms']['hostname'] = '10.255.1.70';
// $db['sms']['hostname'] = '202.173.95.232';
// $db['sms']['hostname'] = '192.168.0.48';
$db['sms']['username'] = 'root';
$db['sms']['password'] = 'admin2016'; //'ifcaifca'; //'energyenergy123';
$db['sms']['database'] = 'sms'; //'smsdb';
$db['sms']['dbdriver'] = 'mysql';
$db['sms']['dbprefix'] = '';
$db['sms']['pconnect'] = FALSE;
$db['sms']['db_debug'] = FALSE;
$db['sms']['cache_on'] = FALSE;
$db['sms']['cachedir'] = '';
$db['sms']['char_set'] = 'utf8';
$db['sms']['dbcollat'] = 'utf8_general_ci';
$db['sms']['swap_pre'] = '';
$db['sms']['autoinit'] = TRUE;
$db['sms']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */
