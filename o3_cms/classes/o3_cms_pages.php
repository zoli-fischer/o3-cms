<?php

//Require objects class
require_once(O3_CMS_DIR.'/classes/o3_cms_objects.php');

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

class o3_cms_pages extends o3_cms_objects {

	/*
	* Use as a constructor
	*/
	public function init() {}

	/*
	* Table name where are the objects
	*/
	public function tablename_index() {
		return 'pages';
	}
	
	/**
	* Get page for current URL
	* 	
	* @return int Page id
	*/
	public function handle_page_url() {		
		$url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
		$url = $url == '' ? '/' : $url;

		//select page id and latest url from history
	 	$sql = "SELECT 
					t2.id, 
					( 
						SELECT 
							t3.url 
						FROM 
							".$this->o3->mysqli->tablename("pages_url")." AS t3
						WHERE
							t3.page_id = t2.id
						ORDER BY
							t3.timestamp DESC
						LIMIT 1 
					) AS url
				FROM 
					".$this->o3->mysqli->tablename("pages_url")." AS t1
				RIGHT JOIN
					".$this->o3->mysqli->tablename("pages")." AS t2
				ON
					t1.page_id = t2.id
				WHERE
					t1.url = '".$this->o3->mysqli->escape_string($url)."'   
				";
		$result = $this->o3->mysqli->query($sql);
		
		//if no url found send error 404
		if ( $result->num_rows != 1 ) {
			return false;
			//o3_header_code( 404 );
			//die();
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