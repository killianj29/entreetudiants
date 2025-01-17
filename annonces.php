<?php
	include("connection.php");

	$connexion = getDatabaseConnexion();
	$annonces = getAnnonces($connexion);
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

<body class="body-wrapper">.

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
							<li class="nav-item active">
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

<section class="page-search">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Advance Search -->
				<div class="advance-search">
					<form>
						<div class="form-row">
							<div class="form-group col-md-4">
								<input type="text" class="form-control" id="inputtext4" placeholder="Rechercher un produit">
							</div>
							<div class="form-group col-md-3">
								<input type="text" class="form-control" id="inputCategory4" placeholder="Rechercher par catégorie">
							</div>
							<div class="form-group col-md-3">
								<input type="text" class="form-control" id="inputLocation4" placeholder="Rechercher par département">
							</div>
							<div class="form-group col-md-2">
								
								<button type="submit" class="btn btn-primary">Rechercher</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section-sm ml-5 mr-5">
	<div class="product-grid-list">
		<div class="row mt-30">
			<?php
				foreach ($annonces as $annonce) {
			?>
			<div class="col-sm-12 col-lg-4 col-md-6">

				<!-- product card -->
				<div class="product-item bg-light">
					<div class="card">
						<div class="thumb-content">
							<!-- <div class="price">$200</div> -->
							<a href="">
								<img class="card-img-top img-fluid" src="<?php echo $annonce['image1']; ?>" alt="Card image cap">
							</a>
						</div>
						<div class="card-body">
						    <h4 class="card-title"><a href=""><?php echo $annonce['titre']; ?></a></h4>
						    <ul class="list-inline product-meta">
						    	<li class="list-inline-item">
						    		<a href=""><i class="fa fa-folder-open-o"></i><?php echo $annonce['categorie']; ?></a>
						    	</li>
						    	<li class="list-inline-item">
						    		<a href=""><i class="fa fa-calendar"></i><?php echo $annonce['date']; ?></a>
						    	</li>	
						    	<li class="list-inline-item">
						    		<a href=""><i class="fa fa-money"></i><?php echo $annonce['montant']. '€'; ?></a>
						    	</li>
						    </ul>
						    <p class="card-text"><?php echo $annonce['description']; ?></p>
						    <div class="product-ratings">
						    	<ul class="list-inline"> 
						    		<li class="list-inline-item <?php echo $annonce['note'] > 0 ? 'selected' : ''; ?>"><i class="fa fa-star"></i></li>
						    		<li class="list-inline-item <?php echo $annonce['note'] > 1 ? 'selected' : ''; ?>"><i class="fa fa-star"></i></li>
						    		<li class="list-inline-item <?php echo $annonce['note'] > 2 ? 'selected' : ''; ?>"><i class="fa fa-star"></i></li>
						    		<li class="list-inline-item <?php echo $annonce['note'] > 3 ? 'selected' : ''; ?>"><i class="fa fa-star"></i></li>
						    		<li class="list-inline-item <?php echo $annonce['note'] > 4 ? 'selected' : ''; ?>"><i class="fa fa-star"></i></li>
						    	</ul>
						    </div>
						</div>
					</div>
				</div>
			</div>
	<?php
		}
	?>
		</div>
	</div>

	<div class="pagination justify-content-center">
		<nav aria-label="Page navigation example">
			<ul class="pagination">
				<li class="page-item">
					<a class="page-link" href="#" aria-label="Previous">
						<span aria-hidden="true">&laquo;</span>
						<span class="sr-only">Précédent</span>
					</a>
				</li>
				<li class="page-item"><a class="page-link" href="#">1</a></li>
				<li class="page-item active"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item">
					<a class="page-link" href="#" aria-label="Next">
						<span aria-hidden="true">&raquo;</span>
						<span class="sr-only">Suivant</span>
					</a>
				</li>
			</ul>
		</nav>
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