<?php

function createSession()
{
	$sessid = session_id();
	if(empty($sessid))session_start();
}

function sessionExpired()
{
	if(!isset($_SESSION['lastAction']))
		{
			$_SESSION['lastAction'] = time();
		}
		$st = $_SESSION['lastAction'] + 1200; //session time is 20 minutes
		if(time() < $st)
		{
			return "session active";
		}
		else
		{
			session_destroy();
			return "session expired";
		}
}

try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=db_marceddy', 'marceddy', 'lafo1520');
	if($_GET["type"] == "signup")
	{
		$_SESSION['lastAction'] = time();
		if( isset($_POST["lastname"]) && isset($_POST["firstname"]) && isset($_POST["email"]) && isset($_POST["passwd"]))
		{
			
			//filtring passwd and save
			$passwd = $_POST["passwd"];
			$passwd = strip_tags($passwd);
			$passwd = trim($passwd);
			$rand = rand();
			$passwd = $passwd.$rand;
			$passwd =  hash('sha256', $passwd, false);
			$uEmail = $_POST["email"];
			$chckEmail = $bdd->query("SELECT count(*) as count FROM users WHERE email='$uEmail'");
			$chck = $chckEmail->fetch();
			if($chck['count'] > 0)
			{
				echo "Email Already in Exists";
			}
			else
			{
				$req = $bdd->prepare('INSERT INTO users(ID, email, status, creation_date) VALUES(:ID, :email, :status, CURDATE())');
				$req->execute(array(
					'ID' => '',
					'email' => $_POST["email"],
					'status' => '1'
					));
				$req2 = $bdd->prepare('INSERT INTO userP(U_id, firstname, lastname, sha, random) VALUES(LAST_INSERT_ID(), :firstname, :lastname,:sha, :random)');
				$req2->execute(array(
					'firstname' => $_POST["firstname"],
					'lastname' =>  $_POST["lastname"],
					'sha' => $passwd,
					'random' => $rand
					));
					
				echo "Success" ;
			}
		}
		else
		{
			echo "Failed";
		}
	}
	else if($_GET["type"] == "signin")
	{
		createSession();
		$_SESSION['lastAction'] = time();
		$passwd1 = $_POST["passwd"];
		$passwd1 = strip_tags($passwd1);
		$passwd1 = trim($passwd1);
		$uEmail1 = $_POST["email"];
		$getId = $bdd->query("SELECT ID FROM users WHERE email='$uEmail1'");
		$id = $getId->fetch();
		$getRand = $bdd->query("SELECT sha as hash, random as rand FROM userP WHERE U_id='$id[0]'");
		$gRand = $getRand->fetch();
		$rand1 = $gRand['rand'];
		$passwd1 = $passwd1.$rand1;
		$passwd1 =  hash('sha256', $passwd1, false);
		$hash = $gRand['hash'];
		if( $passwd1 == $hash)
		{
				$info = array(
						'isexpired' => sessionExpired(),
						'result' 	=> "Success",
						'user'   	=> $uEmail1,
						'id'		=> session_id()
						);
				echo json_encode($info);
		}
		else
		{
			echo "Failed";
		}
		
	}
	else if($_GET["type"] == "logout")
	{
		session_destroy();
		$sessid = "";
		echo "session logout";
	}
	else if($_GET["type"] == "test")
	{
	}
	else
	{
		echo "Nice try";
	}
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
	die("Failed");
}

?>
Roger Booto
00:44
Roger Booto

---

