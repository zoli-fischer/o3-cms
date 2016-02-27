<?php

//Require controllers classes
require_once("o3_cms_admin_template_controller.php");
require_once("o3_cms_admin_template_view_controller.php");

/**
 * O3 Admin tempalte class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class o3_cms_admin_template extends o3_template {

	/** mixed Template name */
	protected $templatename = '';

	/**
	 * Constructor of template
	 * @return void
	 */
	public function __construct() {
		global $o3;

		//set parent the global o3 instance
		$this->parent = $o3;

		//set dirs
		$this->template_dir = O3_CMS_ADMIN_DIR.'/templates';
		$this->template_controller_dir = O3_CMS_ADMIN_DIR.'/templates/controllers';
		$this->view_dir = O3_CMS_ADMIN_DIR.'/templates/views';
		$this->view_controller_dir = O3_CMS_ADMIN_DIR.'/templates/views/controllers';

	}

	/**
	* Add template
	* Add css/less and js.
	*
	* @param string $template Name of the template
	* @param mixed. List of parameters pass to template constructor
	* @return object
	*/
  	public function template( $templatename ) {
  		$args = func_get_args();

		//formate template name
		if ( isset($args[0]) ) {
			$this->templatename = $args[0];
			$args[0] = 'o3_cms_admin_template_'.$args[0];
		}

		//laod template
		call_user_func_array('parent::template', func_get_args());
	}

	/**
	* Flush template content
	* On flush add css/less and js.
	*
	* @param string $template Name of the template to load and flush content
	* @param mixed. List of parameters pass to template constructor
	* @return object
	*/
	public function flush() {
		$args = func_get_args();

		//formate template name
		if ( isset($args[0]) ) {
			$this->templatename = $args[0];
			$args[0] = 'o3_cms_admin_template_'.$args[0];
		}

		//flush the buffer
		call_user_func_array('parent::flush', $args);
	}

}

?>