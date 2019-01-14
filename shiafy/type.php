<?php include("includes/includedFiles.php"); 
if(isset($_GET['ID'])) {
	$typeId = $_GET['ID'];
}
else { header("Location: index.php");}

$typeQuery = mysqli_query($con, "SELECT * FROM type WHERE ID='$typeId'");
$type = mysqli_fetch_array($typeQuery);

echo "<h1 class='pageHeadingBig'>".$type['name']."</h1>";

$masoomQuery = mysqli_query($con, "SELECT DISTINCT name, masoomPath FROM masoom INNER JOIN tracks ON masoom.id=tracks.masoom WHERE tracks.type='$typeId'");
while($row = mysqli_fetch_array($masoomQuery)){ 
	echo "<div class='gridViewItem'> <span role='link' tabindex='0' onclick='openPage(\"tracks.php?ID=".$typeId."&masoom=".$row['name']."\")'> 
				<img src='".$row['masoomPath']."'>
				<div class='gridViewInfo'>".$row['name']."</div></span>
			</div>";
		}
?>
<!--
<?php include("includes/footer.php"); ?>
-->

