<?php 
 include("includes/includedFiles.php");
?>
<h1 class="pageHeadingBig">Browse</h1>

<div class="gridViewContainer">
	<?php
		$typesQuery = mysqli_query($con, "SELECT * FROM type");
		while($row = mysqli_fetch_array($typesQuery)){
			echo "<div class='gridViewItem'> <span role='link' tabindex='0' onclick='openPage(\"type.php?ID=".$row['ID']."\")'>
				<img src='".$row['typePath']."'>
				<div class='gridViewInfo'>".$row['name']."</div></span>
			</div>";
		} 
	?>
</div>
<!--
<?php include("includes/footer.php"); ?>
-->		