HTML
Roger Booto
00:44
Roger Booto

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>IQ Evolve Dashboard</title>
		<link href="css/main.css" rel="stylesheet">
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/dropzone.css" type="text/css" rel="stylesheet" />
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		</head>
		<body background="../images/bgimage.jpeg">
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
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
							<img alt="iqevolve.png" src="images/IQEvolve.png" width="150px" height="50px">
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
								  <a  class="signL" href = "#" data-toggle="modal" data-target="#signin" >
									  Sign intttttt
								  </a>
							  </button>
						  </div>
					  </li>
					  <li id="Sup">
						  <div >
							  <button type="button" class="btn btn-default navbar-btn">
								  <a class="signL"  href = "#" data-toggle="modal" data-target="#signup" >
									  Sign up
								  </a>
							  </button>
						  </div>
					  </li>
					  <li id="logout" >
						  <div >
							  <button id="logoutS"type="button" class="btn btn-default navbar-btn">
								  <a href = "#">
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
			<!--Start navbar menu-->
			<div id="navMenu">
					<!-- Sign in Modal -->
				<div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<form class="form-horizontal" role="form" method="POST" id="signinForm">
						<div class="form-group" id="emailD1">
								<div class="col-sm-10">
									<input type="text" class="form-control" id="emaili" name="email" placeholder="Email" >
								</div>
						</div>
						<div class="form-group" id="passwdD1">
							<div class="col-sm-10">
								<input type="password" class="form-control" id="passwdi" name="passwd" placeholder="Password" >
								</div>
						</div>
						  <div class="form-group row">
				  <div class="col-xs-4"><button class="btn btn-success">Sign in</button></div>
				  <div class="col-xs-4 col-xs-offset-4"><button id="closein" class="btn btn-info close" data-dismiss="modal" style="padding-top:15px;">Close</button></div>
				</div>
					</form>
							</div>
						</div>
					</div>
				</div>
				<!-- End sign in form -->
				
				<!-- Sign up Modal -->
				<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<form class="form-horizontal" role="form" method="POST" id="signupForm">
						<div class="form-group" id = "lastnameD">
								<div class="col-sm-10" >
									<input type="text" class="form-control" id="lastname" name="lastname" onkeyup="validateLastName()" placeholder="Last name" >
									<span style="display:none;" id="lastnameE" class="help-block">Please enter a minimum of 2 characters</span>
									<span style="display:none;" id="lastnameRq" class="help-block">Required</span>
									<span style="display:none;" id="lastnameRE" class="help-block">
										<ul style="list-style-type:none;">
											<li>Only the following charaters are accepted for the name :" ' " " - " </li>
											<li>A name cannot finish with a special character</li>
										</ul>
									</span>
								</div>
						</div>
						<div class="form-group" id ="firstnameD">
								<div class="col-sm-10">
									<input type="text" class="form-control" id="firstname" name="firstname" onkeyup="validateFirstName()" placeholder="First name" >
									<span style="display:none;" id="firstnameE" class="help-block">Please enter a minimum of 2 characters</span>
									<span style="display:none;" id="firstnameRq" class="help-block">Required</span>
									<span style="display:none;" id="firstnameRE" class="help-block">
										<ul style="list-style-type:none;">
											<li>Only the following charaters are accepted for the name :" ' " " - " </li>
											<li>A name cannot finish with a special character</li>
										</ul>
									</span>
								</div>
						</div>
						<div class="form-group" id="emailD">
								<div class="col-sm-10">
									<input type="text" class="form-control" id="email" name="email" onkeyup="validateEmail()" placeholder="Email" >
									<span style="display:none;" id="emailE" class="help-block">Please enter a valid email</span>
									<span style="display:none;" id="emailRq" class="help-block">required</span>
								</div>
						</div>
						<div class="form-group" id="passwdD">
							<div class="col-sm-10">
								<input type="password" class="form-control" id="passwd" name="passwd" onkeyup="validatePasswd()" placeholder="Password" >
								<span id="passwdE" class="help-block">Minimum of 8 charaters</span>
								<span style="display:none;" id="passwdRq" class="help-block">Required</span>
								</div>
						</div>
						<div class="form-group" id="rpasswdD">
							<div class="col-sm-10">
								<input type="password" class="form-control" id="rpasswd" name="rpasswd" onkeyup="validateRPasswd()" placeholder="Confirm password" >
								<span style="display:none;" id="rpasswdE" class="help-block">Passwords does not match</span>
								<span style="display:none;" id="rpasswdRq" class="help-block">Required</span>
							</div>
						</div>
						<div class="form-group" id="signupD">
							<div class="col-sm-10">
								<span id="signupS" style="display:none;" class="help-block">Sign up confirmed, now please sign in</span>
								<span id="signupE" style="display:none;" class="help-block">Connection Error !</span>
								<span id="signupAE" style="display:none;" class="help-block">The email provided aprears to be already used, please use another one !</span>
							</div>
						</div>
						  <div class="form-group row">
				  <div class="col-xs-4"><button class="btn btn-info">Sign up</button></div>
				  <div class="col-xs-4 col-xs-offset-4"><button id="closeup" class="btn btn-info close" data-dismiss="modal" style="padding-top:15px;">Close</button></div>
				</div>
					</form>
					  </div>
					</div>
				  </div>
				</div>
				<!-- End Sign up Form -->
			</div>
			<!--End Start navbar menu-->
			<!--Start Dashboard-->
			<section id="dashboard" class="container-fluid" style="margin-top:60px;display:none;">
				<!--Start projects-->
				<div style="float:left;width:50%;margin-right:25px;">
					<div id="projects" class="dashShadow" style="min-height:650px;margin-bottom:25px;background: rgba(255, 255, 255, 0.1);color:white;">
						<nav id="projectNav" class="navbar navbar-inverse">
							<div class="container-fluid">
								<div class="navbar-header">
								  <a class="navbar-brand" href="#">Project</a>
								</div>
							</div>
						</nav>
						<section id="projectNewFiles" style="float:left;width:50%;margin-right:10px;">
							<div class="container-fluid" >
								<p><h4>Add new project by name or drop project file (max 2)</h4></p>
							</div>
							<div>
								<form id="batchName" class="form-horizontal" role="form" method="POST">
									<div class="col-md-6">
										<input type="text" class="form-control" id="projectName" name="projectName" placeholder="Please type batch name">
									</div>
								</form>
							</div>
							<div id="dropzone" style="max-width:450px;margin-top:50px;margin-left:15px;">
								<div >
									<form id="zone" action="upload.php" class="dropzone"></form>
								</div>
							</div>
						</section>
						<section id="projectActive" style="float:left;width:45%;">
							<div class="container-fluid" style="margin-bottom:10px;">
								<p><h4>Active projects</h4></p>
							</div>
						</section>
					</div>
					<div id="templates" class="dashShadow" style="min-height:400px;margin-bottom:25px;background: rgba(255, 255, 255, 0.1);color:white;">
						<nav id="templateNav" class="navbar navbar-inverse">
							<div class="container-fluid">
								<div class="navbar-header">
								  <a class="navbar-brand" href="#">Templates</a>
								</div>
							</div>
						</nav>
						<section id="templateSec">
						</section>
					</div>
				</div>
				<div id="isaList" class="dashShadow" style="width:45%;height:100px;margin-bottom:25px;float:left;background: rgba(255, 255, 255, 0.1);color:white;">
					<nav id="isaNav" class="navbar navbar-inverse">
							<div class="container-fluid">
								<div class="navbar-header">
								  <a class="navbar-brand" href="#">ISA List</a>
								</div>
							</div>
						</nav>
						<section id="isaSec">
						</section>
				</div>
				<!--End projects -->
			</section>
			<!--End Dashboard-->
			<script src="js/validate.js" ></script>
			<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
			<script src="js/jquery.min.js"></script>
			<!-- Include all compiled plugins (below), or include individual files as needed -->
			<script src="js/bootstrap.min.js"></script>
			<script src="js/browser.min.js" ></script>
			<script src="js/dropzone.js" ></script>
			<script>
				$(document).ready(function(){
					$(function(){
						if($.browser.msie)
						{
							
						}
						else if ($.browser.firefox)
						{
							$("#signup").css("display","none");
							$("#signin").css("display","none");
							$(".signL").removeAttr("data-toggle data-target");
							$("#signup").removeClass("modal fade");
							$("#signin").removeClass("modal fade");
							$("#Sup").on("click",function(){
								$("#signin").css("display","none");
								$("#signup").css("display","block");
							});
							$("#Sin").on("click",function(){
								$("#signup").css("display","none");
								$("#signin").css("display","block");
							});
						}
						$("#logout").hide();
						$(".close").hide();
					});
				});
			</script>
			<script>
				$(document).ready(function(){
					$(function(){
						$("#closeup").on("click",function(){
							//Clear form data 
							$( "#signupForm" ).each(function(){
								$( "#signupForm div" ).removeClass("has-success has-error has-warning");
								this.reset();
							});
							$("signupD").css("display:none;");
							$("#signup").css("display","none");
						});
						$("#closein").on("click",function(){
							//Clear form data 
							$( "#signinForm" ).each(function(){
								$( "#signinForm div" ).removeClass("has-success has-error has-warning");
								this.reset();
							});
							$("#signin").css("display","none");
						});
					});
				});
			<!--End reset and close form-->
			</script>
			<script>
			  $(document).ready(function(){
				  //Sign up request
				  $(function(){
					  $("#signupForm").on("submit", function(e){
						  e.preventDefault();
						  //Client side data filtrer 
						  if(validateLastName() && validateFirstName() && validateEmail() && validatePasswd())
						  {
							  //Ajax call for asynch refresh
							  $.ajax({
								  url:"api.php?type=signup",//Request type
								  type:"POST",
								  data: $("#signupForm").serialize(),
								  success:function(data,status){
									  if(status)//If connection successfull close modal form and show message
										  {
											  console.log(status);
											  if(data == "Success")
											  {
												  $("#signupAE").hide();
												  $("#signupD").removeClass("has-error has-warning").addClass("has-success");
												  $("#signupS").fadeIn(500);
												  $("#closeup").fadeIn(500);
											  }
											  else if (data == "Email Already in Exists")
											  {
												  $("#signupS").hide();
												  $("#signupD").removeClass("has-success has-warning").addClass("has-error");
												  $("#signupAE").fadeIn(500);
											  }
											  else if(data == "Failed")
											  {
												  $("#signupD").removeClass("has-success has-warning").addClass("has-error");
												  $("#signupE").fadeIn(500);
											  }
										  }	
									}
									
								});
							}
							else
							{
								$("#signupS").fadeOut(500);
								$("#signupE").fadeOut(500);
							}
						});
					});//End sign up request
					
					//Sign in request
					 $(function(){
					  $("#signinForm").on("submit", function(e){
						  e.preventDefault();
						  //Ajax call for asynch refresh
							  $.ajax({
								  url:"api.php?type=signin",//Request type
								  type:"POST",
								  dataType:'json',
								  data: $("#signinForm").serialize(),
								  success:function(data,status){
									  if(status)//If connection successfull close modal form and show message
										  {
											   rResult = data;
											  if(rResult.result == "Success")
											  {
												  $("#logout").show().siblings().hide();
												  $("#userW").children().remove();
												  $("#signin").remove();
												  $("body").removeClass("modal-open");
												  $("#userW").append("<li  style=\"padding-right:50px;padding-top:20px;\"><div>welcome "+rResult.user+"</div></li>");
												  $("#dashboard").fadeIn(500);
												  $("#zone").click(function(){
													if($("#zone").hasClass("dz-started"))
													{
														alert("bingo");
													}
												  });
												  
											  }
											  else if (rResult.result == "Failed")
											  {
												  
											  }
										  }	
									}
									
								});
						});
					});//End sign in request
					
					$(function(){
					  $("#logoutS").on("click", function(e){
						  e.preventDefault();
						  //Ajax call for asynch refresh
							  $.ajax({
								  url:"api.php?type=logout",//Request type
								  type:"POST",
								  //dataType:'json',
								  //data: $("#signinForm").serialize(),
								  success:function(data,status){
									  if(status)//If connection successfull close modal form and show message
										  {
											  if(data == "session logout")
											  {
												  location.reload();  
											  }
											  else
											  {
												  console.log(data);
											  }
										  }	
									}
									
								});
						});
					});//End sign in request
					
						  //Ajax call for asynch refresh
							  $.ajax({
								  url:"http://librairieadsi3541.ddns.net:8000",//Request type
								  type:"GET",
								  success:function(data,status){
									  console.log("ok");
									  if(status)//If connection successfull close modal form and show message
										  {
											  console.log(status);
										  }	
									}
									
								});
				});
			</script>
			</body>
</html>
