<?php

//handle pdf render
if ( isset($_REQUEST['render-pdf']))
	require_once('render-pdf.php');

/*
//add defines for javascript
$o3->head_inline("
	var SNAFER_TRANSFER_EMAIL = '".o3_html(SNAFER_TRANSFER_EMAIL)."',
		SNAFER_TRANSFER_DOWNLOAD = '".o3_html(SNAFER_TRANSFER_DOWNLOAD)."',
		SNAFER_TRANSFER_SOCIAL = '".o3_html(SNAFER_TRANSFER_SOCIAL)."';
");

snafer_define::
*/

?>