<?php
session_start();
require("../include/connexion.php");
require("../include/inactivity.php");
if(!isset($_POST['CNE'])){
    header('location:absences.php');
    exit();
}
include('../../db.php');
$admin = new admin();
if($_POST['CNE'] == ''){
    echo 'Veillez selectioner le CNE';
    exit();
}
if($_POST['date'] == ''){
    echo 'Veillez selectioner une date';
    exit();
}
if($_POST['justification'] == ''){
    echo 'Veillez selectioner une justification';
    exit();
}
$admin->getStudentabsences($_POST['CNE'],$_POST['date'],$_POST['justification']);
echo "Absence d'etudiant ".$_POST['CNE']." est justifié avec succès\n Rafraîchir la page pour voir le changement";

?>