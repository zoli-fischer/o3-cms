<?php

use o3\config;

/*FILESYSTEM*/

/** URL to your O3 installation */
o3\config\def('O3_URL',O3_CMS_URL.'/o3');

/** The location of the O3 cache directory */
o3\config\def("O3_CACHE_DIR", O3_CMS_ROOT_DIR."/cache");

/** The location of the directory with json language files */
o3\config\def("O3_LANG_DIR", O3_CMS_DIR.'/langs' );

/*URL*/

/** URL to cache forlder for your O3 installation */
o3\config\def("O3_CACHE_URL", O3_CMS_URL.'/cache');


/** O3 Admin utility */

/** Username and password used by the admin utility in www/ */
o3\config\def( "O3_ADMIN_USERNAME", "test" );
o3\config\def( "O3_ADMIN_PASSWORD", "test" );


/** OPTIMIZE, MINIMIZE & CACHE */

/** Allow js & css compression */
o3\config\def('O3_MINI_MINIMIZE', O3_CMS_MINI_MINIMIZE );

/** Allow minimizeing of html output */
o3\config\def('O3_MINI_HTML_OUTPUT', O3_CMS_MINI_HTML_OUTPUT );

/** Compress javascript */
o3\config\def('O3_MINI_JS', O3_CMS_MINI_JS );

/** Compress css */
o3\config\def('O3_MINI_CSS', O3_CMS_MINI_CSS );


/** DATABASE */

/** Connect to mysql server after O3 initialization */
o3\config\def('O3_MYSQLI_AUTOCONNECT',O3_CMS_MYSQLI_AUTOCONNECT);

/** MySql server's host name */
o3\config\def('O3_MYSQLI_HOST',O3_CMS_MYSQLI_HOST);

/** MySql server auth. username */
o3\config\def('O3_MYSQLI_USER',O3_CMS_MYSQLI_USER);

/** MySql server auth. password */
o3\config\def('O3_MYSQLI_PASSWORD',O3_CMS_MYSQLI_PASSWORD);

/** MySql default database to select */
o3\config\def('O3_MYSQLI_DB',O3_CMS_MYSQLI_DB);

/** MySql table name prefiex */
o3\config\def('O3_MYSQLI_TABLE_PREFIX',O3_CMS_MYSQLI_TABLE_PREFIX);

/** Show performed mysqli queries in debug console if debugging allowed */
o3\config\def('O3_MYSQLI_DEBUG_QUERIES', O3_CMS_MYSQLI_DEBUG_QUERIES );


/** TEMPLATES **/

/** The location of the directory with template files */
o3\config\def('O3_TEMPLATE_DIR', O3_CMS_ROOT_DIR.'/theme/templates' );   

/** The location of the directory with template controller files */
o3\config\def('O3_TEMPLATE_CONTROLLER_DIR', O3_TEMPLATE_DIR.'/controllers' );   

/** The location of the directory with view files */
o3\config\def('O3_TEMPLATE_VIEW_DIR', O3_TEMPLATE_DIR.'/views' );   
	
/** The location of the directory with view controller files */
o3\config\def('O3_TEMPLATE_VIEW_CONTROLLER_DIR', O3_TEMPLATE_VIEW_DIR.'/controllers' );




?>