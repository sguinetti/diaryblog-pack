<?php
/** 
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

define('DB_NAME', 'agendaword');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_HOST', 'localhost');


define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

/* Auth keys */
define('AUTH_KEY',         'r,a+c5F9s!abE8}@S9:+|4+##p>-5$t/_(+&|,~U;I9LI`Sf@z-xx?S*K.p|K,:`');
define('SECURE_AUTH_KEY',  'fC)KTtqef62A7%fGe:+)ULQ//[Vi0#6T ~_!(LDK%iBwBe;K~,ROU0P{0(+6K1^#');
define('LOGGED_IN_KEY',    'CJC5if*6o2ATB>tT+-:~8_p=.K}JZt|8+Hwc?;8iJ<V@z-jwouzYv{7Ld^d0v_$u');
define('NONCE_KEY',        '3lhrI:94G?P+<QDdJtZ-6C97Wtv{3@pn{oP*3|H$3fj:qqSJwOh@v.oT;X%4jkut');
define('AUTH_SALT',        '_kw%%*#dDF}5j2|Zbn{$j[ Jj*t:CJ!fBLTkCwcGHx6|{9@I6MH1EPJ,k|E_jJ3-');
define('SECURE_AUTH_SALT', '4r0ryX.F$MiV~:1H_>u4L*^d-lnxSb,5=OnJ-{<IBZl|yA6V6s}w3x(5i[5N5{|`');
define('LOGGED_IN_SALT',   '8H=:YWWSvtAF#)`UOq@bV,kUU+q+D=b$-(f]mC^1m|Q,hSRp5C(75QTz5<}F#j`#');
define('NONCE_SALT',       'U60RhBj0l>#uyaKHoWq-gKI45qgE>)$%G.w6nCT&-Tv}@bZqFO!|iPQ3_-!4<-yi');
/**#@-*/

/* Wordpress database prefix */
$table_prefix  = 'wp_';

define('WPLANG', 'en_US');

/**
Debug mode
 */
define('WP_DEBUG', false);

/** Patch */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
