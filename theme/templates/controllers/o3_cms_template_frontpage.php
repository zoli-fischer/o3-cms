<?php

//Require theme controller class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_template_controller.php');

//Require transfers class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_transfers.php');

class o3_cms_template_frontpage extends snapfer_template_controller {

	public function init() {

		//parent init
		parent::init( func_get_args() );
		
		//check for logout
		if ( isset($_GET['snapfer-sign-out']) ) {

			//log out user
			$this->logged_user()->set_logged_out();
			
			//reload admin page
			o3_redirect("/");
		}
 
	}

	/**
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
		if ( o3_with(new snapfer_users())->get_by_username( $this->ajax_result->value('username') ) !== false ) {

			$this->ajax_result->data('username',true);

			//send error
			$this->ajax_result->error();
		};

		//check if email available
		if ( o3_with(new snapfer_users())->get_by_email( $this->ajax_result->value('email') ) !== false ) {

			$this->ajax_result->data('email',true);

			//send error
			$this->ajax_result->error();
		};

		//insert user
		$id = o3_with(new snapfer_users())->insert( $values );

		if ( $id !== false && $id > 0 ) {

			//set user logged
			$this->logged_user()->set_logged( $this->ajax_result->value('username'), $this->ajax_result->value('password') );			

			//if premium sign up, set premium/trial period, else send welcome free
			if ( $this->ajax_result->value('sign_up_type') == SNAPFER_PREMIUM ) {
				$this->logged_user()->set_premium_subscription();
			} else {
				$this->logged_user()->send_free_subscription_notification();
			}

			//send user data
			$this->ajax_result->data('id',$this->logged_user->get('id'));
			$this->ajax_result->data('username',$this->logged_user->get('username'));
			$this->ajax_result->data('subsciption_type',$this->logged_user->get('subsciption_type'));
			$this->ajax_result->data('allow_trial',$this->logged_user->allow_trial());
			$this->ajax_result->data('storage_free',$this->logged_user->storage_free());

			//redirect user to add payment
			if ( $this->logged_user->get('subsciption_type') == SNAPFER_PREMIUM )
				$this->ajax_result->redirect( $this->o3_cms()->page_url(UPDATE_PAYMENT_METHOD_PAGE_ID) );	

			//send success
			$this->ajax_result->success();
		};

	}

	/**
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

	/**
	* Ajax call handler for sign out
	*/
	public function ajax_sign_out() {
		
		//log out user
		$this->logged_user()->set_logged_out();

		//user is logged out
		$this->ajax_result->success();
	}

	/**
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
			$this->ajax_result->data('storage_free',$this->logged_user->storage_free());

			//user is logged
			$this->ajax_result->success();
		} else {
			$this->ajax_result->error();
		}

	}	

	/**
	* Ajax call handler for create transfer
	*/
	public function ajax_create_transfer() {
		$user_id = null;
		$type = SNAPFER_NONE;
		$way = $this->ajax_result->value('way');
		$email = $this->ajax_result->value('email');
		$message = $this->ajax_result->value('message');
		$recipients = $this->ajax_result->value('recipients');
		$size = $this->ajax_result->value('size');
		$files = array();
		
		if ( $this->logged_user()->is() ) {
			$user_id = $this->logged_user()->get('id');
			$type = $this->logged_user()->get('subsciption_type');
			$email = $this->logged_user()->get('email');
		}

		if ( $this->logged_user()->is() && $this->logged_user()->is_premium() && $size > $this->logged_user()->storage_free() ) {
			
			//return storage_free
			$this->ajax_result->data('storage_free', $this->logged_user()->storage_free() );

			//return error
			$this->ajax_result->error();

		} else {

			//create transfer
			$transfer = o3_with(new snapfer_transfers())->create( $user_id, $type, $way, $email, $message, $recipients, $files );
			if ( $transfer !== false && $transfer->is() ) {
				//return url
				$this->ajax_result->data('url', $transfer->url() );

				//return caninical id
				$this->ajax_result->data('id', $transfer->get('canonical_id') );

				//return success
				$this->ajax_result->success();
			}
		
		}	
	}

	/**
	* Ajax call handler for create transfer
	*/
	public function ajax_finalize_transfer() {
		//create transfer instance and load from canonical id 
		$transfer = new snapfer_transfer();
		$transfer->load_canonical( $this->ajax_result->value('id') );

		//check if transfer exists and owner is the same as logged user, if no logged user should be no owner of transfer
		if ( $transfer->is() && $transfer->is_temp() && intval($transfer->get('user_id')) == intval($this->logged_user()->get('id')) ) {
			
			//finalize transfer and return success
			if ( $transfer->finalize() ) {

				//update user storage
				$this->ajax_result->data('storage_free',$this->logged_user->storage_free());

				//return success
				$this->ajax_result->success();
			}
			
		}
	}

	/**
	* Add file to transfer
	*/
	public function ajax_upload_file() { 

		//create transfer and load from canonical id 
		$transfer = new snapfer_transfer();
		$transfer->load_canonical( $this->ajax_result->value('id') );

		//handle file if transfer exists and file uploaded
		if ( $transfer->is() && $_FILES['file']['error'] == 0 ) {
			$name = $_FILES['file']['name'];
			$tmp_name = $_FILES['file']['tmp_name'];
			$size = $_FILES['file']['size'];

			//add file to transfer
			if ( $transfer->add_file( $name, $tmp_name, $size ) ) {
				
				//file uploaded
				$this->ajax_result->success();
				
			}

		}

		
	}

}

?>