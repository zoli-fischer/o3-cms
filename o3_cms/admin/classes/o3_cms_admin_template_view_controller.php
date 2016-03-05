<?php

/**
 * O3 Admin template view's controller
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class o3_cms_admin_template_view_controller extends o3_template_view_controller {

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

}

?>