<?php session_start();

	// main usefull functions implemented here
	include_once("db_connection.php"); // on recupere les infos de la bd
	include("login_modal.php");

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

	//**************

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

	// pour afficher l'entete du panel
	function panel_heading($titre) 
	{
		global $modal;
		echo '<h2>'.$titre.'</h2>';
			
		echo '<div class="row">
			
				<div class="col-xs-6">
					<a href="fils.php"><span class="glyphicon glyphicon-home"></span></a>
				</div>
			
				<div class="col-xs-6 r-glyph">';
						
					if(isset($_SESSION['curr_u_id']))
					{
						echo '<span style="margin-right: 3%;">'.get_u_login($_SESSION["curr_u_id"]).'</span>';
						
						if (isset($_SESSION["role"]) and $_SESSION["role"] == "ad") 
						{
							echo '<a href="admin.php"><span style="margin-right: 3%;">admin</span></a>';
						}
						
						echo '<a href="admin/logout.php"><span class="glyphicon glyphicon-log-out"></span></a>';
					}
					else 
					{
						echo '<span style="margin-right: 3%;">Guest</span>';
						echo '<a href="loginHtml.php">
						<button type="button" class="btn btn-link" id="myBtn">
							<span class="glyphicon glyphicon-log-in"></span>
						</button></a>';
					}
		echo	'</div>
		
			</div>';
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

	//**************

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
	function retrive_fils($page)
	{
		global $connectionDB;
		$num_rec_per_page=6;
		$start_from = ($page-1) * $num_rec_per_page;
		$sqlReq = "SELECT fil_id, fil_titre, fil_creation FROM t_fils LIMIT $start_from, $num_rec_per_page";
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

	function login($u_login, $u_pwd)
    {
    	global $connectionDB;

    	$sqlReq = "SELECT u_id FROM t_utilisateurs WHERE u_login ='".$u_login."'";
		$reqReponse = mysqli_query($connectionDB,$sqlReq);
		if ($reqReponse)
		{
			if (mysqli_num_rows($reqReponse) > 0)	// le login existe dans la db
 			{
				$dataRecieved = mysqli_fetch_assoc($reqReponse);
				$u_id = $dataRecieved["u_id"];
				$fil_id = 1;

				$sqlReqPwd = "SELECT u_passe, u_role FROM t_utilisateurs WHERE u_id =".$u_id."";
				$reqReponsePwd = mysqli_query($connectionDB,$sqlReqPwd);
				if ($reqReponsePwd)
				{
					$dataRecievedPwd = mysqli_fetch_assoc($reqReponsePwd);
					if ($dataRecievedPwd["u_passe"] == $u_pwd) //password correct
					{
						$_SESSION['curr_u_id'] = $u_id;
						$_SESSION['role'] = $dataRecievedPwd["u_role"];
						$link = "fils.php";
						
						if (isset($_SESSION['curr_fil_id'])) 
						{
							$fil_id = $_SESSION["curr_fil_id"];
						}
						
				    	if ($_SESSION['role'] == "ad") 
				    	{
				    		$link = 'admin.php';
				    	}
				    	else
				    	{
				    		$link = 'forum.php?fil_id='.$fil_id.'';
				    	}

						// ajouter le message deja entre par le user avant la connection
						if (isset($_SESSION['message'])) 
						{	
							$sqlReqF = "SELECT MAX(forum_id) AS forum_id FROM t_forum";
				    		$reqReponseF =  mysqli_query($connectionDB,$sqlReqF);
				    		if ($reqReponseF)
				    		{
				    			if (mysqli_num_rows($reqReponseF) > 0)
				    			{
				    				$dataRecievedF = mysqli_fetch_assoc($reqReponseF);
				    				$forum_id = $dataRecievedF["forum_id"];
				    				$forum_id += 1;
				    				$u_message = $_SESSION['message'];

				    				$insertSqlReq = 'INSERT INTO t_forum VALUES ('.$forum_id.','.$u_id.','.$fil_id.',"'.$u_message.'",now())';
				    				$insertReqReponse = mysqli_query($connectionDB,$insertSqlReq);
				    				if ($insertReqReponse)
				    				{
				    					// Correct insertion
				    					header("location: forum.php?fil_id=".$fil_id."");
				    				}
					            	else
					            	{
					            		echo 'An error occurred while inserting into the DB';
					            	}
					    		}
					        	else
					          	{
					          		echo 'An error occurred while getting the last forum_id';
				          		}
							}
						}
						else 
						{
							// redirect vers 
							header('location: '.$link.'');
						}
					}
					else 	// wrong  passwd
					{
				    	header("location: loginHtml.php?err_not_login=Mot de passe ou username incorrect!");
					}
				}	
			}
			else 	// wrong login
			{
				header("location: loginHtml.php?err_not_login=Mot de passe ou username incorrect!");
			}
    	}
    }

	function retrive_forum($fil_id,$page)
	{
		global $connectionDB;
		$num_rec_per_page=6;
		$start_from = ($page-1) * $num_rec_per_page;
		$sqlReq = "SELECT u_id, u_message, u_date, forum_id FROM t_forum WHERE fil_id=".$fil_id." LIMIT $start_from, $num_rec_per_page";
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
					$forum_id = $dataRecieved["forum_id"];

					echo "<tr>";

				      echo "<td>";
								echo "<a>".get_u_login($u_id)."</a>";
							echo "</td>";

							/*if (isset($_SESSION['role']) and $_SESSION['role'] == "ad")
							{
								echo "<td><table> <tr>
									<td style = 'width:90%' > <pre>".$u_message."</pre> </td>";

								// si admin
								echo "<td style = 'padding:2%'><a href='#'>
										
										<input type='checkbox' value='$forum_id' />
									
									</a> </td>";
									
									echo " </tr> </table> </td>";
							}
							else
							{*/
								echo "<td>";
									echo "Posté le <b>".date_format($u_date, 'd M Y à H:i')."</b><br/>";
									echo "<pre>".$u_message."</pre>";
								echo "</td>";

								echo "</tr>";
							//}
							echo "</tr>";
				}
 			}
 		}

	}

	function pager($table_name, $page, $fil_id)
  {
    global $connectionDB;


		if ($table_name == "t_forum")
		{
			$link = "forum.php?fil_id=".$fil_id."&page=";
			$sql = "SELECT * FROM ".$table_name." WHERE fil_id=".$fil_id."";
		}
		elseif ($table_name == "t_fils")
		{
			$link = "fils.php?page=";
			  $sql = "SELECT * FROM ".$table_name."";
		}

		$num_rec_per_page = 6;
  	$rs_result = mysqli_query($connectionDB,$sql);
  	$total_records = mysqli_num_rows($rs_result);
  	$total_pages = ceil($total_records / $num_rec_per_page);
  	echo '<ul class="pagination">';
  	$points = false;
  	for ($i=1; $i<=$total_pages; $i++)
  	{
  		if ($i <= 5)
  		{
  			if ($i == $page)
  			{
  				echo "<li class='active'><a href='".$link."".$i."'>".$i."</a> </li>";
  			}
  			else
  			{
					echo "<li><a href='".$link."".$i."'>".$i."</a> </li>";
  			}
  		}
  		else if($i == ($page - 1) OR $i == $page OR $i == ($page + 1))
  		{
  			if ($i == $page)
  			{
					echo "<li class='active'><a href='".$link."".$i."'>".$i."</a> </li>";
					//echo "<li class='active'><a href='../admin/update_amis.php?page=".$i."'>".$i."</a> </li>";
  			}
  			else
  			{
					echo "<li><a href='".$link."".$i."'>".$i."</a> </li>";
  				//echo "<li><a href='../admin/update_amis.php?page=".$i."'>".$i."</a> </li>";
  			}
  			$points = false;
  		}
  		else if($i >= ($total_pages - 4))
  		{
  			if ($i == $page)
  			{
					echo "<li class='active'><a href='".$link."".$i."'>".$i."</a> </li>";
  				//echo "<li class='active'><a href='../admin/update_amis.php?page=".$i."'>".$i."</a> </li>";
  			}
  			else
  			{
					echo "<li><a href='".$link."".$i."'>".$i."</a> </li>";
					//echo "<li><a href='../admin/update_amis.php?page=".$i."'>".$i."</a> </li>";
  			}
  		}
  		else if(!$points)
  		{
  		    $points = true;
  		    if ($i == $page)
  			{
					echo "<li class='active'><a href='".$link."".$i."'>".$i."</a> </li>";
					//echo "<li class='active'><a href='../admin/update_amis.php?page=".$i."'>".$i."</a> </li>";
  			}
  			else
  			{
					echo "<li><a href='".$link."".$i."'>".$i."</a> </li>";
  				//echo "<li><a href='../admin/update_amis.php?page=".$i."'>...</a> </li>";
  			}
  		}
  	 }
  	 echo '</ul>';
    }
?>
