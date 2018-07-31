<?php
	$con = mysqli_connect("localhost", "martin", "bour1520", "db_martin");
	
	$question_id = 0;
	$choix_id = 0;
	$texte = "";


	if(mysqli_connect_errno())
	{
		echo "Erreur de connection a MySQL:" . mysqli_connect_error();
	}
	else
	{
		$question_id = $_POST["question_name"];
		$choix_id = $_POST["choix_value"];
		$texte = $_POST["texte"];

		echo "question_id: ".$question_id."\nchoix_id: ".$choix_id."\ntexte: ".$texte."\n";

		if(mysqli_query($con, "INSERT INTO t_reponses (question_id, choix_id, texte) VALUES(".$question_id.", ".$choix_id.", \"".$texte."\");"))
			echo "Merci de prendre votre temps pour repondre a ce sondage...\n";
		else
			echo "Erreur dans l'insertion dans la base de donnees\n";

		mysqli_close($con);
	}
?>
