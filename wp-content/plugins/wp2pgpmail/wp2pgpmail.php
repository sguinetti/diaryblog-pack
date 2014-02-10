<?php
/*
Plugin Name: wp2pgpmail
Plugin URI: http://wp2pgpmail.com
Description: A simple PGP Mail Form Plugin for WordPress
Version: 1.16
Author: wp2pgpmail
Author URI: http://wp2pgpmail.com
License:
    Copyright 2010-2013 wp2pgpmail  (e-mail : contact@wp2pgpmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

    This software would not exist without the work done by:
    - Herbert Hanewinkel, http://www.haneWIN.de (OpenPGP Encryption)
    - Drew Phillips, http://www.phpcaptcha.org (Securimage)

    Thanks to you, Folks !
*/

function wp2pgpmail_init(){
	load_plugin_textdomain('wp2pgpmail', false, dirname( plugin_basename( __FILE__ ) ) . '/i18n/');
	require_once 'phpcaptcha/securimage.php';
	$image = new Securimage();
}

function wp2pgpmail_insert() {
	if ( isset($_POST['submitted']) ) {
		$image = new Securimage();
		if ( ( $image->check($_POST['code']) == true || get_option('wp2pgpmail_captcha_field') !== 'enabled' ) && strpos(strip_tags($_POST['text']), "-----BEGIN PGP MESSAGE-----")!==false) {
			$emailTo = get_option("admin_email");
			$subject = '[wp2pgpmail]['.get_bloginfo('name').']'.__('Encrypted PGP Message','wp2pgpmail');
			$body = strip_tags($_POST['text']);
			$headers = 'From: '.get_option('blogname').' <'.$emailTo.'>' . "\r\n";
			wp_mail($emailTo, $subject, $body, $headers);
			return __('Form successfully submitted! The encrypted message has been sent.','wp2pgpmail');
		} else {
			return ( __('The image verification code you entered is incorrect. No message has been sent.','wp2pgpmail').'<br /><a href="'.get_permalink().'">'.__('Please try again.','wp2pgpmail').'</a>');
		}
	} else {
		require_once 'classes/formulaire.inc.php';
		$formulaire = new Formulaire();
		return $formulaire->Output;
	}
}

