<?php include('pages/haut.php'); ?>
<section id="page_devis">
	<div>
<?php

	if(isset($_POST['description']) && isset($_POST['etape'])) {

		if(isset($_POST['type'])) {$type = $_POST['type'];} else{ $marque = "";}
		if(isset($_POST['marque'])) {$marque = utf8_decode($_POST['marque']);} else{ $marque = "";}
		if(isset($_POST['modele'])) {$modele = utf8_decode($_POST['modele']);} else{ $modele = "";}
		if(isset($_POST['annee'])) {$annee = $_POST['annee'];} else{ $annee = "";}
		if(isset($_POST['min'])) {$min = $_POST['min'];} else{ $min = "";}
		if(isset($_POST['max'])) {$max = $_POST['max'];} else{ $max = "";}
		if(isset($_POST['description'])) {$description = utf8_decode($_POST['description']);}

//		if(isset($_FILE['file1']['name'])) {$file1 = $_FILE['file1']['name'];} else{ $file1=""; }
		$i = 1;
		foreach ($_FILES["pictures"]["error"] as $key => $error) {
 		   if ($error == UPLOAD_ERR_OK) {
		   		$tmp_name = $_FILES["pictures"]["tmp_name"][$key];
       			$name = $_FILES["pictures"]["name"][$key];
       			$file[$i] = $_FILES["pictures"]["name"][$key];
        		move_uploaded_file($tmp_name, "upload/devis/$name");
		    }
		    else{
       			$file[$i] = "";	
		    }
	    	$i++;
		}		




		$req2 = $bdd->prepare('INSERT INTO devis (nom_devis, prenom_devis, mail_devis, marque, modele, annee, budget_min, budget_max, description, file1, file2, file3, etat, type) VALUES (:var1, :var2, :var3, :var4, :var5, :var6, :var7, :var8, :var9, :var10, :var11, :var12, :var13, :var14);');
		$req2->execute(array(
			'var1' => utf8_decode($_SESSION['devis_temp_nom']),
			'var2' => utf8_decode($_SESSION['devis_temp_prenom']),
			'var3' => utf8_decode($_SESSION['devis_temp_mail']),
			'var4' => $marque,
			'var5' => $modele,
			'var6' => $annee,
			'var7' => $min,
			'var8' => $max,
			'var9' => $description,
			'var10' => $file['1'],
			'var11' => $file['2'],
			'var12' => $file['3'],
			'var13' => 0,
			'var14' => $type
			));

?>

<div id="message"><h1>Votre devis à bien été transmis.</h1></div>
<!--<meta http-equiv="refresh" content="2; URL=?page=accueil" ></meta>-->


<?php
	}
	elseif(isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['mail']) || isset($_SESSION['id'])) {
	if(isset($_POST['prenom'])) $_SESSION['devis_temp_prenom'] = $_POST['prenom'];
	if(isset($_POST['nom'])) $_SESSION['devis_temp_nom'] = $_POST['nom'];
	if(isset($_POST['mail'])) $_SESSION['devis_temp_mail'] = $_POST['mail'];
	if(isset($_SESSION['id'])) {
		$req = $bdd->query('SELECT * FROM membre WHERE num_membre = \''.$_SESSION["id"].'\'');
		while($donnees = $req->fetch()){
			$_SESSION['devis_temp_prenom'] = $donnees['prenom_membre'];
			$_SESSION['devis_temp_nom'] = $donnees['nom_membre'];
			$_SESSION['devis_temp_mail'] = $donnees['mail_membre'];
		}
	}

?>

<form enctype="multipart/form-data" id="form_devis" method="post">
		<fieldset id="premiere_etape">
		
		<legend>Première étape : Vos coordonnées</legend>
		<a>
		<p><label for="prenom">Prenom : </label><input id="prenom" name="prenom" type="text" value="<?php echo $_SESSION['devis_temp_prenom']; ?>" disabled></p>
		<p><label for="nom">Nom : </label><input id="nom" name="nom" type="text" value="<?php echo $_SESSION['devis_temp_nom']; ?>" disabled></p>
		<p><label for="mail">Votre email : </label><input id="mail" name="mail" type="email" value="<?php echo $_SESSION['devis_temp_mail']; ?>" disabled></p>
	</a></fieldset>
	<fieldset id="deuxieme_etape">
		<legend>Deuxième étape : Votre véhicule</legend>
		<a>
		<p><label for="type">Type : </label><select id="type" name="type"><option value="Auto">Auto</option><option value="Moto">Moto</option><option value="Quad">Quad</option></select></p>
		<p><label for="marque">Marque : </label><input id="marque" name="marque" type="text"></p>
		<p><label for="modele">Modèle : </label><input id="modele" name="modele" type="text"></p>
		<p><label for="annee">Année : </label><input id="annee" name="annee" type="text"></p>
		<p><label for="min">Budget minimum : </label><input id="min" name="min" type="text"></p>
		<p><label for="max">Budget maximum : </label><input id="max" name="max" type="text"></p>
		<p><label for="description" id="label_description">Description de votre projet : </label><textarea id="description" name="description" type="text" required></textarea></p>
		<p><label id="pj">Ajouter une photo (3 maximum) : </label><input type="file" name="pictures[]" /><input type="file" name="pictures[]" /><input type="file" name="pictures[]" /><input type="hidden" name="etape" value="valid"><br><input id="valider" type="submit"></p>
	</a>
	</fieldset>
</form>
<?php
	}
	else {
?> 
<form id="form_devis" method="post">
	<fieldset id="premiere_etape">
		<legend>Première étape : Vos coordonnées</legend>
		<a>
		<p><label for="prenom">Prénom : </label><input id="prenom" name="prenom" type="text" required></p>
		<p><label for="nom">Nom : </label><input id="nom" name="nom" type="text" required></p>
		<p><label for="mail">Votre email : </label><input id="mail" name="mail" type="email" required></p>
		<p><input id="valider" type="submit"></p>
	</a>
	</fieldset>
</form>

<?php
	}
?>
<div>
	</section>
<?php include('pages/bas.php'); ?>