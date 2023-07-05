<?php
session_start();
include('db.php');
require("../include/connexion.php");
require("../include/inactivity.php");
$admin = new admin();
$semestres = $admin->getSemestres();
if(isset($_POST['matiere'])){
    $_SESSION['matiere'] = $_POST['matiere'];
    $students = $admin->Mat($_SESSION['matiere']);
}
if(isset($_POST['semestre'])){
    $_SESSION['semestre'] = $_POST['semestre'];
    if(isset($_SESSION['module'])){
        unset($_SESSION['module']);
    }
}
if(isset($_POST['module'])){
    $_SESSION['module'] = $_POST['module'];
    if(isset($_SESSION['matiere'])){
        unset($_SESSION['matiere']);
    }
}

if(!isset($_POST['semestre']) && !isset($_POST['module']) && !isset($_POST['matiere'])){
    if(isset($_SESSION['semestre'])){
        unset($_SESSION['semestre']);
    }
    if(isset($_SESSION['module'])){
        unset($_SESSION['module']);
    }
     if(isset($_SESSION['matiere'])){
        unset($_SESSION['matiere']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Ajout Note Etudiant</title>
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

        <!--  BEGIN CONTENT AREA  -->
<section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-4">
                    <h2 class="heading-section">Gestion des notes</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                       <h3 class="h5 mb-4 text-center" style="display: flex;flex-direction:row;justify-content:space-evenly;">
                        
                        <form action="" method="post">
                         
                            <label for="semestre">Semestre : </label>
                            <select name="semestre" onchange="this.form.submit()"class="form-control">
                        
                            <?php 
                                if(isset($_SESSION['semestre'])){
                                    if($_SESSION['semestre'] == "") echo '<option value="">Choisir Un semestre</option>';
                                    else echo '<option value="'.$_SESSION['semestre'].'">'.$_SESSION['semestre'].'</option>';
                                }
                                if(!isset($_SESSION['semestre'])) echo '<option value="">Choisir Un semestre</option>';
                                while($semestre = $semestres->fetch()){
                                    if($_SESSION['semestre'] != $semestre['Code_Sem']){
                                        echo '
                                        <option value="'.$semestre['Code_Sem'].'">'.$semestre['Code_Sem'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        
                            
                        </form>
                        <form action="" method="POST">
                            <label for="module">Module : </label>
                            <select name="module" required onchange="this.form.submit()" class="form-control">
                            <?php 
                                if(isset($_SESSION['module'])){
                                    if($_SESSION['module'] == "") echo '<option value="">Choisir Un module</option>';
                                    else echo '<option value="'.$_SESSION['module'].'">'.$_SESSION['module'].'</option>';
                                }
                                if(!isset($_SESSION['module'])) echo '<option value="">Choisir Un module</option>';
                                $modules = $admin->getModule($_SESSION['semestre']);
                                while($module = $modules->fetch()){
                                    if($_SESSION['module'] != $module['Num_module']) echo '<option value="'.$module['Num_module'].'">'.$module['Nom_module'].'</option>';
                                }
                                ?>
                            </select>

                        </form>
                                               <form action="" method="post">
                            <label for="matiere">Matière : </label>
                            <select name="matiere"  onchange="this.form.submit()" class="form-control">
                            <?php 
                                if(isset($_SESSION['matiere'])){
                                    if($_SESSION['matiere'] == "") echo '<option value="">Choisir Un matiere</option>';
                                    else echo '<option value="'.$_SESSION['matiere'].'">'.$_SESSION['matiere'].'</option>';
                                }
                                if(!isset($_SESSION['matiere'])) echo '<option value="">Choisir Un matiere</option>';
                                 $matieres = $admin->getMat($_SESSION['module']);
                                while($matiere = $matieres->fetch()){
                                    if($_SESSION['matiere'] != $matiere['Code_Mat']) echo '<option value="'.$matiere['Code_Mat'].'">'.$matiere['Nom_Mat'].'</option>';
                                }
                                ?>
                            </select>
                        </form>
                    </h3>
                    <div class="table-wrap" style="margin-bottom:100px;">
                    <form  action="note.php" method="POST">
                        <table class="table table table-bordered mb-4" >
                        <thead class="thead-primary">
                            <tr>
                                <th style="text-align:center;margin:0;padding:25px 5px;">CNE</th>
                                <th style="text-align:center;margin:0;padding:25px 5px;">Matière</th>
                                <th style="text-align:center;margin:0;padding:25px 5px;">DS<input type="text" name="DS" id="DS" value="DS" style="display:none;"></th>
                                <th style="text-align:center;margin:0;padding:25px 5px;">Coefficient DS</th>
                                <th style="text-align:center;margin:0;padding:25px 5px;">Examen<input type="text" name="Examen" value="Examen" style="display:none;"></th>
                                <th style="text-align:center;margin:0;padding:25px 5px;">Coefficient Examen</th>
                                <th style="text-align:center;margin:0;padding:25px 5px;">Tp<input type="text" name="TP" value="TP" style="display:none;"></th>
                                <th style="text-align:center;margin:0;padding:25px 5px;">Coefficient TP</th>
                                <th style="text-align:center;margin:0;padding:25px 5px;">Projet<input type="text" name="Projet" value="Projet" style="display:none;"></th>
                                <th style="text-align:center;margin:0;padding:25px 5px;">Coefficient projet</th>

                            </tr>
                        </thead>
                        <tbody>
                          <?php 
                            if(isset($students)){
                              
                                while($student = $students->fetch()){
                                    
                                ?>
                                    <tr class="alert" role="alert">
                                                      <td>
                                                        <?php
                                                        echo" ".$_GET["ajouterN"]."
                                                          <input type='text' name='CNE'  value='".$_GET["ajouterN"]."' style='display:none;'>";
                                                         ?>
                                                       
                                                        </td>
                                                        <td>
                                                         <?php
                                                        
                                                          echo'
                                                         
                                                            '.$student["Nom_Mat"].'
                                                            <input type="text" name="Code_Mat"  value="'.$student["Code_Mat"].'" id="Code_Mat" style="display:none;">';
                                                        ?>
                                                       

                                                        </td>
                                                        
                                                         <td >
                                                          <?php
                                                          echo "  
                                                           <input type='text' name='ds' id='ds' >";
                                                    
                                                       ?>                                                            
                                                        </td>
                                                        <td >
                                                          
                                                        <input type="text"  name="coeffds" class="quantity form-control input-text" id ="coeffds">
                                                         
                                                        </td>
                                                         <td class="quantity">
                                                            <div class="input-group">
                                                                <input type="text" id="examen" name="examen"  >
                                                            </div>
                                                        </td>
                                                        <td class="quantity">
                                                            <div class="input-group">
                                                                <input type="text" id="coeffExam" name="coeffExam"  >
                                                            </div>
                                                        </td>
                                                         <td class="quantity">
                                                                <input type="text" name="tp" id="tp" class="quantity form-control input-text">
                                                           
                                                        </td>
                                                        <td class="quantity">
                                                                <input type="text" name="coefftp" id="coefftp" class="quantity form-control input-text"  >
                                                           
                                                        </td>
                                                         <td class="quantity">
                                                            <div class="input-group">
                                                              <input type="text" name="projet" id="projet" >
                                                            </div>
                                                        </td>
                                                        <td class="quantity">
                                                            <div class="input-group">
                                                                <input type="text" name="coeffprojet" id="coeffprojet" class="quantity form-control input-text"  >
                                                            </div>
                                                        </td>
                                                     
                                                    </tr>;
                                                <?php
                                                   
                                           }


                               
                                }
                                ?>
                                    </tbody>
                                </table>
                                <input type="submit" class="button" id="ajouter2" name="ajouter2" value="Ajouter">
                               </form>
                              <button style="border:none;box-shadow:0 0 5px rgba(0,0,0,0.5);border-radius:20px; margin-left:700px; width: 200px;margin-top: 10px;"><a href="tester.php" style="color:black">liste des notes</a></button>
                    </div>
                </form>
                </div>
                          </div>
        </div>
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
    margin-left:4px;
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