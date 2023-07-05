<div class="col-md-6 text-center mb-4">
					<h2 class="heading-section">Gestion des notes <button  style="font-size:0.5em;border:2px solid grey;border-radius:20px" onclick="downloadTable()">télécharger La fiche en tant que PDF</button></h2>
				</div>


<?php
                                    if(isset($_SESSION['classe'])){
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
										<th style="text-align:center;margin:0;padding:25px 5px;">Somme Des heures</th>
										<th style="text-align:center;margin:0;padding:25px 5px;">Avertir l\'etudiant</th>';
                                    }
                                ?>