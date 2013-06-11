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
			<li><a href="?page=admin&choix=menu">Config du Menu</a></li>
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
					<table cellspacing="0" id="table_membre">
						<thead><td width="100px">Nom</td><td width="100px">Prenom</td><td width="200px">Mail</td><td width="200px">Date Inscription</td></thead>';
			while($donnes = $req->fetch()){
				echo'<tr><td>'.$donnes["nom_membre"].'</td><td>'.$donnes["prenom_membre"].'</td><td>'.$donnes["mail_membre"].'</td><td>'.date ('d-m-Y G:i',$donnes["date_inscription"]).'</td><td><a class="icon_del" href="?page=admin&choix=membre&fonction=delete&id='.$donnes["num_membre"].'"></a></td></tr>';
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
					while($donnes1 = $req1->fetch()){

						$req2 = $bdd->query('SELECT * FROM membre WHERE mail_membre =\''.$donnes1['mail_devis'].'\'');
						$count = $req2->rowCount();
															
						if ($count == 0) {
							$req4 = $bdd->prepare('INSERT INTO membre(nom_membre, prenom_membre, mail_membre, mdp_membre, date_inscription ) VALUES(:nom, :prenom, :mail, :mdp, :date)');
							$req4->execute(array(
							    'nom' => $donnes1['nom_devis'],
							    'prenom' => $donnes1['prenom_devis'],
							    'mail' => $donnes1['mail_devis'],
							    'mdp' => "098f6bcd4621d373cade4e832627b4f6",
							    'date' => time()
							));
							$membre = $bdd->lastInsertId();
						} 
						else { while($donnes2 = $req2->fetch()){$membre = $donnes2['num_membre'];}}

						$req3 = $bdd->query('SELECT * FROM vehicule WHERE marque =\''.$donnes1['marque'].'\' AND modele =\''.$donnes1['modele'].'\' AND annee =\''.$donnes1['annee'].'\' ');
						$count2 = $req3->rowCount();

						if ($count2 == 0) {
							$req4 = $bdd->prepare('INSERT INTO vehicule(marque, modele, annee, type ) VALUES(:marque, :modele, :annee, :type)');
							$req4->execute(array(
							    'marque' => $donnes1['marque'],
							    'modele' => $donnes1['modele'],
							    'annee' => $donnes1['annee'],
							    'type' => $donnes1['type']
							));
							$vehicule = $bdd->lastInsertId();
						}
						else { while($donnes2 = $req3->fetch()){$vehicule = $donnes2['num_vehicule'];}}
						$req4 = $bdd->prepare('INSERT INTO projet(nom_projet, num_vehicule, num_membre, date_projet, description_projet, motscles_projet,theme) VALUES(:nom, :num_vehicule, :num_membre, :date, :description, :motcles, :theme)');
						$req4->execute(array(
							    'nom' => $donnes1['marque'],
							    'num_vehicule' => $vehicule,
							    'num_membre' => $membre,
							    'date' => date("Y"),
							    'description' => $donnes1['description'],
							    'motcles' => "",
							    'theme' => $donnes1['type']
						));
						
						$req2 = $bdd->query('DELETE FROM devis WHERE num_devis =\''.$_GET['id'].'\'');

				}}};
			$req = $bdd->query('SELECT * FROM devis');
			echo' 
				<fieldset>
					<legend>Liste des Devis</legend>
					<table cellspacing="0" cellpadding="0" id="table_devis">
						<thead><td width="90px">Nom</td><td width="90px">Prenom</td><td width="130px">Mail</td><td width="80px">Marque</td><td width="100px">Modéle</td><td width="50px">Annee</td><td width="80px">Budget Min</td><td  width="80px">Budget Max</td></thead>';
			while($donnes = $req->fetch()){
				echo'<tr><td>'.$donnes["nom_devis"].'</td><td>'.$donnes["prenom_devis"].'</td><td>'.$donnes["mail_devis"].'</td><td>'.utf8_encode($donnes["marque"]).'</td><td>'.utf8_encode($donnes["modele"]).'</td><td>'.$donnes["annee"].'</td><td>'.$donnes["budget_min"].'</td><td>'.$donnes["budget_max"].'</td></tr>';
				echo'<tr><td colspan=7>'.utf8_encode($donnes["description"]).'</td><td><a class="icon_del" href="?page=admin&choix=devis&fonction=delete&id='.$donnes["num_devis"].'"></a><a class="icon_val" href="?page=admin&choix=devis&fonction=update&id='.$donnes["num_devis"].'"></a></td></tr>';
			}
			echo'
					</table>
				</fieldset>';
		break;
		case "projets":
			if(!isset($_GET['trie'])){$_GET['trie'] = "";}
			switch ($_GET['trie']) {
				case 'en_attente':
					$req = $bdd->query('SELECT * FROM projet WHERE status = "0"');
					break;
				case 'en_cours':
					$req = $bdd->query('SELECT * FROM projet WHERE status = "1"');
					break;
				case 'termine':
					$req = $bdd->query('SELECT * FROM projet WHERE status = "2"');
					break;
				case 'abandonne':
					$req = $bdd->query('SELECT * FROM projet WHERE status = "3"');
					break;
				default:
					$req = $bdd->query('SELECT * FROM projet');
					break;
			}
			echo' 
				<fieldset>
					<legend>Liste des Projets</legend>
					<nav><a href="?page=admin&choix=projets&trie=en_attente">En Attente</a>  <a href="?page=admin&choix=projets&trie=en_cours">En Cours</a>  <a href="?page=admin&choix=projets&trie=termine">Terminé</a>  <a href="?page=admin&choix=projets&trie=abandonne">Abandonné</a> <a href="?page=admin&choix=projets">Tous</a></nav>
					<div>
					<table cellspacing="0" cellpadding="0" id="table_projets">
						<thead><td width="100px">Nom</td><td width="40px">Date</td><td width="70px">Status</td><td width="50px">En ligne</td></thead>';
			while($donnes = $req->fetch()){
				switch($donnes['status']){
					case 0:
						$status="En attente";
					break;
					case 1:
						$status="En cours";
					break;
					case 2:
						$status="Terminé";
					break;
					case 3:
						$status="Abandonné";
					break;
					default:
					$status="Error 0329";
				}
				switch($donnes['en_ligne']){
					case false:
						$enligne= "Non";
					break;
					case true:
						$enligne="Oui";
					break;
					default:
						$enligne="Error 0329";
				}
				echo'<tr><td><a href="?page=suivi_projet&suivi_projet='.$donnes["num_projet"].'">'.$donnes["nom_projet"].'</a></td><td>'.$donnes["date_projet"].'</td><td>'.$status.'</td><td>'.$enligne.'</td></tr>';
			}
				echo'					</table></div>

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
					<table cellspacing="0" cellpadding="0" id="table_vehicule">
						<thead><td width="100px">Marque</td><td width="100px">Modèle</td><td width="70px">Année</td><td width="70px">Type</td></thead>';
			while($donnes = $req->fetch()){
				echo'<tr><td>'.$donnes["marque"].'</td><td>'.$donnes["modele"].'</td><td>'.$donnes["annee"].'</td><td>'.$donnes["type"].'</td><td><a class="icon_del" href="?page=admin&choix=vehicule&fonction=delete&id='.$donnes["num_vehicule"].'"></a></td></tr>';
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
					if ($_FILES['file']['error'] > 0) {echo "ERROR";} 
					else
					{

					$nom_img="upload/carrousel/".$_FILES['file']['name'];
					$result = move_uploaded_file($_FILES['file']['tmp_name'],$nom_img);
					if($result){$req = $bdd->prepare('INSERT INTO carrousel( url_images, nom_images, desc_images) VALUES(:url, :nom, :desc_img)');
					$req->execute(array(
					    'url' => $_POST['url'],
					    'nom' => $_FILES['file']['name'],
					    "desc_img" => $_POST['nom']
					    ));
			}}}};		
					$req = $bdd->query('SELECT * FROM carrousel');
			echo' 
				<fieldset id="carrousel">
					<legend>Configuration du Carrousel</legend>
					<table>
						<thead><td width="100px">Nom</td><td width="140px">Url</td><td width="120px">Description</td></thead>';
			while($donnes = $req->fetch()){
				echo'<tr><td>'.$donnes["nom_images"].'</td><td>'.$donnes["url_images"].'</td><td>'.$donnes["desc_images"].'</td><td><a class="icon_del" href="?page=admin&choix=carrousel&fonction=delete&id='.$donnes["url_images"].'"></a></td></tr>';
			}
			echo'
					</table>
					<form enctype="multipart/form-data" action="?page=admin&choix=carrousel&fonction=create" method="post">
						<p>Nom de l\'image :</p>
						<p><input name="nom"></p><br>
						<p>Lien :</p>
						<p><input name="url"></p><br>
						<p>Saisi du fichier images: 672px*300px</p>
						<p><input name="file" type="file"></p><br>
						<p class="right"><input type="submit"></p>
					</form>
				</fieldset>';


		break;
		case "menu": 

			if(isset($_GET['fonction'])){
				if($_GET['fonction'] == "delete"){

					if(!empty($_GET['Date'])) {
					}
					elseif(!empty($_GET['Theme'])) {
					}

				}
				elseif($_GET['fonction'] == "create"){
					$filer = fopen("cache/menu.json", "r");
					$fread = fread($filer, 8192);
					$json_decode = json_decode($fread, true);
					fclose($filer);
					$filew = fopen("cache/menu.json", "w");

					if(!empty($_POST['Date'])) {
						$json_encode = $json_decode;
						array_push($json_encode[0]["sous_liste"], array('nom' => $_POST['Date']));
						$fwrite = fwrite($filew, json_encode($json_encode, FALSE));
					}
					elseif(!empty($_POST['Theme'])) {
						$json_encode = $json_decode;
						array_push($json_encode[1]["sous_liste"], array('nom' => $_POST['Theme']));
						$fwrite = fwrite($filew, json_encode($json_encode, FALSE));
					}

					fclose($filew);
					}};

			echo' 
				<fieldset id="menu">
					<legend>Configuration du Menu</legend>';
					$file = fopen("cache/menu.json", "r");
					$liste = fread($file, 8192);
					$liste_tableau = json_decode($liste, true); 
					foreach ($liste_tableau as $categorie) {
						echo'
						<form action="?page=admin&choix=menu&fonction=create" method="POST">
						<table>
						<thead><td width="50px">'.$categorie['nom'].'</td></thead>';
						foreach ($categorie["sous_liste"] as $objet) {
							echo'<tr><td>'.$objet['nom'].'</td><td><!--<a class="icon_del" href="?page=admin&choix=menu&fonction=delete&'.$categorie['nom'].'='.$objet['nom'].'"></a>--></td></tr>';
						};
						echo'
						<tr><td><input name="'.$categorie['nom'].'" type="text"></td><td><input type="submit"></td></tr>
						</table>
						</form>
						';
					};
					echo '
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