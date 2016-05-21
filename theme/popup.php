<?php 

//Require transfers class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_template_controller.php');

$popup_name = o3_get('snapfer-popup-name');
$view = 'popup/o3_cms_template_view_'.basename($popup_name);

//load view into template
$o3->template->view( $view );

//flush buffer
$o3->template->flush();

die();

?>