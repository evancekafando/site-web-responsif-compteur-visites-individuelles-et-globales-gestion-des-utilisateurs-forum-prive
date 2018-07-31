//fonction de validation du formulaire

// verification_reponse()
function verification_reponse()
{
	var rep = document.getElementById('comment').value;
	rep = rep.trim();

	if (rep != null && rep != "")
	{
		return true;
	}
	else
	{
		alert("Le champ message ne peut pas être vide!");
		return false;
	}
}


/*/JQuery
$(document).ready(function(){
	$("#myBtn").click(function(){
		$("#myModal").modal();
	});
});*/


/*$(document).ready(function(){

	// Action pour le modal de login
	$("#myBtn").click(function(){
		$("#myModal").modal();
	});

	// Action pour le button de suppression
	$("#supprimer").click(function(){
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
				//url: 'forum.php' ,
				type: 'GET' , // MEthode GET utilisé
				data: 'fil_id='+ <?php echo "$fil_id";?>,
				dataType: 'html' , // type de donnée à recevoir
				success: function(result)
				{
					$("#messages").append(result) ;
				}
			});
		}
	});
});
*/
