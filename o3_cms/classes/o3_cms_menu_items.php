<?php

//Require objects class
require_once(O3_CMS_DIR.'/classes/o3_cms_objects.php');

//Require menu item class
require_once(O3_CMS_DIR.'/classes/o3_cms_menu_item.php');

/**
 * O3 CMS Menu groups class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class o3_cms_menu_items extends o3_cms_objects {

	/*
	* Use as a constructor
	*/
	public function init() {}

	/*
	* Table name where are the objects
	*/
	public function tablename_index() {
		return 'menu_items';
	}

	/*
	* Select menu items by menu group id
	*
	* @param menu_group_id Menu group id to select
	* @return mixed Array of menu items or false on error
	*/
	public function select_by_menu_group_id( $menu_group_id ) {
		//if menu_group_id not valid int return false
		if ( $menu_group_id != intval($menu_group_id) )
			return false;

		$return = array();
		$rows = parent::select( ' * ', " group_id = ".intval($menu_group_id)." AND deleted = 0  AND active > 0 " , " priority DESC, title " );
		if ( $rows !== false ) {
			foreach ( $rows as $value )
				o3_with( $return[] = new o3_cms_menu_item() )->load( $value );				

			return $return;
		}
		return false;
	}

}

?>