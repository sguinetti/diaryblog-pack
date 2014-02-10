<?php

if ( !function_exists('wp_install_defaults') ) :
/**
 * {@internal Missing Short Description}}
 *
 * {@internal Missing Long Description}}
 *
 * @since 2.1.0
 *
 * @param int $user_id User ID.
 */
function wp_install_defaults($user_id) {
	global $wpdb, $wp_rewrite, $current_site, $table_prefix;
	
	//////////////////////////////////////
	////  WPROLLER ADDED CONFIG 2014-02-09
	//////////////////////////////////////
	update_option('timezone_string','UTC+0');
	
	
	
	
	
	

	// Default category
	$cat_name = __('Uncategorized');
	/* translators: Default category slug */
	$cat_slug = sanitize_title(_x('Uncategorized', 'Default category slug'));

	if ( global_terms_enabled() ) {
		$cat_id = $wpdb->get_var( $wpdb->prepare( "SELECT cat_ID FROM {$wpdb->sitecategories} WHERE category_nicename = %s", $cat_slug ) );
		if ( $cat_id == null ) {
			$wpdb->insert( $wpdb->sitecategories, array('cat_ID' => 0, 'cat_name' => $cat_name, 'category_nicename' => $cat_slug, 'last_updated' => current_time('mysql', true)) );
			$cat_id = $wpdb->insert_id;
		}
		update_option('default_category', $cat_id);
	} else {
		$cat_id = 1;
	}

	$wpdb->insert( $wpdb->terms, array('term_id' => $cat_id, 'name' => $cat_name, 'slug' => $cat_slug, 'term_group' => 0) );
	$wpdb->insert( $wpdb->term_taxonomy, array('term_id' => $cat_id, 'taxonomy' => 'category', 'description' => '', 'parent' => 0, 'count' => 1));
	$cat_tt_id = $wpdb->insert_id;

	
	

	// Default comment
	$first_comment_author = __('Mr WordPress');
	$first_comment_url = 'http://wordpress.org/';
	$first_comment = __('Hi, this is a comment.
To delete a comment, just log in and view the post&#039;s comments. There you will have the option to edit or delete them.');
	if ( is_multisite() ) {
		$first_comment_author = get_site_option( 'first_comment_author', $first_comment_author );
		$first_comment_url = get_site_option( 'first_comment_url', network_home_url() );
		$first_comment = get_site_option( 'first_comment', $first_comment );
	}
	$wpdb->insert( $wpdb->comments, array(
								'comment_post_ID' => 1,
								'comment_author' => $first_comment_author,
								'comment_author_email' => '',
								'comment_author_url' => $first_comment_url,
								'comment_date' => $now,
								'comment_date_gmt' => $now_gmt,
								'comment_content' => $first_comment
								));
	
		// First Page
	$first_page = sprintf( __( "This is an example page. It's different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:

<blockquote>Hi there! I'm a bike messenger by day, aspiring actor by night, and this is my blog. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin' caught in the rain.)</blockquote>

...or something like this:

<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>

As a new WordPress user, you should go to <a href=\"%s\">your dashboard</a> to delete this page and create new pages for your content. Have fun!" ), admin_url() );
	if ( is_multisite() )
		$first_page = get_site_option( 'first_page', $first_page );
	$first_post_guid = get_option('home') . '/?page_id=2';
	$wpdb->insert( $wpdb->posts, array(
								'post_author' => $user_id,
								'post_date' => $now,
								'post_date_gmt' => $now_gmt,
								'post_content' => $first_page,
								'post_excerpt' => '',
								'post_title' => __( 'Sample Page' ),
								/* translators: Default page slug */
								'post_name' => __( 'sample-page' ),
								'post_modified' => $now,
								'post_modified_gmt' => $now_gmt,
								'guid' => $first_post_guid,
								'post_type' => 'page',
								'to_ping' => '',
								'pinged' => '',
								'post_content_filtered' => ''
								));
	$wpdb->insert( $wpdb->postmeta, array( 'post_id' => 2, 'meta_key' => '_wp_page_template', 'meta_value' => 'default' ) );

	// Set up default widgets for default theme.
	update_option( 'widget_search', array ( 2 => array ( 'title' => '' ), '_multiwidget' => 1 ) );
	update_option( 'widget_recent-posts', array ( 2 => array ( 'title' => '', 'number' => 5 ), '_multiwidget' => 1 ) );
	update_option( 'widget_recent-comments', array ( 2 => array ( 'title' => '', 'number' => 5 ), '_multiwidget' => 1 ) );
	update_option( 'widget_archives', array ( 2 => array ( 'title' => '', 'count' => 0, 'dropdown' => 0 ), '_multiwidget' => 1 ) );
	update_option( 'widget_categories', array ( 2 => array ( 'title' => '', 'count' => 0, 'hierarchical' => 0, 'dropdown' => 0 ), '_multiwidget' => 1 ) );
	update_option( 'widget_meta', array ( 2 => array ( 'title' => '' ), '_multiwidget' => 1 ) );
	update_option( 'sidebars_widgets', array ( 'wp_inactive_widgets' => array ( ), 'sidebar-1' => array ( 0 => 'search-2', 1 => 'recent-posts-2', 2 => 'recent-comments-2', 3 => 'archives-2', 4 => 'categories-2', 5 => 'meta-2', ), 'sidebar-2' => array ( ), 'sidebar-3' => array ( ), 'array_version' => 3 ) );

	if ( ! is_multisite() )
		update_user_meta( $user_id, 'show_welcome_panel', 1 );
	elseif ( ! is_super_admin( $user_id ) && ! metadata_exists( 'user', $user_id, 'show_welcome_panel' ) )
		update_user_meta( $user_id, 'show_welcome_panel', 2 );

	if ( is_multisite() ) {
		// Flush rules to pick up the new page.
		$wp_rewrite->init();
		$wp_rewrite->flush_rules();

		$user = new WP_User($user_id);
		$wpdb->update( $wpdb->options, array('option_value' => $user->user_email), array('option_name' => 'admin_email') );

		// Remove all perms except for the login user.
		$wpdb->query( $wpdb->prepare("DELETE FROM $wpdb->usermeta WHERE user_id != %d AND meta_key = %s", $user_id, $table_prefix.'user_level') );
		$wpdb->query( $wpdb->prepare("DELETE FROM $wpdb->usermeta WHERE user_id != %d AND meta_key = %s", $user_id, $table_prefix.'capabilities') );

		// Delete any caps that snuck into the previously active blog. (Hardcoded to blog 1 for now.) TODO: Get previous_blog_id.
		if ( !is_super_admin( $user_id ) && $user_id != 1 )
			$wpdb->delete( $wpdb->usermeta, array( 'user_id' => $user_id , 'meta_key' => $wpdb->base_prefix.'1_capabilities' ) );
	}
}
endif;

?>