<?php
$inactive = 60;
if(!isset($_SESSION['inactivity'])){
    $_SESSION['inactivity']=time();
}
$session_life = time() - $_SESSION['inactivity'];
if($session_life > $inactive){
    $_SESSION['last_url']=basename($_SERVER['PHP_SELF']);
    $_SESSION['last_url2']=$_SERVER['PHP_SELF'];
    $_SESSION['last_url3']=$_SERVER['HTTP_REFERER'];
    $_SESSION['last_url4']=basename($_SERVER['HTTP_REFERER']);
    $_SESSION["admin2"]=$_SESSION['admin'];
    unset($_SESSION['admin']);
    unset($_SESSION['inactivity']);
    
}
else{
    $_SESSION['inactivity']=time();
}
if(!isset($_SESSION["admin"])){
    header("location: ../auth_lockscreen.php");
    exit;
}
?>