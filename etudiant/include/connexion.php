<?php
try{
    $db = new PDO('mysql:host=127.0.0.1;dbname=pfe;charset=utf8','root','');
}catch(Exception $e){
    die('msg dyali'.$e->getMessage());
}
// class student {
//     function __construct(){}    
//     function getStudent($id){
//         $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
//         $response = $db->prepare('select * from etudiant where CNE=?');
//         $response->execute([$id]);
//         return $response->fetch();
//     }
// }
?>