<?php

//Require object class
require_once(O3_CMS_DIR.'/classes/o3_cms_object.php'); 

//Require email sending class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_emails.php');

//Require country class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_country.php');

/**
 * O3 Snapfer Reset password class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */


//Request expiration in hours
snapfer_helper::def('SNAPFER_PASSWORD_RESET_REQUEST_HOURS',12);

//Request expiration in seconds
snapfer_helper::def('SNAPFER_PASSWORD_RESET_REQUEST_SEC',SNAPFER_PASSWORD_RESET_REQUEST_HOURS * 3600);

//Request cleaning percent - default: 1
snapfer_helper::def('SNAPFER_PASSWORD_RESET_REQUEST_CLEAN_USE_PERCENT',1);

class snapfer_reset_password extends o3_cms_object {

	/*
	* Get table name
	*/
	function tablename() {
		return $this->o3->mysqli->tablename('snapfer_reset_password_requests');
	}

	/**
	* Load payment request by id
	* @param $id Request id to select
	*/
	public function load( $id ) {				
		$data = $this->o3->mysqli->select_first( $this->tablename(), array( 'id' => $id ) );
		$this->data = $data !== false ? $data : null;
	}

	/**
	* Request reset password for user 
	* @param $user_id
	* @return boolean True if request created 
	*/
	public function request( $user_id ) {
		$created = date('Y-m-d H:i:s', time());
		$id = md5($user_id.$created).$user_id;
		$this->o3->mysqli->insert( $this->tablename(), array( 'id' => $id, 'user_id' => $user_id, 'created' => $created ) );
		$this->load( $id );
		return $this->is();
	}

	/**
	* Release reset password request 
	* @param $id
	* @return void  
	*/
	public function release() {
		$this->o3->mysqli->delete( $this->tablename(), array( 'id' => $this->get('id') ) );

		//delete old requests
		if ( SNAPFER_PASSWORD_RESET_REQUEST_CLEAN_USE_PERCENT > 0 && rand(1,100) <= SNAPFER_PASSWORD_RESET_REQUEST_CLEAN_USE_PERCENT ) {
			$this->o3->debug->_('Clearing old password reset request');
			
			$datetime = date('Y-m-d H:i:s', time() - SNAPFER_PASSWORD_RESET_REQUEST_SEC );
			$sql = 'DELETE FROM '.$this->tablename().' WHERE created < "'.$datetime.'"';
			$this->o3->mysqli->query( $sql );
		}
	}

	/**
	* Request URL 
	*/
	public function url() {
		return o3_get_host().$this->o3_cms->page_url( RESET_USER_PASSWORD_PAGE_ID, array( 'request' => $this->get('id') ) );
	}

	/**
	* Is request expired
	*/
	public function is_expired() {
		$datetime = date('Y-m-d H:i:s', time() - SNAPFER_PASSWORD_RESET_REQUEST_SEC );
		return !$this->is() || ( $this->is() && $this->get('created') < $datetime ); 	
	}

	/**
	*
	*/
	public function send() {
		if ( $this->is() ) {
			$user = new snapfer_user( $this->get('user_id') );
			if ( $user->is() )
				return o3_with(new snapfer_emails())->send( $user->get('email'), 'Reset your password', '<h1>Hello.</h1> <p>You can reset your Snapfer password by clicking the link below: <a href="'.o3_html($this->url()).'" target="_blank">'.o3_html($this->url()).'</a></p> <p>Your username is: '.o3_html($user->get('username')).'</p> <p>If you didn\'t request a password reset, feel free to delete this email.</p>' );
		}
		return false;
	}

}

?>