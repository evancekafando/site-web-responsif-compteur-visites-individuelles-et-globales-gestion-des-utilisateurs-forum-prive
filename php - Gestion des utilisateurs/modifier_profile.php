<?php
	include "session.php";
	include "connecto.php";
	$con = mysqli_connect($host, $user, $passwd, $db);
	if(!$con)
	{ 
		die('Erreur de connexion : ' . mysqli_error($con)); 
	}

// check the login details of the user and stop execution if not logged in
require ("check.php");

// If member has logged in then below script will be execuated. 
// let us collect all data of the member 
mysqli_select_db($con, $db);
$query = "SELECT * FROM t_utilisateurs WHERE t_utilisateurs.u_id= '$_SESSION[u_id]'";
$records =  mysqli_query($con,$query);
if (($rcd = mysqli_fetch_array($records, MYSQLI_NUM)) ==0) 
		{
			echo "<center><font face='Verdana' size='2' color=red><b>Connexion failed</b><br>
			D&eacute;sol&eacute; votre identifiant n'est pas enregistr&eacute; dans notre base de donn&eacute;es. Vous pouvez cr&eacute;er un compte gratuitement et vous connecter pour utiliser notre site. 
			<BR><BR><a href='signup.php'> Cr&eacute;er un compte </a> </center>";
			exit; 
		}
$_query = mysqli_query($con,"SELECT u_id,u_prenom,u_nom,u_programme,u_courriel,u_login,u_passe,u_id FROM t_utilisateurs WHERE t_utilisateurs.u_id= '$_SESSION[u_id]'");
$row = mysqli_fetch_row($_query); 
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
	<script type="text/javascript" src="http://abaque.ca/~eml5534/projet/roger.js"></script>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>formulaire de modification de profil</title>

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
	</head>
	</body>

	
	<div class='container'> 
	<nav class='navbar navbar-default ' role='navigation'>
			  <ul class='nav navbar-nav ' >
				  <li>
					  <div class='container-fluid'>
						<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navCollapse'>
							<span class='sr-only'>Toggle navigation</span>
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>
						</button>
						<div class='navbar-header container-fluid'>
						  <a href='#'>
							<img alt='imagesproj.jpg' src='forum.jpg' width='150px' height='50px'>
						  </a>
						</div>
					  </div>
					</li>
				</ul>
				<div class='collapse navbar-collapse container-fluid' id='navCollapse'>
					<ul class='nav navbar-nav'>
					  <li id='Sin' style='padding-right:10px;'>
						  <div >
							  <button type='button' class='btn btn-default navbar-btn'>
								  <a  class='signL' href = 'goback.php' data-toggle='modal' data-target='#signin' >
									  Annuler
								  </a>
							  </button>
						  </div>
					  </li>
					  <li id='Sup'>
						  <div >
							  <button type='button' class='btn btn-default navbar-btn'>
								  <a class='signL'  href = 'login.php' data-toggle='modal' data-target='#signup' >
									  Creer compte
								  </a>
							  </button>
						  </div>
					  </li>
					  <li id='logout' >
						  <div >
							  <button style='margin-left:10px;display:none;' id='logoutS'type='button' class='btn btn-default navbar-btn'>
								  <a href = 'logout.php'>
									  Sign out
								  </a>
							  </button>
						  </div>
					  </li>
				  </ul>
				  <ul id='userW' class='nav navbar-nav navbar-right'>
			  </ul>
				</div> 
			</nav>
			<div id='pagetitle'>
		   <a href='login.php'>
			<span class='glyphicon glyphicon-home' aria-hidden='true'></span>
		   </a>
			<h1>Modifier Profile</h1> 
			 
		</div>

	      <form method='post' action='traite_modifier_profil.php'  class='vbform form-inline' id='enregistrer'>
			<h2 class='blockhead'>Formulaire de modification de profil</h2>
		<div class='blockbody formcontrols'>
		<h3 class='blocksubhead'>Champs de modification</h3>
