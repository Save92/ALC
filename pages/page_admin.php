<?php 
include('pages/haut.php');
if(!isset($_SESSION['admin'])){
	echo '<section id="page_admin">!!! Accées Interdit !!!</section>';
}else{
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=alc', 'root', '');
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
 ?>
<section id="page_admin">
<div>
	<fieldset>
		<legend>Menu</legend>
		<ul>
			<li><a href="?page=admin&choix=membre">Liste des Membres</a></li>
			<li><a href="?page=admin&choix=devis">Liste des devis</a></li>
			<li><a href="?page=admin&choix=projets">Liste des projets</a></li>
			<li><a href="?page=admin&choix=vehicule">Liste des véhicules</a></li>
			<li><a href="?page=admin&choix=carrousel">Config du Carrousel</a></li>
		</ul>
	</fieldset>
<?php
	if(isset($_GET['choix'])){
	switch($_GET['choix']){
		case "membre":
			if(isset($_GET['fonction']))
				{if($_GET['fonction'] == "delete"){
					$req = $bdd->query('DELETE FROM membre WHERE num_membre =\''.$_GET['id'].'\'');
				}
				elseif($_GET['fonction'] == "create"){
					$req = $bdd->prepare('INSERT INTO membre( nom_membre, prenom_membre, mail_membre, mdp_membre, date_inscription) VALUES(:nom, :prenom, :mail, :mdp, :time)');
					$req->execute(array(
					    'nom' => $_POST['nom'],
					    'prenom' => $_POST['prenom'],
					    'mail' => $_POST['mail'],
					    'mdp' => md5($_POST['mdp']),
					    'time' => time()
					    ));
				}};
			$req = $bdd->query('SELECT * FROM membre');
			echo' 
				<fieldset>
					<legend>Liste des Membres</legend>
					<table>
						<thead><td width="100px">Nom</td><td width="100px">Prenom</td><td width="200px">Mail</td><td width="200px">Date Inscription</td></thead>';
			while($donnes = $req->fetch()){
				echo'<tr><td>'.$donnes["nom_membre"].'</td><td>'.$donnes["prenom_membre"].'</td><td>'.$donnes["mail_membre"].'</td><td>'.date ('d-m-Y G:i',$donnes["date_inscription"]).'</td><td class="icon_del"><a href="?page=admin&choix=membre&fonction=delete&id='.$donnes["num_membre"].'"></a></td></tr>';
			}
			echo'
					</table><br><br>
					<form action="?page=admin&choix=membre&fonction=create" method="post">
						<input name="nom" placeholder="Nom">
						<input name="prenom" placeholder="Prenom">
						<input name="mail" placeholder="Mail">
						<input name="mdp" placeholder="Mot de passe">
						<input type="submit">
					</form>
				</fieldset>';
		break;
		case "devis":
			if(isset($_GET['fonction']))
				{
				if($_GET['fonction'] == "delete"){
					$req = $bdd->query('DELETE FROM devis WHERE num_devis =\''.$_GET['id'].'\'');
				}
				elseif($_GET['fonction'] == "update"){
					$req1 = $bdd->query('SELECT * FROM devis WHERE num_devis =\''.$_GET['id'].'\'');
					$donnes1 = $req1->fecth();
					$req2 = $bdd->query('DELETE FROM devis WHERE num_devis =\''.$_GET['id'].'\'');
					$donnes2 = $req1->fecth();

					$req3 = $bdd->query('SELECT * FROM membre WHERE mail_membre =\''.$donnes1['mail_devis'].'\'');
					if(true){


						$req4 = $bdd->prepare('INSERT INTO projet(nom_projet, num_vehicule, theme, date_projet, description_projet, motcles_projet ) VALUES(:nom, :num_vehicule, :theme, :date, :description, :motcles)');
						$req4->execute(array(
						    'nom' => $donnes1['marque'],
						    'num_vehicule' => "",
						    'theme' => $donnes1['theme'],
						    'date' => $date("Y"),
						    'description' => $donnes1['description'],
						    'motcles' => ""
						    ));
					}

				}};
			$req = $bdd->query('SELECT * FROM devis');
			echo' 
				<fieldset>
					<legend>Liste des Devis</legend>
					<table>
						<thead><td width="100px">Nom</td><td width="100px">Prenom</td><td width="150px">Mail</td><td width="100px">Marque</td><td>Modéle</td><td>Annee</td><td>Budget Min</td><td>Budget Max</td></thead>';
			while($donnes = $req->fetch()){
				echo'<tr><td>'.$donnes["nom_devis"].'</td><td>'.$donnes["prenom_devis"].'</td><td>'.$donnes["mail_devis"].'</td><td>'.$donnes["marque"].'</td><td>'.$donnes["modele"].'</td><td>'.$donnes["annee"].'</td><td>'.$donnes["budget_min"].'</td><td>'.$donnes["budget_max"].'</td><td rowspan=2><a class="icon_del" href="?page=admin&choix=devis&fonction=delete&id='.$donnes["num_devis"].'"></a><a class="icon_val" href="?page=admin&choix=devis&fonction=update&id='.$donnes["num_devis"].'"></a></td></tr>';
				echo'<tr><td colspan=4>'.utf8_encode($donnes["description"]).'</td></tr>';
			}
			echo'
					</table>
				</fieldset>';
		break;



		case "projets":
			echo' 
				<fieldset>
					<legend>Liste des Projets</legend>
					<table>
						<thead><td width="100px">Nom</td><td width="100px">Prenom</td><td width="200px">Mail</td><td width="200px">Date Inscription</td></thead>';
				echo'					</table>
				</fieldset>';
		break;
		case "vehicule":
			if(isset($_GET['fonction']))
				{if($_GET['fonction'] == "delete"){
					$req = $bdd->query('DELETE FROM vehicule WHERE num_vehicule =\''.$_GET['id'].'\'');
				}
				elseif($_GET['fonction'] == "create"){
					$req = $bdd->prepare('INSERT INTO vehicule( marque, modele, annee, type) VALUES(:marque, :modele, :annee, :type)');
					$req->execute(array(
					    'marque' => $_POST['marque'],
					    'modele' => $_POST['modele'],
					    'annee' => $_POST['annee'],
					    'type' => $_POST['type']
					    ));
				}};
			$req = $bdd->query('SELECT * FROM vehicule');
			echo' 
				<fieldset>
					<legend>Liste des Vehicules</legend>
					<table>
						<thead><td width="100px">Marque</td><td width="100px">Modèle</td><td width="70px">Années</td><td width="50px">Projet</td><td width="50px">Devis</td></thead>';
			while($donnes = $req->fetch()){
				echo'<tr><td>'.$donnes["marque"].'</td><td>'.$donnes["modele"].'</td><td>'.$donnes["annee"].'</td><td></td><td></td><td class="icon_del"><a href="?page=admin&choix=vehicule&fonction=delete&id='.$donnes["num_vehicule"].'"></a></td></tr>';
			}
			echo'

					</table>
					<form action="?page=admin&choix=vehicule&fonction=create" method="post">
						<input name="marque">
						<input name="modele">
						<input name="annee">
						<input name="type">
						<input type="submit">
					</form>
				</fieldset>';
		break;
		case "carrousel":
			if(isset($_GET['fonction']))
				{if($_GET['fonction'] == "delete"){
					$req = $bdd->query('DELETE FROM carrousel WHERE url_images =\''.$_GET['id'].'\'');
				}
				elseif($_GET['fonction'] == "create"){
					if ($_FILES['image']['error'] > 0) {echo "ERROR";} 
					else
					{
					$req = $bdd->prepare('INSERT INTO carrousel( url_images, nom_images, desc_images) VALUES(:url, :nom, :desc_img)');
					$req->execute(array(
					    'url' => $_POST['url'],
					    'nom' => $_FILES['image']['name'],
					    "desc_img" => $_POST['nom']
					    ));
					$resultat = move_uploaded_file($_FILES['image']['tmp_name'], "upload/carrousel/".$_FILES['image']['name']);
				}}};		
			$req = $bdd->query('SELECT * FROM carrousel');
			echo' 
				<fieldset id="carrousel">
					<legend>Liste des Projets</legend>
					<table>
						<thead><td width="100px">Nom</td><td width="140px">Url</td><td width="120px">Description</td></thead>';
			while($donnes = $req->fetch()){
				echo'<tr><td>'.$donnes["nom_images"].'</td><td>'.$donnes["url_images"].'</td><td>'.$donnes["desc_images"].'</td><td><a class="icon_del" href="?page=admin&choix=carrousel&fonction=delete&id='.$donnes["url_images"].'"></a></td></tr>';
			}
			echo'
					</table>
					<form action="?page=admin&choix=carrousel&fonction=create" method="post">
						<p>Nom de l\'image :</p>
						<p><input name="nom"></p><br>
						<p>Lien :</p>
						<p><input name="url"></p><br>
						<p>Saisi du fichier images: 672px*300px</p>
						<p><input name="image" type="file"></p><br>
						<p class="right"><input type="submit"></p>
					</form>
				</fieldset>';


		break;
	}}
	else{
		echo"
		<fieldset>
			<h2>Welcome to Hell World :D</h2>
		</fieldset>";

	}
?></div>
</section>
<?php }
include('pages/bas.php'); ?>