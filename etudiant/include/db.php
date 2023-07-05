<?php
$db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
class student {
    function __construct(){}
    function getNotifications($id){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select * from etudiantnotif where CNE=? ORDER BY Id_notification DESC');
        $response->execute([$id]);
        return $response;
    }
    function notifCount($id){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select count(`id_notification`) from etudiantnotif where CNE=?');
        $response->execute([$id]);
        return $response->fetch();
    }
    function getNotification($id){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select * from notification where Id_notification=?');
        $response->execute([$id]);
        return $response->fetch();
    }
    function getStudent($id){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select * from etudiant where CNE=?');
        $response->execute([$id]);
        return $response->fetch();
    }
    function getModules($classe,$semestre){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select Num_module from module where Id_class=? AND Code_Sem=?');
        $response->execute([$classe,$semestre]);
        return $response;
    }
    function getSemestres(){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select * from semestre');
        $response->execute();
        return $response;
    }
    function getMatieres($module){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select * from matiere where Num_module=?');
        $response->execute([$module]);
        return $response;
    }
    function getAbsences($CNE){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select * from absence where CNE=? order by Date_absence');
        $response->execute([$CNE]);
        return $response;
    }
    function getMatiere($idMat){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select Nom_Mat from matiere where Code_Mat=?');
        $response->execute([$idMat]);
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
    function getModules($classe){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select Num_module from module where Id_class=?');
        $response->execute([$classe]);
        return $response;
    }
    function getMatieres($module){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select * from matiere where Num_module=?');
        $response->execute([$module]);
        return $response;
    }
    function getStudents($classe){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select CNE,Nom,Prenom from etudiant where Id_class=?');
        $response->execute([$classe]);
        return $response;
    }
    function AjoutAbsence($CNE,$matiere,$Date_absence,$nbheures){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select Code_Mat from matiere where Nom_Mat=?');
        $response->execute([$matiere]);
        $Code_mat = $response->fetch();
        $response->closeCursor();
        $response = $db->prepare('insert into absence values (?,?,?,?,?)');
        $response->execute([$CNE,$Code_mat[0],$Date_absence,$nbheures,'']);
    }
    function matiereheures($CNE,$matiere,$date){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select Code_Mat from matiere where Nom_Mat=?');
        $response->execute([$matiere]);
        $Code_mat = $response->fetch();
        $response->closeCursor();
        $response = $db->prepare('select SUM(`Nombre_heures`) from absence where CNE=? AND `Code_Mat`=? AND `Date_absence`=?');
        $response->execute([$CNE,$Code_mat[0],$date]);
        $res['count'] = $response->fetch()[0];
        $res['justificationStatus'] = 'Non Justifié';
        $response->closeCursor();
        $response = $db->prepare('select Justification from absence where CNE=? AND `Date_absence`=?');
        $response->execute([$CNE,$date]);
        while($resp = $response->fetch()){
            if($resp[0] != '') {
                $res['justificationStatus'] = 'Justifié';
                $res['justification'] = $resp[0];
            }
        }
        return $res;
    }
    function matiereheuresTout($CNE,$matiere){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select Code_Mat from matiere where Nom_Mat=?');
        $response->execute([$matiere]);
        $Code_mat = $response->fetch();
        $response->closeCursor();
        $response = $db->prepare('select SUM(`Nombre_heures`) from absence where CNE=? AND `Code_Mat`=? AND Justification=?');
        $response->execute([$CNE,$Code_mat[0],'']);
        return $response->fetch()[0];
    }
    function getStudentabsences($CNE,$date,$justification){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('update absence set Justification=? where CNE=? AND Date_absence=?');
        $response->execute([$justification,$CNE,$date]);
    }
    function studentExists($CNE,$date){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select CNE from absence where CNE=? AND Date_absence=?');
        $response->execute([$CNE,$date]);
        return $response->fetch();
    }
    function absencenonjustifier($CNE){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare("select SUM(Nombre_heures) from absence where CNE=? AND Justification=''");
        $response->execute([$CNE]);
        return $response->fetch()[0];
    }
    function updateNotification($id,$date){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('update notification set `Date_notification`=? where Id_notification=?');
        $response->execute([$date,$id]);
    }
    function ajoutetudiantnotif($CNE,$NotifId){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('insert into etudiantnotif values (?,?)');
        $response->execute([$CNE,$NotifId]);
    }
    function getSemMatieres($semestre){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select matiere.Code_Mat,matiere.Nom_Mat from module join matiere on module.Num_module=matiere.Num_module where Code_Sem=?');
        $response->execute([$semestre]);
        return $response;
    }
    function insertDocument($doc,$idtype){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('insert into document(lien_doc,id_type) values(?,?)');
        $response->execute([$doc,$idtype]);
    }
    function deleteDocument($id){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('delete from document where id_doc=?');
        $response->execute([$id]);
    }
    function dtypes(){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select * from dtype');
        $response->execute();
        return $response;
    }
    function documentsList(){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select * from document');
        $response->execute();
        return $response;
    }
    function reclamation(){
        
    }
}

?>