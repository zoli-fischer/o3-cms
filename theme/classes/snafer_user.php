<?php

//Require object class
require_once(O3_CMS_DIR.'/classes/o3_cms_object.php');

//Require users class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_users.php');

//Require country class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_country.php');

/**
 * O3 Snafer User class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

define('SNAFER_SIGNED_USER_SESSION_INDEX_NAME','snafer_signed_user_name');
define('SNAFER_SIGNED_USER_SESSION_INDEX_PASSWORD','snafer_signed_user_password');
define('SNAFER_SIGNED_USER_SESSION_INDEX_ID','snafer_signed_user_id');

//Subsciption types
define('SNAFER_FREE','free');
define('SNAFER_PREMIUM','premium');

//Subsciption pay types
define('SNAFER_CARD','card');
define('SNAFER_PAYPAL','paypal');


class snafer_user extends o3_cms_object {

	protected $country = false;

	/*
	* Load user with id
	* @param id User id to select
	*/
	public function load( $id ) {				
		if ( $id > 0 ) {
			$this->data = o3_with(new snafer_users())->get_by_id( $id );			

			//load country
			if ( $this->is() ) {
				$this->country = new snafer_country( $this->get('country_id') );

				//if country not found load default country
				if ( !$this->country->is() )
					$this->country = new snafer_country( DEFAULT_COUNTRY );

			}

		}
	}

	/**
	 * Update user
	 *
	 * @param array $values List of values
	 * @param array $condition List of conditions
	 *
	 * @return boolean
	 */
	public function update( $values, $conditions = null ) {
		if ( $this->is() ) {
			$conditions = $conditions === null ? array() : $conditions;
			$conditions['id'] = $this->get('id');

			return o3_with(new snafer_users())->update( $values, $conditions );
		}
		return false;
	}

	/*
	* Set user password
	*
	* @param string $password Not encrupted password
	*
	* @return boolean
	*/
	public function set_password( $password ) {
		$password = o3_sha3($password);
		if ( $this->update( array( 'password' => $password ) ) ) {
			$_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_PASSWORD] = $password;
			return true;
		}
		return false;
	}

	/*
	* Log in user from session
	*/
	public function load_from_session() {
		if ( isset($_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_NAME]) && isset($_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_PASSWORD]) && isset($_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_ID]) ) {
			$data = o3_with(new snafer_users())->get_by_username( $_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_NAME] );
			if ( $data !== false && $data->id == $_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_ID] && $data->password == $_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_PASSWORD]  ) {
				$this->data = $data;
				$this->reload();
				return true;
			}
		}
		return false;
	}

	/*
	* Check if user is logged
	* @return boolean
	*/
	public function is_logged() {		
		return $this->is() && !$this->is_deleted() &&
			   isset($_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_NAME]) && $_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_NAME] == $this->get('username') &&
			   isset($_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_PASSWORD]) && $_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_PASSWORD] == $this->get('password') &&
			   isset($_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_ID]) && $_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_ID] == $this->get('id');
	}

	/*
	* Log user in
	*/
	public function set_logged( $username, $password ) {
		//encrypt password
		$password = o3_sha3( $password );

		//if already logged in and username is the same return true
		if ( $this->is_logged() && $this->get('username') == $username && $this->get('password') == $password ) {
			return true;
		} else if ( !$this->is_logged() ) {
			$data = o3_with(new snafer_users())->get_by_username( $username );
			if ( $data !== false && $data->deleted == 0 && $data->password == $password ) {
				$this->data = $data;
				$this->reload();
				$_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_NAME] = $this->get('username');
				$_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_PASSWORD] = $this->get('password');
				$_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_ID] = $this->get('id');
				return true;
			}
		}
		$this->set_logged_out();
		return false;
	}

	/*
	* Log user out
	*/
	public function set_logged_out() {
		$this->data = null;
		$this->reload();
		$_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_NAME] = '';
		$_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_PASSWORD] = '';
		$_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_ID] = 0;
	}

	/*
	* Check if user logged and he/she is the sender
	*/
	public function validate_ajax( &$ajax_result ) {

		if ( $this->is_logged() ) {

			//check if the current user is the sender
			if ( $this->get('id') == $ajax_result->value('snafer_logged_user_id') ) {

				return true;

			} else {
				//set error
				$ajax_result->error();
			}

		} else {
			//rediret user
			$ajax_result->redirect('/');
		}

		return false;		
	}

	/*
	* Get country object
	*/
	public function country() {
		return $this->country;
	}

	/*
	* Format date by the users country
	*/
	public function format_date( $date ) {
		return $this->country->format_date( $date );
	}

	/*
	* Format number by the users country
	*/
	public function format_number( $nubmer ) {
		return $this->country->format_number( $nubmer );
	}

	/*
	* Display monthly price with currency and formated value
	*/
	public function monthly_price() {
		return $this->country->monthly_price();
	}

 	/*
 	* Check if user's subscription's type is premium
 	*/
 	public function is_premium() {
 		return $this->get('subsciption_type') === SNAFER_PREMIUM;
 	}

 	/*
 	* Check if user's subscription's is paid
 	*/
 	public function is_paid() {
 		return $this->get('subscription_paid') > '0000-00-00';
 	}

 	/*
 	* Update payment
 	*/
 	public function update_payment( $type, $cardnumber ) {
 		//check valid type and update
 		if ( $type == SNAFER_CARD || $type == SNAFER_PAYPAL )
 			return $this->update( array( 'subscription_pay_type' => $type, 'subscription_pay_card' => substr( $cardnumber, 12, 4 ) ) );

 		return false;
 	}

	


}

?>