<?php
include("include/connexion.php");
session_start();
$message="<br>";
if(isset($_SESSION["admin"])){
    header("location: inbox/reclamation.php");
    exit;
}
if(isset($_POST['submit'])){
    $username = $_POST['email'];
    $pass = $_POST['pass'];
    $result=$db->prepare("SELECT * FROM admin WHERE username=? AND password=sha2(?,256);");
    $result->execute([$username,$pass]);
    if($result->rowCount()>0){
        $_SESSION['admin']=$username;
        header('location: inbox/reclamation.php');
    }
    else {
        $message="Le nom d'utilisateur ou le mot de passe est inccorect";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <title>Ecole Supérieure de Téchnologie Safi</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/authentication/form-1.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
        <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
    </head>
    <body class="form">
        <div class="form-container">
            <div class="form-form">
                <div class="form-form-wrap">
                    <div class="form-container">
                        <div class="form-content">
                            <h1 class="">CONNECTION A <a href="index.html"><span class="brand-name">GS-ESTS</span></a></h1>
                            <p style="color: red;"><?=$message;?></p>
                            <div class="text-left">
                                <form action="auth_login.php" method="POST">
                                    <div class="form">
                                        <div id="username-field" class="field-wrapper input">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                            <input type="text" name="email" class="form-control" placeholder="Username">
                                        </div>
                                        <div id="password-field" class="field-wrapper input mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                            <input  type="password" name="pass" class="form-control" placeholder="Password">
                                        </div>
                                        <div class="d-sm-flex justify-content-between">
                                            <div class="field-wrapper toggle-pass">
                                                <p class="d-inline-block">Afficher le mot de pass</p>
                                                <label class="switch s-primary">
                                                    <input type="checkbox" id="toggle-password" class="d-none">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                            <div class="field-wrapper">
                                                <button  type="submit" name="submit" class="btn btn-primary" value="">Connection</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="field-wrapper text-center keep-logged-in">
                                        <div class="n-chk new-checkbox checkbox-outline-primary">
                                            <label class="new-control new-checkbox checkbox-outline-primary">
                                            <input type="checkbox" class="new-control-input">
                                            <span class="new-control-indicator"></span>Rester connecté
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="field-wrapper">
                                        <a href="auth_pass_recovery.html" class="forgot-pass-link">Mot de pass oublie?</a>
                                    </div>
                                </form>
                            </div>
                            <p class="terms-conditions">© 2021 All Rights Reserved. <a href="http://www.ests.uca.ma/">ESTS</a> L'école Supérieure de Technologie de Safi.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-image">
                <div class="l-image"></div>
            </div>
        </div>
    </body>
</html>