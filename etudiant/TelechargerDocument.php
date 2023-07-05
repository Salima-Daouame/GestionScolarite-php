<?php
session_start();
include('db.php');
if(!isset($_SESSION["CNE"])){
  header('location: login.php');
}
$student = new student();
$documents = $student->getdoc();
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

      <?php include('header.php') ?>
       <div class="container">
    <div class="row">
        <div class="col-md-12">
<div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                       
                        <th>#</th>
                        <th>Document</th>
                        <th>Afficher</th>
                        <th>Télécherger</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      
                       while($doc = $documents->fetch()) : ?>
                    <tr>
                        
                        <td><?php echo $doc['id_doc'] ?></td>
                        <td ><?php echo $doc['Nom_demmande'] ?></td>
                        <td class="text-center"><a href="afficherdoc.php?id_doc=<?php echo $doc['id_doc'] ?>"class="btn btn-primary">Afficher</a></td>
                        <td class="text-center"><a href="telechargerdoc.php?id_doc=<?php echo $doc['id_doc'] ?>" class="btn btn-primary">Télécharger</a></td>
                        
                    </tr>
                    <?php 
                   
                  endwhile; 
                
                  ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<style type="text/css">
.table {
    width:800px;
    height: 200px;
}

.toggleDisplay {
  display: none;
}
.toggleDisplay.in {
  display: table-cell;
}
</style>
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