<?php
$file = fopen("cached/menu.json", "r");
$liste = fread($file, 8192);
$liste_tableau = json_decode($liste, true); 
?>
	<footer id="page_bas">
		<?php if(!empty($_SESSION['id'])){ ?>
		<nav>
			<a href="?page=presentation">Présentation</a>
			<span></span>
			<a href="?page=galerie">Galerie</a>
			<?php
				foreach($liste_tableau as $nom){
					echo '<a href="#" >'.$nom['nom'].'</a><span></span>';
				};
				echo "</div>";
				foreach ($liste_tableau as $categorie) {
					echo '<div  class="categorie" id="galerie_lien_'.$categorie['nom'].'">';
					foreach ($categorie["sous_liste"] as $objet) {
						echo '<a href="">'.$objet['nom'].'</a><span></span>';
					};
					echo"</div>";
				};
			?>
			<span></span>
			<a href="?page=membre">Mon Compte</a>
			<span></span>
			<a href="?page=devis">Mon/Mes Projets</a>
			<span></span>
			<a href="?page=deconnexion">Déconnexion</a>
			<span></span>
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
						echo '<a href="">'.$objet['nom'].'</a><span></span>';
					};
					echo"</div>";
				};
			?>
			<span></span>
			<a href="?page=contact">Nous contacter</a>
			<span></span>
			<a href="?page=devis">Envie de soumettre un projet ?</a>
			<span></span>
			<a href="?page=inscription">Par ici pour s'inscrire !</a>
			<span></span>
			<a href="?page=membre"> ou se connecter.</a>
			<span></span>
		</nav>
		<?php }?>
	</footer>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="js/jquery.orbit-1.2.3.js"></script>
	<script src="js/script.js"></script>
</body>
</html>