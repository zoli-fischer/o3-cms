<?php

//Require theme controller class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_template_controller.php');

class o3_cms_template_edit_profile extends snafer_template_controller {

	protected $bday_day;
	protected $bday_month;
	protected $bday_year;

	public function init() {

		//parent init
		parent::init( func_get_args() );

		//get bday
		$date = explode( "-", $this->logged_user()->get('bday') );
		$this->bday_day = intval($date[2]);
		$this->bday_month = intval($date[1]);
		$this->bday_year = intval($date[0]);

	}

	public function ajax_edit_profile() {

		//check if user logged and he/she is the sender
		if ( $this->logged_user()->validate_ajax( $this->ajax_result ) ) {
			
			//check if current password is correct
			if ( $this->logged_user()->get('password') === o3_sha3($this->ajax_result->value('password')) ) {

				//update profile
				if ( $this->logged_user()->update( array(
						'email' => $this->ajax_result->value('email'),
						'bday' => $this->ajax_result->value('bday'),
						'gender' => $this->ajax_result->value('gender'),
						'mobile' => $this->ajax_result->value('mobile'),
						'country_id' => $this->ajax_result->value('country_id')
					) ) )
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