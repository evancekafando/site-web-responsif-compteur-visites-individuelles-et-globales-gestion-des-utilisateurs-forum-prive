<?php
	require('header.php');

	global $connectionDB;

	if (isset($_SESSION['curr_u_id']))
	{
		if (isset($_POST['fil_titre']) and !(empty(trim($_POST['fil_titre']))))
		{
			$fil_titre = $_POST['fil_titre'];
			$sqlVerif = "SELECT COUNT(fil_titre) AS fil_titre FROM t_fils WHERE fil_titre='".$fil_titre."'";
			$reqVerif = mysqli_query($connectionDB,$sqlVerif);
			if ($reqVerif)
			{
				if (mysqli_num_rows($reqVerif) > 0)
				{
					$dataRecieved = mysqli_fetch_assoc($reqVerif);
					if ($dataRecieved["fil_titre"] == 0)
					{

						$sqlReq = "SELECT MAX(fil_id) AS fil_id FROM t_fils";
						$reqReponse = $reqReponse = mysqli_query($connectionDB,$sqlReq);
						if ($reqReponse)
						{
							if (mysqli_num_rows($reqReponse) > 0)
							{
								$dataRecieved = mysqli_fetch_assoc($reqReponse);
								$fil_id = $dataRecieved["fil_id"];
								$fil_id += 1;

								$insertSqlReq = 'INSERT INTO t_fils VALUES ('.$fil_id.',"'.$fil_titre.'",now())';
								$insertReqReponse = mysqli_query($connectionDB,$insertSqlReq);
								if ($insertReqReponse)
								{
									header("location: admin.php");
								}
							}
						}
					}
					else
					{
						header("location: fils.php");
					}

				}
			}
		}
	}

	require('footer.php');
?>
