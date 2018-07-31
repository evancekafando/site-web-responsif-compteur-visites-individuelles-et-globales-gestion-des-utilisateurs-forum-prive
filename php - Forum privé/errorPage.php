<?php require("header.php");
	// error message display handler
	if (!isset($_GET["_rsn"]) || $_GET["_rsn"] == "")
	{
		echo '<div style="font-size:100px; text-align:center;margin:20px;" class="alert alert-info">
				<b>404<b><br/> page not found
			</div>';
		header("refresh:2; url=../anciens/");
	}
	else
	{
		$reason = $_GET["_rsn"];
		if ($reason == "login")
		{
			display_error_msg("mot de passe ou nom d'utlisateur incorrect");
			header("refresh:2; url=../admin/loginHtml.php");
		}
		elseif ($reason == "bd_yr")
		{
			display_error_msg("PAS DE RESULTAT !");
			header("refresh:2; url=../anciens/");
		}
		elseif ($reason == "i_a")
		{
			display_error_msg("Vous n'avez pas acces a cette page");
			header("refresh:2; url=../anciens/");
		}
		elseif ($reason == "upd_i")
		{
			display_error_msg("Erreur lors de l'insertion ou la mise à jours");
			header("refresh:2; url=../admin/index_amis.php");
		}
		elseif ($reason == "form")
		{
			display_error_msg("Veuillez remplir le formulaire correctement");
			header("refresh:2; url=../admin/index_amis.php");
		}
		elseif ($reason == "form_s")
		{
			display_error_msg("Veuillez remplir le formulaire correctement");
			header("refresh:2; url=../admin/uploadHtml.php");
		}
		elseif ($reason == "upload_e")
		{
			display_error_msg("Erreur lors du téléchargement de fichiers");
			header("refresh:2; url=../admin/uploadHtml.php");
		}
		elseif ($reason == "url_error")
		{
			display_error_msg("Erreur lors du téléchargement de fichiers");
			header("refresh:2; url=../admin/uploadHtml.php");
		}
		elseif ($reason == "dir_create_e")
		{
			display_error_msg("Echec lors de la création du répertoire");
			header("refresh:2; url=../admin/uploadHtml.php");
		}
		elseif ($reason == "bad_format")
		{
			display_error_msg("Le format fichier choisi n'est pas accepté.</br> Format accepter : jpg, png, jpeg, gif");
			header("refresh:2; url=../admin/uploadHtml.php");
		}
		elseif ($reason == "img_exist")
		{
			display_error_msg("L'image existe déjà!!");
			header("refresh:2; url=../admin/uploadHtml.php");
		}
		elseif ($reason == "img_exist")
		{
			display_error_msg("Le fichier choisi existe déjà");
			header("refresh:2; url=../admin/uploadHtml.php");
		}
		elseif ($reason == "not_img")
		{
			display_error_msg("Le fichier choisi n'est pas une image");
			header("refresh:3; url=../admin/uploadHtml.php");
		}
		elseif ($reason == "update_newPwd_e")
		{
			display_error_msg("Une erreur est survenu lors de la mis à jour du mot de passe");
			header("refresh:3; url=../anciens/");
		}
		elseif ($reason == "f_pwd_e")
		{
			display_error_msg("Votre courriel n'existe pas dans la base de donnée");
			header("refresh:3; url=../anciens/");
		}
		else
		{
			echo '<div style="font-size:100px; text-align:center;margin:20px;" class="alert alert-info">
				<b>404<b><br/> page not found
			</div>';
			header("refresh:2; url=../anciens/");
		}
	}
	require("footer.php");
?>
