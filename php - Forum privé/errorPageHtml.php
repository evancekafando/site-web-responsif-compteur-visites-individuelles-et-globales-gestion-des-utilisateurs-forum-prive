<?php
	require('header.php');
?>

<div class="container">

	<div id="error_section">
		<div class="page-header">
			<h1>Error !</h1>
		</div>
		<?php
		  if (isset($_GET['err_id']))
		  {
		    if ($_GET['err_id'] == 1)
		    {
		      // Veuiller vous connecter avant de poster un message
		     header('location: loginHtml.php?err_not_login=Veuiller vous connecter avant de poster un message');
		    }
		    elseif ($_GET["err_id"] == 2)
		    {
		      echo '
		      <div class="alert alert-danger">
		        <strong>Erreur! : </strong> Le champ message ne peut pas être vide!
		      </div>
		      ';
		    }
		  }
		?>
	</div>
</div>

<?php
	require('footer.php');
?>