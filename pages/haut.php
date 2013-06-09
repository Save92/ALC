<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
	<!-- <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">-->
	<link href='http://fonts.googleapis.com/css?family=Advent+Pro:700,400' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/orbit-1.2.3.css">
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<title>ALC</title>

</head>
<body>
	<header>
		<a href="?page=accueil"><!--<img src="images/logo_psd.gif"/>-->Art Line Concept</a>
		<?php if(!isset($_SESSION['id'])){echo'<div><a href="?page=membre">Connexion</a><a href="?page=inscription">Inscription</a></div>';}
		else {echo'<div><a href="?page=membre">'.$_SESSION['nom_complet'].'</a><a href="?page=deconnexion">Deconnexion</a></div>';}?>
		<form action="?page=recherche" method="post">
			<input type="text" name="content" placeHolder="Recherche...">
			<input type="submit" name="recherche_ok">
		</form>
	</header>

