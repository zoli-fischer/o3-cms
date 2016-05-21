<?php

//Require theme view controller class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_view_controller.php');

class o3_cms_template_view_footer extends snapfer_view_controller {

	public function init() {

		//parent init
		parent::init( func_get_args() );
		
	}
	
}

?>