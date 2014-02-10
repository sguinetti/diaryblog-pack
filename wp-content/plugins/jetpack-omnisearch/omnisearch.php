<?php

/*
 * Plugin Name: Jetpack Omnisearch
 * Plugin URI: http://wordpress.org/plugins/jetpack-omnisearch/
 * Description: A single search box, that lets you search many different things. <a href="admin.php?page=omnisearch">Start Searching</a>
 * Author: Anas H. Sulaiman
 * Version: 2.7
 * Author URI: http://ahs.pw/
 * Text Domain: jetpack-omnisearch
 * Domain Path: /languages/
 * License: GPL2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Module Name: Omnisearch
 * Module Description: A single search box, that lets you search many different things.
 * Sort Order: 8
 * First Introduced: 2.3
 * Requires Connection: No
 * Auto Activate: Yes
 */

// Only do Jetpack Omnisearch if there isn't already a Core WP_Omnisearch Class.
if ( ! class_exists( 'WP_Omnisearch' ) )
	require_once( dirname( __FILE__ ) . '/omnisearch/omnisearch-core.php' );

add_action( 'plugins_loaded', 'omnisearch_load_textdomain' ); // Edited by Anas H. Sulaiman
function omnisearch_load_textdomain() {
	load_plugin_textdomain( 'jetpack-omnisearch', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
} // Edited by Anas H. Sulaiman

/*
* Edits are denoted by the comment: Edited by Anas H. Sulaiman.
* Other edits are listed here:
* Edit 1: 
*/
