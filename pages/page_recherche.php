
<?php 
include('pages/haut.php'); ?>
<section id="page_recherche">
	<fieldset id="block_recherche">
		<legend>Résultat de la recherche :</legend>
		<div id="liste_resultat_projet">
			<strong>Résultat(s) de la recherche</strong> : <br>
<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=alc', 'root', '');
	//$req = $bdd->prepare('SELECT num_projet, nom_projet, theme, date_projet, description_projet, motscles_projet FROM projet WHERE motscles_projet= \''.$_GET["content"]). '\'' or die(print_r($bdd->errorInfo()));
	//$req->execute(array($POST['content']));
	//$resultat = $bdd->query('SELECT * FROM vehicule WHERE marque="'.$_POST["content"]).'" OR modele="'.$_POST["content"]).'" OR annee="'.$_POST["content"]).'" ';

$req = $bdd->prepare('SELECT num_projet, nom_projet, theme, date_projet, description_projet, motscles_projet FROM projet WHERE motscles_projet= ?');
$req->execute(array($_POST['content']));
//if ($req->fetch()){
	while($donnees = $req->fetch())
	{
		echo"
			<p>
		    	".$donnees['nom_projet'].", son theme : ".$donnees['theme'].", fait en ".$donnees['date_projet']." Description du projet : <br>".$donnees['description_projet']."
		   	</p>
		   	<br>";
	}
/*}
else
{
echo "Aucun résultat trouvé pour \"".$_POST['content']."\"";
}*/
$req->closeCursor(); // Termine le traitement de la requête
?>
		</div>
	</fieldset>
	<fieldset id="block_recherche_2">
		<div id="liste_resultat_vehicule">
			<strong>Plus de résultats : </strong><br>
<?php
		//$req = $bdd->prepare('SELECT num_projet, nom_projet, theme, date_projet, description_projet, motscles_projet FROM projet WHERE motscles_projet= \''.$_GET["content"]). '\'' or die(print_r($bdd->errorInfo()));
		//$req->execute(array($POST['content']));
	//$resultat = $bdd->query('SELECT * FROM vehicule WHERE marque="'.$_POST["content"]).'" OR modele="'.$_POST["content"]).'" OR annee="'.$_POST["content"]).'" ';

$req2 = $bdd->prepare('SELECT * FROM vehicule WHERE marque=? OR modele=? OR annee=? OR type=?');
$req2->execute(array($_POST['content'],$_POST['content'],$_POST['content'],$_POST['content']));
if(1)
{
	while($donnes = $req2->fetch())
	{
	echo "
		<p>
    		".$donnes['type']." : ".$donnes['marque'].", modele : ".$donnes['modele']." de ". $donnes['annee']."
   		</p>
   		<br>";
	}
}
else
{
echo "Aucun résultat trouvé pour \"".$_POST['content']."\"";
}
$req2->closeCursor(); // Termine le traitement de la requête
?>
		</div>
	</fieldset>
</section>
<?php include('pages/bas.php'); ?>