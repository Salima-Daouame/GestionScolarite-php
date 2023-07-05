<?php
session_start();
include('db.php');
if(!isset($_SESSION["CNE"])){
    header('location: login.php');
}
$student = new student();
$notifications = $student->getNotifications($_SESSION['CNE']);
$notifCount = $student->notifCount($_SESSION['CNE']);
$etudiant = $student->getStudent($_SESSION['CNE']);
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

    <!-- Main CSS   <link rel="stylesheet" href="css/style-reinsc.css"> -->
    <link href="tcss/theme.css" rel="stylesheet" media="all">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--<link rel="stylesheet" href="materialize.min.css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style-reinsc.css">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
  </head>
  <style>
    label {
        margin-bottom: 0;
    
    }
    h4 {
        margin-top: 20px;
        margin-bottom: 5px;
    }
   .col-sm-9{
       margin-left:50px;
       display:block;
   }
</style>
  <body>
    
<div class="wrapper d-flex align-items-stretch">
    <?php include('nav.php') ?>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <?php include("header.php")?>
        
        <hr>
<div class="container bootstrap snippet">
    <div class="row">
      <div class="col-sm-3"><!--left col-->
              

      <div class="text-center">
        
      </div></hr><br>

               
          
          
        </div><!--/col-3-->
      <div class="col-sm-9">
         <?php 
               if(isset($_GET['msg_error']) && !empty(($_GET['msg_error']))){

                  echo "<h3 style='color:green; font-size:18px;'>".$_GET['msg_error']."</h3>";

                }
                
               ?>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home"><i class="fas fa-user-graduate"></i> Inscription</a></li>
              </ul>

              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <hr>
                  <form class="form" action="inscriphp.php" method="post" >
                      <div class="form-group">
                        <div class="col-xs-6">
                            <label for="cne"><h4>CNE:</h4></label>
                            <input type="text" class="form-control" name="cne" id="cne" value="<?php echo $etudiant['CNE'] ?>" disabled>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <div class="col-xs-6">
                        <label for="cni"><h4>CNI:</h4></label>
                        <input type="text" class="form-control" name="cni" id="cni" value="<?php echo $etudiant['CNI'] ?>" disabled>
                    </div>
                </div>
                          
                          <div class="form-group">
                          <div class="col-xs-6">
                              <label for="first_name"><h4>Nom :</h4></label>
                              <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $etudiant['Nom'] ?>" disabled>
                          </div>
                      </div>
                       
                      <div class="form-group">
                      <div class="form-group">
                          <div class="col-xs-6">
                            <label for="last_name"><h4>Prénom :</h4></label>
                              <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $etudiant['Prenom'] ?>" disabled>
                          </div>
                      </div>
          
                      <div class="form-group">
                          <div class="col-xs-6">
                              <label for="nomarb"><h4>Nom en arabe :</h4></label>
                              <input type="text" class="form-control" name="nomarb" id="nomarb" value="<?php echo $etudiant['Nom_AR'] ?>" disabled dir="rtl">
                          </div>
                      </div>
          
                      <div class="form-group">
                          <div class="col-xs-6">
                             <label for="prarb"><h4>Prénom en arabe :</h4></label>
                              <input type="text" class="form-control" name="prarb" id="prarb" value="<?php echo $etudiant['Prenom_AR'] ?>" disabled dir="rtl">
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-xs-6">
                              <label for="daten"><h4>Date de naissance :</h4></label>
                              <input type="text" class="form-control" name="daten" id="daten" value="<?php echo $etudiant['Date_Nais'] ?>" disabled>
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-xs-6">
                              <label for="villeac"><h4>Ville actuelle :</h4></label>
                              <input type="text" class="form-control" name="villeac" value="<?php echo $etudiant['Ville_Actuelle'] ?>" disabled>
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-xs-6">
                              <label for="villeor"><h4>Ville origine :</h4></label>
                              <input type="text" class="form-control" name="villeor" value="<?php echo $etudiant['Ville_Origine'] ?>" disabled>
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-xs-6">
                              <label for="villeora"><h4>Ville origine en arabe :</h4></label>
                              <input type="text" class="form-control" name="villeora" value="<?php echo $etudiant['Ville_Origine_AR'] ?>" disabled>
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-xs-6">
                            <label for="adresse"><h4>Adresse :</h4></label>
                              <input type="text" class="form-control" name="adresse" id="adresse" value="<?php echo $etudiant['Addresse'] ?>" maxlength="100">
                          </div>
                      </div>

                      <div class="form-group">
                        <div class="col-xs-6">
                            <label for="email" ><h4>Email :</h4></label>
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $etudiant['email'] ?>" >
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                          <label for="tel"><h4>Numéro de téléphone :</h4></label>
                            <input type="number" class="form-control" name="tel"  value="<?php echo $etudiant['N_tele'] ?>" >
                        </div>
                    </div>

                    <div class="form-group">
                          <div class="col-xs-6">
                              <label for="classe"><h4>Classe :</h4></label>
                              <input type="text" class="form-control" name="classe" value="<?php echo $etudiant['Id_class'] ?>" disabled>
                          </div>
                      </div>

                    
    
                    <div class="form-group">
                          <div class="col-xs-6">
                            <label for="bacop"><h4>Bac Option :</h4></label>
                              <input type="text" class="form-control" name="bacop" id="bacop" value="<?php echo $etudiant['Bac_Option'] ?>" disabled>
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-xs-6">
                            <label for="filière"><h4>Bac Filière :</h4></label>
                              <input type="text" class="form-control" name="filière" id="filière" value="<?php echo $etudiant['Bac_Filiere'] ?>" disabled>
                          </div>
                      </div>
                                
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="bacmen"><h4>Bac mention :</h4></label>
                              <input type="text" class="form-control" name="bacmen" id="bacmen" value="<?php echo $etudiant['Bac_Mention'] ?>" disabled>
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="annéebac"><h4>Année bac :</h4></label>
                              <input type="text" class="form-control" name="annéebac" id="annéebac" value="<?php echo $etudiant['Bac_Annee'] ?>" disabled>
                          </div>
                      </div>

                      <div class="form-group">
                        <div class="col-xs-6">
                            <label ><h4>photo de bac:</h4></label>
                            <input type="file"  class="form-control"  name="upload_img1" id="upload_img1">
                          </div>
                      </div>

                      <div class="form-group">
                        <div class="col-xs-6">
                            <label ><h4>photo de carte national:</h4></label>
                            <input type="file"  class="form-control"  name="upload_img2" id="upload_img2">
                          </div>
                      </div>

                      <div class="form-group">
                    <div class="form-group">
                        <div class="col-xs-12">
                             <br>
                               <button href="home.php" class="btn btn-lg btn-success" type="submit" name="save"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                
                         </div>
                   </div>

                </form>
              
              <hr>
              
             </div><!--/tab-pane-->
             
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
<script>
    $(document).ready(function() {

    
var readURL = function(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.avatar').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


$(".file-upload").on('change', function(){
    readURL(this);
});
});
</script>
      </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
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

    <script src="vendor/js/main.js"></script>
     <script src="jquery.min.js"></script>
  <script src="bootstrap.min.js"></script>
  <script src="all.min.js"></script>
   
  </body>
</html>