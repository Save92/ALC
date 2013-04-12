	<footer>
		<?php if(!empty($_SESSION['id'])){ ?>
		<nav>
			<a href="?page=presentation">Présentation</a>
			<span></span>
			<a href="?page=galerie">Galerie</a>
			<div id="theme_date"  style="display:none;"><a href="">theme</a> | <a href="">Date</a></div>
			<div id="theme"  style="display:none;"><a href="">Auto</a> | <a href="">Moto</a></div>
			<div id="date" style="display:none;"><a href="">2011</a> | <a href="">2012</a></div>
			<span></span>
			<a href="?page=membre">Mon Compte</a>
			<span></span>
			<a href="?page=devis">Mon/Mes Projets</a>
			<span></span>
			<a href="?page=deconnexion">Déconnexion</a>
		</nav>
		<?php } else{ ?>
		<nav>
			<a href="?page=presentation">Présentation</a>
			<span></span>
			<a href="?page=galerie">Galerie</a>
			<div id="theme_date"  style="display:none;"><a href="">theme</a> | <a href="">Date</a></div>
			<div id="theme"  style="display:none;"><a href="">Auto</a> | <a href="">Moto</a></div>
			<div id="date" style="display:none;"><a href="">2011</a> | <a href="">2012</a></div>
			<span></span>
			<a href="?page=contact">Nous contacter</a>
			<span></span>
			<a href="?page=devis">Envie de soumettre un projet ?</a>
			<span></span>
			<a href="?page=inscription">Par ici pour s'inscrire !</a>
			<span></span>
			<a href="?page=membre"> ou se connecter.</a>
		</nav>
		<?php }?>
	</footer>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="js/menu.js"></script>
</body>
</html>