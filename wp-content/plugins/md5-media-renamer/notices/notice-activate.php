<?php
/*
// =====================================
// Developed by : Natexim Group
// Copyright : 2013 © All right Reserved
// Contact : contact@natexim.com
// Website : http://www.natexim.com
// =====================================
*/

/* 
-----------------------
Activation Notification
-----------------------
*/

$MessageText = 'Dear Administrator,'."\n\n";
$MessageText.= 'Thank you for installing '.ML79_PLUGIN_NAME.' v'.ML79_PLUGIN_VERSION.'. We hope you enjoy this plugin features, you can also visit our website '.ML79_PLUGIN_AUTHOR_URL.' for further information about us.'."\n\n";
$MessageText.= 'If you have found this plugin to be useful, please consider a small donation. Your kind contribution will help me afford more time on plugins development and pay for running costs.'."\n\n";
$MessageText.= 'PayPal Link : https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=4VCTGXKKGBYW4&lc=US&item_name=MD5-Media Renamer&item_number=md5-media-renamer&amount=2.00&currency_code=USD&button_subtype=services&no_note=1&no_shipping=1&bn=PP-BuyNowBF:button-paypal.png:NonHosted'."\n";
$MessageText.= 'If you would like to support my plugins development in other ways, here are some ideas :'."\n";
$MessageText.= 'Tell your family, friends, and colleagues about '.ML79_PLUGIN_AUTHOR_URL."\n";
$MessageText.= 'Follow us on our social network Like Facebook, Twitter, Google+ etc ... All our page are links with Bookmark icons to the most popular social network sites like Facebook, Twitter, Delicious, Google+, Linkedin, Blogger, StumbleUpon, Tumblr and Wordpress.'."\n";
$MessageText.= 'If you own a web site or blog, consider adding a link to our home page, or to specific articles.'."\n";
$MessageText.= 'Please feel free to contact us if any special requirements,'."\n";
$MessageText.= 'Wish you a nice day,'."\n";
$MessageText.= '--'."\n";
$MessageText.= ML79_PLUGIN_AUTHOR_NAME."\n";
$MessageText.= ML79_PLUGIN_AUTHOR_SCREEN."\n";
$MessageText.= '--'."\n";

