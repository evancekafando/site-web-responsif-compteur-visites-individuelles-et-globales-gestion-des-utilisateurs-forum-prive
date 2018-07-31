<?php require('header.php'); ?>

<div class="container">
  
  
    <?php
        if (isset($_GET['err_not_login']))
        {
          // Veuiller vous connecter avant de poster un message
          echo '
          <div id="error_section"> 
            <div style="text-align: center;" class="alert alert-danger">
              <strong>'.$_GET["err_not_login"].' </strong>
            </div>
           </div>';
        }
    ?>

  <div class="panel panel-default">

    <div class="panel-heading panel-heading-login">
          <h4 style="color:black;"><span class="glyphicon glyphicon-lock"></span> Connexion</h4>
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
        <button type="submit" class="btn btn-default btn-success btn-block" id="submit_btn">
        <span class="glyphicon glyphicon-off"></span> Login</button>
      </form>
    </div>
    
    <div class="panel-footer">
      <p>Pas encore membre? <a href="#">Inscription</a></p>
      <p>Oublié votre <a href="#">Password?</a></p>
    </div>

  </div>

</div>

<?php require('footer.php'); ?>
