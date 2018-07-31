<?php 
	require('header.php') ;
	// Enlever un element de la 
	global $connectionDB ; // connection a la DB
	
	if (isset($_GET['f_id'])) 
	{
		$id = $_GET['f_id'] ; 	// id du forum a effacer
		// delete les messages du fil a supprimer
		$sqlReq = "DELETE FROM t_forum WHERE forum_id=$id"; 
		$reqReponse = mysqli_query($connectionDB,$sqlReq);
	}
	else
	{
		$id = $_GET['fil_id'] ; 	// id du forum a effacer
		// delete les messages du fil a supprimer
		$sqlReq = "DELETE FROM t_forum WHERE fil_id=$id"; 
		$reqReponse = mysqli_query($connectionDB,$sqlReq);

		// ensuite delete le fil en question
		$sqlReq = "DELETE FROM t_fils WHERE fil_id=$id"; 
		$reqReponse = mysqli_query($connectionDB,$sqlReq);

		header('location: admin.php');
	}

?>