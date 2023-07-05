<?php
require("connexion.php");
session_start();
$result=$connect->prepare("SELECT * FROM etudiant WHERE CNE=?;");
$result->execute([$_SESSION['CNE2']]);
$row=$result->fetch();
function generate_password($chars) {
    $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($data), 0, $chars);
}
$password = generate_password(10);
$res=$connect->prepare("SELECT * FROM etudiant WHERE email=?;");
$res->execute([$_POST['email']]);
if($res->rowCount()>0){
    echo json_encode("Ce email est déja utilisée !");
}
else{
    if(empty($_FILES['upload_img']['tmp_name'])){        
        $result=$connect->prepare("UPDATE etudiant SET email=?,password=sha2(?,256),Addresse=?,N_tele=?,Role='1ère année' WHERE CNE=?;");
        $result->execute([$_POST['email'],$password,$_POST['adresse'],(int)$_POST['tele'],$_SESSION['CNE2']]);
    }    
    else{
        $des = "image/avatar/".$_SESSION['CNE2'].".png";
        move_uploaded_file($_FILES['upload_img']['tmp_name'],$des);
        $result=$connect->prepare("UPDATE etudiant SET email=?,password=sha2(?,256),Addresse=?,N_tele=?,Role='1ère année',Avatar=? WHERE CNE=?;");
        $result->execute([$_POST['email'],$password,$_POST['adresse'],(int)$_POST['tele'],$des,$_SESSION['CNE2']]);
    }
    if($result){
        $to_email = $_POST['email'];        
        $subject = "Mot de passe d'inscription dans ESTS";
        $to = $row['Nom']." ".$row['Prenom'];
        // $body = "Bonjour {$to},\nVotre code d'activation est : {$password}\nCordialement.";
        $body = "Vous avez bien inscrit dans École Supérieure de Technologie.\nVous pouvez maintenant accéder à votre espace étudiant, voici votre CNE et le mot de passe :\nCNE : {$_SESSION['CNE2']}\nLe mot de pass : {$password}\nCordialement.";
        $headers = "From: oussama.test3500@gmail.com";
        if (mail($to_email, $subject, $body, $headers)) {
            $_SESSION["CNE"]=$_SESSION['CNE2'];
            unset($_SESSION['CNE2']);
            echo json_encode("Successful");
        }
        else {
            echo json_encode("L'envoi de l'e-mail a échoué ...");
        }
    }
}
?>