=== MD5 Media Renamer ===
Contributors: natexim
Donate link: 
Tags: filename, sanitize, media, upload, rename, md5, encrypt
Requires at least: 3.0
Tested up to: 3.6
Stable tag: 1.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Sanitize and rename automatically media files during upload using PHP time() as prefix and the file name encrypted in MD5() as suffix.

== Description ==

MD5 Media Renamer will automatically rename and convert to lower case your media file during the upload process using PHP time() stamp as prefix and the file name encrypted in MD5() as suffix in order to keep your upload folder clean and organized. More information can be found at : <a target="_blank" href="http://www.natexim.com/wp-rename-file-during-upload/">WP Rename file during upload</a>.

** Supported files Image extension **

*	.jpg
*	.jpeg
*	.png
*	.gif

** Supported files Document extension **

*	.pdf
*	.doc
*	.docx
*	.ppt 
*	.pptx
*	.pps
*	.ppsx
*	.odt
*	.xls
*	.xlsx

** Supported files Audio extension **

*	.mp3
*	.m4a
*	.ogg
*	.wav

** Supported files Video extension **

*	.mp4
*	.m4v
*	.mov
*	.wmv
*	.avi
*	.mpg
*	.ogv
*	.3gp
*	.3g2

== Screenshots ==

1. WP Upload directory of media file converted using the plugin.

== Changelog ==

= 1.0 =
* Initial release

= 1.1 =
* Check for WP context
* Update file header

= 1.2 =
* Added Welcome notice
* Fixed trigger bug upon activation

= 1.3 =
* Control if functions exist to avoid duplicate callback

= 1.4 =
* Remove ununsed sub-folder to avoid the confusion

= 1.5 =
* Fixed bug on function callback

== Installation ==

1. Install plugin and activate it on the Plugins page.
2. Now your media MD5 Media Renamer will be automatically rename all your media file during upload process.