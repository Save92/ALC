<?php
$file = fopen("cache/menu.json", "r");
$liste = fread($file, 8192);
$liste_tableau = json_decode($liste, true); 
?>
	<footer id="page_bas">
		<?php if(!empty($_SESSION['id'])){ ?>
		<nav>
			<a href="?page=presentation">Présentation</a>
			<span></span>
			<a href="?page=galerie" id="galerie">Galerie</a>
			<div class="galerie_choix">
			<?php
				foreach($liste_tableau as $nom){
					echo '<a>'.$nom['nom'].'</a><span></span>';
				};
				echo "</div>";
				foreach ($liste_tableau as $categorie) {
					echo '<div  class="categorie" id="galerie_lien_'.$categorie['nom'].'">';
					foreach ($categorie["sous_liste"] as $objet) {
						echo '<a href="?page=galerie&'.$categorie['nom'].'='.$objet['nom'].'">'.$objet['nom'].'</a><span></span>';
					};
					echo"</div>";
				};
			?>
			</div>
			<span></span>
			<a href="?page=membre">Mon Compte</a>
			<span></span>
			<a href="?page=devis">Mon/Mes Projets</a>
			<?php if(isset($_SESSION["admin"]))
			{
				echo'
				<span></span>
				<a href="?page=admin">Administration</a>';
			}?>
		</nav>
		<?php } else{ ?>
		<nav>
			<a href="?page=presentation">Présentation</a>
			<span></span>
			<a href="?page=galerie" id="galerie">Galerie</a>
			<div class="galerie_choix">
			<?php
				foreach($liste_tableau as $nom){
					echo '<a href="#" >'.$nom['nom'].'</a><span></span>';
				};
				echo "</div>";
				foreach ($liste_tableau as $categorie) {
					echo '<div  class="categorie" id="galerie_lien_'.$categorie['nom'].'">';
					foreach ($categorie["sous_liste"] as $objet) {
						echo '<a href="?page=galerie&'.$categorie['nom'].'='.$objet['nom'].'">'.$objet['nom'].'</a><span></span>';
					};
					echo"</div>";
				};
			?>
			</div>
			<span></span>
			<a href="?page=contact">Nous contacter</a>
			<span></span>
			<a href="?page=devis">Envie de soumettre un projet ?</a>
		</nav>
		<?php }?>
	</footer>
	<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/jquery.orbit-1.2.3.js"></script>
	<script src="js/script.js"></script>
</body>
</html>