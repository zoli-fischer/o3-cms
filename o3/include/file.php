<?php 

/**
 * O3 Engine file/folder handler
 *
 * Functions for handling files and folders.
 *
 * @package o3
 * @link    todo: add url
 * @author  Zotlan Fischer <zoli_fischer@yahoo.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
 
/**
* Read sub folders and files in a folder with details.
*
* Index of returned items: <br>
* boolean <b>file</b> True if is a file else false <br>
*	string <b>name</b> Name with extension <br>
* string <b>filename</b> Name without extension <br>
* string <b>extension</b> <br>
* string <b>path</b> Full path to the file/folder <br>
* int <b>size</b> Total size of the file/folder with subfolders in bytes  <br>
* int <b>mdate</b> Timestamp when the content of the file/folder was changed	
*
* @example example.php
* <b>//Read and display content of sample</b><br>
* $files = o3_read_path( '/sample' ); <br>
* if ( count() ) { <br>
*		foreach ( $files as $value ) <br>
*			echo ( $value['file'] ? 'File: ' : 'Folder: ' ).$value['filename']; <br>
*	}
*
* @param string $dir Path to the folder	 
*
* @return array[]
*/	
function o3_read_path( $dir ) {

	$relative_path = o3_get_caller_path();
	if ( $relative_path != '' && !realpath($dir) )
		$dir = $relative_path.'/'.$dir;

	if ( !is_readable($dir) || !is_dir($dir) )
	    return false;

	$a = array();
	if ( $handle = opendir($dir) ) {
		while (false !== ($file = readdir($handle))) {
			if ($file!='..' && $file!='.') {
				$aux['file'] = !is_dir($dir."/".$file);				
				$aux['name'] = $file;
				$pathinfo = pathinfo($aux['name']);
				$aux['filename'] = $pathinfo['filename'];
				$aux['extension'] = isset($pathinfo['extension']) ? $pathinfo['extension'] : '';
				$aux['path'] = $dir."/".$file;
				$aux['size'] = $aux['file'] ? filesize($dir."/".$file) : sprintf("%u",o3_path_size($dir."/".$file));
				$aux['mdate']=filemtime($dir."/".$file);								
				$a[] = $aux;
			}
		}
		closedir($handle);
	} else {		
		trigger_error( 'Can\'t read content of directory '.o3_html($dir).'.' );
		return false;
	}
	return $a;
}

/**
* Get the size of a folder in bytes. The total size with subfolders and files.
*
* @param string $path Path to the folder
*
* @return int
*/	
function o3_path_size( $path ) {
	
	$relative_path = o3_get_caller_path();
	if ( $relative_path != '' && !realpath($path) )
		$path = $relative_path.'/'.$path;

	if ( !is_readable($path) || !is_dir($path) )
	    return false;
	
	$d_stack[] = $path;
	$size = 0;
	
	do {
	    $path = array_shift($d_stack);
	    if ($handle = opendir($path)) {
	    	while (false !== ($file = readdir($handle))) {
	        if ($file != '.' && $file != '..' && is_readable($path . "/" . $file)) {
	            if (is_dir($path . "/" . $file)) {
	                $d_stack[] = $path . "/" . $file;
	            }
	            $size += filesize($path . "/" . $file);
	        }	
	      }
	    } else {
	    	trigger_error( 'Can\'t read content of directory '.o3_html($path).'.' );
	    }
	    closedir($handle);
	} while (count($d_stack) > 0);
	
	return $size;
}



/**
* Get the dir of a file.
*
* @param string $path Path to the file
*
* @return string
*/	
function o3_dirname( $path ) {
	return pathinfo($path, PATHINFO_DIRNAME);
}

/**
* Get the filename of a file without extension.
*
* @param string $path Path to the file
*
* @return string
*/	
function o3_filename( $path ) {
	return pathinfo($path, PATHINFO_FILENAME);
}

/**
* Get the extension of a file.
*
* @param string $path Path to the file
*
* @return string
*/	
function o3_extension( $path ) {
	preg_match('/\.[^\.]+$/i',$path,$ext);
	return isset($ext[0]) ? str_replace('.', '', $ext[0]) : '';
}

