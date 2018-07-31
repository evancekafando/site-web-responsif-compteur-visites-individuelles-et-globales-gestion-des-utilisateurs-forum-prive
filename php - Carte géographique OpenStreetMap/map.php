<!DOCTYPE html>
<html>
  <head>
  <title>Projet MAP INFO4007</title>
   <meta charset="utf-8" />
   <script src="http://code.jquery.com/jquery-2.1.4.min.js"> </script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
   <link href="bootstrap.min.css" rel="stylesheet">
   <style>
	   .labelone {
		margin-top: 15px;
		display:block;		
	   }
	   .labeltwo {
		 margin-top: 10px;
		 display:block;	  
	   }
   </style>
  </head>

  <body>
  <div class="container-fluid">
	  <div class = "row">
		  <div class = "col-xs-12 col-sm-12 col-md-3 col-lg-2 col-lg-offset-1">
		  <strong>Veuillez selectionner une tour pour afficher sa position sur la carte.</strong><br>
			<?php
			  require("connexion.php");

			  $conn = mysqli_connect($host, $user, $passwd, $db);
			  mysqli_select_db($conn, $db) or die("Unable to select db $db");
			  $requete = "SELECT * FROM t_lieux";
			  $tuples = mysqli_query($conn,$requete);
			  $row = mysqli_fetch_array($tuples);
			   
			   	echo"<select id=","ddown>";
			   echo"<option selected disabled>---</option>";
			  while($row){
			   echo "<option value=","\"",$row["nom"],"\"",">",$row["nom"],"</option>";
			   $row = mysqli_fetch_array($tuples);
			  }
			  echo"</select>";

			  mysqli_close($conn);
			?>
			<label class ="labelone" id='infotour'></label>
		  </div>
		  <div class = "col-xs-12 col-sm-12 col-md-9 col-lg-5 col-lg-offset-2">
			<label class ="labeltwo"id ="mapLabel">Voici la carte de votre region :</label>
			<div id="GoogleMap" style="width:640px;height:480px"></div>
		  </div>
	   </div>	
	</div>
  <script src="bootstrap.min.js"></script>
  </body>
  <script>
	//Prendre la position de l'utilisateur.
	navigator.geolocation.getCurrentPosition(SetPos);	
	//Fonction quest est appeler pour cree l'instence du permier map. Ce map sera 
		function SetPos(pos){
			startLat = pos.coords.latitude;
			startLng = pos.coords.longitude;
			console.log(startLat+" 2 "+startLng)
		SetPosition(startLat,startLng);
	    var mapProp = { 		
			center:centre,
			zoom:10,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};
		//afficher le google map avec les propriete defini ci-haut dans l'élément GoogleMap.
		var map=new google.maps.Map(document.getElementById("GoogleMap"),mapProp);
			var marker=new google.maps.Marker({position:centre,});
			marker.setMap(map);	
			
		}
		//Fonctoin qui cree un objet de position pour google maps.
	function  SetPosition(lat,lng){
		centre = new google.maps.LatLng(lat,lng);
	} 

	function CreeMap(lat,lng) {
 
		SetPosition(lat,lng);
	    var mapProp = { 		
			center:centre,
			zoom:10,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};
		//afficher le google map avec les propriete defini ci-haut dans l'élément GoogleMap.
		var map=new google.maps.Map(document.getElementById("GoogleMap"),mapProp);
			var marker=new google.maps.Marker({position:centre,
			});
		marker.setMap(map);	
	}		
	//console.log(window.startLat+" 1 "+window.startLng);
	

	

	$(document).ready(function(){
	
		$("#ddown").change(function(){
			var nomTour = $('#ddown').val();
			$('#mapLabel').text("Voici la position de la tour : "+nomTour); 
			 $.ajax({
				
				url:'infotour.php',
				type:'GET',
				data : 'tour='+nomTour,
				dataType:'html',
				success:function(code_html,statut){
					
					$("#infotour").html(code_html);	
					var vlat =$("#lat",code_html).text();
					var vlng =$("#lng",code_html).text();
					var valt = $("#alt",code_html).text();
				//	console.log("Coor : "+vlat+" "+vlng+" "+valt);
					var latlng = vlat+vlng;
					CreeMap(vlat,vlng);
				}	
			});
		});
    });
	
	
  </script>

</html>
