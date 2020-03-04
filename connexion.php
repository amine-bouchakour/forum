<?php 
		if(isset($_POST['con']))
		{
			$user = new user;
			if($user->connexion($_POST['login'],$_POST['password'])==true)
			{
				$_SESSION['user']=$user;
				header("location: ".$_SERVER['HTTP_REFERER']);
			}
			else
			{
				$err="mdp ou login incorect";
			}

			 
		}
		if(isset($_SESSION['user']))
		{
			echo"conécté";
		}
		else
		{
?>

<form class="formco" method="post">
	<input type="text" name="login" placeholder="login">
	<input type="password" name="password" placeholder="password">
	<input type="submit" name="con">
	<?php 
	if(isset($err))
	{
		echo "<b id=\"err_con\">".$err."</b>";
	}
	?>
</form>
<?php
		}
?>