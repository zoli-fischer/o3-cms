<?php

//Require user class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_user.php');

//Require country class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_country.php');

class snafer_template_controller extends o3_cms_template_controller {

	protected $logged_user = false;

	private $country = false;

	/*
	* On template init
	*/
	public function init() {

		//parent init
		parent::init( func_get_args() );

		//creat logged user instance and check session
		o3_with($this->logged_user = new snafer_user())->load_from_session();

		//if user not logged check country
		if ( !$this->logged_user()->is() ) {
			$country_id = 0;

			//if country is stored in session load from session
			if ( isset($_SESSION['snafer_country_id']) ) {
				$this->country = new snafer_country( $_SESSION['snafer_country_id'] );	
			} else {
				$this->country = new snafer_country( 0 );
				$this->country->load_by_ip( $_SERVER['REMOTE_ADDR'] );
			}

			//if country not found load default country
			if ( !$this->country->is() )
				$this->country = new snafer_country( DEFAULT_COUNTRY );

			//save country to session
			$_SESSION['snafer_country_id'] = $this->country->get('id');
		}

	}

	/*
	* Current country, if user logged than user's country
	* @return object
	*/
	public function country() {
		return $this->country === false ? $this->logged_user->country() : $this->country;
	}	

	/*
	* Return logged_user 
	* @return object
	*/
	public function logged_user() {
		return $this->logged_user;
	}

}

?>