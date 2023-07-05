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
        <link rel="stylesheet" href="css/style_demande1.css" />
        <link rel="stylesheet" href="css/style.css">
     	

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

      <?php include('header.php') ?>


			
	
	<div id="ALL">
		<!------------- Partie de demande les document------------->
		
				<form action="ajtBD.php" class="frm" method="post">
					<h3>Reclamation :</h3>
					       </p>
             <?php 
               if(isset($_GET['msg_error']) && !empty(($_GET['msg_error']))){

                  echo "<h3 style='color:green; font-size:18px;'>".$_GET['msg_error']."</h3>";

                }
                if(isset($_GET['msg_error2']) && !empty(($_GET['msg_error2']))){

                  echo "<h3 style='color:red'>".$_GET['msg_error2']."</h3>";
                }
               ?>
              
             <input type="hidden" name="sujet"  value=""> 
              <input type="hidden" name="reclamation" value=""> 
              
              <input type="hidden" name="date" value="<?php echo date('Y-m-d') ?>" >
              <input type="hidden" name="cne" value="<?php echo $etudiant['CNE'] ?>" >

            	<!------------- Sujet------------->
            
                    <label for="">Sujet</label>
                    <input type="text" id="sujet" name="sujet" placeholder="entrer le sujet " required>
                
                	<!------------- Reclamation------------->

              <label for="">Reclamation</label>
              <input type="text" id="reclamation"  name="reclamation" placeholder="entrer le reclametion " required>

              	<!------------- DATE------------->

              <label for="">Date</label>
              <input type="text" id="date" disabled value="<?php echo date('Y-m-d') ?>" >

	<!------------- CME------------->

              <label for="">CNE</label>
              <input type="text" id="cne" disabled value=" <?php echo $etudiant['CNE'] ?>"> 
                  

              <input type="submit" id="but" name="envoyer" value="envoyer">
				</form>
			

	</div>



      </div>
		</div>

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
  </body>
</html>