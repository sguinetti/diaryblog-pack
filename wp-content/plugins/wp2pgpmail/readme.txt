=== wp2pgpmail ===
Contributors: wp2pgpmail
Donate link: http://wp2pgpmail.com
Tags: PGP, mail, contact form, encrypt, crypt, privacy, encode, secure, encryption, GnuPG, GPG
Requires at least: 2.9.2
Tested up to: 3.8
Stable tag: 1.16
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple PGP Mail Form Plugin. Enter your PGP public key, then visitors will be able to send you PGP encrypted messages by mail from a form.

== Description ==

With wp2pgpmail, your visitors can send you a PGP encrypted message very easily. A contact form will offer encryption for sending you confidental messages.

**NEW !!**

We have now released a Pro version: [Gravity Forms PGP Encryption plugin](http://wp2pgpmail.com)

It's working with [Gravity Forms](http://bit.ly/GravityFormsPlugin), the best full featured contact form plugin for WordPress.

With the Pro version, you will get:

* Additional Fields
* Unlimited Forms
* Nested Drag n' Drop
* Advanced Email Configuration

Check it at [http://wp2pgpmail.com](http://wp2pgpmail.com). We are still working on the Free version.

How does it work ?

wp2pgpmail includes an OpenPGP Message Encryption System in Javascript, based on [Herbert Hanewinkel's work](http://www.haneWIN.de). Visitors enter a message in a form, encrypt it (with the PGP public key you entered in wp2pgpmail option settings), then an e-mail is sent to you (blog admin e-mail address). The message is encrypted locally on the visitor's computer, so no data is transfered in clear !

[youtube http://www.youtube.com/watch?v=nnY2xirKXkQ]

Is it secure ?

* All code is implememented in readable Javascript.
* You can verify the source code.
* No binaries are loaded from a server or used embedded.
* No hidden transfer of plain text.

Supported languages :

* English
* French
* German
* Spanish
* Estonian

== Installation ==

1. Upload and extract the content of 'wp2pgpmail.zip' to the '/wp-content/plugins/' directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Paste your PGP public key in the option setting page of wp2pgpmail
1. Place the tag **[wp2pgpmail]** in the HTML code of the page you want to see the form
1. Enjoy!

== Frequently Asked Questions ==

= Where do I get a public PGP key and how do I uncrypt messages ? =
The easiest way to use PGP is to install Mozilla Thunderbird with the [Enigmail extension](http://enigmail.mozdev.org/). For more information about the installation and how to use this software, go to [About PGP](http://wp2pgpmail.com/about-pgp/) and [Enigmail installation instructions](http://wp2pgpmail.com/pgp-with-enigmail/)

= wp2pgpmail is not available in my language. What can I do ? =
You can translate wp2pgpmail in your language, then submit your translation, so everybody would can use it.
To do it, we have [a project hosted at Transifex](https://www.transifex.net/projects/p/wp2pgpmail/) where you can add the translation in your language. It's simple, fast and effective. Or:

1. Download and install [Poedit](http://www.poedit.net/)
1. Open the wp2pgpmail POT file from **wp2pgpmail/i18n/wp2pgpmail.pot**
1. Go to **File => Save as...** to save your translations in a PO file (*wp2pgpmail-fr_FR.po* for example)
1. When you are finished translating, go to **File => Save as...** again to generate the MO file
1. Send us the PO and MO files to translation@wp2pgpmail.com : we will add them to the next release of the plugin

If you want to translate the Pro Edition, please [contact us !](http://wp2pgpmail.com/contact/)

== Screenshots ==
Screenshots are available on the [wp2pgpmail plugin website](http://wp2pgpmail.com/screenshots/).

== Changelog ==
= 1.16 =
* Captcha is now optional
* IP Address Collect is now optional (Germany's Telemedia Act defines IP addresses as personal data and prohibits the use of these IP addresses for the purpose of analyzing individual web traffic behavior)

= 1.15 =
* Added Danish translation (user contributed)

= 1.14 =
* Updated German translation (user contributed)

= 1.13 =
* Fixing translation support

= 1.12 =
* Improving WordPress compliance (user contributed)

= 1.11 =
* Improving SSL support

= 1.10 =
* Using **wp_mail** function instead of **mail** function (user contributed)

= 1.09 =
* Added link to wp2pgpmail Support Team

= 1.08 =
* bug fix : PGP public keys with a comment line inside were not recognized

= 1.07 =
* Added Estonian translation (user contributed)

= 1.06 =
* Added Spanish translation (user contributed)

= 1.05 =
* Added German translation (user contributed)

= 1.04 =
* Changing the tag to **[wp2pgpmail]** (using Shortcode API now)

= 1.03 =
* Changing the tag to **{wp2pgpmail}**
* Adding new fields to the form
* Adding empty index files to protect all directories

= 1.02 =
* Fixing bug with some themes

= 1.01 =
* Initial import

== Upgrade Notice ==
= 1.04 =
* The tag must now be **[wp2pgpmail]** to run the plugin

= 1.03 =
* The tag must now be **{wp2pgpmail}** to run the plugin
