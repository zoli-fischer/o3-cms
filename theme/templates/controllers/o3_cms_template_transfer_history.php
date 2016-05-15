<?php

//Require theme controller class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_template_controller.php');

//Require transfers class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_transfers.php');

class o3_cms_template_transfer_history extends snapfer_template_controller {

	public function init() {

		//parent init
		parent::init( func_get_args() );		
		
	}

	public function show_deleted_message() {
		if ( isset($_SESSION['flag_show_deleted_message']) && $_SESSION['flag_show_deleted_message'] === true ) {
			$_SESSION['flag_show_deleted_message'] = false;
			return true;
		}
		return false;
	}

	public function flag_show_deleted_message() {
		$_SESSION['flag_show_deleted_message'] = true;
	}

	public function ajax_delete_transfer() {
		//check if user logged and he/she is the sender
		if ( $this->logged_user()->validate_ajax( $this->ajax_result ) ) {

			//create transfer instance and load from canonical id 
			$transfer = new snapfer_transfer();
			$transfer->load_canonical( $this->ajax_result->value('id') );

			//check if transfer exists and owner is the same as logged user, if no logged user should be no owner of transfer
			if ( $transfer->is() && intval($transfer->get('user_id')) == intval($this->logged_user()->get('id')) ) {

				//return success
				if ( $transfer->delete() ) {

					//after reload show deleted message
					$this->flag_show_deleted_message();

					//reload list					
					$this->ajax_result->redirect( $this->o3_cms()->page_url(TRANSFERS_HISTORY_PAGE_ID) );

					//return success
					$this->ajax_result->success();
				}
			}

		}
	}

}

?>