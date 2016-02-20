<?php

/**
 * O3 Admin tempalte class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class o3_cms_admin_template_controller extends o3_template_controller {

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