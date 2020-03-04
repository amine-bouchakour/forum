<?php 
	include("class-fonction.php");

	session_start();

	if(isset($_POST['msg']))
	{
	
		sql("INSERT INTO message ( id_conversation,id_user,message,date)VALUES (".$_GET['t'].",".$_SESSION['user']->id().",'".$_POST['texte']."',now())");
	}

	if(isset($_SESSION['user']))
	{	
		if(isset($_GET['m'])&&isset($_GET['l']))
		{
			$testlike=sql("SELECT * FROM `likes` WHERE id_message=".$_GET['m']." && id_user=".$_SESSION['user']->id()." ;");
			if(empty($testlike))
			{
				if($_GET['l']=="like"||$_GET['l']=="dislike")
				{	
					$like=0;
					if($_GET['l']=="dislike")
					{
						$like=1;
					}
					sql("INSERT INTO likes ( id_user,id_message,type)VALUES (".$_SESSION['user']->id().",".$_GET['m'].",".$like.")");

				}
			}
			else
			{
				$like=0;
				if($_GET['l']=="dislike")
				{
					$like=1;
				}
				if ($testlike[0][3]==$like) 
				{
					sql("DELETE FROM `likes` WHERE `likes`.`id` = ".$testlike[0][0]." ");
				}
				else
				{
					sql("UPDATE `likes` SET `type` = '".$like."' WHERE `likes`.`id` = ".$testlike[0][0].";");
				}
			} 
			header("location:conversation.php?t=".$_GET['t']."");
		}
	}

	if(isset($_GET['d']))
	{
		if(isset($_SESSION['user'])&&$_SESSION['user']->stat()>0)
		{
			sql("DELETE FROM `message` WHERE `id` = ".$_GET['m']." ");
		}
	}

	$lisconv=sql("SELECT message.id,message,message.date,login,user.id FROM `message`INNER JOIN `user` ON user.id = message.id_user  WHERE id_conversation=".$_GET['t']." ORDER BY date;");
?>
<!DOCTYPE html>
<html>
<head>
<?php 
	$title=sql("SELECT nom,resum FROM `conversation` WHERE id=".$_GET['t'].";");
?>	

	<title><?=$title[0][0]?></title>
	<link rel="stylesheet" href="css/style.css">

</head>
<body>
	<?php include("header.php");?>
	<main>
	<section class="message sectionmessage">
<article class="titremessage">
		<h1>TITRE : <?=$title[0][0]?> </h1>
		<p>DESCRIPTION : <?=$title[0][1]?> </p>
		<?php
			foreach ($lisconv as $msg) 
			{
				$like=sql("SELECT count(*) FROM `likes` WHERE id_message=$msg[0] && type=0 ;");
				$dislike=sql("SELECT count(*) FROM `likes` WHERE id_message=$msg[0] && type=1 ;")
			?>
			</article>
			<article class="messageinside">
				<div>
					<b>Le <?=$msg[2]?>, <a href="profil.php?p=<?=$msg[4]?>"><?=ucfirst($msg[3])?>  </a>à écrit : </b> <br>
				</div>
				<div class="msg-div">
					<p><?=$msg[1]?></p>	
				</div>
				<div class="like-div">
					<b><a href="conversation.php?t=<?=$_GET['t']?>&m=<?=$msg[0]?>&l=like"><img class="like" src="img/like.png" /></a><?=$like[0][0]?></b>&nbsp
					<b><a href="conversation.php?t=<?=$_GET['t']?>&m=<?=$msg[0]?>&l=dislike"><img class="dislike" src="img/like.png" /></a><?=$dislike[0][0]?></b>
				</div>
				<?php
					if(isset($_SESSION['user'])&&$_SESSION['user']->stat()>0)
					{
				?>
					<a href="conversation.php?t=<?=$_GET['t']?>&m=<?=$msg[0]?>&d=true">suprimer le message</a>
				<?php
					}
				?>
			<?php
			}
			if(isset($_SESSION['user']))
			{
		?>
		</article>

<article class="envoimessage">
		
		<form method="post" action="conversation.php?t=<?=$_GET['t']?>">
		
			<label>votre message : <br></label><textarea name="texte"></textarea><br>

			<input type="submit" name="msg" value="Graver sur le marbre">
		</form>
</article>

		<?php
			}
			 
		
		?>
		</section>

	</main>

</body>
</html>