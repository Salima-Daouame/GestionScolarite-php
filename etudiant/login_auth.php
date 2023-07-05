<?php
include("connexion.php");
session_start();
$result=$connect->prepare("SELECT * FROM etudiant WHERE CNE=? AND password=sha2(?,256);");
$result->execute([$_POST['CNE_login'],$_POST['password']]);
if($result->rowCount()>0){
    $rows=$result->fetch();
    $_SESSION['CNE']=$rows['CNE'];
    echo json_encode("Successful");
}
else {
    echo json_encode("Le CNE ou le mot de passe est incorrect");
}
$result->closeCursor();  
?>