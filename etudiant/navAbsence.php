<!--THE CONNECTION-->
<?php
// try{
//     $db = new PDO('mysql:host=127.0.0.1;dbname=pfe;charset=utf8','root','');
// }catch(Exception $e){
//     die('Error'.$e->getMessage());
// }
?>
<!--THE HEADER-->
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
    <!-- Main CSS-->
    <link href="tcss/theme.css" rel="stylesheet" media="all">

  </head>
  <body>
		

<div class="wrapper d-flex align-items-stretch">
<!--THE NAV-->
        <?php $etudiant = $student->getStudent($_SESSION['CNE']); ?>
		<?php include("nav.php")?>

  <!-- Page Content  -->
  <div id="content" class="p-4 p-md-5">

  <!--THE SECOND NAV-->
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