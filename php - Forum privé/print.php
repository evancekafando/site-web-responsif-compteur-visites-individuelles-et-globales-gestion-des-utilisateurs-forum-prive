<?php
	require("header.php") ;

	$page = 1;
	$fil_id = 1;

	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
	}

	if (isset($_GET["fil_id"])) 
	{
		$fil_id = $_GET["fil_id"];
	}
	
	echo '
	<table class="table table-striped">
        <thead>
          <tr>
            <th>Auteur</th>
            <th>Message</th>
          </tr>
        </thead>
        <tbody id="messages">';

    // on affiche la liste des message poster dans ce fil de discussion précis
    //retrive_forum($fil_id,$page);
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

										echo "<td><table> <tr>
											<td style = 'width:90%' > <pre>".$u_message."</pre> </td>";

										// si admin
										echo "<td style = 'padding:2%'>
												
												<input type='checkbox' value='$forum_id' />
											
											</td>";
											
											echo " </tr> </table> </td>";
								
								echo "</tr>";
							}
			 			}
			 		}

 		echo ' </tbody>
      </table>';
?>