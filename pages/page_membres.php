<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=alc', 'root', '');
if(!empty($_GET['page'])){
	if($_GET['page'] == "deconnexion"){
		$_SESSION['id'] = 0;
		session_destroy();
		include('pages/haut.php'); 
		?>
			<section id="page_deconnexion">
				<meta http-equiv="refresh" content="2; URL=?page=accueil" ></meta>
				<div id="message"><h1>Déconnecté</h1></div>
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
	$req = $bdd->query('SELECT * FROM membre WHERE mail_membre = \''.$_POST["login"].'\' AND mdp_membre = \''.$mdp.'\' ');
	if( $donnes = $req->fetch())
	{
		$_SESSION['id'] = $donnes['num_membre'];
		$_SESSION['nom_complet'] = $donnes['nom_membre']." ".$donnes['prenom_membre'];
		if ($donnes['permission_membre'] == 1) {$_SESSION['admin'] = "1";}

	}

}
if(isset($_POST['mdp']) && isset($_POST['new_mdp']) && isset($_POST['repeat_mdp'])){
	if($_POST['new_mdp']==$_POST['repeat_mdp']){
		$req = $bdd->prepare('SELECT num_membre, mdp_membre FROM `membre` 
		WHERE num_membre= ? AND mdp_membre= ?');
		$req->execute(array($_SESSION['id'],md5($_POST['mdp'])));
		$count1 =$req->rowCount();
		if ($count1!=0){
		while($donnees=$req->fetch()){
			if($donnees['num_membre']==$_SESSION['id'])
			{
				$req2 = $bdd->prepare('UPDATE `membre` set mdp_membre= ? 
				WHERE num_membre= ?');
				$req2->execute(array(md5($_POST['new_mdp']), $_SESSION['id']));
				$mdp_info="Changement du mot de passe effectué !";
			}
			}
		}
			else $mdp_info="Votre mot de passe est incorrect !";
		}
	else{$mdp_info="Les deux nouveaux mot de passe ne sont pas correspondant."; }
	
}
if(isset($_POST['sup_mdp']))
{
	$req1 = $bdd->prepare('SELECT mdp_membre FROM `membre` 
		WHERE num_membre= ? AND mdp_membre= ?');
		$req1->execute(array($_SESSION['id'],md5($_POST['sup_mdp'])));
		$count =$req1->rowCount();
	if ($count!=0){
	while($donnees1=$req1->fetch()){
		
				$req3 = $bdd->prepare('DELETE FROM `membre` WHERE num_membre= ?');
				$req3->execute(array($_SESSION['id']));
				$mdp_info="Votre compte à été supprimer !";
				session_destroy();
				echo '<meta http-equiv="refresh" content="2; URL=?page=accueil" ></meta>';
		}
		
	}
	else $mdp_info="Mot de passe incorrect !";
}

if(isset($_GET['mdp']))
{
			//Fonction mdp oublié
		if (isset($_POST['oublie']))
		{
			$resultat = $bdd->query('UPDATE membre SET mdp_membre = "'.md5("test").'" WHERE mail_membre = \''.$_POST["mail"].'\'');
			if($resultat->rowCount() != 0)
			{
				$mdp_info="Mot de passe réinitialisé à 'test'.";

			}	
			else $mdp_info="Mail incorrect !";

		}
	include('pages/haut.php'); 
	echo '
			<section id="page_connexion">
			<fieldset id="field_mdp_oublie"> <br>
			<form id="mdp_oublie" method="post">
			<p>Mot de passe oublié ?</p>';
			if(isset($mdp_info)){
					echo '<p>'.$mdp_info.'</p>';
				}	
				echo'
			<p><label for="mail">Votre adresse Mail : </label><input id="mail" name="mail" type="email" required></p>
			<input type="text" name="oublie" value="ok" style="display:none;">
			<p><input type="submit"></p>
			</form>	
			</fieldset>
			</section>';
	include('pages/bas.php');
}
elseif(empty($_SESSION['id'])){
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
			<span><a href="?page=membre&mdp=oublie">Mot de passe oublié ?<a></span>
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
				<?php if(isset($mdp_info)){
					echo '<p>'.$mdp_info.'</p>';
				}	
				?>
				<div>
					<form method="post">	
					<p><h3>Modifications du mots de passe</h3></p>
					<p>Saisir votre mot de passe :
					<input name="mdp" type="password" required></p>
					<p>Saisir votre nouveau mot de passe :
					<input name="new_mdp" type="password" required></p>
					<p>Réécrire le nouveau mots de passe :
					<input name="repeat_mdp" type="password" required></p>
						<p><input id="modif_mdp" type="submit" value="Soumettre"></p><br>
					</form>
						<br>
					<form method="post">
						<p><h3>Pour supprimer votre compte :</h3></p>
						<p>Saisir votre mot de passe :
						<input id="sup_mdp" name="sup_mdp" type="password" required></p>
						<p> Et appuyer sur "Supprimer" :
						<input id="sup_compte" type="submit" value="Supprimer"></p>
					</form>

				</div>


			</fieldset>
			<fieldset>
				<legend>Gestion de projet</legend> 
				<ul>
					<?php
						$variable = $_SESSION['id'];
						$bdd = new PDO('mysql:host=127.0.0.1;dbname=alc', 'root', '');
						$res = $bdd->prepare('SELECT projet.num_projet,nom_projet,theme,date_projet,num_image
						FROM `projet`,`image` WHERE projet.num_projet=image.num_projet AND projet.num_membre= ? GROUP BY projet.num_projet');
						$res->execute(array($variable));
						$count =$res->rowCount();
						if ($count!=0){
							while($donnees=$res->fetch())
							{
							echo '<li>
								<a href="?page=suivi_projet&suivi_projet='.$donnees['num_projet'].'">
								<img width="90px" height="90px" src="upload/'.$donnees['num_image'].'.jpg">
								<p>'.$donnees['nom_projet'].'</p>
								</a>
								</li>';
							}
							//req->closeCursor();
						}
						else
						{
							echo "Aucun projet correspondant...";
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