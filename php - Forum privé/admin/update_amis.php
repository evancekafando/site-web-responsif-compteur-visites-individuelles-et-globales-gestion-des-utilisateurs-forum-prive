<?php require("../anciens/header.php"); 
	if (!isset($_SESSION["privUser"]) || $_SESSION["privUser"] != "admin") {
		header("refresh:0; url=../admin/errorPage.php?_rsn=i_a");
		die();
	}
?>
<!-- Le centre de la page style="padding:1%; margin:1%;" -->
<div class="center_page_admn">
	<?php
		$num_rec_per_page=10;
		if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
		$start_from = ($page-1) * $num_rec_per_page;
		$sqlReq = "SELECT id_membre, nom, prenom, donation FROM t_amis ORDER BY nom ASC, prenom ASC LIMIT $start_from, $num_rec_per_page";
		$reqReponse = mysqli_query($connectionDB,$sqlReq); //mysql_query($connectionDB,$req) ;
		if (mysqli_num_rows($reqReponse) > 0)
		{
			echo '<table class="table-striped" align="center"; style="width:80%; text-align:center;">'.
					'<tr class="h_update_amis">'.
						'<td class="h_update_amis">Nom</td>'.
						'<td class="h_update_amis">Prénom</td>'.
						'<td class="h_update_amis">Donation</td>'.
					'</tr>'
				;
			while($dataRecieved = mysqli_fetch_assoc($reqReponse))
			{
				$id = $dataRecieved["id_membre"];
				$nom = $dataRecieved["nom"];
				$prenom = $dataRecieved["prenom"];
				$donation = $dataRecieved["donation"];
				echo '<tr>
						<td class="c_update_amis">
							'. $nom .'
						</td>
						<td class="c_update_amis">
							'. $prenom .'
						</td>
						<td class="c_update_amis">
							<textarea id="'.$id.'" onChange=\'return toUpdate('.$id.');\'>'. $donation .'</textarea>
						</td>
					</tr>';
			}
			echo '</table>';

			$sql = "SELECT * FROM t_amis";
			$rs_result = mysqli_query($connectionDB,$sql);
			$total_records = mysqli_num_rows($rs_result);
			$total_pages = ceil($total_records / $num_rec_per_page);
			echo '<div id="pagination"><ul class="pagination">';
			$points = false;
			for ($i=1; $i<=$total_pages; $i++)
			{
				if ($i <= 5)
				{
					if ($i == $page)
					{
						echo "<li class='active'><a href='../admin/update_amis.php?page=".$i."'>".$i."</a> </li>";
					}
					else
					{
						echo "<li><a href='../admin/update_amis.php?page=".$i."'>".$i."</a> </li>";
					}
				}
				else if($i == ($page - 1) OR $i == $page OR $i == ($page + 1))
				{
					if ($i == $page)
					{
						echo "<li class='active'><a href='../admin/update_amis.php?page=".$i."'>".$i."</a> </li>";
					}
					else
					{
						echo "<li><a href='../admin/update_amis.php?page=".$i."'>".$i."</a> </li>";
					}
					$points = false;
				}
				else if($i >= ($total_pages - 4))
				{
					if ($i == $page)
					{
						echo "<li class='active'><a href='../admin/update_amis.php?page=".$i."'>".$i."</a> </li>";
					}
					else
					{
						echo "<li><a href='../admin/update_amis.php?page=".$i."'>".$i."</a> </li>";
					}
				}
				else if(!$points)
				{
				    $points = true;
				    if ($i == $page)
					{
						echo "<li class='active'><a href='../admin/update_amis.php?page=".$i."'>".$i."</a> </li>";
					}
					else
					{
						echo "<li><a href='../admin/update_amis.php?page=".$i."'>...</a> </li>";
					}
				}
			}
			echo '</ul></div>';
		}
		else
		{
			display_error_msg("PAS DE RESULTAT!");
			echo '<div class="ret_arriere">
					<a href="../admin/update_amis.php">Revenir en arrière</a>
				</div>';
		}
	?>
</div>
<?php require("../anciens/footer.php"); ?>
