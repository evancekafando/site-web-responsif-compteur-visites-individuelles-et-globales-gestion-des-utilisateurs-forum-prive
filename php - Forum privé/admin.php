<?php
	require('header.php');
?>

<div class="container">

	<div class="panel panel-default">

		<div class="panel-heading">
			<?php panel_heading("Section Administration des fils de discussion"); ?>
		</div>

		<div class="panel-body">

			<?php
				$page = 1;
				if(isset($_GET['page']))
				{
					$page = $_GET['page'];
				}
				pager("t_fils",$page,1);
			?>

			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Sujets</th>
							<th>Editer</th>
						</tr>
					</thead>
					<tbody>

						<?php

							// for pour chercher la liste des fils crées
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
												echo "<a style='margin-right: 2.5%;' href='adminChanges.php?fil_id=".$fil_id."'>
													<span class='glyphicon glyphicon-edit'></span>
													</a>";
												echo " /  <a style='margin-left: 2.5%;' href='remove_forum.php?fil_id=".$fil_id."'>
													<span class='glyphicon glyphicon-trash'></span>
													</a>";
											echo "</td>";

										echo "</tr>";
									}
								}
							}
						?>

					</tbody>
				</table>

				<?php
					pager("t_fils",$page,2);
				?>
				
			</div>
		</div>

	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Ajouter nouveau sujet</div>
		<div class="panel-body">
			<!-- section d'insertion fil -->
		  <form role="form" action="add_fil.php" method="post">
		    <div class="form-group">
		      <label for="comment">Le titre du nouveau sujet:</label>
		      <input	type="text" class="form-control" name="fil_titre"/>
		    </div>
		    <button type="submit" class="btn btn-default">Ajouter</button>
		  </form>
		</div>
	</div>
</div>

<?php
	require('footer.php');
?>
