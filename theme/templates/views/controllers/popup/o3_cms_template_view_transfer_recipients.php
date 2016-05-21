<?php

//Require theme view controller class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_view_controller.php');

//Require transfers class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_transfers.php');

class o3_cms_template_view_transfer_recipients extends snapfer_view_controller {

	public $transfer = null;

	public function init() {

		//parent init
		parent::init( func_get_args() );

		//if not the logged user is the requester, return 404
		if ( !$this->is_valid_requester() ) {
			o3_header_code(404);
			die();
		}

		//load transfer
		$this->transfer = new snapfer_transfer();
		$this->transfer->load_canonical( o3_get('transfer_id') );		
		if ( !$this->transfer->is() || $this->transfer->get('user_id') != $this->logged_user()->get('id') ) {
			o3_header_code(404);
			die();
		}
		
	}
	
}

?>