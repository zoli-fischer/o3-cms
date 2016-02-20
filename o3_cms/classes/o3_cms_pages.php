<?php

//Require page class
require_once(O3_CMS_DIR.'/classes/o3_cms_page.php');

/**
 * O3 CMS Pages class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class o3_cms_pages {

	/*
	* Constructor
	*/
	function __construct() { }

	/**
	* Select login data by client id and type
	*
	* @param integer $client_id 	
	* @return mixed False if not found, login id if found
	*/		
	public static function get_by_id( $client_id ) {
		global $o3;
		$sql = "SELECT * FROM ".$o3->mysqli->tablename("pages")." WHERE id = ".$o3->mysqli->escape_string($client_id);
		$result = $o3->mysqli->query( $sql );
		if ( $result->num_rows == 1 )
			return $result->fetch_object();
		return false;
	}

	/**
	* Get page for current URL
	* 	
	* @return int Page id
	*/
	public static function handle_page_url() {
		global $o3;
		$url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
		$url = $url == '' ? '/' : $url;

		//select page id and latest url from history
	 	$sql = "SELECT 
					t2.id, 
					( 
						SELECT 
							t3.url 
						FROM 
							".$o3->mysqli->tablename("pages_url")." AS t3
						WHERE
							t3.page_id = t2.id
						ORDER BY
							t3.timestamp DESC
						LIMIT 1 
					) AS url
				FROM 
					".$o3->mysqli->tablename("pages_url")." AS t1
				RIGHT JOIN
					".$o3->mysqli->tablename("pages")." AS t2
				ON
					t1.page_id = t2.id
				WHERE
					t1.url = '".$o3->mysqli->escape_string($url)."'   
				";
		$result = $o3->mysqli->query($sql);
		
		//if no url found send error 404
		if ( $result->num_rows != 1 ) {
			o3_header_code( 404 );
			die();
		}

		$row = $result->fetch_object();

		//check if the current url is the newsest in the history, otherwise redirect with permanently moved
		if ( $row->url != $url )
			o3_redirect( O3_CMS_URL.$row->url );

		//return page id
		return $row->id;
	}

}

?>