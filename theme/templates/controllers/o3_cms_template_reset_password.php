<?php

//Require theme controller class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_template_controller.php');

//Require reset password request class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_reset_password.php');

class o3_cms_template_reset_password extends snafer_template_controller {

	protected $reset_password_request;

	public function init() {

		//parent init
		parent::init( func_get_args() );

		//send logged user to frontpage, but if request code sent log out user
		if ( $this->logged_user()->is() ) {
			if ( isset($_GET['request']) ) {
				$this->logged_user()->set_logged_out();
			} else {
				o3_redirect( $this->o3_cms()->page_url(HOME_PAGE_ID)  );
			}
		}

		//load request from url
		$this->reset_password_request = new snafer_reset_password( $this->o3_cms()->page()->get('id') == RESET_USER_PASSWORD_PAGE_ID ? o3_get('request') : '' );
	}

	public function ajax_reset_password() {

		//no go zone for logged users
		if ( $this->logged_user()->is() ) {
			$this->ajax_result->redirect( $this->o3_cms()->page_url(HOME_PAGE_ID)  );
		} else {
			//check if exists and load request 
			$reset_password_request = new snafer_reset_password( $this->ajax_result->value('id') );
			if ( $reset_password_request->is() ) {

				//check if password reset request expired 
				if ( $reset_password_request->is_expired() ) {
					$this->ajax_result->data('expired','1');
				} else {
					//check if exists and load user 
					$user = new snafer_user( $reset_password_request->get('user_id') );
					if ( $user->is() ) {
						//update user's password
						$user->set_password( $this->ajax_result->value('password'), false );
						
						//remove the reset password request
						$reset_password_request->release();

						$this->ajax_result->success();
					}
				}				
			}
		}

	}

	public function ajax_request_password() {

		//no go zone for logged users
		if ( $this->logged_user()->is() ) {
			$this->ajax_result->redirect( $this->o3_cms()->page_url(HOME_PAGE_ID)  );
		} else {
			$users = new snafer_users();
			$userdata = false;

			if ( ( $userdata = $users->get_by_username( $this->ajax_result->value('username') ) ) !== false ) {
				;
			} else if ( ( $userdata = $users->get_by_email( $this->ajax_result->value('username') ) ) !== false ) {
				;
			}

			if ( $userdata !== false ) {
				$reset_password_request = new snafer_reset_password();
				$reset_password_request->request( $userdata->id );
				
				//send email with password reset link
				$reset_password_request->send();

				//$this->ajax_result->redirect( $reset_password_request->url() );
			}

			$this->ajax_result->success();
		}
	}

}

?>