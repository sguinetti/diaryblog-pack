<?php

class Formulaire {
	function __construct() {
		$siteurl = site_url();
		$wp2pgpmail_pgpkey_keyid = get_option('wp2pgpmail_pgpkey_keyid');
		$wp2pgpmail_pgpkey_pkey = get_option('wp2pgpmail_pgpkey_pkey');
		$wp2pgpmail_pgpkey_vers = get_option('wp2pgpmail_pgpkey_vers');
		$wp2pgpmail_pgpkey_pktype = get_option('wp2pgpmail_pgpkey_pktype');
		$wp2pgpmail_pgpkey = get_option('wp2pgpmail_pgpkey');
		$wp2pgpmail_captcha_field = get_option('wp2pgpmail_captcha_field');
		$wp2pgpmail_collect_ip = get_option('wp2pgpmail_collect_ip');
		
		$mail_champ_nom = __('Name','wp2pgpmail');
		$mail_champ_email = __('E-mail Address','wp2pgpmail');
		$mail_champ_message = __('Message','wp2pgpmail');
		$mail_champ_adresseIP = __('IP Address','wp2pgpmail');
		$mail_footer = __('This message has been sent from your website','wp2pgpmail') .' '. get_permalink() .' '. __('and has been encrypted using wp2pgpmail.','wp2pgpmail');
		
		$message_champ_incomplet = __('A field has not been completed. Thank you to complete in order to validate the form.','wp2pgpmail');
		$message_email_incorrect = __('The email address you typed is incorrect.','wp2pgpmail');
		$message_champ_crypte = __('encrypted data','wp2pgpmail');
		
		$formulaire_adresse_page = get_permalink();
		$formulaire_champ_nom = __('Your Name','wp2pgpmail');
		$formulaire_champ_email = __('Your E-mail Address','wp2pgpmail');
		$fomulaire_champ_message = __('Your Message','wp2pgpmail');
		$formulaire_bouton_encrypter = __('Encrypt Message','wp2pgpmail');
		$formulaire_bouton_reset = __('Reset','wp2pgpmail');
		$formulaire_bouton_recharger_image = __('Reload image','wp2pgpmail');
		$formulaire_champ_captcha = __('Type the word:','wp2pgpmail');
		$formulaire_bouton_envoyer = __('Send','wp2pgpmail');
		
		if ( $wp2pgpmail_collect_ip == 'disabled' ) {
			$adresseIP = __('DATA NOT COLLECTED BY POLICY','wp2pgpmail');
		} else {
			$adresseIP = $_SERVER['REMOTE_ADDR'];
		}
		
		$this->Output = <<<EOF
<!-- wp2pgpmail - Begin -->
<script src="$siteurl/wp-content/plugins/wp2pgpmail/js/rsa.js" type="text/javascript"></script> 
<script src="$siteurl/wp-content/plugins/wp2pgpmail/js/aes-enc.js" type="text/javascript"></script> 
<script src="$siteurl/wp-content/plugins/wp2pgpmail/js/base64.js" type="text/javascript"></script> 
<script src="$siteurl/wp-content/plugins/wp2pgpmail/js/PGpubkey.js" type="text/javascript"></script> 
<script src="$siteurl/wp-content/plugins/wp2pgpmail/js/mouse.js" type="text/javascript"></script> 
<script src="$siteurl/wp-content/plugins/wp2pgpmail/js/PGencode.js" type="text/javascript"></script> 
<script type="text/javascript"> 

var keytyp = 1;
var keyid  = '$wp2pgpmail_pgpkey_keyid';
var pubkey = '$wp2pgpmail_pgpkey_pkey';
 
function getkey() {
	var pu=new getPublicKey(document.s.pubkey.value);
	if(pu.vers == -1) return;

	document.s.vers.value=pu.vers;
	document.s.user.value=pu.user;
	document.s.keyid.value=pu.keyid;

	pubkey = pu.pkey.replace(/\\\\n/g,'');
	document.s.pkey.value=pubkey;
	document.s.pktype.value=pu.type;
}
 

function encrypt() {
	
	if ( document.t.message_from_name.value == "" || document.t.message_from_mail.value == "" || document.t.message_body.value == "" ) {
		alert("$message_champ_incomplet");
		return false;
	}
	
	var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
	if(!reg.test(document.t.message_from_mail.value)) {
		alert("$message_email_incorrect");
		return false;
	}
	
	document.t.message_from_name.readOnly=true;
	document.t.message_from_mail.readOnly=true;
	document.t.message_body.readOnly=true;
	document.t.message.value = "$mail_champ_nom : " + document.t.message_from_name.value + "\\n" + "$mail_champ_email : " + document.t.message_from_mail.value + "\\n" + "$mail_champ_message : " + document.t.message_body.value + "\\n\\n";
	document.t.message.value += "$mail_champ_adresseIP : " + "$adresseIP" + "\\n\\n";
	document.t.message.value += "$mail_footer" + "\\n\\n" + "http://wp2pgpmail.com/";
	document.t.bouton_envoi.disabled=false;
	document.t.encrypter.disabled=true;
	
	keyid="$wp2pgpmail_pgpkey_keyid";
	if(document.s.keyid.value.length) keyid=document.s.keyid.value;
	if(keyid.length != 16) {
		alert('Invalid Key Id');
		return;
	}
	 
	 keytyp = 1;
	 if(document.s.pktype.value == 'ELGAMAL') keytyp = 1;
	 if(document.s.pktype.value == 'RSA')     keytyp = 0;
	 if(keytyp == -1) {
		alert('Unsupported Key Type');
		return;
	 } 
	 
	 var startTime=new Date();
	 
	 var text=document.t.text.value+'\\r\\n';
	 document.t.text.value=doEncrypt(keyid, keytyp, pubkey, text);
	 
	 var endTime=new Date();
	 document.t.howLong.value=(endTime.getTime()-startTime.getTime())/1000.0;
	 
	 document.t.message_from_name.value="-- "+"$message_champ_crypte"+" --";
	 document.t.message_from_mail.value="-- "+"$message_champ_crypte"+" --";
	 document.t.message_body.value="-- "+"$message_champ_crypte"+" --";
	 
	 return true;
}


function recommencer() {
	document.t.message_from_name.readOnly=false;
	document.t.message_from_mail.readOnly=false;
	document.t.message_body.readOnly=false;
	document.t.bouton_envoi.disabled=true;
	document.t.encrypter.disabled=false;
}
</script> 
<form name="t" action="$formulaire_adresse_page" method="post">
				<table style="border-width: 0px;">
					<tr>
						<td style="border-width: 0px;">$formulaire_champ_nom :</td>
						<td style="border-width: 0px;"><input type="text" name="message_from_name" id="message_from_name" value="" size="34" /></td>
					</tr>
					<tr>
						<td style="border-width: 0px;">$formulaire_champ_email :</td>
						<td style="border-width: 0px;"><input type="text" name="message_from_mail" id="message_from_mail" value="" size="34" /></td>
					</tr>
				</table>
				$fomulaire_champ_message :<br />
				<textarea name="message_body" id="message_body" value="" rows="15" cols="50"></textarea>
				<br />
				<input type="hidden" name="text" id="message" />
				<input type="hidden" name="howLong" />
				<input type="hidden" name="submitted" id="submitted" value="true" />
				<br /> 
				<table style="border-width: 0px;">
					<tr>
						<td style="border-width: 0px;"><input onclick="encrypt();" type="button" value="$formulaire_bouton_encrypter" id="encrypter"></td>
						<td style="border-width: 0px;"><input onclick="recommencer();" type="reset" value="$formulaire_bouton_reset"></td>
					</tr>
					<tr>
						<td colspan="2" style="border-width: 0px;">
EOF;
		if ( $wp2pgpmail_captcha_field == 'enabled' ) {
			$this->Output .= <<<EOF
							<img src="$siteurl/wp-content/plugins/wp2pgpmail/phpcaptcha/securimage_show.php" id="captcha" alt="" /><a href="#" onclick="document.getElementById('captcha').src = '$siteurl/wp-content/plugins/wp2pgpmail/phpcaptcha/securimage_show.php?' + Math.random(); return false"><img src="$siteurl/wp-content/plugins/wp2pgpmail/images/reload.png" alt="$formulaire_bouton_recharger_image" border="0" /></a><br />
							$formulaire_champ_captcha<br />
							<input type="text" size="10" maxlength="6" name="code" /><br />
EOF;
		}
			$this->Output .= <<<EOF
			<input type="submit" name="submit" id="bouton_envoi" value="$formulaire_bouton_envoyer" /></td>
					</tr>
						
				</table>


</form>

<script type="text/javascript"> 
document.t.bouton_envoi.disabled=true;
</script>
<form name="s">
	<input type="hidden" name="pubkey" value="$wp2pgpmail_pgpkey" />
	<input type="hidden" name="vers" value="$wp2pgpmail_pgpkey_vers" />
	<input type="hidden" name="keyid" value="$wp2pgpmail_pgpkey_keyid" />
	<input type="hidden" name="pktype" value="$wp2pgpmail_pgpkey_pktype" />
	<input type="hidden" name="pkey" value="$wp2pgpmail_pgpkey_pkey" />
</form>
<!-- wp2pgpmail - End -->
EOF;
		return $this->Output;
	}
}