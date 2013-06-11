<?php include('pages/haut.php'); ?>
<section id="page_inscription">
<?php

/*function envoi_mail($nom, $adresseMail, $message){
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
*/
if (!empty($_POST['mail'])&& !empty($_POST['pwd']) && !empty($_POST['nom']) && !empty($_POST['prenom'])) {
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=alc', 'root', '');
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}

	$req1 = $bdd->query('SELECT mail_membre FROM membre WHERE mail_membre = \''.$_POST["mail"].'\'');
	if ($verif = $req1->fetch() != true) {
		$req2 = $bdd->prepare('INSERT INTO membre (nom_membre, prenom_membre, mail_membre, mdp_membre) VALUES (:var1, :var2, :var3, :var5);');
		$req2->execute(array(
			'var1' => $_POST['nom'],
			'var2' => $_POST['prenom'],
			'var3' => $_POST['mail'],
			'var5' => md5($_POST['pwd'])
		));
		echo"<div><p>Message Envoyé</p></div>";

		$defaut = false;
	}
	else {

		$defaut = false;
		echo $verif['mail_membre'];
		if($verif['mail_membre'] == $_POST["mail"]) {$indispo_mail = true;
			echo "123456";}
	}
}
else
{
	$defaut = true;
	if (empty($_POST['mail']))
	{
	$vide_mail = true;
	}
	if (empty($_POST['pwd']))
	{
	$vide_pwd = true;
	}
	if (empty($_POST['nom']))
	{
	$vide_nom = true;
	}
	if (empty($_POST['prenom']))
	{
	$vide_prenom = true;
	}

}
if ($defaut) {
?>
			<fieldset>
				<legend id="titre"> Pour vous inscrire, veuillez remplir les champs ci-dessous : </legend>
	<form id="form_inscription" method="post" >

	
<?php	if (isset($vide_mail) || isset($vide_pwd) || isset($vide_nom) || isset($vide_prenom)){
			echo "<p>Erreur : case ";
			if (!isset($vide_mail)){echo"mail ";}
			if (!isset($vide_pwd)){echo"password ";}
			if (!isset($vide_nom)){echo"nom ";}
			if (!isset($vide_prenom)){echo"prenom ";}
			echo "vide.";
			echo" </p>";
		}
		if (isset($indispo_mail))) {
			echo "<p>Erreur : ";
			if (isset($indispo_mail)){echo"mail";}
			echo" </p>";
		}
		 ?>
		<a><p><label for="mail">Adresse Mail : </label><input id="mail" name="mail" type="email" class="<?php if (empty($vide_mail)){echo "error ";} if (isset($indispo_mail)){echo"indispo";} ?>" required></p>
		<p><label for="prenom">Prenom : </label><input id="prenom" name="prenom" type="text" class="<?php if (isset($vide_login)){echo "error";} ?>" required></p>
		<p><label for="nom">Nom : </label><input id="nom" name="nom" type="text" class="<?php if (isset($vide_pwd)){echo "error";} ?>" required></p>
		<br>
		<p><label for="pwd">Votre mot de passe : </label><input id="pwd" name="pwd" type="password" required></p>
		<input id="envoyer" type="submit" value="Envoyer"></a>

</form>
</fieldset>
<?php } ?>
</section>
<?php include('pages/bas.php'); ?>
