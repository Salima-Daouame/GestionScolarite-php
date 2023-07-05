<?php  
        $db = new PDO("mysql:host=localhost;dbname=pfe;charset=utf8",'root','');

if(isset($_GET['id'])){

	$sup = $_GET['id'];

	$sql = $db->prepare("DELETE FROM evaluation WHERE Id_eval= '$sup'");
   $result = $sql->execute();
   if ($result) {
   	  header("Location: ./tester.php?success=successfully deleted");
   }else {
      header("Location: ./tester.php?error=unknown error occurred&$user_data");
   }

}else {
	header("Location: ./tester.php");
}