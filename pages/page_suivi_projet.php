<?php include('pages/haut.php'); 
$id_membre=$_SESSION['id'];
if(isset($_GET['suivi_projet'])) $num_projet_var=$_GET['suivi_projet'];
if(isset($_SESSION['admin'])) $admin=true;
else $admin=false;
$bdd = new PDO('mysql:host=127.0.0.1;dbname=alc', 'root', '');
if (isset($_POST['requete'])){
switch($_POST['requete']){
	case "projet":
		$modif = $bdd->prepare('UPDATE `projet` SET nom_projet = :nom, theme = :theme, date_projet = :date, description_projet = :desc , motscles_projet= :mc, status= :status, en_ligne= :en_ligne, progression= :progression WHERE num_projet= :num');
		$modif->execute(array(
			'nom' => $_POST['nom_projet'],
			'theme' => $_POST['theme'],
			'date' => $_POST['date'],
			'desc' => $_POST['description'],
			'mc' => $_POST['motscles'],
			'status' => $_POST['status'],
			'en_ligne' => $_POST['en_ligne'],
			'progression' => $_POST['progression'],
			'num' => $num_projet_var
			));
	break;
	case "vehicule":
				$modifv = $bdd->prepare('UPDATE `vehicule` SET type = :type, marque = :marque, modele = :modele , annee= :annee WHERE num_vehicule= :num');
		$modifv->execute(array(
			'type' => $_POST['type'],
			'marque' => $_POST['marque'],
			'modele' => $_POST['modele'],
			'annee' => $_POST['annee'],
			'num' => intval($_POST['id_vehicule'])
			));
	break;
	case "image":
			$reqi = $bdd->query('SELECT MAX(num_image) FROM image');
			$resul=$reqi->fetch();
			$nom_img="upload/".$resul[0].".jpg";
			$result = move_uploaded_file($_FILES['file']['tmp_name'],$nom_img);
			if ($result) 
				{

					echo "Transfert réussi";
				$modifi = $bdd->prepare('INSERT INTO image(num_projet, description) VALUES (:num, :desc)');
				$modifi->execute(array(
			'num' => $_POST['id_projet'],
			'desc' => $_POST['description_image']
				));
			}
	break;



}}

?>
<section id="page_suivi_projet">
	<div>
	<fieldset id="description_suivi_projets">
	<?php

