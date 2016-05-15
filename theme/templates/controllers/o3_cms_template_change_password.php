<?php

//Require theme controller class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_template_controller.php');

class o3_cms_template_change_password extends snapfer_template_controller {

	public function init() {

		//parent init
		parent::init( func_get_args() );

	}

	public function ajax_change_password() {
		
		//check if user logged and he/she is the sender
		if ( $this->logged_user()->validate_ajax( $this->ajax_result ) ) {
			
			//check if current password is correct
			if ( $this->logged_user()->get('password') === o3_sha3($this->ajax_result->value('password')) ) {

				//set new password to user and send success
				if ( $this->logged_user()->set_password( $this->ajax_result->value('password_new') ) )
					$this->ajax_result->success();

			} else {

				//send password error
				$this->ajax_result->data( 'password', true );

	
				//set error
				$this->ajax_result->error();

			}

		}

	}

}

?>