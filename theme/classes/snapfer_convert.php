<?php

//Require define class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_helper.php');

/**
 * O3 Snapfer Video/Audio/Document converter class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

//Path audio/video converter - Avcomv 
snapfer_helper::define('SNAPFER_AVCONV','avconv');

//Path to audio normalizer
snapfer_helper::define('SNAPFER_NORMALIZE_AUDIO','normalize-audio');

//Path to document to pdf converter
snapfer_helper::define('SNAPFER_LOWRITER','lowriter');

//Path to pdf to image converter
snapfer_helper::define('SNAPFER_PDFTOPPM','pdftoppm');

//Path to faststart converter
snapfer_helper::define('SNAPFER_FASTSTART','qt-faststart');

//Path to montage creator
snapfer_helper::define('SNAPFER_MONTAGE','montage');

//Path to PDF info retrieve
snapfer_helper::define('PDF_INFO','pdfinfo');

class snapfer_convert {
	
	/*
	* Check if document to pdf converter is installed on the system
	*/
	public static function is_lowriter() {
		exec("\"".SNAPFER_LOWRITER."\" -h", $out, $rcode);
		return $rcode === 0;
	}

	/*
	* Check if audio normalizer is installed on the system
	*/
	public static function is_normalize_audio() {
		exec("\"".SNAPFER_NORMALIZE_AUDIO."\"", $out, $rcode);
		return $rcode === 0;
	}

	/*
	* Check if avconv is installed on the system
	*/
	public static function is_avconv() {
		exec("\"".SNAPFER_AVCONV."\"", $out, $rcode);
		return $rcode === 0;
	}

	/**
	* Convert pdf to image
	*/
	public static function pdf2jpg( $source, $destination, $page = 1, $width = 1024, $height = 768, $flags = null, $quality = 90, $dpi = O3_IMAGE_WEB_DPI ) {
		$page = intval($page);
		$filename = o3_filename($destination);
		$dirname = o3_dirname($destination);
		$temp_file = $dirname.'/'.$filename.'.png';

		$script = "cd \"".addslashes($dirname)."\"; ".SNAPFER_PDFTOPPM." -r 299 -cropbox -f ".$page." -singlefile -png \"".addslashes($source)."\" \"".addslashes($filename)."\"";
		exec($script, $out, $rcode);
		if ( $rcode === 0 ) {

			//create final image
			$return = o3_image_resize( $temp_file, $destination, $width, $height, $flags, $quality, $dpi );

			//remove temp file
			o3_unlink( $temp_file );

			return $return;
		}

		return false;
	}

	/**
	* Get pdf info array
	*/	
	function pdf_info( $source ) {
		$script = PDF_INFO." -l 50000 \"".addslashes($source)."\"";		
		exec($script, $out, $rcode);
		if ( $rcode === 0 && is_array($out) && !empty($out) )
			return $out;		
		return false;
	}

	/**
	* Get pdf pages
	*/	
	public static function pdf_pages( $source ) {
		$info = self::pdf_info( $source );		
		if ( $info !== false ) {
			foreach ( $info as $value ) 
				if ( strpos( $value, 'Pages:' ) === 0 )
					return intval(str_replace('Pages:', '', $value));			
		}
		return false;		
	}

	/**
	* Get doc pages if converted to pdf
	*/
	public static function doc_pages( $source ) {
		$convert2pdf = strtolower(o3_extension($source)) != 'pdf';
		$pages = false;
		if ( $convert2pdf ) {
			//get temp pdf path
			$temp_pdf = o3_temp_cache_file( 'doc_pages.pdf' );
			
			//create pdf and get pages
			if ( self::doc2pdf( $source, $temp_pdf ) )
				$pages = self::pdf_pages( $temp_pdf );

			//remove temp pdf
			//o3_unlink($temp_pdf);
		} else {
			$pages = self::pdf_pages( $source );
		}
		return $pages;
	}

	/**
	* Convert doc to jpg
	*/
	public static function doc2jpg( $source, $destination, $page = 1, $width = 1024, $height = 768, $flags = null, $quality = 90, $dpi = O3_IMAGE_WEB_DPI ) {
		$convert2pdf = strtolower(o3_extension($source)) != 'pdf';		
		if ( $convert2pdf ) {
			$temp_pdf = o3_dirname($destination).'/'.o3_filename($destination).'.pdf';
			if ( self::doc2pdf( $source, $temp_pdf ) ) {
				$return = self::pdf2jpg( $temp_pdf, $destination, $page, $width, $height, $flags, $quality, $dpi );				
				
				//delete temp pdf
				o3_unlink($temp_pdf);

				return $return;
			} else {
				//delete temp pdf
				o3_unlink($temp_pdf);
			}
		} else {			
			return self::pdf2jpg( $source, $destination, $page, $width, $height, $flags, $quality, $dpi );
		}
		return false;
	}

	/**
	* Convert doc to pdf
	*/
	public static function doc2pdf( $source, $destination ) {
		$filename = o3_filename($destination);
		$dirname = o3_dirname($destination);		
		$temp_file = $dirname.'/'.o3_filename($filename).'.'.strtolower(o3_extension($source));
		$temp_pdf = $dirname.'/'.o3_filename($filename).'.pdf';

		//create destination
		o3_unlink( $temp_file );
		copy( $source, $temp_file );

		$script = "cd \"".addslashes($dirname)."\"; ".SNAPFER_LOWRITER." --headless --convert-to pdf \"".addslashes($temp_file)."\"";		
		exec($script, $out, $rcode);
		if ( $rcode === 0 ) {
			
			//create destination
			o3_unlink( $temp_file );

			return true;
		}
		return false;
	}

	/**
	* Duration of video or audio in seconds
	*/
	public static function duration( $source ) {
		//return duration informat 00:00:04.99
		$script = SNAPFER_AVCONV." -i \"".addslashes($source)."\" 2>&1 | grep 'Duration' | awk '{print $2}' | sed s/,//";
		exec($script, $out, $rcode);		
		if ( $rcode === 0 ) {
			$arr = explode(":", $out[0]);
			return $arr[0] * 3600 + $arr[1] * 60+ $arr[2];			
		}
		return false;	
	}
	

	/**
	* Extract image from video at x second
	*/
	public static function video2img( $source, $destination = '', $from = 0, $width = 1024, $height = 768, $flags = null, $quality = 90, $dpi = O3_IMAGE_WEB_DPI, $background = '' ) {
		$width = intval($width);
		$temp_file = $destination.'.jpg';

		//fix with and duration
		$videolength = self::duration($source);
		$from = $from > $videolength ? ( $videolength / 2 ) : $from;

		$script = SNAPFER_AVCONV." -ss ".$from." -r 24 -i \"".addslashes($source)."\" -t 0.01 \"".addslashes($temp_file)."\"";
		exec($script, $out, $rcode);				
		if ( $rcode === 0 ) {

			//create final image
			$return = o3_image_resize( $temp_file, $destination, $width, $height, $flags, $quality, $dpi, $background );

			//remove temp file
			o3_unlink( $temp_file );
			
			return $return;
		}
		return false;		
	}

	
	/**
	* Extract gif from video at x second with y second duration
	*/
	public static function video2gif( $source, $destination = '', $from = 15, $duration = 15, $width = 1024, $height = 768, $background = '' ) {
		$width = intval($width);
		$height = intval($height);
		$from = intval($from);
		$duration = intval($duration);
		$filename = o3_filename($destination);
		$dirname = o3_dirname($destination);		
		$destination = strtolower(o3_extension($destination)) == 'gif' ? $destination : $destination.'.gif'; 
		
		//fix with and duration
		$videolength = self::duration($source);
		$from = $from > $videolength ? 0 : $from;
		$duration = ( $from + $duration > $videolength ) ? ( $videolength - $from ) : $duration;

		$script = SNAPFER_AVCONV." -i \"".addslashes($source)."\" -ss ".$from." -r 1 -t ".$duration." -f image2 \"".addslashes($dirname."/".$filename)."-%04d.jpg\"";
		exec($script, $out, $rcode);
		if ( $rcode === 0 ) {
			
			//create gif file			
			$script = "\"".O3_IMAGE_MAGIC."\" -delay 10 -loop 0 \"".addslashes($dirname."/".$filename)."-*.jpg\" -scale ".$width."x".$height." \"".addslashes($destination)."\"";
			exec($script, $out, $rcode);			

			//remove temp files
			$temp_files = glob(addslashes($dirname)."/".addslashes($filename)."-*.jpg");
			foreach ( $temp_files as $file )
				o3_unlink( $file );			

			if ( $rcode === 0 )
				return $destination;
		}
		return false;		
	}
	
	/**
	* Convert to web supported mp4 at x second with y second duration
	*/
	public static function video2mp4( $source, $destination = '', $from = 15, $duration = 15, $normalize = true ) {
		$from = intval($from);
		$duration = intval($duration);		
		$filename = o3_filename($destination);
		$dirname = o3_dirname($destination);
		
		//fix with and duration
		$videolength = self::duration($source);
		$from = $from > $videolength ? 0 : $from;
		$duration = ( $from + $duration > $videolength ) ? ( $videolength - $from ) : $duration;
		
		$script = SNAPFER_AVCONV." -i \"".addslashes($source)."\" -ss ".$from." -r 24 -t ".$duration." -strict experimental -b:v 1M -maxrate 2M -minrate 0.5M -bufsize 1M -c:a aac -ac 2 -b:a 128k -c:v h264 -y \"".addslashes($destination)."\"";
		exec($script, $out, $rcode);
		if ( $rcode === 0 ) {

			//move index to front of file fo quick streaming
			$temp_file = $dirname.'/'.$filename.'-indexed.mp4';
			$script = SNAPFER_FASTSTART." \"".addslashes($destination)."\" \"".addslashes($temp_file)."\"";
			exec($script, $out, $rcode);
			if ( $rcode === 0 ) {
				o3_unlink($destination);
				rename($temp_file, $destination);
			}

			//normalize audio
			/*todo: make normalization work
			if ( $normalize ) {				
				$wav = $dirname."/".$filename.".wav";

				$script = SNAPFER_AVCONV." -i \"".addslashes($destination)."\" -c:a pcm_s16le -vn \"".addslashes($wav)."\"";
				exec($script, $out, $rcode);
				if ( $rcode === 0 ) {
					$script = SNAPFER_NORMALIZE_AUDIO." \"".$wav."\"";
					exec($script, $out, $rcode);
						
					if ( $rcode === 0 ) {
						echo $script = SNAPFER_AVCONV." -i \"".addslashes($destination)."\" -i \"".addslashes($wav)."\" -strict experimental -map 0:0 -map 1:0 -c:v copy -c:a aac \"".addslashes($destination)."\"";
						exec($script, $out, $rcode);

						print_r($out);
   					}
				}

				//remove temp file
				o3_unlink($wav,'wav');
			}
			*/

			return true;
		}
		return false;
	}

	/**
	* Convert to web supported mp3 at x second with y second duration
	*/
	public static function audio2mp3( $source, $destination = '', $from = 15, $duration = 15, $normalize = true, $kb = 128 ) {
		$from = intval($from);
		$duration = intval($duration);
		$kb = intval($kb);

		//fix with and duration
		$videolength = self::duration($source);
		$from = $from > $videolength ? 0 : $from;
		$duration = ( $from + $duration > $videolength ) ? ( $videolength - $from ) : $duration;

		$script = SNAPFER_AVCONV." -i \"".addslashes($source)."\" -ss ".$from." -t ".$duration." -strict experimental -c:a libmp3lame -ac 2 -b:a ".$kb."k \"".addslashes($destination)."\"";
		exec($script, $out, $rcode);
		if ( $rcode === 0 ) {

			//normalize audio
			if ( $normalize ) {
				$script = SNAPFER_NORMALIZE_AUDIO." \"".addslashes($destination)."\"";
				exec($script, $out, $rcode);
			}

			return true;

		}
		return false;
	}

	/**
	* Create montage from a list of files
	*/
	public static function montage( $sources, $destination, $rows, $cols, $padding = 2, $width = 1024, $height = 768, $flags = null, $quality = 90, $dpi = O3_IMAGE_WEB_DPI, $background = '' ) {
		$return = false;
		if ( count($sources) > 0 ) {
			$dirname = o3_dirname($destination);
			$temp_dir = $dirname.'/montage';
			$temp_file = $temp_dir.'/montage.jpg';
			
			//create temp dir
			if ( !file_exists($temp_dir) )
				mkdir($temp_dir);

			//check if temp dir writable
			if ( is_writable($temp_dir) ) {

				//space between images
				$padding = intval($padding);
				$rows = intval($rows);
				$cols = intval($cols);

				//number of items on a row
				$max_items = $rows * $cols;				

				$new_sources = array();
				$i = 0;
				foreach ( $sources as $source ) {
					$new_source = $temp_dir.'/'.$i.'.'.o3_extension($source);
					o3_image_resize( $source, $new_source, 300, 300, O3_IMAGE_SHRINK_LARGER | O3_IMAGE_ENLARGE_SMALLER | O3_IMAGE_CROP_CENTER, 90 );
					
					if ( $max_items - 2 < $i )
						break;

					$i++;
				}

				$script = "cd \"".addslashes($temp_dir)."\"; ".SNAPFER_MONTAGE." -geometry +".$padding."+".$padding." -tile ".$rows."x".$cols." *.* montage.jpg";
				exec($script, $out, $rcode);
				if ( $rcode === 0 ) {					
						
					//remove temp dir
					o3_unlink($destination);
					
					//create final image
					$return = o3_image_resize( $temp_file, $destination, $width, $height, O3_IMAGE_SHRINK_LARGER | O3_IMAGE_OPTIMIZE, 70 );				
					
				}
				
				//remove temp dir
				o3_unlink_dir($temp_dir);				
			}			
		}
		return $return;		
	}

}

?>