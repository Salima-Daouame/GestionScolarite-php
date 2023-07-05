<?php
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
    function ajoutetudiantnotif($CNE,$NotifId){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('insert into etudiantnotif values (?,?)');
        $response->execute([$CNE,$NotifId]);
    }
     function getAdmin($module){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select Nom_Mat,coeffMat from matiere where Num_module=?');
        $response->execute([$module]);
        return $response;
    }
     function getSemestres(){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select * from semestre');
        $response->execute();
        return $response;
    }
    function getModule($semestre){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare('select Code_Sem from semestre where Code_Sem=?');
        $response->execute([$semestre]);
        $semestreId = $response->fetch();
        $response->closeCursor();
        $response = $db->prepare('select Nom_module from module where Code_Sem=?');
        $response->execute([$semestreId['Code_Sem']]);
        return $response;
    }
}

class student {
    function __construct(){}
    function getNotifications($id){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8;charset=utf8",'root','');
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
        // return "select Num_module from module where Id_class={$classe} AND Code_Sem=$semestre";
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
    function getdoc(){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $response = $db->prepare(' select * from document inner join dtype on document.id_type = dtype.id_type ');
        $response->execute();
        return $response;
    }
    function afficherdoc(){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        if(isset($_GET['id_doc'])){
            $id_doc = $_GET['id_doc'];
            $response = $db->prepare(' select * from document inner join dtype on document.id_type = dtype.id_type where id_doc=?');
            $response->bindParam(1, $id_doc);
            $response->execute();
            $data = $response->fetch();
            $file = 'document/'.$data['lien_doc'];

    if(file_exists($file)){
         header("Content-type: application/pdf");  
        header('Content-Length: '.filesize($file));
        readfile($file);
        exit;
    }
   
}
    }
    function telechargerdoc(){
              $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');

        if(isset($_GET['id_doc']))
   {
    $id_doc = $_GET['id_doc'];
    $stat = $db->prepare("SELECT * FROM document  INNER JOIN dtype on document.id_type = dtype.id_type WHERE id_doc=?");
    $stat->bindParam(1, $id_doc);
    $stat->execute();
    $data = $stat->fetch();

    $file = 'document/' .$data['lien_doc'];

    if(file_exists($file)){
        header('Content-Description: File Transfer');
        header('Content-Type:  '.$data['Nom_demmande']);
        header('Content-Disposition: attachement; lien_doc="'.basename($file).'"');
        header('Content-Length: '.filesize($file));
        readfile($file);
        exit;

    }
}
    }
    function demande($date,$etat,$cne,$id_type ){
     $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
      $requet = $db->prepare('INSERT INTO demmande(Date_demmande,Etat,CNE,Id_type) VALUES(?,?,?,?)');
      $requet->execute([$date,$etat,$cne,$id_type]);
     return $requet;

    }
    function reclamation($sujet,$reclamation,$date,$cne){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
        $requet = $db->prepare('INSERT INTO reclamation(Sujet,Reclamation,Date_reclamation,CNE) VALUES (?,?,?,?)');   
    $requet->execute([$sujet,$reclamation,$date,$cne]);
    return $requet;
 
    }
    function modifierProfil(){
     $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
    echo $_FILES['upload_img']['tmp_name'];
    if(empty($_FILES['upload_img']['tmp_name'])){        
        $result=$db->prepare("UPDATE etudiant SET N_tele=?, email=?,Addresse=? WHERE CNE=?;");
        $result->execute([$_POST['N_tele'],$_POST['email'],$_POST['Addresse'],$_SESSION['CNE']]);
    }
    else{
        $des = "assets/images/".$_SESSION['CNE'].".png";
        move_uploaded_file($_FILES['upload_img']['tmp_name'],$des);
        $result=$db->prepare("UPDATE etudiant SET Avatar=?, N_tele=?, email=? WHERE CNE=?;");
        $result->execute([$des,(int)$_POST['N_tele'],$_POST['email'],$_SESSION['CNE']]);
        
    }
    }
    function reinsc(){
        $db = new PDO('mysql:host=localhost;dbname=pfe','root','');   
        $result= $db->prepare("UPDATE etudiant SET N_tele=?, email=?, password=sha2(?,256), Addresse=? WHERE CNE=?");
        $result->execute([(int)$_POST['num_tele'],$_POST['mail'],$_POST['passw'],$_POST['adress'],$_SESSION['CNE']]); 
       return $result;
      
    }
    function inscription(){
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
     
        echo $_FILES['upload1_img']['tmp_name'];
        echo $_FILES['upload2_img']['tmp_name'];
  
        $des1="images/".$_SESSION['CNE']."Bac".".png";
        $des2="images/".$_SESSION['CNE']."Carte".".png";
    
        move_uploaded_file($_FILES['upload1_img']['tmp_name'],$des1);
        move_uploaded_file($_FILES['upload2_img']['tmp_name'],$des2);
        $result=$db->prepare("UPDATE etudiant SET  N_tele=?,email=?,Addresse=? Bac_scan= ? , Carte_scan=? WHERE CNE=?;");
        $result->execute([$_POST['tel'],$_POST['email'],$_POST['adresse'],$des1,$des2,$_SESSION['CNE']]);
        return $result;
   
    }
 }
?>