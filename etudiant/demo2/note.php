<?php
$db = new PDO("mysql:host=localhost;dbname=pfe",'root','');
if(isset($_POST['ajouter']))
{
    $DS= $_POST['DS'];
    $ds= $_POST['ds'];
    $Nom_Mat= $_POST['Code_Mat'];
    $CNE= $_POST['ajouterN'];
	 $stat =$db->prepare('INSERT INTO evaluation (Nom_eval,Note_eval,Code_Mat,CNE) 
    VALUES (?,?,?,?)');
      $result=$stat->execute([$DS,$ds,$Nom_Mat,$CNE]);
      header('location:tester.php');
}
else{
  echo "string";
}
/*
$CNE= $_POST['ajouterN'];
    $ds= $_POST['ds'];
    $examen= $_POST['examen'];
    $tp= $_POST['tp'];
    $projet= $_POST['projet'];
    $Nom_Mat= $_POST['Code_Mat'];
    $DS= $_POST['DS'];
    $Examen= $_POST['Examen'];
    $Tp= $_POST['Tp'];
    $Projet= $_POST['Projet'];*/
?>

