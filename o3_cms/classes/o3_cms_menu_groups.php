<?php

//Require objects class
require_once(O3_CMS_DIR.'/classes/o3_cms_objects.php');

//Require menu group class
require_once(O3_CMS_DIR.'/classes/o3_cms_menu_group.php');

/**
 * O3 CMS Menu groups class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class o3_cms_menu_groups extends o3_cms_objects {

	/*
	* Use as a constructor
	*/
	public function init() {}

	/*
	* Table name where are the objects
	*/
	public function tablename_index() {
		return 'menu_groups';
	}
	
}

?>