<?php

//Require page class
require_once(O3_CMS_DIR.'/classes/o3_cms_template.php');

/**
 * O3 CMS Page class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class o3_cms_templates {

	/*
	* Constructor
	*/
	function __construct() { }


	/**
	* Select login data by client id and type
	*
	* @param integer $client_id 	
	* @return mixed False if not found, login id if found
	*/		
	public static function get_by_id( $client_id ) {
		global $o3;
		$sql = "SELECT * FROM ".$o3->mysqli->tablename("templates")." WHERE id = ".$o3->mysqli->escape_string($client_id);
		$result = $o3->mysqli->query( $sql );
		if ( $result->num_rows == 1 )
			return $result->fetch_object();
		return false;
	}

	 

}

?>