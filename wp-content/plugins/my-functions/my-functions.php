<?php
/*
Plugin Name: My Functions
Plugin URI: 
Description: The parameters that can not fit offsite in a unique and highly secure customizable plugin.
Tags: stable, easyuse, particular, private, functions
Version: 2014.222
Author: Diego Sanguinetti
Author URI: 
Contributors: slangjis, Christopher Ross
Editor URI: http://slangji.wordpress.com/
Requires at least: 3.8
Tested up to: 7.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Indentation: GNU style coding standard
Indentation URI: http://www.gnu.org/prep/standards/standards.html
Note: Thanks in readme.txt file 	
  */

add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}

/* Change post option name
function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Noticias';
    $submenu['edit.php'][5][0] = 'Noticias';
    $submenu['edit.php'][10][0] = 'Añadir noticias';
    $submenu['edit.php'][16][0] = 'Etiquetas de noticia';
    echo '';
}

function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Notes';
    $labels->singular_name = 'Note';
    $labels->add_new = 'Add notes';
    $labels->add_new_item = 'Add new note';
    $labels->edit_item = 'Edit note';
    $labels->new_item = 'New note';
    $labels->view_item = 'View note';
    $labels->search_items = 'Search note';
    $labels->not_found = 'Note not found';
    $labels->not_found_in_trash = 'Note not found in trash';
}
 
add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );
*/

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

function custom_excerpt_length($length) {
    return 25;
}

/**
 * Mostrar miniatura de imagen destacada en el feed
 * FROM AYUDAWORDPRESS.COM
 */

add_filter('the_content_feed', 'imagen_destacada_rss');
function imagen_destacada_rss($content) {
        global $post;
        if( has_post_thumbnail($post->ID) )
                $content = '<p>' . get_the_post_thumbnail($post->ID, 'thumbnail') . '</p>' . $content;
        return $content;
}

/*
Hotlink Protection by Christopher Ross (+ Antispam)(http://thisismyurl.com/plugins/hotlink-protection/ + http://brassblogs.com/tidbits/htaccess-and-spam)
License: GPL
*/

/**
 * Hotlink Protection core file
 *
 * This file contains all the logic required for the plugin
 *
 * @link		http://wordpress.org/extend/plugins/hotlink-protection/
 *
 * @package 		Hotlink Protection
 * @copyright		Copyright (c) 2008, Chrsitopher Ross
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Hotlink Protection 1.0
 */


// on activate
global $thisismyurl_hotlink_protection_file;
global $thisismyurl_hotlink_protection_file_hlp;


$url = strtolower(get_bloginfo('url'));
$url = str_replace('https://','',$url);
$url = str_replace('http://','',$url);
$url = str_replace('www.','',$url);
$thisismyurl_hotlink_protection_file_hlp = "

# Hotlink+Antispam Protection START #

