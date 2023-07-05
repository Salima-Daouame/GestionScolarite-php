<?php
require("../include/connexion.php");
$result=$db->prepare("UPDATE demmande SET Date_demmande=Date_demmande,Etat='Traite' WHERE Id_demmande=?;");
$result->execute([$_POST['Id_demmande']]);
?>