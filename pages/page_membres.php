<?php 
if(!empty($_GET['page'])){
	if($_GET['page'] == "deconnexion"){
		$_SESSION['id'] = 0;
		session_destroy();
		include('pages/haut.php'); 
		?>
<section id="page_deconnexion">
	<div><div><h1> Deconnecté</h1></div></div>
</section>
</body>
</html>
		<?php
		exit;
	}
}
if(!empty($_POST['login']) && !empty($_POST['password'])){ $_SESSION['id'] = "2";}


if(empty($_SESSION['id'])){
	include('pages/haut.php'); 
	?>
<section id="page_connexion">
	<div id="se_connecter">
	<div>
		<form method="post">
			<h1>Connexion :</h1>
			<label>Votre Login : <br><input type="text" id="login" name="login"></label><br>
			<label>Mot de passe : <br><input type="password" id="password" name="password"></label><br>
			<input type="submit" id="button_connexion" value="Connexion">
		</form>
	<!-- Nombre de résultats variable -->
	</div></div>
</section>
<?php
include('pages/bas.php');
	}

	else{
	include('pages/haut.php'); 
?>
	<section>


	</section>

<?php
include('pages/bas.php');
//session_destroy();
 }  ?>