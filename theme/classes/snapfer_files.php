<?php

//Require define class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_helper.php');

/**
 * O3 Snapfer Helper functions for file/folders handling and converting class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

//File type groups
snapfer_helper::define('SNAPFER_FILE_IMAGE','image',true);
snapfer_helper::define('SNAPFER_FILE_VIDEO','video',true);
snapfer_helper::define('SNAPFER_FILE_AUDIO','audio',true);
snapfer_helper::define('SNAPFER_FILE_DOC','doc',true);
snapfer_helper::define('SNAPFER_FILE_OTHER','other',true);

//Temp path for transfer
snapfer_helper::def('SNAPFER_TRANSFERS_PATH',O3_CMS_ROOT_DIR.'/transf3rs');

//Sendfile path for x-sendfile
snapfer_helper::def('SNAPFER_TRANSFERS_SENDFILE','transf3rs');

class snapfer_files {

	/**URL START**/

	/**
	* Get transfer image url
	*/
	public static function image_url( $canonical_id ) { 				
		return strlen(trim($canonical_id)) > 0 ? ( o3_get_host().'/?dl='.$canonical_id.'&fl=image' ) : false;
	}

	/**
	* Get zip download url
	*/
	public static function zip_url( $canonical_id, $recepient = 0 ) { 		
		$recepient = intval($recepient);
		return strlen(trim($canonical_id)) > 0 ? ( o3_get_host().'/?dl='.$canonical_id.( $recepient > 0 ? '&r='.$recepient : '' ) ) : false;
	}

	/**
	* Get file download url
	*/
	public static function file_url( $canonical_id, $file_id, $recepient = 0 ) { 		
		$file_id = intval($file_id);
		$recepient = intval($recepient);
		return strlen(trim($canonical_id)) > 0 && $file_id > 0 ? ( o3_get_host().'/?dl='.$canonical_id.'&fl='.$file_id.( $recepient > 0 ? '&r='.$recepient : '' ) ) : false;
	}

	/**
	* Get assset url
	*
	* @param string $type Values: thumb or preview
	* @param int $index Values: 1 or 2
	*/
	public static function asset_url( $canonical_id, $file_id, $type, $index ) { 		
		$file_id = intval($file_id);		
		$index = intval($index);
		return strlen(trim($canonical_id)) > 0 && ( $type == 'thumb' || $type == 'preview' ) && ( $index == 1 || $index == 2 ) ? ( o3_get_host().'/?dl='.$canonical_id.'&fl='.$file_id.'&ai='.$index.'&at='.$type ) : false;
	}

	/**URL END**/

	/**FILE TYPES START**/

	/**
	* Check if file is image
	*/
	public static function is_image( $ext ) { 		
		return self::ext2group( strtolower( preg_match('/\./', $ext) ? o3_extension($ext) : $ext ) ) == SNAPFER_FILE_IMAGE; 
	}

	/**
	* Check if file is video
	*/
	public static function is_video( $ext ) { 
		return self::ext2group( strtolower( preg_match('/\./', $ext) ? o3_extension($ext) : $ext ) ) == SNAPFER_FILE_VIDEO; 
	}

	/**
	* Check if file is audio
	*/
	public static function is_audio( $ext ) { 
		return self::ext2group( strtolower( preg_match('/\./', $ext) ? o3_extension($ext) : $ext ) ) == SNAPFER_FILE_AUDIO; 
	}

	/**
	* Check if file is document
	*/
	public static function is_doc( $ext ) { 
		return self::ext2group( strtolower( preg_match('/\./', $ext) ? o3_extension($ext) : $ext ) ) == SNAPFER_FILE_DOC; 
	}

	/**
	* Check if file is other
	*/
	public static function is_other( $ext ) { 
		return self::ext2group( strtolower( preg_match('/\./', $ext) ? o3_extension($ext) : $ext ) ) == SNAPFER_FILE_OTHER; 
	}

	/**
	* Get file type group by extension
	*/
	public static function ext2group( $ext ) {		
		switch ( strtolower( preg_match('/\./', $ext) ? o3_extension($ext) : $ext ) ) { //get extension if file name passed to function
			case 'jpg':
			case 'jpeg':
			case 'png':
			case 'pnga':
			case 'bmp':
			case 'gif':
			case 'jfif':
			case 'tif':
			case 'tiff':
			case 'ppm':
			case 'pgm':
			case 'pbm':			
			case 'webp':
			case 'heif':
			case 'heic':
			case 'bpg':
			case 'ecw':
			case 'fits':
			case 'fit':
			case 'fts':
			case 'ico':
			case 'tga':
			case 'cgm':
			case 'svg':
			case 'psd':
			case 'ai':
				return SNAPFER_FILE_IMAGE;
				break;
			case 'webm':
			case 'mkv':
			case 'flv':
			case 'f4v':
			case 'f4p':
			case 'f4a':
			case 'f4b':
			case 'vob':
			case 'ogv':
			case 'drc':
			case 'gifv':
			case 'mng':
			case 'avi':
			case 'mov':
			case 'qt':
			case 'wmv':
			case 'yuv':
			case 'rm':
			case 'rmvb':
			case 'asf':
			case 'asf':
			case 'mp4':
			case 'm4p':
			case 'm4v':
			case 'mpg':
			case 'mp2':
			case 'mpeg':
			case 'mpe':
			case 'mpv':
			case 'm2v':
			case 'm4v':
			case 'svi':
			case '3gp':
			case '3g2':
			case 'mxf':
			case 'roq':
			case 'nsv':			
				return SNAPFER_FILE_VIDEO;
				break;
			case '3gp':
			case 'aa':
			case 'aac':
			case 'aax':
			case 'act':
			case 'aiff':
			case 'amr':
			case 'ape':
			case 'au':
			case 'awb':
			case 'dct':
			case 'dss':
			case 'dvf':
			case 'flac':
			case 'gsm':
			case 'iklax':
			case 'ivs':
			case 'm4a':
			case 'm4b':
			case 'm4p':
			case 'mmf':
			case 'mp3':
			case 'mpc':
			case 'msv':
			case 'ogg':
			case 'oga':
			case 'opus':
			case 'ra':
			case 'rm':
			case 'raw':
			case 'sln':
			case 'tta':
			case 'vox':
			case 'wav':
			case 'wma':
			case 'wv':
				return SNAPFER_FILE_AUDIO;
				break;
			case 'docx':
			case 'docm':
			case 'doc':
			case 'dotx':
			case 'dotm':
			case 'dot':
			case 'pdf':
			case 'xps':
			case 'mht':
			case 'mhtml':
			case 'htm':
			case 'html':
			case 'rtf':
			case 'txt':
			case 'nfo':
			case 'xml':
			case 'docx':
			case 'odt':
			case 'xlsx':
			case 'xlsm':
			case 'xlsb':
			case 'xls':
			case 'xml':
			case 'xltx':
			case 'xltm':
			case 'xlt':
			case 'csv':
			case 'prn':
			case 'dif':
			case 'slk':
			case 'xlam':
			case 'xla':
			case 'ods':
			case 'pptx':
			case 'pptm':
			case 'ppt':
			case 'potx':
			case 'potm':
			case 'pot':
			case 'thmx':
			case 'ppsx':
			case 'ppsm':
			case 'pps':
			case 'ppam':
			case 'ppa':
			case 'wmf':
			case 'emf':
			case 'odp':
				return SNAPFER_FILE_DOC;
				break;
			default:
				return SNAPFER_FILE_OTHER;
				break;
		}
	}

	/**FILE TYPES END**/

	/**TRANSFER PATH START**/

	/**
	* Get transfer files path
	*/
	public static function files_path( $transfer_id, $file = '' ) {		
		$transfer_id = intval($transfer_id);
		if ( $transfer_id > 0 ) {
			$file = basename($file); //keep only filename

			//get files path
			$files_path = self::transfer_path( $transfer_id, '/files' );

			//check if folder/file exists
			if ( $files_path !== false ) {

				//create files dir if not exits
				if ( !file_exists($files_path) ) {
					mkdir( $files_path );
					if ( file_exists($files_path) )
						return $files_path.( $file != '' ? '/'.$file : '');
				} else {
					return $files_path.( $file != '' ? '/'.$file : '');
				}

			}			
		}
		return false;
	}

	/**
	* Get transfer files sendfile path
	*/
	public static function files_sendfile( $transfer_id, $file = '' ) {
		$transfer_id = intval($transfer_id);
		if ( $transfer_id > 0 ) {
			$file = basename($file); //keep only filename
			
			//check if folder/file exists
			if ( self::files_path( $transfer_id ) !== false ) {
				$files_sendfile = self::transfer_sendfile( $transfer_id, '/files' );
				if ( $files_sendfile !== false )
					return $files_sendfile.( $file != '' ? '/'.$file : '');
			}
		}
		return false;
	}

	/**
	* Get transfer path
	*/
	public static function transfer_path( $transfer_id, $file = '' ) {
		$transfer_id = intval($transfer_id);		
		if ( $transfer_id > 0 ) {
			$transfer_path = SNAPFER_TRANSFERS_PATH.'/'.$transfer_id;
			$file = basename($file); //keep only filename
			if ( !file_exists($transfer_path) ) {
				mkdir( $transfer_path );
				if ( file_exists($transfer_path) )
					return $transfer_path.( $file != '' ? '/'.$file : '');
			} else {
				return $transfer_path.( $file != '' ? '/'.$file : '');
			}
		}
		return false;
	}

	/**
	* Get transfer sendfile path
	*/
	public static function transfer_sendfile( $transfer_id, $file = '' ) {
		$transfer_id = intval($transfer_id);
		if ( $transfer_id > 0 ) {
			$file = basename($file); //keep only filename

			//check if folder/file exists
			if ( self::transfer_path( $transfer_id ) !== false ) {
				$transfer_sendfile = SNAPFER_TRANSFERS_SENDFILE.'/'.$transfer_id;								
				return $transfer_sendfile.( $file != '' ? '/'.$file : '');
			}
		}
		return false;
	}

	/**
	* Get transfer assets path
	*/
	public static function assets_path( $transfer_id, $file = '' ) {		
		$transfer_id = intval($transfer_id);
		if ( $transfer_id > 0 ) {
			$file = basename($file); //keep only filename

			//get assets path
			$assets_path = self::transfer_path( $transfer_id, '/assets' );

			//check if folder/file exists
			if ( $assets_path !== false ) {

				//create assets dir if not exits
				if ( !file_exists($assets_path) ) {
					mkdir( $assets_path );
					if ( file_exists($assets_path) )
						return $assets_path.( $file != '' ? '/'.$file : '');
				} else {
					return $assets_path.( $file != '' ? '/'.$file : '');
				}

			}			
		}
		return false;
	}

	/**
	* Get transfer assets sendfile path
	*/
	public static function assets_sendfile( $transfer_id, $file = '' ) {
		$transfer_id = intval($transfer_id);
		if ( $transfer_id > 0 ) {
			$file = basename($file); //keep only filename
			
			//check if folder/file exists
			if ( self::assets_path( $transfer_id ) !== false ) {
				$assets_sendfile = self::transfer_sendfile( $transfer_id, '/assets' );
				if ( $assets_sendfile !== false )
					return $assets_sendfile.( $file != '' ? '/'.$file : '');
			}
		}
		return false;
	}

	/**TRANSFER PATH STRUCTURE END**/

	/**TRANSFER IMAGE START**/

	/**
	* Get transfer zip path
	*/
	public static function transfer_image_path( $transfer_id ) {
		return self::transfer_path( $transfer_id, 'image.jpg' );
	}

	/**
	* Get transfer zip sendfile path
	*/
	public static function transfer_image_sendfile( $transfer_id ) {
		return self::transfer_sendfile( $transfer_id, 'image.jpg' );
	}

	/**TRANSFER IMAGE END**/

	/**ZIP START**/

	/**
	* Get transfer zip path
	*/
	public static function transfer_zip_path( $transfer_id ) {
		return self::transfer_path( $transfer_id, 'files.zip' );
	}

	/**
	* Get transfer zip sendfile path
	*/
	public static function transfer_zip_sendfile( $transfer_id ) {
		return self::transfer_sendfile( $transfer_id, 'files.zip' );
	}

	/**
	* Append zip to file
	*/
	public static function transfer_zip_append( $transfer_id, $file ) {
		$transfer_id = intval($transfer_id);
		if ( $transfer_id > 0 ) {
			$file = basename($file); //keep only filename
			$files_path = self::files_path( $transfer_id );
			$zip_path = self::transfer_zip_path( $transfer_id );

			if ( $files_path !== false && $zip_path !== false && strlen(trim($file)) > 0 ) {
				//append to zip file
				$script = "cd \"".addslashes($files_path)."\"; zip -r -0 -1 \"".addslashes($zip_path)."\" \"".addslashes($file)."\"";
				exec($script);

				return true;
			}			
		}
		return false;
	}

	/**ZIP END**/

}

?>