<?php
	require('header.php');
	
	if (isset($_POST["usrname"]) && isset($_POST["pwd"])) 
	{
		$usrname = $_POST["usrname"];
		$pwd = $_POST["pwd"];
		login($usrname, $pwd);
	}

	require('footer.php');
?>
