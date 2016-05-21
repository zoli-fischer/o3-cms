<?php

/**
 * O3 CMS Objects class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

abstract class o3_cms_objects {

	//global o3
	protected $o3 = null;

	//global o3 cms
	protected $o3_cms = null;
		
	/*
	* Constructor
	*/
	function __construct() {
		global $o3, $o3_cms;

		//o3 ref
		$this->o3 = &$o3;
		
		//o3 cms ref
		$this->o3_cms = &$o3_cms;	

		//call on init
		if ( method_exists( $this, 'init' ) )
			call_user_func_array( array( $this, 'init' ), func_get_args() );
	}	

	/*
	* Use as a constructor
	*/
	abstract public function init();

	/*
	* Get table name withour prefix assigned to the object
	*/
	abstract public function tablename_index();

	/*
	* Get table name assigned to the object
	*/
	public function tablename() {
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
	 * @param array $update_values List of values to update on duplicated
	 * @return mixed False on error, insert id on success
	 */
  	public function insert( $values, $update_values = array() ) {
		if ( $result = $this->o3->mysqli->insert( $this->o3->mysqli->escape_string($this->tablename()), $values, $update_values ) )		 
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

	/**
	 * Delete row
	 *
	 * @param array $condition List of conditions
	 *
	 * @return boolean
	 */
  	public function delete( $conditions ) {
		return $this->o3->mysqli->delete( $this->o3->mysqli->escape_string($this->tablename()), $conditions );
	}

}

?>