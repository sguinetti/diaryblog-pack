<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * About Box
 *
 * Show more information about the plugin, incl. support & docs links.
 *
 * @package WPSocial SEO Booster
 * @since 1.0.0
 */	
 ?>
 
<!-- beginning of the about meta box -->
<div id="wps-seo-booster-about" class="post-box-container">
	<div class="metabox-holder">
		<div class="meta-box-sortables ui-sortable">
			<div id="about" class="postbox">	
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wpsseo' ); ?>"><br /></div>
									
					<h3 class="hndle">
						<span style="vertical-align: top;"><?php esc_attr_e( 'WPSocial', 'wpsseo' ); ?></span>
					</h3>
									
					<div class="inside">
								
						<table class="form-table">
							<tr>
								<th>
									<?php _e( 'Plugin:', 'wpsseo' ); ?>
								</th>
								<td>
									<a href="http://wpsocial.com/product/wp-social-seo-booster-pro/" title="<?php _e( 'WP Social SEO Booster Pro', 'wpsseo' ); ?>" target="_blank"><?php _e( 'WP Social SEO Booster Pro', 'wpsseo' ); ?></a>
								</td>
							</tr>
									
							<tr>
								<th>
									<?php _e( 'Version:', 'wpsseo' ); ?>
								</th>
								<td>
									<?php echo WPS_SEO_BOOSTER_VERSION; ?>
								</td>
							</tr>
									
							<tr>
								<th>
									<?php _e( 'Author:', 'wpsseo' ); ?>
								</th>
								<td>
									<?php _e( 'Daniel Waser', 'wpsseo' ); ?>
								</td>
							</tr>
									
							<tr>
								<th>
									<?php _e( 'Support:', 'wpsseo' ); ?>
								</th>
								<td>
									<p>
										<?php _e( 'If you have issues with this plugin, please let us know about it here:', 'wpsseo' ); ?>
										<a href="http://wordpress.org/support/plugin/wp-social-seo-booster" target="_blank"><?php _e( 'Support Forum', 'wpsseo' ); ?></a>
									</p>
								</td>
							</tr>
							
							<tr>
								<th>
									<?php _e( 'Documentation:', 'wpsseo' ); ?>
								</th>
								<td>
									<p>
										<?php _e( 'Not quite sure how to use the plugin? Visit our Knowledge Base to learn how to use it properly.', 'wpsseo' ); ?>	
										<a href="http://support.wpsocial.com/support/home" target="_blank"><?php _e( 'WP Social Knowledge Base', 'wpsseo' ); ?></a>
									</p>
								</td>
							</tr>
						</table><!-- .form-table -->
											
					</div><!-- .inside -->
									
			</div><!-- #about -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #wps-seo-booster-about -->
<!-- end of the about meta box -->