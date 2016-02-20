<?php

//Require object class
require_once(O3_CMS_DIR.'/classes/o3_cms_object.php');

/**
 * O3 CMS User class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class o3_cms_user extends o3_cms_object {

	/*
	* Check if user is logged
	* @return boolean
	*/
	public function is_logged() {
		return true;
	}

}

?>