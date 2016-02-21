<?php

//load O3 CMS config
require_once( str_replace(DIRECTORY_SEPARATOR, '/', realpath(dirname(__FILE__) )).'/o3_cms/config.php');

//Require O3 engine
require_once(O3_DIR.'/o3.php');

//Create global O3 instance 
$o3 = new o3();

//Load o3 modules
$o3->module( 'mysqli' );
$o3->module( 'mini' );
$o3->module( 'template' );
$o3->load();	

//Set mysqli char encoding	
if ( isset($o3->mysqli) )
	$o3->mysqli->set_charset("utf8");

//Require o3 class
require_once(O3_CMS_DIR.'/classes/o3_cms.php');

//Create global O3 cms instance and flush the template buffer
o3_with($o3_cms = new o3_cms())->flush();

?>