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


?>
