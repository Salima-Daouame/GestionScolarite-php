<?php $etudiant = $student->getStudent($_SESSION['CNE']); ?>
<nav id="sidebar">
	<div class="p-4 pt-5">
		<a href="profile.php?CNE=<?php echo $_SESSION['CNE'] ?>" class="img logo rounded-circle mb-5"
			style="background-image: url('<?php echo $etudiant['Avatar'] ?>');"></a>
		<ul class="list-unstyled components mb-5">
			<li class="active">
				<a href="./">Home</a>
			</li>
			<li>
				<a href="annonces.html">Annonces</a>
			</li>
			<!-- <li>
              <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
              <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="#">Page 1</a>
                </li>
                <li>
                    <a href="#">Page 2</a>
                </li>
                <li>
                    <a href="#">Page 3</a>
                </li>
              </ul>
	          </li> -->
			<li>
				<a href="#">Contact</a>
			</li>
		</ul>
	</div>
</nav>