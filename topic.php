<?php 
	include("class-fonction.php");

	session_start();
	if(!isset($_SESSION['user'])||sql("SELECT status FROM topic WHERE id=".$_GET['t'].";")[0][0]>$_SESSION['user']->stat())
	{
		header("location: index.php");
	}
	if(isset($_POST['newconv']))
	{
		$type=0;
		if(isset($_POST['type']))
		{
			switch ($_POST['type']) 
			{
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
		}

		sql("INSERT INTO conversation (nom, id_topic,id_user,resum,status,date)VALUES ('".$_POST['titre']."',".$_GET['t'].",".$_SESSION['user']->id().",'".$_POST['texte']."',".$type.",now())");
	}

	$lisconv=sql("SELECT * FROM `conversation` WHERE id_topic=".$_GET['t'].";");

?>

<!DOCTYPE html>
<html>
	<head>
	<?php 
		$title=sql("SELECT nom FROM topic WHERE id=".$_GET['t'].";");
		?>	
		<title><?=$title[0][0]?></title>
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body> 

		<?php include("header.php");?>
		<main>
			<h1><u>Conversation :</u></h1>
			<?php
				
				if(isset($_SESSION['user']))
				{
			?>
			<h4>Nouvelle conversation</h4>
		<section class="sectiontopic1">
			
			<form class="prof1" method="post" action="topic.php?t=<?=$_GET['t']?>">
			
				<label>Titre du sujets :</label><input type="text" name="titre">
				<label>Résumé du sujet :</label><textarea name="texte"></textarea>

				<?php if($_SESSION['user']->stat()>0)
					{
				?>
				<label>Niveau de Privilege :</label>
					<select  name="type">
						<option value="p">Tout le monde</option>
						<option value="m">Moderateur et admin</option>
							<?php if($_SESSION['user']->stat()>1)
								{ 
							?>
						<option value="a">Admin uniquement</option>
							<?php } ?>
					</select>
				<?php }?>
				<input type="submit" name="newconv" id="normal">
			</form>
		</section>
		<hr>						
			<?php
				}
				
			foreach ($lisconv as $conv) 
				{
					$nbmsg=sql("SELECT COUNT(*) FROM message WHERE id_conversation=".$conv[0].";");
					$dermsg=sql("SELECT MAX(date) FROM message WHERE id_conversation=".$conv[0].";");
				?>


				<section class="sectiontopic">
					<table class="topi">
						<tr>
							<article>
									<td class="topic0">
										<div id="my-div">
											<a href="conversation.php?t=<?=$conv[0]?>"> <?=$conv[1]?></a>
										</div>
									</td>
							</article>

							<article>
									<td class="topic1">
									<div>
										<p> nombre de message : <?=$nbmsg[0][0]?><br>
									</div>
									</td>
							</article>

							<article>
									<td class="topic1">
										<div>
											<p>dernier message le : <?=$dermsg[0][0]?>
										</div>
									</td>
							</article>

						</tr>
					</table>

				</section>

				<?php
				}
			?>
		</main>

	</body>
</html>