<!DOCTYPE html>
<html>
<head>
	<title>Déposez une annonce !</title>
</head>
<body>


<?php

try {

	// On se connecte à MySQL
	$bdd = new PDO ('mysql:host=remotemysql.com;dbname=oub2gdN0kk;charset=utf8', 'oub2gdN0kk', 'UZdeO6k5tR');
}

catch (Exception $e) {
	// En cas d'ereur, on affiche un message et on arrête tout
	die('Erreur : '.$e-> getMessage());
}


if (!isset($_GET['order'])) {
	$_GET['order'] = 'ASC';
}

// On envoie des données en POST et on les sécurise :
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$prenom = strip_tags(trim($_POST["prenom"]));
	$prenom = str_replace(array("\r", "\n"), array(" ", " "), $prenom);

	$nom = strip_tags(trim($_POST["nom"]));
	$nom = str_replace(array("\r", "\n"), array(" ", " "), $nom);

	$mail = filter_var(trim($_POST["mail"]), FILTER_SANITIZE_EMAIL);

	$departement = $_POST["departement"];

	$tel = $_POST["tel"];
	$tel = preg_replace('/[^0-9+-]/', '', $_POST['tel']);

	$date = $_POST["date"];

	$type_annonce = strip_tags(trim($_POST["type_annonce"]));

	if (isset($_POST['action']) && isset($_POST['numero_annonce']) && !empty($_POST['action'])) {


		// On modifie une entrée :
		if ($_POST['action'] == "update") {
			$requeteUpdate = "UPDATE annonces SET prenom='$prenom', nom='$nom', mail='$mail', departement='$departement', tel='$tel', type_annonce='$type_annonce' WHERE num_annonce='". $_POST['numero_annonce'] . "'";
			$reponseUpdate = $bdd-> query($requeteUpdate);
			$reponseUpdate-> closeCursor();
		}


		// On supprime une entrée :
		else if ($_POST['action'] == "delete") {
			$requeteDelete = "DELETE FROM annonces WHERE num_annonce='" . $_POST['num_annonce'] . "'";
			$reponseDelete = $bdd-> query($requeteDelete);
			$reponseDelete-> closeCursor();
		}
	}

	// On cré une entrée :
	else {
		$requeteInsert = "INSERT INTO annonces(prenom, nom, mail, departement, tel, type_annonce) VALUES ('$prenom', '$nom', '$mail', '$departement', '$tel', '$type_annonce')";
		$reponseInsert = $bdd->query($requeteInsert);
		$reponseInsert -> closeCursor();
	}
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
if (isset($_GET['field'])) {
	$requete .= " ORDER BY " . $_GET['field'] . " " . $_GET['order'];
	$_GET['order'] = $_GET['order'] == "ASC" ? "DESC" : "ASC";
}
$reponse = $bdd-> query($requete);

/*if ($_GET['field'] == "nom" && $_GET['order'] == "ASC") {
	echo '<img '
}*/
?>

<!-- Titre du tablau affichant la Bdd et lien sur 'prenom' et 'nom' pour ordonner-->
<table>
	<tr>
		<th><a href="?depot_annonce.php&order=<?php echo $_GET['order']; ?>&field=nom">Nom</th>
		<th><a href="?depot_annonce.php&order=<?php echo $_GET['order']; ?>&field=prenom">Prenom</th>
		<th><a href="?depot_annonce.php&order=<?php echo $_GET['order']; ?>&field=departement">Departement</th>
		<th><a href="?depot_annonce.php&order=<?php echo $_GET['order']; ?>&field=tel">Numéro de téléphone</th>
		<th><a href="?depot_annonce.php&order=<?php echo $_GET['order']; ?>&field=type_annonce">Type de l'annonce</th>
			<th><a href="?depot_annonce.php&order=<?php echo $_GET['order']; ?>&field=date">Date</th>
		<th>Adresse Email</th>
		<th colspan="2">Actions</th>
	</tr>
	
<?php 