/*		$resultat = $bdd->prepare('SELECT vehicule.num_vehicule, marque,modele,annee,type,projet.num_projet,projet.num_membre
	,nom_projet,theme,date_projet,description_projet,motscles_projet,status
	FROM `vehicule`,`projet`,`image` WHERE vehicule.num_vehicule=projet.num_vehicule 
	AND projet.num_projet= ? AND projet.num_membre= ? GROUP BY projet.num_projet');
	$resultat->execute(array($num_projet_var , $id_membre));*/
	$resultat = $bdd->query('SELECT vehicule.num_vehicule, marque, modele, annee, type, projet.num_projet, num_membre, nom_projet, theme, date_projet, description_projet, motscles_projet, status, progression
	FROM vehicule,projet WHERE vehicule.num_vehicule=projet.num_vehicule AND projet.num_projet='.$num_projet_var.' ');
	$resultat1 = $bdd->prepare('SELECT num_image, num_projet, description FROM image WHERE num_projet= ?');
	$resultat1->execute(array($num_projet_var));
	$count =$resultat->rowCount();
	if ($count!=0)
	{
			while($donnees = $resultat->fetch())
			{
				if($_SESSION['id'] == $donnees['num_membre'] || $admin ==true)
				{
					switch($donnees['status']){
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
				echo '
				<legend>'.$donnees['nom_projet'].'</legend>
				<p> Ce projet a pour thème : '.$donnees['theme']. '.</p>
				<p> Il date de : '.$donnees['date_projet']. '.</p>
				<p> Description du projet : <br>'.$donnees['description_projet']. '.</p>
				<p> Status : '.$status. '.</p>
				<br><p> Caractéristiques du véhicule : <br></p>
				<p> Son type : '.$donnees['type']. '.</p>
				<p> Marque : '.$donnees['marque']. '.</p>
				<p> Modèle : '.$donnees['modele']. '.</p>
				<p> Année : '.$donnees['annee']. '.</p>

				<form>
				<!--<p><label for="message">Envoyer un message à l\'admin : </label><textarea id="message" name="message" type="text">Votre message...</textarea></p>-->
				</form>
				<p><div id="barre_progression"><div style="width:'.$donnees["progression"].'%"></div><span>'.$donnees["progression"].'%</span></div></p>';
				if($admin==true)
				{
					echo'
						<div id="menu_admin">
							<a href="" id="modif_projet">Modifier le projet</a>
							<a href="" id="modif_vehicule">Modifier le vehicule</a>
							<a href="" id="ajout_image">Ajouter une image</a>
						</div>';
				}

				echo'
				</fieldset>';

			
				echo'
				<div id="liste_image_suivi_projet">
				<h2>Photos du projet :</h2>';
				while ($donnees2 = $resultat1->fetch()) {
					echo '
					<a href="?page=suivi_projet&suivi_projet='.$_GET['suivi_projet'].'&image='.$donnees2['num_image'].'"><img width="100px" height="100px" src="upload/'.$donnees2['num_image'].'.jpg"></a>
					';
				}
				echo '</div>';
				if(isset($_GET['image'])){
					echo'
						<div id="image_projet">
							<img width="300px" height="290px" src="upload/'.$_GET['image'].'.jpg">
						</div>';
				}
				else{
					echo'
						<div id="image_projet" style="display:none;">
							<img width="300px" height="290px" src="">
						</div>';

				}
				$var_tab=$donnees;
			}
			else{
				echo '<div id="liste_vide">
			<p>Accées Interdit !</p>
			</div>
			</fieldset>';
			}
		}
		if($admin==true)
		{
			echo '
			<div id="admin" style="display:none;">
				<fieldset class="modif_projet suivi_projet" style="display:none;">
					<legend> Modification du projet :</legend> 
					<form method="post">
						<p><label for="nom_projet">Modifier le nom du projet : </label><input id="nom_projet" name="nom_projet" type="text" value="'.$var_tab['nom_projet'].'"></p>
						<p><label for="theme">Modifier le thème : </label><input id="theme" name="theme" type="text" value="'.$var_tab['theme'].'"></p>
						<p><label for="date">Modifier la date : </label><input id="date" name="date" type="text" value="'.$var_tab['date_projet'].'"></p>
						<p><label for="motscles">Modifier les mots clés : </label><input id="motscles" name="motscles" type="text" width="150px" value="'.$var_tab['motscles_projet']. '".></p>
						<p><label for="description">Modifier la description: </label><textarea id="description" name="description" type="text">'.$var_tab['description_projet'].'</textarea></p>
						<br><p>Status du projet : <select name="status">
							<option value="0">En attente</option>
							<option value="1">En cours</option>
							<option value="2">Terminé</option>
							<option value="3">Abandonné</option>
						</select>Progression : <select name="progression">
							<option value="0">0%</option>
							<option value="10">10%</option>
							<option value="20">20%</option>
							<option value="30">30%</option>
							<option value="40">40%</option>
							<option value="50">50%</option>
							<option value="60">60%</option>
							<option value="70">70%</option>
							<option value="80">80%</option>
							<option value="90">90%</option>
							<option value="100">100%</option>
						</select></p>
						<p><label><input type="checkbox" name="en_ligne"> En ligne</label></p>
						<br>
						<input type="text" name="requete" value="projet" style="display:none;">
						<p><input type="submit"><button>Annuler</button></p>
					</form>
				</fieldset>

				<fieldset class="modif_vehicule suivi_projet" style="display:none;">
					<legend> Modification du véhicule :</legend> 
					<form method="post">
						<p><label for="type">Modifier le type du véhicule : </label><input id="type" name="type" type="text" value="'.$var_tab['type'].'"></p>
						<p><label for="marque">Modifier la marque : </label><input id="marque" name="marque" type="text" value="'.$var_tab['marque'].'"></p>
						<p><label for="modele">Modifier le modèle : </label><input id="modele" name="modele" type="text" value="'.$var_tab['modele'].'"></p>
						<p><label for="annee">Modifier l\'année : </label><input id="annee" name="annee" type="text" value="'.$var_tab['annee'].'"></p>
						<br>
						<input type="text" name="id_vehicule" value="'.$var_tab['num_vehicule'].'" style="display:none;">
						<input type="text" name="requete" value="vehicule" style="display:none;">
						<p><input type="submit"><button>Annuler</button></p>
					</form>
				</fieldset>

				<fieldset class="ajout_image suivi_projet" style="display:none;">
					<legend> Gérer les images :</legend> 
					<form method="post" enctype="multipart/form-data">
						<p><label for="description_image">Modifier description de l\'image : </label><input id="description_image" name="description_image" type="text"></p>
						<p><input id="file" name="file" type="file"></p>
						<br>
						<input type="text" name="id_projet" value="'.$var_tab['num_projet'].'" style="display:none;">
						<input type="text" name="requete" value="image" style="display:none;">
						<p><input type="submit"><button>Annuler</button></p>
					</form>
				</fieldset>
			</div>
			';

		}
	}
	else
	{
		echo '<div id="liste_vide">
			<p>Aucun projet trouvé !</p>
			</div>
			</fieldset>';

	}
?>
<!--				-->
</section>
<?php include('pages/bas.php'); ?>