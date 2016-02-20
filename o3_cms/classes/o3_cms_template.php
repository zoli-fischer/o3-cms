<?php

//Require page class
require_once(O3_CMS_DIR.'/classes/o3_cms_object.php');

//Require page class
require_once(O3_CMS_DIR.'/classes/o3_cms_templates.php');

/**
 * O3 CMS Template class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class o3_cms_template extends o3_cms_object {
 
	/*
	* Load template with id
	* @param id Template id to select
	*/
	public function load( $id ) {
		parent::load($id);
		$this->data = o3_cms_templates::get_by_id( $id );	
	} 

}

?>