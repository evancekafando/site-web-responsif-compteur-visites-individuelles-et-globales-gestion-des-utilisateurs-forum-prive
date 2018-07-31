<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
</head>

<body>
    <div id="pagetitle">
        <strong><center><h1> Questionnaire d'interet general </h1></center></strong>
    </div>
    <?php
         //require("connectionBD.php");
         $conn = mysqli_connect("localhost", "epm9135", "mugi1520", "db_pierrette");
         mysqli_select_db($conn, "db_pierrette") or die("Unable to select db.");
         $requete = "SELECT * FROM t_questions";
         $tuples = mysqli_query($conn, $requete);
	 
	 
	 echo'<div style ="border-style:groove; margin:20px; border-width:4px;">';
	 echo'<form action="questionnaire.php>"';
	 if(($row = mysqli_fetch_array($tuples)) == true)
	 {
	     do{
		$q = 0;
	     	$question .= '<strong> '.$row["question_id"].'. '.$row["question"].' </strong>';
	     	$reponses = mysql_query('SELECT * FROM t_reponses WHERE question_id = '.$row["question_id"]);
	     	while($rep = mysqli_fetch_array($reponses))
		{
		    $q++;
		    $question .= '<input type="checkbox" id="'.$repo["reponse_id"].';" name="q'.$rep["reponse_id"].''.$rep["reponse_id"].''.$q.'" '.$rep["text"].'<br />';
		}
		echo $question;
	     }while($row);
	 }
	 echo'</form>';
	 echo'</div>';
    ?>
</body>
<html>
