<?php

//Require object class
require_once(O3_CMS_DIR.'/classes/o3_cms_object.php');

//Require users class
require_once(O3_CMS_DIR.'/classes/o3_cms_users.php');

/**
 * O3 CMS User class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

define('O3_CMS_LOGGED_USER_SESSION_INDEX_NAME','logged_user_name');
define('O3_CMS_LOGGED_USER_SESSION_INDEX_PASSWORD','logged_user_password');
define('O3_CMS_LOGGED_USER_SESSION_INDEX_ID','logged_user_id');

class o3_cms_user extends o3_cms_object {

	/*
	* Load user with id
	* @param id User id to select
	*/
	public function load( $id ) {				
		if ( $id > 0 )
			$this->data = o3_with(new o3_cms_users())->get_by_id( $id );			
	}

	/*
	* Log in user from session
	*/
	public function load_from_session() {
		if ( isset($_SESSION[O3_CMS_LOGGED_USER_SESSION_INDEX_NAME]) && isset($_SESSION[O3_CMS_LOGGED_USER_SESSION_INDEX_PASSWORD]) && isset($_SESSION[O3_CMS_LOGGED_USER_SESSION_INDEX_ID]) ) {
			$data = o3_with(new o3_cms_users())->get_by_username( $_SESSION[O3_CMS_LOGGED_USER_SESSION_INDEX_NAME] );
			if ( $data !== false && $data->id == $_SESSION[O3_CMS_LOGGED_USER_SESSION_INDEX_ID] && $data->password == $_SESSION[O3_CMS_LOGGED_USER_SESSION_INDEX_PASSWORD]  ) {
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
			   isset($_SESSION[O3_CMS_LOGGED_USER_SESSION_INDEX_NAME]) && $_SESSION[O3_CMS_LOGGED_USER_SESSION_INDEX_NAME] == $this->get('username') &&
			   isset($_SESSION[O3_CMS_LOGGED_USER_SESSION_INDEX_PASSWORD]) && $_SESSION[O3_CMS_LOGGED_USER_SESSION_INDEX_PASSWORD] == $this->get('password') &&
			   isset($_SESSION[O3_CMS_LOGGED_USER_SESSION_INDEX_ID]) && $_SESSION[O3_CMS_LOGGED_USER_SESSION_INDEX_ID] == $this->get('id');
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
			$data = o3_with(new o3_cms_users())->get_by_username( $username );
			if ( $data !== false && $data->deleted == 0 && $data->password == $password ) {
				$this->data = $data;
				$this->reload();
				$_SESSION[O3_CMS_LOGGED_USER_SESSION_INDEX_NAME] = $this->get('username');
				$_SESSION[O3_CMS_LOGGED_USER_SESSION_INDEX_PASSWORD] = $this->get('password');
				$_SESSION[O3_CMS_LOGGED_USER_SESSION_INDEX_ID] = $this->get('id');
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
		$_SESSION[O3_CMS_LOGGED_USER_SESSION_INDEX_NAME] = '';
		$_SESSION[O3_CMS_LOGGED_USER_SESSION_INDEX_PASSWORD] = '';
		$_SESSION[O3_CMS_LOGGED_USER_SESSION_INDEX_ID] = 0;
	}

}

?>