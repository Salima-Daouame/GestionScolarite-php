<?php

class student {
    function __construct(){}
    function getNotifications($id){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8;charset=utf8",'root','');
        $response = $db->prepare('select * from etudiantnotif where CNE=? ORDER BY Id_notification DESC');
        $response->execute([$id]);
        return $response;
    }
    
   
    function getStudent($id){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select * from etudiant where CNE=?');
        $response->execute([$id]);
        return $response->fetch();
    }

    }
    
class admin {
    
    function __construct(){}
    function getFilieres(){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select * from filiere');
        $response->execute();
        return $response;
    }
    function getClasses($filiere){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select Code_Filiere from filiere where Nom_Filiere=?');
        $response->execute([$filiere]);
        $filiereId = $response->fetch();
        $response->closeCursor();
        $response = $db->prepare('select Id_class from class where Code_Filiere=?');
        $response->execute([$filiereId['Code_Filiere']]);
        return $response;
    }
    
    function getStudents($classe){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select CNE,CNI,Nom,Prenom,Date_Nais,N_tele,email,Id_class from etudiant where Id_class=?');
        $response->execute([$classe]);
        return $response;
    }
    
   
}

?>