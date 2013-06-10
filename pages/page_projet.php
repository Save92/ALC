<?php include('pages/haut.php'); 
if(isset($_GET['projet'])){$num_projet_var =$_GET['projet'];}
?>
<section id="page_projet">
	<fieldset id="description_projets">
		<?php

$bdd = new PDO('mysql:host=127.0.0.1;dbname=alc', 'root', '');
		$res3 = $bdd->prepare('SELECT marque,modele,annee,type,projet.num_projet,nom_projet,theme,date_projet,description_projet,num_image
FROM `vehicule`,`projet`,`image` WHERE vehicule.num_vehicule=projet.num_vehicule 
AND projet.num_projet=image.num_projet AND projet.num_projet= ? GROUP BY projet.num_projet');
		$res3->execute(array($num_projet_var));
				$res4 = $bdd->prepare('SELECT num_image, image.num_projet,description ,projet.num_projet
FROM `image`,`projet` WHERE projet.num_projet=image.num_projet AND projet.num_projet= ?');
		$res4->execute(array($num_projet_var));
		$count =$res4->rowCount();
	if ($count!=0){
		while($donnees = $res3->fetch())
			{
						echo '
			<legend>'.$donnees['nom_projet'].'</legend>
			<p> Ce projet a pour thème : '.$donnees['theme']. '.</p>
			<p> Il date de : '.$donnees['date_projet']. '.</p>
			<p> Description du projet : <br>'.$donnees['description_projet']. '.</p>
			<br><p> Caractéristiques du véhicule : <br></p>
			<p> Son type : '.$donnees['type']. '.</p>
			<p> Marque : '.$donnees['marque']. '.</p>
			<p> Modèle : '.$donnees['modele']. '.</p>
			<p> Année : '.$donnees['annee']. '.</p>
			</fieldset>	

			<div id="liste_image_projet">
			<h2>Photos du projet :</h2>';
			while ($donnees2 = $res4->fetch()) {
				echo '
				<img width="100px" height="100px" src="upload/'.$donnees2['num_image'].'.jpg">
				';
			}
			echo '</div>
			<div id="image_projet">
				<img width="310px" height="290px" src="upload/'.$donnees['num_image'].'.jpg">
				</div>';
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