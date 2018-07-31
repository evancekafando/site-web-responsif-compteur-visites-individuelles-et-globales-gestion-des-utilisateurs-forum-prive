<?php
include"session.php"
?>

<?Php
require("connecto.php");
$con = mysqli_connect($host, $user, $passwd, $db);
if(!$con)
{ 
	die('Erreur de connexion : ' . mysqli_error($con)); 
}

mysqli_select_db($con, $db);

$input = $_POST['input'];
$password  = sha1($_POST['password']);

if(!stristr($input,"@") OR !stristr($input,"."))
	{
		$user_id = $input;
			$query = "SELECT u_courriel,u_login,u_passe,u_id FROM t_utilisateurs WHERE t_utilisateurs.u_login= '$user_id'";
		$records =  mysqli_query($con,$query);
		
		if (($rcd = mysqli_fetch_array($records, MYSQLI_NUM)) ==0) 
		{
			echo "1";
			/*echo "<center><font face='Verdana' size='2' color=red><b>Identifiant invalide</b><br>
			D&eacute;sol&eacute; votre identifiant n'est pas enregistr&eacute; dans notre base de donn&eacute;es. Vous pouvez cr&eacute;er un compte gratuitement et vous connecter pour utiliser notre site. 
			<BR><BR><a href='signup.php'> Cr&eacute;er un compte </a> </center>";*/
			exit; 
		}

		$_query = mysqli_query($con,"SELECT u_courriel,u_login,u_passe,u_id FROM t_utilisateurs WHERE t_utilisateurs.u_login= '$user_id'");
		$row = mysqli_fetch_row($_query);

			if ($row[2]==$password) 
			{
			//	echo " Inside ";
				// Start session n redirect to last page
				$_SESSION['id']=session_id();
				$_SESSION['u_login']=$row[1];
				$_SESSION['u_id']=$row[3];
			//	echo "1";
			/*	if(empty($_SESSION['id']))
				{*/
				 				/*}*/
					$msg="<center><font face='Verdana' size='2' color=green>Bonjour, $_SESSION[u_login] . <a href=modifier_profile.php>Modifier Profile</a> . <a href=logout.php>se déconnecter</a></font></center>";
				//session_start();
				echo $msg;
			/*	echo '<script>
	 					window.location.assign("Bienvenue.php")
					  </script>';*/
				/*echo "<script language='JavaScript' type='text/JavaScript'>
				<!--window.location='welcome.php';//-->
				</script>";*/
			}
			else
			{
			//	$msg = " Login failed, tray again ... <br><INPUT TYPE='button' VALUE='Back' onClick='history.go(-1);'>";
				echo"1";
			}
	}
else
{
	
		$courriel = $input;


		$query = "SELECT u_courriel,u_login,u_passe,u_id FROM t_utilisateurs WHERE t_utilisateurs.u_courriel = '$courriel'";
		$records =  mysqli_query($con,$query);
		
		if (!($rcd = mysqli_fetch_array($records, MYSQLI_NUM))) 
		{
				echo "1";
		/*	echo "<center><font face='Verdana' size='2' color=red><b>Adresse courrielle invalide</b><br>
			D&eacute;sol&eacute; votre adresse courrielle n'est pas enregistr&eacutee; dans notre base de donn&eacute;es. Vous pouvez cr&eacute;er un compte gratuitement et vous connecter pour utiliser notre site. 
			<BR><BR><a href='signup.php'> Cr&eacute;er un compte </a> </center>";*/
			exit; 
		}

		$_query = mysqli_query($con,"SELECT u_courriel,u_login,u_passe,u_id FROM t_utilisateurs WHERE t_utilisateurs.u_courriel = '$courriel'");
		$row = mysqli_fetch_row($_query);

			if ($row[2]==$password) 
			{
				echo " Inside ";
				// Start session n redirect to last page
				$_SESSION['id']=session_id();
				$_SESSION['u_login']=$row[1];
				$_SESSION['u_id']=$row[3];
				$msg="<center><font face='Verdana' size='2' color=green>Bonjour, $_SESSION[u_login] . <a href=modifier_profile.php>Update Profile</a> . <a href=logout.php>Logout</a></font></center>";
				echo $msg;

				
			}
			else
			{
			//	$msg = " Login failed, tray again ... <br><INPUT TYPE='button' VALUE='Back' onClick='history.go(-1);'>";
					echo "1";
			}
	
}


mysqli_close($con);

?>
