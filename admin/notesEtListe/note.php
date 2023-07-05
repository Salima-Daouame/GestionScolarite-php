<?php
     $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');

    if(isset($_POST['ajouter2']))   
  {  
    $DS= $_POST['DS'];
    $ds= $_POST['ds'];
     $Coeff_ds = $_POST['coeffds'];
    $Nom_Mat= $_POST['Code_Mat'];
    $CNE = $_POST['CNE'];
    $Examen= $_POST['Examen'];
    $examen= $_POST['examen'];
     $Coeff_examen = $_POST['coeffExam'];
     $TP= $_POST['TP'];
    $tp= $_POST['tp'];
     $Coeff_tp = $_POST['coefftp'];
     $Projet= $_POST['Projet'];
    $projet= $_POST['projet'];
     $Coeff_projet = $_POST['coeffprojet'];
       if (!empty($ds)){
   
    $requet = $db->prepare('INSERT INTO evaluation(Nom_eval,Coef_eval,Note_eval,Code_Mat,CNE) VALUES (?,?,?,?,?)');   
    $exec = $requet->execute([$DS,$Coeff_ds,$ds,$Nom_Mat,$CNE]);
  if($exec){
    header('location:tester.php');
  }else{
    echo "Échec de l'opération d'insertion";
  }
}
   if (!empty($examen)){
   
    $requet = $db->prepare('INSERT INTO evaluation(Nom_eval,Coef_eval,Note_eval,Code_Mat,CNE) VALUES (?,?,?,?,?)');   
    $exec = $requet->execute([$Examen,$Coeff_examen,$examen,$Nom_Mat,$CNE]);
  if($exec){
    header('location:tester.php');
  }else{
    echo "Échec de l'opération d'insertion";
  }
}
   if (!empty($tp)){
   
    $requet = $db->prepare('INSERT INTO evaluation(Nom_eval,Coef_eval,Note_eval,Code_Mat,CNE) VALUES (?,?,?,?,?)');   
    $exec = $requet->execute([$TP,$Coeff_tp,$tp,$Nom_Mat,$CNE]);
  if($exec){
    header('location:tester.php');
  }else{
    echo "Échec de l'opération d'insertion";
  }
}
   if (!empty($projet)){
   
    $requet = $db->prepare('INSERT INTO evaluation(Nom_eval,Coef_eval,Note_eval,Code_Mat,CNE) VALUES (?,?,?,?,?)');   
    $exec = $requet->execute([$Projet,$Coeff_projet,$projet,$Nom_Mat,$CNE]);
  if($exec){
    header('location:tester.php');
  }else{
    echo "Échec de l'opération d'insertion";
  }
}

}

?>

