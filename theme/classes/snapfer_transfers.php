<?php

//Require objects class
require_once(O3_CMS_DIR.'/classes/o3_cms_objects.php');

//Require transfer class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_transfer.php');

//Require transfer files class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_transfer_files.php');

//Require transfer recipients class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_transfer_recipients.php');

//Require users class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_users.php');


/**
 * Snapfer Transfers class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class snapfer_transfers extends o3_cms_objects {

	/**
	* Use as a constructor
	*/
	public function init() {}

	/**
	* Table name where are the transfers
	*/
	public function tablename_index() {
		return 'snapfer_transfers';
	}

	/**
	* Table name where are the canonical ids
	*/
	public function tablename_index_canonical_ids() {
		return 'snapfer_transfer_canonical_ids';
	}

	/*
	* Get recipients table name
	*/
	public function tablename_canonical_ids() {
		return $this->o3->mysqli->tablename($this->tablename_index_canonical_ids());
	}

	/**
	* Select object data by id
	*
	* @param integer $id 	
	* @return mixed False if not found, login id if found
	*/		
	public function get_by_id( $id ) {
		$sql = "SELECT t1.*, t2.canonical_id FROM ".$this->o3->mysqli->escape_string($this->tablename())." AS t1 LEFT JOIN ".$this->o3->mysqli->escape_string($this->tablename_canonical_ids())." AS t2 ON t1.id = t2.transfer_id WHERE t1.id = '".$this->o3->mysqli->escape_string($id)."'";
		$result = $this->o3->mysqli->query( $sql );
		if ( $result->num_rows == 1 )
			return $result->fetch_object();
		return false;
	}

	/**
	* Select object data by canonical id
	*
	* @param integer $canonical_id 	
	* @return mixed False if not found, login id if found
	*/		
	public function get_by_canonical_id( $canonical_id ) {
		$sql = "SELECT t1.*, t2.canonical_id FROM ".$this->o3->mysqli->escape_string($this->tablename())." AS t1 LEFT JOIN ".$this->o3->mysqli->escape_string($this->tablename_canonical_ids())." AS t2 ON t1.id = t2.transfer_id WHERE t2.canonical_id = '".$this->o3->mysqli->escape_string($canonical_id)."'";
		$result = $this->o3->mysqli->query( $sql );
		if ( $result->num_rows == 1 )
			return $result->fetch_object();
		return false;
	}

	/**
	* Generate canonical id
	*/
	public static function canonical_id( $user_id, $created, $expire, $way, $email ) {
		return preg_replace( "/[ :=-]+/i", "", base64_encode($way.$email).strrev($expire).strrev($created.$user_id) );
	}

	/**
	* Insert temporary transfer into database 
	* @example o3_with(new snapfer_transfers())->create( null, 'free', 'email', '$email', '$message', array( 'mail1@test.dk', 'mail2@test.dk' ) );
	*/
	public function create( $user_id, $type, $way, $email, $message, $recipients = array(), $files = array() ) {
		//error flag
		$mysql_error = false;

		//disable autocommit
		$this->o3->mysqli->autocommit(false);

		//start mysqli transaction
		$this->o3->mysqli->begin_transaction();

		//set values
		$now = time();
		$created = date('Y-m-d H:i:s', $now);
		$lifetime_sec = $type == SNAPFER_NONE ? SNAPFER_TRANSFER_LIFETIME_SECS : SNAPFER_TRANSFER_LIFETIME_FREE_SECS;
		$expire = date('Y-m-d H:i:s', $now + $lifetime_sec );
		$canonical_id = self::canonical_id( $user_id, $created, $expire, $way, $email );
		
		//insert transfer
		if ( ( $transfer_id = $this->insert( array(
			'user_id' => $user_id,			
			'way' => $way,
			'email' => $email,
			'message' => $message,
			'expire' => $expire,
			'created' => $created,
			'temp' => 1,
			'ip' => $_SERVER['REMOTE_ADDR']
		) ) ) === false )
			$mysql_error = true;

		if ( count($recipients) > 0 ) {
			$snapfer_transfer_recipients = new snapfer_transfer_recipients();

			//insert recipients
			foreach ($recipients as $recepient_email) {				
				if ( $snapfer_transfer_recipients->insert( array( 'transfer_id' => $transfer_id, 'email' => $recepient_email ) ) === false )
					$mysql_error = true;
			}
		}

		//insert canonical id
		if ( $this->o3->mysqli->insert( $this->tablename_canonical_ids(), array(
				'transfer_id' => $transfer_id,
				'canonical_id' => $canonical_id
			) ) === false )
				$mysql_error = true;

		//rollback on mysql error else commit
		if ( $mysql_error ) {
			$this->o3->mysqli->rollback();
		} else if ( $this->o3->mysqli->commit() ) {
			
			//return transfer if exists
			if ( ( $transfer = new snapfer_transfer( $transfer_id ) ) && $transfer->is() )
				return $transfer;

		}
		
		return false;
	}

	/**
	* Get total files of transfer
	* @param int $transfer_id 
	* @return int Files
	*/
	public function total_files_by_transfer_id( $transfer_id ) {
		$sql = "SELECT
			COUNT(t2.id) AS files
		FROM
			".$this->o3->mysqli->escape_string($this->tablename())." AS t1
		LEFT JOIN
			".$this->o3->mysqli->escape_string(o3_with(new snapfer_transfer_files())->tablename())." AS t2 ON t2.transfer_id = t1.id
		WHERE
			t1.id = '".$this->o3->mysqli->escape_string($transfer_id)."' AND
			t1.temp = 0";
		$query = $this->o3->mysqli->query( $sql );
		return $query->num_rows > 0 ? $query->fetch_object()->files : 0;
	}

	/**
	* Get total files of transfers by user
	* @param int $user_id If 0 then will get all users transfers, if null total transfers from not logged users
	* @return int Files
	*/
	public function total_files_by_user_id( $user_id = 0 ) {
		$sql = "SELECT
			COUNT(t2.id) AS files
		FROM
			".$this->o3->mysqli->escape_string($this->tablename())." AS t1
		LEFT JOIN
			".$this->o3->mysqli->escape_string(o3_with(new snapfer_transfer_files())->tablename())." AS t2 ON t2.transfer_id = t1.id
		WHERE
			".( $user_id === null ? " t1.user_id IS NLL " : " t1.user_id = '".$this->o3->mysqli->escape_string($user_id)."'" )." AND
			t1.temp = 0";
		$query = $this->o3->mysqli->query( $sql );
		return $query->num_rows > 0 ? $query->fetch_object()->files : 0;
	}

	/**
	* Get total downloads of transfer
	* @param int $transfer_id 
	* @return int Downloads
	*/
	public function total_downloads_by_transfer_id( $transfer_id ) {
		$sql = "SELECT
			SUM(t2.downloads) AS downloads
		FROM
			".$this->o3->mysqli->escape_string($this->tablename())." AS t1
		LEFT JOIN
			".$this->o3->mysqli->escape_string(o3_with(new snapfer_transfer_files())->tablename())." AS t2 ON t2.transfer_id = t1.id
		WHERE
			t1.id = '".$this->o3->mysqli->escape_string($transfer_id)."' AND
			t1.temp = 0";
		$query = $this->o3->mysqli->query( $sql );
		return $query->num_rows > 0 ? $query->fetch_object()->downloads : 0;
	}

	/**
	* Get total downloads of transfers by user
	* @param int $user_id If 0 then will get all users transfers, if null total transfers from not logged users
	* @return int Downloads
	*/
	public function total_downloads_by_user_id( $user_id = 0 ) {
		$sql = "SELECT
			SUM(t2.downloads) AS downloads
		FROM
			".$this->o3->mysqli->escape_string($this->tablename())." AS t1
		LEFT JOIN
			".$this->o3->mysqli->escape_string(o3_with(new snapfer_transfer_files())->tablename())." AS t2 ON t2.transfer_id = t1.id
		WHERE
			".( $user_id === null ? " t1.user_id IS NLL " : " t1.user_id = '".$this->o3->mysqli->escape_string($user_id)."'" )." AND
			t1.temp = 0";
		$query = $this->o3->mysqli->query( $sql );
		return $query->num_rows > 0 ? $query->fetch_object()->downloads : 0;
	}

	/**
	* Get total size of transfer
	* @param int $transfer_id 
	* @return int Size in bytes
	*/
	public function total_size_by_transfer_id( $transfer_id ) {
		$sql = "SELECT
			SUM(t2.filesize) AS size
		FROM
			".$this->o3->mysqli->escape_string($this->tablename())." AS t1
		LEFT JOIN
			".$this->o3->mysqli->escape_string(o3_with(new snapfer_transfer_files())->tablename())." AS t2 ON t2.transfer_id = t1.id
		WHERE
			t1.id = '".$this->o3->mysqli->escape_string($transfer_id)."' AND
			t1.temp = 0";
		$query = $this->o3->mysqli->query( $sql );
		return $query->num_rows > 0 ? $query->fetch_object()->size : 0;
	}

	/**
	* Get total size of transfers by user
	* @param int $user_id If 0 then will get all users transfers, if null total transfers from not logged users
	* @return int SIze in bytes
	*/
	public function total_size_by_user_id( $user_id = 0 ) {
		$sql = "SELECT
			SUM(t2.filesize) AS size
		FROM
			".$this->o3->mysqli->escape_string($this->tablename())." AS t1
		LEFT JOIN
			".$this->o3->mysqli->escape_string(o3_with(new snapfer_transfer_files())->tablename())." AS t2 ON t2.transfer_id = t1.id
		WHERE
			".( $user_id === null ? " t1.user_id IS NLL " : " t1.user_id = '".$this->o3->mysqli->escape_string($user_id)."'" )." AND
			t1.temp = 0";
		$query = $this->o3->mysqli->query( $sql );
		return $query->num_rows > 0 ? $query->fetch_object()->size : 0;
	}

	/**
	* Display day/month period
	* @param integer $days
	* @return string
	*/
	public static function display_period( $days ) {
		if ( $days == 1 ) {
			return "1 day";
		} else if ( $days >= SNAPFER_YEAR_LENGTH ) {
			$years = $days / SNAPFER_YEAR_LENGTH;
			if ( $years == 1 ) {
				return "1 year";
			} else {
				return $years." years";
			}
		} else if ( $days >= SNAPFER_MONTH_LENGTH ) {
			$months = $days / SNAPFER_MONTH_LENGTH;
			if ( $months == 1 ) {
				return "1 month";
			} else {
				return $months." months";
			}
		} 
		return $days.' days';
	}

	/**
 	* Remove temp/expired transfers 
 	*/
 	public function unlink_old_transfers() {
 		$sql = 'SELECT
			t1.id
		FROM
			'.$this->o3->mysqli->escape_string($this->tablename()).' AS t1
		LEFT JOIN
			'.$this->o3->mysqli->escape_string(o3_with(new snapfer_users())->tablename()).' AS t2 ON t1.user_id = t2.id
		WHERE
			( t1.temp = 1 AND t1.created < "'.date('Y-m-d H:i:s',time() - SNAPFER_TRANSFER_LIFETIME_TEMP_SECS).'" ) OR 
 			( t1.expire < "'.date('Y-m-d H:i:s').'" AND t2.id IS NULL ) OR 
 			( t1.expire < "'.date('Y-m-d H:i:s').'" AND t2.subsciption_type != "'.$this->o3->mysqli->escape_string(SNAPFER_PREMIUM).'" )
 		ORDER BY
 			created DESC
 		';
		$result = $this->o3->mysqli->query( $sql );
		while ( $row = $result->fetch_object() ) {

			//unlink transfer
			o3_with(new snapfer_transfer( $row->id ))->unlink();
		
		}
 	}

 	/**
	* Delete by transfer id
	*/
	public function detele_by_transfer_id( $transfer_id ) {
		return $this->delete( array( 'id' => $transfer_id ) );
	}

	/**
	* Delete canonical by transfer id
	*/
	public function detele_canonical_by_transfer_id( $transfer_id ) {
		return $this->o3->mysqli->delete( $this->tablename_canonical_ids(), array( 'transfer_id' => $transfer_id ) );
	}

}

?>