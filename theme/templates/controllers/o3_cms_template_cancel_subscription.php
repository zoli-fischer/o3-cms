<?php

//Require theme controller class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_template_controller.php');

class o3_cms_template_cancel_subscription extends snapfer_template_controller {

	public function init() {

		//parent init
		parent::init( func_get_args() );


		//if not premium redirect from this apge
		if ( !$this->logged_user()->is_premium() )
			o3_redirect( $this->o3_cms()->page_url(ACCOUNT_PAGE_ID) );
		

	}

	//update payment
	public function ajax_cancel_subscription() {

		//check if user logged and he/she is the sender
		if ( $this->logged_user()->validate_ajax( $this->ajax_result ) ) {
			
			//if payment method updated send success
			if ( $this->logged_user()->cancel_subscription() ) {
				
				//set success
				$this->ajax_result->success();
			}

		}
		
		

	}


}

?>