<?php
	require('header.php');
?>

<?php

  global $connectionDB;

  if (isset($_POST['comment']) and !(empty(trim($_POST['comment']))))
  {

    // Save the message on a session to insert it when the user logged in
    $_SESSION["message"] = $_POST['comment'];

    if (isset($_SESSION['curr_u_id']))
    {

      if (isset($_SESSION['curr_fil_id']))
      {
        $u_id = $_SESSION['curr_u_id'];
        $fil_id = $_SESSION['curr_fil_id'];
        $u_message = $_POST['comment'];

        $sqlReq = "SELECT MAX(forum_id) AS forum_id FROM t_forum";
    		$reqReponse = mysqli_query($connectionDB,$sqlReq);
    		if ($reqReponse)
    		{
    			if (mysqli_num_rows($reqReponse) > 0)
    			{
    				$dataRecieved = mysqli_fetch_assoc($reqReponse);
    				$forum_id = $dataRecieved["forum_id"];
    				$forum_id += 1;

    				$insertSqlReq = 'INSERT INTO t_forum VALUES ('.$forum_id.','.$u_id.','.$fil_id.',"'.$u_message.'",now())';
    				$insertReqReponse = mysqli_query($connectionDB,$insertSqlReq);
    				if ($insertReqReponse)
    				{
    					header("location: forum.php?fil_id=".$fil_id."");
    				}
            else
            {
              echo '
                <div class="alert alert-danger">
                  <strong>Danger!</strong> Insert error.
                </div>
                ';
            }
    			}
          else
          {
            header("location: forum.php?fil_id=".$fil_id."");
          }
    		}
        else
        {
          header('location: forum.php?fil_id='.$fil_id.'');
        }
      }
      else
      {
          header('location: fils.php');
      }
    }
    else
    {
      header('location: errorPageHtml.php?err_id=1');
    }
    
  }
  else
  {
    header('location: errorPageHtml.php?err_id=2');
  }

?>

<?php
	require('footer.php');
?>
