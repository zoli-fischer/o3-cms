<?php

//Require object class
require_once(O3_CMS_DIR.'/classes/o3_cms_object.php');

//Require menu items class
require_once(O3_CMS_DIR.'/classes/o3_cms_menu_items.php');

/**
 * O3 CMS Menu item class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class o3_cms_menu_item extends o3_cms_object {

	/** array | boolean Attributes of the menu item. Null if no attributes. */	
	protected $attr = null;

	/*
	* Load menu group with id
	* @param midex Menu item id to select or menu item row data
	*/
	public function load( $object ) {				
		if ( gettype($object) == "object" ) {
			$this->data = $object;
		} else if ( $object > 0 ) {
			$this->data = o3_with(new o3_cms_menu_items())->get_by_id( $object );
		}

		if ( $this->data !== null )
			$this->attr = json_decode($this->get('attr_json'));
	}

	/**
	 * Return attributes array
	 * @return mixed 
	 */	
	public function attr() {
		return $this->is() && $this->attr !== null ? $this->attr : array();
	}

	/**
	 * Return value of column of attribute 
	 *
	 * @param string $index Intex of colunn	 
	 * @param string $value If index not set value is returned
	 *
	 * @return mixed 
	 */	
	public function get_attr( $index, $value = '' ) {
		return $this->is() && property_exists( $this->attr, $index ) ? $this->attr->{$index} : $value;
	}

	/*
	* Check if the item is active. The items href is pointing to the current url
	*/
	public function active( $flag = null ) {
		//todo fix url check if relative and make to absolute
		return o3_compare_uri( o3_current_url(), O3_CMS_URL.$this->get('href'), $flag === null ? O3_COMPARE_URI_HOST | O3_COMPARE_URI_PATH : $flag );
	}

}

?>