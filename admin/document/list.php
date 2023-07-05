<?php
session_start();
require("../include/connexion.php");
require("../include/inactivity.php");
$title= "liste des document";
$bo = "css/bootstrap.css";
$st = "css/style.css";
$jq = "js/jquery.js";
$bu = "js/bootstrap.bundle.js";
include('../../db.php');
$admin = new admin();
include '../include/header.php'; 
include '../include/menu-h.php'; 
?>
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
                    <h3>Liste Document</h3>
                </div>
            </div>

            <div class="row" id="cancel-row">

                <div class="col-md-8 mx-auto">
                    <?php if(isset($_GET['msg']) && $_GET['msg']=='added'): ?>
                    <div class="alert alert-success">Ajouté avec succès
                        <span class="close" data-dismiss="alert">&times;</span>
                    </div>
                    <?php endif; ?>
                    <?php if(isset($_GET['msg']) && $_GET['msg']=='deleted'): ?>
                    <div class="alert alert-danger">Supprimé avec succès
                        <span class="close" data-dismiss="alert">&times;</span>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                    <!--     -->
                        
                        <div class="table-responsive mb-4 mt-4">
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>id_doc</th>
                                        <th>lien_doc</th>
                                        <th>id_type</th>
                                        <th class="no-content"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            $documents = $admin->documentsList();
                                            while($data =  $documents->fetch()):

                                    ?>
                                    <tr>
                                        <td><?php echo  $data['id_doc'] ?></td>
                                        <td><?= $data['lien_doc'] ?></td>
                                        <td><?= $data['id_type'] ?></td>
                                        <td>
                                            <!-- <a href="/document/update.php?id=<?=  $data['id'] ?>" class="btn btn-warning">
                                                <i class="fa fa-edit"></i>
                                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                  </a> -->
                                             <a href="./delete.php?id=<?= $data['id_doc'] ?>">
                                                  <svg width="30" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-x-circle table-cancel">
                                                    <circle cx="12" cy="12" r="10">
                                                    </circle>
                                                    <line x1="15" y1="9" x2="9" y2="15"></line>
                                                    <line x1="9" y1="9" x2="15" y2="15"></line>
                                                </svg>
                                            </a>

                                        </td>
                                    </tr>
                                    <?php endwhile; ?>





                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Document</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
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