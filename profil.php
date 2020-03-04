<?php 
	include("class-fonction.php");
	
	session_start();
	if(!isset($_SESSION['user']))
	{
		header("location: ".$_SERVER['HTTP_REFERER']);
	}
	if(isset($_SESSION['user'])&&$_SESSION['user']->id()==$_GET['p'])
	{
		if (isset($_POST['modif']))
		{
			$veriflog=sql("SELECT * FROM user WHERE login='".$_POST['login']."'");
			if(empty($veriflog)&&!empty($_POST['login'])&&$_POST['login']!=$_SESSION['user']->login())
			{
				sql("UPDATE `user` SET `login` = '".$_POST['login']."' WHERE `user`.`id` = ".$_SESSION['user']->id().";");
				$_SESSION['user']->newlogin($_POST['login']);
			}
			echo "SELECT password FROM user WHERE id=".$_SESSION['user']->id().";";
			$psw=sql("SELECT password FROM user WHERE id=".$_SESSION['user']->id()."");
			if(chiffre($_POST['psw'])==$psw[0][0])
			{
				if($_POST['newpsw']==$_POST['confpsw'])
				{
					$newpsw=chiffre($_POST['newpsw']);
					sql("UPDATE `user` SET `password` = '".$newpsw."' WHERE `user`.`id` = ".$_SESSION['user']->id().";");
				}
				else
				{
					$err="nouveau mot de passe et confirmation différente";
				}				
			}
			else
			{
				$err="mot de passe incorect";
			}	
		}
	}


	if($_SESSION['user']->stat()==2 && isset($_POST))
	{
		if(isset($_POST['sup']))
		{
			sql("DELETE FROM `user` WHERE id=".$_GET['p'].";");
		}
		if(isset($_POST['changestat']))
		{
			$type;
			switch ($_POST['type']) 
			{
				case "p":
					$type=0;
					break;
				case "m":
					$type=1;
				break;
				case "a":
					$type=2;
					break;
				default:
					$type=0;
					break;
			}
			sql("UPDATE `user` SET `status` = '".$type."' WHERE `user`.`id` = ".$_GET['p'].";");
		}
	}

	$profil=sql("SELECT * FROM user WHERE id=".$_GET['p'].";");
	if(empty($profil))
	{
		header("location: index.php");
	}
	$nbmsg=sql("SELECT COUNT(*) FROM message WHERE id_user=".$_GET['p'].";");
	switch ($profil[0][4]) 
	{
		case 0:
			$profil[0][4]="random";
			break;
		case 1:
			$profil[0][4]="modérateur";
			break;
		case 2:
			$profil[0][4]="administrateur";
			break;
		default:
			$profil[0][4]="mysterieux";
			break;
	}
?>
<!DOCTYPE html>
<html>
<head>

	<title>profil</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php include("header.php");?>
	<main class="prof">
		
		<?php 

			if($_SESSION['user']->id()==$_GET['p'])
			{
		?>	<section class="prof">
			<form class="prof2" method="post" action="profil.php?p=<?=$_GET['p']?>">
				<label>Login :</label><input type="text" name="login" value="<?=$profil[0][1]?>">
				<label>Modifier mots de passe :</label><input type="password" name="psw" placeholder="votre mot de passe actuel">
				<input type="password" name="newpsw" placeholder="nouveau mot de passe">
				<input type="password" name="confpsw" placeholder="confirmation mot de passe">
				<input type="submit" name="modif">
			</form>
			</section>
		<?php
			}
			else
			{
		?> 
			<section class="prof">
				<p>Login : <?=$profil[0][1]?></p>
				
		<?php		
			}			
		?>
		<hr>
				<p>Date d'inscription : <?=$profil[0][3]?></p>
				<p>Nombre de message posté : <?=$nbmsg[0][0]?></p>
				<p>Status : <?=$profil[0][4]?></p>
		<?php
			if ($_SESSION['user']->stat()==2) 
			{
		?>
			<form class="prof1" method="post" action="profil.php?p=<?=$_GET['p']?>">
				<label>Changer status :</label><select  name="type">
        			<option value="p">Normal</option><br>
        			<option value="m">Moderateur</option><br>
        			<option value="a">Admin</option><br>
     				</select>
     			<input type="submit" name="changestat">
			</form>
			<form method="post" action="profil.php?p=<?=$_GET['p']?>">
				<label>Supprimer l'utilisateur :</label>
     			<input type="submit" name="sup">
			</form>
		<?php
			}
		?>
			</section>
	</main>
</body>