<?php
include("connexion.php");
session_start();
if(!isset($_SESSION["CNE2"])){
    header("location: homepage.php");
    exit;
}
$result=$connect->prepare("SELECT * FROM etudiant WHERE CNE=?;");
$result->execute([$_SESSION['CNE2']]);
$row=$result->fetch();
function generate_password($chars) {
    $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($data), 0, $chars);
}
$password = generate_password(10);
if(isset($_POST['submit'])){
    echo $_FILES['upload_img']['tmp_name'];
    if(empty($_FILES['upload_img']['tmp_name'])){        
        $result=$connect->prepare("UPDATE etudiant SET email=?,password=sha2(?,256),Addresse=?,N_tele=?,Role='1ère année' WHERE CNE=?;");
        $result->execute([$_POST['email'],$password,$_POST['adresse'],(int)$_POST['tele'],$_SESSION['CNE2']]);
    }
    else{
      $des = "assets/images/".$_SESSION['CNE2'].".png";
        move_uploaded_file($_FILES['upload_img']['tmp_name'],$des);
        $result=$connect->prepare("UPDATE etudiant SET email=?,password=sha2(?,256),Addresse=?,N_tele=?,Role='1ère année',Avatar=? WHERE CNE=?;");
        $result->execute([$_POST['email'],$password,$_POST['adresse'],(int)$_POST['tele'],$des,$_SESSION['CNE2']]);
    }
    if($result){
        $to_email = $_POST['email'];
        $subject = "Mot de passe d'inscription dans ESTS";
        $to = $row['Nom']." ".$row['Prenom'];
        $body = "Vous avez bien inscrit dans École Supérieure de Technologie.\nVous pouvez maintenant accéder à votre espace étudiant, voici votre CNE et le mot de passe :\nCNE : {$_SESSION['CNE2']}\nLe mot de pass : {$password}\nCordialement.";
        $headers = "From: contact.ests@uca.ma";
        if (mail($to_email, $subject, $body, $headers)) {
            $_SESSION["CNE"]=$_SESSION['CNE2'];
            unset($_SESSION['CNE2']);
            header("Location: homepage.php");
            exit;
            
        } else {
            echo "L'envoi de l'e-mail a échoué ...";
        }
    }  
}

?>
<head>
  <title>Ecole Supérieure de Téchnologie Safi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- <script src="js/all.min.js"></script> -->
  <!-- <link rel="stylesheet" href="s.css"> -->
