<?php
session_start();
include('db.php');
$student = new student();
if(isset($_POST['modifier'])){
    $student = new student();
    $profil = $student->modifierProfil();
    header('location:profil.php');
}
?>
