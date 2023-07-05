<?php
session_start();
require("../include/connexion.php");
require("../include/inactivity.php");
include('db.php');
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
    <title>Ajout des notes</title>
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
                         
                            <label for="filiere">Filiere : </label>
                            <select name="filiere" onchange="this.form.submit()"class="form-control">
                        
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
                            <select name="classe" required onchange="this.form.submit()" class="form-control">
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
                                <th style="text-align:center;margin:0;padding:25px 5px;">Nom </th>
                                <th style="text-align:center;margin:0;padding:25px 5px;">Prénom</th>
                                <th style="text-align:center;margin:0;padding:25px 5px;">Ajouter une note</th>
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
                                                    <span> '.$student['Nom'].' </span>
                                                </div>
                                            </td>
                                            <td style="text-align:center">
                                                <div class="email">
                                                    <span> '.$student['Prenom'].' </span>
                                                </div>
                                            </td>
                                        <td style="text-align:center">
                                                <div class="email">
                                                    <a href="ajouternotes.php?ajouterN='.$student['CNE'].'" class="btn btn-primary">Ajouter</a>
                                                </div>
                                        </td>
                                        ';
                                       
                                     }
                                 }       
                            ?>
                        </tbody>
                        </table>
    </section>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/html2pdf.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function avertir(x){
            CNE = x.id;
            $.ajax({
                type:"POST",
                url:"avertirEtudiant.php",
                data: {
                    "CNE": CNE,
                },
                success:function(response){
                    alert(response);
                }
            });
        }
        async function downloadTable(){
            table = document.querySelector('.table-wrap2');
            table.style.display = 'block';
            var opt = {
                filename:     'absence_<?php echo $_SESSION['filiere']?>_<?php echo $_SESSION['classe']?>.pdf',
                image:        { type: 'jpeg', quality: 1 },
                html2canvas:  { scale: 1 },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape',format: 'a3' }
            };
            var worker = await html2pdf().from(table).set(opt).save();
            table.style.display = 'none';
        }
    </script>
    <style type="text/css">

  table{
    background: white;
    margin-left: 200px;
  }
  form {
    margin-left: 300px;
  }
  label{  
  color: black;
   }
   select{
    margin-left: 30px;
   }
    margin-left: 40px;
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