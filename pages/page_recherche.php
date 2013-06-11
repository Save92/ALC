
<?php 
include('pages/haut.php'); ?>
<section id="page_recherche">
	<fieldset id="block_recherche">
		<div id="liste_resultat_projet">
			<strong>Résultat(s) de la recherche :</strong> <br>
<?php

$var_error=true;
$req = $bdd->query('SELECT * FROM projet');
$req2 = $bdd->query('SELECT motscles_projet FROM projet');
	$motcles=explode(" ", $_POST['content']);
		while($donnees1=$req2->fetch())
		{
			for($i=0;is_array($donnees1) && isset($donnees1[$i]); $i++)
			{
				$motcle = $donnees1[$i];
				if(stristr($motcle, $motcles[0])!=false)
				{
					while($donnees=$req->fetch()){
		echo"
					<p><a href='?page=projet&projet=".$donnees['num_projet']."'>
			    	<span>".$donnees['nom_projet']."</span>, <span>".$donnees['theme']."</span> fait en <span>".$donnees['date_projet']."</span><br> Description du projet : <br><span>".$donnees['description_projet']."</span>
				   	</a></p>
				   	";
				   }
				   $var_error=false;
				}
				
			}
		}
		if($var_error){echo "Aucun résultat trouvé pour \"".$_POST['content']."\"";}

//$req->closeCursor(); // Termine le traitement de la requête
?>
		</div>
	</fieldset>
	<fieldset id="block_recherche_2">
		<div id="liste_resultat_vehicule">
			<strong>Plus de résultats : </strong><br>
<?php
$var_error2=true;
$req3 = $bdd->query('SELECT * FROM vehicule');
	$motcles2=explode(" ", $_POST['content']);
		while($donnees2=$req3->fetch())
		{
			for($i=0;is_array($donnees2) && isset($donnees2[$i]); $i++)
			{
				$motcle2 = $donnees2[$i];
				if(stristr($motcle2, $motcles2[0])!=false)
				{
					//while($donnees3=$req3->fetch()){
	echo "
		<p>
			    	".$donnees2['type']." : ".$donnees2['marque'].", modele : ".$donnees2['modele']." de ". $donnees2['annee']."
   		</p>
				   	";
				   //}
				   $var_error2=false;
				}
				
			}
		}
		if($var_error2){echo "Aucun résultat trouvé pour \"".$_POST['content']."\"";}

$req2->closeCursor(); // Termine le traitement de la requête
?>
		</div>
	</fieldset>
</section>
<?php include('pages/bas.php'); ?>