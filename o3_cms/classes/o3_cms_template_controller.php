<?php

//Require theme template view controller class
require_once(O3_CMS_DIR.'/classes/o3_cms_template_view_controller.php');

/**
 * O3 Theme template's controller
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class o3_cms_template_controller extends o3_template_controller {

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
		//$this->ajax();

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

	/*
	* Get page object
	*/
	public function page() {
		return $this->o3_cms->page();
	}

	/*
	* Get template object
	*/
	public function template() {
		return $this->o3_cms->page->template();
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
		if ( file_exists(O3_CMS_THEME_DIR.'/css/o3_cms_global.less') )
			$this->parent->head_less( O3_CMS_THEME_DIR.'/css/o3_cms_global.less' );
		
		//add global js
		if ( file_exists(O3_CMS_THEME_DIR.'/js/o3_cms_global.js') )
			$this->parent->body_js( O3_CMS_THEME_DIR.'/js/o3_cms_global.js' );
 
		//add js
		if ( file_exists(O3_CMS_THEME_DIR.'/js/'.$name.'.js') )
			$this->parent->body_js( O3_CMS_THEME_DIR.'/js/'.$name.'.js' );

		//add less
		if ( file_exists(O3_CMS_THEME_DIR.'/css/'.$name.'.less') )
			$this->parent->head_less( O3_CMS_THEME_DIR.'/css/'.$name.'.less' );

		//add css
		if ( file_exists(O3_CMS_THEME_DIR.'/css/'.$name.'.css') )
			$this->parent->head_css( O3_CMS_THEME_DIR.'/css/'.$name.'.css' );
	}

}

?>