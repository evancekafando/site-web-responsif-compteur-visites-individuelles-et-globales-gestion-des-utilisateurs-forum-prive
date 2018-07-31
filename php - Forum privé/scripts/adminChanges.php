<?php
	require('header.php');
	if (isset($_GET['fil_id']))
	{
		$fil_id = $_GET['fil_id'];
	}
?>

<script>
	$(document).ready(function() {
		var titre = '<?php echo get_title($fil_id); ?>' ;
		$("#usr").val(titre) ;

		// affichage des messages par ajax
		$.ajax({
			url: 'print.php' , // script pour afficher les messages
			type: 'GET' , // MEthode GET utilisé
			data: 'fil_id='+ <?php echo "$fil_id";?>,
			dataType: 'html' , // type de donnée à recevoir
			success: function(result)
			{
				$("#messages").append(result) ;

			},

			error: function(result, statut, erreur)
			{
				alert(erreur) ;
			}
		});

		// action sur le button save title
		$("#saveTitle").click(function(){

			var title = $("#usr").val() ; // nouvelle valeur

			var id = '<?php echo $fil_id; ?>'; // id du fil
			  if ($("#usr").value == 0) {
			  	// champ vide
			    return;
			  }

			  $.ajax({
					url: 'set_title.php',
					type: 'GET',
					data: 'id_fil='+id + "&title="+title, // id de l'element à supprimer
					dataType: 'text',
					success: function(result)
					{
						console.log("id = " +id +" a ete mis a jour.") ;
					}
				});  

		});

		// Action pour le button de suppression
		$("#delete").click(function(){
			var checkbox = $(":checkbox") ; // tous les checkbox
			if(checkbox.length > 0)
			{

				for(var i = checkbox.length - 1; i >= 0; i--) {
					if(checkbox[i].checked) // element à supprimer
					{
						var id = Number(checkbox[i].value) ; // id de l'elment à supprimer
						
						console.log("message id: " + id) ;

						$.ajax({
							url: 'remove_forum.php',
							type: 'GET',
							data: 'f_id='+id, // id de l'element à supprimer
							dataType: 'text',
							success: function(result)
							{
								console.log(result) ;
								//console.log("id = " +id +" a ete supprimer.") ;
							}
						});  

					}
				}

				// Reafficher le tableau
				$.ajax({
					url: 'print.php' , // script pour afficher les messages
					type: 'GET' , // MEthode GET utilisé
					data: 'fil_id='+ <?php echo "$fil_id";?>,
					dataType: 'html' , // type de donnée à recevoir
					success: function(result)
					{
						$("#messages").append(result) ;
					}
				});
	

			}

		}) ;
	}) ;
</script>

<div class="container">

	<div class="panel panel-default">

		<div class="panel-heading">
			<h2>Forum privé</h2>
			<a href="fils.php"><span class="glyphicon glyphicon-home"></span></a>
		</div> 
		<div class="panel-body">

			<ul class="pagination">
				<li><a href="#">1</a></li>
			</ul>

			<!-- Modification du sujet par ladminstrateur -->
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

			<!-- Modification du fil de discution  -->
			<div class="panel-body">
			  <table class="table table-striped">
			    <thead>
			      <tr>
			        <th style = "width:25%">Auteur</th>
			        <th style = "width:75%">Message</th>

			      </tr>
			    </thead>
			    <tbody id="messages">
			    </tbody>
			  </table>
    		</div>

    		<input type = "button" value = "Supprimer" id="delete">
  		</div>
  	</div>
  </div>

  <?php
	require('footer.php');
?>
