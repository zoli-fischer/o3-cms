<?php

//Require objects class
require_once(O3_CMS_DIR.'/classes/o3_cms_objects.php');

//Require payments class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_transfer.php');

/**
 * Snafer Transfers class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class snafer_transfers extends o3_cms_objects {

	/**
	* Use as a constructor
	*/
	public function init() {}

	/**
	* Table name where are the objects
	*/
	public function tablename_index() {
		return 'snafer_transfers';
	}


	/**
	*
	*/
}

?>