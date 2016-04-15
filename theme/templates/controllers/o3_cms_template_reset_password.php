<?php

//Require theme controller class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_template_controller.php');

class o3_cms_template_reset_password extends snafer_template_controller {

	public function init() {

		//parent init
		parent::init( func_get_args() );
		
	}

	public function ajax_reset_password() {

		if ( $this->logged_user()->is() ) {
			$this->ajax_result->redirect( $this->o3_cms()->page_url(HOME_PAGE_ID)  );
		} else {
			$users = new snafer_users();
			
			if ( ( $userdata = $users->get_by_username( $this->ajax_result->value('username') ) ) !== false ) {
				$this->ajax_result->success();
			} else if ( ( $userdata = $users->get_by_email( $this->ajax_result->value('username') ) ) !== false ) {
				$this->ajax_result->success();
			}

			//$this->ajax_result->success();
		}
	}

}

?>