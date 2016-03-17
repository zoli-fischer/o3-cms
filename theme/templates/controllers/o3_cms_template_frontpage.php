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
			'gender' => $this->ajax_result->value('gender')
		);

		//check if username available
		if ( o3_with(new snafer_users())->get_by_username( $this->ajax_result->value('username') ) !== false ) {

			$this->ajax_result->data('username',true);

			//send success
			$this->ajax_result->error();
		};

		//check if email available
		if ( o3_with(new snafer_users())->get_by_email( $this->ajax_result->value('email') ) !== false ) {

			$this->ajax_result->data('email',true);

			//send success
			$this->ajax_result->error();
		};

		//insert user
		$id = o3_with(new snafer_users())->insert( $values );

		if ( $id !== false && $id > 0 ) {

			//set user logged
			$this->logged_user()->set_logged( $this->ajax_result->value('username'), $this->ajax_result->value('password') );

			//send user data
			$this->ajax_result->data('id',$this->logged_user->get('id'));
			$this->ajax_result->data('username',$this->logged_user->get('username'));

			//send success
			$this->ajax_result->success();
		};

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

			//user is logged
			$this->ajax_result->success();
		} else {
			$this->ajax_result->error();
		}

	}

}

?>