<?php

//Require theme controller class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_template_controller.php');

class o3_cms_template_account extends snafer_template_controller {

	public function init() {

		//parent init
		parent::init( func_get_args() );
		

	}

}

?>