<?php
session_start();
require("../include/connexion.php");
require("../include/inactivity.php");
include('db.php');
$admin = new admin();
$semestres = $admin->getSemestres();
$students = $admin->modifiernote($_GET['modi']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Modifier la note</title>
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
           </h3>
                    <div class="table-wrap" style="margin-bottom:100px;">
                    <form method="POST" action="modifier.php">
                        <table class="table table table-bordered mb-4">
                        <thead class="thead-primary">
                            <tr>
                                <th></th>
                                <th style="text-align:center;margin:0;padding:25px 5px;">CNE</th>
                                <th style="text-align:center;margin:0;padding:25px 5px;">Nom & Prenom</th>
                                <th style="text-align:center;margin:0;padding:25px 5px;" >Evaluation</th>
                                <th style="text-align:center;margin:0;padding:25px 5px;">Note</th>
                               
                                <th style="text-align:center;margin:0;padding:25px 5px;">Enregistrer</th>



                                



                            </tr>
                        </thead>
                        <tbody>
                           <?php 
                            if(isset($students)){
                                 $etat = 0;
                                while($student = $students->fetch()){
                                    if($etat === $student['CNE']){
                                        echo'
                                        <th> <input type="hidden" name="id_eval" value=" ' .$student['Id_eval']. '"</th>
                                        <th></th>
                                        <th>
                                         ' .$student['Nom_eval']. '
                                        </th>
                                        <th>
                                         <input type="text" value="'.$student['Note_eval']. '">
                                                          
                                        </th>
                                             <th class="text-center" ><a href="modifiernote.php?sup'.$student["Id_eval"].'" >Enregistrer</a         <input type="submit" class="button" title="modifier" name="modifier" value="Mettre à jour"></input>

                                            </th>
                                        </tr>';

                                    }
                                    else{
                                        $etat = $student['CNE'] ;
                                    
                                        echo'     
                                        <tr class="alert" role="alert">
                                        <th>
                                        <input type="hidden" name="id_eval" value=" ' .$student['Id_eval']. '"
                                        </th>
                                            <th >  
                                                         
                                            '.$student['CNE'].'
                                                
                                            </th>
                                                        
                                            <th >
                                                           
                                                '.$student['Nom'].'  '.$student['Prenom'].'
                                                            
                                             </th>
                                            <th>
                                                    ' .$student['Nom_eval']. '
                                            </th>
                                            <th>
                                                <input type="text" name="Note" value="'.$student['Note_eval']. '">
                                                          
                                            </th>
                                             <th class="text-center">           
                                             <input type="submit" class="button" title="modifier" name="modifier" value="Mettre à jour"></input>
        
                                            </th>

                                            </tr> ';
                                        }
                                    }
                                           
                                }
                                            
                                        ?>
                                    </tbody>
                                </table>
                            <input type="submit"  title="ajouter" name="ajouter" value="Ajouter des Notes"><a href="ajouternotes.php"></a></input>

                             <button style="border:none;box-shadow:0 0 5px rgba(0,0,0,0.5);border-radius:20px; margin-left:700px; width: 300px;font-size: 20px;"><a href="apps_todolist.php">Ajout des notes</a></button>
                             </form>
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
    margin-left: 100px;
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