<?php
session_start();
require("../include/connexion.php");
require("../include/inactivity.php");
include('../../db.php');
$admin = new admin();
$date = date("Y-m-d");
$admin->updateNotification('4', $date);
$filieres = $admin->getFilieres();
while($filiere = $filieres->fetch()){
    $classes = $admin->getClasses($filiere['Nom_Filiere']);
    while($classe = $classes->fetch()){
        $etudiants = $admin->getStudents($classe['Id_class']);
        while($etudiant = $etudiants->fetch()){
            $absences = $admin->absencenonjustifier($etudiant['CNE']);
            if($absences >= 10){
                $admin->ajoutetudiantnotif($etudiant['CNE'],4);
            }
        }
    }
}
echo 'Les avertissements sont envoyé avec succés'
?>