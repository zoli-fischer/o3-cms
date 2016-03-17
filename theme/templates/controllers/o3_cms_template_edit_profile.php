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

}

?>