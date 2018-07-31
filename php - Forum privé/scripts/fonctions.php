<?php session_start();

	// main usefull functions implemented here
	include_once("db_connection.php"); // on recupere les infos de la bd

	function retrive_rep_nbre($id_fil)
	{
		global $connectionDB;
		$nbre_rep;

		$sqlReq = "SELECT COUNT(forum_id) AS nbre_rep FROM t_forum WHERE fil_id =".$id_fil."";
		$reqReponse = mysqli_query($connectionDB,$sqlReq);
		if ($reqReponse)
		{
			if (mysqli_num_rows($reqReponse) > 0)
			{
				$dataRecieved = mysqli_fetch_assoc($reqReponse);
				$nbre_rep = $dataRecieved["nbre_rep"];
			}
		}
		return $nbre_rep;
	}

	function get_u_login($u_id)
	{
		global $connectionDB;

		$sqlReq = "SELECT u_login FROM t_utilisateurs WHERE u_id =".$u_id."";
		$reqReponse = mysqli_query($connectionDB,$sqlReq);
		if ($reqReponse)
		{
			if (mysqli_num_rows($reqReponse) > 0)
			{
				$dataRecieved = mysqli_fetch_assoc($reqReponse);
				$u_login = $dataRecieved["u_login"];
				echo "".$u_login."";
			}
		}
	}

	// Obtenir le titre d'un fil de discution
	function get_title($fil_id)
	{
		global $connectionDB ; // connection à la DB
		$result = "" ; // resultat de la recherche

		$sqlReq = "SELECT fil_titre FROM t_fils WHERE fil_id =".$fil_id."";
		$reqReponse = mysqli_query($connectionDB,$sqlReq);
		if ($reqReponse)
		{
			if (mysqli_num_rows($reqReponse) > 0)
			{
				$dataRecieved = mysqli_fetch_assoc($reqReponse);
				$resultat = $dataRecieved["fil_titre"];
			}

		}

		return $resultat;

	}

	// Initialiser titre d'un forum
	function set_title($fil_id, $newTitle)
	{
		global $connectionDB ; // connection à la DB
		// Mise à jour du titre du fiL

		$sqlReq = "UPDATE t_fils SET fil_titre ='".$newTitle."' WHERE fil_id =" .$fil_id. "";
		$reqReponse = mysqli_query($connectionDB,$sqlReq);
		echo "$newTitle" ;
	}

	function retrive_last_msg($id_fil)
	{
		global $connectionDB;
		$last_username_id;
		$last_u_date;
		$sqlReq = "SELECT u_id, u_date FROM t_forum WHERE fil_id=".$id_fil." AND u_date IN (SELECT MAX(u_date) FROM t_forum WHERE fil_id=".$id_fil.")";

		$reqReponse = mysqli_query($connectionDB,$sqlReq);
 		if ($reqReponse)
 		{
 			if (mysqli_num_rows($reqReponse) > 0)
 			{
 				$dataRecieved = mysqli_fetch_assoc($reqReponse);
				$last_u_date = date_create($dataRecieved["u_date"]);
				$last_username_id = $dataRecieved["u_id"];

				echo "<br/>".get_u_login($last_username_id)."";
				echo "".date_format($last_u_date, 'd M Y à H:i')."";
 			}
			else
			{
					echo "Pas de message posté";
			}
 		}
	}

	// recupere la liste des fils de discussion avec le nombre de reponse et le dernier message
	function retrive_fils()
	{
		global $connectionDB;
		$sqlReq = "SELECT fil_id, fil_titre, fil_creation FROM t_fils";
		$reqReponse = mysqli_query($connectionDB,$sqlReq);
		if ($reqReponse)
		{
			if (mysqli_num_rows($reqReponse) > 0)
			{
				while($dataRecieved = mysqli_fetch_assoc($reqReponse))
				{
					$fil_titre = $dataRecieved["fil_titre"];
					$fil_creation = date_create($dataRecieved["fil_creation"]);
					$fil_id = $dataRecieved["fil_id"];

					echo "<tr>";

			      echo "<td>";
							echo "<a href='forum.php?fil_id=".$fil_id."'>".$fil_titre."</a>";
							echo "<br/> Créé le ".date_format($fil_creation, 'd M Y à H:i')."";
						echo "</td>";

						echo "<td>";
							echo "".retrive_rep_nbre($fil_id)."";
						echo "</td>";

						echo "<td>";
							echo "".retrive_last_msg($fil_id)."";
						echo "</td>";

					echo "</tr>";
				}
			}
		}
	}

	function retrive_forum($fil_id)
	{
		global $connectionDB;

		$sqlReq = "SELECT u_id, u_message, u_date FROM t_forum WHERE fil_id=".$fil_id."";
		$reqReponse = mysqli_query($connectionDB,$sqlReq);
 		if ($reqReponse)
 		{
 			if (mysqli_num_rows($reqReponse) > 0)
 			{
				while($dataRecieved = mysqli_fetch_assoc($reqReponse))
				{
	 				$u_id = $dataRecieved["u_id"];
					$u_message = $dataRecieved["u_message"];
					$u_date = date_create($dataRecieved["u_date"]);

					echo "<tr>";

			      echo "<td>";
							echo "<a>".get_u_login($u_id)."</a>";
						echo "</td>";

						echo "<td>";
							echo "Posté le <b>".date_format($u_date, 'd M Y à H:i')."</b><br/>";
							echo "<table> <tr>
								<td style = 'width:90%' > <pre>".$u_message."</pre> </td>";

							// si admin
							echo "<td style = 'padding:2%'><a href='#'>
										<span class='glyphicon glyphicon-trash'></span>
								</a> </td>";
						echo " </tr> </table> </td>";

					echo "</tr>";

				}
 			}
 		}

	}

?>
