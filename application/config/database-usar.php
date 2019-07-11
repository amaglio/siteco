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

//Conexión a CEMADESA para ABMCs
//$active_group = 'default';
//$active_record = TRUE;
//$db['default']['hostname'] = '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=satu)(PORT=1521))(CONNECT_DATA=(SID=cema)))';
////////$db['default']['hostname'] = '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=jupiter)(PORT=1521))(CONNECT_DATA=(SID=cema)))';
////////$db['default']['username'] = 'vletizia';
////////$db['default']['password'] = 'Ariane95';
//$_SESSION['usr'] = $db['default']['username'] = 'cemap';
//$db['default']['password'] = 'prueba_cema';
//$db['default']['database'] = 'cemadesa';
//$db['default']['dbdriver'] = 'oci8';
//$db['default']['dbprefix'] = '';
//$db['default']['pconnect'] = FALSE;
//$db['default']['db_debug'] = TRUE;
//$db['default']['cache_on'] = FALSE;
//$db['default']['cachedir'] = '';
//$db['default']['char_set'] = 'WE8ISO8859P1';
//$db['default']['dbcollat'] = '';
//$db['default']['swap_pre'] = '';
//$db['default']['autoinit'] = FALSE;
//$db['default']['stricton'] = FALSE;

$active_group = 'default';
$active_record = TRUE;

/*
$db['default']['hostname'] = 'localhost';
$db['default']['username'] = '';
$db['default']['password'] = '';
$db['default']['database'] = '';
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = FALSE;
$db['default']['stricton'] = FALSE; */

// -------- PARA VER LAS FOTOS -------------- //

$db['db2']['hostname'] = 'dbfotos.ucema.edu.ar';
$db['db2']['username'] = 'fotoslectura';
$db['db2']['password'] = 'fotoslectura';
$db['db2']['database'] = 'fotos';
$db['db2']['dbdriver'] = 'mysql';
$db['db2']['dbprefix'] = '';
$db['db2']['pconnect'] = FALSE;
$db['db2']['db_debug'] = TRUE;
$db['db2']['cache_on'] = FALSE;
$db['db2']['cachedir'] = '';
$db['db2']['char_set'] = 'utf8';
$db['db2']['dbcollat'] = 'utf8_general_ci';
$db['db2']['swap_pre'] = '';
$db['db2']['autoinit'] = FALSE;
$db['db2']['stricton'] = FALSE;
 


/* End of file database.php */
/* Location: ./application/config/database.php */
