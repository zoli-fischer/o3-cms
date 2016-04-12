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

			//check where to send the user after payment added
			$redirect_url = !$this->logged_user()->has_payment() ? $this->o3_cms()->page_url( HOME_PAGE_ID ) : $this->o3_cms()->page_url( SUBSCRIPTION_PAGE_ID );

			//if payment method updated send success
			if ( $this->logged_user()->update_payment( $this->ajax_result->value('type'), $this->ajax_result->value('cardnumber') ) ) {

				//redirect
				$this->ajax_result->redirect( $redirect_url );

				//set success
				$this->ajax_result->success();
			}

		}
		
		

	}

}

?>