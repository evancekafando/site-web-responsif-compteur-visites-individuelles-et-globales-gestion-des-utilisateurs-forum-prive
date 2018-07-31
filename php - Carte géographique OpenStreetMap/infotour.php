

<!DOCTYPE html>
<html>
  <head>
    <title>Script PHP</title>
    <meta charset="utf-8" />
  </head>

 <body>
   <?php 
      require("connexion.php");
	  // Si la variable tour est défini
      if (isset($_GET['tour'])){
		  $nom = $_GET['tour'];
		  $conn = mysqli_connect($host, $user, $passwd, $db);
		  mysqli_select_db($conn, $db) or die("Unable to select db $db");
		  //Requete qui trouve tous les noms de tours de la base de donner
		  $requete = "SELECT * FROM t_lieux WHERE nom ='".$nom."'";
		  $tuples = mysqli_query($conn,$requete); // devrait seulement retourner 1 valeur.
		  $row = mysqli_fetch_array($tuples);   
		  //afficher tous l'info the la tour dans une table html.
		  echo "<table cellspacing='2' cellpadding='1' border='1' align='left'>";
		  echo "<tr><td>Nom </td><td id=nom>",$row["nom"],"</td></tr>";
		  echo "<tr><td>Ville </td><td id=ville>",$row["ville"],"</td></tr>";
		  echo "<tr><td>Pays </td><td id=pays>",$row["pays"],"</td></tr>";
		  echo "<tr><td>Lng </td><td id=lng>",$row["lng"],"</td></tr>";
		  echo "<tr><td>Lat </td><td id=lat>",$row["lat"],"</td></tr>";
		  echo "<tr><td>Alt </td><td id=alt>",$row["alt"],"</td></tr>";
		  echo"</table>";
		  mysqli_close($conn);  
	  }
 	  else
		ECHO "Problemde connextion"
  ?>
  </body>
</html>
