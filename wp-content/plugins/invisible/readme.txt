=== Invisible ===
Contributors: colorchips
Tags: private post, attachment
Requires at least: 3.8.1
Tested up to: 3.8.1
Stable tag: 0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Protect private post attachment file.

== Description ==

This plugin moving attachment file to other protected directory.

`/wp-content/uploads/path/to/file` -> `/wp-content/uploads/protect/path/to/file`

But, attachment file url is not changed.
WordPress will return the attachment file content, check the access permission.

== Installation ==

1. Upload the `invisible` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the Plugins menu in WordPress.

Protected directory is deny access by htaccess file.
If using nginx server, **you must edit nginx.conf** to location settings.

== Screenshots ==

1. Enable protection at media library.


== Changelog ==
