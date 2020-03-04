<?php 
	include("class-fonction.php");
	session_start();
	if(isset($_POST['insc']))
	{	if(!empty($_POST['login'])&&!empty($_POST['password'])&&!empty($_POST['repassword']))
		{
			$veriflog=sql("SELECT * FROM user WHERE login='".$_POST['login']."'");
			if(empty($veriflog))
			{
				if($_POST['password']==$_POST['repassword'])
				{	
					if($_POST['password']!=$_POST['login'])
					{
						$_POST['password']=chiffre($_POST['password']);
						sql("INSERT INTO user (login, password,date)VALUES ('".$_POST['login']."', '".$_POST['password']."', NOW())");
						header("location: index.php");
					}
					else
					{
						$err="le login et le mots de passe doivent étres différent";
					}
				}
				else
				{
					$err="mot de passe et confirme mots de passe différent";
				}
			
			}
			else
			{
				$err="login deja pris, éssayer ";
			}
		}
		else
		{
			$err="Hacker man";
		}
		
		 
		
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php include("header.php"); ?>
<main>
	<form class="forumcinsc" method="post" action="inscription.php">
		<input type="text" name="login" placeholder="login" required>
		<input type="password" name="password" placeholder="mot de passe" required>
		<input type="password" name="repassword" placeholder="confirmation mot de passe" required>
		<input type="submit" name="insc">
	</form>
	<?php
		if(isset($err))
		{
			echo $err;
		} 
	?>
	</main>
</body>
</html>