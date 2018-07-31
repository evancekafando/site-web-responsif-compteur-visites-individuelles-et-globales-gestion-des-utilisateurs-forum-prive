<?php require('header.php'); ?>
	<!-- Modal -->
<div class="container">
  
	<div class="panel panel-default">

		<div class="panel-heading">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        	<h4 style="color:red;"><span class="glyphicon glyphicon-lock"></span> Connexion</h4>
		</div>

		<div class="panel-body">
			<form role="form" action="login.php" method="post">
				<div class="form-group">
					<label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
					<input type="text" class="form-control" id="usrname" name="usrname" placeholder="Enter email">
				</div>
				<div class="form-group">
					<label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
					<input type="password" class="form-control" id="psw" name="pwd" placeholder="Enter password">
				</div>
				<button type="submit" onclick="return check_login();" class="btn btn-default id="submit_btn" btn-success btn-block">
				<span class="glyphicon glyphicon-off"></span> Login</button>
			</form>
		</div>
		
		<div class="panel-footer">
			<button type="submit" class="btn btn-default btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
	        <p>Pas encore membre? <a href="#">Inscription</a></p>
	        <p>Oublié votre <a href="#">Password?</a></p>
		</div>

	</div>
	
</div>

<?php require('footer.php'); ?>
