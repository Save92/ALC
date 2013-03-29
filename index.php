<?php
session_start();
include('lib/config.php');

include('pages/haut.html');


if(isset($_GET['page'])){
	switch($_GET['page']){
		case 'accueil':
			include('pages/page_accueil.html');
		break;
		case 'devis':
			include('pages/page_devis.html');
		break;
		case 'contact':
			include('pages/page_contact.html');
		break;
		case 'galerie':
			include('pages/page_galerie.html');
		break;
		case 'inscription':
			include('pages/page_inscription.html');
		break;
		case 'presentation':
			include('pages/page_presentation.html');
		break;
		case 'recherche':
			include('pages/page_recherche.html');
		break;		
		case 'membres':
			include('pages/page_membres.html');
		break;




		default:
			include('pages/error/404.html');
		break;
}}
else {
	include('pages/page_accueil.html');
}


include('pages/bas.html');


?>