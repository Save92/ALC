<?php 
if(!empty($_GET['page'])){
	if($_GET['page'] == "deconnexion"){
		$_SESSION['id'] = 0;
		session_destroy();
		include('pages/haut.php'); 
		?>
			<section id="page_deconnexion">
				<meta http-equiv="refresh" content="2; URL=<?php echo $root; ?>" ></meta>
				<div><div><h1> Deconnecté</h1></div></div>
			</section>
			</body>
			</html>
		<?php
		exit;
	}
}
if(!empty($_POST['login']) && !empty($_POST['password'])){
	$_SESSION['id'] = "2";
}


if(empty($_SESSION['id'])){
	include('pages/haut.php'); 
	?>
		<section id="page_connexion">
			<div>
				<div id="background">
					<div></div>
				</div>
				<div id="mask">
					<form method="post">
						<p><label>Votre Login : <br><input type="text" id="login" name="login"></label></p>
						<p><label>Mot de passe : <br><input type="password" id="password" name="password"></label></p>
						<p><input type="submit" id="button_connexion" value="Connexion"></p>
					</form>
				</div>
			</div>
		</section>
<?php
include('pages/bas.php');
	}

	else{
	include('pages/haut.php'); 
?>
	<section id="page_membres">
		<div>
			<fieldset>
				<legend>Information du Compte</legend> 
				<input type="checkbox" id="cache" name="cache" hidden/>
				<label for="cache">
					<h1>Pour affichez les informations, cliquez ici</h1>
					<h4>Pour caché les informations, cliquez ici</h4>
				</label>
				<div>

					<p><h3>Modifications du mots de passe</h3></p>
					<p>écriver votre mots de passe:</p>
					<p><input type="text"></p>
					<p>écriver votre nouveau mots de passe:</p>
					<p><input type="text"></p>
					<p>Reécriver le nouveau mots de passe:</p>
					<p><input type="text"></p>

					<p><h3>Modifications de l'adresse mail</h3></p>
					<p></p>
					<p><input type="text"></p>
				</div>




			</fieldset>
			<fieldset>
				<legend>Gestion de projet</legend> 
				<ul>
					<?php

					for($i = 1; $i <= 10; $i++)
					{ ?>
					<li>
						<a href="">
							<img src="http://www.centaures-footus.com/modules/Gallery/icone-Dossier.png" width="64px" height="64px" />
							<p>Honda civic</p>
						<a/>
					</li>
					<?php
					}
					?>
				</ul>

				


			</fieldset>
		</div>
	</section>

<?php
include('pages/bas.php');
//session_destroy();
 }  ?>