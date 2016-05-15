<?php

namespace o3_cms\config;

/** O3 CMS GENERAL */

//O3 CMS Version
define('O3_CMS_VERSION', '1.0a');

//The root of your O3 CMS installation
if ( !defined('O3_CMS_ROOT_DIR') )
  define("O3_CMS_ROOT_DIR", str_replace(DIRECTORY_SEPARATOR, '/', realpath(dirname(__FILE__).'/..')));

//The path to cms classes
define("O3_CMS_DIR", O3_CMS_ROOT_DIR.'/o3_cms' );

//Current host
define('O3_CMS_HOST', $_SERVER['HTTP_HOST'] );

//Is https used 
define('O3_CMS_IS_HTTPS', isset($_SERVER['HTTPS']) );

//URL to your O3 CMS installation
define('O3_CMS_URL', 'http'.( O3_CMS_IS_HTTPS ? 's' : '' ).'://'.O3_CMS_HOST);

/** The location of the directory with themes files */
define('O3_CMS_THEME_DIR', O3_CMS_ROOT_DIR.'/theme' );   

//URL to theme
define('O3_CMS_THEME_URL', O3_CMS_URL.'/theme');

/** The location of the directory with themes files */
define('O3_CMS_ADMIN_DIR', O3_CMS_DIR.'/admin' );   

//URL to theme
define('O3_CMS_ADMIN_URL', O3_CMS_URL.'/admin');

/** LOAD USER CONFIG **/
require_once(O3_CMS_ROOT_DIR."/config.php");

/** DEFINE VALUES NOT DEFINED BY USER **/

/** 
* Defines a named constant if not allready defined
* @param $name string The name of the constant. 
* @param $name mixed The value of the constant; only scalar and null values are allowed. Scalar values are integer, float, string or boolean values.
* @param $case_insensitive bool (optional) If set to TRUE, the constant will be defined case-insensitive. The default behavior is case-sensitive. 
*/
function def( $name, $value, $case_insensitive = false ) {
	if ( !defined($name) ) define( $name, $value, $case_insensitive );
}

/** DEBUG, LOG & TEST */

/** ALlow debug if test mode active */
def( 'O3_DEBUG_ALLOWED', O3_CMS_TESTMODE );

//Set error reporting for test mode
if ( O3_CMS_TESTMODE ) {		
	error_reporting( E_ERROR || E_NOTICE || E_WARNING || E_PARSE );
	ini_set('display_errors', 'On'); 
} else {
	error_reporting( 0 );
	ini_set('display_errors', 'Off');
}

/** OPTIMIZE, MINIMIZE & CACHE */

//Allow js & css compression
def('O3_CMS_MINI_MINIMIZE', true );

//Compress javascript
def('O3_CMS_MINI_HTML_OUTPUT', true );

//Compress javascript
def('O3_CMS_MINI_JS', true );

//Compress css
def('O3_CMS_MINI_CSS', true );

/** DATABASE */

//Connect to mysql server after O3 initialization
def('O3_CMS_MYSQLI_AUTOCONNECT',true);

//MySql server's host name
def('O3_CMS_MYSQLI_HOST','localhost');

//MySql server auth. username
def('O3_CMS_MYSQLI_USER','root');

//MySql server auth. password
def('O3_CMS_MYSQLI_PASSWORD','');

//MySql default database to select
def('O3_CMS_MYSQLI_DB',"");

//Show performed mysqli queries in debug console if debugging allowed
def('O3_CMS_MYSQLI_DEBUG_QUERIES', false );

//MySql table name prefiex
def('O3_CMS_MYSQLI_TABLE_PREFIX','o3_cms_');


/** LOAD O3 CONFIG */

//Set O3 custom config file
define('O3_CUSTOM_CONFIG', O3_CMS_DIR.'/config.o3.php');

//Load O3 main config
require_once(O3_CMS_ROOT_DIR.'/o3/config.php');
 

?>