/**
* Output buffer to download or inline
*
* @param string $buffer Buffer
* @param string $filename Output file name
* @param string $mime Output conten type
* @param string $disposition inline or attachment Defaut: inline
*
* @return boolean
*/	
function o3_output_buffer( $buffer, $filename, $mime = 'application/octet-stream', $disposition = 'inline' ) { 
	
	header("Content-Type: ".$mime);	
	header('Content-Disposition: '.$disposition.'; filename="'.$filename.'"');
	header('Cache-Control: public, must-revalidate, max-age=0, post-check=0, pre-check=0');
	header('Pragma: no-cache');  
	header('Content-Length: '.strlen($buffer));
	header("Last-Modified: ".date( 'r', filemtime($path) ));

	ob_clean();

	echo $buffer;

	return true;
}

/**
* Get mime type by extension
*/
function o3_ext2mime( $ext ){
    $types['swf'] = 'application/x-shockwave-flash';
    $types['pdf'] = 'application/pdf';
    $types['exe'] = 'application/octet-stream';
    $types['zip'] = 'application/zip';
    $types['doc'] = 'application/msword';
    $types['xls'] = 'application/vnd.ms-excel';
    $types['ppt'] = 'application/vnd.ms-powerpoint';
    $types['gif'] = 'image/gif';
    $types['png'] = 'image/png';
    $types['jpeg'] = 'image/jpg';
    $types['jpg'] = 'image/jpg';
    $types['rar'] = 'application/rar';

    $types['ra'] = 'audio/x-pn-realaudio';
    $types['ram'] = 'audio/x-pn-realaudio';
    $types['ogg'] = 'audio/x-pn-realaudio';

    $types['wav'] = 'video/x-msvideo';
    $types['wmv'] = 'video/x-msvideo';
    $types['avi'] = 'video/x-msvideo';
    $types['asf'] = 'video/x-msvideo';
    $types['divx'] = 'video/x-msvideo';

    $types['mp3'] = 'audio/mpeg';
    $types['mp4'] = 'video/mp4';
    $types['mpeg'] = 'video/mp4';
    $types['mpg'] = 'video/mp4';
    $types['mpe'] = 'video/mp4';
    $types['mov'] = 'video/quicktime';
    $types['swf'] = 'video/quicktime';
    $types['3gp'] = 'video/quicktime';
    $types['m4a'] = 'video/quicktime';
    $types['aac'] = 'video/quicktime';
    $types['m3u'] = 'video/quicktime';
    return isset($types[$ext]) ? $types[$ext] : 'application/octet-stream';
};

/**
* Output file to download or inline
*
* @param string $path Path to the file
* @param string $filename Output file name
* @param string $mime Output conten type
* @param string $disposition inline or attachment Defaut: inline
*
* @return boolean
*/	
function o3_output_file_stream( $path, $filename = null, $mime = null, $disposition = 'attachment', $maxspeed = 100, $stream = false ) {
	if ( connection_status() != 0 )
		return false;
	
	$filename = $filename == null ? basename($path) : $filename;
	$ext = o3_extension($filename);
	$mime = $mime === null ? $mime : o3_ext2mime($extension);
    header("Cache-Control: public");
    header("Content-Transfer-Encoding: binary\n");
    header('Content-Type: $mime');

        
    if ( $stream == true ) {
        /* extensions to stream */
        $array_listen = array('mp3', 'm3u', 'm4a', 'mid', 'ogg', 'ra', 'ram', 'wm', 'wav', 'wma', 'aac', '3gp', 'avi', 'mov', 'mp4', 'mpeg', 'mpg', 'swf', 'wmv', 'divx', 'asf');
        if ( in_array($extension, $array_listen) ) {
            $disposition = 'inline';
        }
    }

    if ( strstr($_SERVER['HTTP_USER_AGENT'], "MSIE" ) ) {
        $filename = preg_replace('/\./', '%2e', $filename, substr_count($filename, '.') - 1);
        header("Content-Disposition: $disposition;
            filename=\"$filename\"");
    } else {
        header("Content-Disposition: $disposition;
            filename=\"$filename\"");
    }

    header("Accept-Ranges: bytes");
    $range = 0;
    $size = filesize($path);

    if (isset($_SERVER['HTTP_RANGE'])) {
        list($a, $range) = explode("=", $_SERVER['HTTP_RANGE']);
        str_replace($range, "-", $range);
        $size2 = $size - 1;
        $new_length = $size - $range;
        header("HTTP/1.1 206 Partial Content");
        header("Content-Length: $new_length");
        header("Content-Range: bytes $range$size2/$size");
    } else {
        $size2 = $size - 1;
        header("Content-Range: bytes 0-$size2/$size");
        header("Content-Length: " . $size);
    }

    if ($size == 0) {
        die('Zero byte file! Aborting download');
    }
    set_magic_quotes_runtime(0);
    $fp = fopen("$path", "rb");

    fseek($fp, $range);

    while (!feof($fp) and ( connection_status() == 0)) {
        set_time_limit(0);
        print(fread($fp, 1024 * $maxspeed));
        flush();
        ob_flush();
        sleep(1);
    }
    fclose($fp);

    return((connection_status() == 0) and ! connection_aborted());
}

