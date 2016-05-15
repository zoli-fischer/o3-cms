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
	* Return o3 object
	*/
	public function o3() { 	return $this->o3; }

	/*
	* Return o3 cms object
	*/
	public function o3_cms() { 	return $this->o3_cms; }
	
	/*
	* Get page title 
	*/
	public function page_title() {
		return $this->page()->is() ? $this->page()->get('title') : false;
	}

	/*
	* Get page description 
	*/
	public function page_description() {
		return $this->page()->is() ? $this->page()->get('description') : false;
	}

	/*
	* Get page keywords 
	*/
	public function page_keywords() {
		return $this->page()->is() ? $this->page()->get('keywords') : false;
	}

	/*
	* Get page image 
	*/
	public function page_image() {		
		return $this->page()->is() ? $this->page()->get('image') : false;
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
	* @return void
	*/
	public function require_js_css() {
		$this->require_js();
		$this->require_css();
	}

	/**
	* Require js.
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
		if ( file_exists(O3_CMS_THEME_DIR.'/js/'.$name.'.js') )
			$this->parent->body_js( O3_CMS_THEME_DIR.'/js/'.$name.'.js' );
	}

	/**
	* Require css/less.
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
		if ( file_exists(O3_CMS_THEME_DIR.'/css/'.$name.'.less') )
			$this->parent->head_less( O3_CMS_THEME_DIR.'/css/'.$name.'.less' );

		//add css
		if ( file_exists(O3_CMS_THEME_DIR.'/css/'.$name.'.css') )
			$this->parent->head_css( O3_CMS_THEME_DIR.'/css/'.$name.'.css' );
	}

	/* MENU */

	/*
	* Get menu group items by menu group id
	*/
	public function menu_group_items( $menu_group_id ) {
		
		//Require menu group class
		require_once(O3_CMS_DIR.'/classes/o3_cms_menu_group.php');

		return o3_with( new o3_cms_menu_group( $menu_group_id ) )->items();
	}

	/*
	* Generate menu group items html list
	*/
	public function menu_group_items_html_list( $menu_group_id ) {
		$buffer = '';
		foreach ( $this->menu_group_items( $menu_group_id ) as $menu_item) {
			//default attributes
			$attr = array(
				'href' => $menu_item->get('href'),
				'target' => o3_html($menu_item->get('target')),
				'class' => o3_html( $menu_item->active() ? 'active' : '' ),
				'title' => $menu_item->get('title')
			);

			//extend attributes
			if ( count($menu_item->attr()) > 0 )
				foreach ( $menu_item->attr() as $key => $value ) {
					switch ($key) {
						case 'class':
							$attr['class'] = trim( $attr['class'].' '.$value ); 
							break;
						default:
							$attr[$key] = $value;
							break;
					}
				}
			
			//format attributes
			$attr_formated = array();
			foreach ( $attr as $key => $value)
				$attr_formated[] = o3_html($key).'="'.o3_html($value).'"';

			//generate list tag
			$buffer .= '<li><a '.implode(' ', $attr_formated).'><span>'.o3_html($menu_item->get('title')).'</span></a></li>';
		}
		echo $buffer;
	}

}

?>