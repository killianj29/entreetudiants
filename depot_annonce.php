<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Calssimax</title>
  <?php include("connection.php")?>
  
  <!-- PLUGINS CSS STYLE -->
  <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Owl Carousel -->
  <link href="plugins/slick-carousel/slick/slick.css" rel="stylesheet">
  <link href="plugins/slick-carousel/slick/slick-theme.css" rel="stylesheet">
  <!-- Fancy Box -->
  <link href="plugins/fancybox/jquery.fancybox.pack.css" rel="stylesheet">
  <link href="plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet">
  <link href="plugins/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css" rel="stylesheet">
  <!-- CUSTOM CSS -->
  <link href="css/style.css" rel="stylesheet">

  <!-- FAVICON -->
  <link href="img/favicon.png" rel="shortcut icon">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body class="body-wrapper">

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg  navigation">
					<a class="navbar-brand" href="index.html">
						<img src="images/logo.png" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto main-nav ">
							<li class="nav-item active">
								<a class="nav-link" href="index.html">Accueil</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="annonces.html">Annonces</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="profil.html">Profil</a>
							</li>
						</ul>
						<ul class="navbar-nav ml-auto mt-10">
							<li class="nav-item">
								<a class="nav-link login-button" href="index.html">S'inscrire</a>
							</li>
							<li class="nav-item">
								<a class="nav-link login-button" href="index.html">Se connecter</a>
							</li>
							<li class="nav-item">
								<a class="nav-link add-button" href="depot_annonce.html"><i class="fa fa-plus-circle"></i> Déposer une annonce</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</section>

<!--============================
=            Content           =
=============================-->
<section class=" section">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<!-- Section title -->
				
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

	// On crée une entrée :
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
				</div>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>




<!--============================
=            Footer            =
=============================-->

<footer class="footer section section-sm">
  <!-- Container Start -->
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-7 offset-md-1 offset-lg-0">
        <!-- About -->
        <div class="block about">
          <!-- footer logo -->
          <img src="images/logo-footer.png" alt="">
          <!-- description -->
          <p class="alt-color">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
      </div>
      <!-- Link list -->
      <div class="col-lg-2 offset-lg-1 col-md-3">
        <div class="block">
          <h4>Site Pages</h4>
          <ul>
            <li><a href="#">Boston</a></li>
            <li><a href="#">How It works</a></li>
            <li><a href="#">Deals & Coupons</a></li>
            <li><a href="#">Articls & Tips</a></li>
            <li><a href="#">Terms of Services</a></li>
          </ul>
        </div>
      </div>
      <!-- Link list -->
      <div class="col-lg-2 col-md-3 offset-md-1 offset-lg-0">
        <div class="block">
          <h4>Admin Pages</h4>
          <ul>
            <li><a href="#">Boston</a></li>
            <li><a href="#">How It works</a></li>
            <li><a href="#">Deals & Coupons</a></li>
            <li><a href="#">Articls & Tips</a></li>
            <li><a href="#">Terms of Services</a></li>
          </ul>
        </div>
      </div>
      <!-- Promotion -->
      <div class="col-lg-4 col-md-7">
        <!-- App promotion -->
        <div class="block-2 app-promotion">
          <a href="">
            <!-- Icon -->
            <img src="images/footer/phone-icon.png" alt="mobile-icon">
          </a>
          <p>Get the Dealsy Mobile App and Save more</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Container End -->
</footer>
<!-- Footer Bottom -->
<footer class="footer-bottom">
    <!-- Container Start -->
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-12">
          <!-- Copyright -->
          <div class="copyright">
            <p>Copyright © 2016. All Rights Reserved</p>
          </div>
        </div>
        <div class="col-sm-6 col-12">
          <!-- Social Icons -->
          <ul class="social-media-icons text-right">
              <li><a class="fa fa-facebook" href=""></a></li>
              <li><a class="fa fa-twitter" href=""></a></li>
              <li><a class="fa fa-pinterest-p" href=""></a></li>
              <li><a class="fa fa-vimeo" href=""></a></li>
            </ul>
        </div>
      </div>
    </div>
    <!-- Container End -->
    <!-- To Top -->
    <div class="top-to">
      <a id="top" class="" href=""><i class="fa fa-angle-up"></i></a>
    </div>
</footer>

  <!-- JAVASCRIPTS -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="plugins/tether/js/tether.min.js"></script>
  <script src="plugins/raty/jquery.raty-fa.js"></script>
  <script src="plugins/bootstrap/dist/js/popper.min.js"></script>
  <script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="plugins/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js"></script>
  <script src="plugins/slick-carousel/slick/slick.min.js"></script>
  <script src="plugins/jquery-nice-select/js/jquery.nice-select.min.js"></script>
  <script src="plugins/fancybox/jquery.fancybox.pack.js"></script>
  <script src="plugins/smoothscroll/SmoothScroll.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
  <script src="js/scripts.js"></script>

</body>

</html>