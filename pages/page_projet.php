<?php include('pages/haut.php'); 
if(isset($_GET['projet'])){$num_projet_var =$_GET['projet'];}
?>
<section id="page_projet">
	<div>
	<fieldset id="description_projets">
		<?php

	$res3 = $bdd->query('SELECT * FROM projet WHERE num_projet= "'.$num_projet_var.'" ');
	$res4 = $bdd->query('SELECT * FROM image WHERE num_projet= "'.$num_projet_var.'"');
	$count =$res3->rowCount();
	$count2 =$res4->rowCount();
	if ($count!=0){
		while($donnees = $res3->fetch())
			{

			echo '
			<legend>'.$donnees['nom_projet'].'</legend>
			<p> Ce projet a pour thème : '.$donnees['theme']. '.</p>
			<p> Il date de : '.$donnees['date_projet']. '.</p>
			<p> Description du projet : <br>'.utf8_decode($donnees['description_projet']).'.</p>
			<br><p> Caractéristiques du véhicule : <br></p>';
			$res5 = $bdd->query('SELECT * FROM vehicule WHERE num_vehicule= "'.$donnees['num_vehicule'].'"');
			while($donnees2 = $res5->fetch())
			{
				echo '
				<p> Son type : '.$donnees2['type']. '.</p>
				<p> Marque : '.$donnees2['marque']. '.</p>
				<p> Modèle : '.$donnees2['modele']. '.</p>
				<p> Année : '.$donnees2['annee']. '.</p>
			';}
			echo '
			</fieldset>
			<div id="liste_image">
				<h2>Photos du projet :</h2>';
			if ($count2!=0){
				while ($donnees2 = $res4->fetch()) {
					echo '<a href="?page=projet&projet='.$_GET['projet'].'&image='.$donnees2['num_image'].'"><img width="100px" height="100px" src="upload/'.$donnees2['num_image'].'.jpg"></a>';
				}
			}
			else echo '<p>Aucune Image associé au projet!';	
			echo '
			</div>';
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
</div></section>
<?php include('pages/bas.php'); ?>