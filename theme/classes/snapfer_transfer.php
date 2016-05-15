<?php

//Require object class
require_once(O3_CMS_DIR.'/classes/o3_cms_object.php');

//Require transfers class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_transfers.php');

//Require transfer files class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_transfer_files.php');

//Require transfer recipients class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_transfer_recipients.php');

//Require define class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_helper.php');

//Require email sending class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_emails.php');

//Require define class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_files.php');

/**
 * O3 Snapfer Transfer class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

//Transfer types
snapfer_helper::define('SNAPFER_TRANSFER_EMAIL','email',true);
snapfer_helper::define('SNAPFER_TRANSFER_DOWNLOAD','download',true);
snapfer_helper::define('SNAPFER_TRANSFER_SOCIAL','social',true);

//System month length in days
snapfer_helper::define('SNAPFER_MONTH_LENGTH',30);

//System year length in days
snapfer_helper::define('SNAPFER_YEAR_LENGTH', SNAPFER_MONTH_LENGTH * 12 );

//Transfer expires days
snapfer_helper::def('SNAPFER_TRANSFER_LIFETIME_DAYS', 7, true);
snapfer_helper::def('SNAPFER_TRANSFER_LIFETIME_FREE_DAYS', 14, true);
snapfer_helper::def('SNAPFER_TRANSFER_LIFETIME_TEMP_DAYS', 1 );

//Transfer expires sec
snapfer_helper::define('SNAPFER_TRANSFER_LIFETIME_SECS', SNAPFER_TRANSFER_LIFETIME_DAYS * 3600 * 24, true);
snapfer_helper::define('SNAPFER_TRANSFER_LIFETIME_FREE_SECS', SNAPFER_TRANSFER_LIFETIME_FREE_DAYS * 3600 * 24, true);
snapfer_helper::define('SNAPFER_TRANSFER_LIFETIME_TEMP_SECS', SNAPFER_TRANSFER_LIFETIME_TEMP_DAYS * 3600 * 24, true);

//Transfer history days
snapfer_helper::def('SNAPFER_TRANSFER_KEEP_DAYS', 7, true);
snapfer_helper::def('SNAPFER_TRANSFER_KEEP_FREE_DAYS', SNAPFER_MONTH_LENGTH * 2, true);

//Transfer history sec
snapfer_helper::define('SNAPFER_TRANSFER_KEEP_SECS', SNAPFER_TRANSFER_KEEP_DAYS * 3600 * 24, true);
snapfer_helper::define('SNAPFER_TRANSFER_KEEP_FREE_SECS', SNAPFER_TRANSFER_KEEP_FREE_DAYS * 3600 * 24, true);

//Transfer size GB
snapfer_helper::def('SNAPFER_TRANSFER_MAXSIZE_GB','2.5GB',true);
snapfer_helper::def('SNAPFER_TRANSFER_FREE_MAXSIZE_GB','5GB',true);
snapfer_helper::def('SNAPFER_TRANSFER_PREMIUM_MAXSIZE_GB','25GB',true);

//Transfer size bytes
snapfer_helper::define('SNAPFER_TRANSFER_MAXSIZE', str_ireplace( 'gb', '', SNAPFER_TRANSFER_MAXSIZE_GB) * 1024 * 1024 * 1024, true);
snapfer_helper::define('SNAPFER_TRANSFER_FREE_MAXSIZE', str_ireplace( 'gb', '', SNAPFER_TRANSFER_FREE_MAXSIZE_GB) * 1024 * 1024 * 1024,true);
snapfer_helper::define('SNAPFER_TRANSFER_PREMIUM_MAXSIZE', str_ireplace( 'gb', '', SNAPFER_TRANSFER_PREMIUM_MAXSIZE_GB) * 1024 * 1024 * 1024,true);

class snapfer_transfer extends o3_cms_object {

	public $owner = null;

	/**
	* Load transfer with id
	* @param id Transfer id to select
	*/
	public function load( $id ) {				
		if ( $id != '' ) {
			$this->data = o3_with(new snapfer_transfers())->get_by_id( $id );

			//if owner was loaded than reload owner
			if ( $this->owner !== null )
				$this->owner = new snapfer_user( $this->get('user_id') );
		}
	}

	/**
	* Check if transfer has owner
	*/
	public function has_owner() {
		return $this->get('user_id') > 0;
	}

	/**
	* Get transfer owner
	*/
	public function owner() {
		if ( $this->owner === null )
			$this->owner = new snapfer_user( $this->get('user_id') );
		return $this->owner;
	}

	/**
	* Load transfer with canonical id
	* @param id Transfer canonical id to select
	*/
	public function load_canonical( $canonical_id ) {				
		if ( $canonical_id != '' ) {
			$this->data = o3_with(new snapfer_transfers())->get_by_canonical_id( $canonical_id );
		}
	}

	/**
	 * Update transfer
	 *
	 * @param array $values List of values
	 * @param array $condition List of conditions
	 *
	 * @return boolean
	 */
	public function update( $values, $conditions = null ) {
		if ( $this->is() ) {
			$conditions = $conditions === null ? array() : $conditions;
			$conditions['id'] = $this->get('id');

			//update
			if ( o3_with(new snapfer_transfers())->update( $values, $conditions ) !== false ) {				

				//reload transfer data
				$this->reload();

				return true;
			}	
		}
		return false;
	}

	/**
	* Check if transfer is temporary
	*/
	public function is_temp() {
		return !$this->is() || ( $this->is() && $this->get('temp') == 1 );
	}

	/**
	* Get if transfer is expired
	*/
	public function is_expired() {		
		return !$this->is() || 
				( $this->is() && $this->is_temp() ) ||
				( $this->is() && $this->has_owner() && !$this->owner()->is_premium() && $this->get('expire') < date('Y-m-d H:i:s') ) || 
				( $this->is() && !$this->has_owner() && $this->get('expire') < date('Y-m-d H:i:s') );	
	}

	/**
	* Finalize transfer
	*/
	public function finalize() {
		if ( $this->is() ) {
			if ( $this->update(array(
				'temp' => 0
			) ) ) {				
				
				$recipients = $this->recipients();
				$recipients_count = count($recipients);
				$files = $this->files();
				$files_count = count($files);

				//send emails
				if ( $this->get('way') == SNAPFER_TRANSFER_EMAIL && count($recipients_count) > 0 ) {

					//send confirmation email to sender
					o3_with(new snapfer_emails())->send( $this->get('email'), 'Snapfer - '.$files_count.' '.( $files_count == 1 ? 'file' : 'files' ).' sent to '.$recipients_count.' '.( $recipients_count == 1 ? 'recepient' : 'recipients' ), '<h1>'.$files_count.' '.( $files_count == 1 ? 'file' : 'files' ).' sent to '.$recipients_count.' '.( $recipients_count == 1 ? 'recepient' : 'recipients' ).'</h1> <p>As soon as a recipient has clicked on the download button, we will send you a confirmation email.</p><p><br><br></p>' );

					//send to recipients
					foreach ( $recipients as $recipient ) {
						//send download link to recepient and 
						if ( $recipient->is() ) {					
							if ( o3_with(new snapfer_emails())->send( $recipient->get('email'), $this->get('email').' has sent you '.$files_count.' '.( $files_count == 1 ? 'file' : 'files' ).' via Snapfer', '<h1>'.o3_html($recipient->get('email')).' sent you '.$files_count.' '.( $files_count == 1 ? 'file' : 'files' ).'</h1>'.( strlen(trim($this->get('message'))) > 0 ? '<p>Message from '.o3_html($recipient->get('email')).':<br><i>'.nl2br(o3_html($this->get('message'))).'</i></p><p><br></p>' : '' ).'<h2><a href="'.$this->url( $recipient->get('id') ).'" target="_blank" class="btn" title="Download '.( $files_count == 1 ? 'file' : 'files' ).'">Download '.( $files_count == 1 ? 'file' : 'files' ).'</a></h2><p><br></p>'.( $this->get('expire') !== null && !$this->owner()->is_premium() ? '<p><b>The '.( $files_count == 1 ? 'file' : 'files' ).' will be deleted on '.snapfer_helper::format_date( $this->get('expire') ).'</b>.</p>' : ''  ).'<p><br><br></p>' ) ) {

								//set sent
								$recipient->update( array( 'sent' => date('Y-m-d H:i:s') ) );
							}
						}
					}

				}

				//create temp image
				$this->create_image();

				return true;
			}
		}
		return false;
	}	

	/**
	* Send notification email that on recepient opened the transfer
	*/
	public function send_opened_notification( $recepient_email ) {
		if ( $this->is() && $this->get('way') == SNAPFER_TRANSFER_EMAIL && o3_valid_email($this->get('email')) ) {

			//send confirmation email to sender
			return o3_with(new snapfer_emails())->send( $this->get('email'), 'Snapfer - download confirmation from zlf@web2it.dk', '<h1>zlf@web2it.dk saw your files</h1> <h2><a href="'.$this->url().'" target="_blank" class="btn" title="Download '.( $files_count == 1 ? 'file' : 'files' ).'">Download link</a></h2><p><br></p>'.( $this->get('expire') !== null && !$this->owner()->is_premium() ? '<p><b>The '.( $files_count == 1 ? 'file' : 'files' ).' will be deleted on '.snapfer_helper::format_date( $this->get('expire') ).'</b>.</p>' : ''  ).'<p><br><br></p>' );

		}
		return false;
	}
		
	/**
	* Get transfer url
	*/
	public function url( $recepient = 0 ) {
		if ( $this->is() ) 
			return o3_get_host().'/transfer?id='.$this->get('canonical_id').( $recepient > 0 ? '&r='.$recepient : '' );
		return false;
	}

	/**
	* Get zip download url
	*/
	public function zip_url( $recepient = 0 ) {
		return snapfer_files::zip_url( $this->get('canonical_id'), $recepient );
	}

	/**
	* Get file download url
	*/
	public function file_url( $file_id, $recepient = 0 ) {
		return snapfer_files::file_url( $this->get('canonical_id'), $file_id, $recepient );		
	}

	/**
	* Get transfer title
	*/
	public function page_title() {
		$files_count = $this->files_count();
		return $files_count.' '.( $files_count == 1 ? 'file is' : 'files are' ).' ready to download on Sapfer';
	}

	/**
	* Get transfer desc
	*/
	public function page_desc() {
		$files_count = $this->files_count();
		return 'Check '.( $files_count == 1 ? ' this '.$files_count.' file' : ' these '.$files_count.' files' ).' ( '.o3_bytes_display('vU',$this->size()).' ) on Sapfer';
	}

	/**
	* Get transfer title
	*/
	public function share_title() {
		return $this->page_title();
	}

	/**
	* Get transfer desc
	*/
	public function share_desc() {
		return $this->page_desc();
	}

	/**
	* Get transfer path
	*/
	public function transfer_path( $file = '' ) {
		return snapfer_files::transfer_path( $this->get('id'), $file );
	}

	/**
	* Get transfer sendfile path
	*/
	public function transfer_sendfile( $file = '' ) {
		return snapfer_files::transfer_sendfile( $this->get('id'), $file );
	}

	/**
	* Get transfer files path
	*/
	public function files_path( $file = '' ) {
		return snapfer_files::files_path( $this->get('id'), $file );
	}	

	/**
	* Get transfer files sendfile path
	*/
	public function files_sendfile( $file = '' ) {
		return snapfer_files::files_sendfile( $this->get('id'), $file );
	}

	/**
	* Get transfer zip path
	*/
	public function zip_path() {
		return snapfer_files::transfer_zip_path( $this->get('id') );
	}

	/**
	* Get transfer zip sendfile path
	*/
	public function zip_sendfile() {
		return snapfer_files::transfer_zip_sendfile( $this->get('id') );
	}

	/**
	* Add file
	* @param $name Name of the file
	* @param $tmp_name Uploaded file
	* @param $size Size of the file
	* @return boolean True if the file was added
	*/
	public function add_file( $name, $tmp_name, $size ) {
		if ( $this->is() ) {			
			$file_path = $this->files_path( $name );			
			if ( $file_path !== false && move_uploaded_file( $tmp_name, $file_path ) ) {				

				//insert file into database
				$file = o3_with(new snapfer_transfer_files())->add( $this->get('id'), $name, $file_path );
				if ( $file->is() ) {

					//append zip to transfer zip
					$file->transfer_zip_append();
					
					//generate thumbnails and perviews
					$file->generate();

					return true;					
				}
			}
		}
		return false;
	}

	/**
	* Get transfer size
	*/
	public function size() {
		return $this->is() ? o3_with(new snapfer_transfers())->total_size_by_transfer_id( $this->get('id') ) : 0;
	}

	/**
	* Get transfer downloads
	*/
	public function downloads() {
		return $this->is() ? o3_with(new snapfer_transfers())->total_downloads_by_transfer_id( $this->get('id') ) : 0;
	}

	/**
	* Get transfer files
	*/
	public function files_count() {
		return $this->is() ? o3_with(new snapfer_transfers())->total_files_by_transfer_id( $this->get('id') ) : 0;
	}

	/**
	* Get transfer's recipients list
	*/
	public function recipients() {
		$recipients = array();
 		if ( $this->is() ) {
 			$transfer_recipients = o3_with(new snapfer_transfer_recipients())->select( 'id',  ' transfer_id = '.$this->get('id'), ' id ' );
 			if ( is_array($transfer_recipients) && count($transfer_recipients) > 0 )
	 			foreach ( $transfer_recipients as $key => $value )
	 				$recipients[] = new snapfer_transfer_recipient( $value->id );
		}
		return $recipients;
	}

	/**
	* Get transfer's files list
	*/
	public function files() {
		$files = array();
 		if ( $this->is() ) {
 			$transfer_files = o3_with(new snapfer_transfer_files())->select( 'id',  ' transfer_id = '.$this->get('id'), ' name, id ' );
 			if ( is_array($transfer_files) && count($transfer_files) > 0 )
	 			foreach ( $transfer_files as $key => $value )
	 				$files[] = new snapfer_transfer_file( $value->id );
		}
		return $files;
	}

	/**
	* Flag as deleted
	* Set as temp
	*/
	public function delete() {
		return $this->update(array( "temp" => 1 ));	
	}

	/**
	* Increase download count for files
	*/
	public function increase_download( $file_id = 0 ) {
		if ( $this->is() )
			return (new snapfer_transfer_files())->increase_download( $this->get('id'), $file_id );
		return false;
	}

	/**
	* Send file to download
	*/
	public function download( $file_id = 0 ) {		
		if ( $this->is() ) {

			//transfer expired send file not found
			if ( $this->is_expired() ) {
				;		
			} else {
				
				$is_asset = isset($_GET['ai']) || isset($_GET['at']); //check if is an asset or file
				$disposition = $is_asset ? 'inline' : 'attachment'; //attachment or inline				
				
				//if file requested send file else zip
				if ( $file_id > 0 ) {
					
					//get file and check if part of the requested transfer
					$file = new snapfer_transfer_file( $file_id );					
					if ( $file->is() && $file->get('transfer_id') === $this->get('id') ) {
						if ( $is_asset ) {
							switch (o3_get('at')) {
								case 'thumb':
									$file_path = $file->thumb_file_path( intval(o3_get('ai')) );
									$file_sendfile = $file->thumb_file_sendfile( intval(o3_get('ai')) );
									break;
								case 'preview':
										
									$page = isset($_GET['p']) ? ( $_GET['p'] + 1 ) : 1; //document file page									
										
									$file_path = $file->preview_file_path( intval(o3_get('ai')), $page );
									$file_sendfile = $file->preview_file_sendfile( intval(o3_get('ai')), $page );

									//check if document file and not first page and file no exists than creaete it
									if ( $page > 1 && $page < $file->get('pages') - 1 && $file->is_doc() && !file_exists($file_path) )
										$file->generate_preview( intval(o3_get('ai')), false, $page );

									break;									
							}							
						} else {
							$file_sendfile = $file->sendfile();
							$file_path = $file->path();
						}
					}

				} else if ( !$is_asset ) { 
					if ( o3_get('fl') == 'image' ) {
						//if asset requested than for sure is not zip
						$file_sendfile = $this->image_sendfile();
						$file_path = $this->image_path();
					} else {
						//if asset requested than for sure is not zip
						$file_sendfile = $this->zip_sendfile();
						$file_path = $this->zip_path();
					}
				}


				//if filex exists send to client
				if ( $file_sendfile != false && $file_path != false && file_exists($file_path) ) {

					if ( !$is_asset ) {
						//ignore this part for assets
					
						//should increase file download
						$increase_download = false;

						//check for owner
						if ( $this->has_owner() ) {

							//creat logged user instance and check session
							o3_with($logged_user = new snapfer_user())->load_from_session();

							//check if the logged user is the owner, don't increase download for owner
							if ( !$logged_user->is() || ( $logged_user->is() && $logged_user->get('id') !== $this->owner()->get('id') ) ) {
								$increase_download = true;	
							}
						} else {
							$increase_download = true;
						}

						if ( $increase_download ) {
							//save to session that file download was increased, the downloads only count 1 per session
							$session_index = 'snapfer_file_dl_'.$file_id;
							if ( !isset($_SESSION[$session_index]) ) {
								$this->increase_download( $file_id );							
								$_SESSION[$session_index] = date('Y-m-d H:i:s');
							}
						}
					}

					//send file
					header('X-Sendfile: '.$file_sendfile);
					header('Content-Type: '.o3_ext2mime(o3_extension($file_sendfile)));					
					header('Content-Disposition: '.$disposition.'; filename="'.o3_html(basename($file_sendfile)).'"');
					/*
					header("Expires: ".gmdate("D, d M Y H:i:s", time() + 768960000));
    				header("Pragma: cache");
					header('Content-Length: '.filesize($file_path));
					header("Last-Modified: ".date( 'r', filemtime($file_path) ));
					*/
					die();
				}
				
			}

		}

		//show file not found if we reached this point
		echo 'Sorry. The file couldn\'t be found.';
		o3_header_code(404);
		die();
	}
	
	/**
	* Unlink transfer (Completly remove from database and files/folders)
	*/
	public function unlink() {
		if ( $this->is() ) {
			//error flag
			$mysql_error = false;

			//disable autocommit
			$this->o3->mysqli->autocommit(false);

			//start mysqli transaction
			$this->o3->mysqli->begin_transaction();

			//remove recipients
			if ( o3_with(new snapfer_transfer_recipients())->detele_by_transfer_id( $this->get('id') )  === false )
				$mysql_error = true;

			//remove files
			if ( o3_with(new snapfer_transfer_files())->detele_by_transfer_id( $this->get('id') ) === false )
				$mysql_error = true;

			//remove transfer and canonical id
			$transfers = new snapfer_transfers();
			if ( $transfers->detele_canonical_by_transfer_id( $this->get('id') ) === false )
				$mysql_error = true;
			if ( $transfers->detele_by_transfer_id( $this->get('id') ) === false )
				$mysql_error = true;

			//rollback on mysql error else commit
			if ( $mysql_error ) {
				$this->o3->mysqli->rollback();
			} else if ( $this->o3->mysqli->commit() ) {
			
				//remove folder	
				o3_unlink_dir( $this->transfer_path() );	

				return true;
			}
		}
		return false;
	}

	/**
	* Get image url
	*/
	public function image_url() {
		return snapfer_files::image_url( $this->get('canonical_id') );
	}

	/**
	* Get transfer image path
	*/
	public function image_path() {
		return snapfer_files::transfer_image_path( $this->get('id') );
	}

	/**
	* Get transfer image sendfile path
	*/
	public function image_sendfile() {
		return snapfer_files::transfer_image_sendfile( $this->get('id') );
	}

	/**
	* Create transfer image collage
	*/
	public function create_image() {
		$files = $this->files();
		$images = array();
		$nr_max_images = 18; //max images to use
		if ( count($files) > 0 ) {
			$i = 0;
			foreach ( $files as $file ) {	
				$index = 0;			
				switch ( $file->get('type') ) {
					case SNAPFER_FILE_IMAGE:
					case SNAPFER_FILE_DOC:
						$index = 1;
						break;
					case SNAPFER_FILE_VIDEO:
						$index = 2;
						break;
				}

				if ( $index > 0 )
					if ( $file->has_preview($index) && $file->preview_file_path($index) !== false )
						$images[] = $file->preview_file_path($index);
				
				if ( $i > $nr_max_images - 3 )
					break;

				$i++;				
			}						

			//slit array
			$images_split = array_chunk( $images, $nr_max_images );
			$images = $images_split[0];

			//add snapfer logo
			$images[] = O3_CMS_THEME_DIR.'/res/snapfer-image.jpg';

			//shuffler array
			shuffle($images);
			
			//items count
			$items = count($images);

			$rows = 3;
			$cols = 6;
			if ( $items >= 15 && $items < 18 ) {
				$rows = 3;
				$cols = 5;	
			} else if ( $items >= 12 && $items < 15 ) {
				$rows = 3;
				$cols = 4;	
			} else if ( $items >= 8 && $items < 12 ) {
				$rows = 2;
				$cols = 4;	
			} else if ( $items >= 4 && $items < 8 ) {
				$rows = 2;
				$cols = 2;	
			} else if ( $items >= 2 && $items < 4 ) {
				$rows = 1;
				$cols = 2;	
			} else if ( $items == 1 ) {
				$rows = 1;
				$cols = 2;	
			}
			$max_items = $rows * $cols;			
 
			//Require define class
			require_once(O3_CMS_THEME_DIR.'/classes/snapfer_convert.php');
			
			//create montage
			return snapfer_convert::montage( $images, $this->image_path(), $cols, $rows, 2, 1200, 1200, O3_IMAGE_SHRINK_LARGER | O3_IMAGE_OPTIMIZE, 70, O3_IMAGE_WEB_DPI );		
		}
		return false;
	}

}

?>