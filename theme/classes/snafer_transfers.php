<?php

//Require objects class
require_once(O3_CMS_DIR.'/classes/o3_cms_objects.php');

//Require transfer class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_transfer.php');

//Require users class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_users.php');

/**
 * Snafer Transfers class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class snafer_transfers extends o3_cms_objects {

	/**
	* Use as a constructor
	*/
	public function init() {}

	/**
	* Table name where are the transfers
	*/
	public function tablename_index() {
		return 'snafer_transfers';
	}

	/**
	* Table name where are the recipients
	*/
	public function tablename_index_recipients() {
		return 'snafer_transfer_recipients';
	}

	/*
	* Get recipients table name
	*/
	public function tablename_recipients() {
		return $this->o3->mysqli->tablename($this->tablename_index_recipients());
	}

	/**
	* Table name where are the canonical ids
	*/
	public function tablename_index_canonical_ids() {
		return 'snafer_transfer_canonical_ids';
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
		$sql = "SELECT t1.*, t2.canonical_id FROM ".$this->o3->mysqli->escape_string($this->tablename())." AS t1 LEFT JOIN ".$this->o3->mysqli->escape_string($this->tablename_canonical_ids())." AS t2 ON t1.id = t2.transfer_id WHERE t1.id = ".$this->o3->mysqli->escape_string($id);
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
		$sql = "SELECT t1.*, t2.canonical_id FROM ".$this->o3->mysqli->escape_string($this->tablename())." AS t1 LEFT JOIN ".$this->o3->mysqli->escape_string($this->tablename_canonical_ids())." AS t2 ON t1.id = t2.transfer_id WHERE t2.canonical_id = ".$this->o3->mysqli->escape_string($canonical_id);
		$result = $this->o3->mysqli->query( $sql );
		if ( $result->num_rows == 1 )
			return $result->fetch_object();
		return false;
	}

	/**
	* Generate canonical id
	*/
	public static function canonical_id( $user_id, $created, $expire, $type, $way, $email ) {
		return preg_replace( "/[ :=-]+/i", "", base64_encode($type.$way.$email).strrev($expire).strrev($created.$user_id) );
	}

	/**
	* Insert temporary transfer into database 
	* @example o3_with(new snafer_transfers())->create( null, 'free', 'email', '$email', '$message', array( 'mail1@test.dk', 'mail2@test.dk' ) );
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
		$lifetime_sec = $type == SNAFER_PREMIUM ? SNAFER_TRANSFER_LIFETIME_PREMIUM_SECS : ( $type == SNAFER_FREE ? SNAFER_TRANSFER_LIFETIME_FREE_SECS : SNAFER_TRANSFER_LIFETIME_SECS );
		$expire = date('Y-m-d H:i:s', $now + $lifetime_sec );
		$canonical_id = self::canonical_id( $user_id, $created, $expire, $type, $way, $email );
		
		//insert transfer
		if ( ( $transfer_id = $this->insert( array(
			'user_id' => $user_id,
			'type' => $type,
			'way' => $way,
			'email' => $email,
			'message' => $message,
			'expire' => $expire,
			'created' => $created,
			'temp' => 1
		) ) ) === false )
			$mysql_error = true;

		//insert recipients
		if ( count($recipients) == 1 ) {
			foreach ($recipients as $recepient_email )
				if ( $this->o3->mysqli->insert( $this->tablename_recipients(), array(
					'transfer_id' => $transfer_id,
					'email' => $recepient_email
				) ) === false )
					$mysql_error = true;
		} elseif ( count($recipients) > 1 ) {
			if ( $prepare = $this->o3->mysqli->prepare("INSERT INTO ".$this->tablename_recipients()." ( transfer_id, email ) VALUES ( ?, ? )") ) {
				$prepare->bind_param("ss", $transfer_id, $recepient_email);
				foreach ($recipients as $recepient_email )
					$prepare->execute();
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
			if ( ( $transfer = new snafer_transfer( $transfer_id ) ) && $transfer->is() )
				return $transfer;

		}
		
		return false;
	}

	/**
	* Display day/month period
	* @param integer $days
	* @return string
	*/
	public static function display_period( $days ) {
		if ( $days == 1 ) {
			return "1 day";
		} else if ( $days >= SNAFER_YEAR_LENGTH ) {
			$years = $days / SNAFER_YEAR_LENGTH;
			if ( $years == 1 ) {
				return "1 year";
			} else {
				return $years." years";
			}
		} else if ( $days >= SNAFER_MONTH_LENGTH ) {
			$months = $days / SNAFER_MONTH_LENGTH;
			if ( $months == 1 ) {
				return "1 month";
			} else {
				return $months." months";
			}
		} 
		return $days.' days';
	}

}

?>