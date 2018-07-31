<?php ?>
<html>
  <head>
	<link rel="stylesheet" type="text/css" href="formulaire.css" />
	   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="http://abaque.ca/~eml5534/projet/roger.js"></script>

  <script type="text/javascript" ></script>
    <title>Forgot password</title>
	 <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script type"text/javascript" src="js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

  <script>
   function validateForm()
   {
    var champ = document.forms["myform"]["input"].value;
    if ( champ == null || champ == "") 
      {
        alert("**Veuillez saisir votre id ou votre adresse courrielle**");
        return false;
      }
   }
  </script>

  <body>
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
							<img alt="imagesproj.jpg" src="forum.jpg" width="150px" height="50px">
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
							  <button style="margin-left:10px;display:none;" id="logoutS"type="button" class="btn btn-default navbar-btn">
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
<div class="blockrow">

        <h2 style="text-align:center;"> Pas de panique! </h2>
        <table align="center" bgcolor="#FFFFFF" width="800" height ="300">
        <form name="myform" action="password.php" onsubmit="return validateForm()" method="post" id="myform">
	<div class="section">	   
	<div class="blockrow">
				  <ul class="group" style="text-align:center;list-style-type:none;
">
				    <li>
				      <label for="nom">Identifiant/Courriel :</label>
				      <input class="textbox " maxlength="50" tabindex="1" type="text" name="input" id="nom"/>
				  	<span id="msg_id"></span>
				    	<input type="submit" value="Submit" class="button "/>
				    </li>
			          </ul>
			    </div>
	</div>

 
</div> 
	<?php ?>
</div>
   </body>
</html>




