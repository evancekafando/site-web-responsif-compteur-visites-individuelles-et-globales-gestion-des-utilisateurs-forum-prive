<?php
	
	require('header.php');
	if (isset($_GET['fil_id']))
	{
		
		$fil_id = $_GET['fil_id'];
		$_SESSION['curr_fil_id'] =  $fil_id;
	}

	$page = 1;
	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
	}
?>

<script>
	$(document).ready(function() {
		var titre = '<?php echo get_title($fil_id)?>' ;
		$("#usr").val(titre) ;

		// action sur le button save title
		$("#saveTitle").click(function(){

			var title = $("#usr").val() ; // nouvelle valeur

			var id = '<?php echo $fil_id; ?>'; // id du fil
			var xhttp;
			  if ($("#usr").value == 0) {
			  	// champ vide
			    return;
			  }
			  xhttp = new XMLHttpRequest(); // nouvel objet XMLHttpRequest
			  xhttp.onreadystatechange = function() {
			    if (xhttp.readyState == 4 && xhttp.status == 200) {
			      alert("Titre mis à jour") ; // nouvel titre
			    }
			  }

			  xhttp.open("GET", "set_title.php?id_fil=" +id+ "&title="+title, true);
			  xhttp.send();

		});
	}) ;
</script>

<div class="container">

	<div class="panel panel-default">

		<div class="panel-heading">
			<?php panel_heading("Gestion d'un fils de discussion"); ?>
		</div>  <!-- End panel-heading div -->
		<div class="panel-body">

			<!-- Modification du sujet par l'adminstrateur -->
			<div class="container-fluid">
				<label for="usr">Modifier Sujet:</label>
				<div class="row">
					<div class="col-sm-10">
			 			<div class="form-group">
			  				<input type="text" class="form-control" id="usr">
			 			</div>
					</div>
					<div class="col-sm-2">
			   			<button type="submit" class="btn btn-default" id = "saveTitle">Enregistrer</button>
					</div>
				</div>
			</div>


			<!-- Modification du fil de discution -->
			<div id="messages" class="panel-body">

				<?php pager("t_forum",$page, $fil_id); ?>
			  <table class="table table-striped">
			    <thead>
			      <tr>
			        <th style = "width:25%">Auteur</th>
			        <th style = "width:75%">Message</th>
			      </tr>
			    </thead>
			    <tbody>

			      <?php
					
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

					/*$page = 1;
			        // on affiche la liste des message poster dans ce fil de discussion précis
			        retrive_forum($fil_id,$page);*/

			      ?>
			    </tbody>
			  </table>
  
			<?php
				pager("t_forum",$page, $fil_id);
			?>
    		</div>
	        <!-- -->
	        <button type="button" id="supprimer" class="btn btn-primary btn-block">Supprimer</button>
            <br/>
  			<!-- -->
  		</div>
  	</div>
  </div>

  <?php
	require('footer.php');
?>
