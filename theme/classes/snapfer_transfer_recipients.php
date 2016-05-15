<?php

//Require objects class
require_once(O3_CMS_DIR.'/classes/o3_cms_objects.php');

//Require transfer recipient class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_transfer_recipient.php');

/**
 * Snapfer Transfer recipients class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class snapfer_transfer_recipients extends o3_cms_objects {

	/**
	* Use as a constructor
	*/
	public function init() {}

	/**
	* Table name where are the transfers
	*/
	public function tablename_index() {
		return 'snapfer_transfer_recipients';
	}

	/**
	* Delete by transfer id
	*/
	public function detele_by_transfer_id( $transfer_id ) {
		return $this->delete( array( 'transfer_id' => $transfer_id ) );
	}

}

?>