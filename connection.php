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
function getBdd(){
	$connection = getDatabaseConnexion();
	$requete = "SELECT * FROM annonces";
	$reponse = $connection->query($requete);
	return $reponse;
}

// Créer une entrée
function Create ($prenom, $nom, $mail, $departement, $tel, $type_annonce, $libelle){
	try {
		$connection = getDatabaseConnexion();
		$sql = "INSERT INTO annonces(prenom, nom, mail, departement, tel, type_annonce, libelle) VALUES ('$prenom', '$nom', '$mail', '$departement', '$tel', '$type_annonce', '$libelle')";
	    	$connection->exec($sql);
		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}

?>
