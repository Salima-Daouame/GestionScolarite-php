<?php
  include('db.php');
 $student = new student();
 
 // Pour recuperer les données de table ::
   
 if(isset($_POST['envoyer'])){
    
    $sujet =  $_POST['sujet'];
    $reclamation =  $_POST['reclamation'];
    $date = $_POST['date'];
    $cne =  $_POST['cne'];
    
     $reclamer = $student->reclamation($sujet,$reclamation,$date,$cne);
    $message_error="La reclamation est bien passé.";
    header('location:reclamation.php?msg_error='.$message_error);
    
 } 

?>