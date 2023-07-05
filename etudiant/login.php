<?php
include("db.php");
session_start();
$message='<br>';
if(isset($_SESSION["CNE"])){
  header("location: homepage.php");
  exit;
}
if(isset($_SESSION["CNE2"])){
    header("location: inscription.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecole Supérieure de Téchnologie Safi</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="js/jquery.min.js"></script>
</head>
<body>
<div class="alert hide">
                <span class="fas fa-exclamation-circle"></span>
                <span class="Notification">Warning: This is a warning alert!</span>
                <div class="close-btn">
                    <span class="fas fa-times"></span>
                </div>
            </div>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

<div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="signup.php" method="POST" onsubmit="return formSubmit();" id="idform">
                <h1 class="title">Create Account</h1>                
                <div class="field2">
                    <input onkeyup="CNE_check()" type="text" placeholder="Code Massar" id="CNE" name="CNE_signup" required>
                    <div class="icon29">
                        <span class="icon11 fas fa-exclamation"></span>
                        <span class="icon22 fas fa-check"></span>
                    </div>
                </div>
                <input type="date" placeholder="Date de naissance" name="date_nais" required>
                <button name="signup-btn" style="margin-top: 30px;" class="btn" id="Inscrire">Inscrire</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="login_auth.php" method="POST" onsubmit="return formSubmit2();" id="idform2">
                <h1>S'identifier</h1>
                <span style="padding-bottom: 50px;">ou <a href="#" style="font-size: 12px;text-decoration: underline;" id="signUp">créer votre compte</a></span>
                <div class="field">
                    <input onkeyup="CNE_check_login()" id="email" type="text" placeholder="Code Massar ex : D130xxxxxx" name="CNE_login" required>
                    <div class="icon">
                      <span class="icon1 fas fa-exclamation"></span>
                      <span class="icon2 fas fa-check"></span>
                    </div>
                </div>
                <div class="eye">
                    <input type="password" placeholder="Mot de passe" class="loginpassword" id="loginpassword" name="password" required>
                    <span class="login-hide"><i class="fa fa-eye"></i></span>
                </div>
                <a href="#" style="text-decoration: underline;">Mot de passe oublié?</a>
                <button name="login-btn">Connexion</button>
            </form>            

        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="title">Bienvenue sur la plateforme de ESTS</h1>
                    <!-- <p>Pour rester connecté avec nous, veuillez vous connecter avec vos informations personnelles</p> -->
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Bienvenue sur la plateforme de ESTS</h1>
                    <p>Vous pouver déposer votre candidature en-ligne sur cette plateforme. Une fois authentifié vous devez remplir un formulaire.</p>
                    <button class="ghost" id="signUp2">S'inscrire</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const signUpButton = document.getElementById('signUp');    
        const signUpButton2 = document.getElementById('signUp2');
        const signInButton = document.getElementById('signIn');        
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () =>
        container.classList.add('right-panel-active'));
        signUpButton2.addEventListener('click', () =>
        container.classList.add('right-panel-active'));

        signInButton.addEventListener('click', () =>
        container.classList.remove('right-panel-active'));
    </script>
    <script>
        const email = document.querySelector("#email");
        const cne = document.querySelector("#CNE");        
        const icon1 = document.querySelector(".icon1");
        const icon2 = document.querySelector(".icon2");
        const icon11 = document.querySelector(".icon11");
        const icon22 = document.querySelector(".icon22");
        let regExp = /^[a-zA-Z0-9]{10}$/;
        let regExp2 = /^[a-zA-Z0-9]{10}$/;
        function CNE_check_login(){
            if(email.value.match(regExp)){
            email.style.borderColor = "#27ae60";
            email.style.background = "#eafaf1";
            icon1.style.display = "none";
            icon2.style.display = "block";
            }else{
            email.style.borderColor = "#e74c3c";
            email.style.background = "#fceae9";
            icon1.style.display = "block";
            icon2.style.display = "none";
            }
            if(email.value == ""){
            email.style.borderColor = "lightgrey";
            email.style.background = "#fff";
            icon1.style.display = "none";
            icon2.style.display = "none";
            }
        }
        function CNE_check(){
            if(cne.value.match(regExp2)){
            cne.style.borderColor = "#27ae60";
            cne.style.background = "#eafaf1";
            icon11.style.display = "none";
            icon22.style.display = "block";
            }else{
            cne.style.borderColor = "#e74c3c";
            cne.style.background = "#fceae9";
            icon11.style.display = "block";
            icon22.style.display = "none";
            }
            if(cne.value == ""){
            cne.style.borderColor = "lightgrey";
            cne.style.background = "#fff";
            icon11.style.display = "none";
            icon22.style.display = "none";
            }
        }
    </script>
    <script>        
        const LoginPassword = document.querySelector(".loginpassword");
        const showBtnlogin = document.querySelector(".login-hide i");
        showBtnlogin.onclick = (()=>{
          if(LoginPassword.type === "password"){
            LoginPassword.type = "text";
            showBtnlogin.classList.add("hide-btn");
          }
          else{
            LoginPassword.type = "password";
            showBtnlogin.classList.remove("hide-btn");
          }
        });
        function formSubmit() {
            var reponse = $.ajax({
                type:'POST',
                url:'signup.php',
                async: false,
                dataType: 'JSON',
                data:$('#idform').serialize(),
                success:function(data){                    
                    $('.Notification').html(data);                                   
                }
            });
            if(reponse.responseJSON=="Nouveau"){
                var loc = window.location.pathname;
                var dir = loc.substring(0, loc.lastIndexOf('/'));                
                window.location.href = location.protocol + '//' + location.host+dir+"/inscription.php";
            }
            else{
                Notification();                
            }
            return false;
        }
        function formSubmit2() {
            var reponse = $.ajax({
                type:'POST',
                url:'login_auth.php',
                async: false,
                dataType: 'JSON',
                data:$('#idform2').serialize(),
                success:function(data){                    
                    $('.Notification').html(data);                    
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
    </script>
    <script>
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
</body>
</html>