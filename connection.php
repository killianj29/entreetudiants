<?php

try {

	// On se connecte à MySQL
	$bdd = new PDO ('mysql:host=remotemysql.com;dbname=oub2gdN0kk;charset=utf8', 'oub2gdN0kk', 'UZdeO6k5tR');
}

catch (Exception $e) {
	// En cas d'ereur, on affiche un message et on arrête tout
	die('Erreur : '.$e-> getMessage());
}

// Récupération des Id de chaque entrée :
if (isset($_GET['numero_annonce']) && isset($_GET['action']) && $_GET['action'] == "update") {
	
	$requeteUserId = "SELECT * FROM annonces WHERE num_annonce='". $_GET['numero_annonce'] . "'";
	$reponseUserId = $bdd-> query($requeteUserId);
	$currentUser = $reponseUserId-> fetch();
	$reponseUserId-> closeCursor();
}

// On sélectionne la base de données et on l'ordonne :
$requete = "SELECT * FROM annonces";
$reponse = $bdd-> query($requete);
?>
