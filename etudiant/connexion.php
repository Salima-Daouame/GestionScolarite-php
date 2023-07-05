<?php
try{
    $connect = new PDO('mysql:host=localhost;dbname=pfe', 'root', '');
}
catch(PDOException $e){
echo $e->getMessage();
}
?>