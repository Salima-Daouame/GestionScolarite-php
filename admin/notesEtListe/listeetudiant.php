<?php
session_start();
include('db.php');
require("../include/connexion.php");
require("../include/inactivity.php");
$admin = new admin();
$filieres = $admin->getFilieres();
if(isset($_POST['classe'])){
    $_SESSION['classe'] = $_POST['classe'];
    $students = $admin->getStudents($_SESSION['classe']);
}
if(isset($_POST['filiere'])){
    $_SESSION['filiere'] = $_POST['filiere'];
    if(isset($_SESSION['classe'])){
        unset($_SESSION['classe']);
    }
}
if(!isset($_POST['filiere']) && !isset($_POST['classe'])){
    if(isset($_SESSION['filiere'])){
        unset($_SESSION['filiere']);
    }
    if(isset($_SESSION['classe'])){
        unset($_SESSION['classe']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Liste des Etudiants</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="plugins/editors/quill/quill.snow.css">
    <link href="assets/css/apps/todolist.css" rel="stylesheet" type="text/css" />

    <!--  END CUSTOM STYLE FILE  -->
</head>
<body class="alt-menu sidebar-noneoverflow">
    
    <!--  BEGIN NAVBAR  -->
    <?php include('../include/menu-h.php'); ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container sidebar-closed sbar-open" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->

    <?php include '../include/menu-v.php'; ?>
        <!--  END SIDEBAR  -->
<section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-4">
                    <h2 class="heading-section">Liste des étudiants</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="h5 mb-4 text-center" style="display: flex;flex-direction:row;justify-content:space-evenly;">
                        
                        <form action="" method="post">
                            <label for="filiere">Filiere : </label>
                            <select name="filiere" onchange="this.form.submit()">
                            <?php 
                                if(isset($_SESSION['filiere'])){
                                    if($_SESSION['filiere'] == "") echo '<option value="">Choisir Une filiere</option>';
                                    else echo '<option value="'.$_SESSION['filiere'].'">'.$_SESSION['filiere'].'</option>';
                                }
                                if(!isset($_SESSION['filiere'])) echo '<option value="">Choisir Une filiere</option>';
                                while($filiere = $filieres->fetch()){
                                    if($_SESSION['filiere'] != $filiere['Nom_Filiere']){
                                        echo '
                                        <option value="'.$filiere['Nom_Filiere'].'">'.$filiere['Nom_Filiere'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                                <button type="submit" style="display:none;"></button>
                        </form>
                        <form action="" method="post">
                            <label for="classe">Classe : </label>
                            <select name="classe" required onchange="this.form.submit()">
                            <?php 
                                if(isset($_SESSION['classe'])){
                                    if($_SESSION['classe'] == "") echo '<option value="">Choisir Une classe</option>';
                                    else echo '<option value="'.$_SESSION['classe'].'">'.$_SESSION['classe'].'</option>';
                                }
                                if(!isset($_SESSION['classe'])) echo '<option value="">Choisir Une classe</option>';
                                $classes = $admin->getClasses($_SESSION['filiere']);
                                while($classe = $classes->fetch()){
                                    if($_SESSION['classe'] != $classe[0]) echo '<option value="'.$classe[0].'">'.$classe[0].'</option>';
                                }
                                ?>
                            </select>
                        </form>
                    </h3>
                    <div class="table-wrap" style="margin-bottom:100px;">
                        <table class="table table table-bordered mb-4">
                        <thead class="thead-primary">
                            <tr>
                                <th style="text-align:center;margin:0;padding:25px 5px;">CNE</th>
                                <th style="text-align:center;margin:0;padding:25px 5px;">CNI</th>
                                <th style="text-align:center;margin:0;padding:25px 5px;">Student Name</th>
                                <th style="text-align:center;margin:0;padding:25px 5px;">date_nais</th>
                                <th style="text-align:center;margin:0;padding:25px 5px;">num_tele</th>
                                <th style="text-align:center;margin:0;padding:25px 5px;">email</th>
                                <th style="text-align:center;margin:0;padding:25px 5px;">classe</th>

                                

                                
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(isset($students)){
                                    $count = 0;
                                    while($student = $students->fetch()){
                                        echo '
                                        <tr class="alert" role="alert">
                                            <td style="text-align:center">
                                                '.$student['CNE'].'
                                                <input type="text" name="CNE['.$count.']" value="'.$student['CNE'].'" style="display:none;">
                                            </td>
                                            <td style="text-align:center">
                                                <div class="email">
                                                    <span> '.$student['CNI'].'  </span>
                                                    <span></span>
                                                </div>
                                            </td>
                                        
                                            
                                            <td style="text-align:center">
                                                <div class="email">
                                                    <span> '.$student['Nom'].' '.$student['Prenom'].' </span>
                                                    <span></span>
                                                </div>
                                            </td>
                                            <td style="text-align:center">
                                                <div class="email">
                                                    <span> '.$student['Date_Nais'].'  </span>
                                                    <span></span>
                                                </div>
                                            </td>

                                            <td style="text-align:center">
                                                <div class="email">
                                                    <span> '.$student['N_tele'].'  </span>
                                                    <span></span>
                                                </div>
                                            </td>
                                            <td style="text-align:center">
                                                <div class="email">
                                                    <span> '.$student['email'].'  </span>
                                                    <span></span>
                                                </div>
                                            </td>
                                            <td style="text-align:center">
                                                <div class="email">
                                                    <span> '.$student['Id_class'].'  </span>
                                                    <span></span>
                                                </div>
                                            </td>'
                                            

                                            ;
                                            
                                            }
                                            echo '
                                            
                                        </tr>';
                                        $count++;
                                        echo '<input type="number" name="studentsNumber" value="'.$count.'" style="display:none">';
                                    }
                                
                            ?>
                        </tbody>
                        </table>
                    </div>
                    <div class="table-wrap2" style="display:none;">
                    <h2 style="text-align:center;">Fiche d'absence des etudiants de <?php echo $_SESSION['filiere']?> <?php echo $_SESSION['classe']?></h2>
                        <table class="table table table-bordered mb-4">
                        <thead class="thead-primary">
                            <tr>
                                <th style="text-align:center;margin:0;padding:25px 5px;">CNE</th>
                                <th style="text-align:center;margin:0;padding:25px 5px;">Student Name</th>
                                <?php
                                    if(isset($_SESSION['classe'])){
                                        $students = $admin->getStudents($_SESSION['classe']);
                                        $modules = $admin->getModules($_SESSION['classe']);
                                        while($module = $modules->fetch()){
                                            $matieres = $admin->getMatieres($module[0]);
                                            while($matiere = $matieres->fetch()){
                                                $students2 = $admin->getStudents($_SESSION['classe']);
                                                echo '
                                                <th style="text-align:center;margin:0;padding:25px 5px;">'.$matiere['Nom_Mat'].'</th>';
                                                while($student2 = $students2->fetch()){
                                                    $some = $admin->matiereheuresTout($student2['CNE'],$matiere['Nom_Mat']);
                                                    $etudiants[$student2['CNE']][$matiere['Nom_Mat']] = $some;
                                                }
                                            }
                                        }
                                        echo '
                                        <th style="text-align:center;margin:0;padding:25px 5px;">Somme Des heures</th>';
                                    }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(isset($students)){
                                    $count = 0;
                                    while($student = $students->fetch()){
                                        echo '
                                        <tr class="alert" role="alert">
                                            <td style="text-align:center;margin:0;padding:10px 5px;">
                                                '.$student['CNE'].'
                                                <input type="text" name="CNE['.$count.']" value="'.$student['CNE'].'" style="display:none;">
                                            </td>
                                            <td style="text-align:center;margin:0;padding:10px 5px;">
                                                <div class="email">
                                                    <span> '.$student['Nom'].' '.$student['Prenom'].' </span>
                                                    <span></span>
                                                </div>
                                            </td>';
                                            $modules = $admin->getModules($_SESSION['classe']);
                                            $some = 0;
                                            while($module = $modules->fetch()){
                                                $matieres = $admin->getMatieres($module[0]);
                                                while($matiere = $matieres->fetch()){
                                                    echo '
                                                    <td style="text-align:center;margin:0;padding:10px 5px;">';
                                                    if($etudiants[$student['CNE']][$matiere['Nom_Mat']] == '') echo '0';
                                                    else echo $etudiants[$student['CNE']][$matiere['Nom_Mat']];
                                                    $some += $etudiants[$student['CNE']][$matiere['Nom_Mat']];
                                                    echo '</td>';
                                                }
                                            }
                                            echo '
                                            <td style="text-align:center;margin:0;padding:10px 5px;">'.$some.'</td>
                                        </tr>';
                                        $count++;
                                        echo '<input type="number" name="studentsNumber" value="'.$count.'" style="display:none">';
                                    }
                                }
                            ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </section>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        $(function(){
            $('#submitButton').click(function(event){
                event.preventDefault();
                console.log('Hello There !!!');
                $.ajax({
                    type:"POST",
                    url:"ajoutabs.php",
                    data:$('#mainabsenceform').serialize(),
                    success:function(response){
                        if(response == 'Veillez selectioner une matiere' || response == 'Entrez le champ date') alert(response);
                        else window.location.href = 'absences.php';
                    }
                });
            });
        });
    </script>
    <style type="text/css">

  table{
    background: white;
    margin-left:200px;
    width: 300px;
  }
  form {
    margin-left: 100px;
  }
  label{  
  color: black;
  margin-left: 170px;
   }
   select{
    margin-left:100px;
   }
   .from-control{
    margin-left: 20px;
   }
   input{
    width: 30px;
   }
   input[type="submit"]{
    width: 70px;
   }


    </style>
                               

         
    <!-- END MAIN CONTAINER -->
    
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY STYLES -->
    <script src="assets/js/ie11fix/fn.fix-padStart.js"></script>
    <script src="plugins/editors/quill/quill.js"></script>
    <script src="assets/js/apps/todoList.js"></script>
</body>
</html>