<?php

//Require object class
require_once(O3_CMS_DIR.'/classes/o3_cms_object.php');

//Require users class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_users.php');

//Require country class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_country.php');

//Require email sending class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_emails.php');

//Require define class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_helper.php');

/**
 * O3 Snafer User class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

snafer_helper::define('SNAFER_SIGNED_USER_SESSION_INDEX_NAME','snafer_signed_user_name');
snafer_helper::define('SNAFER_SIGNED_USER_SESSION_INDEX_PASSWORD','snafer_signed_user_password');
snafer_helper::define('SNAFER_SIGNED_USER_SESSION_INDEX_ID','snafer_signed_user_id');

//Subsciption types
snafer_helper::define('SNAFER_FREE','free',true);
snafer_helper::define('SNAFER_PREMIUM','premium',true);

//Subsciption pay types
snafer_helper::define('SNAFER_CARD','card',true);
snafer_helper::define('SNAFER_PAYPAL','paypal',true);

//Subsciption length in days
snafer_helper::define('SNAFER_PERIOD_DAYS',30);

//Subsciption length in seconds
snafer_helper::define('SNAFER_PERIOD_SECS',SNAFER_PERIOD_DAYS * 24 * 3600);

class snafer_user extends o3_cms_object {

	protected $country = false;

	/**
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

			//update
			if ( o3_with(new snafer_users())->update( $values, $conditions ) !== false ) {				

				//reload user data
				$this->reload();

				return true;
			}	
		}
		return false;
	}

	/**
	* Set user password
	*
	* @param string $password Not encrupted password
	*
	* @return boolean
	*/
	public function set_password( $password, $update_session = true ) {
		$password = o3_sha3($password);
		if ( $this->update( array( 'password' => $password ) ) ) {
			if ( $update_session )
				$_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_PASSWORD] = $password;
			return true;
		}
		return false;
	}

	/**
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

	/**
	* Check if user is logged
	* @return boolean
	*/
	public function is_logged() {		
		return $this->is() && !$this->is_deleted() &&
			   isset($_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_NAME]) && $_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_NAME] == $this->get('username') &&
			   isset($_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_PASSWORD]) && $_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_PASSWORD] == $this->get('password') &&
			   isset($_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_ID]) && $_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_ID] == $this->get('id');
	}

	/**
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

	/**
	* Log user out
	*/
	public function set_logged_out() {
		$this->data = null;
		$this->reload();
		$_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_NAME] = '';
		$_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_PASSWORD] = '';
		$_SESSION[SNAFER_SIGNED_USER_SESSION_INDEX_ID] = 0;
	}

	/**
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

	/**
	* Get country object
	*/
	public function country() {
		return $this->country;
	}

	/**
	* Format date by the users country
	*/
	public function format_date( $date ) {
		return $this->country->format_date( $date );
	}

	/**
	* Format number by the users country
	*/
	public function format_number( $nubmer ) {
		return $this->country->format_number( $nubmer );
	}

	/**
	* Display monthly price with currency and formated value
	*/
	public function monthly_price() {
		return $this->country->monthly_price();
	}

 	/**
 	* Check if user's subscription's type is premium
 	*/
 	public function is_premium() {
 		return $this->get('subsciption_type') === SNAFER_PREMIUM;
 	}

 	/**
 	* Check if user's subscription's is paid
 	*/
 	public function is_paid() {
 		return $this->get('subscription_paid') !== null && $this->get('subscription_paid') <= $this->country()->now();
 	}

 	/**
 	* Has payment
 	*/
 	public function has_payment() {
		return $this->get('subscription_pay_type') == SNAFER_CARD || $this->get('subscription_pay_type') == SNAFER_PAYPAL;
 	}

 	/**
 	* Update payment
 	*/
 	public function update_payment( $type, $cardnumber ) {
 		//check valid type and update
 		if ( $type == SNAFER_CARD || $type == SNAFER_PAYPAL ) { 			
 			$update = array( 
 				'subscription_pay_type' => $type, 
 				'subscription_pay_card' => substr( $cardnumber, 12, 4 ) 
 			);
 			
 			return $this->update( $update );
 		}

 		return false;
 	}

 	/*
 	* Check if user allowed for trial
 	*/
 	public function allow_trial() {
 		return $this->get('subscription_trial') === null;
 	}

 	/**
 	* Send subscription set to premium trial notification
 	* @return Boolean If true the email was sent
 	*/ 
 	public function send_premium_trial_subscription_notification() {
	 	if ( $this->is() ) {			
			return o3_with(new snafer_emails())->send( $this->get('email'), 'Welcome to Premium! Enjoy your '.SNAFER_PERIOD_DAYS.' '.( SNAFER_PERIOD_DAYS == 1 ? 'day' : 'days' ).' for free', '<h1>Hello.</h1> <h2>Welcome to Snafer Premium</h2><p>Thanks for taking our '.SNAFER_PERIOD_DAYS.' '.( SNAFER_PERIOD_DAYS == 1 ? 'day' : 'days' ).' free trial!</p><p><b>What is Snafer Premium?</b><ul>
<li>Send up to 20GB per upload</li>
<li>Transfer never expire</li>
<li>Transfer history</li>
<li>Ad free</li>
<li>Secure transfer with password</li>
<li>Customize transfer</li></ul></p><p><br></p>' );
		}
		return false;
	}

	/**
 	* Send subscription set to premium notification
 	* @return Boolean If true the email was sent
 	*/ 
 	public function send_premium_subscription_notification() {
	 	if ( $this->is() ) {			
			return o3_with(new snafer_emails())->send( $this->get('email'), 'Welcome to Premium!', '<h1>Hello.</h1> <h2>Welcome to Snafer Premium</h2><p>Thanks for taking our great service!</p><p><b>What is Snafer Premium?</b><ul>
<li>Send up to 20GB per upload</li>
<li>Transfer never expire</li>
<li>Transfer history</li>
<li>Ad free</li>
<li>Secure transfer with password</li>
<li>Customize transfer</li></ul></p><p><br></p>' );
		}
		return false;
	}

	/**
 	* Send subscription set to free notification
 	* @return Boolean If true the email was sent
 	*/ 
 	public function send_free_subscription_notification() {
	 	if ( $this->is() ) {			
			return o3_with(new snafer_emails())->send( $this->get('email'), 'Welcome to Snafer!', '<h1>Hello.</h1> <h2>Welcome to Snafer Free</h2><p>Thanks for taking our great service!</p><p>You can try Snafer Premium for '.SNAFER_PERIOD_DAYS.' '.( SNAFER_PERIOD_DAYS == 1 ? 'day' : 'days' ).' for free. Just click <a href="'.o3_get_host().$this->o3_cms->page_url( HOME_PAGE_ID, '', 'premium' ).'" target="_blank">here</a>.</p><p><b>What is Snafer Premium?</b><ul>
<li>Send up to 20GB per upload</li>
<li>Transfer never expire</li>
<li>Transfer history</li>
<li>Ad free</li>
<li>Secure transfer with password</li>
<li>Customize transfer</li></ul></p><p><br></p>' );
		}
		return false;
	}

 	/*
 	* Set premium subscription
 	*/
 	public function set_premium_subscription() { 		
 		$now = $this->country->now();
 		$return = false;

 		if ( $this->allow_trial() ) {
			
			$values = array(
					'subsciption_type' => SNAFER_PREMIUM,
					'subsciption_start' => date('Y-m-d',$now),
					'subsciption_end' => date('Y-m-d',$now + SNAFER_PERIOD_SECS),
					'subscription_paid' => date('Y-m-d',$now),
					'subscription_trial' => date('Y-m-d',$now)
				);			
			$return = $this->update( $values );
	
			//create payment
			if ( $return ) {
				//send notification email
				$this->send_premium_trial_subscription_notification();

				//create invoice
				$this->add_subscription_payment( true );
			}

		} else if ( $this->is_paid() ) {

			$values = array(
					'subsciption_type' => SNAFER_PREMIUM					
				);			
			$return = $this->update( $values );

		} else {

			$values = array(
					'subsciption_type' => SNAFER_PREMIUM,
					'subsciption_start' => date('Y-m-d',$now),
					'subsciption_end' => date('Y-m-d',$now + SNAFER_PERIOD_SECS),
					'subscription_paid' => $this->has_payment() ? date('Y-m-d',$now) : null
				);			
			$return = $this->update( $values );

			//create payment
			if ( $return ) {
				
				//send notification email
				$this->send_premium_subscription_notification();

				//create invoice
				$this->add_subscription_payment( true );
			}

		}
		return $return;
 	} 

 	/**
 	* Send cancel subscription notification
 	* @return Boolean  If true the email was sent
 	*/ 
 	public function send_subscription_canceled_notification() {
	 	if ( $this->is() ) {			
			return o3_with(new snafer_emails())->send( $this->get('email'), 'You have cancelled your Snafer subscription', '<h1>Hello.</h1> <p>We thought you\'d like to know that you have successfully cancelled your Snafer subscription.</p><p>We\'re sorry to lose you as a subscriber, but you can come back any time just go to your account and re-subscribe.</p>' );
		}
		return false;
	}
 	
 	/**
 	* Cancel subscription
 	* @param $send_notification Boolean If true email with cancel subscription notification will be sent to user
 	* @return Boolean  If true the subscription was cancelled
 	*/ 
 	public function cancel_subscription( $send_notification = true ) {
 		if ( !$this->is_premium() )
 			return true;

 		//update user
 		$update = array( 
 			'subsciption_type' => SNAFER_FREE/*, 
 			'subscription_paid' => null,
 			'subsciption_start' => null,
 			'subsciption_end' => null*/
 		); 			 			 		
 		$this->update( $update );

		//send email notification
 		if ( $send_notification && !$this->is_premium() )
 			$this->send_subscription_canceled_notification();

 		//check is still premium
 		return !$this->is_premium();
 	}

 	/**
 	* Add payment
 	*
 	* @param boolean $is_trial If the payment is for trial, than the value is 0
 	* @return boolean
 	*/
 	public function add_subscription_payment( $is_trial = false ) {
 		if ( $this->is() ) {
 			$has_vat = $this->country->has_vat();
 			
 			//home country always vat payment and if country has vat and no vat inserted than vat payment
 			$vat_percent = $has_vat && ( $this->country->get('country_code') == SNAFER_PAYMENT_HOME_COUNTRY || strlen(trim($this->get('bil_vat'))) == 0 ) ? SNAFER_PAYMENT_VAT_PERCENT : 0;
 		
 			$total_excl_vat = $is_trial ? 0 : snafer_payments::get_excl_vat_value( $this->country->get('monthly_price'), $vat_percent );;
 			$total_vat = $total_excl_vat * $vat_percent / 100;
 			$total_incl_vat = $total_excl_vat + $total_vat;

	 		$values = array(
	 				'user_id' => $this->get('id'),
	 				'username' => $this->get('username'),
	 				'email' => $this->get('email'),
	 				'mobile' => $this->get('mobile'),
	 				'country_id' => $this->country->get('id'),
	 				'bil_name' => $this->get('bil_name'),
	 				'bil_vat' => $this->get('bil_vat'),	 				
	 				'bil_country' => $this->country->get('name'),
	 				'bil_city' => $this->get('bil_city'),
	 				'bil_zip' => $this->get('bil_zip'),
	 				'bil_address' => $this->get('bil_address'),
	 				'product' => "Snafer Premium monthly subscription from ".$this->format_date($this->get('subsciption_start'))." to ".$this->format_date($this->get('subsciption_end')),
	 				'currency' => $this->country->get('currency'),
	 				'show_vat' => $has_vat ? 1 : 0,
	 				'vat_percent' => $vat_percent,
	 				'total_excl_vat' => $total_excl_vat,
	 				'total_vat' => $total_vat,
	 				'total_incl_vat' => $total_incl_vat,
	 				'subscription_pay_type' => $this->get('subscription_pay_type'),
	 				'subscription_pay_card' => $this->get('subscription_pay_card')
	 			);
	 		return o3_with(new snafer_payments())->insert( $values );
	 	}
	 	return false;
 	}

 	/**
 	* Get user's payments
 	*/
 	public function get_payments() {
 		$payments = array();
 		if ( $this->is() ) {
 			$user_payments = o3_with(new snafer_payments())->select( 'id',  ' user_id = '.$this->get('id'), ' created DESC ' );
 			foreach ( $user_payments as $key => $value )
 				$payments[] = new snafer_payment( $value->id );
		}
		return $payments;
 	}


}

?>