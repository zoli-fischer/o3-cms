<?php

//Require object class
require_once(O3_CMS_DIR.'/classes/o3_cms_object.php');

//Require transfers class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_transfers.php');

//Require define class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_helper.php');


/**
 * O3 Snafer Transfer class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

//Transfer types
snafer_helper::define('SNAFER_TRANSFER_EMAIL','email',true);
snafer_helper::define('SNAFER_TRANSFER_DOWNLOAD','download',true);
snafer_helper::define('SNAFER_TRANSFER_SOCIAL','social',true);

class snafer_transfer extends o3_cms_object {

	protected $country = false;

	/**
	* Load transfer with id
	* @param id Transfer id to select
	*/
	public function load( $id ) {				
		if ( $id != '' ) {
			$this->data = o3_with(new snafer_transfers())->get_by_id( $id );			

			//load country
			if ( $this->is() ) {
				$this->country = new snafer_country( $this->get('country_id') );

				//if country not found load default country
				if ( !$this->country->is() )
					$this->country = new snafer_country( DEFAULT_COUNTRY );

			}

		}
	}
	
}

?>