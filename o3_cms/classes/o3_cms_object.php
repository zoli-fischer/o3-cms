<?php

/**
 * O3 CMS Objects interface
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

interface o3_cms_object_interface  {
		
	/*
	* Load object with id
	* @param id object id to select
	*/
	public function load( $id );
 

}

/**
 * O3 CMS Object class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

abstract class o3_cms_object implements o3_cms_object_interface {

	/** array | boolean Data of the object. Null if no object data. */	
	protected $data = null;

	//global o3
	protected $o3 = null;

	//global o3 cms
	protected $o3_cms = null;
	
	/*
	* Constructor
	* @param id object id to select
	*/
	public function __construct( $id = null ) {
		global $o3, $o3_cms;

		//o3 ref
		$this->o3 = &$o3;

		//o3 cms ref
		$this->o3_cms = &$o3_cms;	

		if ( $id !== null )
			$this->load( $id );
	}

	/*
	* Re-load object with the current id
	*/
	public function reload() {
		$this->load( $this->get('id') );
	}
	
	/**
	 * Check for valid object data
	 * @return boolean
	*/
	public function is() {		
		return $this->data !== null && $this->data !== false;
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

	/*
	* Check if object is deleted
	*/
	public function is_deleted() {
		return !( $this->is() && $this->get('deleted') == 0 );
	}

}

?>