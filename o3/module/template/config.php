<?php

/**
 * PHP/HTML Templating module for O3 Engine
 *
 * Config file
 *
 * @package o3
 * @link    todo: add url
 * @author  Zotlan Fischer <zoli_fischer@yahoo.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
 
use o3\config as config;

/** The location of the directory with template files */
config\def('O3_TEMPLATE_DIR', str_replace(DIRECTORY_SEPARATOR, '/', realpath(dirname(__FILE__))).'/template' );   

/** The location of the directory with template controller files */
config\def('O3_TEMPLATE_CONTROLLER_DIR', O3_TEMPLATE_DIR.'/controller' );   

/** The location of the directory with view files */
config\def('O3_TEMPLATE_VIEW_DIR', O3_TEMPLATE_DIR.'/view' );   
	
/** The location of the directory with view controller files */
config\def('O3_TEMPLATE_VIEW_CONTROLLER_DIR', O3_TEMPLATE_VIEW_DIR.'/controller' );   
	

?>