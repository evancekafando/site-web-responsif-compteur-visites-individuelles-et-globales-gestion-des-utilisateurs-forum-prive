<?php
	require('header.php');
?>

<div class="container">

  <div class="panel panel-default">

    <div class="panel-heading">
      
        <?php 
              $fil_id = 1;
              if (isset($_GET['fil_id'])) 
              {
                $fil_id = $_GET["fil_id"];
                $_SESSION["curr_fil_id"] = $fil_id; 
              } 
              panel_heading(get_title($fil_id));
        ?>
      
    </div>

    <div id="messages" class="panel-body">

      <?php
				$page = 1;
				if(isset($_GET['page']))
				{
					$page = $_GET['page'];
				}
				pager("t_forum",$page, $fil_id);
			?>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>Auteur</th>
            <th>Message</th>
          </tr>
        </thead>
        <tbody>

          <?php
            // on affiche la liste des message poster dans ce fil de discussion précis
            retrive_forum($fil_id,$page);
          ?>

        </tbody>
      </table>

      <?php
				pager("t_forum",$page,$fil_id);
			?>
    </div>
  </div>

  <?php

    echo '
          <!-- section d\'insertion de message -->
          <form role="form" action="msg.php" method="post">
            <div class="form-group">
              <label for="comment">Message:</label>
              <textarea name="comment" class="form-control" rows="6" id="comment"></textarea>
            </div>
            <button type="submit" onclick="return verification_reponse();" class="btn btn-primary">Repondre</button>
          </form>';
  
  ?>
</div>

<?php
	require('footer.php');
?>
