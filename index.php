<?php
session_start();
include('lib/config.php');

include('pages/haut.php');


if(isset($_GET['page'])){
	switch($_GET['page']){
		case 'accueil':
			include('pages/page_accueil.php');
		break;
		case 'devis':
			include('pages/page_devis.php');
		break;
		case 'contact':
			include('pages/page_contact.php');
		break;
		case 'galerie_choix':
			include('pages/page_galerie_choix.php');
		break;
		case 'galerie':
			include('pages/page_galerie.php');
		break;
		case 'inscription':
			include('pages/page_inscription.php');
		break;
		case 'presentation':
			include('pages/page_presentation.php');
		break;
		case 'recherche':
			include('pages/page_recherche.php');
		break;		
		case 'membres':
			include('pages/page_membres.php');
		break;




		default:
			include('pages/error/404.php');
		break;
}}
else {
	include('pages/page_accueil.php');
}


include('pages/bas.php');


?>