<?php

//Require object class
require_once(O3_CMS_DIR.'/classes/o3_cms_object.php');

//Require transfer recipients class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_transfer_recipients.php');

/**
 * O3 Snapfer Transfer Recipient class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class snapfer_transfer_recipient extends o3_cms_object {

	/**
	* Load transfer with id
	* @param id Transfer id to select
	*/
	public function load( $id ) {				
		if ( $id != '' ) {
			$this->data = o3_with(new snapfer_transfer_recipients())->get_by_id( $id );
		}
	}

	/**
	 * Update transfer recipient
	 *
	 * @param array $values List of values
	 * @param array $condition List of conditions
	 *
	 * @return boolean
	 */
	public function update( $values, $conditions = null ) {
		if ( $this->is() ) {
			$conditions = $conditions === null ? array() : $conditions;
			$conditions['id'] = $this->get('id');

			//update
			if ( o3_with(new snapfer_transfer_recipients())->update( $values, $conditions ) !== false ) {				

				//reload user data
				$this->reload();

				return true;
			}	
		}
		return false;
	}
	
}

?>