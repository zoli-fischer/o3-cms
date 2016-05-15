<?php

/**
 * O3 Snapfer Helper functions class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class snapfer_helper {
	
	/**
	* Define a named constant
	*/
	public static function define( $index, $value, $add2js = false ) {
		global $o3;
		define( $index, $value );
		if ( $add2js ) {
			switch ( gettype($value) ) {
			 	case 'boolean':
			 		$o3->head_inline("var ".o3_html($index)." = ".( $value ? true : false ).";","javascript");
			 		break;
			 	case "integer":
			 	case "double":
			 		$o3->head_inline("var ".o3_html($index)." = ".$value.";","javascript");
			 		break;
			 	case "string":
			 		$o3->head_inline("var ".o3_html($index)." = '".o3_html($value)."';","javascript");
			 		break;
			 	case "NULL":
			 		$o3->head_inline("var ".o3_html($index)." = null;","javascript");
			 		break;
			 	default:			 		
			 		$o3->head_inline("var ".o3_html($index)." = ".json_encode($value).";","javascript");
			 		break;
			 }
		}
	}

	/**
	* Define a named constant if not defined
	*/
	public static function def( $index, $value, $add2js = false ) {
		if ( !defined($index) )
			self::define( $index, $value, $add2js );
	}

	/**
	* Format mysql date in default format
	*/
	public static function format_date( $date ) {		
		return date( 'j F, Y', o3_mysqli::date2time($date) );
	}

}

?>