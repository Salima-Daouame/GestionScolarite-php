<?php $etudiant = $student->getStudent($_SESSION['CNE']); ?>
			<nav id="sidebar">
				<div class="p-4 pt-5">
		  		<a href="profil.php?CNE=<?php echo $_SESSION['CNE'] ?>" class="img logo rounded-circle mb-5" 
		  			style="background-image: url('<?php echo $etudiant['Avatar'] ?>');background-color: white;"></a>
	        <ul class="list-unstyled components mb-5">
	          <li class="active">
              <a href="homepage.php">Home</a>
	          </li>
			  <li>
	              <a href="notifications.php">Notifications</a>
	          </li>	          			  
	          <li>
	              <a href="inscription2.php">Inscription</a>
	          </li>
			  <li>
	              <a href="reinsc.php">Réinscription</a>
	          </li>
			  <li>
	              <a href="absence.php">Absence</a>
	          </li>
			  <li>
	              <a href="Note.php">Notes</a>
	          </li>
			  <li>
	              <a href="TelechargerDocument.php">Télécharger un document</a>
	          </li>	
			  <li>
	              <a href="demande.php">Demander un document</a>
	          </li>
			  <li>
			  	<a href="docTriter.php">List des demandes</a>
			  </li>
			  <li>
	              <a href="reclamation.php">Réclamation</a>
	          </li>		  
			  
	        </ul>

	      </div>
    	</nav>