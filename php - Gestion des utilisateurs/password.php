<?php
require "submit.php";
require ("connecto.php");
$con = mysqli_connect($host, $user, $passwd, $db);
if(!$con)
{ 
	die('Erreur de connexion : ' . mysqli_error($con)); 
}

mysqli_select_db($con, $db);

$input = $_POST['input'];
//$status = "not_ok";
//$login = ""; $courriel = "";

function CreeMotDePasse()
{   
  $chaine = "chaine utilisee pour le cryptage";
  $longueur = 8; // longueur d'encryptage
  $chaine = md5($chaine);
  $longchaine = strlen($chaine);
  srand((double)microtime()*1000000);
  $debut = rand(0, $longchaine-$longueur-1);
  $motdepasse = substr($chaine, $debut, $longueur);
  return $motdepasse;
  // print("Mot de passe propos&eacute; : <p><big>$motdepasse</big><p/>\n");
}


$pw = CreeMotDePasse();


if(!stristr($input,"@") OR !stristr($input,"."))
{
	$login = $input;
	$query = "SELECT * FROM t_utilisateurs WHERE t_utilisateurs.u_login = '$login'";
	$records =  mysqli_query($con,$query);
	
	if (!($rcd = mysqli_fetch_array($records, MYSQLI_NUM))) 
	{
		echo "<center><font face='Verdana' size='2' color=red><b>Identifiant invalide</b><br>
		D&eacute;sol&eacute; votre identifaiant n'est pas enregistr&eacute; dans notre base de donn&eacute;es. Vous pouvez cr&eacute;er un compte gratuitement et vous connecter pour utiliser notre site. 
		<BR><BR><a href='formulaire.html'> Cr&eacute;er un compte </a> </center>";
		exit; 
	}
	$crypter_mot_de_passe = sha1($pw);
	$_query = "UPDATE t_utilisateurs SET u_passe= '$crypter_mot_de_passe' WHERE t_utilisateurs.u_login = '$login' ";
    mysqli_query($con,$_query);

    $__query= mysqli_query($con,"SELECT u_prenom FROM t_utilisateurs WHERE t_utilisateurs.u_login = '$login' ")or die(mysqli_error($con));
    if (!$__query) 
    {
    	echo 'Could not run query: ' . mysqli_error($con);
    	exit;
	}
	$row = mysqli_fetch_row($__query);
    $prenom = ucfirst($row[0]);
    
    echo "<center><font face='Verdana' size='2' color=grey><b>Identifiant valide</b><br>
	Bonjour <span style='color:#00008b;'><big><strong> $prenom </strong></big></span> utilisez ce nouveau mot de passe :  <p><big>$pw</big><p/>pour vous connecter pour utiliser notre site. 
	<BR><BR><a href='login.php'> Se connecter </a> </center>";
	exit;
}

else
{
		$courriel = $input;
		$query = "SELECT u_courriel FROM t_utilisateurs WHERE t_utilisateurs.u_courriel = '$courriel'";
		$records = mysqli_query($con,$query);
		
		if (!($rcd = mysqli_fetch_array($records, MYSQLI_NUM)))
		{
			echo "<center><font face='Verdana' size='2' color=red><b>Adresse courrielle invalide</b><br>D&eacute;sol&eacute; votre adresse courrielle n\'est pas enregistr&eacute;e dans notre base de donn&eacute;es. Vous pouvez cr&eacute;er un compte gratuitement et vous connecter pour utiliser à notre site. <BR><BR><a href='formulaire.html'> Cr&eacute;er un compte. </a> </center>";
			exit; 
		}
        $crypter_mot_de_passe = sha1($pw);
	    mysqli_query($con,"UPDATE t_utilisateurs SET u_passe= '$crypter_mot_de_passe' WHERE t_utilisateurs.u_courriel = '$courriel' ");
       // mysqli_query($con,$__ulogin);

        $__query= mysqli_query($con,"SELECT u_prenom FROM t_utilisateurs WHERE t_utilisateurs.u_courriel= '$courriel' ")or die(mysqli_error($con));
	    if (!$__query) 
	    {
	    	echo 'Could not run query: ' . mysqli_error($con);
	    	exit;
		}
		$row = mysqli_fetch_row($__query);
	    $prenom = ucfirst($row[0]);
	    $msg= "<center><font face='Verdana' size='2' color=grey><b>Adresse courrielle valide</b><br>
		Bonjour <span style='color:#00008b;'><big><strong> $prenom </strong></big></span> utilisez ce nouveau mot de passe :  <p><big>$pw</big><p/>pour vous connecter et utiliser notre site. 
		<BR><BR><a href='login.php'> Se connecter </a> </center>";
		echo $msg;
		exit;

}

 mysqli_close($con);


?>



