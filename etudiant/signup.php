<?php
include("connexion.php");
session_start();
$result=$connect->prepare("SELECT * FROM etudiant WHERE CNE=? AND Date_Nais=?");
$result->execute([$_POST['CNE_signup'],$_POST['date_nais']]);
if($result->rowCount()>0){
    $result=$connect->prepare("SELECT * FROM etudiant WHERE CNE=? AND Date_Nais=? AND Role=?");
    $result->execute([$_POST['CNE_signup'],$_POST['date_nais'],'']);
    if($result->rowCount()>0){
        $rows=$result->fetch();
        $_SESSION['CNE2']=$rows['CNE'];
        echo json_encode("Nouveau");
    }
    else{            
        echo json_encode("Vous êtes déjà inscrit dans la plateforme");
    }
}
else{    
    echo json_encode("Le CNE ou date de naissance est incorrect");
}
?>