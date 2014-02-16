<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'agendaword');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'root');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '`-@vdeBl]hq_,54g<y|yjE&Y]P*_$(Rk_Nkb%vl}~*LQ=_z*yaHV+-z.@@&f8Ps)'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_KEY', '9V4:xA?vr8VN9,zf=RdOCO(Zsh|O!QG7u#YW!3DA@qO?W].8dN(^J/#L&lZV:dEx'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_KEY', 'hbpa3o Uxh;?U|pB0:x9fyEDQ9g E6M?WTRdy`Bw`*dV!JN{awd:+.Sv9ghqitU)'); // Cambia esto por tu frase aleatoria.
define('NONCE_KEY', 'vj3#b8yH?3hoSl[+;zS@Fy9H[iB?Q,cd?&CknM^S-nDV_!F[lk)>a6#|= sEkI!M'); // Cambia esto por tu frase aleatoria.
define('AUTH_SALT', 'ubN(0[u-)S4J|d+Bq;EV*dyZF]mSGA}?I<(*wV*p_,nDmF2&:OnF),zp>a_u jA4'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_SALT', 'O$r)%0G_+/l+:yaBS5E]*h5 L*<QFchH58vvtv:q|C0d0eUXOrIW:?]/]x[u8|wT'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_SALT', 'm??,E&/N?u8B#=o.mV~-[1+CA,iAR,,w-,Kh8Plx+SCi@_&YYF|Y59F0Xg~l)lNS'); // Cambia esto por tu frase aleatoria.
define('NONCE_SALT', '}QSC,`-,E#6<^L:83*rg)=K[]&$-QR`GBE?TwD}?JNnu_Jd=p~uo>~1rKevIs6|2'); // Cambia esto por tu frase aleatoria.

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';

/**
 * Idioma de WordPress.
 *
 * Cambia lo siguiente para tener WordPress en tu idioma. El correspondiente archivo MO
 * del lenguaje elegido debe encontrarse en wp-content/languages.
 * Por ejemplo, instala ca_ES.mo copiándolo a wp-content/languages y define WPLANG como 'ca_ES'
 * para traducir WordPress al catalán.
 */
define('WPLANG', 'es_ES');

/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
