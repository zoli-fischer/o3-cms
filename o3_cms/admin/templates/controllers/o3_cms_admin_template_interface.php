<?php

class o3_cms_admin_template_interface extends o3_cms_admin_template_controller {

	public function init() {

		//parent init
		parent::init( func_get_args() );
		
		//set title
		$this->page_title = 'Loading...';

	}

}

?>