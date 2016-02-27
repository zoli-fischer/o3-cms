<?php

/**
 * O3 Admin template's controller
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class o3_cms_admin_template_controller extends o3_template_controller {

	//page title
	protected $page_title = ''; 

	//global o3
	protected $o3 = null;

	//global o3 cms
	protected $o3_cms = null;

	/**
	 * Constructor of template
	 * @param string $template_file File path to template
	 */
	public function __construct() {
		global $o3, $o3_cms;		

		//o3 ref
		$this->o3 = &$o3;

		//o3 cms ref
		$this->o3_cms = &$o3_cms;

		/** string Path to the folder with views */
		$this->view_dir = O3_CMS_ADMIN_DIR.'/templates/views';

		/** string Path to the folder with controllers for views */
		$this->view_controller_dir = $this->view_dir.'/controllers';
	}

	/*
	* On template initializations
	*/
	public function init() {}

	/*
	* On before template initializations
	*/
	public function before_load() {}

	/*
	* On after template initializations
	*/
	public function after_load() {

		//handle ajax calls
		$this->ajax();

	}

	protected $ajax_result = null;

	/**
	* Ajax call handler
	*/
	public function ajax() {		
		if ( isset($_POST['o3_cms_template_ajax']) ) {
			$ajax_name = 'ajax_'.o3_post('o3_cms_template_ajax_name');

			//todo - private, public

			//ajax result
			$this->ajax_result = new o3_ajax_result();

			//set default as fail
			$this->ajax_result->error();

			if ( method_exists( $this, $ajax_name ) ) {
				$this->{$ajax_name}();
			} else {
				//set default as fail
				$this->o3->debug->_( "Method '$ajax_name' not defined in ".get_class($this)."." );
			}

			//flush
			$this->ajax_result->flush();

		}
	}

	/*
	* Get page title 
	*/
	public function page_title() {
		return $this->page_title;
	}

	/*
	* Get template name
	*/
	public function name() {
		return preg_replace('/\.[^.]+$/','',basename($this->template_file));
	}

	/**
	* Require css/less and js.
	*
	* @param string $name Name of the template
	* @return void
	*/
	public function require_js_css() {
		$name = $this->name();

		//add global css
		if ( file_exists(O3_CMS_ADMIN_DIR.'/css/o3_cms_admin_global.less') )
			$this->parent->head_less( O3_CMS_ADMIN_DIR.'/css/o3_cms_admin_global.less' );
		
		//add global js
		if ( file_exists(O3_CMS_ADMIN_DIR.'/js/o3_cms_admin_global.js') )
			$this->parent->body_js( O3_CMS_ADMIN_DIR.'/js/o3_cms_admin_global.js' );
 
		//add js
		if ( file_exists(O3_CMS_ADMIN_DIR.'/js/'.$name.'.js') )
			$this->parent->body_js( O3_CMS_ADMIN_DIR.'/js/'.$name.'.js' );

		//add less
		if ( file_exists(O3_CMS_ADMIN_DIR.'/css/'.$name.'.less') )
			$this->parent->head_less( O3_CMS_ADMIN_DIR.'/css/'.$name.'.less' );

		//add css
		if ( file_exists(O3_CMS_ADMIN_DIR.'/css/'.$name.'.css') )
			$this->parent->head_css( O3_CMS_ADMIN_DIR.'/css/'.$name.'.css' );	
	}

}

?>