</head>
<style>
    label {
        margin-bottom: 0;
    }
    h4 {
        margin-top: 20px;
        margin-bottom: 5px;
    }
    .avatar {
        max-width: 250px;
        width: 100%;
    }
    .avatar img{
        object-fit: cover;
        height: 250px;
        width: 250px;
    }
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  font-family: 'Poppins', sans-serif;
}
.alert{
  background: #ffdb9b;
  padding: 20px 40px;
  min-width: 420px;
  position: absolute;
  right: 0;
  top: 10px;
  border-radius: 4px;
  border-left: 8px solid #ffa502;
  overflow: hidden;
  opacity: 0;
  pointer-events: none;
}
.alert.showAlert{
  opacity: 1;
  pointer-events: auto;
}
.alert.show{
  animation: show_slide 1s ease forwards;
}
@keyframes show_slide {
  0%{
    transform: translateX(100%);
  }
  40%{
    transform: translateX(-10%);
  }
  80%{
    transform: translateX(0%);
  }
  100%{
    transform: translateX(-10px);
  }
}
.alert.hide{
  animation: hide_slide 1s ease forwards;
}
@keyframes hide_slide {
  0%{
    transform: translateX(-10px);
  }
  40%{
    transform: translateX(0%);
  }
  80%{
    transform: translateX(-10%);
  }
  100%{
    transform: translateX(100%);
  }
}
.alert .fa-exclamation-circle{
  position: absolute;
  left: 20px;
  top: 50%;
  transform: translateY(-50%);
  color: #ce8500;
  font-size: 30px;
}
.alert .Notification{
  padding: 0 20px;
  font-size: 18px;
  color: #ce8500;
}
.alert .close-btn{
  position: absolute;
  right: 0px;
  top: 50%;
  transform: translateY(-50%);
  background: #ffd080;
  padding: 20px 18px;
  cursor: pointer;
}
.alert .close-btn:hover{
  background: #ffc766;
}
.alert .close-btn .fas{
  color: #ce8500;
  font-size: 22px;
  line-height: 40px;
}
</style>
<body>
<div class="alert hide" style="z-index: 1;">
        <span class="fas fa-exclamation-circle"></span>
        <span class="Notification">Warning: This is a warning alert!</span>
        <div class="close-btn">
            <span class="fas fa-times"></span>
        </div>
    </div>
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <div class="container bootstrap snippet" style="margin-top: 30px;">
    <div class="row">
  		<div class="col-sm-3"><!--left col-->
              
          <form class="form" action="" method="POST" id="registrationForm" enctype="multipart/form-data">
          
      <div class="text-center">
        <div class="avatar">
                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" id="avatar" alt="avatar">
        </div>
        <h3><?=$row['Nom']." ".$row['Prenom']?></h3>
        <input type="file" class="text-center center-block file-upload" id="upload_file" style="display: none;" name="upload_img">
      </div></hr><br>

               
          
          
        </div><!--/col-3-->
    	<div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home"><i class="fas fa-user-graduate"></i> Information Candidat</a></li>
                
                <li><a data-toggle="tab" href="#messages"><i class="fas fa-certificate"></i> Informations Baccalauréat</a></li>
              </ul>

              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <hr>
                  <!-- <form class="form" action="" method="POST" id="registrationForm"> -->
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="first_name"><h4>Nom :</h4></label>
                              <input type="text" class="form-control" name="first_name" id="first_name" value="<?=$row['Nom']?>" disabled>
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="last_name"><h4>Prénom :</h4></label>
                              <input type="text" class="form-control" name="last_name" id="last_name" value="<?=$row['Prenom']?>" disabled>
                          </div>
                      </div>
          
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="phone"><h4>Nom en arabe :</h4></label>
                              <input type="text" class="form-control" name="phone" id="phone" value="<?=$row['Prenom_AR']?>" disabled dir="rtl">
                          </div>
                      </div>
          
                      <div class="form-group">
                          <div class="col-xs-6">
                             <label for="mobile"><h4>Prénom en arabe :</h4></label>
                              <input type="text" class="form-control" name="mobile" id="mobile" value="<?=$row['Nom_AR']?>" disabled dir="rtl">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Date de naissance :</h4></label>
                              <input type="text" class="form-control" name="email" id="email" value="<?=$row['Date_Nais']?>" disabled>
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Lien de naissance en arabe :</h4></label>
                              <input type="text" class="form-control" id="location" value="<?=$row['Ville_Origine_AR']?>" disabled dir="rtl">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="password"><h4>Ville actuelle :</h4></label>
                              <input type="text" class="form-control" value="<?=$row['Ville_Actuelle']?>" disabled>
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label><h4>Adresse :</h4></label>
                              <input type="text" class="form-control" name="adresse" id="password2" placeholder="Entrer votre adresse" maxlength="100" required>
                          </div>
                      </div>
                      <div class="form-group">
                          
                        <div class="col-xs-6">
                            <label for="password"><h4>Email :</h4></label>
                            <input type="email" class="form-control" name="email" placeholder="Entrer votre email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        
                        <div class="col-xs-6">
                          <label><h4>Numéro de téléphone :</h4></label>
                            <input type="text" class="form-control" name="tele" id="" placeholder="Entrer votre n° téléphone" maxlength="10" required>
                        </div>
                    </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg btn-success" type="submit" name="submit">Soumettre</button>
                            </div>
                      </div>
              	<!-- </form> -->
                  </form>
              <hr>
              
             </div><!--/tab-pane-->
             <div class="tab-pane" id="messages">
               
               <h2></h2>
               
               <hr>
                  <form class="form" action="" method="POST">
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label><h4>Baccalauréat :</h4></label>
                              <input type="text" class="form-control" name="" id="" value="<?=$row['Bac_Filiere']?>" disabled>
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="last_name"><h4>Bac mention :</h4></label>
                            <input type="email" class="form-control" id="email" value="<?=$row['Bac_Mention']?>" disabled>
                          </div>
                      </div>
                                
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                          <label for="email"><h4>Année bac :</h4></label>
                              <input type="email" class="form-control" id="location" value="<?=$row['Bac_Annee']?>" disabled>
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="phone"><h4>Académie :</h4></label>
                            <input type="text" class="form-control" name="phone" id="phone" value="Inzegane-Ait Melloul" disabled>
                          </div>
                      </div>

                      <div class="form-group">
                          
                        <div class="col-xs-6">
                        <label for="mobile"><h4>Province :</h4></label>
                            <input type="text" class="form-control" name="mobile" id="mobile" value="Souss-Massa-Draa" disabled>
                        </div>
                    </div>    
                                            
              	</form>
               
             </div>
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
</body>
</html>
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
    function formSubmit() {
        var reponse = $.ajax({
                type:'POST',
                url:'inscription_auth.php',
                async: false,
                dataType: 'JSON',
                data:$('#registrationForm').serialize(),
                success:function(data){                    
                    $('.Notification').html(data);   
                    console.log("data is : " + data);
                }                
            });
            if(reponse.responseJSON=="Successful"){
                var loc = window.location.pathname;
                var dir = loc.substring(0, loc.lastIndexOf('/'));                
                window.location.href = location.protocol + '//' + location.host+dir+"/homepage.php";
            }
            else{
                Notification();                
            }
            return false;
    }
         function Notification(){
           $('.alert').addClass("show");
           $('.alert').removeClass("hide");
           $('.alert').addClass("showAlert");
           setTimeout(function(){
             $('.alert').removeClass("show");
             $('.alert').addClass("hide");
           },5000);
         }
         $('.close-btn').click(function(){
           $('.alert').removeClass("show");
           $('.alert').addClass("hide");
         });
</script>