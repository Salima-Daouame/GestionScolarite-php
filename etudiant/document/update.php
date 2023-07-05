<?php
$title= "Liste des documment";
$fa = "../css/all.css";
$bo = "../css/bootstrap.css";
$st = "../css/style.css";
$jq = "../js/jquery.js";
$bu = "../js/bootstrap.bundle.js";
?>
<?php require '../include/sess.php'; ?>
<?php require '../include/connexion.php'; ?>
<?php include '../include/header.php'; ?>
<?php include '../include/menu.php'; ?>


<?php
$id = $_GET['id'];
 $reqq = $db->query('select * from documments where id='.$id);
 $dataa =  $reqq->fetch();
 $doc= $dataa['documment'];
 echo $doc;
if(isset($_POST['update'])){
    $name = $_POST['name'];
    $etudient =intval($_POST['etudient_id']);
    if($_FILES['doc']['name']!==''){

    $doc = $_FILES['doc']['name'];
    $path = "../documment/". $doc ;
    $target_file="../documments/".basename($doc);
    $docFileType=pathinfo($target_file,PATHINFO_EXTENSION);
    $allowed=array('pdf');
    $tmp_name = $_FILES['doc']['tmp_name'];
    $ext=pathinfo($doc, PATHINFO_EXTENSION);
    move_uploaded_file( $tmp_name, $path);   
    var_dump($name,$doc,$etudient);
    }

    
        $req11 = $db->prepare('update documments set nom=? , documment=? , etudient_id=? where id=? ');
        $result= $req11->execute([$name,$doc,$etudient,$id]);
        if($result){
            var_dump('true result');
           
             header("location: /documment/list.php?msg=updated");
        }
        else{
            var_dump('false result');
             header('location: /documment/update.php');
        } 
}

?>
<div class="container mt-5">
    <h4 class="text-center text-uppercase">update documment</h4>
    <div class="row">
        <div class="col-md-6 col-xs-12 mx-auto card p-5 border-0 shadow  rounded">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name" class="text-uppercase">name</label>
                        <input type="text" class="form-control" name="name" value="<?= $dataa['nom'] ?>" id="name"  placeholder="name">
                    </div>
                   
                    <div class="form-group">
                        <label for="doc" class="text-uppercase">doc</label>
                        <input  type="file"  class="form-control" name="doc" id="doc" >
                        <span><?=  $dataa['documment'] ?></span>
                    </div>
                    
                        <div class="form-group">
                        <label for="etudient_id">etudient</label>
                        <select class="form-control" name="etudient_id" id="etudient_id">
                        <?php
                            $req = $db->query('select * from etudiant');
                            while($data =  $req->fetch()):
        ?>
                        
                        <option value="<?= $data['id'] ?>" <?php if($data['id']==$dataa['etudient_id']){ echo'selected';}  ?> >
                            <?= $data['Nom'] ?>
                        </option>
                            <?php endwhile; ?>
                        </select>
                        </div>
                    <button type="submit" name="update" class="btn btn-warning">modifier</button>
            </form>
        </div>
    </div>
    
</div>




<?php include '../include/footer.php'; ?>