/**
* Output file to download or inline
*
* @param string $path Path to the file
* @param string $filename Output file name
* @param string $mime Output conten type
* @param string $disposition inline or attachment Defaut: inline
*
* @return boolean
*/	
function o3_output_file( $path, $filename, $mime = 'application/octet-stream', $disposition = 'inline' ) { 
	
	if ( !file_exists($path) )
		return false;
	
	$fh = @fopen( $path, 'rb' );	
	if( !$fh )
		return false;
	
	header("Content-Type: ".$mime);	
	header('Content-Disposition: '.$disposition.'; filename="'.$filename.'"');
	header('Cache-Control: public, must-revalidate, max-age=0, post-check=0, pre-check=0');
	header('Pragma: no-cache');
	header('Content-Length: '.filesize($path));
	header("Last-Modified: ".date( 'r', filemtime($path) ));
	
	while(!feof($fh)) {
		print(@fread($fh, 1024*8));
		ob_flush();
		flush();
	}

	return true;
}

/*append & create*/

/**
* Write into a file.
* The default mode is 'w' - open for writing only; place the file pointer at the beginning of the file and truncate the file to zero length. If the file does not exist, attempt to create it. 
*
* @param string $file Path to the file. Same as first parameter $filename in http://www.php.net/manual/en/function.fopen.php
* @param string $buffer (optional) String that is to be written	
* @param string $flag (optional) The mode parameter specifies the type of access you require to the stream. Same as first parameter $mode in http://www.php.net/manual/en/function.fopen.php
*
* @return string
*/
function o3_write_file( $file, $buffer = "", $flag = 'w' ) {	
	$relative_path = o3_get_caller_path();
	if ( $relative_path != '' && !realpath(dirname($file)) )
		$file = $relative_path.'/'.$file;	
	$error = true;
	$h = fopen( $file, $flag );
	if ( $h ) {		
		$error = fwrite( $h, $buffer ) === false;
		fclose( $h );
	}		
	if ( $error ) 
		trigger_error( 'Can\'t open file '.o3_html($file).' for write.' );
	return !$error;	
}

/**
* Write into the top of a file
* The default mode is 'w' - open for writing only; place the file pointer at the beginning of the file and truncate the file to zero length. If the file does not exist, attempt to create it. 
*
* @param string $file Path to the file. Same as first parameter $filename in http://www.php.net/manual/en/function.fopen.php
* @param string $buffer (optional) String that is to be written		
*
* @return string
*/
function o3_write2top_file( $file, $buffer = "" ) {
	$relative_path = o3_get_caller_path();
	if ( $relative_path != '' && !realpath(dirname($file)) )
		$file = $relative_path.'/'.$file;
	$contents = file_get_contents( $file );
	if ( $contents !== false ) {
		$contents = $buffer.$contents;
		return o3_write_file( $file, $contents, 'w' );
	}
	trigger_error( 'Can\'t read content of '.o3_html($file).'.' );	
	return false;
}

/**
* Delete a folder
*/	
function o3_unlink_dir( $dir ) {
	$files = array_diff( scandir($dir), array('.','..') );
    foreach ( $files as $file ) {
    	if ( is_dir($dir."/".$file) ) {
    		o3_unlink_dir($dir."/".$file);
    	} else {
    		o3_unlink($dir."/".$file);
    	}
    }
    return rmdir($dir);
}


/**
* Delete a file.
*
* @param string $file Path to the file.
*
* @return boolean
*/
function o3_unlink( $file ) {	
	//get caller script path, we need for relaive paths
	$relative_path = o3_get_caller_path();
	if ( $relative_path != '' && !realpath(dirname($file)) )
		$file = $relative_path.'/'.$file;
	if ( file_exists( $file ) && is_file($file) && is_writable($file) )
		return unlink( $file );
	return true;
}

