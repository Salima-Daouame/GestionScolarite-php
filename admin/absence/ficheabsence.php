<?php
session_start();
require("../include/connexion.php");
require("../include/inactivity.php");
include('../../db.php');
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
if(isset($_POST['semestre'])){
	$Mmatieres = $admin->getSemMatieres($_POST['semestre']);
	$arrayOfMatieres = array();
	while($Mmatiere = $Mmatieres->fetch()){
		array_push($arrayOfMatieres, $Mmatiere['Code_Mat']);
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
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>GS web app</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
	<link rel="stylesheet" type="text/css" href="css/new.css">
    <!-- END PAGE LEVEL STYLES -->
</head>
<body class="alt-menu sidebar-noneoverflow">
    
    <!--  BEGIN NAVBAR  -->
    <?php include("../include/menu-h.php");?>
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
<div id="content" class="main-content">
	<div class="layout-px-spacing">
		
		<div class="page-header">
			<div class="page-title">
				<h3>Gestion d'absence</h3>
			</div>
		</div>

		<div class="row" id="cancel-row">
		
			<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
				<div class="widget-content widget-content-area br-6">
					<div class="table-responsive mb-4 mt-4">
						<div class="container">
							<div class="row justify-content-center">
								<div class="row">
								<section class="ftco-section">


								<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
			<a href="absences.php"><button  class="buttonabc"><---Table d'absence</font></button></a>
				<div class="col-md-6 text-center mb-4">
					<h2 class="heading-section">La fiche des absences <button  class="telechargerfichier" style="font-size:20px;" onclick="downloadTable()">télécharger La fiche en tant que PDF</button></h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3 class="h5 mb-4 text-center" style="display: flex;flex-direction:row;justify-content:space-evenly;">
						
						<form action="" method="post">
							<label for="filiere">Filiere : </label>
							<select class="inputs" name="filiere" onchange="this.form.submit()">
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
							<select class="inputs" name="classe" required>
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
							<label for="classe">Semestre: </label>
							<select class="inputs" name="semestre" required onchange="this.form.submit()">
							<?php 
								if(isset($_POST['semestre'])){
									echo '<option value="">'.$_POST['semestre'].'</option>';
									for($i = 1; $i <= 2; $i++){
										if($_POST['semestre'] != $i) echo '<option value="'.$i.'">'.$i.'</option>';
									}
								}
								else {
									echo '<option value="">Choisir Un semestre</option>';
									for($i = 1; $i <= 2; $i++){
									echo '<option value="'.$i.'">'.$i.'</option>';
									}
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
								<th style="text-align:center;margin:0;padding:25px 5px;">Student Name</th>
                                <?php
                                    if(isset($_SESSION['classe'])){
                                        $modules = $admin->getModules($_SESSION['classe']);
                                        while($module = $modules->fetch()){
                                            $matieres = $admin->getMatieres($module[0]);
                                            while($matiere = $matieres->fetch()){
												if(in_array($matiere['Code_Mat'], $arrayOfMatieres)){
													$students2 = $admin->getStudents($_SESSION['classe']);
													echo '
													<th style="text-align:center;margin:0;padding:25px 5px;">'.$matiere['Nom_Mat'].'</th>';
													while($student2 = $students2->fetch()){
														$some = $admin->matiereheuresTout($student2['CNE'],$matiere['Nom_Mat']);
														$etudiants[$student2['CNE']][$matiere['Nom_Mat']] = $some;
													}
                                                }
                                            }
                                        }
										echo '
										<th style="text-align:center;margin:0;padding:25px 5px;">Somme Des heures</th>
										<th style="text-align:center;margin:0;padding:25px 5px;">Avertir l\'etudiant</th>';
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
											<td style="text-align:center">
												'.$student['CNE'].'
												<input type="text" name="CNE['.$count.']" value="'.$student['CNE'].'" style="display:none;">
											</td>
											<td style="text-align:center">
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
													if(in_array($matiere['Code_Mat'], $arrayOfMatieres)){
														echo '
														<td style="text-align:center">';
														if($etudiants[$student['CNE']][$matiere['Nom_Mat']] == '') echo '0';
														else echo $etudiants[$student['CNE']][$matiere['Nom_Mat']];
														$some += $etudiants[$student['CNE']][$matiere['Nom_Mat']];
														echo '</td>';
													}
                                                }
                                            }
											echo '
											<td style="text-align:center">'.$some.'</td>
											<td style="text-align:center;"><img src="assets/css/icons/send.png" id="'.$student['CNE'].'" onclick="avertir(this)" alt="send icon" style="cursor:pointer;"></td>
										</tr>';
										$count++;
										echo '<input type="number" name="studentsNumber" value="'.$count.'" style="display:none">';
									}
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
												if(in_array($matiere['Code_Mat'], $arrayOfMatieres)){
													$students2 = $admin->getStudents($_SESSION['classe']);
													echo '
													<th style="text-align:center;margin:0;padding:25px 5px;">'.$matiere['Nom_Mat'].'</th>';
													while($student2 = $students2->fetch()){
														$some = $admin->matiereheuresTout($student2['CNE'],$matiere['Nom_Mat']);
														$etudiants[$student2['CNE']][$matiere['Nom_Mat']] = $some;
													}
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
													if(in_array($matiere['Code_Mat'], $arrayOfMatieres)){
														echo '
														<td style="text-align:center;margin:0;padding:10px 5px;">';
														if($etudiants[$student['CNE']][$matiere['Nom_Mat']] == '') echo '0';
														else echo $etudiants[$student['CNE']][$matiere['Nom_Mat']];
														$some += $etudiants[$student['CNE']][$matiere['Nom_Mat']];
														echo '</td>';
													}
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

</div>
</div>
</div>
</div>
</div>
</div>

</div>

</div>
</div>

</div>

	</section>
	    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
	<script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
	<!-- <script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/main.js"></script> -->
    <script src="assets/js/custom.js"></script>
	<script src="js/html2pdf.bundle.min.js"></script>
    
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="../assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="plugins/table/datatable/datatables.js"></script>
    <script>        
        $('#default-ordering').DataTable( {
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Rechercher...",
               "sLengthMenu": "Résultats :  _MENU_",
            },
            "order": [[ 3, "desc" ]],
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7,
            drawCallback: function () { $('.dataTables_paginate > .pagination').addClass(' pagination-style-13 pagination-bordered mb-5'); }
	    } );
    </script>
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
</body>
</html>

