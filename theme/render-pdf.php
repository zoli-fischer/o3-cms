<?php

/**
* Rendering the invoice PDF
* Invoice is rendered as HTML and converted to PDF  
*/

$id = o3_get('id');
$download = o3_get('download',0); // 0 - inline pdf, 1 - download pdf, 2 - html
$type = o3_get('render-pdf');
$view = 'pdf/o3_cms_template_view_render_pdf_'.basename($type);

/*
* Extract title tag content from html
*
* @param string html content
* @return mixed title tag  value if found else false
*/
function get_title_from_html( $html ) {
	if ( preg_match('/<title>(.+)<\/title>/', $html, $matches ) && isset($matches[1]) )
	   return $matches[1];
	return false;
}
 
$o3->template->view( $view, $id );

//turn on output buffer
ob_start();

//flush template buffer
$o3->template->flush();

//store buffer content
$pdf_content = ob_get_contents();

//turn off output buffer
ob_end_clean();

//check for pdf content
if ( trim(strlen($pdf_content)) == 0 ) {
	//return 404
	o3_header_code(404);
} else {

	//show html
	if ( $download == 2 )
		die($pdf_content);

	//file name from html title
	$filename = get_title_from_html( $pdf_content ).'.pdf';

	//load dom pdf
	require_once( O3_CMS_THEME_DIR.'/lib/dompdf/dompdf_config.inc.php' );
	$dompdf = new DOMPDF();
	$dompdf->set_paper( 'A4' );
 	
 	//replace local url with local path
	$pdf_content = str_replace( o3_get_host().'/', O3_CMS_THEME_DIR.'/', $pdf_content );

	//no debug
	$o3->debug->show( false );

	//set pdf content
	$dompdf->load_html( $pdf_content );
	$pdf = $dompdf->render();
	
	$dompdf->stream( $filename, array("Attachment" => $download == 1 ? 1 : 0 ));

}

//stop the script
die();

?>