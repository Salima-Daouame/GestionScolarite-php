<?php
session_start();
 include('db.php');
 $student = new student();
   
     if(isset($_POST['valider'])){ 
         $reinscrip = $student->reinsc();
       header('location:reinsc.php');
       $message_error="La réinscription est bien passé.";
    header('location:reinsc.php?msg_error='.$message_error);
      }

      
  ?>