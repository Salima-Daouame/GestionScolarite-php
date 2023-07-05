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
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $etudient =intval($_POST['etudient_id']);
    $doc = $_FILES['doc']['name'];
    $path = "../documment/". $doc ;
    $target_file="../documments/".basename($doc);
    $docFileType=pathinfo($target_file,PATHINFO_EXTENSION);
    $allowed=array('pdf');
    $tmp_name = $_FILES['doc']['tmp_name'];
    $ext=pathinfo($doc, PATHINFO_EXTENSION);
    if(!in_array($ext,$allowed)) 
    {
        echo "Sorry, only pdf  files are allowed.";
    }
    else{
        move_uploaded_file( $tmp_name, $path);   
        var_dump($name,$doc,$etudient);
        $req11 = $db->prepare('insert into documments(nom,documment,etudient_id) values(?,?,?)');
        $result= $req11->execute([$name,$doc,$etudient]);
        if($result){
           
             header("location: /documment/list.php?msg=added");
        }
        else{
            var_dump('false result');
             header('location: /documment/add.php');
        } 
    } 






}
?>
<div class="container mt-5">
    <h4 class="text-center text-uppercase">ajouter documment</h4>
    <div class="row">
        <div class="col-md-6 col-xs-12 mx-auto card p-5 border-0 shadow  rounded">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name" class="text-uppercase">Nom</label>
                        <input type="text" class="form-control" name="name" id="name"  placeholder="name">
                    </div>
                   
                    <div class="form-group">
                        <label for="doc" class="text-uppercase">document</label>
                        <input type="file" class="form-control" name="doc" id="doc" >
                    </div>
                    
                        <div class="form-group">
                        <label for="etudient_id">etudient</label>
                        <select class="form-control" name="etudient_id" id="etudient_id">
                        <?php
                            $req = $db->query('select * from etudiant');
                            while($data =  $req->fetch()):
        ?>
                        
                        <option value="<?= $data['id'] ?>"><?= $data['Nom'] ?></option>
                            <?php endwhile; ?>
                        </select>
                        </div>
                    <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
    
</div>




<?php include '../include/footer.php'; ?>