<?php 
include('pages/haut.php'); 
if(isset($_GET['Date'])){$variable = "Date";}
elseif(isset($_GET['Theme'])){$variable = "Theme";}
else{ $variable = NULL;}
switch ($variable){
	case "Date":
		$variable2 = $_GET['Date'];
		$bdd = new PDO('mysql:host=127.0.0.1;dbname=alc', 'root', '');
		$res = $bdd->query('SELECT num_projet,en_ligne,nom_projet FROM projet WHERE en_ligne = "1" AND date_projet="'.$_GET["Date"].'" ');
		$count =$res->rowCount();
		if ($count!=0){
			echo '
			<section id="page_galerie_choix">
			<div id="page_galerie_global">	
			<fieldset id="liste_projets">
			<legend>Choix du projet :</legend>
			<h3>Par Date</h3>
			<div>
			<table id="icones_projets">
			<tr>';
			while($donnees = $res->fetch())
			{
				$res3 = $bdd->query('SELECT * FROM image WHERE num_projet="'.$donnees["num_projet"].'" LIMIT 0,1');
				$count3 =$res3->rowCount();
				if ($count3!=0){
					while($donnees2 = $res3->fetch()){
						echo '<td>
							<a href="?page=projet&projet='.$donnees2['num_projet'].'">
								<img width="90px" height="90px" src="upload/'.$donnees2['num_image'].'.jpg">
								<span>'.$donnees['nom_projet'].'</span>
							</a>
							</td>';
						}
					}
				else{
					echo'
					<td>
						<a href="?page=projet&projet='.$donnees['num_projet'].'">
							<img width="90px" height="90px" src="http://softdownload.ro/uploads/posts/2012-10/1349527217_folder-icon.png">
							<span>'.$donnees['nom_projet'].'</span>
						</a>
					</td>';
				}
			}
			echo '</tr>
			
		</table></div>
		</fieldset>
		<div id="image_projet" style="display: none;">
		    <img width="450px" height="400px" src=".jpg"></img>
		</div>
		</section>
		';
		//req->closeCursor();
		}
		else{ echo '
		<section id="page_galerie_choix">
			<div id="page_galerie_global">	
				<fieldset id="liste_projets">
					<legend>Choix du projet :</legend>
					<h3>Par Date</h3>
					<div>
						<table id="icones_projets">
							Aucun projet correspondant...
						</table>
					</div>
				</fieldset>
			</div>
		</section>';}
	break;
	case "Theme":
		$bdd = new PDO('mysql:host=127.0.0.1;dbname=alc', 'root', '');
		//$res2 = $bdd->query('SELECT projet.num_projet,nom_projet,num_image,en_ligne FROM `projet`,`image` WHERE projet.num_projet=image.num_projet AND en_ligne = "1" AND theme="'.$_GET["Theme"].'" GROUP BY projet.num_projet');
		$res2 = $bdd->query('SELECT num_projet,en_ligne,nom_projet FROM projet WHERE en_ligne = "1" AND theme="'.$_GET["Theme"].'" ');
		$count2 =$res2->rowCount();
		//echo $count2;
		if ($count2!=0){
			echo '
			<section id="page_galerie_choix">
			<div id="page_galerie_global">	
			<fieldset id="liste_projets">
			<legend>Choix du projet :</legend>
			<h3>Par Thème</h3>
			<div>
			<table id="icones_projets">
			<tr>';
			while($donnees = $res2->fetch())
			{
				$res3 = $bdd->query('SELECT * FROM image WHERE num_projet="'.$donnees["num_projet"].'" LIMIT 0,1');
				$count3 =$res3->rowCount();
				if ($count3!=0){
					while($donnees2 = $res3->fetch()){
						echo '<td>
							<a href="?page=projet&projet='.$donnees2['num_projet'].'">
								<img width="90px" height="90px" src="upload/'.$donnees2['num_image'].'.jpg">
								<span>'.$donnees['nom_projet'].'</span>
							</a>
							</td>';
						}
					}
				else{
					echo'
					<td>
						<a href="?page=projet&projet='.$donnees['num_projet'].'">
							<img width="90px" height="90px" src="images/1349527217_folder-icon.png" status="none">
							<span>'.$donnees['nom_projet'].'</span>
						</a>
					</td>';
				}
			}
			echo '</tr>
			
			</table></div>
			</fieldset>
			<div id="image_projet" style="display: none;">
			    <img width="450px" height="400px" src=".jpg"></img>
			</div>
			</section>
			';
		}
		else
		{
			echo '
			<section id="page_galerie_choix">
			<div id="page_galerie_global">	
			<fieldset id="liste_projets">
			<legend>Choix du projet :</legend>
			<h3>Par Thème</h3>
			<div>
				<a><p>Aucun projet correspondant...</p></a>
			</div>
		</fieldset>
		</section>
		';
		}
	break;
	default:
	$file = fopen("cache/menu.json", "r");
	$liste = fread($file, 8192);
	$liste_tableau = json_decode($liste, true); 
	echo'
		<section id="page_galerie_choix">
			<div id="page_galerie_global">	
			<fieldset id="liste_projets_Date">
			<legend>Par Date :</legend>
			<div>
				';
				foreach ($liste_tableau as $categorie) {
				if($categorie['nom'] == "Date"){
					foreach ($categorie["sous_liste"] as $objet) {
						echo '<a href="?page=galerie&'.$categorie['nom'].'='.$objet['nom'].'">'.$objet['nom'].'</a><br><span></span>';
					};
					}
				};
			echo '
			</div>
			</fieldset>
			<fieldset id="liste_projets_Theme">
			<legend>Par Thème :</legend>
			<div>
			';
				foreach ($liste_tableau as $categorie) {
				if($categorie['nom'] == "Theme"){
					foreach ($categorie["sous_liste"] as $objet) {
						echo '<a href="?page=galerie&'.$categorie['nom'].'='.$objet['nom'].'">'.$objet['nom'].'</a><br><span></span>';
						};
					}
				};
			echo '
			</div>
			</fieldset>
			</div>
			</section>
		';
?>

<?php }
include('pages/bas.php'); 
?>