<IfModule mod_rewrite.c>
RewriteEngine on
RewriteCond %{HTTP_REFERER} !^$
# Hotlink include additional file types here
RewriteCond %{REQUEST_FILENAME} \.(gif|jpe?g?|png)$                [NC]
RewriteCond %{HTTP_REFERER} !^http(s)?://(www\.)?".$url." [NC]
RewriteCond %{HTTP_REFERER} !^http(s)?://".$url." [NC]
# search engine access
RewriteCond %{HTTP_REFERER}     !search\?q=cache                   [NC]
RewriteCond %{HTTP_REFERER}     !google\.                          [NC]
RewriteCond %{HTTP_REFERER}     !yahoo\.                           [NC]
RewriteRule \.(jpg|jpeg|png|gif)$ - [NC,F,L]
RewriteCond %{HTTP_REFERER} advair [OR]
RewriteCond %{HTTP_REFERER} allegra [OR]
RewriteCond %{HTTP_REFERER} ambien [OR]
RewriteCond %{HTTP_REFERER} amoxicillin [OR]
RewriteCond %{HTTP_REFERER} baccarat [OR]
RewriteCond %{HTTP_REFERER} bet [OR]
RewriteCond %{HTTP_REFERER} blackjack [OR]
RewriteCond %{HTTP_REFERER} cash [OR]
RewriteCond %{HTTP_REFERER} casino [OR]
RewriteCond %{HTTP_REFERER} celeb [OR]
RewriteCond %{HTTP_REFERER} cheap [OR]
RewriteCond %{HTTP_REFERER} cialis [OR]
RewriteCond %{HTTP_REFERER} craps [OR]
RewriteCond %{HTTP_REFERER} credit [OR]
RewriteCond %{HTTP_REFERER} deal [OR]
RewriteCond %{HTTP_REFERER} debt [OR]
RewriteCond %{HTTP_REFERER} drug [OR]
RewriteCond %{HTTP_REFERER} effexor [OR]
RewriteCond %{HTTP_REFERER} equity [OR]
RewriteCond %{HTTP_REFERER} faxo [OR]
RewriteCond %{HTTP_REFERER} finance [OR]
RewriteCond %{HTTP_REFERER} gambling [OR]
RewriteCond %{HTTP_REFERER} hold-em [OR]
RewriteCond %{HTTP_REFERER} holdem [OR]
RewriteCond %{HTTP_REFERER} iconsurf [OR]
RewriteCond %{HTTP_REFERER} insurance [OR]
RewriteCond %{HTTP_REFERER} interest [OR]
RewriteCond %{HTTP_REFERER} internetsupervision [OR]
RewriteCond %{HTTP_REFERER} keno [OR]
RewriteCond %{HTTP_REFERER} levitra [OR]
RewriteCond %{HTTP_REFERER} lipitor [OR]
RewriteCond %{HTTP_REFERER} loan [OR]
RewriteCond %{HTTP_REFERER} meds [OR]
RewriteCond %{HTTP_REFERER} money [OR]
RewriteCond %{HTTP_REFERER} mortgage [OR]
RewriteCond %{HTTP_REFERER} omaha [OR]
RewriteCond %{HTTP_REFERER} paxil [OR]
RewriteCond %{HTTP_REFERER} pharmacy [OR]
RewriteCond %{HTTP_REFERER} pharmacies [OR]
RewriteCond %{HTTP_REFERER} phentermine [OR]
RewriteCond %{HTTP_REFERER} pheromone [OR]
RewriteCond %{HTTP_REFERER} pills [OR]
RewriteCond %{HTTP_REFERER} poker [OR]
RewriteCond %{HTTP_REFERER} refinance [OR]
RewriteCond %{HTTP_REFERER} roulette [OR]
RewriteCond %{HTTP_REFERER} scout [OR]
RewriteCond %{HTTP_REFERER} seventwentyfour [OR]
RewriteCond %{HTTP_REFERER} slot [OR]
RewriteCond %{HTTP_REFERER} syntryx [OR]
RewriteCond %{HTTP_REFERER} texas [OR]
RewriteCond %{HTTP_REFERER} tournament [OR]
RewriteCond %{HTTP_REFERER} tramadol [OR]
RewriteCond %{HTTP_REFERER} tramidol [OR]
RewriteCond %{HTTP_REFERER} valtrex [OR]
RewriteCond %{HTTP_REFERER} viagra [OR]
RewriteCond %{HTTP_REFERER} vicodin [OR]
RewriteCond %{HTTP_REFERER} win [OR]
RewriteCond %{HTTP_REFERER} xanax [OR]
RewriteCond %{HTTP_REFERER} zanax [OR]
RewriteCond %{HTTP_REFERER} zoloft [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?.*(-|.)?adult(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?.*(-|.)?anal(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?.*(-|.)?blow.?job(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?.*(-|.)?gay(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?.*(-|.)?incest(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?.*(-|.)?mature(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?.*(-|.)?nude(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?.*(-|.)?porn(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?.*(-|.)?pus*y(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?.*(-|.)?sex(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?.*(-|.)?teen(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?.*(-|.)?tits(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?.*(-|.)?titten(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?38ha(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?4free(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?4hs8(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?4t(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?4u(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?6q(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?8gold(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?911(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?abalone(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?adminshop(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?adultactioncam(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?aizzo(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?alexa(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?alphacarolinas(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?amateur(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?amateurxpass(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?ansar-u-deen(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?atelebanon(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?beastiality(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?bestiality(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?belize(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?best-deals(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?blogincome(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?bontril(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?bruce-holdeman(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?vixen1(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?ca-america(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?chatt-net(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?commerce(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?condo(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?conjuratia(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?consolidate(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?coswap(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?crescentarian(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?crepesuzette(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?dating(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?devaddict(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?discount(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?domainsatcost(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?doobu(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?e-site(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?egygift(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?empathica(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?empirepoker(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?e-poker-2005(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?escal8(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?eurip(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?exitq(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?eyemagination(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?fastcrawl(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?fearcrow(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?ferretsoft(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?fick(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?finance(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?flafeber(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?fidelityfunding(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?freakycheats(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?freeality(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?fuck(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?future-2000(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?gabriola(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?gallerylisting(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?gb.com(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?globusy(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?golf-e-course(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?gospelcom(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?gradfinder(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?hasfun(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?herbal(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?hermosa(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?highprofitclub(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?hilton(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?teaminspection(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?hotel(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?houseofseven(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?hurricane(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?iaea(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?ime(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?info(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?ingyensms(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?inkjet-toner(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?isacommie(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?istarthere(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?it.tt(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?italiancharms(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?iwantu(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?jfcadvocacy(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?jmhic(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?juris(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?kylos(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?laser-eye(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?leathertree(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?lillystar(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?linkerdome(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?livenet(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?low-limit(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?lowest-price(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?macsurfer(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?mall.uk(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?maloylawn(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?marketing(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?mcdortaklar(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?mediavisor(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?medications(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?mirror.sytes(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?mp3(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?(-|.)musicbox1(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?naked(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?netdisaster(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?netfirms(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?newtruths(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?no-limit(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?nude(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?nudeceleb(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?nutzu(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?odge(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?oiline(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?onlinegamingassoc(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?outpersonals(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?pagetwo(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?paris(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?passions(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?peblog(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?peng(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?perfume-cologne(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?personal(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?php-soft(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?pics(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?pisoc(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?pisx(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?popwow(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?porn(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?prescriptions(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?printdirectforless(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?ps2cool(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?psnarones(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?psxtreme(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?quality-traffic(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?registrarprice(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?reliableresults(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?rimpim(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?ro7kalbe(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?rohkalby(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?ronnieazza(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?rulo.biz(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?s5(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?samiuls(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?searchedu(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?seventwentyfour(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?seventwentyfour.*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?sex(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?sexsearch(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?sexsq(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?shoesdiscount(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?site-4u(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?site5(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?slatersdvds(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?sml338(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?sms(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?smsportali(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?software(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?sortthemesitesby(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?spears(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?spoodles(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?sportsparent(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?stmaryonline(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?strip(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?suttonjames(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?talk.uk-yankee(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?tecrep-inc(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?teen(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?terashells(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?thatwhichis(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?thorcarlson(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?tmsathai(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?traffixer(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?tranny(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?valeof(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?video(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?vinhas(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?vixen1(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?vpshs(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?vrajitor(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?w3md(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?webdevsquare(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?whois(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?withdrawal(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?worldemail(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?wslp24(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?ws-op(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?xopy(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?xxx(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?yelucie(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?youradulthosting(-|.).*$ [OR]
RewriteCond %{HTTP_REFERER} ^http://(www\.)?(-|.)zindagi(-|.).*$ [NC]
RewriteRule .* - [F]
deny from 217.46.255.241
deny from 65.112.44.225
deny from 64.246.161.26
</IfModule>
<IfModule mod_rewrite.c>
AddOutputFilterByType DEFLATE text/text text/html text/plain text/xml text/css application/x-javascript application/javascript
</IfModule>
<IfModule mod_rewrite.c>
# Anti sql inyection attack from ayudawordpress com/evita-hackeos-en-wordpress-desde-htaccess/
Options +FollowSymLinks
RewriteEngine On
RewriteCond %{QUERY_STRING} proc/self/environ [OR]
 
RewriteCond %{QUERY_STRING} mosConfig_[a-zA-Z_]{1,21}(=|\%3D) [OR]
 
RewriteCond %{QUERY_STRING} base64_encode.*(.*) [OR]
 
RewriteCond %{QUERY_STRING} (<|%3C).*script.*(>|%3E) [NC,OR]
 
RewriteCond %{QUERY_STRING} GLOBALS(=|[|\%[0-9A-Z]{0,2}) [OR]
 
RewriteCond %{QUERY_STRING} _REQUEST(=|[|\%[0-9A-Z]{0,2})
 
RewriteRule ^(.*)$ index.php [F,L]
</IfModule>

# Hotlink+Antispam Protection END #

";

$thisismyurl_hotlink_protection_file = ABSPATH.'.htaccess';

// on activate
function timu_wpaihp_active() {
	global $thisismyurl_hotlink_protection_file;
	global $thisismyurl_hotlink_protection_file_hlp;
	
	if (file_exists($thisismyurl_hotlink_protection_file)) {
	  
		$fh = fopen($thisismyurl_hotlink_protection_file, 'r');
		$htaccess = fread($fh, filesize($thisismyurl_hotlink_protection_file));
		fclose($fh);
  	}
  
	$fh = fopen($thisismyurl_hotlink_protection_file, 'w') or die("can't open file");
	fwrite($fh, $htaccess.$thisismyurl_hotlink_protection_file_hlp);
	fclose($fh);
	
}
register_activation_hook( __FILE__, 'timu_wpaihp_active' );


// on deactivate
function timu_wpaihp_deactivate() {
	global $thisismyurl_hotlink_protection_file;
	global $thisismyurl_hotlink_protection_file_hlp;
	
	if (file_exists($thisismyurl_hotlink_protection_file)) {
		
		$fh = fopen($thisismyurl_hotlink_protection_file, 'r');
		$htaccess = fread($fh, filesize($thisismyurl_hotlink_protection_file));
		fclose($fh);

		$htaccess = str_replace($thisismyurl_hotlink_protection_file_hlp,"",$htaccess);

		$fh = fopen($thisismyurl_hotlink_protection_file, 'w') or die("can't open file");
		fwrite($fh, $htaccess);
		fclose($fh);

	}
}
register_deactivation_hook( __FILE__, 'timu_wpaihp_deactivate' );
*/

/*
Sharpen Resized Images by Ünsal Korkmaz (http://unsalkorkmaz.com/ajx-sharpen-resized-images/)
License: GPL v3
*/ 

/*
filter usage:
	add_filter('sharpen_resized_corner',function(){ return -1.2; });
	add_filter('sharpen_resized_side',function(){ return -1; });
	add_filter('sharpen_resized_center',function(){ return 20; });
*/
function ajx_sharpen_resized_files( $resized_file ) {
	
	$image = imagecreatefromstring( file_get_contents( $resized_file ) );
	
	$size = @getimagesize( $resized_file );
	if ( !$size )
		return new WP_Error('invalid_image', __('Could not read image size'), $file);
	list($orig_w, $orig_h, $orig_type) = $size;

	switch ( $orig_type ) {
		case IMAGETYPE_JPEG:
			$matrix = array(
				array(apply_filters('sharpen_resized_corner',-1.2), apply_filters('sharpen_resized_side',-1), apply_filters('sharpen_resized_corner',-1.2)),
				array(apply_filters('sharpen_resized_side',-1), apply_filters('sharpen_resized_center',20), apply_filters('sharpen_resized_side',-1)),
				array(apply_filters('sharpen_resized_corner',-1.2), apply_filters('sharpen_resized_side',-1), apply_filters('sharpen_resized_corner',-1.2)),
			);

			$divisor = array_sum(array_map('array_sum', $matrix));
			$offset = 0; 
			imageconvolution($image, $matrix, $divisor, $offset);
			imagejpeg($image, $resized_file,apply_filters( 'jpeg_quality', 90, 'edit_image' ));
			break;
		case IMAGETYPE_PNG:
			return $resized_file;
		case IMAGETYPE_GIF:
			return $resized_file;
	}	
	
	// we don't need images in memory anymore
	imagedestroy( $image );
	
	return $resized_file;
}	
	
add_filter('image_make_intermediate_size', 'ajx_sharpen_resized_files',900);

/*
Email Address Encoder by Till KrÃ¼ss: (http://tillkruess.com/)
License: GPLv3
*/

/**
 * Copyright 2013 Till KrÃ¼ss  (www.tillkruess.com)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package Email Address Encoder
 * @copyright 2013 Till KrÃ¼ss
 */

/**
 * Define plugin constants that can be overridden, generally in wp-config.php.
 */
if (!defined('EAE_FILTER_PRIORITY'))
	define('EAE_FILTER_PRIORITY', 1000);

/**
 * Register filters to encode exposed email addresses in
 * posts, pages, excerpts, comments and widgets.
 */
foreach (array('the_content', 'the_excerpt', 'widget_text', 'comment_text', 'comment_excerpt') as $filter) {
	add_filter($filter, 'eae_encode_emails', EAE_FILTER_PRIORITY);
}

/**
 * Searches for plain email addresses in given $string and
 * encodes them (by default) with the help of eae_encode_str().
 * 
 * Regular expression is based on based on John Gruber's Markdown.
 * http://daringfireball.net/projects/markdown/
 * 
 * @param string $string Text with email addresses to encode
 * @return string $string Given text with encoded email addresses
 */
function eae_encode_emails($string) {

	// abort if $string doesn't contain a @-sign
	if (apply_filters('eae_at_sign_check', true)) {
		if (strpos($string, '@') === false) return $string;
	}

	// override encoding function with the 'eae_method' filter
	$method = apply_filters('eae_method', 'eae_encode_str');

	// override regex pattern with the 'eae_regexp' filter
	$regexp = apply_filters(
		'eae_regexp',
		'{
			(?:mailto:)?
			(?:
				[-!#$%&*+/=?^_`.{|}~\w\x80-\xFF]+
			|
				".*?"
			)
			\@
			(?:
				[-a-z0-9\x80-\xFF]+(\.[-a-z0-9\x80-\xFF]+)*\.[a-z]+
			|
				\[[\d.a-fA-F:]+\]
			)
		}xi'
	);

	return preg_replace_callback(
		$regexp,
		create_function(
            '$matches',
            'return '.$method.'($matches[0]);'
        ),
		$string
	);

}

/**
 * Encodes each character of the given string as either a decimal
 * or hexadecimal entity, in the hopes of foiling most email address
 * harvesting bots.
 *
 * Based on Michel Fortin's PHP Markdown:
 *   http://michelf.com/projects/php-markdown/
 * Which is based on John Gruber's original Markdown:
 *   http://daringfireball.net/projects/markdown/
 * Whose code is based on a filter by Matthew Wickline, posted to
 * the BBEdit-Talk with some optimizations by Milian Wolff.
 *
 * @param string $string Text with email addresses to encode
 * @return string $string Given text with encoded email addresses
 */
function eae_encode_str($string) {

	$chars = str_split($string);
	$seed = mt_rand(0, (int) abs(crc32($string) / strlen($string)));

	foreach ($chars as $key => $char) {

		$ord = ord($char);

		if ($ord < 128) { // ignore non-ascii chars

			$r = ($seed * (1 + $key)) % 100; // pseudo "random function"

			if ($r > 60 && $char != '@') ; // plain character (not encoded), if not @-sign
			else if ($r < 45) $chars[$key] = '&#x'.dechex($ord).';'; // hexadecimal
			else $chars[$key] = '&#'.$ord.';'; // decimal (ascii)

		}

	}

	return implode('', $chars);

}


/*
IFTTT Post Formats
 by Jtsternberg: (http://dsgnwrks.pro/plugins/ifttt-post-formats
)
License: GPLv2
*/

/*
	Plugin Name: IFTTT Post Formats
	Plugin URI: http://dsgnwrks.pro/plugins/ifttt-post-formats
	Description: Set a post format for your IFTTT-created posts, by adding a post format category.
	Author URI: http://jtsternberg.com/about
	Author: Jtsternberg
	Donate link: http://dsgnwrks.pro/give/
	Version: 0.1.0
*/


class IFTTT_WP_Post_Formats {

	function __construct() {
		add_action( 'save_post', array( $this, 'ifttt_formats' ), 18 );
	}

	/**
	 * Set post format based on category, and remove category
	 * @since 0.1.0
	 */
	function ifttt_formats( $post_id ) {

		$cats          = get_the_terms( $post_id, 'category' );
		$formats       = array( 'ifttt-aside', 'ifttt-gallery', 'ifttt-link', 'ifttt-image', 'ifttt-quote', 'ifttt-status', 'ifttt-video', 'ifttt-audio', 'ifttt-chat' );
		$filtered_cats = array();
		$share         = array();
		$format        = false;

		if ( $cats ) {
			// Loop through
			foreach ( $cats as $key => $cat ) {
				// if our cat slug matches one of our ifttt formats,
				if ( in_array( $cat->slug, $formats ) ) {
					// Set the post format
					$format = str_replace( 'ifttt-', '', $cat->slug );
					continue;
				}
				// Otherwise, add the term to the list of terms to be re-applied to the post
				$filtered_cats[] = $cat->name;
			}
		}

		// If we found a post-format category...
		if ( $format && ! get_post_format( $post_id ) ) {
			// set the post format
			set_post_format( $post_id , $format );
		}
		// Reset terms minus ifttt post format terms
		wp_set_object_terms( $post_id, $filtered_cats, 'category' );
	}

}

new IFTTT_WP_Post_Formats();

/*
Email Rocket Lazy Load by WP Media: (http://wp-rocket.me)
License: GPLv2
Site: http://wordpress.org/plugins/rocket-lazy-load/
*/

/**
 * Add Lazy Load JavaScript in the header
 * No jQuery or other library is required !!
 *
 * @since 1.0
 *
 */

if( !function_exists( 'rocket_lazyload_script' ) ) :
add_action( 'wp_head', 'rocket_lazyload_script', PHP_INT_MAX );
function rocket_lazyload_script()
{

	if( !apply_filters( 'do_rocket_lazyload', true ) )
		return;

	echo '<script type="text/javascript">(function(a,e){function f(){var d=0;if(e.body&&e.body.offsetWidth){d=e.body.offsetHeight}if(e.compatMode=="CSS1Compat"&&e.documentElement&&e.documentElement.offsetWidth){d=e.documentElement.offsetHeight}if(a.innerWidth&&a.innerHeight){d=a.innerHeight}return d}function b(g){var d=ot=0;if(g.offsetParent){do{d+=g.offsetLeft;ot+=g.offsetTop}while(g=g.offsetParent)}return{left:d,top:ot}}function c(){var l=e.querySelectorAll("[data-lazy-original]");var j=a.pageYOffset||e.documentElement.scrollTop||e.body.scrollTop;var d=f();for(var k=0;k<l.length;k++){var h=l[k];var g=b(h).top;if(g<(d+j)){h.src=h.getAttribute("data-lazy-original");h.removeAttribute("data-lazy-original")}}}if(a.addEventListener){a.addEventListener("DOMContentLoaded",c,false);a.addEventListener("scroll",c,false)}else{a.attachEvent("onload",c);a.attachEvent("onscroll",c)}})(window,document);</script>';
}
endif;




/**
 * Replace Gravatar, thumbnails, images in post content and in widget text by LazyLoad
 *
 * @since 1.0
 *
 */

if( !function_exists( 'rocket_lazyload_images' ) ) :
add_filter( 'get_avatar', 'rocket_lazyload_images', PHP_INT_MAX );
add_filter( 'post_thumbnail_html', 'rocket_lazyload_images', PHP_INT_MAX );
add_filter( 'the_content', 'rocket_lazyload_images', PHP_INT_MAX );
add_filter( 'widget_text', 'rocket_lazyload_images', PHP_INT_MAX );
function rocket_lazyload_images( $html )
{

	// Don't LazyLoad if the thumbnail is in admin, a feed or a post preview
	if( is_admin() || is_feed() || is_preview() || empty( $html ) )
		return $html;

	// Don't LazyLoad if the thumbnail has already been run through previously or stop process with a hook
	if ( strpos( $html, 'data-lazy-original' ) || strpos( $html, 'data-no-lazy' ) || !apply_filters( 'do_rocket_lazyload', true ) )
		return $html;

	$html = preg_replace( '#<img([^>]+?)src=[\'"]?([^\'"\s>]+)[\'"]?([^>]*)>#', '<img${1}src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-lazy-original="${2}"${3}><noscript><img${1}src="${2}"${3}></noscript>', $html );

	return $html;
}
endif;



/**
 * Replace WordPress smilies by Lazy Load
 *
 * @since 1.0
 *
 */

if( !function_exists( 'rocket_convert_smilies' ) ) :
remove_filter( 'the_content', 'convert_smilies' );
remove_filter( 'the_excerpt', 'convert_smilies' );
remove_filter( 'comment_text', 'convert_smilies' );

add_filter( 'the_content', 'rocket_convert_smilies' );
add_filter( 'the_excerpt', 'rocket_convert_smilies' );
add_filter( 'comment_text', 'rocket_convert_smilies' );



/**
 * Convert text equivalent of smilies to images.
 *
 * @source convert_smilies() in /wp-includes/formattings.php
 * @since 1.0
 *
 */

function rocket_convert_smilies( $text ) {
	global $wp_smiliessearch;

	$output = '';
	if ( get_option( 'use_smilies' ) && ! empty( $wp_smiliessearch ) ) {
		// HTML loop taken from texturize function, could possible be consolidated
		$textarr = preg_split( '/(<.*>)/U', $text, -1, PREG_SPLIT_DELIM_CAPTURE ); // capture the tags as well as in between
		$stop = count( $textarr );// loop stuff

		// Ignore proessing of specific tags
		$tags_to_ignore = 'code|pre|style|script|textarea';
		$ignore_block_element = '';

		for ( $i = 0; $i < $stop; $i++ ) {
			$content = $textarr[$i];

			// If we're in an ignore block, wait until we find its closing tag
			if ( '' == $ignore_block_element && preg_match( '/^<(' . $tags_to_ignore . ')>/', $content, $matches ) )  {
				$ignore_block_element = $matches[1];
			}

			// If it's not a tag and not in ignore block
			if ( '' ==  $ignore_block_element && strlen( $content ) > 0 && '<' != $content[0] ) {
				$content = preg_replace_callback( $wp_smiliessearch, 'rocket_translate_smiley', $content );
			}

			// did we exit ignore block
			if ( '' != $ignore_block_element && '</' . $ignore_block_element . '>' == $content )  {
				$ignore_block_element = '';
			}

			$output .= $content;
		}
	} else {
		// return default text.
		$output = $text;
	}
	return $output;
}
endif;



/**
 * Convert one smiley code to the icon graphic file equivalent.
 *
 * @source translate_smiley() in /wp-includes/formattings.php
 * @since 1.0
 *
 */

if( !function_exists( 'rocket_translate_smiley' ) ) :
function rocket_translate_smiley( $matches ) {
	global $wpsmiliestrans;

	if ( count( $matches ) == 0 )
		return '';

	$smiley = trim( reset( $matches ) );
	$img = $wpsmiliestrans[ $smiley ];

	/**
	 * Filter the Smiley image URL before it's used in the image element.
	 *
	 * @since 2.9.0
	 *
	 * @param string $smiley_url URL for the smiley image.
	 * @param string $img        Filename for the smiley image.
	 * @param string $site_url   Site URL, as returned by site_url().
	 */
	$src_url = apply_filters( 'smilies_src', includes_url( "images/smilies/$img" ), $img, site_url() );

	// Don't lazy-load if process is stopped with a hook
	if ( apply_filters( 'do_rocket_lazyload', true ) )
	{
		return sprintf( ' <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-lazy-original="%s" alt="%s" class="wp-smiley" /> ', esc_url( $src_url ), esc_attr( $smiley ) );
	}
	else
	{
		return sprintf( ' <img src="%s" alt="%s" class="wp-smiley" /> ', esc_url( $src_url ), esc_attr( $smiley ) );
	}

}
endif;

/*
Filenames to latin by webvitaly
(http://wordpress.org/plugins/filenames-to-latin/)
License: GPL v3
*/ 

if( ! function_exists( 'filenames_to_latin_unqprfx' ) ) :
	function filenames_to_latin_unqprfx( $filename ) {

		$chars_table = array(

			// Cyrillic alphabet
			'/А/' => 'a', '/Б/' => 'b', '/В/' => 'v', '/Г/' => 'g', '/Д/' => 'd',
			'/а/' => 'a', '/б/' => 'b', '/в/' => 'v', '/г/' => 'g', '/д/' => 'd',

			'/Е/' => 'e', '/Ж/' => 'zh', '/З/' => 'z', '/И/' => 'i', '/Й/' => 'j',
			'/е/' => 'e', '/ж/' => 'zh', '/з/' => 'z', '/и/' => 'i', '/й/' => 'j',

			'/К/' => 'k', '/Л/' => 'l', '/М/' => 'm', '/Н/' => 'n', '/О/' => 'o',
			'/к/' => 'k', '/л/' => 'l', '/м/' => 'm', '/н/' => 'n', '/о/' => 'o',

			'/П/' => 'p', '/Р/' => 'r', '/С/' => 's', '/Т/' => 't', '/У/' => 'u',
			'/п/' => 'p', '/р/' => 'r', '/с/' => 's', '/т/' => 't', '/у/' => 'u',

			'/Ф/' => 'f', '/Х/' => 'h', '/Ц/' => 'c', '/Ч/' => 'ch', '/Ш/' => 'sh',
			'/ф/' => 'f', '/х/' => 'h', '/ц/' => 'c', '/ч/' => 'ch', '/ш/' => 'sh',

			'/Щ/' => 'shch', '/Ь/' => '', '/Ю/' => 'ju', '/Я/' => 'ja',
			'/щ/' => 'shch', '/ь/' => '', '/ю/' => 'ju', '/я/' => 'ja',

			// Ukrainian
			'/Ґ/' => 'g', '/Є/' => 'ye', '/І/' => 'i', '/Ї/' => 'yi',
			'/ґ/' => 'g', '/є/' => 'ye', '/і/' => 'i', '/ї/' => 'yi',
			
			// Russian
			'/Ё/' => 'yo', '/Ы/' => 'y', '/Ъ/' => '', '/Э/' => 'e',
			'/ё/' => 'yo', '/ы/' => 'y', '/ъ/' => '', '/э/' => 'e',
			
			// Belorussian
			'/Ў/' => 'u',
			'/ў/' => 'u',

			// German
			'/Ä/' => 'ae', '/Ö/' => 'oe', '/Ü/' => 'ue', '/ß/' => 'ss',
			'/ä/' => 'ae', '/ö/' => 'oe', '/ü/' => 'ue',
			
			// Polish
			'/Ą/' => 'a', '/Ć/' => 'c', '/Ę/' => 'e', '/Ł/' => 'l', '/Ń/' => 'n',
			'/ą/' => 'a', '/ć/' => 'c', '/ę/' => 'e', '/ł/' => 'l', '/ń/' => 'n',
			'/Ó/' => 'o', '/Ś/' => 's', '/Ź/' => 'z', '/Ż/' => 'z',
			'/ó/' => 'o', '/ś/' => 's', '/ź/' => 'z', '/ż/' => 'z',

			// Hungarian
			'/Ő/' => 'o', '/Ű/' => 'u',
			'/ő/' => 'o', '/ű/' => 'u',

			// Czech
			'/Ě/' => 'e', '/Š/' => 's', '/Č/' => 'c', '/Ř/' => 'r', '/Ž/' => 'z',
			'/ě/' => 'e', '/š/' => 's', '/č/' => 'c', '/ř/' => 'r', '/ž/' => 'z',

			'/Ý/' => 'y', '/Á/' => 'a', '/É/' => 'e', '/Ď/' => 'd', '/Ť/' => 't',
			'/ý/' => 'y', '/á/' => 'a', '/é/' => 'e', '/ď/' => 'd', '/ť/' => 't',

			'/Ň/' => 'n', '/Ú/' => 'u', '/Ů/' => 'u',
			'/ň/' => 'n', '/ú/' => 'u', '/ů/' => 'u',

			// Greek alphabet & modern polytonic characters
			'/Α/' => 'a', '/Β/' => 'v', '/Γ/' => 'g', '/Δ/' => 'd', '/Ε/' => 'e',
			'/α/' => 'a', '/β/' => 'v', '/γ/' => 'g', '/δ/' => 'd', '/ε/' => 'e',

			'/Ζ/' => 'z', '/Η/' => 'i', '/Θ/' => 'th', '/Ι/' => 'i', '/Κ/' => 'k',
			'/ζ/' => 'z', '/η/' => 'i', '/θ/' => 'th', '/ι/' => 'i', '/κ/' => 'k',

			'/Λ/' => 'l', '/Μ/' => 'm', '/Ν/' => 'n', '/Ξ/' => 'x', '/Ο/' => 'o',
			'/λ/' => 'l', '/μ/' => 'm', '/ν/' => 'n', '/ξ/' => 'x', '/ο/' => 'o',

			'/Π/' => 'p', '/Ρ/' => 'r', '/Σ/' => 's', '/Τ/' => 't', '/Υ/' => 'y',
			'/π/' => 'p', '/ρ/' => 'r', '/σ/' => 's', '/τ/' => 't', '/υ/' => 'y',

			'/Φ/' => 'f', '/Χ/' => 'ch', '/Ψ/' => 'ps', '/Ω/' => 'o', '/Ά/' => 'a',
			'/φ/' => 'f', '/χ/' => 'ch', '/ψ/' => 'ps', '/ω/' => 'o', '/ά/' => 'a',

			'/Έ/' => 'e', '/Ή/' => 'i', '/Ί/' => 'i', '/Ό/' => 'o', '/Ύ/' => 'y',
			'/έ/' => 'e', '/ή/' => 'i', '/ί/' => 'i', '/ό/' => 'o', '/ύ/' => 'y',

			'/Ώ/' => 'o', '/Ϊ/' => 'i', '/Ϋ/' => 'y',
			'/ώ/' => 'o', '/ς/' => 's', '/ΐ/' => 'i', '/ϊ/' => 'i', '/ϋ/' => 'y', '/ΰ/' => 'y',

			// Extra all (http://www.atm.ox.ac.uk/user/iwi/charmap.html)
			'/À/' => 'a', '/Á/' => 'a', '/Â/' => 'a', '/Ã/' => 'a', '/Å/' => 'a',
			'/à/' => 'a', '/á/' => 'a', '/â/' => 'a', '/ã/' => 'a', '/å/' => 'a',

			'/Æ/' => 'ae', '/Ç/' => 'c', '/È/' => 'e', '/É/' => 'e', '/Ê/' => 'e',
			'/æ/' => 'ae', '/ç/' => 'c', '/è/' => 'e', '/é/' => 'e', '/ê/' => 'e',

			'/Ë/' => 'e', '/Ì/' => 'i', '/Í/' => 'i', '/Î/' => 'i', '/Ï/' => 'i',
			'/ë/' => 'e', '/ì/' => 'i', '/í/' => 'i', '/î/' => 'i', '/ï/' => 'i',

			'/Ð/' => 'd', '/Ñ/' => 'n', '/Ò/' => 'o', '/Ô/' => 'o', '/Õ/' => 'o',
			'/ð/' => 'd', '/ñ/' => 'n', '/ò/' => 'o', '/ô/' => 'o', '/õ/' => 'o',

			'/×/' => 'x', '/Ø/' => 'o', '/Ù/' => 'u', '/Ú/' => 'u', '/Û/' => 'u',
			'/×/' => 'x', '/ø/' => 'o', '/ù/' => 'u', '/ú/' => 'u', '/û/' => 'u',

			'/Þ/' => 'p', '/Ÿ/' => 'y',
			'/þ/' => 'p', '/ÿ/' => 'y',

			// Other
			'/№/' => '', '/“/' => '', '/”/' => '', '/«/' => '', '/»/' => '',
			'/„/' => '', '/@/' => '', '/%/' => '', '/‘/' => '', '/’/' => '',
			'/`/' => '', '/´/' => '', '/º/' => 'o', '/ª/' => 'a',

		);

		// rewrite some chars for some languages
		$locale = get_locale();
		switch ( $locale ) {
			case 'uk_UA': // Ukrainian
			case 'uk_ua':
			case 'uk':
				$chars_table_ext = array(
					'/Г/' => 'h',
					'/г/' => 'h',
					'/И/' => 'y',
					'/и/' => 'y'
				);
				$chars_table = array_merge( $chars_table, $chars_table_ext );
				break;
			case 'sv_SE': // Swedish
			case 'sv_se':
				$chars_table_ext = array(
					'/Å/' => 'a',
					'/å/' => 'a',
					'/Ä/' => 'a',
					'/ä/' => 'a',
					'/Ö/' => 'o',
					'/ö/' => 'o'
				);
				$chars_table = array_merge( $chars_table, $chars_table_ext );
				break;
			case 'bg_BG': // Bulgarian
			case 'bg_bg':
				$chars_table_ext = array(
					'/Щ/' => 'sht',
					'/щ/' => 'sht',
					'/Ъ/' => 'a',
					'/ъ/' => 'a'
				);
				$chars_table = array_merge( $chars_table, $chars_table_ext );
				break;
		}

		$friendly_filename = preg_replace( array_keys( $chars_table ), array_values( $chars_table ), $filename ); // replace original chars in filename with friendly chars

		return strtolower( $friendly_filename ); // filename to lowercase
	}
	add_filter( 'sanitize_file_name', 'filenames_to_latin_unqprfx', 10 );
endif;


if( ! function_exists( 'filenames_to_latin_unqprfx_plugin_meta' ) ) :
	function filenames_to_latin_unqprfx_plugin_meta( $links, $file ) { // add 'Plugin page' and 'Donate' links to plugin meta row
		if ( strpos( $file, 'filenames-to-latin.php' ) !== false ) {
			$links = array_merge( $links, array( '<a href="http://web-profile.com.ua/wordpress/plugins/filenames-to-latin/" title="Plugin page">' . __('Filenames to latin') . '</a>' ) );
			$links = array_merge( $links, array( '<a href="http://web-profile.com.ua/donate/" title="Support the development">' . __('Donate') . '</a>' ) );
		}
		return $links;
	}
	add_filter( 'plugin_row_meta', 'filenames_to_latin_unqprfx_plugin_meta', 10, 2 );
endif;




