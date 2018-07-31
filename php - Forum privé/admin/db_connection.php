<?php
	header('Content-Type: text/html; charset=utf-8');
	$hostname = '';
	$username = '';
	$mot_2_passe = '';
	$db_name = '';
	// la connection vers la base de donnée
	$connectionDB = mysqli_connect($hostname,$username,$mot_2_passe,$db_name);
	mysqli_set_charset ( $connectionDB, "utf8");
	// verification de la connection
	if (!$connectionDB) {
    	die("<h2>Erreur lors la connection</h2>" . mysqli_connect_error());
	}
?>
