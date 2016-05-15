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

	/**
	* Set page meta image width
	* Facebook recomands: 1200 x 630 or 600 x 315
	*/
	public function page_image_width() {
		if ( !$this->transfer->is_expired() ) {
			$file = $this->transfer->image_path();
			$imagesize = getimagesize($file);
			if ( getimagesize($file) !== false )
				return $imagesize[0];
		} else {
			return parent::page_image_width();
		}
	}	

	/**
	* Set page meta image height
	* Facebook recomands: 1200 x 630 or 600 x 315
	*/
	public function page_image_height() {
		if ( !$this->transfer->is_expired() ) {
			$file = $this->transfer->image_path();
			$imagesize = getimagesize($file);
			if ( getimagesize($file) !== false )
				return $imagesize[1];
		} else {
			return parent::page_image_height();
		}
	}

	/**
	* Set page meta image	
	*/
	public function page_image() {
		if ( !$this->transfer->is_expired() ) {
			return $this->transfer->image_url();
		} else {
			return parent::page_image();
		}
	}		

	/**
	* Set page meta image height
	* Facebook recomands: 1200 x 630 or 600 x 315
	*/
	public function page_url() {
		if ( !$this->transfer->is_expired() ) {
			return $this->transfer->url();
		} else {
			return o3_current_url();
		}
	}

	public function show_group_headers() {
		return ( ( count($this->images) > 0 ? 1 : 0 ) +
			   ( count($this->videos) > 0 ? 1 : 0 ) +
			   ( count($this->audio) > 0 ? 1 : 0 ) +
			   ( count($this->docs) > 0 ? 1 : 0 ) +
			   ( count($this->others) > 0 ? 1 : 0 ) ) > 1;
	}

	public function ad_tag() {
		$leaderboard_files = array( '1.jpg', '2.gif', '3.jpg', '4.jpg', '5.jpg' );
		$mobilebanner_files = array( '1.jpg', '2.jpg', '3.gif', '4.gif', '5.jpg' );
		echo '<img src="/res/ad/leaderboard/'.$leaderboard_files[rand(1,5)-1].'" width="728" height="90" class="leaderboard-ad" alt="Google Ad placeholder - Leaderboard (728x90)" onclick="alert(\'Google Ad placeholder - Leaderboard (728x90)\');" />
			  <img src="/res/ad/mobile/'.$mobilebanner_files[rand(1,5)-1].'" width="320" height="100" class="mobilebanner-ad" alt="Google Ad placeholder - Mobile banner (320x100)" onclick="alert(\'Google Ad placeholder - Mobile banner (320x100)\');" />';
	}
}

?>