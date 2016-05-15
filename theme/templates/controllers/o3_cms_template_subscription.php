<?php

//Require theme controller class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_template_controller.php');

class o3_cms_template_subscription extends snapfer_template_controller {

	public function init() {

		//parent init
		parent::init( func_get_args() );


	}

}

?>