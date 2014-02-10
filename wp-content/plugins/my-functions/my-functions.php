<?php
/*
Plugin Name: My Functions
Plugin URI: http://localhost/
Description: The parameters that can not fit offsite in a unique and highly secure customizable plugin.
Tags: stable, easyuse, particular, private, functions
Version: 2013.888
Author: Niaj-scio
Author URI: niaj-scio
Contributors: slangjis, Christopher Ross
Editor URI: http://slangji.wordpress.com/
Requires at least: 3.1
Tested up to: 7.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Indentation: GNU style coding standard
Indentation URI: http://www.gnu.org/prep/standards/standards.html
Note: Thanks in readme.txt file 	
  */

add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}

/* Change post option name
function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Noticias';
    $submenu['edit.php'][5][0] = 'Noticias';
    $submenu['edit.php'][10][0] = 'Añadir noticias';
    $submenu['edit.php'][16][0] = 'Etiquetas de noticia';
    echo '';
}

function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Noticias';
    $labels->singular_name = 'Noticia';
    $labels->add_new = 'Añadir noticias';
    $labels->add_new_item = 'Añadir noticia';
    $labels->edit_item = 'Editar noticias';
    $labels->new_item = 'Noticias';
    $labels->view_item = 'Ver noticias';
    $labels->search_items = 'Buscar noticias';
    $labels->not_found = 'Noticias no encontradas';
    $labels->not_found_in_trash = 'Noticias no encontradas en la papelera';
}
 
add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );
*/

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

function custom_excerpt_length($length) {
    return 25;
}

/**
 * Mostrar miniatura de imagen destacada en el feed
 * DE AYUDAWORDPRESS.COM
 */

add_filter('the_content_feed', 'imagen_destacada_rss');
function imagen_destacada_rss($content) {
        global $post;
        if( has_post_thumbnail($post->ID) )
                $content = '<p>' . get_the_post_thumbnail($post->ID, 'thumbnail') . '</p>' . $content;
        return $content;
}

/*
Hotlink Protection by Christopher Ross (http://thisismyurl.com/plugins/hotlink-protection/)
License: GPL
*/

/**
 * Hotlink Protection core file
 *
 * This file contains all the logic required for the plugin
 *
 * @link		http://wordpress.org/extend/plugins/hotlink-protection/
 *
 * @package 		Hotlink Protection
 * @copyright		Copyright (c) 2008, Chrsitopher Ross
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Hotlink Protection 1.0


// on activate
global $thisismyurl_hotlink_protection_file;
global $thisismyurl_hotlink_protection_file_hlp;


$url = strtolower(get_bloginfo('url'));
$url = str_replace('https://','',$url);
$url = str_replace('http://','',$url);
$url = str_replace('www.','',$url);
$thisismyurl_hotlink_protection_file_hlp = "

# Hotlink Protection START #

<IfModule mod_rewrite.c>
RewriteEngine on
RewriteCond %{HTTP_REFERER} !^$
# include additional file types here
RewriteCond %{REQUEST_FILENAME} \.(gif|jpe?g?|png)$                [NC]
RewriteCond %{HTTP_REFERER} !^http(s)?://(www\.)?".$url." [NC]
RewriteCond %{HTTP_REFERER} !^http(s)?://".$url." [NC]
# search engine access
RewriteCond %{HTTP_REFERER}     !search\?q=cache                   [NC]
RewriteCond %{HTTP_REFERER}     !google\.                          [NC]
RewriteCond %{HTTP_REFERER}     !yahoo\.                           [NC]
RewriteRule \.(jpg|jpeg|png|gif)$ - [NC,F,L]
</IfModule>
<IfModule mod_rewrite.c>
AddOutputFilterByType DEFLATE text/text text/html text/plain text/xml text/css application/x-javascript application/javascript
</IfModule>
# Hotlink Protection END #

";

$thisismyurl_hotlink_protection_file = ABSPATH.'.htaccess';

// on activate
function timu_wpaihp_active() {
	global $thisismyurl_hotlink_protection_file;
	global $thisismyurl_hotlink_protection_file_hlp;
	
	if (file_exists($thisismyurl_hotlink_protection_file)) {
	  
		$fh = fopen($thisismyurl_hotlink_protection_file, 'r');
		$htaccess = fread($fh, filesize($thisismyurl_hotlink_protection_file));
		fclose($fh);
  	}
  
	$fh = fopen($thisismyurl_hotlink_protection_file, 'w') or die("can't open file");
	fwrite($fh, $htaccess.$thisismyurl_hotlink_protection_file_hlp);
	fclose($fh);
	
}
register_activation_hook( __FILE__, 'timu_wpaihp_active' );


// on deactivate
function timu_wpaihp_deactivate() {
	global $thisismyurl_hotlink_protection_file;
	global $thisismyurl_hotlink_protection_file_hlp;
	
	if (file_exists($thisismyurl_hotlink_protection_file)) {
		
		$fh = fopen($thisismyurl_hotlink_protection_file, 'r');
		$htaccess = fread($fh, filesize($thisismyurl_hotlink_protection_file));
		fclose($fh);

		$htaccess = str_replace($thisismyurl_hotlink_protection_file_hlp,"",$htaccess);

		$fh = fopen($thisismyurl_hotlink_protection_file, 'w') or die("can't open file");
		fwrite($fh, $htaccess);
		fclose($fh);

	}
}
register_deactivation_hook( __FILE__, 'timu_wpaihp_deactivate' );
*/

