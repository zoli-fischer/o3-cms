<?php

/**
 * O3 CMS Object class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class o3_cms_object {

	/** array | boolean Data of the object. Null if no object data. */	
	protected $data = null;
	
	/*
	* Constructor
	* @param id object id to select
	*/
	public function __construct( $id = null ) {
		if ( $id !== null )
			$this->load( $id );
	}

	/*
	* Load object with id
	* @param id object id to select
	*/
	public function load( $id ) {
		if ( !$this->is() ) 
			return false;
	}

	/**
	 * Check for valid object data
	 * @return boolean
	*/
	public function is() {		
		return $this->data !== null;
	}

	/**
	 * Return value of column of data 
	 *
	 * @param string $index Intex of colunn	 
	 * @param string $value If index not set value is returned
	 *
	 * @return mixed 
	 */	
	public function get( $index, $value = '' ) {
		return $this->is() && property_exists( $this->data, $index ) ? $this->data->{$index} : $value;
	}

}

?>