<?php require('header.php')

  // function pager($table_name, $page)
  // {
  //   global $connectionDB;
  //
  //   $sql = "SELECT * FROM ".$table_name."";
  // 	$rs_result = mysqli_query($connectionDB,$sql);
  // 	$total_records = mysqli_num_rows($rs_result);
  // 	$total_pages = ceil($total_records / $num_rec_per_page);
  // 	echo '<ul class="pagination">';
  // 	$points = false;
  // 	for ($i=1; $i<=$total_pages; $i++)
  // 	{
  // 		if ($i <= 5)
  // 		{
  // 			if ($i == $page)
  // 			{
  // 				echo "<li class='active'><a href='../admin/update_amis.php?page=".$i."'>".$i."</a> </li>";
  // 			}
  // 			else
  // 			{
  // 				echo "<li><a href='../admin/update_amis.php?page=".$i."'>".$i."</a> </li>";
  // 			}
  // 		}
  // 		else if($i == ($page - 1) OR $i == $page OR $i == ($page + 1))
  // 		{
  // 			if ($i == $page)
  // 			{
  // 				echo "<li class='active'><a href='../admin/update_amis.php?page=".$i."'>".$i."</a> </li>";
  // 			}
  // 			else
  // 			{
  // 				echo "<li><a href='../admin/update_amis.php?page=".$i."'>".$i."</a> </li>";
  // 			}
  // 			$points = false;
  // 		}
  // 		else if($i >= ($total_pages - 4))
  // 		{
  // 			if ($i == $page)
  // 			{
  // 				echo "<li class='active'><a href='../admin/update_amis.php?page=".$i."'>".$i."</a> </li>";
  // 			}
  // 			else
  // 			{
  // 				echo "<li><a href='../admin/update_amis.php?page=".$i."'>".$i."</a> </li>";
  // 			}
  // 		}
  // 		else if(!$points)
  // 		{
  // 		    $points = true;
  // 		    if ($i == $page)
  // 			{
  // 				echo "<li class='active'><a href='../admin/update_amis.php?page=".$i."'>".$i."</a> </li>";
  // 			}
  // 			else
  // 			{
  // 				echo "<li><a href='../admin/update_amis.php?page=".$i."'>...</a> </li>";
  // 			}
  // 		}
  // 	 }
  // 	 echo '</ul>';
  //   }
  //   else
  //   {
  //   	display_error_msg("PAS DE RESULTAT!");
  //   	echo '<div class="ret_arriere">
  //   			<a href="../admin/update_amis.php">Revenir en arrière</a>
  //   		</div>';
  //   }

  require('footer.php');
?>
