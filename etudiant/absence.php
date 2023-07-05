<?php include "navAbsence.php";?>
<!--ABSENCE PHP-->       
<?php
$title = "Absence";
// $student = new student();
$etudiant = $student->getStudent($_SESSION['CNE']);
$semestres = $student->getSemestres();
$absences = $student->getAbsences($_SESSION['CNE']);
if(isset($_POST['semestre'])){
    $modules = $student->getModules($etudiant['Id_class'],$_POST['semestre']);
    // echo var_dump($modules->fetch()[0]);
    // echo var_dump($modules->fetch());
    // echo $etudiant['Id_class'],$_POST['semestre'];
}
?>
<head>
<style>
.card {
    margin-bottom: 30px;
    width: 63em;
    height: 100%;
}
table {
    border-collapse: collapse;
    width: 62em;
    text-align: center;
}
.rows{
    padding: 19px;
    border-bottom: 3px solid #e0e6ed;
    font-family: "Poppins", sans-serif;
}
.rowss{
    padding: 10px;
    border-bottom: 3px solid #e0e6ed;
    font-family: "Poppins", sans-serif;
    color: #4dbae6;
}
</style>
</head>

            <h2 class="mb-4">Absence</h2>
                <div class="row">
                            <div class="col-12">
                                <form action="" method="post">
                                    <div class="form-group">
                                    <label for="filiere">Semestre : </label>
                                    <select class="form-control w-25" name="semestre" onchange="this.form.submit()">
                                        <?php
                                            if(isset($_POST['semestre'])) echo '<option value="">'.$_POST['semestre'].'</option>';
                                            else echo '<option value="">Choisir un semestre</option>';
                                            while($semestre = $semestres->fetch()){
                                                echo 'entered haha';
                                                if(isset($_POST['semestre'])){
                                                    if($semestre['Code_Sem'] != $_POST['semestre']) echo '<option value="'.$semestre['Code_Sem'].'">'.$semestre['Code_Sem'].'</option>';
                                                }
                                                else echo '<option value="'.$semestre['Code_Sem'].'">'.$semestre['Code_Sem'].'</option>';
                                            }
                                        ?>
                                    </select>
                                        <button type="submit" style="display:none;"></button>
                                    </div>
                                </form>
                            </div>
                            <!-- loop on module -->
                    <div class="col-md-12">

                        <div class="row m-3  bg-dark p-3 rounded">
                                    <!-- loop on matier -->
                            <div class="col-md-4">
                                <div class="card border-0 p-2 shadow ">
                                    <h4 class="text-center"></h4>
                                    <div class="row text-dark">
                                        <div class="col-md-4">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th class="rows">Date</th>
                                                        <th class="rows">Matiere</th>
                                                        <th class="rows">Nombre des heures</th>
                                                        <th class="rows">Justifié/Non Justifié</th>
                                                        <th class="rows">Justification</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        if(isset($_POST['semestre'])){
                                                            while($module = $modules->fetch()){
                                                                $matieres = $student->getMatieres($module[0]);
                                                                $arrayOfMatieres = array();
                                                                while($matiere = $matieres->fetch()){
                                                                    array_push($arrayOfMatieres, $matiere['Code_Mat']);
                                                                }
                                                            }
                                                            while($absence = $absences->fetch()){                                                                
                                                                if(isset($arrayOfMatieres)){                                                                    
                                                                    if(in_array($absence['Code_Mat'], $arrayOfMatieres)){
                                                                        $matiere = $student->getMatiere($absence['Code_Mat'])['Nom_Mat'];
                                                                        if($absence['Justification'] == '')
                                                                        {
                                                                            $just = 'Non Justifié';
                                                                            $absence['Justification'] = '-';
                                                                        }
                                                                        else $just = 'Justifié';
                                                                        echo '<tr>
                                                                        <td class="rowss">'.$absence['Date_absence'].'</td>
                                                                        <td class="rowss">'.$matiere.'</td>
                                                                        <td class="rowss">'.$absence['Nombre_heures'].'</td>
                                                                        <td class="rowss">'.$just.'</td>
                                                                        <td class="rowss">'.$absence['Justification'].'</td>
                                                                        </tr>';
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>

    <!-- Main JS-->
    <script src="vendor/js/main.js"></script>
  </body>
</html>