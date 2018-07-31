<?php
	include "session.php";
	include "connecto.php";
	$con = mysqli_connect($host, $user, $passwd, $db);
	if(!$con)
	{ 
		die('Erreur de connexion : ' . mysqli_error($con)); 
	}
?>


<!DOCTYPE html>
<html>
	<head>
	   <link rel="stylesheet" type="text/css" href="formulaire.css" />
	   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>login</title>

    <!-- Bootstrap -->
        <link href="login.css" rel="stylesheet">
    <script type="text/javascript" src="http://abaque.ca/~eml5534/projet/roger.js"></script>

	 <link href="css/bootstrap.min.css" rel="stylesheet">
    <script type"text/javascript" src="js/bootstrap.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
	</head>
	</body>
<div class="container"> 
<nav class="navbar navbar-default " role="navigation">
			  <ul class="nav navbar-nav " >
				  <li>
					  <div class="container-fluid">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navCollapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<div class="navbar-header container-fluid">
						  <a href="#">
							<img alt="forum.jpg" src="forum.jpg" width="150px" height="50px">
						  </a>
						</div>
					  </div>
					</li>
				</ul>
				<div class="collapse navbar-collapse container-fluid" id="navCollapse">
					<ul class="nav navbar-nav">
					  <li id="Sin" style="padding-right:10px;">
						  <div >
							  <button type="button" class="btn btn-default navbar-btn">
								  <a  class="signL" href = "formulaire.html" data-toggle="modal" data-target="#signin" >
									  Sign in
								  </a>
							  </button>
						  </div>
					  </li>
					  <li id="Sup">
						  <div >
							  <button type="button" class="btn btn-default navbar-btn">
								  <a class="signL"  href = "login.php" data-toggle="modal" data-target="#signup" >
									  Sign up
								  </a>
							  </button>
						  </div>
					  </li>
					  <li id="logout" >
						  <div >
							  <button id="logoutS"type="button" style="margin-left:10px;display:none;" class="btn btn-default navbar-btn">
								  <a href = "logout.php">
									  Sign out
								  </a>
							  </button>
						  </div>
					  </li>
				  </ul>
				  <ul id="userW" class="nav navbar-nav navbar-right">
							  	</ul>
				
				</div>
				 
			</nav>
<span id ="connectnav" style="float:right;"></span>


<!--<aside>
<!-- <div class="row">
 <div class="col-sm-4">
<div id ="divsect" class="section">-->
   <form class="form-signin " method="post"action="traite_login.php" id="connexionForm">
        <p class="blocksubhead"><strong>connecter-vous a votre compte</strong></p>
	<div class="form-group">
        	<label for="inputEmail" class="sr-only">couriel</label>
        	<input type="text" id="inputEmail" class="form-control" name="input" placeholder="Nom utilisateur" required autofocus>
	</div>
	<div class="form-group">
        	<label for="inputPassword" class="sr-only">Mot de passe</label>
        	<input type="password" id="inputPassword" name="password" class="form-control" placeholder="mot de passe" required>
	</div>
	<span id="erreur"></span>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> se rappeler de mon compte
          </label>
        </div>
	<p>
	    nouvel utilisateur? <a href="formulaire.html">s'inscrire!</a> 
	</p>
            <input type="submit" class="btn btn-lg btn-primary btn-block" value="Ouvrir une session"/><br/>
	
	    <a  href="submit.php"  id="pagepassforgot" action="submit.php" >Mot De Passe oublié?</a> 
	
      </form>
<!--</div>
</div>
</div>-->
<!--<aside>-->
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

<script>
$(document).ready( function () { 
	$("#connexionForm").submit( function() {	// à la soumission du formulaire						 
		$.ajax({ // fonction permettant de faire de l'ajax
		   type: "POST", // methode de transmission des données au fichier php
		   url: "traite_login.php", // url du fichier php
		   data: "input="+$("#inputEmail").val()+"&password="+$("#inputPassword").val(), // données à transmettre
		   success: function(msg, status){ // si l'appel a bien fonctionné
			   //alert(status);
				if(msg!=1) // si la connexion en php a fonctionnée
				{

					$("#connectnav").html(msg)
						$("#connexionForm").html("<span id=\"confirmMsg\">Vous &ecirc;tes maintenant connect&eacute;.</span>");
					$("#logoutS").show();
					$("#Sin").hide();
					// on désactive l'affichage du formulaire et on affiche un message de bienvenue à la place
				}
				else // si la connexion en php n'a pas fonctionnée
				{
				//	alert(msg);

					$("span#erreur").html("<font face='Verdana' size='2' color=red> Erreur lors de la connexion, veuillez v&eacute;rifier votre login et votre mot de passe.");
					// on affiche un message d'erreur dans le span prévu à cet effet
				}
		   }
		});
		return false; // permet de rester sur la même page à la soumission du formulaire
	});
});		
	</script>
					

</body>
<html>
