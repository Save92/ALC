<?php include('pages/haut.php'); ?>
<section id="page_contact">
	<div>
<?php

function envoi_mail($nom, $adresseMail, $message){
	$to = 'njournaud@hotmail.fr';

	$subject = '[CONTACT] Question de '.$nom;

	// Message
	$msg = $message;

	// Headers
	$headers = 'From: '.$nom.' <'.$adresseMail.'>'."\r\n";
	$headers .= 'Bcc: ALC <njournaud@gotmail.fr>;'."\r\n";
	$headers .= "\r\n";

	// Function mail()
	mail($to, $subject, $msg, $headers);
}

	if(isset($_POST['nom']) && isset($_POST['mail']) && isset($_POST['message'])) {

	envoi_mail($_POST['nom'],$_POST['mail'],$_POST['message'] );
?>
<div id="msg_envoye"><p>Message Envoyé</p></div>
<?php
	}
	else{
?>
	<fieldset id="contact-us">
		<legend id="titre">Nous sommes présent : </legend>
		<p>Par Mail : <a href="maito:contact@alc.com">contact@alc.com</a></p>
		<p>Sur Facebook : <a href="">Facebook/AlC</a></p>
	</fieldset>
	<fieldset id="question">
		<legend id="titre"> Posez nous votre question : </legend>
		<form method="post" >
			<p><label for="nom">Nom : </label><input id="nom" name="nom" type="text" required></p>
			<p><label for="mail">Adresse Mail : </label><input id="mail" name="mail" type="email" required></p>
			<p><label for="message">Votre question : </label><textarea id="message" name="message" type="text" required></textarea></p>
			<p id="valider"><input type="submit" value="Envoyer" ></p>
		</form>
	</fieldset>
<?php
	}
?>
</div>
</section>
<?php include('pages/bas.php'); ?>