$MessageHTML = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Reset Password</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
	<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width= "650" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFF" style="border:5px solid #353535;">
					<tr>
						<td align="left" valign="top">
							<table width="650" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #CCCCCC;">
								<tr>
									<td width="275" align="left" valign="middle" style="padding:15px;"><img src="'.ML79_PLUGIN_URL.'/cpanel/images/notices/logo.png" alt="Logo" width="310px" height="52px" /></td>
									<td width="255" align="right" valign="middle" style="font-family:Arial;color:#555555;padding:15px;"><h3 style="margin:2px;">Notification</h2><span>'.date('j F Y').'</span></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td align="left" valign="top">
							<table width="650" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td colspan="3" width="100%" height="30"><img src="'.ML79_PLUGIN_URL.'/cpanel/images/notices/blank.gif" width="1" height="1" /></td>
								</tr>
								<tr>
									<td width="30"><img src="'.ML79_PLUGIN_URL.'/cpanel/images/notices/blank.gif" width="1" height="1" /></td>
									<td width="590">
										<p style="font-family:Arial;font-size:20px;margin-bottom:0.5em;margin-top:0;">Dear Administrator,</p>
									</td>
									<td width="30"><img src="'.ML79_PLUGIN_URL.'/cpanel/images/notices/blank.gif" width="1" height="1" /></td>
								</tr>            
								<tr>
									<td width="30"><img src="'.ML79_PLUGIN_URL.'/cpanel/images/notices/blank.gif" width="1" height="1" /></td>
									<td width="590" style="font-family:Arial;font-size:14px;padding-bottom:15px;">
										<p align="justify" style="font-family:Arial;font-size:12px;text-align:justify;">Thank you for installing <b>'.ML79_PLUGIN_NAME.' v'.ML79_PLUGIN_VERSION.'</b>. We hope you enjoy this plugin features, you can also visit our website '.ML79_PLUGIN_AUTHOR_SCREEN.' for further information about us.</p>
										<p align="justify" style="font-family:Arial;font-size:12px;text-align:justify;">If you have found this plugin to be useful, please consider a small donation. Your kind contribution will help me afford more time on plugins development and pay for running costs. To make a donation click on the below button.</p>
										<p align="justify" style="font-family:Arial;font-size:12px;text-align:justify;"><a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=4VCTGXKKGBYW4&lc=US&item_name=MD5-Media Renamer&item_number=md5-media-renamer&amount=2.00&currency_code=USD&button_subtype=services&no_note=1&no_shipping=1&bn=PP-BuyNowBF:button-paypal.png:NonHosted"><img src="'.ML79_PLUGIN_URL.'/cpanel/images/notices/button-paypal.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" /></a></p>
										<p align="justify" style="font-family:Arial;font-size:12px;text-align:justify;">Or if the above link doesn&#039;t work properly, <a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=4VCTGXKKGBYW4&lc=US&item_name=MD5-Media Renamer&item_number=md5-media-renamer&amount=2.00&currency_code=USD&button_subtype=services&no_note=1&no_shipping=1&bn=PP-BuyNowBF:button-paypal.png:NonHosted">click-here</a>.</p>
										<p align="justify" style="font-family:Arial;font-size:12px;text-align:justify;">If you would like to support my plugins development in other ways, here are some ideas :</p>
										<p align="justify" style="font-family:Arial;font-size:12px;text-align:justify;">Tell your family, friends, and colleagues about <a target="_blank" href="'.ML79_PLUGIN_AUTHOR_URL.'">'.ML79_PLUGIN_AUTHOR_SCREEN.'</a>.</p>
										<p align="justify" style="font-family:Arial;font-size:12px;text-align:justify;">Follow us on our social network Like Facebook, Twitter, Google+ etc ... All our page are links with Bookmark icons to the most popular social network sites like Facebook, Twitter, Delicious, Google+, Linkedin, Blogger, StumbleUpon, Tumblr and Wordpress.</p>
										<p align="justify" style="font-family:Arial;font-size:12px;text-align:justify;">If you own a web site or blog, consider adding a link to our home page, or to specific articles.</p>
										<p align="justify" style="font-family:Arial;font-size:12px;text-align:justify;">Please feel free to contact us if any special requirements,</p>
										<p align="justify" style="font-family:Arial;font-size:12px;text-align:justify;">Wish you a nice day,</p>
										<p align="justify" style="font-family:Arial;font-size:12px;text-align:justify;"><b>'.ML79_PLUGIN_AUTHOR_NAME.'</b><br /><a target="_blank" href="'.ML79_PLUGIN_AUTHOR_URL.'">'.ML79_PLUGIN_AUTHOR_SCREEN.'</a></p>
										<p align="justify" style="font-family:Arial;font-size:12px;text-align:justify;"><img src="'.ML79_PLUGIN_URL.'/cpanel/images/notices/blank.gif" width="1" height="1" /></p>
									</td>
									<td width="30"><img src="'.ML79_PLUGIN_URL.'/cpanel/images/notices/blank.gif" width="1" height="1" /></td>
								</tr>
								<tr>
									<td width="30"><img src="'.ML79_PLUGIN_URL.'/cpanel/images/notices/blank.gif" width="1" height="1" /></td>
									<td width="590">
										<table width="590" border="0" cellspacing="0" cellpadding="0" bgcolor="#EFFAF" style="border: 1px solid #C4E4F2;">
											<tr>
												<td align="center" style="padding-top:10px;padding-bottom:7px;">
													<a target="_blank" href="http://www.facebook.com/pages/Natexim-Concept/159183970787968/"><img src="'.ML79_PLUGIN_URL.'/cpanel/images/notices/facebook.png" alt="Facebook" width="32px" height="32px" /></a>
												</td>
												<td align="center" style="padding-top:10px;padding-bottom:7px;">
													<a target="_blank" href="https://twitter.com/natexim"><img src="'.ML79_PLUGIN_URL.'/cpanel/images/notices/twitter.png" alt="Twitter" width="32px" height="32px" /></a>
												</td>												
												<td align="center" style="padding-top:10px;padding-bottom:7px;">
													<a target="_blank" href="https://delicious.com/natexim/"><img src="'.ML79_PLUGIN_URL.'/cpanel/images/notices/delicious.png" alt="Delicious" width="32px" height="32px" /></a>
												</td>
												<td align="center" style="padding-top:10px;padding-bottom:7px;">
													<a target="_blank" href="https://plus.google.com/103803505482805746638/"><img src="'.ML79_PLUGIN_URL.'/cpanel/images/notices/googleplus.png" alt="Google" width="32px" height="32px" /></a>
												</td>
												<td align="center" style="padding-top:10px;padding-bottom:7px;">
													<a target="_blank" href="http://th.linkedin.com/in/natexim/"><img src="'.ML79_PLUGIN_URL.'/cpanel/images/notices/linkedin.png" alt="Linkedin" width="32px" height="32px" /></a>
												</td>
												<td align="center" style="padding-top:10px;padding-bottom:7px;">
													<a target="_blank" href="http://natexim.blogspot.com/"><img src="'.ML79_PLUGIN_URL.'/cpanel/images/notices/blogger.png" alt="Blogger" width="32px" height="32px" /></a>
												</td>
												<td align="center" style="padding-top:10px;padding-bottom:7px;">
													<a target="_blank" href="http://www.stumbleupon.com/stumbler/natexim/"><img src="'.ML79_PLUGIN_URL.'/cpanel/images/notices/stumble.png" alt="StumbleUpon" width="32px" height="32px" /></a>
												</td>
												<td align="center" style="padding-top:10px;padding-bottom:7px;">
													<a target="_blank" href="http://natexim.tumblr.com/"><img src="'.ML79_PLUGIN_URL.'/cpanel/images/notices/tumblr.png" alt="Tumblr" width="32px" height="32px" /></a>
												</td>
												<td align="center" style="padding-top:10px;padding-bottom:7px;">
													<a target="_blank" href="http://natexim.wordpress.com/"><img src="'.ML79_PLUGIN_URL.'/cpanel/images/notices/wordpress.png" alt="Wordpress" width="32px" height="32px" /></a>
												</td>												
												<td align="center" style="padding-top:10px;padding-bottom:7px;">
													<a target="_blank" href="http://www.natexim.com/feed/"><img src="'.ML79_PLUGIN_URL.'/cpanel/images/notices/rss.png" alt="RSS Feed" width="32px" height="32px" /></a>
												</td>
											</tr>
										</table>
									</td>
									<td width="30"><img src="'.ML79_PLUGIN_URL.'/cpanel/images/notices/blank.gif" width="1" height="1" /></td>
								</tr>
								<tr>
									<td colspan="3" width="100%" height="30"><p style="margin:5px;"><img src="'.ML79_PLUGIN_URL.'/cpanel/images/notices/blank.gif" width="1" height="1" /></p></td>
								</tr>								
							</table>
						</td>
					</tr>
				</table>
				<p align="center" style="font-family:Arial;font-size:11px;margin:5px;">Copyright &copy; 2013 - All Right Reserved <a target="_blank" title="'.ML79_PLUGIN_AUTHOR_NAME.'" href="'.ML79_PLUGIN_AUTHOR_URL.'/">'.ML79_PLUGIN_AUTHOR_NAME.'</a></p>
			</td>
		</tr>
	</table>
</body>
</html>';

?>