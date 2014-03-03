# DiaryBlog

DiaryBlog is a prototype made with the Wordpress CMS that is used in the realization of personal diaries with certain mixtures blog (if desired).

CAUTION: This is used as a testing ground, though, you can use applications normally without spies or anything like.

##Description
* This is a custom wordpress instalation
* Has about 20 plugins, including one for modification to code.
* It has almost the same features, most easily accessible.

##Requirements
* 20-40MB RAM recommend.
* 40MB disk space (your files not inclued).
* PHP 5.4 or more in Apache or similar server.
* MySQL o MariaDB installed.


##Instalation
* Download, unzip the files and move with FTP aplication.
* Install, follow the instructions (the famous 5-minute installation), or
* Use the precooked version (is included and requires more steps) you can do it from the "wp-prolife" folder.
* Is not English or Spanish speaker, [review the instructions](http://codex.wordpress.org/Installing_WordPress_in_Your_Language).

##FAQ
###How I can make it rather a hybrid of public and private diary is just a private diary?
Sure, it's advisable to do if you think your information is extremely confidential. Please install the plugin "More Privacy Options" from wordpress.org (or move it from the wp-prolife folder) and select "Admin only".

###Will my images are safe?
If you install Attachment page redirector, is possible. The page on the file (either image, video or any media) is not required, so if possible you can save on an oversight.

###Are there pictures on this prototype?
Check the "screenshots" folder, where they performed a version prepared DiaryBlog.

###How to execute the prepared DiaryBlog version?
The database is stored in the "agendaword" folder (you can change the wp-config file). Put it in the right place (or extract it from PhpMyAdmin as a compressed file), enter your administration user and password and start editing.

Please copy and paste the password because it could be the character "ñ" to improve security (until you change it).

###What is the use CAPTCHA on the login page?
Applied as additional security for the attempt to reduce identity theft. You can change it from the options. The link looks like this:
http://localhost/wordpress/wp-admin/admin.php?page=blcap_options_page

###There is a feature to publish my posts to social networks, how do I do? 
There is a plugin you can activate without problems (all are open source and free), and you can also disable them at any time.
The link looks like this: http://localhost/wordpress/wp-admin/plugins.php

###Why are uncompressed files?
The idea of this prototype is to study and improve it as a "tool commonly used" as well as avoid any dirty trick when installing.

### What is PGP Encryption?
The GPG (GNU Privacy Guard) is an open source system to encrypt information using an email linked to your key. It consists of two files: one to encrypt and that is public (for a plugin must be configured in the options) and other private user who only knows and is reinforced with a password.

See [demo page](https://wp2pgpmail.com/pgp-key-generator/) .


###I am installing DiaryBlog with precooked version, what should I do if there are problems once migrated files?
Try to modify the database using PhpMyAdmin. From the "SQL" tab, then select on the side of the database "agendablog" type the following commands (in orden of numbers):

//1
UPDATE wp_options
SET option_value = REPLACE(option_value,'old_domain','new_domain');
//2
UPDATE wp_posts
SET post_content = REPLACE(post_content,'old_domain','new_domain');
//3
UPDATE wp_posts
SET guid = REPLACE(guid,'old_domain','new_domain');
//4
UPDATE wp_postmeta
SET meta_value = REPLACE(meta_value,'old_domain','new_domain');

If you are using the prefix "wp_" You can replace other prefix if it came an bug. The same can happen with the database (unless you have not configured).

Sources:http://es.forums.wordpress.org/topic/problema-con-wordpress-recien-instalado http://marioguzman.net/como-migrar-un-wordpress-de-dominio/

###How I can move to another site without risk to crash?
Continuing with the previous question, the only way to move to another place without suffering problems of access or the like is to disable the security plugin. Once deactivated, makY a copy of the data stored in the database (you can use phpMyAdmin selecting "Agendaword" and follow the instructions).

##License and acknowledgment
* [Mozilla Public License 2.0 or later](http://www.mozilla.org/MPL/)
* [GNU General Public License 2.0 or later](http://www.gnu.org/)
* Incuye other licenses specified in the "plugins" folder and "themes".
