<?php
session_start();
include('../../db.php');
$admin = new admin();
if($_POST['matiere'] == ''){
    echo 'Veillez selectioner une matiere';
    exit();
}
if($_POST['date'] == ''){
    echo 'Entrez le champ date';
    exit();
}
if(isset($_POST['studentsNumber'])){
    for($i = 0; $i < $_POST['studentsNumber']; $i++){
        if(isset($_POST['checkbox'][$i]) && $_POST['nbheures'][$i] != 0){
            $admin->AjoutAbsence($_POST['CNE'][$i],$_POST['matiere'],$_POST['date'],$_POST['nbheures'][$i]);
        }
    }
    unset($_SESSION['filiere']);
    unset($_SESSION['classe']);
}
?>