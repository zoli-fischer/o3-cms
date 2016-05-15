<?php

//handle pdf render
if ( isset($_REQUEST['render-pdf']))
	require_once('render-pdf.php');

//handle cronjob-hourly cronjob
if ( isset($_REQUEST['cronjob-hourly']))
	require_once('cronjob-hourly.php');

//handle file download request
if ( isset($_GET['dl']) ) {

	//Require transfers class
	require_once(O3_CMS_THEME_DIR.'/classes/snapfer_transfers.php');
	
	//load transfer and start download
	$transfer = new snapfer_transfer();
	$transfer->load_canonical( o3_get('dl') );
	$transfer->download( intval(o3_get('fl')), intval(o3_get('r')) );
}

?>