<header>
	<ul>
		<li><a href="index.php">Accueil</a></li>
	<?php if(!isset($_SESSION['user']))
			{ 
	?>
		
		<li><?php include("connexion.php"); ?></li>
		<li><a href="inscription.php">Inscription</a></li>
	<?php   }
		else
		{	
	?>
		<li><a href="profil.php?p=<?=$_SESSION['user']->id()?>">Profil</a></li>
		<li><a href="index.php?deco=true">Deconnexion</a></li>
	<?php
		}

	?>
		
		 


	</ul>
</header>