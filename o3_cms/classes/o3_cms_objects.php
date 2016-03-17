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


	/**
	* Retrun array of row selected from table
	*
	* @param string $field_list Default value: *
	* @param string $where (optional) Default value: '' 
	* @param string $order_by (optional) Default value: ''
	* @param string $limit (optional) Default value: ''
	*
	* @return mixed Array of rows
	*/
	public function select( $field_list = '*', $where = '', $order_by = '', $limit = '' ) {
		$return = '';
		$sql = "SELECT $field_list FROM ".$this->o3->mysqli->escape_string($this->tablename());
		if ( $where != '' )
			$sql .= " WHERE $where ";
		if ( $order_by != '' )
			$sql .= " ORDER BY $order_by ";		
		if ( $limit != '' )
			$sql .= " LIMIT $limit ";
				
		$result = $this->o3->mysqli->query( $sql );
		if ( $result->num_rows > 0 ) {
			while ( $row = $result->fetch_object() ) {
				$return[] = $row;
			}
		}
		return $return;
	}


	/**
	 * Insert row
	 *	 
	 * @param mixed $values Value to set
	 * @return mixed False on error, insert id on success
	 */
  	public function insert( $values ) {
		if ( $result = $this->o3->mysqli->insert( $this->o3->mysqli->escape_string($this->tablename()), $values ) )		 
			$row_id = $this->o3->mysqli->insert_id;

		return isset($row_id) && $row_id > 0 ? $row_id : false;		
	}

	/**
	 * Update row
	 *
	 * @param array $values List of values
	 * @param array $condition List of conditions
	 *
	 * @return boolean
	 */
  	public function update( $values, $conditions ) {
		return $this->o3->mysqli->update( $this->o3->mysqli->escape_string($this->tablename()), $values, $conditions );
	}

}

?>