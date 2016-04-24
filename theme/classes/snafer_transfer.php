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

//System month length in days
snafer_helper::define('SNAFER_MONTH_LENGTH',30);

//System year length in days
snafer_helper::define('SNAFER_YEAR_LENGTH', SNAFER_MONTH_LENGTH * 12 );

//Transfer expires days
snafer_helper::def('SNAFER_TRANSFER_LIFETIME_DAYS', 7, true);
snafer_helper::def('SNAFER_TRANSFER_LIFETIME_FREE_DAYS', 14, true);
snafer_helper::def('SNAFER_TRANSFER_LIFETIME_PREMIUM_DAYS', SNAFER_MONTH_LENGTH * 6, true);

//Transfer expires sec
snafer_helper::define('SNAFER_TRANSFER_LIFETIME_SECS', SNAFER_TRANSFER_LIFETIME_DAYS * 3600 * 24, true);
snafer_helper::define('SNAFER_TRANSFER_LIFETIME_FREE_SECS', SNAFER_TRANSFER_LIFETIME_FREE_DAYS * 3600 * 24, true);
snafer_helper::define('SNAFER_TRANSFER_LIFETIME_PREMIUM_SECS', SNAFER_TRANSFER_LIFETIME_PREMIUM_DAYS * 3600 * 24, true);

//Transfer history days
snafer_helper::def('SNAFER_TRANSFER_KEEP_DAYS', 7, true);
snafer_helper::def('SNAFER_TRANSFER_KEEP_FREE_DAYS', SNAFER_MONTH_LENGTH * 2, true);
snafer_helper::def('SNAFER_TRANSFER_KEEP_PREMIUM_DAYS', SNAFER_YEAR_LENGTH * 1, true);

//Transfer history sec
snafer_helper::define('SNAFER_TRANSFER_KEEP_SECS', SNAFER_TRANSFER_KEEP_DAYS * 3600 * 24, true);
snafer_helper::define('SNAFER_TRANSFER_KEEP_FREE_SECS', SNAFER_TRANSFER_KEEP_FREE_DAYS * 3600 * 24, true);
snafer_helper::define('SNAFER_TRANSFER_KEEP_PREMIUM_SECS', SNAFER_TRANSFER_KEEP_PREMIUM_DAYS * 3600 * 24, true);

//Transfer size GB
snafer_helper::def('SNAFER_TRANSFER_MAXSIZE_GB','2GB',true);
snafer_helper::def('SNAFER_TRANSFER_FREE_MAXSIZE_GB','4GB',true);
snafer_helper::def('SNAFER_TRANSFER_PREMIUM_MAXSIZE_GB','20GB',true);

//Transfer size bytes
snafer_helper::define('SNAFER_TRANSFER_MAXSIZE', str_ireplace( 'gb', '', SNAFER_TRANSFER_MAXSIZE_GB) * 1024 * 1024 * 1024, true);
snafer_helper::define('SNAFER_TRANSFER_FREE_MAXSIZE', str_ireplace( 'gb', '', SNAFER_TRANSFER_FREE_MAXSIZE_GB) * 1024 * 1024 * 1024,true);
snafer_helper::define('SNAFER_TRANSFER_PREMIUM_MAXSIZE', str_ireplace( 'gb', '', SNAFER_TRANSFER_PREMIUM_MAXSIZE_GB) * 1024 * 1024 * 1024,true);

class snafer_transfer extends o3_cms_object {

	/**
	* Load transfer with id
	* @param id Transfer id to select
	*/
	public function load( $id ) {				
		if ( $id != '' ) {
			$this->data = o3_with(new snafer_transfers())->get_by_id( $id );
		}
	}

	/**
	* Load transfer with canonical id
	* @param id Transfer canonical id to select
	*/
	public function load_canonical( $canonical_id ) {				
		if ( $id != '' ) {
			$this->data = o3_with(new snafer_transfers())->get_by_canonical_id( $canonical_id );
		}
	}

	/**
	* Get transfer url
	*/
	public function url() {
		if ( $this->is() )
			return o3_get_host().'/transfer?id='.$this->get('canonical_id');
		return false;
	}
	
}

?>