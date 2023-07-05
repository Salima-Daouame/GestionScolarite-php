<?php
//Démarrer la session
session_start();
//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['id_compte']) || (trim($_SESSION['id_compte']) == '')) {
    header("location: index.php");
    exit();
}
$session_id=$_SESSION['id_compte'];

?>