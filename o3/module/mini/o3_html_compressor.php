<?php
/**
 * CSS/JS minify module for O3 Engine
 *
 * HTML Packer file
 *
 * @package o3
 * @link    todo: add url
 * @author  Zotlan Fischer <zoli_fischer@yahoo.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
 
namespace o3\module\mini;
 
//Check if HTMLPacker class was defined before
if ( !class_exists('Minify_HTML', false ) ) 
    require_once('html/Minify_HTML.php');
    
/**
 * Pack HTML file
 *
 * Extends the HTML Packer class made by Dean Edwards
 * 
 * @see Minify_HTML 
 */
class o3_html_compressor extends \Minify_HTML {

}

?>