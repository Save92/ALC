<?php include('pages/haut.php'); ?>
<section id="page_devis">
<?php
	if(isset($_POST['description']) && isset($_POST['etape'])) {

		if(isset($_POST['marque'])) {$marque = $_POST['marque'];} else{ $marque = "";}
		if(isset($_POST['modele'])) {$modele = $_POST['modele'];} else{ $modele = "";}
		if(isset($_POST['annee'])) {$annee = $_POST['annee'];} else{ $annee = "";}
		if(isset($_POST['min'])) {$min = $_POST['min'];} else{ $min = "";}
		if(isset($_POST['max'])) {$max = $_POST['max'];} else{ $max = "";}
		if(isset($_POST['description'])) {$description = $_POST['description'];}

		if(isset($_POST['file1'])) {$file1 = $_POST['file1'];} else{ }
		if(isset($_POST['file2'])) {$file2 = $_POST['file2'];} else{ }
		if(isset($_POST['file3'])) {$file3 = $_POST['file3'];} else{ }

/*
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=alc', 'root', '');
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}*/

		$req2 = $bdd->prepare('INSERT INTO devis_requete (nom, prenom, adresse_mail, marque, modele, annee, budget_min, budget_max, description, file1, file2, file3, etat) VALUES (:var1, :var2, :var3, :var4, :var5, :var6, :var7, :var8, :var9, :var10, :var11, :var12, :var13);');
		$req2->execute(array(
			'var1' => $_SESSION['devis_temp_nom'],
			'var2' => $_SESSION['devis_temp_prenom'],
			'var3' => $_SESSION['devis_temp_mail'],
			'var4' => $marque,
			'var5' => $modele,
			'var6' => $annee,
			'var7' => $min,
			'var8' => $max,
			'var9' => $description,
			'var10' => "",
			'var11' => "",
			'var12' => "",
			'var13' => 0
			));

?>

<h1> votre devis a été transmit.</h1>


<?php
	}
	elseif(isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['mail'])) {
	$_SESSION['devis_temp_prenom'] = $_POST['prenom'];
	$_SESSION['devis_temp_nom'] = $_POST['nom'];
	$_SESSION['devis_temp_mail'] = $_POST['mail'];
?>
<h1>Une idée ? Une envie ? Soumettez nous votre projet !</h1>

<form id="form_devis" method="post">
		<fieldset id="premiere_etape">
		
		<legend>Premiere etape : Vos coordonnées</legend>
		<a>
		<p><label for="prenom">Prenom : </label><input id="prenom" name="prenom" type="text" value="<?php echo $_POST['prenom']; ?>" disabled></p>
		<p><label for="nom">Nom : </label><input id="nom" name="nom" type="text" value="<?php echo $_POST['nom']; ?>" disabled></p>
		<p><label for="mail">Votre email : </label><input id="mail" name="mail" type="email" value="<?php echo $_POST['mail']; ?>" disabled></p>
	</a></fieldset>
	<fieldset id="deuxieme_etape">
		<legend>Deuxieme etape : Votre véhicule</legend>
		<a>
		<p><label for="marque">Marque : </label><input id="marque" name="marque" type="text"></p>
		<p><label for="modele">Modéle : </label><input id="modele" name="modele" type="text"></p>
		<p><label for="annee">Année : </label><input id="annee" name="annee" type="text"></p>
		<p><label for="min">Budget minimum : </label><input id="min" name="min" type="text"></p>
		<p><label for="max">Budget maximum : </label><input id="max" name="max" type="text"></p>
		<p><label for="description">Description de votre projet : </label><br><textarea id="description" name="description" type="text" required></textarea></p>
		<p><label id="pj">Ajouter une photo (3 maximum) : </label><input type="file" ><input type="hidden" name="etape" value="valid"><br><input id="valider" type="submit"></p>
	</a>
	</fieldset>
</form>
<?php
	}
	else {
?> 
<h1>Une idée ? Une envie ? Soumettez nous votre projet !</h1>
<form id="form_devis" method="post">
	<fieldset id="premiere_etape">
		<legend>Premiere etape : Vos coordonnées</legend>
		<a>
		<p><label for="prenom">Prenom : </label><input id="prenom" name="prenom" type="text" required></p>
		<p><label for="nom">Nom : </label><input id="nom" name="nom" type="text" required></p>
		<p><label for="mail">Votre email : </label><input id="mail" name="mail" type="email" required></p>
		<p><input id="valider" type="submit"></p>
	</a>
	</fieldset>
</form>

<?php
	}
?>
	</section>
<?php include('pages/bas.php'); ?>