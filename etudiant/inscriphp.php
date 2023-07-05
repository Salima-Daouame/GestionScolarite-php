<?php
session_start();
include('db.php');
$student = new student();
   
     if(isset($_POST['save'])){ 
         $inscri = $student->inscription();
       header('location:inscription2.php');
       $message_error="L'inscription est bien passé.";
    header('location:inscription2.php?msg_error='.$message_error);
  }
  ?>