<?php

//Require object class
require_once(O3_CMS_DIR.'/classes/o3_cms_object.php');

//Require countries class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_countries.php');

//Require define class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_helper.php');

/**
 * O3 Snafer Country class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

//Default country id
snafer_helper::def('DEFAULT_COUNTRY',46);

class snafer_country extends o3_cms_object {

	/*
	* Load country with id
	* @param id Country id to select
	*/
	public function load( $id ) {				
		if ( $id > 0 )
			$this->data = o3_with(new snafer_countries())->get_by_id( $id );			
	}

	/*
	* Load country with ip
	*/
	public function load_by_ip( $ip ) {				
		$this->data = o3_with(new snafer_countries())->get_by_ip( $ip );			
	}

	/*
	* Check if country member of EU
	*/
	public function is_eu() {
		return $this->get('is_eu') == 1;
	}

	/*
	* Check if country has vat number
	*/
	public function has_vat() {
		return $this->is_eu();
	}

	/*
	* Format date by the users country
	*/
	public function format_date( $date ) {
		$date = explode( '-', $date );
		return date( $this->is() ? $this->get('date_format') : 'j/n/Y', mktime( 0, 0, 0, intval($date[1]), intval($date[2]), intval($date[0]) ) );
	}

	/*
	* Format number by the users country
	*/
	public function format_number( $nubmer ) {
		return number_format( $nubmer, $this->is() ? $this->get('number_dec_count') : 2, $this->is() ? $this->get('number_dec_sep') : ',', $this->is() ? $this->get('number_thousand_sep') : '.' );
	}

	/*
	* Format currency
	*/
	public function format_currency( $currency ) {
		switch ( $currency ) {
			case 'DKK':
				return 'kr.';			
			case 'EUR':
				return '€';
			case 'GBP':
				return '£';
			case 'HUF':
				return 'forint';
			case 'USD':
				return '$';
		}
		return $currency;
	}

	/*
	* Format price
	* c - currency index (USD,EURO), f - formated currency ($,kr.), p - price 
	*/
	public function format_price( $price ) {
		return str_replace( array('c','f','p'), array( $this->get('currency'), $this->format_currency($this->get('currency')), $this->format_number( $price ) ), $this->is() ? $this->get('price_format') : 'fp' );
	}

	/*
	* Display monthly price with currency and formated value
	*/
	public function monthly_price() {
		return $this->is() ? $this->format_price( $this->get('monthly_price') ) : false;
	}

	/*
	* Get current timestamp in current country
	*/
	public function now() {
		$timestamp = time();
		return $timestamp;
	}

}

?>