<!-- div principale --><div class='section'>
			     <div class='blockrow'>
				  <ul class='group'>
				    <li>
				      <label for='nom'>Identifiant :</label>
				      <input class='textbox ' maxlength='20' tabindex='1' type='text' name='nomUtilisateur' value=<?php echo $row[5]; ?> id='nom'/>
				  	<span id='msg_id'></span>
				     <p class='description'>**Veuillez insérer l'identifiant avec lequel vous souhaitez vous identifier</p>
				    </li>
			          </ul>
			    </div>
			     <div class='blockrow'>
				<ul class='group'>
				  <li>
					<label for='password'>Mot de passe:</label>
					<input type='' class='textbox' name='password' id='password' maxlength='50'  tabindex='1' />
					 <span id='msg_pass1'></span>
				   </li>
				  <li>
					<label for='passwordconfirm'>Confirmez votre mot de passe:</label>
					<input type='' class='textbox' name='passwordconfirm' id='passwordconfirm' maxlength='50'  tabindex='1' />
					<span id='msg_pass2'></span>
				  </li>
			       </ul>
				<p class='description'>**Remarquez que les mots de passe sont sensibles à la casse.</p>
			     </div>
			    <div class='blockrow'>
				<ul class='group'>
					<li>
						<label for='email'>Adresse email:</label>
						<input type='email' placeholder='Ex: abc1234@gmail.com' class='textbox' name='email' value=<?php echo $row[4]; ?> id='email' maxlength='50' value='' dir='ltr' tabindex='1' />
						<span id='mail1'></span>
					</li>
					<li>
						<label for='emailconfirm'>Confirmez votre adresse email:</label>
						<input type='email' placeholder='Ex: abc1234@gmail.com' class='textbox' name='emailconfirm' value=<?php echo $row[4]; ?> id='emailconfirm' maxlength='50' value='' dir='ltr' tabindex='1' />
						<span id='mail2'></span>
					</li>
				</ul>
				<p class='description'>**Veuillez insérer une adresse email valide.</p>
			   </div>
      			</div>
			
			   <h3 class='blocksubhead'>Autres renseignements</h3>
			<div class='section'> 
				<div class='blockrow'>
				   
					<ul class='group'>
					<li>
					<label>Prénom:</label>
					    <input type='text' class='textbox' name='le_prenom' value=<?php echo $row[1]; ?> maxlength='100' tabindex='1' />
					</li>		
				<li>
				    <label>Nom:</label>
					    <input type='text' class='textbox' name='le_nom' value=<?php echo $row[2]; ?> maxlength='100' tabindex='1' />
				</li>
				<li>
					<label>Programme:</label>
					    <input type='text' class='textbox' name='programeUtil' value=<?php echo $row[3]; ?> maxlength='100' tabindex='1' />
					</li>
					
				</div>
    <!--fin section-->    </div>
				
 
<!--blockbody--></div> 
	<span id='msg_all'></span>
		<div class='blockfoot actionbuttons'>
		   <div class='group'>
		      <input type='submit' class='button ' value='Terminer modification' tabindex='1' accesskey='s' />
		      <input type='reset' class='button' name='Reset' tabindex='1' value='Réinitialiser les champs' />
		  </div>
	       </div>
		
<!--fin div principale--></div> 

  
	      </form>
	
<script>
			$(function(){

			$('#enregistrer').submit(function(event){
					//event.preventdefault();
					var id= $('#nom').val();
					var pass=$('#password').val();
					var conf=$('#passwordconfirm').val();
					var DataString= id+pass+conf;
					var msg_alert='**Merci de remplir ce champs**';
					var msg_all='***Merci de remplir tous les champs***';
					var alert_error='**Les mots de passes ne correspondent pas**';
					var mail= $('#email').val();
					var mailconf= $('#emailconfirm').val();
					if(DataString=='')
					{
						$('#msg_all').html(msg_all).css({color:'#FF0000'});
					}
					else if(id == '')
					{
						$('#msg_id').html(msg_alert).css({color:'#FF0000'});
					}
					else if(pass== '')
					{
						$('#msg_pass1').html(msg_alert).css({color:'#FF0000'});
					}
					else if(conf== '')
					{
						$('#msg_pass2').html(msg_alert).css({color:'#FF0000'});
					}
					else if(conf!= ''&& pass!=conf)
					{
						$('#msg_pass1').html(alert_error).css({color:'#FF0000'});
					}
					else if(mail= '')
					{
						$('#mail1').html(alert_error).css({color:'#FF0000'});
					}
					else if(mailconf= '')
					{
						$('#mail2').html(alert_error).css({color:'#FF0000'});
					}
					else if(mailconf!= ''&&mailconf!=mail)
					{
						$('#mail1').html('***les mails ne correspondent pas***').css({color:'#FF0000'});
					}
					else{
						//alert($(this).attr('action'));
						$.ajax({
						type: 'POST',
						url:'traite_modifier_profil.php',
						data:$(this).serialize(),
					 	success : function(code_html,status) {
                           				 $('#enregistrer').html(code_html);
                       					 },
                       			 	error: function(code_html,status) {
                           				 $('#enregistrer').html(code_html);
                       			 }
						});
					}
				return false;
			});
		});
</script>
	</body>
</html>
<?php
	mysqli_close($con);
?>