// Affichage de la Bdd sous forme de tablau :
while ($annonce = $reponse->fetch()) {
	echo '<tr style ="border : 1px solid; width : 5vw">'
		.'<td style ="border : 1px solid; width : 5vw">' . $annonce['nom'] . '</td>'
		.'<td style ="border : 1px solid; width : 5vw">' . $annonce['prenom'] . '</td>'
		.'<td style ="border : 1px solid; width : 5vw">' . $annonce['departement'] . '</td>'
		.'<td style ="border : 1px solid; width : 5vw">' . $annonce['tel'] . '</td>'
		.'<td style ="border : 1px solid; width : 5vw">' . $annonce['type_annonce'] . '</td>'
		.'<td style ="border : 1px solid; width : 5vw">' . $annonce['date'] . '</td>'
		.'<td style ="border : 1px solid; width : 5vw">' . $annonce['mail'] . '</td>'
		.'<td style ="border : 1px solid; width : 5vw"><a href="?depot_annonce.php&numero_annonce='.$annonce['num_annonce'].'&action=update">Modifier</td>'
		.'<td style ="border : 1px solid; width : 5vw"><a onclick="confirmerSuppression(\''.$annonce['num_annonce'].'\', \''.$annonce['nom'].'\', \''.$annonce['prenom'].'\')" href="?depot_annonce.php&numero_annonce='.$annonce['num_annonce'].'&action=delete">Supprimer</td>'
		.'</tr>';
}

$reponse-> closeCursor();
?>
</table>


<!-- Le Formulaire -->
<div>
	<h2>Déposer une annonce</h2>
	<form action="depot_annonce.php" method="POST">
		<div>
			<label for="nom">Nom</label><br><input type="text" name="nom" placeholder="Nom" value="<?php echo isset($_GET['action']) && $_GET['action'] == 'update' ? $currentUser['nom'] : ''; ?>">
		</div>
		<br>
		<div>
			<label for="age">Prenom</label><br><input type="text" name="prenom" placeholder="Prenom" value="<?php echo isset($_GET['action']) && $_GET['action'] == 'update' ? $currentUser['prenom'] : ''; ?>">
		</div>
		<br>
		<div>
			<label for="age">Departement</label><br><input type="text" name="departement" placeholder="Departement" value="<?php echo isset($_GET['action']) && $_GET['action'] == 'update' ? $currentUser['departement'] : ''; ?>">
		</div>
		<br>
		<div>
			<label for="age">Numéro de téléphone</label><br><input type="text" name="tel" placeholder="Tel" value="<?php echo isset($_GET['action']) && $_GET['action'] == 'update' ? $currentUser['tel'] : ''; ?>">
		</div>
		<br>
		<div>
			<label for="age">Type de l'annonce</label><br><input type="text" name="type_annonce" placeholder="Type de l'annonce" value="<?php echo isset($_GET['action']) && $_GET['action'] == 'update' ? $currentUser['type_annonce'] : ''; ?>">
		</div>
		<br>
		<div>
			<label for="age">Date</label><br><input type="text" name="date" placeholder="Date" value="<?php echo isset($_GET['action']) && $_GET['action'] == 'update' ? $currentUser['date'] : ''; ?>">
		</div>
		<br>
		<div>
			<label for="mail">Adresse email</label><br><input type="text" name="mail" placeholder="Adresse email" value="<?php echo isset($_GET['action']) && $_GET['action'] == 'update' ? $currentUser['mail'] : ''; ?>">
		</div>
		<br>
		<div>
			<input id="inputDelete" type="hidden" name="action" value="<?php echo isset($_GET['action']) ? $_GET['action'] : ''; ?>">
			<input id="inputUserId" type="hidden" value="<?php echo isset($_GET['num_annonce']) ? $_GET['num_annonce'] : '-1'; ?>" name="num_annonce">
			<input id="submitBtn" type="submit" value="<?php echo isset($_GET['num_annonce']) ? "Modifier" : "Enregistrer"; ?>">
		</div>

	</form>
</div>

<div>

<div>
	<script type="text/javascript">
		function confirmerSuppression (num_annonce, nom, prenom) {
			if (confirm("Voulez-vous vraiment supprimer cette annonce ? [ Le/la " + type_annonce + ", au nom de " + nom + " " + prenom + " déposé(e) le " + date + "]?")){
				document.querySelector("#inputDelete").value = "delete";
				document.querySelector("#inputUserId").value = num_annonce;
				document.querySelector("#submitBtn").click();
				return false;
			}
		}
	</script>
</div>

</body>
</html>