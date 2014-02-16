<?php
/*
Plugin Name: MD5 Media Renamer
Plugin URI: http://wordpress.org/plugins/md5-media-renamer/
Description: Sanitize and rename automatically media files during upload using PHP time() as prefix and the file name encrypted in MD5() as suffix.
Version: 1.5
Author: Natexim Concept
Author URI: http://www.natexim.com/wp-rename-file-during-upload/

Copyright 2013 Natexim Concept  (email : contact@natexim.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Prevent the file to be accessed directly
// ----------------------------------------
if('md5-media-renamer.php' == basename($_SERVER['SCRIPT_FILENAME']))
{
	die('You cannot access this file directly ...');
}

// Check for WP context
// --------------------
if(!defined('ABSPATH')) { die(); }

// Define Constants
// ----------------
define('ML79_PLUGIN_URL',				plugins_url().'/md5-media-renamer');
define('ML79_PLUGIN_DIR',				plugin_dir_path(__FILE__));
define('ML79_PLUGIN_FILE', 				__FILE__);
define('ML79_PLUGIN_NAME',				'MD5-Media Renamer');
define('ML79_PLUGIN_VERSION',			'1.5');
define('ML79_PLUGIN_AUTHOR_NAME',		'Natexim Concept');
define('ML79_PLUGIN_AUTHOR_URL',		'http://www.natexim.com');
define('ML79_PLUGIN_AUTHOR_SCREEN',		'www.natexim.com');
define('ML79_PLUGIN_EMAIL',				get_bloginfo('admin_email'));

// Check file extension
// --------------------
if(!function_exists('ML79_fileExtension'))
{
	function ML79_fileExtension($String)
	{
		$i = strrpos($String,".");
		if(!$i)
		{
			return "";
		}
		$Case = strlen($String) - $i;
		$Exts = substr($String, $i+1, $Case);
		return $Exts;
	}
}

// Send e-Mail
// ------------
if(!function_exists('ML79_sendMail'))
{
	function ML79_sendMail($SendFor,$Subject,$MessageText,$MessageHTML)
	{
		$Divider = '-----=' . md5(uniqid(mt_rand()));

		$Headers = 'From: "'.get_bloginfo('name').'" <'.$SendFor.'>'."\n";
		$Headers.= 'Return-Path: <'.$SendFor.'>'."\n";
		$Headers.= 'MIME-Version: 1.0'."\n";
		$Headers.= 'X-Mailer: PHP/'.phpversion()."\n";		
		$Headers.= 'Content-Type: multipart/alternative; boundary="'.$Divider.'"';

		// Message Text
		// ------------
		$Message = 'This is a multi-part message in MIME format.'."\n\n";
		$Message.= '--'.$Divider."\n";
		$Message.= 'Content-Type: text/plain; charset="iso-8859-1"'."\n";
		$Message.= 'Content-Transfer-Encoding: 8bit'."\n\n";
		$Message.= $MessageText."\n\n";

		// Message HTML
		// ------------
		$Message.= '--'.$Divider."\n";
		$Message.= 'Content-Type: text/html; charset="iso-8859-1"'."\n";
		$Message.= 'Content-Transfer-Encoding: 8bit'."\n\n";
		$Message.= $MessageHTML."\n\n";
		$Message.= '--'.$Divider."\n";

		mail($SendFor,$Subject,$Message,$Headers);
	}
}

// Execute the rename function during upload
// -----------------------------------------
if(!function_exists('ML79_md5_media_renamer'))
{
	function ML79_md5_media_renamer($fileName) 
	{
		$Exts = ML79_fileExtension($fileName);
		$Exts = strtolower($Exts);
		
		if(($Exts == "jpg") || ($Exts == "jpeg") || ($Exts == "png") || ($Exts == "gif") || ($Exts == "pdf") || ($Exts == "doc") || ($Exts == "docx") || 
		($Exts == "ppt") || ($Exts == "pptx") || ($Exts == "pps") || ($Exts == "ppsx") || ($Exts == "odt") || ($Exts == "xls") || ($Exts == "xlsx") || 
		($Exts == "mp3") || ($Exts == "m4a") || ($Exts == "ogg") || ($Exts == "wav") || ($Exts == "mp4") || ($Exts == "m4v") || ($Exts == "mov") || 
		($Exts == "wmv") || ($Exts == "avi") || ($Exts == "mpg") || ($Exts == "ogv") || ($Exts == "3gp") || ($Exts == "3g2"))
		{
			$fileName = time().'-'.md5($fileName).'.'.$Exts;
		}
		return strtolower($fileName);
	}
	add_filter('sanitize_file_name', 'ML79_md5_media_renamer', 10);
}

// Send a welcome notice
// ---------------------
if(!function_exists('ML79_welcomeNotice'))
{
	function ML79_welcomeNotice()
	{
		$SendFor = ML79_PLUGIN_EMAIL;
		$Subject = __('Thank you for installing '.ML79_PLUGIN_NAME.' v'.ML79_PLUGIN_VERSION.'', 'imRobot');

		require(ML79_PLUGIN_DIR.'notices/notice-activate.php');
		ML79_sendMail($SendFor,$Subject,$MessageText,$MessageHTML);	
	}
}

// Callback function on activation
// -------------------------------
register_activation_hook(ML79_PLUGIN_FILE, 'ML79_welcomeNotice');

?>