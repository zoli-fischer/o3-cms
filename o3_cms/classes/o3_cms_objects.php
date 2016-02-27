<?php


/**
 * O3 CMS Objects interface
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

interface o3_cms_objects_interface  {
		
	/*
	* Use as a constructor
	*/
	public function init();

	/*
	* Use as a constructor
	*/
	public function tablename_index();

}


/**
 * O3 CMS Objects class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

abstract class o3_cms_objects implements o3_cms_objects_interface {

	//global o3
	protected $o3 = null;
		
	/*
	* Constructor
	*/
	function __construct() {
		global $o3;

		//o3 ref
		$this->o3 = &$o3;

		//call on init
		if ( method_exists( $this, 'init' ) )
			call_user_func_array( array( $this, 'init' ), func_get_args() );
	}	

	/*
	* Get table name
	*/
	function tablename() {
		return $this->o3->mysqli->tablename($this->tablename_index());
	}

	/**
	* Select object data by id
	*
	* @param integer $id 	
	* @return mixed False if not found, login id if found
	*/		
	public function get_by_id( $id ) {
		$sql = "SELECT * FROM ".$this->o3->mysqli->escape_string($this->tablename())." WHERE id = ".$this->o3->mysqli->escape_string($id);
		$result = $this->o3->mysqli->query( $sql );
		if ( $result->num_rows == 1 )
			return $result->fetch_object();
		return false;
	}

}

?>