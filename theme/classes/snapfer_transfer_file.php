<?php


//Require object class
require_once(O3_CMS_DIR.'/classes/o3_cms_object.php');

//Require transfer files class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_transfer_files.php');

//Require define class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_files.php');

/**
 * O3 Snapfer Transfer File class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class snapfer_transfer_file extends o3_cms_object {

	/**
	* Load transfer with id
	* @param id Transfer id to select
	*/
	public function load( $id ) {				
		if ( $id != '' ) {
			$this->data = o3_with(new snapfer_transfer_files())->get_by_id( $id );
		}
	}

	/**
	 * Update transfer file
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
			if ( o3_with(new snapfer_transfer_files())->update( $values, $conditions ) !== false ) {				

				//reload user data
				$this->reload();

				return true;
			}	
		}
		return false;
	}

	/**
	* Get file's extension
	*/
	public function extension() {
		return $this->is() ? strtolower(o3_extension( $this->get('name') )) : false;
	}

	/**
	* Get file size
	*/
	public function size() {
		return $this->is() ? $this->get('filesize') : false;
	}

	/**
	* Get file download url
	*/
	public function url( $recepient = 0 ) {
		return snapfer_files::file_url( $this->get('canonical_id'), $this->get('id'), $recepient );		
	}

	/**
	* Check if file is image
	*/
	public function is_image() { return $this->get('type') == SNAPFER_FILE_IMAGE; }

	/**
	* Check if file is video
	*/
	public function is_video() { return $this->get('type') == SNAPFER_FILE_VIDEO; }

	/**
	* Check if file is audio
	*/
	public function is_audio() { return $this->get('type') == SNAPFER_FILE_AUDIO; }

	/**
	* Check if file is document
	*/
	public function is_doc() { return $this->get('type') == SNAPFER_FILE_DOC; }

	/**
	* Check if file is other
	*/
	public function is_other() { return $this->get('type') == SNAPFER_FILE_OTHER; }	

	/**
	* Get file path
	*/
	public function path() {
		return snapfer_files::files_path( $this->get('transfer_id'), $this->get('file') );
	}

	/**
	* Get file sendfile path
	*/
	public function sendfile() {
		return snapfer_files::files_sendfile( $this->get('transfer_id'), $this->get('file') );
	}

	/**
	* Add this file to transef zip
	*/
	public function transfer_zip_append() {
		global $o3;
		return snapfer_files::transfer_zip_append( $this->get('transfer_id'), $this->get('file') );
	}

	/**
	* Get thumb file url
	*/
	public function thumb_url( $index ) {
		return snapfer_files::asset_url( $this->get('canonical_id'), $this->get('id'), 'thumb', $index );
	}

	/**
	* Get thumb file name
	*/
	public function thumb_file( $index ) {
		return $this->is() ? $this->generate_thumb( $index, true ) : false;
	}

	/**
	* Get thumb file path
	*/
	public function thumb_file_path( $index ) {
		return $this->is() ? snapfer_files::assets_path( $this->get('transfer_id'), $this->thumb_file( $index ) ) : false;
	}

	/**
	* Get thumb file sendfile path
	*/
	public function thumb_file_sendfile( $index ) {
		return $this->is() ? snapfer_files::assets_sendfile( $this->get('transfer_id'), $this->thumb_file( $index ) ) : false;
	}

	/**
	* Get preview file url
	*/
	public function preview_url( $index ) {
		return snapfer_files::asset_url( $this->get('canonical_id'), $this->get('id'), 'preview', $index );
	}

	/**
	* Get preview file name
	*/
	public function preview_file( $index ) {
		return $this->is() ? $this->generate_preview( $index, true ) : false;
	}

	/**
	* Get preview file path
	*/
	public function preview_file_path( $index ) {
		return $this->is() ? snapfer_files::assets_path( $this->get('transfer_id'), $this->preview_file( $index ) ) : false;
	}

	/**
	* Get preview file sendfile path
	*/
	public function preview_file_sendfile( $index ) {
		return $this->is() ? snapfer_files::assets_sendfile( $this->get('transfer_id'), $this->preview_file( $index ) ) : false;
	}

	/**
	* Generate previews and thumbnails
	*
	* @param boolean $force_regenerate If true the previews and thumbnails are deleted and regenerated
	*/
	public function generate( $force_regenerate = false ) {
		
		//delete files if force regenerate requested
		if ( $force_regenerate ) {
			o3_unkink($this->thumb_file_path( 1 ));
			o3_unkink($this->thumb_file_path( 2 ));
			o3_unkink($this->preview_file_path( 1 ));
			o3_unkink($this->preview_file_path( 2 ));
		}

		$result = array(
			'thumb1' => $this->generate_thumb( 1 ) !== false ? filesize($this->thumb_file_path( 1 )) : 0,
			'thumb2' => $this->generate_thumb( 2 ) !== false ? filesize($this->thumb_file_path( 2 )) : 0,
			'preview1' => $this->generate_preview( 1 ) !== false ? filesize($this->preview_file_path( 1 )) : 0,
			'preview2' => $this->generate_preview( 2 ) !== false ? filesize($this->preview_file_path( 2 )) : 0
		);

		//update database table row
		return $this->update($result);	
	}

	/**
	* Generate thumb 
	*
	* @param int $index Index of thumbnail 1 or 2 
	* @param Boolean $only_filename If true the file is not generated just the filename 
	*
	* @return string $filename
	*/
	public function generate_thumb( $index, $only_filename = false ) {
		if ( $this->is() ) {
			$index = intval($index);
			$filename = $this->get('id').'-th-'.$index;
			//$fieldindex = 'thumb'.$index;

			switch ( $index ) {
				case 1:

					//check file type
					switch ($this->get('type')) {
						case SNAPFER_FILE_IMAGE:							
							//add extension
							$filename .= '.jpg'; 

							//geenrate thumb
							if ( !$only_filename ) {

								//create image of max. 384x384 72 dpi and quality 70
								if ( o3_image_resize( $this->path(), $this->thumb_file_path( $index ), 384, 384, O3_IMAGE_SHRINK_LARGER | O3_IMAGE_FILL_AREA | O3_IMAGE_FLATTEN | O3_IMAGE_OPTIMIZE, 70, O3_IMAGE_WEB_DPI, '#ffffff' ) ) {
									
									return $filename;	
								}
							} else {
								return $filename;						
							}
							break;							
						case SNAPFER_FILE_VIDEO:
							//add extension
							$filename .= '.jpg'; 

							//geenrate thumb
							if ( !$only_filename ) {

								//Require define class
								require_once(O3_CMS_THEME_DIR.'/classes/snapfer_convert.php');
								
								//create image of max. 384x384 72 dpi and quality 70 at 60 second of the movie
								if ( snapfer_convert::video2img( $this->path(), $this->thumb_file_path( $index ), 15, 384, 384, O3_IMAGE_SHRINK_LARGER | O3_IMAGE_FILL_AREA | O3_IMAGE_FLATTEN | O3_IMAGE_OPTIMIZE, 70, O3_IMAGE_WEB_DPI ) ) {
									
									return $filename;	
								}

							} else {
								return $filename;						
							}
							break;
						case SNAPFER_FILE_DOC:
							//add extension
							$filename .= '.jpg'; 

							//geenrate thumb
							if ( !$only_filename ) {

								//Require define class
								require_once(O3_CMS_THEME_DIR.'/classes/snapfer_convert.php');
								
								//create image of max. 384x384 72 dpi and quality 70 at 60 second of the movie
								if ( snapfer_convert::doc2jpg( $this->path(), $this->thumb_file_path( $index ), 1, 384, 384, O3_IMAGE_SHRINK_LARGER | O3_IMAGE_FILL_AREA | O3_IMAGE_FLATTEN | O3_IMAGE_OPTIMIZE, 70, O3_IMAGE_WEB_DPI ) ) {
									
									return $filename;	
								}

							} else {
								return $filename;						
							}
							break;
					}
					
					break;			
				case 2:

					//check file type
					switch ($this->get('type')) {						
						case SNAPFER_FILE_VIDEO:
							//add extension
							$filename .= '.gif'; 

							//geenrate thumb
							if ( !$only_filename ) {

								//Require define class
								require_once(O3_CMS_THEME_DIR.'/classes/snapfer_convert.php');

								//create image of max. 384x384 72 dpi and quality 70 at 60 second of the movie
								if ( snapfer_convert::video2gif( $this->path(), $this->thumb_file_path( $index ), 16, 15, 384, 384, O3_IMAGE_SHRINK_LARGER | O3_IMAGE_FILL_AREA ) ) {
									
									return $filename;	
								}

							} else {
								return $filename;						
							}
							break;
					}

					break;
			}
		}
		return false;
	}

	/**
	* Generate preview 
	*
	* @param int $index Index of thumbnail 1 or 2 
	* @param Boolean $only_filename If true the file is not generated just the filename 
	*
	* @return string $filename
	*/
	public function generate_preview( $index, $only_filename = false ) {
		if ( $this->is() ) {
			$index = intval($index);
			$filename = $this->get('id').'-pv-'.$index;
			//$fieldindex = 'preview'.$index;

			switch ( $index ) {
				case 1:
					
					//check file type
					switch ($this->get('type')) {
						case SNAPFER_FILE_IMAGE:							
							//add extension
							$filename .= '.jpg'; 

							//geenrate preview
							if ( !$only_filename ) {

								//create image of max. 1920x1280 72 dpi and quality 70
								if ( o3_image_resize( $this->path(), $this->preview_file_path( $index ), 1920, 1080, O3_IMAGE_SHRINK_LARGER | O3_IMAGE_OPTIMIZE, 70, O3_IMAGE_WEB_DPI ) ) {

									return $filename;	
								}
							} else {
								return $filename;						
							}
							break;
						case SNAPFER_FILE_VIDEO:
							//add extension
							$filename .= '.mp4'; 

							//geenrate thumb
							if ( !$only_filename ) {

								//Require define class
								require_once(O3_CMS_THEME_DIR.'/classes/snapfer_convert.php');
								
								//create web compatible mp4 video from with duration
								if ( snapfer_convert::video2mp4( $this->path(), $this->preview_file_path( $index ), 15, 15 ) ) {
									
									return $filename;	
								}

							} else {
								return $filename;						
							}
							break;
						case SNAPFER_FILE_AUDIO:
							//add extension
							$filename .= '.mp3'; 

							//geenrate thumb
							if ( !$only_filename ) {

								//Require define class
								require_once(O3_CMS_THEME_DIR.'/classes/snapfer_convert.php');
								
								//create web compatible mp4 video from with duration
								if ( snapfer_convert::audio2mp3( $this->path(), $this->preview_file_path( $index ), 15, 15 ) ) {
									
									return $filename;	
								}

							} else {
								return $filename;						
							}
							break;
						case SNAPFER_FILE_DOC:
							//add extension
							$filename .= '.jpg'; 

							//geenrate thumb
							if ( !$only_filename ) {

								//Require define class
								require_once(O3_CMS_THEME_DIR.'/classes/snapfer_convert.php');
								
								//create image of max. 1920x1920 72 dpi and quality 70 at 60 second of the movie
								if ( snapfer_convert::doc2jpg( $this->path(), $this->preview_file_path( $index ), 1, 1920, 1920, O3_IMAGE_SHRINK_LARGER | O3_IMAGE_FILL_AREA | O3_IMAGE_FLATTEN | O3_IMAGE_OPTIMIZE, 90, O3_IMAGE_WEB_DPI ) ) {
									
									return $filename;	
								}

							} else {
								return $filename;						
							}
							break;							
					}

					break;			
				case 2:	
					break;
			}
		}
		return false;
	}

}


/*
$file = new snapfer_transfer_file( 3 );
$file->generate();
$file = new snapfer_transfer_file( 4 );
$file->generate();
$file = new snapfer_transfer_file( 5 );
$file->generate();
$file = new snapfer_transfer_file( 6 );
$file->generate();
*/
/*
$file = new snapfer_transfer_file( 37 );
//echo $file->generate_thumb( 1 ) ? '! thumb1' : '? thumb1' ; echo '<br>';
//echo $file->generate_thumb( 2 ) ? '! thumb2' : '? thumb2' ; echo '<br>';
echo $file->generate_preview( 1 ) ? '! prev1' : '? prev1' ; echo '<br>';
die();
*/

?>

