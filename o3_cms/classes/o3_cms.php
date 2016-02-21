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

	protected $page;
	protected $logged_user;

	/*
	* Constructor
	*/
	function __construct() {
		
		//logged user
		$this->logged_user = new o3_cms_user();

		//current page
		$this->page = new o3_cms_page( o3_cms_pages::handle_page_url() );

	}

	/*
	* Flush buffer
	*/
	function flush() {
		global $o3;

		//show admin part if needed
		if ( $this->is_admin() ) {
			 
			//Require user class
			require_once(O3_CMS_ADMIN_DIR.'/classes/o3_cms_admin_template.php');			
			
			//load index admin template and flush the buffer
			o3_with(new o3_cms_admin_template())->flush('index');

		} else {

			//set template and flush template buffer
			$o3->template->flush( $this->page->template()->name() );

		}

	}

	/*
	* Check if admin enviroment loaded
	*/
	public function is_admin() {
		return $this->logged_user->is_logged() && !isset($_GET['o3_cms_ignore_admin']);
	}

	/*
	* Return page 
	* @void object
	*/
	public function page() {
		return $this->page;
	}

	/*
	* Return logged_user 
	* @void object
	*/
	public function logged_user() {
		return $this->logged_user;
	}

}

?>
