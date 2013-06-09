<?php
$file = fopen("cache/menu.json", "r");
$liste = fread($file, 8192);
$liste_tableau = json_decode($liste, true); 

foreach ($liste_tableau as $categorie) {
	if($categorie['nom'] == "Date"){
		foreach ($categorie["sous_liste"] as $objet) {
			echo '<a href="?page=galerie&'.$categorie['nom'].'='.$objet['nom'].'">'.$objet['nom'].'</a><span></span>';
		};
	}
};
?>