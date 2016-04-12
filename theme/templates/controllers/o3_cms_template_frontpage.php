<?php

//Require theme controller class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_template_controller.php');

class o3_cms_template_frontpage extends snafer_template_controller {

	public function init() {

		//parent init
		parent::init( func_get_args() );
		
		//check for logout
		if ( isset($_GET['snafer-sign-out']) ) {

			//log out user
			$this->logged_user()->set_logged_out();
			
			//reload admin page
			o3_redirect("/");
		}		
 
	}

	/*
	* Ajax call handler for sign out
	*/
	public function ajax_sign_up() {
		
		//log out user if is logged
		if ( $this->logged_user()->is_logged() )
			$this->logged_user()->set_logged_out();

		$values = array(
			'username' => $this->ajax_result->value('username'),
			'password' => o3_sha3($this->ajax_result->value('password')),
			'email' => $this->ajax_result->value('email'),
			'bday' => $this->ajax_result->value('bday'),
			'gender' => $this->ajax_result->value('gender'),
			'country_id' => $this->country()->get('id'),			
			'bil_name' => $this->ajax_result->value('bil_name'),
			'bil_vat' => $this->ajax_result->value('bil_vat'),
			'bil_city' => $this->ajax_result->value('bil_city'),
			'bil_zip' => $this->ajax_result->value('bil_zip'),
			'bil_address' => $this->ajax_result->value('bil_address')
		);
		
		//check if username available
		if ( o3_with(new snafer_users())->get_by_username( $this->ajax_result->value('username') ) !== false ) {

			$this->ajax_result->data('username',true);

			//send error
			$this->ajax_result->error();
		};

		//check if email available
		if ( o3_with(new snafer_users())->get_by_email( $this->ajax_result->value('email') ) !== false ) {

			$this->ajax_result->data('email',true);

			//send error
			$this->ajax_result->error();
		};

		//insert user
		$id = o3_with(new snafer_users())->insert( $values );

		if ( $id !== false && $id > 0 ) {

			//set user logged
			$this->logged_user()->set_logged( $this->ajax_result->value('username'), $this->ajax_result->value('password') );			

			//if premium sign up, set premium/trial period
			if ( $this->ajax_result->value('sign_up_type') == SNAFER_PREMIUM )
				$this->logged_user()->set_premium_subscription();

			//send user data
			$this->ajax_result->data('id',$this->logged_user->get('id'));
			$this->ajax_result->data('username',$this->logged_user->get('username'));
			$this->ajax_result->data('subsciption_type',$this->logged_user->get('subsciption_type'));
			$this->ajax_result->data('allow_trial',$this->logged_user->allow_trial());

			//redirect user to add payment
			if ( $this->logged_user->get('subsciption_type') == SNAFER_PREMIUM )
				$this->ajax_result->redirect( $this->o3_cms()->page_url(UPDATE_PAYMENT_METHOD_PAGE_ID) );	

			//send success
			$this->ajax_result->success();
		};

	}

	/*
	* Ajax call handler for go premium
	*/
	public function ajax_go_premium() {

		//check if user logged and he/she is the sender
		if ( $this->logged_user()->validate_ajax( $this->ajax_result ) ) {

			//if already premium send to account
			if ( $this->logged_user()->is_premium() ) {

				$this->ajax_result->redirect( $this->o3_cms()->page_url( ACCOUNT_PAGE_ID ) );

			} else {

				$values = array(
					'bil_name' => $this->ajax_result->value('bil_name'),
					'bil_vat' => $this->ajax_result->value('bil_vat'),
					'bil_city' => $this->ajax_result->value('bil_city'),
					'bil_zip' => $this->ajax_result->value('bil_zip'),
					'bil_address' => $this->ajax_result->value('bil_address')
				);

				if ( $this->logged_user()->update( $values ) ) {
					
					$this->ajax_result->redirect( $this->o3_cms()->page_url(ACCOUNT_PAGE_ID) );	
						
					//if trial set send to payment page else to account
					if ( $this->logged_user()->set_premium_subscription() ) {
						
						//if no payment method on account send to add payment method
						if ( !$this->logged_user()->has_payment() )
							$this->ajax_result->redirect( $this->o3_cms()->page_url(UPDATE_PAYMENT_METHOD_PAGE_ID) );

					}					

					$this->ajax_result->success();
				}
			}
		}
	}

	/*
	* Ajax call handler for sign out
	*/
	public function ajax_sign_out() {
		
		//log out user
		$this->logged_user()->set_logged_out();

		//user is logged out
		$this->ajax_result->success();
	}

	/*
	* Ajax call handler for sign in
	*/
	public function ajax_sign_in() {

		$username = $this->ajax_result->value('username');
		$password = $this->ajax_result->value('password');
		$remember = $this->ajax_result->value('remember') == 1;

		if ( $this->logged_user()->is_logged() )
			;//todo logout user

		if ( $this->logged_user()->set_logged( $username, $password ) ) {

			//send user data
			$this->ajax_result->data('id',$this->logged_user->get('id'));
			$this->ajax_result->data('username',$this->logged_user->get('username'));
			$this->ajax_result->data('subsciption_type',$this->logged_user->get('subsciption_type'));
			$this->ajax_result->data('allow_trial',$this->logged_user->allow_trial());

			//user is logged
			$this->ajax_result->success();
		} else {
			$this->ajax_result->error();
		}

	}	

}

?>