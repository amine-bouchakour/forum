<?php function sql($sql)
{
	$bd=mysqli_connect("localhost","root","","forum");
	$envoit=mysqli_query($bd,$sql);
	if($sql[0]=="S"||$sql[0]=="s")
	{	
		$reception = mysqli_fetch_all($envoit);
		mysqli_close($bd);
		return $reception;
	}
	mysqli_close($bd);	
}

function chiffre($mdp)
{	
	$mdp=hash('sha512', $mdp);
	$mdp= "me".$mdp."andyourmama";
	$mdp=hash('sha256', $mdp);
	return $mdp;
}
 

class user
{
	private $id;
	private $login;
	private $dateinsc;
	private $type;

	public function connexion($login,$psw)
	{
		$psw=chiffre($psw);
		$tab=sql("SELECT * FROM user WHERE login='".$login."'&& password='".$psw."';");
		if(!empty($tab))
		{
			$this->id=$tab[0][0];
			$this->login=$tab[0][1];
			$this->dateinsc=$tab[0][3];
			$this->type=$tab[0][4];
			return true;
		}
		else
		{
			return false;
		}
	}

	public function stat()
	{
		return $this->type;
	}
	public function id()
	{
		return $this->id;
	}
	public function login()
	{
		return $this->login;
	}
	public function newlogin($login)
	{
		$this->login=$login;
	}
}
?>