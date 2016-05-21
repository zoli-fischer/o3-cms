<?php

/**
 * O3 Theme template view's controller
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class o3_cms_template_view_controller extends o3_template_view_controller {

	//global o3
	protected $o3 = null;

	//global o3 cms
	protected $o3_cms = null;

	/**
	 * Constructor of template
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
	* Return o3 object
	*/
	public function o3() { 	return $this->o3; }

	/*
	* Return o3 cms object
	*/
	public function o3_cms() { 	return $this->o3_cms; }
	
	/*
	* Get template name
	*/
	public function name() {
		return ltrim( preg_replace('/\\.[^.\\s]{3,4}$/', '', str_replace( realpath($this->view_dir), '', realpath($this->view_file) ) ), '/');
	}

	/**
	* Require css/less and js.
	*
	* @return void
	*/
	public function require_js_css() {
		$this->require_js();
		$this->require_css();
	}

	/**
	* Require css/less.
	*
	* @return void
	*/
	public function require_css() {
		$name = $this->name();
 
		//add o3 cms css
		if ( file_exists(O3_CMS_DIR.'/css/o3_cms.less') )
			$this->parent->head_less( O3_CMS_DIR.'/css/o3_cms.less' );

		//add global css
		if ( file_exists(O3_CMS_THEME_DIR.'/css/o3_cms_global.less') )
			$this->parent->head_less( O3_CMS_THEME_DIR.'/css/o3_cms_global.less' );
		
		//add less
		if ( file_exists(O3_CMS_THEME_DIR.'/css/view/'.$name.'.less') )
			$this->parent->head_less( O3_CMS_THEME_DIR.'/css/view/'.$name.'.less' );

		//add css
		if ( file_exists(O3_CMS_THEME_DIR.'/css/view/'.$name.'.css') )
			$this->parent->head_css( O3_CMS_THEME_DIR.'/css/view/'.$name.'.css' ); 
	}

	/**
	* Require js.
	*
	* @return void
	*/
	public function require_js() {
		$name = $this->name();
 
		//add o3 cms js
		if ( file_exists(O3_CMS_DIR.'/js/o3_cms.js') )
			$this->parent->body_js( O3_CMS_DIR.'/js/o3_cms.js' );
		
		//add global js
		if ( file_exists(O3_CMS_THEME_DIR.'/js/o3_cms_global.js') )
			$this->parent->body_js( O3_CMS_THEME_DIR.'/js/o3_cms_global.js' );
 
		//add js
		if ( file_exists(O3_CMS_THEME_DIR.'/js/view/'.$name.'.js') )
			$this->parent->body_js( O3_CMS_THEME_DIR.'/js/view/'.$name.'.js' );
	}


}

?>