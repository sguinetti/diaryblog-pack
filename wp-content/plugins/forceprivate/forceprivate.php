<?php
/*
Plugin Name: ForcePrivate
Description: Force all posts by users without Editor or higher role to be private
Version: 1.1
Author: Elliott Bristow
Author URI: http://jigsawspain.com

Copyright 2013 Jigsaw Spain (http://jigsawspain.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License (Version 3 - GPLv3) as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/* INCLUDES */
require_once 'functions/functions.php';
require_once 'functions/options-page.php';

add_action('admin_menu', 'force_private_admin_menu'); // Create Settings submenu
add_action( 'admin_init', 'force_private_settings' ); // Register Settings

add_filter('wp_insert_post_data', 'force_private_post', '99', 2); // ALL Posts
add_action('wp_insert_post', 'force_private_new_post'); // Only New Posts

?>