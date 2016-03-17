<?php

//Require user class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_user.php');

class snafer_template_controller extends o3_cms_template_controller {

	protected $logged_user;

	/*
	* On template init
	*/
	public function init() {

		//parent init
		parent::init( func_get_args() );

		//creat logged user instance and check session
		o3_with($this->logged_user = new snafer_user())->load_from_session();

	}

	/*
	* Return logged_user 
	* @void object
	*/
	public function logged_user() {
		return $this->logged_user;
	}

}

?>