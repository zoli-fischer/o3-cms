<?php

//Require object class
require_once(O3_CMS_DIR.'/classes/o3_cms_object.php');

//Require menu group class
require_once(O3_CMS_DIR.'/classes/o3_cms_menu_groups.php');

//Require menu items class
require_once(O3_CMS_DIR.'/classes/o3_cms_menu_items.php');

/**
 * O3 CMS Menu group class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class o3_cms_menu_group extends o3_cms_object {
	
	/*
	* Load menu group with id
	* @param id Menu group id to select
	*/
	public function load( $id ) {				
		if ( $id > 0 )
			$this->data = o3_with(new o3_cms_menu_groups())->get_by_id( $id );
	}

	/*
	* Get menu items
	*/
	public function items() {
		global $o3;
		return $this->is() ? o3_with( new o3_cms_menu_items() )->select_by_menu_group_id( $this->get('id') ) : false;
	}

}

?>