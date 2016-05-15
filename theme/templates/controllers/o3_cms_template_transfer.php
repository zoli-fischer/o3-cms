<?php

//Require theme controller class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_template_controller.php');

//Require transfers class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_transfers.php');

class o3_cms_template_transfer extends snapfer_template_controller {

	public $transfer = null;
	
	//files
	public $files = array();
	public $images = array();
	public $videos = array();
	public $audio = array();
	public $docs = array();
	public $others = array();

	public function init() {

		//parent init
		parent::init( func_get_args() );

		//load transfer
		$this->transfer = new snapfer_transfer();
		$this->transfer->load_canonical( o3_get('id') );

		//if transfer not expired
 		if ( !$this->transfer->is_expired() ) {
			//store and sort files
			$this->files = $this->transfer->files();
			if ( count($this->files) > 0 ) {
				foreach ( $this->files as $file ) {				
					switch ($file->get('type')) {
						case SNAPFER_FILE_IMAGE:
							$this->images[] = $file;
							break;
						case SNAPFER_FILE_VIDEO:
							$this->videos[] = $file;
							break;
						case SNAPFER_FILE_AUDIO:
							$this->audio[] = $file;
							break;
						case SNAPFER_FILE_DOC:
							$this->docs[] = $file;
							break;
						default:
							$this->others[] = $file;
							break;
					}
				}
			}

			//check if recepient id is received and order is email way
			if ( o3_get('r') > 0 && $this->transfer->get('way') == SNAPFER_TRANSFER_EMAIL ) {
				$recepient = new snapfer_transfer_recipient( o3_get('r') );
				//flag recepient as opened the transfer and send notification email
				if ( $recepient->is() && $recepient->get('first_open') === null ) {
					//set open date for recepient
					$recepient->update( array( 'first_open' => date('Y-m-d H:i:s') ) );

					//send notification email to transfer owner
					$this->transfer->send_opened_notification( $recepient_email );
				}
			}
		}

	}

	public function page_title() {
		if ( !$this->transfer->is_expired() ) {
			return $this->transfer->page_title();
		} else {
			return 'Sorry. The download couldn\'t be found.';
		}
	}

	public function page_description() {
		if ( !$this->transfer->is_expired() ) {
			return $this->transfer->page_desc();
		} else {
			return 'Sorry. The download couldn\'t be found.';
		}
	}

	public function page_keywords() {
		return '';
	}

	public function show_group_headers() {
		return ( ( count($this->images) > 0 ? 1 : 0 ) +
			   ( count($this->videos) > 0 ? 1 : 0 ) +
			   ( count($this->audio) > 0 ? 1 : 0 ) +
			   ( count($this->docs) > 0 ? 1 : 0 ) +
			   ( count($this->others) > 0 ? 1 : 0 ) ) > 1;
	}
}

?>