<?php

//Require object class
require_once(O3_CMS_DIR.'/classes/o3_cms_object.php');

//Require page class
require_once(O3_CMS_DIR.'/classes/o3_cms_pages.php');

//Require templates class
require_once(O3_CMS_DIR.'/classes/o3_cms_template.php');

/**
 * O3 CMS Page class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class o3_cms_page extends o3_cms_object {

	/** obj | boolean Data of the template. False if no tempalte data. */	
	protected $template = null;
	
	/*
	* Load page with id
	* @param id Page id to select
	*/
	public function load( $id ) {				
		if ( $id > 0 ) {
			$this->data = o3_with(new o3_cms_pages())->get_by_id( $id );
			$this->template = new o3_cms_template( $this->get('template_id') );
		}
	}

	/*
	* Return template 
	* @void pointer Pointer to template object
	*/
	public function template() {
		return $this->template;
	}

}

?>