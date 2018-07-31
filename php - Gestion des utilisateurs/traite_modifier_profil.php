<!DOCTYPE html>
<html>
  <head>
     <title>Insertion donn&eacute;es</title>
     <meta charset="utf-8" />
  </head>
     <body>
	<?php
        include "session.php";
	    require("connecto.php");
	    $conn=mysqli_connect($host,$user,$passwd,$db);
	    mysqli_select_db($conn,$db) or die ("Base de Donnee introuvale");
	/*	if ( (isset($_POST['nomUtilisateur'])) && (strlen(trim($_POST['nomUtilisateur'])) > 0) )
		 {
       			 $identifiant= stripslashes(strip_tags($_POST['nomUtilisateur']));
  		 }
		 else
		 {
        		echo "Merci d'��crire un nom d'utilisateur valide <br />";
       			$identifiant = "";
		 }*/
		$le_prenom=$_POST['le_prenom'];
		$le_nom=$_POST['le_nom'];
		$programme=$_POST['programeUtil'];
		$email=$_POST['email'];
		$identifiant=$_POST['nomUtilisateur'];
		
		//verifions si le courriel ou le nom utilisateur a deja ete utilise
		$id_existe=mysqli_query($conn,"select * from t_utilisateurs where (u_login='".$identifiant."' and u_id != '".$_SESSION['u_id']."') ");
		//verifions email
		$email_existe=mysqli_query($conn,"select * from t_utilisateurs where (u_login='".$identifiant."' and u_id != '".$_SESSION['u_id']."') ");

		if(($rd=mysqli_fetch_array($id_existe,MYSQLI_NUM)))
		{
			die("nom utilisateur existe deja!<a href='modifier_profile.php'>revenir au formulaire de modification.</a>");
		}
		else if(($rc=mysqli_fetch_array($email_existe,MYSQLI_NUM)))
		{
			die("Ce courriel existe deja existe deja!<a href='modifier_profile.php'>revenir au formulaire de modification.</a>");
		}
		
		if ( (empty($identifiant)) || (empty($le_prenom)) || (empty($le_nom)) || (empty($email))|| (!filter_var($email, FILTER_VALIDATE_EMAIL))  ) 
		{
       			 echo 'echec lors du remplissage du formulaire :( <br /><a href="modifier_profile.php">Retour au formulaire de modification</a>';
    		} 
		//modifions les informations
		else 
		{
     
    		$password=sha1($_POST['password']);//crypter mot de passe
			$date=date("Y-m-d");
			$groupe="sd";
			$requete_sql="UPDATE t_utilisateurs SET u_passe='$password',u_login='$identifiant',u_nom='$le_nom',u_prenom='$le_prenom',u_courriel='$email',u_programme='$programme' WHERE t_utilisateurs.u_id = '$_SESSION[u_id]' ";
			$resultat=mysqli_query($conn,$requete_sql);
			if($resultat == false)
			{
				echo "il y a eu un probleme pendant l'enregistrement de votre modification
                                dans la base de donnee, contacter l'admin par courriel" . PHP_EOL;
			}	
			else
			{
				echo " Modification soumise.</a>" . PHP_EOL;
			}
		}
					mysqli_close($conn);

	?>

     </body>
</html>
