<?php

//Require objects class
require_once(O3_CMS_DIR.'/classes/o3_cms_objects.php');

//Require payment class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_payment.php');

//Require country class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_country.php');

/**
 * Snapfer Payments class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class snapfer_payments extends o3_cms_objects {

	/*
	* Use as a constructor
	*/
	public function init() {}

	/*
	* Table name where are the objects
	*/
	public function tablename_index() {
		return 'snapfer_payments';
	}

	/**
	* Get amount wihout vat from an amount
	*/
	static function get_excl_vat_value( $amount, $percent ) {
		return $amount / ( 1 + $percent / 100 );   
	}
	
}

?>