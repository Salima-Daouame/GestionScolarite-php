<?php
session_start();
require("../include/connexion.php");
require("../include/inactivity.php");
include('../../db.php');
$admin = new admin();
$id = $_GET['id'];
$admin->deleteDocument($id);
header('location: ./list.php?msg=deleted');
?>