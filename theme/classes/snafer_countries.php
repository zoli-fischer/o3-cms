<?php

//Require objects class
require_once(O3_CMS_DIR.'/classes/o3_cms_objects.php');

//Require country class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_country.php');

/**
 * Snafer Countries class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class snafer_countries extends o3_cms_objects {

	/*
	* Use as a constructor
	*/
	public function init() {}

	/*
	* Table name where are the objects
	*/
	public function tablename_index() {
		return 'snafer_countries';
	}
	
	/**
	* Select user data by username
	*
	* @param string $ip address 	
	* @return mixed False if not found, login id if found
	*/		
	public function get_by_ip( $ip ) { 
		$iplong = strpos($ip, '.') !== false ? self::ip2long($ip) : $ip;
		$sql = "SELECT 
					t1.*
				FROM 
					".$this->o3->mysqli->escape_string($this->o3->mysqli->tablename('snafer_ips'))." AS t2
				LEFT JOIN
					".$this->o3->mysqli->escape_string($this->tablename())." AS t1 
				ON
					 t2.country_id = t1.id
				WHERE 
					t2.ip_from <= ".$this->o3->mysqli->escape_string($iplong)." AND
					t2.ip_to  >= ".$this->o3->mysqli->escape_string($iplong)."
				LIMIT 1";
		$result = $this->o3->mysqli->query( $sql );
		if ( $result->num_rows == 1 )
			return $result->fetch_object();
		return false;
	} 

	/*
	* Convert ip to long
	*/
	public static function ip2long($a){
		$d = 0.0;
		$b = explode(".", $a,4);
		for ($i = 0; $i < 4; $i++) {
			$d *= 256.0;
			$d += $b[$i];
		};
		return $d;
	}

}

?>