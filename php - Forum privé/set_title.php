<?php
	require('header.php');
	if (isset($_GET['title']) and isset($_GET['id_fil']))
    {
    	$title = $_GET['title'] ; 	// nouvel titre
    	$id = $_GET['id_fil'] ; 	// id
    	set_title($id, $title) ;
    }
?>