function wp2pgpmail_settings_page() {
	wp_enqueue_style( 'wp2pgpmail-style', plugins_url( 'wp2pgpmail-pro' ) . '/css/wp2pgpmail-admin.css' );
	if ( get_option('wp2pgpmail_pgpkey')==false || get_option('wp2pgpmail_pgpkey_vers')=='' ) {
		$wp2pgpmail_message_settings = '<br /><font color="#FF0000"><b>'.__('No valid public PGP key has been entered yet.','wp2pgpmail').'</b></font>';
	} else {
		$wp2pgpmail_message_settings = '<br /><font color="#006633"><b>'.__('Your PGP public key has been entered correctly.','wp2pgpmail').'</b></font>';
	}

?>
<script src="<?php echo site_url('/wp-content/plugins/wp2pgpmail/js/rsa.js'); ?>" type="text/javascript"></script> 
<script src="<?php echo site_url('/wp-content/plugins/wp2pgpmail/js/aes-enc.js'); ?>" type="text/javascript"></script> 
<script src="<?php echo site_url('/wp-content/plugins/wp2pgpmail/js/sha1.js'); ?>" type="text/javascript"></script> 
<script src="<?php echo site_url('/wp-content/plugins/wp2pgpmail/js/base64.js'); ?>" type="text/javascript"></script> 
<script src="<?php echo site_url('/wp-content/plugins/wp2pgpmail/js/PGpubkey.js'); ?>" type="text/javascript"></script> 
<script src="<?php echo site_url('/wp-content/plugins/wp2pgpmail/js/mouse.js'); ?>" type="text/javascript"></script> 
<script src="<?php echo site_url('/wp-content/plugins/wp2pgpmail/js/PGencode.js'); ?>" type="text/javascript"></script> 
<script type="text/javascript"> 
 
var keytyp = -1;
var keyid  = '';
var pubkey = '';
 
function getkey() {
	var pu=new getPublicKey(document.s.pubkey.value);
	if(pu.vers == -1) {
		return false;
	} else {
		document.form_enregistrement.wp2pgpmail_pgpkey.value=document.s.pubkey.value;
		
		document.s.vers.value=pu.vers;
		document.form_enregistrement.wp2pgpmail_pgpkey_vers.value=pu.vers;
		
		document.s.user.value=pu.user;
		document.form_enregistrement.wp2pgpmail_pgpkey_user.value=pu.user;
		
		document.s.keyid.value=pu.keyid;
		document.form_enregistrement.wp2pgpmail_pgpkey_keyid.value=pu.keyid;

		pubkey = pu.pkey.replace(/\n/g,'');
		document.s.pkey.value=pubkey;
		document.form_enregistrement.wp2pgpmail_pgpkey_pkey.value=pubkey;
		
		document.s.pktype.value=pu.type;
		document.form_enregistrement.wp2pgpmail_pgpkey_pktype.value=pu.type;
	
		document.form_enregistrement.submit();
	}
}

 
</script>

<div class="wrap">
	<h2><img src="<?php echo site_url('/wp-content/plugins/wp2pgpmail/images/big-icon.png'); ?>" alt="" />wp2pgpmail</h2>

	<h3><?php _e( 'Getting Started' , 'wp2pgpmail'); ?></h3>
	<ol>
		<li><?php _e( 'Enter your PGP public key in the field below on this page.' , 'wp2pgpmail'); ?></li>
		<li><?php _e( 'Add the shortcode <b>[wp2pgpmail]</b> to any Post or Page to display the contact form.' , 'wp2pgpmail'); ?></li>
	</ol>
	<br />
	<h3><?php _e( 'Help Promote wp2pgpmail' , 'wp2pgpmail'); ?></h3>
	<ul id="promote-wp2pgpmail">
		<li id="star"><b><a href="http://wp2pgpmail.com/" target="_blank"><?php _e( "Get wp2pgpmail Pro version with Additional Fields, Unlimited Forms, Nested Drag n' Drop and Advanced Email Configuration!" , 'wp2pgpmail'); ?></a></b></li>
		<li id="twitter"><?php _e( 'Follow us on Twitter' , 'wp2pgpmail'); ?>: <a href="https://twitter.com/#!/wp2pgpmail">@wp2pgpmail</a></li>
		<li id="star"><a href="http://wordpress.org/extend/plugins/wp2pgpmail/"><?php _e( 'Rate wp2pgpmail on WordPress.org' , 'wp2pgpmail'); ?></a></li>
	</ul>
	<br />
	<h3><?php _e('PGP Key Setup', 'wp2pgpmail'); ?></h3>
	<?php _e('Paste your PGP public key in the first field below. By validating, your key will be recognized and the other fields will be automatically filled.', 'wp2pgpmail'); ?>
	<br />
	<?php echo $wp2pgpmail_message_settings; ?>
	<br />
	<form name="s" action="javascript:getkey()"> 
		<table width="600"> 
			<tr>
				<td> 
					<textarea name="pubkey" rows="32" cols="80" style="font-family: Courier, FreeMono, monospace"><?php echo get_option('wp2pgpmail_pgpkey'); ?></textarea>
				</td>
			</tr> 
			<tr>
				<td> 
					<table width="100%">
						<tr>
							<td><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?php _e("Version:",'wp2pgpmail'); ?></font></td>
							<td align="right"><input size="40" name="vers" value="<?php echo get_option('wp2pgpmail_pgpkey_vers'); ?>" readonly /></td>
						</tr> 
						<tr>
							<td><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?php _e("User ID:",'wp2pgpmail'); ?></font></td>
							<td align="right"><input size="40" name="user" value="<?php echo get_option('wp2pgpmail_pgpkey_user'); ?>" readonly /></td>
						</tr> 
						<tr>
							<td><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?php _e("Key ID:",'wp2pgpmail'); ?></font></td>
							<td align="right"><input size="40" name="keyid" value="<?php echo get_option('wp2pgpmail_pgpkey_keyid'); ?>" readonly /></td>
						</tr> 
						<tr>
							<td><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?php _e("Public Key type and values:",'wp2pgpmail'); ?></font></td>
							<td align="right"><input size="40" name="pktype" value="<?php echo get_option('wp2pgpmail_pgpkey_pktype'); ?>" readonly /></td>
						</tr>					 
						<tr>
							<td colspan="2" align="right"><input size="100" name="pkey" value="<?php echo get_option('wp2pgpmail_pgpkey_pkey'); ?>" readonly /></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</form>
	<br />
	<form method="post" action="options.php" name="form_enregistrement">
		<?php settings_fields( 'wp2pgpmail-settings-group' ); ?>
		<input type="hidden" name="wp2pgpmail_pgpkey" value="<?php echo get_option('wp2pgpmail_pgpkey'); ?>" />
		<input type="hidden" name="wp2pgpmail_pgpkey_vers" value="<?php echo get_option('wp2pgpmail_pgpkey_vers'); ?>" />
		<input type="hidden" name="wp2pgpmail_pgpkey_user" value="<?php echo get_option('wp2pgpmail_pgpkey_user'); ?>" />
		<input type="hidden" name="wp2pgpmail_pgpkey_keyid" value="<?php echo get_option('wp2pgpmail_pgpkey_keyid'); ?>" />
		<input type="hidden" name="wp2pgpmail_pgpkey_pktype" value="<?php echo get_option('wp2pgpmail_pgpkey_pktype'); ?>" />
		<input type="hidden" name="wp2pgpmail_pgpkey_pkey" value="<?php echo get_option('wp2pgpmail_pgpkey_pkey'); ?>" />
		<?php _e( 'Captcha field' , 'wp2pgpmail'); ?><br />
		<input type="radio" id="wp2pgpmail_captcha_field_enabled" name="wp2pgpmail_captcha_field" <?php if(get_option('wp2pgpmail_captcha_field') == 'enabled') echo 'checked="checked"'; ?> value="enabled" /><label for="wp2pgpmail_captcha_field_enabled"> <?php _e( 'Yes' )?></label><br />
		<input type="radio" id="wp2pgpmail_captcha_field_disabled" name="wp2pgpmail_captcha_field" <?php if(get_option('wp2pgpmail_captcha_field') == 'disabled') echo 'checked="checked"'; ?> value="disabled" /><label for="wp2pgpmail_captcha_field_disabled"> <?php _e( 'No' )?></label><br />
		<br />
		<?php _e( 'Collect IP address' , 'wp2pgpmail'); ?><br />
		<input type="radio" id="wp2pgpmail_collect_ip_enabled" name="wp2pgpmail_collect_ip" <?php if(get_option('wp2pgpmail_collect_ip') == 'enabled') echo 'checked="checked"'; ?> value="enabled" /><label for="wp2pgpmail_collect_ip_enabled"> <?php _e( 'Yes' )?></label><br />
		<input type="radio" id="wp2pgpmail_collect_ip_disabled" name="wp2pgpmail_collect_ip" <?php if(get_option('wp2pgpmail_collect_ip') == 'disabled') echo 'checked="checked"'; ?> value="disabled" /><label for="wp2pgpmail_collect_ip_disabled"> <?php _e( 'No' )?></label><br />
		<p class="submit">
			<input type="button" onclick="document.s.submit();" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
	</form>
	
	<h3><?php _e( 'Need help?' , 'wp2pgpmail'); ?></h3>
	<ol>
		<li><a href="http://wp2pgpmail.com/about-pgp/"><?php _e( 'Infomation about PGP from wp2pgpmail' , 'wp2pgpmail'); ?></a></li>
		<li><a href="http://wp2pgpmail.com/faq/"><?php _e( 'wp2pgpmail FAQ' , 'wp2pgpmail'); ?></a></li>
		<li><a href="http://wp2pgpmail.com/support/"><?php _e( 'wp2pgpmail Support Ticket System' , 'wp2pgpmail'); ?></a></li>
		<li><a href="http://wordpress.org/tags/wp2pgpmail?forum_id=10"><?php _e( 'wp2pgpmail Forums' , 'wp2pgpmail'); ?></a></li>
	</ol>

</div>
<?php } ?>
<?php
function wp2pgpmail_register_settings() {
	
	//register settings
	register_setting( 'wp2pgpmail-settings-group', 'wp2pgpmail_pgpkey' );
	register_setting( 'wp2pgpmail-settings-group', 'wp2pgpmail_pgpkey_vers' );
	register_setting( 'wp2pgpmail-settings-group', 'wp2pgpmail_pgpkey_user' );
	register_setting( 'wp2pgpmail-settings-group', 'wp2pgpmail_pgpkey_keyid' );
	register_setting( 'wp2pgpmail-settings-group', 'wp2pgpmail_pgpkey_pktype' );
	register_setting( 'wp2pgpmail-settings-group', 'wp2pgpmail_pgpkey_pkey' );
	register_setting( 'wp2pgpmail-settings-group', 'wp2pgpmail_captcha_field' );
	register_setting( 'wp2pgpmail-settings-group', 'wp2pgpmail_collect_ip' );
}

function wp2pgpmail_menu() {
	
	//create new top-level menu
	add_menu_page('wp2pgpmail Options', 'wp2pgpmail', 'administrator', __FILE__, 'wp2pgpmail_settings_page', plugins_url('/images/icon.png', __FILE__));
	add_submenu_page(__FILE__,'wp2pgpmail Options', 'Options', 'administrator', __FILE__,'wp2pgpmail_settings_page');
	
	//call register settings function
	add_action( 'admin_init', 'wp2pgpmail_register_settings' );
}

add_action('init', 'wp2pgpmail_init');
add_action('admin_menu', 'wp2pgpmail_menu');
add_shortcode('wp2pgpmail', 'wp2pgpmail_insert');
