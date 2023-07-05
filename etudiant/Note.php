<?php 
include 'include/connexion.php';
include('include/header.php');
if(!isset($_SESSION["CNE"])){
    header('location: login.php');
  }
$semm = 0;
//$id = $_GET['id'];
if(isset($_POST['semm'])){
   $semm=  $_POST['semaister'];
   header("Location: afficher.php?id_semestre=".$semm);
}
?>
<div class="wrapper d-flex align-items-stretch">
    <?php include('nav.php') ?>
    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">
        <?php //include('include/nav-h.php') ?>
        <?php include("header.php");?>
        <h2 class="mb-4">Note</h2>
        <div class="row">
            <div class="col-12">
                <form action="" method="post">
                    <input type="hidden" name="user_id" value="22">
                    <div class="form-group">
                        <label for="">Semestrer</label>
                        <select name="semaister" class="form-control w-25" id="semestre">
                            <?php
                                $sql =  'SELECT * FROM semestre';
                                foreach  ($db->query($sql) as $row){ 
                            ?>
                                <option value="<?php echo $row['Code_Sem'] ?>"><?php echo $row['Code_Sem'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button name="semm" class="btn btn-success">CHÈQUE</button>
                </form>
            </div>
<?php include('include/footer.php') ?>