<?php

function getDatabaseConnexion(){
	try {

		// On se connecte à MySQL
		$pdo = new PDO ('mysql:host=remotemysql.com;dbname=oub2gdN0kk;charset=utf8', 'oub2gdN0kk', 'UZdeO6k5tR');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
			
	}

	
	catch (PDOException $e) {
		// En cas d'ereur, on affiche un message et on arrête tout
		print "Erreur !: " . $e->getMessage() . "<br/>";
		die();
	}
}

// On sélectionne la base de données
function getAnnonces($connexion){
	$requete = "SELECT * FROM annonces";
	$reponse = $connexion->query($requete);
	return $reponse;
}

// Créer une entrée
/*function Create(){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['action']) && !empty($_POST['action'])) {

		$requeteInsert = "INSERT INTO annonces(categorie, type_annonce, image1, image2, image3, titre, description) VALUES ('$categorie', '$type_annonce', '$image1', '$image2', '$image3', '$titre', '$description')";
	    $reponseInsert = $connexion->exec($requeteInsert);
		}
	}
	    
}*/

// Récupération des Id de chaque entrée :
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == "update") {
	
	$requeteAnnonceId = "SELECT * FROM annonces WHERE id='". $_GET['id'] . "'";
	$reponseAnnonceId = $bdd-> query($requeteUserId);
	$currentAnnonce = $reponseAnnonceId-> fetch();
	$reponseAnnonceId-> closeCursor();
}

?>
