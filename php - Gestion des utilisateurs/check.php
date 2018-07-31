<?php
	if(!isset($_SESSION['u_login']))
	{
		echo "<center><font face='Verdana' size='2' color=red>Sorry, Please <a href=login.php>login</a> and use this page </font></center>";
	}
	else
	{
		echo "<p style='text-align:right'><font face='Verdana' size='2' color=green>Bonjour, $_SESSION[u_login] . <a href=modifier_profile.php>Modifier Profile</a> . <a href=logout.php>se déconnecter</a></font></p>";
	}
?>