/*
* Create cache file name
*/
function o3_cache_file( $filename = '' ) {
	$ext = o3_extension($filename);
	if ( $filename == '' || $filename == '.'.$ext ) {
		$file = md5(o3_micro_time());
		while ( file_exists(O3_CACHE_DIR.'/'.$file.( $ext != '' ? '.'.$ext : '' )) )
			$file = md5(o3_micro_time());
	} else {
		$file = basename($filename,'.'.$ext);
	}
	return O3_CACHE_DIR.'/'.$file.( $ext != '' ? '.'.$ext : '' );
}

/*
* Create temporary cache file name
* @param string $filename
* @param Lifetime of the file. Default: 1800 (30min)
*/
function o3_temp_cache_file( $filename = '', $lifetime = 1800 ) {
	$ext = o3_extension($filename);
	if ( $filename == '' ) {
		$file = md5(o3_micro_time());
		while ( file_exists(O3_CACHE_DIR.'/'.$file.( $ext != '' ? '.'.$ext : '' )) )
			$file = md5(o3_micro_time());
	} else {
		$file = basename($filename,'.'.$ext);
	}
	return O3_CACHE_DIR.'/'.(time()+$lifetime).'-'.$file.( $ext != '' ? '.'.$ext : '' );
}

/*
* Create url from cache path
*/
function o3_cache_url( $filepath ) {
	$filename = basename($filepath);
	return O3_CACHE_URL.'/'.$filename;
}

/**
* Get function caller script path
* @return string/boolean False if unable to find path else path name
*/
function o3_get_caller_path() {
	$trace = debug_backtrace();
	/*
	$debug_backtrace = false;
	for ($i = 0; $i < count($trace); ++$i) {
        if ( 'debug' == $trace[$i]['function'] ) {
            if (isset($trace[$i + 1]['class'])) {
                $debug_backtrace = array(
                    'class' => $trace[$i + 1]['class'],
                    'line' => $trace[$i]['line'],
                );
            }
            $debug_backtrace = array(
                'file' => $trace[$i]['file'],
                'line' => $trace[$i]['line'],
            );
        }
    }
    if ( $debug_backtrace === false )
    	$debug_backtrace = $trace[0];
   	*/
    if ( isset($trace[1]) ) {
		return isset($trace[1]['file']) ? str_replace(DIRECTORY_SEPARATOR, '/', realpath(dirname($trace[1]['file']))) : '';		
    }
    return false;
}

/*
* Get/set max post size allowed by the server in bytes
*/
function o3_post_max_size() {
	$args = func_get_args();
	if ( count($args) > 0 ) {
		ini_set( 'post_max_size', $args[0] );
	} else { 
	    $mul = substr(ini_get('post_max_size'), -1);
	    $mul = ($mul == 'M' ? 1048576 : ($mul == 'K' ? 1024 : ($mul == 'G' ? 1073741824 : 1)));
	    return $mul * intval(ini_get('post_max_size'));
	}
}

/*
* Get/set max upload size allowed by the server in bytes
*/
function o3_upload_max_filesize() {
	$args = func_get_args();
	if ( count($args) > 0 ) {
		ini_set( 'upload_max_filesize', $args[0] );
	} else { 
	    $mul = substr(ini_get('upload_max_filesize'), -1);
	    $mul = ($mul == 'M' ? 1048576 : ($mul == 'K' ? 1024 : ($mul == 'G' ? 1073741824 : 1)));
	    return $mul * intval(ini_get('upload_max_filesize'));
	}
}
	
/*
* Get max allowed upload size combine with post and upload max size
*/
function o3_upload_max_size() {
	return min( o3_post_max_size(), o3_upload_max_filesize() );
}

/*
* Get content of URL
*
* @param string $url
* @param int $timeout
*
* @return string/boolean Content of URL or false if URL not found
*/
function o3_url_get_contents( $url, $timeout = 5, &$header = null ) {	
	$result = false;

	//check if curl_init available
    if ( is_callable('curl_init') ) {
        try {
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_HEADER, true);
			
               
            $response = @curl_exec($ch);

            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = preg_split('/\r\n|\r|\n/', trim(substr($response, 0, $header_size)));
            $result = substr($response, $header_size);
               
            curl_close($ch);
        } catch (Exception $e) {
        }
    } else {
    	$context = stream_context_create( 
	        			array( 
	        				'http'=> array( 
	        					'timeout' => $timeout,
	        				), 
	        				'https'=> array(
	        					'timeout' => $timeout,
	        				),        			
		        			'ssl' => array(
						        'verify_peer' => false,
						    )
		        		)
	        		);        	
        $result = @file_get_contents( $url, false, $context );
    }

    return $result;
}

?>