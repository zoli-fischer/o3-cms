<?php

//Require theme controller class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_template_controller.php');

class o3_cms_template_update_payment extends snafer_template_controller {

	public function init() {

		//parent init
		parent::init( func_get_args() );

	}


	//update payment
	public function ajax_update_method() {

		//check if user logged and he/she is the sender
		if ( $this->logged_user()->validate_ajax( $this->ajax_result ) ) {

			//if payment method updated send success
			if ( $this->logged_user()->update_payment( $this->ajax_result->value('type'), $this->ajax_result->value('cardnumber') ) ) {

				//redirect to subscription page
				$this->ajax_result->redirect('/subscription');

				//set success
				$this->ajax_result->success();
			}

		}
		
		

	}

}

?>