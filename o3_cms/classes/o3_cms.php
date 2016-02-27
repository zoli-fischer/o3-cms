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
		
		//current page
		$this->page = new o3_cms_page( o3_with(new o3_cms_pages())->handle_page_url() );

		//creat logged user instance and check session
		o3_with($this->logged_user = new o3_cms_user())->load_from_session();
		
	}

	/*
	* Flush buffer
	*/
	function flush() {
		global $o3;

		//check for admin enviroment
		if ( $this->is_admin_env() ) {

			//load admin language
			$o3->module( array( 'name' => 'lang', 'data' => array( 'current' => o3_cookie('o3-cms-admin-lang') != null ? o3_cookie('o3-cms-admin-lang') : 'en' ) ) );
			$o3->load();

			//set lang js load url
			$o3->lang->set_js_url(O3_CMS_ADMIN_URL.'/o3/lang.js.php');
			 
			//require admin template controller class
			require_once(O3_CMS_ADMIN_DIR.'/classes/o3_cms_admin_template.php');			
			
			//load admin or interface template and flush the buffer
			o3_with(new o3_cms_admin_template())->flush( $this->is_admin_page() ? 'admin' : 'interface' );

		} else {

			//require theme template controller class
			require_once(O3_CMS_DIR.'/classes/o3_cms_template_controller.php');			

			//set template and flush template buffer
			$o3->template->flush( $this->page->template()->name() );

		}

	}

	/*
	* Check if current env. is admin enviroment
	*/
	public function is_admin_env() {
		//if user logged or on the login page, ignore if requested 
		return ( $this->logged_user->is_logged() || $this->is_admin_page() ) && !isset($_GET['o3_cms_ignore_admin']);
	}

	/*
	* Check if current page is admin page
	*/
	public function is_admin_page() {		
		return o3_compare_uri( o3_current_url(), O3_CMS_ADMIN_URL, O3_COMPARE_URI_HOST | O3_COMPARE_URI_PATH );
	}

	/*
	* Get page url
	* If id is omitted than the frontpage url is returned.
	*
	* @param int $id Page id
	* @param int $param Parameters as array
	* @param int $hash Hash tag
	* @return mixed String if page found else false
	*/
	public function page_url( $id = 0, $params = array(), $hash = '' ) {
		return O3_CMS_URL.'/';
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
