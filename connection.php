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
function Create($prenom, $nom, $mail, $departement, $tel, $type_annonce, $libelle){
	try {
		$connection = getDatabaseConnexion();
		$sql = "INSERT INTO annonces(prenom, nom, mail, departement, tel, type_annonce, libelle) VALUES ('$prenom', '$nom', '$mail', '$departement', '$tel', '$type_annonce', '$libelle')";
	    	$connection->exec($sql);
		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}

if (isset($_POST['action']) && isset($_POST['numero_annonce']) && !empty($_POST['action'])) {
		
	Create($prenom, $nom, $mail, $departement, $tel, $type_annonce, $libelle);
		
	echo "Annonce créée <br>";
	echo "<a href='index.php'>Retourner à la page d'accueil</a>";
		
}

// Récupération des Id de chaque entrée :
if (isset($_GET['numero_annonce']) && isset($_GET['action']) && $_GET['action'] == "update") {
	
	$requeteNumeroAnnonce = "SELECT * FROM annonces WHERE num_annonce='". $_GET['numero_annonce'] . "'";
	$reponseNumeroAnnonce = $bdd-> query($requeteUserId);
	$currentAnnonce = $reponseNumeroAnnonce-> fetch();
	$reponseNumeroAnnonce-> closeCursor();
}

?>
