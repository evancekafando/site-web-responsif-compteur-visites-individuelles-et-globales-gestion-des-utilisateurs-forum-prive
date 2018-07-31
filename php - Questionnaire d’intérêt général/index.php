<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Questionnaire d'int&eacute;r&ecirc;t g&eacute;n&eacute;rale</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  
  <div class="container">
    <div class="row">
      <div class="col-sm-2"></div>
      <div class="col-sm-8">
        <h1>Questionnaire d'int&eacute;r&ecirc;t g&eacute;n&eacute;rale</h1>
        <hr />
        <form id="questionnaire">
          <?php
            //on etablit une connection initiale a la base de donnees
            $con = mysqli_connect("localhost", "martin", "bour1520", "db_martin");
        
            if (mysqli_connect_errno())
            {
              echo "Erreur de connection a MySQL:" . mysqli_connect_error();
            }
            else
            {
              //requete SQL pour retrouver les questions
              $sqlQuestions = "SELECT question_id, question, multiple FROM t_questions";

              //query pour avoir les questions et leurs IDs
              if ($dbQuestions = mysqli_query($con, $sqlQuestions))
              {
                while($question = mysqli_fetch_object($dbQuestions))
              {
 
                  echo "<h4>" . $question->question_id . ". " . htmlspecialchars($question->question) . "</h4><br />\n";

                  //Query pour recevoir les choix possible pour les questions
                  $sqlChoix = "SELECT choix_id, choix FROM t_choix WHERE question_id=" . $question->question_id;

                  //connection a la BD
                  if ($dbChoix = mysqli_query($con, $sqlChoix))
                  {
                    while($choix = mysqli_fetch_object($dbChoix))
                    {
                      //le code html a afficher pour chaque choix
                      $output = "";

                      //determine si on doit utiliser des bouttons radios ou checkbox
                      if($question->multiple == 0)
                      {
                        $output = $output."<label><input type=\"radio\"";
                      }
                      else
                      {
                        $output = $output."<label><input type=\"checkbox\"";
                      }
                   
                      $output = $output." name=\"q".$question->question_id."\" value=\"".$choix->choix_id."\"> ".$choix->choix;
                   
                      //on ajoute un champ de text si le choix est "Autre"
                      if ($choix->choix === "Autre")
                      {
                        $output = $output." <input type=\"text\" name=\"q".$question->question_id."Autre\" />";
                      }
                      
                      $output = $output."</label></br>";
                      echo $output."\n";
                    }
                  }
              
                  echo "<hr />\n";

                }
              }
            }
            //fermeture de la connection a la BD
            mysqli_close($con);
          ?>
          
          <input type="submit" id="sub" value="Soumettre"/>
        </div>
        <div class="col-sm-2"></div>
      </div>
    </form>
    <br />
    <br />
  </div>
  <script >

//            $(document).ready(function() {
//              var reponses = {};
//              var tab = [];

             /* $('#sub').click(function(event) {
                event.preventDefault();*/
//                $('#questionnaire').submit(function() {
	                //console.log("bob");
//	                $.each($("input:checked"), function(){
//	                  if($(this).attr("type") == "radio") {
//	                    reponses['question_name'] = parseInt($(this).attr("name").split("q")[1]);
	                    //console.log("udajkd : "+reponses['question_name']);
//	                    reponses['choix_value'] = $(this).attr("value");
	                    //console.log("udajkd : "+reponses['choix_value']);
//	                    reponses['texte'] = $(this).parent().text();
	                    //console.log("udajkd : "+reponses['texte']);
//	                    tab.push(reponses);
//	                  }
//	                  else if($(this).attr("type") == "checkbox") {
	                    //console.log("hello");
//	                    reponses['question_name'] = parseInt($(this).attr("name").split("q")[1]);
	                   // console.log("name : "+reponses['question_name']);
//	                    reponses['choix_value'] = $(this).attr("value");
	                   // console.log("value : "+reponses['choix_value']);
//	                    reponses['texte'] = $(this).parent().text();
	                   // console.log("texte : "+reponses['texte']);
//	                    tab.push(reponses);                  
//	                  }
	                 
//	                });

	                /*$.ajax({
	                  url : "reponse.php",
	                  method : "POST",
	                  data : JSON.stringify(tab),
	                  dataType : "text",
	                  success: function(msg,status){
	                          alert(JSON.stringify(msg));
	                  },
	                  complete: function(){

	                  },
	                  error: function(donnees,status, erreur ){
	                    alert("error: " + erreur);
	                  }
	                });*/
//	                jQuery.post("reponse.php",JSON.stringify(tab), function(data){ alert(data); });
//                });
//            });

            //fonction javascript appele quand l'utilisateur soummet le formulaire
//            $(document).ready(function(){
              $("#questionnaire").submit(function(){
                //alert("HEY LISTEN!");
                
                $("input:checked").each(function(){
                  //lecture du nom de la question et selection de l'id
                  var question = $(this).attr("name");
                  var questionId = question.substr(1);

                  //choix_id est la valeur du input
                  var choixId = $(this).val();

                  //capture du texte "autre" s'il existe
                  var texteAutre = "";
                  if ( texteAutre= $("input[name=q"+questionId+"Autre").val() );
                  /*else
                  	texteAutre = $(this).parent().text();*/

                  //requete ajax au serveur
                  /*$.ajax({
                    method: "POST",
                    url: "reponse.php",
                    data: { 
                      question_name : questionId,
                      choix_value : choixId, 
                      texte : texteAutre 
                      }
                  }).fail(function(){alert("error");});*/
                  $.post("reponse.php", { question_name: questionId, choix_value: choixId, texte: texteAutre}, function(data){console.log(data);});

                  //console.log(questionId);
                  //console.log(choixId);
                  //console.log(texteAutre);
                });
		clearInput();
                return false;
              });
				
	      function clearInput() {
	          $("#questionnaire : input").each(function() {
		      $(this).checked(false);
		  });
	      }
//            });
            
          </script>
</body>
</html>
