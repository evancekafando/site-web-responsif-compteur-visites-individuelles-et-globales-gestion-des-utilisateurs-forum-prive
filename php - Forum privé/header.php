<?php
	require('admin/fonctions.php');
	if (isset($_SESSION['curr_fil_id'])) 
	{
		$fil_id = $_SESSION['curr_fil_id'];
	}
	else
	{
		$fil_id = 1;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles/style.css">
	<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="scripts/javaScript.js"></script>

	<script type="text/javascript">
		
		$(document).ready(function() {

			$("#submit_btn").click(function(){

				var usrname = $("#usrname").val();
				usrname = usrname.trim();

				var pwd = $("#psw").val();
				pwd = pwd.trim();
				
				if ((usrname != null && usrname != "") && (pwd != null && pwd != ""))
				{
					return true;
				}
				else 
				{
					alert("mot de passe ou nom d'utilisateur incorrect!");
					return false;
				}
			});
		/*var titre = '<?php echo get_title($fil_id); ?>' ;
		$("#usr").val(titre) ;

		// affichage des messages par ajax
		$.ajax({
			url: 'print.php' , // script pour afficher les messages
			type: 'GET' , // MEthode GET utilisé
			data: 'fil_id='+ <?php echo $fil_id; ?>,
			dataType: 'html' , // type de donnée à recevoir
			async: true,
			success: function(result)
			{
				$("#messages").append(result) ;

			},

			error: function(result, statut, erreur)
			{
				//alert(erreur) ;
			}
		});

		// action sur le button save title
		$("#saveTitle").click(function(){

			var title = $("#usr").val() ; // nouvelle valeur

			var id = <?php echo $fil_id; ?> ; // id du fil
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
		});*/

		// Action pour le button de suppression
		$("#supprimer").click(function(){
			var checkbox = $(":checkbox") ; // tous les checkbox
			if(checkbox.length > 0)
			{

				for(var i = checkbox.length - 1; i >= 0; i--) {
					if(checkbox[i].checked) // element à supprimer
					{
						var id = Number(checkbox[i].value) ; // id de l'elment à supprimer
						
						//console.log("message id: " + id) ;

						$.ajax({
							url: 'remove_forum.php',
							type: 'GET',
							data: 'f_id='+id, // id de l'element à supprimer
							dataType: 'text',
							success: function(result)
							{
								//console.log(result) ;
								//console.log("id = " +id +" a ete supprimer.") ;
							}
						});  

					}
				}

				// Reafficher le tableau
				$.ajax({
					url: 'print.php' , // script pour afficher les messages
					type: 'GET' , // MEthode GET utilisé
					data: 'fil_id='+ <?php echo $fil_id; ?>,
					dataType: 'html' , // type de donnée à recevoir
					async: true,
					success: function(result)
					{
						$("#messages").empty();
						$("#messages").append(result);
					}
				});

			}

		}) ;
	}) ;

	</script>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"
		integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"
		integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"
		integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
</head>

<body style="background-color: #5CB85C;" >
