<?php include 'include/connexion.php'; ?>
<?php include('include/header.php') ?>

<div class="wrapper d-flex align-items-stretch">
    <?php include('nav.php') ?>
    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">
        <?php include("header.php")?>
        <h2 class="mb-4">Note</h2>
        <div class="row">

            <?php
                    $code_sem1 = $_GET['id_semestre'];
                    $sql_module =  "SELECT * FROM module WHERE Code_Sem= $code_sem1";
                    $nbr_module=0;
                    $total_sem=0;
                    foreach($db->query($sql_module) as $row) { 
                        $note_module=0;
                        $nbr_module++;
                        $tot_matier_sur_nbr_matier=0;
                        // echo $nbr_module.' nbr des modules';
            ?>
            <div class="col-12 ">
                <div class="row my-3 border bg-dark">
                    <?php  
                    $nbr_matier=0;
                    $sql_matiere =  "SELECT * FROM matiere WHERE Num_module=".$row['Num_module'].""; 
                    foreach  ($db->query($sql_matiere) as $row1) {
                        $total_matier=0;
                        $note_matier=0;
                       
                        
                        
                        ?>

                    <div class="col-6">
                        <div class="card my-2">
                            <div class="card-body">
                                <h4 class=" card-header text-center"><?php echo $row1['Nom_Mat'] ?></h4>
                                <table class="table table-hover">
                                    <tr>
                                        <th>évaluation </th>
                                        <th>Coef</th>
                                        <th>Note</th>
                                    </tr>
                                    <?php
                                        $code_mat = $row1['Code_Mat'];
                                        $sql_eval =  "SELECT * FROM evaluation WHERE CNE='{$_SESSION['CNE']}' AND Code_Mat=$code_mat";
                                        foreach  ($db->query($sql_eval) as $row3) {
                                            $note_matier += $row3['Coef_eval']*$row3['Note_eval']; 
                                            ?>
                                    <tr>
                                        <td><?php echo $row3['Nom_eval'] ?></td>
                                        <td><?php echo $row3['Coef_eval'] ?></td>
                                        <td><?php echo $row3['Note_eval'] ?></td>
                                    </tr>
                                    <?php $total_matier= $note_matier;
                                    if($note_matier!=0){
                                        $nbr_matier++;
                                    }    
                                }     
                                    ?>
                                </table>
                                <p><span><strong>Coef :</strong> <?php echo $row1['coeffMat']; ?></span></p>
                                <p><span><strong>Note Matière:</strong> <?php  echo $total_matier; ?> </span></p>
                            </div>
                        </div>
                    </div>
                    <?php $note_module+=$total_matier*$row1['coeffMat'];}
                    // echo $nbr_matier ."nbr matier <br>";
                    // echo $note_module ."note module <br>";
                                            // echo $total_matier.'total matier<br>';
                              $total_sem+=$note_module;
                                                                         
                                            if($note_module>=12){

                                                echo '<p class="bg-light p-3 w-100 text-center mx-2 shadow text-capitalize font-weight-bold text-success">Note module  : '. $note_module.' Validé</p>';
                                            }if($note_module<12 && $note_module>=6){
                                                echo '<p class="bg-light p-3 w-100 text-center mx-2 shadow text-capitalize font-weight-bold text-danger">Note module  : '. $note_module.' Rattrapage</p>';
                                            }
                                            if($note_module<6){
                                                echo '<p class="bg-light p-3 w-100 text-center mx-2 shadow text-capitalize font-weight-bold text-danger">Note module  : '. $note_module.' A refaire</p>';
                                            }
                                            ?>
                                            
                    <br>
                   
                </div>
            </div>
            <?php } ?>
             <div class="col-12 p-2 bg-info  mt-5 text-center font-weight-bold text-white">
                        <?php echo "Note semsetre : ".$total_sem/$nbr_module ; ?>
                        
                    </div>
        </div> <!-- loop on module -->
    </div>
</div>

<?php include('include/footer.php') ?>