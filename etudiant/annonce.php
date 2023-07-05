<?php include "navAbsence.php";?>
<!--ABSENCE PHP-->       
<?php
$title = "Annonce";
$etudiant = $student->getStudent($_SESSION['CNE']);
$semestres = $student->getSemestres();


$class = $student->getClass($_SESSION['CNE']);




$classAnnonce = $student->getAnnonceId($class);
$annonce = $student->getAnnonce($classAnnonce);
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

            <h2 class="mb-4">Annonces</h2>
                <div class="row">
                            <!-- loop on module -->
                    <div class="col-md-12">

                        <div class="row m-3  bg-dark p-3 rounded">
                                    <!-- loop on matier -->
                            <div class="col-md-4">
                                <div class="card border-0 p-2 shadow ">
                                    <h4 class="text-center"></h4>
                                    <div class="row text-dark">
                                        <div class="col-md-4">
                                                    <?php 
                                                        if($responce -> num_rows > 0){
                                                            while($annonce = $annonce->fetch()){
                                                                        $annonce_title = $student->getAnnonce($classAnnonce);
                                                                        $annonce_text = $student->getAnnonce($classAnnonce);
                                                                        echo '
                                                                        <h5>'.$annonce_title.'</h5>
                                                                        <p>'.$annonce_text.'</p>';
                                                            
                                                            }
                                                        }
                                                    ?>
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