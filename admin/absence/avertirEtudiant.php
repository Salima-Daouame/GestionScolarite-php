<?php
session_start();
require("../include/connexion.php");
require("../include/inactivity.php");
include('../../db.php');
$admin = new admin();
$date = date("Y-m-d");
$admin->updateNotification('4', $date);
$absences = $admin->absencenonjustifier($_POST['CNE']);
if($absences >= 10){
    $admin->ajoutetudiantnotif($_POST['CNE'],4);
    echo 'Avertissement envoyer à l\'etudiant '.$_POST['CNE'].' avec succées';
}
else echo 'L\'etudiant '.$_POST['CNE'].' n\'a pas un somme des heures non justifiées >= 10 ';
?>