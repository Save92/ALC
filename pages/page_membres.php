<?php 
if(!empty($_GET['page'])){
	if($_GET['page'] == "deconnexion"){
		$_SESSION['id'] = 0;
		session_destroy();
		include('pages/haut.php'); 
		?>
			<section id="page_deconnexion">
				<meta http-equiv="refresh" content="2; URL=?page=accueil" ></meta>
				<div><div><h1>Deconnecté</h1></div></div>
			</section>
			</body>
			</html>
		<?php
		exit;
	}
}
if(!empty($_POST['login']) && !empty($_POST['password'])){
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=alc', 'root', '');
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	$mdp = md5($_POST["password"]);
	$req = $bdd->query('SELECT * FROM membre WHERE mail_membre = \''.$_POST["login"].'\' OR mdp_membre = \''.$mdp.'\' ');
	if( $donnes = $req->fetch())
	{
		$_SESSION['id'] = $donnes['num_membre'];
		$_SESSION['nom_complet'] = $donnes['nom_membre']." ".$donnes['prenom_membre'];
		if ($donnes['permission_membre'] == 1) {$_SESSION['admin'] = "1";}

	}

}


if(empty($_SESSION['id'])){
	include('pages/haut.php'); 
	?>
		<section id="page_connexion">
			<div>
				<div id="background">
					<div></div>
				</div>
				<div id="mask">
					<form method="post">
						<p><label>Votre Login : <br><input type="text" id="login" name="login"></label></p>
						<p><label>Mot de passe : <br><input type="password" id="password" name="password"></label></p>
						<p><input type="submit" id="button_connexion" value="Connexion"></p>
					</form>
				</div>
			</div>
		</section>
<?php
include('pages/bas.php');
	}

	else{
	include('pages/haut.php'); 
?>
	<section id="page_membres">
		<div>
			<fieldset>
				<legend>Information du Compte</legend> 
				<input type="checkbox" id="cache" name="cache" hidden/>
				<label for="cache">
					<h1>Pour affichez les informations, cliquez ici</h1>
					<h4>Pour caché les informations, cliquez ici</h4>
				</label>
				<div>
					<form method="post">	
					<p><h3>Modifications du mots de passe</h3></p>
					<p>Saisir votre mot de passe :
					<input type="text"></p>
					<p>Saisir votre nouveau mot de passe :
					<input type="text"></p>
					<p>Réécrire le nouveau mots de passe :
					<input type="text"></p>
					<p><input type="submit" value="Soumettre"></p>
					<form>
				</div>




			</fieldset>
			<fieldset>
				<legend>Gestion de projet</legend> 
				<ul>
					<?php

					for($i = 1; $i <= 10; $i++)
					{ ?>
					<li>
						<a href="">
							<img src="http://www.centaures-footus.com/modules/Gallery/icone-Dossier.png" width="64px" height="64px" />
							<p>Honda civic</p>
						<a/>
					</li>
					<?php
					}
					?>
				</ul>

				


			</fieldset>
		</div>
	</section>

<?php
include('pages/bas.php');
//session_destroy();
 }  ?>