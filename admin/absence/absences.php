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
        <title>Les Absences</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>GS web app</title>
    	<link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    	<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    	<link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
		<link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
        <link rel="stylesheet" type="text/css" href="css/new.css">
	</head>
	<body class="alt-menu sidebar-noneoverflow">
    
    <!--  BEGIN NAVBAR  -->
    <!-- <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm expand-header">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <ul class="navbar-item flex-row ml-auto">

                <li class="nav-item align-self-center search-animated">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search toggle-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <form class="form-inline search-full form-inline search" role="search">
                        <div class="search-bar">
                            <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Search...">
                        </div>
                    </form>
                </li>

                <li class="nav-item dropdown language-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="language-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="assets/img/ca.png" class="flag-width" alt="flag">
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="language-dropdown">
                        <a class="dropdown-item d-flex" href="javascript:void(0);"><img src="assets/img/de.png" class="flag-width" alt="flag"> <span class="align-self-center">&nbsp;German</span></a>
                        <a class="dropdown-item d-flex" href="javascript:void(0);"><img src="assets/img/jp.png" class="flag-width" alt="flag"> <span class="align-self-center">&nbsp;Japanese</span></a>
                        <a class="dropdown-item d-flex" href="javascript:void(0);"><img src="assets/img/fr.png" class="flag-width" alt="flag"> <span class="align-self-center">&nbsp;French</span></a>
                        <a class="dropdown-item d-flex" href="javascript:void(0);"><img src="assets/img/ca.png" class="flag-width" alt="flag"> <span class="align-self-center">&nbsp;English</span></a>
                    </div>
                </li>
                
                <li class="nav-item dropdown message-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="messageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg><span class="badge badge-primary">3</span>
                    </a>
                    <div class="dropdown-menu position-absolute e-animated e-fadeInUp" aria-labelledby="messageDropdown">
                        <div class="">
                            <a class="dropdown-item">
                                <div class="">
                                    <div class="media notification-new">
                                        <div class="notification-icon">
                                            <div class="icon-svg mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                                <p class="meta-title mr-3">5 messages for group</p>
                                                <p class="message-text">Kelly, Amy, Shaun</p>
                                                <p class="meta-time align-self-center mb-0">Yesterday</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item">
                                <div class="">
                                    <div class="media notification-new">
                                        <div class="usr-profile-img mr-3">
                                            <div class="user-profile">
                                                <div class="">KY</div>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                                <p class="meta-user-name mr-3">Kara Young</p>
                                                <p class="message-text">Some quick example text to build the notification ..</p>
                                                <p class="meta-time align-self-center mb-0">2 hours ago</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item">
                                <div class="">
                                    <div class="media notification-new">
                                        <div class="notification-icon">
                                            <div class="icon-svg mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                                <p class="meta-title mr-3">1 new email</p>
                                                <p class="message-text">Anderson.Daisy@mail.com</p>
                                                <p class="meta-time align-self-center mb-0">Yesterday</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown notification-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span class="badge badge-success"></span>
                    </a>
                    <div class="dropdown-menu position-absolute e-animated e-fadeInUp" aria-labelledby="notificationDropdown">
                        <div class="notification-scroll">

                            <div class="dropdown-item">
                                <div class="media">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                    <div class="media-body">
                                        <div class="notification-para"><span class="user-name">Shaun Park</span> commented on your post.</div>
                                        <div class="notification-meta-time">5 mins ago</div>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-item">
                                <div class="media">                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                                    <div class="media-body">
                                        <div class="notification-para"><span class="user-name">Kelly Young</span> likes your photo</div>
                                        <div class="notification-meta-time">8 mins ago</div>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-item">
                                <div class="media">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                    <div class="media-body">
                                        <div class="notification-para">Invitation successfully sent to <span class="user-name">Amy Diaz</span></div>
                                        <div class="notification-meta-time">10 mins ago</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                    </a>
                    <div class="dropdown-menu position-absolute e-animated e-fadeInUp" aria-labelledby="userProfileDropdown">
                        <div class="user-profile-section">                            
                            <div class="media mx-auto">
                                <img src="assets/img/90x90.jpg" class="img-fluid mr-2" alt="avatar">
                                <div class="media-body">
                                    <h5>Alan Green</h5>
                                    <p>Web Developer</p>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            <a href="user_profile.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> <span>My Profile</span>
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="apps_mailbox.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path></svg> <span>My Inbox</span>
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="auth_lockscreen.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg> <span>Lock Screen</span>
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="auth_login.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> <span>Log Out</span>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </header>
    </div> -->
    <?php include '../include/menu-h.php'; ?>
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
                                                        


	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
            <a href="ajoutabsence.php"><button  class="buttonabc"><---Ajoute absence</font></button></a>
            <a href="ficheabsence.php"><button class="buttonfiche"><font color="white">Fiche d'absence---></font></button></a>
				<div class="row">
					<h2 class="heading-section" style="text-align:center;width:100%;">Justifier absence</h2>
					<div class="col-md-12">
						<h3 class="h5 mb-4 text-center" style="display: flex;flex-direction:row;justify-content:space-evenly;">
							<form action="" method="post" id="justifierabsence">
								<label for="CNE">CNE : </label>
								<input class="inputs" type="text" name="CNE" placeholder="Entez le CNE" required>
								<label for="date">Date : </label>
								<input class="inputs" type="date" name="date" required>
								<label for="justification">Justification : </label>
								<input class="inputs" type="text" name="justification" placeholder="Entez la Justification" required>
								<button id="submitjustification" class="submitjustification">Justifier</button>
							</form>
						</h3>
					</div>
					<button id="envoyerAvertissement" class="submitaver" title="Envoyer un avertissement à tout les étudiants qui ont un somme d'absences>=10">Envoyer avertissements</button>
				</div>
				<div class="col-md-6 text-center mb-4">
					<h2 class="heading-section">Affichage des absences</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3 class="h5 mb-4 text-center" style="display: flex;flex-direction:row;justify-content:space-evenly;">
						
						<form action="" method="post">
							<label for="filiere">Filiere : </label>
							<select class="inputs" style="width:5em;" name="filiere" onchange="this.form.submit()">
							<?php 
								if(isset($_SESSION['filiere'])){
									if($_SESSION['filiere'] == "") echo '<option value="">Choisir Une matiere</option>';
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
							<select class="inputs" style="width:5em;" name="classe" required>
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
							<select class="inputs" style="margin-right:5px;" name="semestre" required>
							<?php 
								if(isset($_POST['semestre'])){
									echo '<option value="'.$_POST['semestre'].'">'.$_POST['semestre'].'</option>';
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
							<label for="date">Date : </label>
							<input class="inputs" style="width:10em;" type="date" name="date" required onchange="this.form.submit()" value="<?php if(isset($_POST['date'])) echo $_POST['date']; ?>"></input>
                        </form>
					</h3>
					<div class="table-wrap">
						<table class="table table table-bordered mb-4">
							<thead class="thead-primary">
								<tr>
								<th>CNE</th>
								<th>Student Name</th>
                                <?php
                                    if(isset($_SESSION['classe'])){
                                        $modules = $admin->getModules($_SESSION['classe']);
                                        while($module = $modules->fetch()){
                                            $matieres = $admin->getMatieres($module[0]);
                                            while($matiere = $matieres->fetch()){
                                                if(in_array($matiere['Code_Mat'], $arrayOfMatieres)){
                                                    $students2 = $admin->getStudents($_SESSION['classe']);
                                                    echo '
                                                    <th>'.$matiere['Nom_Mat'].'</th>';
                                                    while($student2 = $students2->fetch()){
                                                        $some = $admin->matiereheures($student2['CNE'],$matiere['Nom_Mat'],$_POST['date']);
                                                        $etudiants[$student2['CNE']][$matiere['Nom_Mat']] = $some['count'];
                                                        $etudiants[$student2['CNE']]['justificationStatus'] = $some['justificationStatus'];
                                                        if($some['justificationStatus'] == 'Justifié') $etudiants[$student2['CNE']]['justification'] = $some['justification'];
                                                    }
                                                }
                                            }
                                        }
                                    }
                                ?>
								<th>Justifié/Non Justifié</th>
								<th>Justification</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								if(isset($students)){
									$count = 0;
									while($student = $students->fetch()){
										$studentcheck = $admin->studentExists($student['CNE'],$_POST['date']);
										if($studentcheck[0] != $student['CNE']) { continue; }
										echo '
										<tr class="alert" role="alert">
											<td>
												'.$student['CNE'].'
												<input type="text" name="CNE['.$count.']" value="'.$student['CNE'].'" style="display:none;">
											</td>
											<td>
												<div class="email">
													<span> '.$student['Nom'].' '.$student['Prenom'].' </span>
													<span></span>
												</div>
											</td>';
                                            $modules = $admin->getModules($_SESSION['classe']);
                                            while($module = $modules->fetch()){
                                                $matieres = $admin->getMatieres($module[0]);
                                                while($matiere = $matieres->fetch()){
                                                    if(in_array($matiere['Code_Mat'], $arrayOfMatieres)){
                                                        echo '
                                                        <td>';
                                                        if($etudiants[$student['CNE']][$matiere['Nom_Mat']] == '') echo '-';
                                                        else echo $etudiants[$student['CNE']][$matiere['Nom_Mat']];
                                                        echo '</td>';
                                                    }
                                                }
                                            }
                                            if(isset($etudiants)){echo '
                                                <td>'.$etudiants[$student['CNE']]['justificationStatus'].'</td>
                                                <td>';}
                                            if(isset($etudiants[$student['CNE']]['justification'])) echo $etudiants[$student['CNE']]['justification'];
                                            else echo '-';
                                            echo'</td>
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
    <script src="../assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/app.js"></script>
    
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="../assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="../assets/js/apps/mailbox-chat.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

    <script>
        $(document).on('change','#filiere',function(){
            var id = $(this).val();
            $.ajax({
                method: 'POST',
                url: 'select_tag.php',
                data: {'id' : id},
                success: function(data){
                    $('#class').html(data);
                }
            });
        });
    </script>
	<script>
		$(function(){
			$('#submitjustification').click(function(event){
				event.preventDefault();
				$.ajax({
					type:"POST",
					url:"justifierabs.php",
					data:$('#justifierabsence').serialize(),
					success:function(response){
						res = response.split('');
						if(res[0] != 'A') alert(response);
						else {
							let result = confirm(res.join(''));
						}
					}
				});
			});
			$('#envoyerAvertissement').click(function(event){
				event.preventDefault();
				$.ajax({
					type:"POST",
					url:"envoyeravertissement.php",
					success:function(response){
						alert(response);
					}
				});
			});
		});
	</script>
</body>
</html>

