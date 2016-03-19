<?php

//Require objects class
require_once(O3_CMS_DIR.'/classes/o3_cms_objects.php');

//Require user class
require_once(O3_CMS_DIR.'/classes/o3_cms_user.php');

//Require country class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_country.php');

/**
 * Snafer Users class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class snafer_users extends o3_cms_objects {

	/*
	* Use as a constructor
	*/
	public function init() {}

	/*
	* Table name where are the objects
	*/
	public function tablename_index() {
		return 'snafer_users';
	}
	
	/**
	* Select user data by username
	*
	* @param string $username 	
	* @return mixed False if not found, login id if found
	*/		
	public function get_by_username( $username ) { 
		$sql = "SELECT * FROM ".$this->o3->mysqli->escape_string($this->tablename())." WHERE username = '".$this->o3->mysqli->escape_string($username)."'";
		$result = $this->o3->mysqli->query( $sql );
		if ( $result->num_rows == 1 )
			return $result->fetch_object();
		return false;
	}

	/**
	* Select user data by email
	*
	* @param string $email 	
	* @return mixed False if not found, login id if found
	*/		
	public function get_by_email( $email ) { 
		$sql = "SELECT * FROM ".$this->o3->mysqli->escape_string($this->tablename())." WHERE email = '".$this->o3->mysqli->escape_string($email)."'";
		$result = $this->o3->mysqli->query( $sql );
		if ( $result->num_rows == 1 )
			return $result->fetch_object();
		return false;
	}

}

?>