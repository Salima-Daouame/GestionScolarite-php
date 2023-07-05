<?php  
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');
if(isset($_POST['modifier'])){
	$note_eval = $_POST['Note'];
	$id_eval = $_POST['id_eval'];

	$sql=$db->prepare("update evaluation set Note_eval = '$note_eval' where Id_eval =$id_eval");
	$result = $sql->execute();
	if($result){
		header('location: tester.php');
	}
	else{
		$message_error2="Echec de modification.";
     header('location:.php?msg_error2='.$message_error2);
	}
}
?>