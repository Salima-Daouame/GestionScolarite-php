<?php
require("../include/connexion.php");
$result=$db->query("SELECT * FROM class WHERE Code_Filiere='{$_POST['id']}'");
$class="";
while($row=$result->fetch()){
    $class.="<option value='{$row["Id_class"]}'>{$row["Id_class"]}</option>";
}
echo "<option selected disabled>Choisir la class :</option>".$class;
// echo json_encode($class);
?>