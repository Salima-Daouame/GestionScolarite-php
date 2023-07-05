<?php
session_start();
$title= "Ajout un document";
$bo = "css/bootstrap.css";
$st = "css/style.css";
$jq = "js/jquery.js";
$bu = "js/bootstrap.bundle.js";
include('../../db.php');
require("../include/connexion.php");
require("../include/inactivity.php");
$admin = new admin();
$documentTypes = $admin->dtypes();
?>


<?php

if(isset($_POST['submit'])){
    $doc = $_FILES['doc']['name'];
    $idtype = $_POST['idtype'];
    $path = "../document/". $doc ;
    $target_file="../document/".basename($doc);
    $docFileType=pathinfo($target_file,PATHINFO_EXTENSION);
    $allowed = array('pdf');
    $tmp_name = $_FILES['doc']['tmp_name'];
    $ext=pathinfo($doc, PATHINFO_EXTENSION);
    if(!in_array($ext,$allowed)) 
    {
        echo "Sorry, only pdf  files are allowed.";
    }
    else
    {
        move_uploaded_file( $tmp_name, $path);
        $admin->insertDocument($doc,$idtype);
        header('location: ./list.php?msg=added');
    }
}
?>
<?php include '../include/header.php'; ?>
<?php include("../include/menu-h.php"); ?>

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container sidebar-closed sbar-open" id="container">

    <div class="overlay"></div>
    <div class="cs-overlay"></div>
    <div class="search-overlay"></div>

    <!--  BEGIN SIDEBAR  -->
    <?php include '../include/menu-v.php'; ?>
    <!--  END SIDEBAR  -->

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="page-header">
                <div class="page-title">
                    <h3>Ajouter Document</h3>
                </div>
            </div>

            <div class="row" id="cancel-row">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Formulaire</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="idtype">Type</label>
                                    <select class="form-control" name="idtype" id="idtype">
                                        <?php
                                            while($data1 = $documentTypes->fetch()):
                                        ?>
                                        <option value="<?= $data1['Id_type'] ?>"><?= $data1['Nom_demmande'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="form-group mb-4 mt-3">
                                    <label for="doc">Document</label>
                                    <input type="file" name="doc" class="form-control-file" id="doc">
                                </div>

                                <input type="submit" name="submit" class="mt-4 mb-4 btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  END CONTENT AREA  -->
</div>
<!-- END MAIN CONTAINER -->


<?php include '../include/footer.php'; ?>