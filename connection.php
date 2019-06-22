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

function getOffresMoment($connexion){
	$requete = "SELECT * FROM annonces ORDER BY note desc, date desc LIMIT 3";
	$reponse = $connexion->query($requete);
	return $reponse;
}

// Créer une entrée
function CreerAnnonce($connexion, $categorie, $type_annonce, $image1=NULL, $image2=NULL, $image3=NULL, $titre, $description, $departement, $ville){
	
	$requeteInsert = "INSERT INTO annonces(categorie, type_annonce, image1, image2, image3, titre, description, departement,ville) VALUES ('$categorie', '$type_annonce', '$image1', '$image2', '$image3', '$titre', '$description', '$departement','$ville')";
    $reponseInsert = $connexion->query($requeteInsert);
}

// Créer une entrée
function CreerProfil($connexion, $nom, $prenom, $photo_profil, $ville, $departement, $telephone, $mail, $mot_de_passe){
	
	$requeteInsert = "INSERT INTO annonces(nom, prenom, photo_profil, ville, departement, telephone, mail, mot_de_passe) VALUES ('$nom', '$prenom', '$photo_profil', '$ville', '$departement', '$telephone', '$mail', '$mot_de_passe')";
    $reponseInsert = $connexion->query($requeteInsert);
}

function RechercheAccueil($connexion, $titre, $departement)
{
	$requeteWhere = "SELECT * 
					FROM `annonces` 
					WHERE `titre` LIKE '%'$titre'%' 
					AND `departement` LIKE '%$departement%'";
	$reponseWhere = $connexion->query($requeteWhere);
}

// Récupération des Id de chaque entrée :
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == "update") {
	
	$requeteAnnonceId = "SELECT * FROM annonces WHERE id='". $_GET['id'] . "'";
	$reponseAnnonceId = $bdd-> query($requeteUserId);
	$currentAnnonce = $reponseAnnonceId-> fetch();
	$reponseAnnonceId-> closeCursor();
}

?>
