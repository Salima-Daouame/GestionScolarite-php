<?php
session_start();
include('db.php');
if(!isset($_SESSION["CNE"])){
  header('location: login.php');
}
$student = new student();
$notifications = $student->getNotifications($_SESSION['CNE']);
$notifCount = $student->notifCount($_SESSION['CNE']);

?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Ecole Supérieure de Téchnologie Safi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="assets/css/contact.css">
   
    <link rel="stylesheet" href="assets/css/main.css">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
        



    <link href="tcss/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="tcss/theme.css" rel="stylesheet" media="all">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
		
	<div class="wrapper d-flex align-items-stretch">
    <?php include('nav.php') ?>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        

        <?php include("header.php")?>


        <!----  ------------------- CODE IMANE------------------------------------------------------->
  <div id="main">

				
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
     <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>

  <div class="carousel-inner">
    <div class="carousel-item active">
    <img src="images/salim.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
    <img src="images/lamia.png" class="d-block w-100" alt="...">
    </div>
  </div>
  
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
  </div>


<div class="row row-cols-1 row-cols-md-2 g-4">
  <div class="col">
    <div class="card">
     <img src= "images/Service-Minhaty-2017.png" class="card-img-top" alt="..">
    <div class="card-body">
      <h5 class="card-title">Minhaty</h5>
      <p class="card-text">Pour suivre votre demande de subvention, veuillez vous connecter via le portail: <di>
    https://www.minhaty.ma</di></p>
    </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
    <img src="images/download.jpg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Rentrée universitaire 2021-2022</h5>
      <p class="card-text"> le debut des cours en présentiel est lundi 09 novembre 2021. </p>
    </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
    <img src="images/exam (2).jpg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Accés à la platforme numérique cours</h5>
    <p class="card-text">les étudiants sont invités à suivre leurs cours<div>"http://ecampus-ests.uca.ma"</div></p>
    </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
    <img src="images/uca.jpg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="Card ">les informations qui concerne toues les etudiants de ESTS"title</h5>
      <p class="card-text">les emplois de temps et resultas des DS/examens sont disponible sur le lien:http://www.ests.uca.ma/</p>
    </div>
    </div>
  </div>
  </div>


<!-- About Me -->
<section id="about" class="three">
    <div class="container">

      <header>
        <h2>ECOLE SUPERIEURE DE TECHNOLOGIE SAFI</h2>
      </header>

      <a href="#" class="image featured"><img src="images/tawjih-cover-400x250.png" alt="" /></a>

      <p>Premier noyau universitaire de la ville de Safi, l’Ecole Supérieure de Technologie de Safi (ESTS) a démarré en septembre 1992. C’est l’établissement phare de l’université Cadi Ayyad   en termes de formation technologique et professionnelle courte.</p>
      <p class="card-text"> <div  class="email"><i class="fas fa-envelope-square"></i> contact.ests@uca.ma       </div > <div class="mobile"><i class="fas fa-phone-volume"></i> (+212).5.24.62.50.53</div>    <div class="copiryght"><i class="far fa-copyright"></i> 2021 EST SAFI||Devloped BY "les étudiants génie informatique"</div>          </p>
    
    </div>
  </section>


<!-- Contact  --->
<div class="imane" >	
   <div class="container">     
  <form id="contact" action="" method="post">
    <h3>Quick Contact</h3>
    <h4>Contact us today, and get reply with in 24 hours!</h4>
    <fieldset>
    <input placeholder="Your name" type="text" tabindex="1" required autofocus>
    </fieldset>
    <fieldset>
    <input placeholder="Your Email Address" type="email" tabindex="2" required>
    </fieldset>
    <fieldset>
    <input placeholder="Your Phone Number" type="tel" tabindex="3" required>
    </fieldset>
    <fieldset>
    </fieldset>
    <fieldset>
    <textarea placeholder="Type your Message Here...." tabindex="5" required></textarea>
    </fieldset>
    <fieldset>
    <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
    </fieldset>
  </form>
</div>
</div>



      </div>
		</div>
  <style>
    #main{
   margin-left:0px;
  }
  .carousel-item{
   width: 100%;
  }  
  </style>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>

    <!-- Main JS-->
    <script src="vendor/js/main.js"></script>
    <script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
  </body>
</html>
<script>
$(window).on('load', function() {
  $(window).scrollTop(0);
});
</script>