<?php
	$con = mysqli_connect("localhost", "martin", "bour1520", "db_martin");
    //$bob = json_decode(stripslashes($_POST['dt']));
    //echo $bob;
	
	$question_id = mysql_escape_string($_POST['question_name']);
	$choix_id = mysql_escape_string($_POST['choix_value']);
	$texte = mysql_escape_string($_POST['texte']);

	if(mysql_query("INSERT INTO t_reponse (question_id, choix_id, texte) VALUES('$question_id', '$choix_id', '$texte')", $con))
		echo "Merci de prendre votre temps pour repondre a ce sondage...";
	else
		echo "Erreur dans l'insertion dans la base de donnees";

?>