<?php
	include("connection.php");

	$connexion = getDatabaseConnexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$categorie = $_POST["categorie"];
	$type_annonce = $_POST["type_annonce"];
	/*$image1 = $_POST["image1"];
	$image2 = $_POST["image2"];
	$image3 = $_POST["image3"];*/
	$titre = $_POST["titre"];
	$description = $_POST["description"];
	$departement = $_POST["departement"];
	$ville = $_POST["ville"];

	$creationAnnonce = Create($connexion, $categorie, $type_annonce, NULL, NULL, NULL, $titre, $description, $departement, $ville);
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
							<li class="nav-item">
								<a class="nav-link" href="profil.php">Profil</a>
							</li>
						</ul>
						<ul class="navbar-nav ml-auto mt-10">
							<li class="nav-item">
								<a class="nav-link login-button" href="inscription.php">S'inscrire</a>
							</li>
							<li class="nav-item active">
								<a class="nav-link add-button" href="depot_annonce.php"><i class="fa fa-plus-circle"></i> Déposer une annonce</a>
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

			

<!-- Edit Personal Info -->
<div class="widget personal-info">
<h3 class="widget-header user">Déposer une annnonce</h3>
<form action="confirmation_annonce.php" method="POST">
<!-- First Name -->
<div class="form-group">
	<label for="categorie">Selectionner une catégorie *</label>
	<div>
	<select name="categorie" id="categorie" class="select" required>
		<option value="0">«Choisissez une catégorie»</option>                   
		<option value="1" style="background-color:#E6E6E6" disabled="" id="cat1">-- VEHICULES --</option>
		<option value="Voitures" id="cat2">Voitures</option>
		<option value="Motos" id="cat3">Motos</option>
		<option value="Utilitaires" id="cat5">Utilitaires</option>
		<option value="Equipement Auto" id="cat6">Equipement Auto</option>
		<option value="Equipement Moto" id="cat44">Equipement Moto</option>
		<option value="8" style="background-color:#E6E6E6" disabled="" id="cat8">-- MULTIMEDIA --</option>
		<option value="Informatique" id="cat15">Informatique</option>
		<option value="Consoles/Jeux vidéo" id="cat43">Consoles &amp; Jeux vidéo</option>
		<option value="Image/Son" id="cat16">Image &amp; Son</option>
		<option value="Téléphonie" id="cat17">Téléphonie</option>
		<option value="18" style="background-color:#E6E6E6" disabled="" id="cat18">-- MAISON --</option>
		<option value="Ameublement" id="cat19">Ameublement</option>
		<option value="Electroménager" id="cat20">Electroménager</option>
		<option value="Linge de maison" id="cat46">Linge de maison</option>
		<option value="Bricolage" id="cat21">Bricolage</option>
		<option value="Vêtements" id="cat22">Vêtements</option>
		<option value="Chaussures" id="cat53">Chaussures</option>
		<option value="24" style="background-color:#E6E6E6" disabled="" id="cat24">-- LOISIRS --</option>
		<option value="DVD/Films" id="cat25">DVD / Films</option>
		<option value="CD/Musique" id="cat26">CD / Musique</option>
		<option value="Livres" id="cat27">Livres</option>
		<option value="Sports/Hobbies" id="cat29">Sports &amp; Hobbies</option>
		<option value="Instruments de musique" id="cat30">Instruments de musique</option>
		<option value="56" style="background-color:#E6E6E6" disabled="" id="cat56">-- SERVICES --</option>
		<option value="Prestations de services" id="cat34">Prestations de services</option>
		<option value="Cours particuliers" id="cat36">Cours particuliers</option>
		<option value="37" style="background-color:#E6E6E6" disabled="" id="cat37">-- -- --</option>
		<option value="Autres" id="cat38">Autres</option>
	</select>
	</div>
</div>
<!-- Last Name -->
<div class="form-group">
	<label for="type_annonce">Type d'annonce *</label>
		<div>
			<label for="offre">Offre</label>
			<input type="radio" id="offre" name="type_annonce" checked value="offre">
		
			<label for="demande">Demande</label>
			<input type="radio" id="demande" name="type_annonce" value="demande">
		</div>
</div>
<!-- File chooser -->
<div class="form-group choose-file">
	<label for="file1">Image n°1</label>
	<input type="file" class="form-control-file d-inline" name="image1">
</div>
<div class="form-group choose-file">
	<label for="file2">Image n°2</label>
	<input type="file" class="form-control-file d-inline" name="image2">
</div>
<div class="form-group choose-file">
	<label for="file3">Image n°3</label>
	<input type="file" class="form-control-file d-inline" name="image3">
</div>
<!-- Comunity Name -->
<div class="form-group">
	<label for="titre_annonce">Titre de l'annonce *</label>
	<input type="text" class="form-control" name="titre" required>
</div>
<div class="form-group">
	<label for="description_annonce">Description de l'annonce *</label>
	<div>
	<textarea name="description" rows="10" maxlength="3500" style="width: 100%;" required></textarea>
	</div>
</div>
<div class="form-group">
	<label for="departement">Departement *</label>
	<input type="text" class="form-control" name="departement" style="width: 30%;" maxlength="7" required>
</div>
<div class="form-group">
	<label for="ville">Ville *</label>
	<input type="text" class="form-control" name="ville" style="width: 30%;" required>
</div>
<div>
	<input class="btn btn-transparent" type="submit" value="Déposer mon annonce">
</div>
</form>
</div>

				


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