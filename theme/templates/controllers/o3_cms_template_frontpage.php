<?php

class o3_cms_template_frontpage extends o3_cms_template_controller {

	public function init() {

		//parent init
		parent::init( func_get_args() );
		
		//set title
		$this->page_title = $this->page()->get('title');

	}

}

?>