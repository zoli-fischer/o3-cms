<?php

//Require theme controller class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_template_controller.php');

class o3_cms_template_contact extends snapfer_template_controller {

	public function init() {

		//parent init
		parent::init( func_get_args() );

	}


	/**
	* Handle feedback form
	*/
	public function ajax_send_feedback() {

		$name = $this->ajax_result->value('name');
		$email = $this->ajax_result->value('email');
		$phone = $this->ajax_result->value('phone');
		$message = $this->ajax_result->value('message');		

		if ( strlen(trim($name)) > 0 && o3_valid_email($email) && strlen(trim($message)) > 0 ) {

			//Require email sending class
			require_once(O3_CMS_THEME_DIR.'/classes/snapfer_emails.php');

			//send message to admin
			if ( o3_with(new snapfer_emails())->send( 
					'contact@snapfer.com', 
					'Feedback from '.o3_html($name), 
					'<h1>Feedback from '.o3_html($name).'<h1>					
					<p>Email: '.o3_html($email).'</p>
					<p>Phone: '.o3_html($phone).'</p>
					<p>'.( $this->logged_user->is() ? 'User id: '.$this->logged_user->get('id') : '' ).'</p>
					<p>Message:</p>
					<p><b>'.nl2br(o3_html($message)).'</b></p>
					<p><br></p>' ) )
				$this->ajax_result->success();		
		}
	}

}

?>