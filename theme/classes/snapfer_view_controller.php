<?php

//Require user class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_user.php');

//Require country class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_country.php');

class snapfer_view_controller extends o3_cms_template_view_controller {

	protected $logged_user = false;

	private $country = false;

	/*
	* On template init
	*/
	public function init() {

		//parent init
		parent::init( func_get_args() );


		if ( !method_exists( $this->parent, 'logged_user' ) ) {
					
			//creat logged user instance and check session
			o3_with($this->logged_user = new snapfer_user())->load_from_session();

			//if user not logged check country
			if ( !$this->logged_user()->is() ) {
				$country_id = 0;

				//if country is stored in session load from session
				if ( isset($_SESSION['snapfer_country_id']) ) {
					$this->country = new snapfer_country( $_SESSION['snapfer_country_id'] );	
				} else {
					$this->country = new snapfer_country( 0 );
					$this->country->load_by_ip( $_SERVER['REMOTE_ADDR'] );
				}

				//if country not found load default country
				if ( !$this->country->is() )
					$this->country = new snapfer_country( DEFAULT_COUNTRY );

				//save country to session
				$_SESSION['snapfer_country_id'] = $this->country->get('id');
			}

		}	

	}

	/*
	* Current country, if user logged than user's country
	* @return object
	*/
	public function country() {
		return $this->country === false ? $this->logged_user()->country() : $this->country;
	}	

	/*
	* Return logged_user 
	* @return object
	*/
	public function logged_user() {
		return $this->logged_user === false ? $this->parent->logged_user() : $this->logged_user;
	}


	/**
	* Check if the requester is the logged user
	*/
	public function is_valid_requester() {
		return $this->logged_user->is() && $this->logged_user->get('id') > 0 && $this->logged_user->get('id') == o3_get('snapfer_logged_user_id');
	}	

}

?>