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






<h1 class="display-4">Liste des documments</h1>

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <?php if(isset($_GET['msg']) && $_GET['msg']=='added'): ?>
                    <div class="alert alert-success">Ajouter avec succes
                        <span class="close" data-dismiss="alert">&times;</span>
                    </div>
            <?php endif; ?>
            <?php if(isset($_GET['msg']) && $_GET['msg']=='updated'): ?>
                    <div class="alert alert-warning">Modifier avec succes
                        <span class="close" data-dismiss="alert">&times;</span>
                    </div>
            <?php endif; ?>
            <?php if(isset($_GET['msg']) && $_GET['msg']=='deleted'): ?>
                    <div class="alert alert-danger">Supprimer avec succes
                        <span class="close" data-dismiss="alert">&times;</span>
                    </div>
            <?php endif; ?>
        </div>
        <div class="col-md-8 mx-auto">
            <table class="table table-info table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>nom</th>
                        <th>document</th>
                        <th>etudiant</th>
                    </tr>
                </thead>
                <tbody>

                <?php 
                    $req = $db->query('select * from documments');
                    while($data =  $req->fetch()):
?>
                    <tr>
                        <td><?= $data['id'] ?></td>
                        <td><?= $data['nom'] ?></td>
                        <td><?= $data['documment'] ?></td>
                        <?php  
                        
                        $re = $db->query('select * from etudiant where id='.$data['etudient_id']);
                        $dat =  $re->fetch()
                        ?>
                        <td><?= $dat['Nom'] ?></td>
                        <td>
                            <a href="/documment/update.php?id=<?= $data['id'] ?>" class="btn btn-warning">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="/documment/delete.php?id=<?= $data['id'] ?>" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                           
                        </td>
                    </tr>
                    <?php endwhile; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>







<?php include '../include/footer.php'; ?>