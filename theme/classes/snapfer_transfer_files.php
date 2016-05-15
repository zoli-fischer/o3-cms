<?php

//Require objects class
require_once(O3_CMS_DIR.'/classes/o3_cms_objects.php');

//Require transfer file class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_transfer_file.php');

//Require define class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_files.php');

/**
 * Snapfer Transfer files class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class snapfer_transfer_files extends o3_cms_objects {

	/**
	* Use as a constructor
	*/
	public function init() {}

	/**
	* Table name where are the transfers
	*/
	public function tablename_index() {
		return 'snapfer_transfer_files';
	}

	/**
	* Select file data by id
	*
	* @param integer $id 	
	* @return mixed False if not found, login id if found
	*/		
	public function get_by_id( $id ) {
		$sql = "SELECT 
			t1.*, t2.canonical_id
		FROM 
			".$this->o3->mysqli->escape_string($this->tablename())." AS t1
		LEFT JOIN
			".$this->o3->mysqli->escape_string(o3_with(new snapfer_transfers())->tablename_canonical_ids())." AS t2
		ON
			t2.transfer_id = t1.transfer_id
		WHERE 
			t1.id = ".$this->o3->mysqli->escape_string($id);
		$result = $this->o3->mysqli->query( $sql );
		if ( $result->num_rows == 1 )
			return $result->fetch_object();
		return false;
	}

	/**
	* Increase downloads by transfer id
	*/
	public function increase_download( $transfer_id, $file_id = 0 ) {
		$sql = "UPDATE 
			".$this->o3->mysqli->escape_string($this->tablename())." 
		SET 
			downloads = downloads + 1 
		WHERE 
			transfer_id = '".$this->o3->mysqli->escape_string($transfer_id)."' ".( $file_id > 0 ? ' AND id = "'.$this->o3->mysqli->escape_string($file_id).'"' : '' );
		$query = $this->o3->mysqli->query( $sql );
		return $query;
	}

	/**
	* Add file to transfer
	*
	* @return snapfer_transfer_file object
	*/
	public function add( $transfer_id, $filename, $filepath ) {
		$file_id = $this->insert(array(
			'transfer_id' => $transfer_id,
			'name' => $filename,
			'file' => basename($filepath),
			'filesize' => filesize($filepath),
			'type' => snapfer_files::ext2group(o3_extension($filename))
		));
		return new snapfer_transfer_file( $file_id );
	}

	/**
	* Delete by transfer id
	*/
	public function detele_by_transfer_id( $transfer_id ) {
		return $this->delete( array( 'transfer_id' => $transfer_id ) );
	}

}

?>