<?php
  include("connection.php");

  $connexion = getDatabaseConnexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['forminscription'])) {
      
      $nom = $_POST["nom"];
      $prenom = $_POST["prenom"];
      $photo_profil = $_POST["photo_profil"];
      $ville = $_POST["ville"];
      $departement = $_POST["departement"];
      $telephone = $_POST["telephone"];
      $mail = htmlspecialchars($_POST["mail"]);
      $mail2 = htmlspecialchars($_POST["mail2"]);
      $mot_de_passe = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT);
      $mot_de_passe2 = password_hash($_POST["mot_de_passe2"], PASSWORD_DEFAULT);
      
      $erreurTrouvee = false;
      $erreurs = array();

      foreach ($_POST as $key => $value) {
        if (in_array($value,  array("nom", "prenom", "ville", "departement", "telephone", "mail", "mail2", "mot_de_passe", "mot_de_passe2"))) {
          if (empty($_POST[$value])) {
            $erreurs[$value] = "Un champ obligatoire est vide.";
            $erreurTrouvee = true;
            break;
          }
        }
      }

      if (!$erreurTrouvee && (strlen($nom) > 50 || strlen($prenom) > 50)) {
        $erreurs["nom"] = "Votre nom et votre prénom ne doivent pas dépasser 50 caractères !";
        $erreurs["prenom"] = "Votre nom et votre prénom ne doivent pas dépasser 50 caractères !";
        $erreurTrouvee = true;
      }

      if (!$erreurTrouvee && strlen($departement) > 2) {
        $erreurs["departement"] = "Vos departement ne correspond pas !";
        $erreurTrouvee = true;
      }

      if (!$erreurTrouvee && strlen($telephone) > 10) {
        $erreurs["telephone"] = "Votre numéro de télephone ne correspond pas !";
        $erreurTrouvee = true;
      }

      if(!$erreurTrouvee && !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $erreurs["mail1"] = "Votre adresse mail n'est pas valide !";
        $erreurTrouvee = true;
      }

      if (!$erreurTrouvee && $mail != $mail2) {
        $erreurs["mail2"] = "Vos adresses mail ne correspondent pas !";
        $erreurTrouvee = true;
      }

      if (!$erreurTrouvee) {
        $reqmail = $bdd->prepare("SELECT * FROM utilisateurs WHERE mail = ?");
        $reqmail->execute(array($mail));
        $mailexist = $reqmail->rowCount();

        if ($mailexist == 1) {
          $erreurs["mail3"] = "Adresse mail déjà utilisée !";
          $erreurTrouvee = true;
        }
      }

      if(!$erreurTrouvee && $mot_de_passe != $mot_de_passe2) {
          $erreur["mdp"] = "Vos mots de passes ne correspondent pas !";
          $erreurTrouvee = true;
      }


      if (!$erreurTrouvee) {
        $creationProfil = CreerProfil($connexion, $nom, $prenom, $photo_profil, $ville, $departement, $telephone, $mail, $mot_de_passe);
      }                                
  }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EntreEtudiants</title>
  
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
					<a class="navbar-brand" href="index.php">
						<a href="index.php"><h2>EntreEtudiants<h2></a>
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto main-nav ">
							<li class="nav-item">
								<a class="nav-link" href="index.php">Accueil</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="annonces.php">Annonces</a>
							</li>
							<li class="nav-item active">
								<a class="nav-link" href="profil.php">Profil</a>
							</li>
						</ul>
						<ul class="navbar-nav ml-auto mt-10">
							<li class="nav-item">
								<a class="nav-link add-button" href="depot_annonce.php"><i class="fa fa-plus-circle"></i> Déposer une annonce</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</section>

<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
  <!-- Inscription -->
  <div class="widget personal-info">
  	<h3 class="widget-header user">Inscription</h3>
  	<form action="profil.php" method="POST">
  		<!-- Nom -->
  		<div class="form-group">
  		    <label for="nom">Nom</label>
  		    <input type="text" class="form-control" name="nom" required>
  		</div>
  		<!-- Prenom -->
  		<div class="form-group">
  		    <label for="prenom">Prenom</label>
  		    <input type="text" class="form-control" name="prenom" required>
  		</div>
  		<!-- Photo de profil -->
  		<div class="form-group choose-file">
  			<label for="photo-profil">Photo de profil</label>
  			<i class="fa fa-user text-center"></i>
  		    <input type="file" class="form-control-file d-inline" name="photo_profil">
  		 </div>
  		<!-- Departement -->
  		<div class="form-group">
  		    <label for="departement">Departement</label>
  		    <input type="text" class="form-control" name="departement" required>
  		</div>
  		<!-- Ville -->
  		<div class="form-group">
  		    <label for="ville">Ville</label>
  		    <input type="text" class="form-control" name="ville" required>
  		</div>
  		<!-- Mot de passe -->
  		<div class="widget change-password">
  			<h3 class="widget-header user">Mot de passe</h3>
  			<div class="form-group">
  			    <label for="mot-de-passe">Mot de passe</label>
  			    <input type="password" class="form-control" name="mot_de_passe" required>
  			</div>
  			<!-- Confirmation Mot de passe -->
  			<div class="form-group">
  			    <label for="confirmez-mot-de-passe">Confirmez votre mot de passe</label>
  			    <input type="password" class="form-control" name="mot_de_passe2" required>
  			</div>
  		</div>
  		<!-- Adresse email -->
  		<div class="widget mail mb-0">
  			<h3 class="widget-header user">Adresse email</h3>
  			<div class="form-group">
  			    <label for="mail">Adresse email</label>
  			    <input type="email" class="form-control" name="mail" required>
  			</div>
        <!-- Confirmation emial -->
        <div class="form-group">
            <label for="confirmez-email">Confirmez votre adresse email</label>
            <input type="email" class="form-control" name="mail2" required>
        </div>
  		</div>
      <!-- Téléphone -->
      <div class="widget mb-0">
        <h3 class="widget-header user">Numéro de télephone</h3>
        <div class="form-group">
            <label for="telephone">Numéro de télephone</label>
            <input type="tel" class="form-control" name="telephone" required maxlength="10">
        </div>
      </div>
      <!-- Bouton -->
      <div>
        <input class="btn btn-transparent" type="submit" value="S'inscrire" name="forminscription">
      </div>
  	</form>
  </div>
</div>
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
          <h1 name="entreetudiants" class="text-white">EntreEtudiants</h1>
          <!-- description -->
          <p class="alt-color"></p>
        </div>
      </div>
      <!-- Lien vers les pages -->
      <div class="col-lg-2 offset-lg-7 col-md-3">
        <div class="block">
          <h4>Parcourir les pages</h4>
          <ul>
            <li><a href="annonces.php">Voir les annonces</a></li>
            <li><a href="profil.php">Voir son profil</a></li>
            <li><a href="depot_annonce.php">Déposer une annonce</a></li>
          </ul>
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