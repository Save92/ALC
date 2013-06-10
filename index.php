<?php
session_start();
include('pages/config.php');
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
		case 'galerie':
			include('pages/page_galerie.php');
		break;
		case 'projet':
			include('pages/page_projet.php');
		break;
		case 'suivi_projet':
			include('pages/page_suivi_projet.php');
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
		case 'membre':
			include('pages/page_membres.php');
		break;		
		case 'deconnexion':
			include('pages/page_membres.php');
		break;
		case 'admin':
			include('pages/page_admin.php');
		break;


		default:
			header('Location: error/404.php');
		break;
}}
else {
	include('pages/page_accueil.php');
}

?>