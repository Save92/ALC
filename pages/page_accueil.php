<?php
	include('pages/haut.php'); 
?>
<section id="page_accueil">
	<div>
		<div>
			<h1>Bienvenue<br>sur Art<br>Line<br>Concept!</h1>
			<div id="slider">
				<div id="featured" style="width: 840px; height: 250px;"> 
					<?php 

					$req = $bdd->query('SELECT * FROM carrousel');
					while($donnees = $req->fetch()){

						if(!empty($donnees['url_images'])) echo'<a href="'.$donnees['url_images'].'"><img src="upload/carrousel/'.$donnees['nom_images'].'" /></a>';
						else echo'<img src="upload/carrousel/'.$donnees['nom_images'].'" />';
					}

					?>
				</div>
					
			</div>
		</div>
		<fieldset id="presentation_alc">
			<legend>Présentation</legend>
			<a>Le site ALC à pour but de réaliser vos véhicules de rêves!! <3</a>
		</fieldset>
	</div>
</section>
<?php include('pages/bas.php'); ?>