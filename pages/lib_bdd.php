<?php



	function connexionbdd(){
		try
		{
			$bdd = new PDO('mysql:host='$bdd_adresse';dbname='.$bdd_nom.'', $bdd_login, $bdd_pw);
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
	}