/*
Sharpen Resized Images by Ünsal Korkmaz (http://unsalkorkmaz.com/ajx-sharpen-resized-images/)
License: GPL v3
*/ 

/*
filter usage:
	add_filter('sharpen_resized_corner',function(){ return -1.2; });
	add_filter('sharpen_resized_side',function(){ return -1; });
	add_filter('sharpen_resized_center',function(){ return 20; });
*/
function ajx_sharpen_resized_files( $resized_file ) {
	
	$image = imagecreatefromstring( file_get_contents( $resized_file ) );
	
	$size = @getimagesize( $resized_file );
	if ( !$size )
		return new WP_Error('invalid_image', __('Could not read image size'), $file);
	list($orig_w, $orig_h, $orig_type) = $size;

	switch ( $orig_type ) {
		case IMAGETYPE_JPEG:
			$matrix = array(
				array(apply_filters('sharpen_resized_corner',-1.2), apply_filters('sharpen_resized_side',-1), apply_filters('sharpen_resized_corner',-1.2)),
				array(apply_filters('sharpen_resized_side',-1), apply_filters('sharpen_resized_center',20), apply_filters('sharpen_resized_side',-1)),
				array(apply_filters('sharpen_resized_corner',-1.2), apply_filters('sharpen_resized_side',-1), apply_filters('sharpen_resized_corner',-1.2)),
			);

			$divisor = array_sum(array_map('array_sum', $matrix));
			$offset = 0; 
			imageconvolution($image, $matrix, $divisor, $offset);
			imagejpeg($image, $resized_file,apply_filters( 'jpeg_quality', 90, 'edit_image' ));
			break;
		case IMAGETYPE_PNG:
			return $resized_file;
		case IMAGETYPE_GIF:
			return $resized_file;
	}	
	
	// we don't need images in memory anymore
	imagedestroy( $image );
	
	return $resized_file;
}	
	
add_filter('image_make_intermediate_size', 'ajx_sharpen_resized_files',900);

/*
Email Address Encoder by Till KrÃ¼ss: (http://tillkruess.com/)
License: GPLv3
*/

/**
 * Copyright 2013 Till KrÃ¼ss  (www.tillkruess.com)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package Email Address Encoder
 * @copyright 2013 Till KrÃ¼ss
 */

/**
 * Define plugin constants that can be overridden, generally in wp-config.php.
 */
if (!defined('EAE_FILTER_PRIORITY'))
	define('EAE_FILTER_PRIORITY', 1000);

/**
 * Register filters to encode exposed email addresses in
 * posts, pages, excerpts, comments and widgets.
 */
foreach (array('the_content', 'the_excerpt', 'widget_text', 'comment_text', 'comment_excerpt') as $filter) {
	add_filter($filter, 'eae_encode_emails', EAE_FILTER_PRIORITY);
}

/**
 * Searches for plain email addresses in given $string and
 * encodes them (by default) with the help of eae_encode_str().
 * 
 * Regular expression is based on based on John Gruber's Markdown.
 * http://daringfireball.net/projects/markdown/
 * 
 * @param string $string Text with email addresses to encode
 * @return string $string Given text with encoded email addresses
 */
function eae_encode_emails($string) {

	// abort if $string doesn't contain a @-sign
	if (apply_filters('eae_at_sign_check', true)) {
		if (strpos($string, '@') === false) return $string;
	}

	// override encoding function with the 'eae_method' filter
	$method = apply_filters('eae_method', 'eae_encode_str');

	// override regex pattern with the 'eae_regexp' filter
	$regexp = apply_filters(
		'eae_regexp',
		'{
			(?:mailto:)?
			(?:
				[-!#$%&*+/=?^_`.{|}~\w\x80-\xFF]+
			|
				".*?"
			)
			\@
			(?:
				[-a-z0-9\x80-\xFF]+(\.[-a-z0-9\x80-\xFF]+)*\.[a-z]+
			|
				\[[\d.a-fA-F:]+\]
			)
		}xi'
	);

	return preg_replace_callback(
		$regexp,
		create_function(
            '$matches',
            'return '.$method.'($matches[0]);'
        ),
		$string
	);

}

/**
 * Encodes each character of the given string as either a decimal
 * or hexadecimal entity, in the hopes of foiling most email address
 * harvesting bots.
 *
 * Based on Michel Fortin's PHP Markdown:
 *   http://michelf.com/projects/php-markdown/
 * Which is based on John Gruber's original Markdown:
 *   http://daringfireball.net/projects/markdown/
 * Whose code is based on a filter by Matthew Wickline, posted to
 * the BBEdit-Talk with some optimizations by Milian Wolff.
 *
 * @param string $string Text with email addresses to encode
 * @return string $string Given text with encoded email addresses
 */
function eae_encode_str($string) {

	$chars = str_split($string);
	$seed = mt_rand(0, (int) abs(crc32($string) / strlen($string)));

	foreach ($chars as $key => $char) {

		$ord = ord($char);

		if ($ord < 128) { // ignore non-ascii chars

			$r = ($seed * (1 + $key)) % 100; // pseudo "random function"

			if ($r > 60 && $char != '@') ; // plain character (not encoded), if not @-sign
			else if ($r < 45) $chars[$key] = '&#x'.dechex($ord).';'; // hexadecimal
			else $chars[$key] = '&#'.$ord.';'; // decimal (ascii)

		}

	}

	return implode('', $chars);

}




