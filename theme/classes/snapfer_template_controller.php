<?php


//Require user class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_user.php');

//Require country class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_country.php');

class snapfer_template_controller extends o3_cms_template_controller {

	protected $logged_user = false;

	private $country = false;

	/*
	* On template init
	*/
	public function init() {

		//parent init
		parent::init( func_get_args() );

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

	/**
	* Set page meta image
	*/
	public function page_image() {
		return o3_get_host().'/res/snapfer-image.jpg';
	}	

	/**
	* Set page meta image width
	* Facebook recomands: 1200 x 630 or 600 x 315
	*/
	public function page_image_width() {
		return 1024;
	}	

	/**
	* Set page meta image height
	* Facebook recomands: 1200 x 630 or 600 x 315
	*/
	public function page_image_height() {
		return 768;
	}	

	/**
	* Set page meta image height
	* Facebook recomands: 1200 x 630 or 600 x 315
	*/
	public function page_url() {
		return o3_get_host().'/'.$this->o3_cms->page_url();
	}
	
}

?>