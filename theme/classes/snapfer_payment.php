<?php

//Require object class
require_once(O3_CMS_DIR.'/classes/o3_cms_object.php');

//Require payments class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_payments.php');

//Require country class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_country.php');

//Require define class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_helper.php');

/**
 * O3 Snapfer Payment class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

//VAT percent
snapfer_helper::def('SNAPFER_PAYMENT_VAT_PERCENT',25);

//Invoicing country 
snapfer_helper::def('SNAPFER_PAYMENT_HOME_COUNTRY','DK');

class snapfer_payment extends o3_cms_object {

	protected $country = false;

	/**
	* Load payment with id
	* @param id Payment id to select
	*/
	public function load( $id ) {				
		if ( $id > 0 ) {
			$this->data = o3_with(new snapfer_payments())->get_by_id( $id );			

			//load country
			if ( $this->is() ) {
				$this->country = new snapfer_country( $this->get('country_id') );

				//if country not found load default country
				if ( !$this->country->is() )
					$this->country = new snapfer_country( DEFAULT_COUNTRY );

			}

		}
	}

	/**
	* Display price with currency and formated value
	*/
	public function display_price( $price ) {
		//return $this->country->monthly_price();
		if ( $this->country->is() ) {
			return str_replace( array('c','f','p'), array( $this->get('currency'), $this->country->format_currency($this->get('currency')), $this->country->format_number( $price ) ), $this->country->is() ? $this->country->get('price_format') : 'fp' );
		} else {
			$this->get('currency').' '.$price;
		}

	}

	/*
	* Format date by country
	*/
	public function display_date() {
		$date = explode( '-', $this->get('created') );
		return date( $this->country->is() ? $this->country->get('date_format') : 'j/n/Y', mktime( 0, 0, 0, $date[1], $date[2], $date[0]) );
	}

	/**
	* Check if payment has vat
	*/
	public function show_vat() {
		return $this->is() && $this->get('show_vat') == 1;
	}

	/**
	* MD5 check
	*/
	public function md5() {
		return md5($this->get('id').$this->get('created').$this->get('total_incl_vat').$this->get('currency'));
	}

	/**
	* Invocie PDF download url
	*
	* @param int $download Download type. 0 - inline, 1 - attachment, 2 - html
	* @return string Download url
	*/
	public function download_url( $download = 0 ) {
		return '/index.php?render-pdf=invoice&id='.$this->md5().$this->get('id').'&download='.$download;
	}
	
}

?>