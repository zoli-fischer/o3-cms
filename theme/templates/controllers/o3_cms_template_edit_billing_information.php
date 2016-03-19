<?php

//Require theme controller class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_template_controller.php');

class o3_cms_template_edit_billing_information extends snafer_template_controller {

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

	public function ajax_edit_billing_information() {

		//check if user logged and he/she is the sender
		if ( $this->logged_user()->validate_ajax( $this->ajax_result ) ) {
				
			//update billing information
			if ( $this->logged_user()->update( array(
					'bil_name' => $this->ajax_result->value('bil_name'),
					'bil_vat' => $this->ajax_result->value('bil_vat'),
					'bil_city' => $this->ajax_result->value('bil_city'),
					'bil_zip' => $this->ajax_result->value('bil_zip'),
					'bil_address' => $this->ajax_result->value('bil_address')
				) ) )
				$this->ajax_result->success();

		}

	}

}

?>