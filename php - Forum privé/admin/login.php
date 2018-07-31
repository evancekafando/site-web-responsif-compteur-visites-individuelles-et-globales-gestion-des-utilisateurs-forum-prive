<?php require("../anciens/header.php"); ?>
	<div>
		<?php
			if (isset($_POST["username"]) && isset($_POST["mot2passe"]))
			{
				$user = trim(htmlspecialchars($_POST["username"])) ;
				$pwd = trim(htmlspecialchars($_POST["mot2passe"]));
				$sqlCheck = "SELECT username,password FROM t_users WHERE username = '".$user."' AND password = '".$pwd."'";
				$repCheck = mysqli_query($connectionDB,$sqlCheck);
				if (mysqli_num_rows($repCheck) > 0)
				{
					while ($donnee = mysqli_fetch_assoc($repCheck))
					{
						$reqPr = "SELECT privilege FROM t_users WHERE username = '".$user."' AND password = '".$pwd."'";
						$repPr = mysqli_query($connectionDB,$reqPr);
						if (mysqli_num_rows($repPr) > 0)
						{
							$_SESSION["usernameCurr"] = $donnee["username"] ;
							$dataR = mysqli_fetch_assoc($repPr);
							if ($dataR["privilege"] == "admin")
							{
								$_SESSION["privUser"] = "admin";
								header("location: ../admin/index_admin.php");
							}
							else
							{
								$_SESSION["privUser"] = "user";
								header("location: url=../anciens/");
							}
						}
					}
				}
				else
				{
					// gestionnaire de recuperation de mot de passe
					/*if (isset($_SESSION["con_attempt"]))
					{
						if ($_SESSION["con_attempt"] >= 2)
						{
							$_SESSION["con_attempt"] = 0;
							header("location: ../admin/forget_pwdHtml.php");
						}
						$_SESSION["con_attempt"] += 1;
					}
					else
					{
						$_SESSION["con_attempt"] = 1;
					}*/
					header("refresh:0; url=../admin/errorPage.php?_rsn=login");
				}
			}
			else
			{
				header("refresh:0; url=../admin/errorPage.php?_rsn=login");
			}
			mysqli_close($connectionDB);// pour fermer la connection
		?>
	</div>
<?php require("../anciens/footer.php"); ?>
