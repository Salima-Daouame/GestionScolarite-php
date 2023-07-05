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
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
    <?php include('nav.php') ?>
    

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

      <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
              <li class="nav-item">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity"><?php echo $notifCount[0] ?></span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have <?php echo $notifCount[0] ?> Notifications</p>
                                            </div>
                                            <?php
                                            while($res = $notifications->fetch()){
                                              $notification = $student->getNotification($res['Id_notification']);
                                              echo '
                                              <div class="notifi__item">
                                                  <div class="bg-c1 img-cir img-40">
                                                      <i class="zmdi zmdi-email-open"></i>
                                                  </div>
                                                  <div class="content">
                                                    <a href="notification.php?id='.$res['Id_notification'].'">
                                                      <p>'.substr($notification['Notification'], 0, 50).'...</p>
                                                      <span class="date">'.$notification['Date_notification'].'</span>
                                                    </a>
                                                  </div>
                                              </div>';
                                            }
                                            ?>
                                            <div class="notifi__footer">
                                                <a href="notifications.php">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
              </li>
         <li class="nav-item active">
                    <a class="nav-link" href="homepage.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profil.php">Profil</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="deconnexion.php"><i class="fa fa-sign-out-alt"></i></i></a>
                </li>
                </li>
                
              </ul>
            </div>
          </div>
        </nav>
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
                <li class="active"><a data-toggle="tab" href="#home"><i class="fas fa-user-graduate"></i> Réinscription</a></li>
              </ul>

              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <hr>
                  <form class="form" action="validate_user.php" method="post" id="registrationForm">
                      <div class="form-group">

                        <div class="col-xs-6">
                            <label for="cne"><h4>CNE:</h4></label>
                            <input type="text" class="form-control" name="cne" id="cne" value="<?php echo $etudiant['CNE']?>" readonly>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <label for="cni"><h4>CNI:</h4></label>
                        <input type="text" class="form-control" name="cni" id="cni" value="<?php echo $etudiant['CNI']?>" disabled>
                    </div>
                </div>
                          
                          <div class="col-xs-6">
                              <label for="name"><h4>Nom :</h4></label>
                              <input type="text" class="form-control" name="name" id="first_name" value="<?php echo $etudiant['Nom']?>" disabled>
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="pre"><h4>Prénom :</h4></label>
                              <input type="text" class="form-control" name="pre" id="last_name" value="<?php echo $etudiant['Prenom']?>" disabled>
                          </div>
                      </div>
          
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="nomar"><h4>Nom en arabe :</h4></label>
                              <input type="text" class="form-control" name="nomar" id="phone" value="<?php echo $etudiant['Nom_AR']?>" disabled dir="rtl">
                          </div>
                      </div>
          
                      <div class="form-group">
                          <div class="col-xs-6">
                             <label for="pre"><h4>Prénom en arabe :</h4></label>
                              <input type="text" class="form-control" name="pre" id="mobile" value="<?php echo $etudiant['Prenom_AR']?>" disabled dir="rtl">
                          </div>
                      </div>

                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="Date"><h4>Date de naissance :</h4></label>
                              <input type="text" class="form-control" name="Date" id="email" value="<?php echo $etudiant['Date_Nais']?>" disabled>
                          </div>
                      </div>

                      <div class="form-group"> 
                          <div class="col-xs-6">
                              <label for="location"><h4>Ville Actuelle</h4></label>
                              <input type="text" class="form-control" id="location" value="<?php echo $etudiant['Ville_Actuelle']?>" disabled dir="rtl">
                          </div>
                      </div>

        

                      <div class="form-group">
                          <div class="col-xs-6">
                              <label for="villeO"><h4>Ville Origine :</h4></label>
                              <input type="text" class="form-control" name="villeO" value="<?php echo $etudiant['Ville_Origine']?>" disabled>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="col-xs-6">
                              <label for="villeOAR"><h4>Ville Origine en  Arabe :</h4></label>
                              <input type="text" class="form-control" name="villeOAR" value="<?php echo $etudiant['Ville_Origine_AR']?>" disabled>
                          </div>
                      </div>

                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label><h4>Adresse :</h4></label>
                              <input type="text" class="form-control" name="adress" id="password2" value="<?php echo $etudiant['Addresse']?>" maxlength="100">
                          </div>
                      </div>
                      <div class="form-group">
                          
                        <div class="col-xs-6">
                            <label for="mail"><h4>Email :</h4></label>
                            <input type="email" class="form-control" name="mail" value="<?php echo $etudiant['email']?>">
                        </div>
                    </div>

                    <div class="form-group">
                        
                        <div class="col-xs-6">
                          <label><h4>Numéro de téléphone :</h4></label>
                            <input type="number" class="form-control" name="num_tele" id="" value="<?php echo $etudiant['N_tele']?>" >
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                              <label><h4>Mot de passe :</h4></label>
                              <input type="password" class="form-control" name="passw" id="" value="" required>
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-xs-6">
                            <label for="last_name"><h4>Class :</h4></label>
                              <input type="text" class="form-control" name="idclass" id="last_name" value="<?php echo $etudiant['Id_class']?>" disabled>
                          </div>
                      </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            
                         <button class="btn btn-lg btn-success" type="submit" name="valider"><i class="glyphicon glyphicon-ok-sign"></i>Valider</button>
                         </div>
                   </div>

              	</form>
              
              <hr>
         



             </div><!--/tab-pane   <div class="form-group"> -->
             
               
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript" src="all.js"></script>
      <script src="ja/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/all.min.js"></script>

  </body>
</html>