<?php
	require('header.php');
?>

<div class="container">

	<div class="panel panel-default">

		<div class="panel-heading">
			<?php panel_heading("Forum privé"); ?>
		</div>

		<div class="panel-body">

			<?php
				$page = 1;
				if(isset($_GET['page']))
				{
					$page = $_GET['page'];
				}
				pager("t_fils",$page, 1);
			?>

			<div class="table table-striped">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Sujets</th>
							<th>Réponse</th>
							<th>Dernière réponse</th>
						</tr>
					</thead>
					<tbody>

						<?php
							// for pour chercher la liste des fils crées
							retrive_fils($page);
						?>

					</tbody>
				</table>

				<?php
					pager("t_fils",$page, 2);
				?>

			</div>
		</div>

	</div>

</div>


<?php
	require('footer.php');
?>
