<?php
 include('db.php');
 $student = new student();
 
 // Pour recuperer les données de table :: //  $etat =  $_POST['etat'];

 if(isset($_POST['envoyer'])){

    $date = $_POST['date'];
    $etat = $_POST['etat'];
    $cne =  $_POST['cne'];
    $id_type = $_POST['id_type'];
   $demander = $student->demande($date,$etat,$cne,$id_type );
   $message_error="La demande est bien passé.";
    header('location:demande.php?msg_error='.$message_error);
 } 
 
?>

