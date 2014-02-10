<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

	$lang = get_bloginfo( 'language' ); 
	
	$wps_feed_url = '';
	$wps_seo_url = '';
	$wps_fb_url = '';
	$wps_gp_url = '';
	$wps_tw_url = '';
	
	$wps_feed_url = '//wpsocial.com/feed';
	$wps_seo_url = '//wpsocial.com/product/wp-social-seo-booster-pro/';
	$wps_fb_url = '//facebook.com/WPSocial';
	$wps_gp_url = '//plus.google.com/105389611532237339285/posts';
	$wps_tw_url = 'wpsocial';

	// Get RSS Feed(s)
	include_once(ABSPATH . WPINC . '/feed.php');

	// Get a SimplePie feed object from the specified feed source.
	$rss = fetch_feed( 'http://wpsocial.com/feed/' );
	if ( !is_wp_error( $rss ) ) : // Checks that the object is created correctly 
    
	// Figure out how many total items there are, but limit it to 5. 
    $maxitems = $rss->get_item_quantity(5); 

    // Build an array of all the items, starting with element 0 (first element).
    $rss_items = $rss->get_items(0, $maxitems); 
	endif;
	
/**
 * Feed Box
 *
 * Shows a meta box with the latest news from wpsocial.com taken from the feed.
 *
 * @package WPSocial SEO Booster
 * @since 1.0.0
 */	
 ?>

<!-- beginning of the feed meta box -->
<div id="wps-seo-booster-feed" class="post-box-container">
	<div class="metabox-holder">	
		<div class="meta-box-sortables ui-sortable">
			<div id="feed" class="postbox">	
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wpsseo' ); ?>"><br /></div>
									
					<h3 class="hndle">
						<span style="vertical-align: top;"><?php esc_attr_e( 'Latest News from WPSocial.com', 'wpsseo' ); ?></span>
					</h3>
									
					<div class="inside">
								
						<table class="form-table">
							<tr valign="top">
								<td>
									<ul <?php if ( $maxitems == 0 ) { echo ''; } else { echo 'style="margin-top: -16px;"'; } ?>">
										<?php 
											if ( $maxitems == 0 ) echo '<li>' . __( 'No items.', 'wpsseo' ) . '</li>';
											else
											
											// Loop through each feed item and display each item as a hyperlink.
											foreach ( $rss_items as $item ) : 
										?>
											<li>
												<div class="icon-option">
													<a href='<?php echo esc_url( $item->get_permalink() ); ?>' title='<?php echo 'Posted '.$item->get_date('j F Y | g:i a'); ?>'><img src="<?php echo WPS_SEO_BOOSTER_URL . 'includes/images/icons/wps.png'; ?>" alt="WPSocial News" title="<?php echo 'Posted '.$item->get_date('j F Y | g:i a'); ?>" />									
													<?php echo esc_html( $item->get_title() ); ?></a>
												</div>
											</li>
										<?php endforeach; ?>
									</ul>
								</td>
							</tr>
							
							<tr>
								<td valign="middle">
									<div class="icon-option"><a href="<?php echo esc_url_raw( $wps_fb_url ); ?>" target="_blank"><img src="<?php echo WPS_SEO_BOOSTER_URL . 'includes/images/icons/facebook.png'; ?>" alt="WP Social Facebook" title="<?php _e( 'Like WP Social on Facebook', 'wpsseo' ); ?>" /><?php _e( 'Like WP Social on Facebook', 'wpsseo' ); ?></a></div>
									<div class="icon-option"><a href="<?php echo esc_url_raw( $wps_gp_url ); ?>" target="_blank"><img src="<?php echo WPS_SEO_BOOSTER_URL . 'includes/images/icons/google-plus.png'; ?>" alt="WP Social Google+" title="<?php _e( 'Circle WP Social on Google+', 'wpsseo' ); ?>" /><?php _e( 'Circle WP Social on Google+', 'wpsseo' ); ?></a></div>
									<div class="icon-option"><a href="//twitter.com/<?php echo esc_attr_e( $wps_tw_url ); ?>" target="_blank"><img src="<?php echo WPS_SEO_BOOSTER_URL . 'includes/images/icons/twitter.png'; ?>" alt="WP Social Twitter" title="<?php _e( 'Follow WP Social on Twitter', 'wpsseo' ); ?>" /><?php _e( 'Follow WP Social on Twitter', 'wpsseo' ); ?></a></div>
									<div class="icon-option"><a href="<?php echo esc_url_raw( $wps_feed_url ); ?>" target="_blank"><img src="<?php echo WPS_SEO_BOOSTER_URL . 'includes/images/icons/rss.png'; ?>" alt="Subscribe with RSS" title="<?php _e( 'Subscribe with RSS', 'wpsseo' ); ?>" /><?php _e( 'Subscribe with RSS', 'wpsseo' ); ?></a></div>
									<div class="icon-option"><a href="http://wpsocial.com/wp-social-updates-discounts/?c4Le" target="_blank"><img src="<?php echo WPS_SEO_BOOSTER_URL . 'includes/images/icons/email.png'; ?>" alt="Subscribe by email" title="<?php _e( 'Subscribe by email', 'wpsseo' ); ?>" /><?php _e( 'Subscribe by email', 'wpsseo' ); ?></a></div>
									<div class="clear"></div>
								</td>
							</tr>
									
						</table><!-- .form-table -->
											
					</div><!-- .inside -->
									
			</div><!-- #feed -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #wps-seo-booster-feed -->
<!-- end of the feed meta box -->		