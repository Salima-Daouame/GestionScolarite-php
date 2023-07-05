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
     <link rel="stylesheet" href="style/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

  </head>
  <body>
		
	<div class="wrapper d-flex align-items-stretch">
    <?php include('nav.php') ?>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

      <?php include('header.php') ?>
<div class="container bootstrap snippets bootdey">
<form action="modifierProfil2.php" method="POST" enctype="multipart/form-data" >
<div class="row">
  <div class="profile-nav col-md-3">
      <div class="panel">
          <div class="user-heading round">
          	    <div class="avatar">
               <img src="<?=$etudiant['Avatar']?>" class="avatar img-circle img-thumbnail" id="avatar" alt="avatar">
                </div>
                <h1><?php echo $etudiant['CNE'] ?></h1>
                <h4><?php echo $etudiant['Nom'] ?>  <?php echo $etudiant['Prenom']?></h4>
                <input type="file" class="text-center center-block file-upload" id="upload_file" style="display: none;" name="upload_img">
			</div>

          <ul class="nav nav-pills nav-stacked">
              <li ><a href="profil.php"> <i class="fa fa-user"></i> Profil</a></li>
              <li class="active"><a href="modifierProfil.php"> <i class="fa fa-edit"></i>Modifier profil</a></li>

          </ul>
      </div>

  </div>
  <div class="profile-info col-md-9">
      <div class="panel">
          <div class="panel-body bio-graph-info">
          	<?php 
		if(isset($_GET['msg_error2']) && !empty(($_GET['msg_error2']))){

			echo "<h3 style='color:red'>".$_GET['msg_error2']."</h3>";

		}
        ?>

              <h1 style=" margin-top:-30px; font-size:40px; margin-left:140px ; font-family: 'New Century Schoolbook', 'TeX Gyre Schola', 'serif'">Votre profil</h1>
              <div class="row">
                  <div class="bio-row">
                      <p><span>CNE</span><input type="text" id="CNE" name="CNE" value="<?php echo $etudiant['CNE'] ?>" disabled style="background-color: #e9ecef;"> </p>
                  </div>
                  <div class="bio-row" >
                      <p><span>CNI</span><input type="text" id="CNI" name="CNI" value="<?php echo $etudiant['CNI'] ?>" disabled style="background-color: #e9ecef;"> </p>
                  </div>
                  <div class="bio-row">
                      <p><span>Nom</span><input type="text" id="Nom" name="Nom" value="<?php echo $etudiant['Nom']?>"disabled style="background-color: #e9ecef;"></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Prénom</span><input type="text" id="Prenom" name="Prenom" value="<?php echo $etudiant['Prenom']?>" disabled style="background-color: #e9ecef;"> </p>
                  </div>
                  <div class="bio-row">
                      <p><span>Adresse </span><input type="text" id="Addresse" name="Addresse" value="<?php echo $etudiant['Addresse']?>"></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Classe </span><input type="text" id="Id_class" name="Id_class" value="<?php echo $etudiant['Id_class']?>" disabled style="background-color: #e9ecef;"> </p>
                  </div>
                  <div class="bio-row">
                      <p><span>Télèphone </span><input type="text" id="N_tele" name="N_tele" value="<?php echo $etudiant['N_tele']?>"> </p>
                  </div>
                  <div class="bio-row">
                       <p><span>Email </span><input type="text" id="email" name="email" value="<?php echo $etudiant['email']?>"> </p>
                  </div>
                   <div class="bio-row">
                       <p><span>Role </span><input type="text" id="Role" name="Role" value="<?php echo $etudiant['Role']?>" disabled style="background-color: #e9ecef;"> </p>
                  </div>
                   <div class="bio-row">
                       <span>Date de naissance</span><input type="text" disabled value="<?php echo $etudiant['Date_Nais']?>"  style="background-color: #e9ecef;">
                  </div>
              <input type="submit" class="button" title="modifier" name="modifier" value="Mettre à jour" style="background: #fbc02d;">

              </div>
          </div>
      </div>
     </div>
    </div>
   </form>
   </div>
 </div>
 </div>
<script  src="assets/scripts.js"></script>

<style type="text/css">

.profile-nav, .profile-info{
    margin-top:30px;   
}

.profile-nav .user-heading {
    background: #fbc02d;
    color: #fff;
    border-radius: 4px 4px 0 0;
    -webkit-border-radius: 4px 4px 0 0;
    padding: 30px;
    text-align: center;
    margin-top:-70px;
    margin-bottom:10px;
    height: 230px;
}

.profile-nav .user-heading.round img  {
    border-radius: 50%;
    -webkit-border-radius: 50%;    
    display: inline-block;
}

.profile-nav .user-heading  img {
    width: 112px;
    height: 112px;
    border-radius: 50%;
    -webkit-border-radius: 50%;
}

.profile-nav .user-heading h1 {
    font-size: 22px;
    font-weight: 300;
    margin-bottom: 5px;
    margin-top:29px;
}

.profile-nav .user-heading p {
    font-size: 12px;
}

.profile-nav ul {
    margin-top: 1px;
}

.profile-nav ul > li {
    border-bottom: 1px solid #ebeae6;
    margin-top: 0;
    line-height: 30px;
}

.profile-nav ul > li:last-child {
    border-bottom: none;
}

.profile-nav ul > li > a {
    border-radius: 0;
    -webkit-border-radius: 0;
    color: #89817f;
    border-left: 5px solid #fff;
}

.profile-nav ul > li > a:hover, .profile-nav ul > li > a:focus, .profile-nav ul li.active  a {
    background: #f8f7f5 !important;
    border-left: 5px solid #fbc02d;
    color: #89817f !important;
}

.profile-nav ul > li:last-child > a:last-child {
    border-radius: 0 0 4px 4px;
    -webkit-border-radius: 0 0 4px 4px;
}

.profile-nav ul > li > a > i{
    font-size: 16px;
    padding-right: 10px;
    color: #bcb3aa;
}

.r-activity {
    margin: 6px 0 0;
    font-size: 12px;
}


.p-text-area, .p-text-area:focus {
    border: none;
    font-weight: 300;
    box-shadow: none;
    color: #c3c3c3;
    font-size: 16px;
}


.bio-graph-heading {
    background: #fbc02d;
    color: #fff;
    text-align: center;
    font-style: italic;
    padding: 40px 110px;
    border-radius: 4px 4px 0 0;
    -webkit-border-radius: 4px 4px 0 0;
    font-size: 16px;
    font-weight: 300;
}

.bio-graph-info {
    color: #89817e;
}

.bio-graph-info h1 {
    font-size: 22px;
    font-weight: 300;
    margin: 0 0 20px;
}

.bio-row {
    width: 50%;
    float: left;
    margin-bottom: 10px;
    padding:0 15px;
}

.bio-row p span {
    width: 100px;
    display: inline-block;
}

label{
	color: white;
    position: absolute;
    font-size:18px;
    display: flex;
   
}
.material-icons{
	margin-left:-14px;


}
h1{
  margin-top:-4px;
}
h4{
  margin-top: -12px;
}
 .avatar {
        max-width: 250px;
        width: 100%;
        height:110px;
        margin-bottom:-19px; 
    }
    .avatar img{
        object-fit: cover;
        height: 100%;
        width: 250px;
    }
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

</style>
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
    $("#avatar").click(function() {
        $("#upload_file").click();
    });
</script>
</body>
</html>