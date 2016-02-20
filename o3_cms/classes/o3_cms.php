<?php

//Require page class
require_once(O3_CMS_DIR.'/classes/o3_cms_page.php');

//Require user class
require_once(O3_CMS_DIR.'/classes/o3_cms_user.php');

/**
 * O3 CMS Main class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class o3_cms {

	private $page;
	private $logged_user;

	/*
	* Constructor
	*/
	function __construct() {

		//logged user
		$this->logged_user = new o3_cms_user();

		//current page
		$this->page = new o3_cms_page( o3_cms_pages::handle_page_url() );

		//show admin part for logged user
		if ( $this->logged_user->is_logged() ) {
			 
			//Require user class
			require_once(O3_CMS_ADMIN_DIR.'/classes/o3_cms_admin_template.php');			
			
			//load index admin template and flush the buffer
			o3_with(new o3_cms_admin_template())->flush('index');
			
		} else {

		}

	}

}

?>
