<?php
session_start();
require("include/connexion.php");
if(!isset($_SESSION["admin2"])){
    header("location: auth_login.php");
    exit;
}
$message='<br>';
if(isset($_POST['submit'])){
    $pass = $_POST['pass'];
    $result=$db->prepare("SELECT * FROM admin WHERE username=? AND password=sha2(?,256);");
    $result->execute([$_SESSION["admin2"],$pass]);
    if($result->rowCount()>0){
        $_SESSION['admin']=$_SESSION["admin2"];
        // header("location: {$_SESSION['last_url']}");
        $redirc="http://".$_SERVER['HTTP_HOST'].$_SESSION['last_url2'];
        header("location: {$redirc}");
        // echo "<script>window.history.go(-2)</script>";
        // echo "<script>window.history.back(-2)</script>";
    }
    else {
        $message="Le mot de passe est inccorect";
        // $message="http://".$_SERVER['HTTP_HOST'].$_SESSION['last_url2'];
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
                            <div class="d-flex user-meta">
                                <img src="assets/img/90x90.jpg" class="usr-profile" alt="avatar">
                                <div class="">
                                    <p class="">MR EL NAFAA</p>
                                </div>                                
                            </div>                            
                            <p style="color: red;"><?=$message;?></p>
                            <form class="text-left" action="auth_lockscreen.php" method="POST">
                                    <div class="form">
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
                                            <button type="submit" name="submit" class="btn btn-primary" value="">Ouvrir</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>                
                            <p class="terms-conditions">© 2021 All Rights Reserved. <a href="http://www.ests.uca.ma/">ESTS</a> L'école Supérieure de Technologie de Safi.</p>
                        </div>                    
                    </div>
                </div>
            </div>
            <div class="form-image">
                <div class="l-image">
                </div>
            </div>
        </div>        
        <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
        <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
        <script src="bootstrap/js/popper.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- END GLOBAL MANDATORY SCRIPTS -->
        <script src="assets/js/authentication/form-1.js"></script>
    </body>
</html>