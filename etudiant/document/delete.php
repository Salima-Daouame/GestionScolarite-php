<?php
include '../include/connexion.php';
$id = $_GET['id'];
$req = $db->prepare('delete from documments where id=?');
$req->execute([$id]);
header('location: /documment/list.php?msg=deleted');