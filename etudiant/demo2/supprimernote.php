<?php  

if(isset($_GET['id'])){
   include "db.php";
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}

	$Nom_eval = validate($_GET['id']);

	$sql = "DELETE FROM compte
	        WHERE id=$id_compte";
   $result = mysqli_query($conn, $sql);
   if ($result) {
   	  header("Location: ../read.php?success=successfully deleted");
   }else {
      header("Location: ../read.php?error=unknown error occurred&$user_data");
   }

}else {
	header("Location: ../read.php");
}