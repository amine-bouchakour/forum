<?php 
	include("class-fonction.php");
	session_start();
	if(isset($_GET['deco']))
	{
		unset($_SESSION['user']);
		header("location: index.php");
	}
	if(isset($_POST['newtop']))
	{
		$type;
		switch ($_POST['type']) {
			case 'p':
				$type=0;
				break;
			case 'm':
				$type=1;
				break;
			case 'a':
				$type=2;
				break;
			
			default:
				$type=$_SESSION->stat();
				break;
		}
		sql("INSERT INTO topic (nom, status,id_user)VALUES ('".$_POST['titre']."',".$type." ,".$_SESSION['user']->id().")");
	}
	$listop=sql("SELECT * FROM `topic`");
?>
<!DOCTYPE html>
<html>
<head>
 
	<title>Accueil</title>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=GFS+Neohellenic&display=swap" rel="stylesheet">
</head>
<body>

<?php include("header.php");?>
	
<main>
		<h1 >Liste des topic</h1>
	
		<?php
			
			if(isset($_SESSION['user'])&&$_SESSION['user']->stat()>0)
			{
		?>
		<h1>Nouveau topic</h1>
		
		<form class="tete" method="post" action="index.php">
			<label>Titre du topic:</label><input type="text" name="titre">
			<label>Niveau de Privilege :</label>
			<select  name="type">
        		<option value="p">tout le monde</option>
        		<option value="m">moderateur et admin</option>
        	<?php if($_SESSION['user']->stat()>1)
        			{ 
        				?>
        		<option value="a">admin uniquement</option>
        			<?php } ?>
     		</select>
			<input type="submit" name="newtop">
		</form>
		<br>


				<?php
			}
		foreach ($listop as $top) 
			{
				$cont=sql("SELECT COUNT(*) FROM  conversation WHERE id_topic=".$top[0]." ;");
				$st;
				switch ($top[2]) 
				{
					case 0:
						$st="tout public";
						break;
					case 1:
						$st="modérateur";
						break;
					case 2:
						$st="admin uniquement";
						break;
					default:
						$st="inconue";
						break;
				}
				?>

			<section class="sectionmessage backmessage">
				<table class="topi">
					<tr>
						<article>
							<td class="topic0">
								<div>
									<a href="topic.php?t=<?=$top[0]?>"> <?=$top[1]?></a>
								</div>
							</td>
						</article>

						<article>
							<td class="topic1">
								<div>
									 <div class="sstopic1">
										<p></p>
									</div> 
								
									<div class="sstopic2"> 
										<p> nombre de conversation : <?=$cont[0][0] ?></p>
									</div>
								</div>
							</td>
						</article>

						<article>
							<td class="topic0">
								<div>
									<p>public :	<?=$st?></p>
								</div>
							</td>
						</article>
					</tr>
				</table>

			</section>

				
			<?php
			}
		?>
		</section>

	</main>

</body>
</html>