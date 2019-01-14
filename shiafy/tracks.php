<?php include("includes/includedFiles.php"); 
if(isset($_GET['ID']) && isset($_GET['masoom'])) {
	$typeId = $_GET['ID'];
	$masoomName = $_GET['masoom'];
}
elseif (isset($_GET['ID']) && !isset($_GET['masoom'])) {
	header("Location: type.php");
}
else { 
	//header("Location: index.php");
}

$typeQuery = mysqli_query($con, "SELECT * FROM type WHERE ID='$typeId'");
$type = mysqli_fetch_array($typeQuery);

$masoomPicQuery = mysqli_query($con, "SELECT * FROM masoom WHERE name='$masoomName'");
$row = mysqli_fetch_array($masoomPicQuery);
$masoomId = $row['id']; 
$numQuery = mysqli_query($con, "SELECT * FROM tracks WHERE type='$typeId' AND masoom='$masoomId'");
$num = mysqli_num_rows($numQuery);


echo "<div class='entityInfo'>
		<div class='leftSection'>
			<img src='".$row['masoomPath']."'>
		</div>
		<div class='rightSection'>
			<h2>".$row['name']."</h2>
			<p>".$type['name']."s</p>
			<p>".$num." ".$type['name']."s</p>

		</div>
		
	</div>
	";
$tracksQuery  = mysqli_query($con, "SELECT ID FROM tracks WHERE type='$typeId' AND masoom='$masoomId'");
	$trackArray = array();
	while ($tracksRow = mysqli_fetch_array($tracksQuery)) {
		array_push($trackArray, $tracksRow['ID']);
	}
?>

<div class='trackListContainer'>
	<ul class='trackList'>
		<?php
		//$trackIdArray = $tracks->getTrackIds();
		$i = 1;
		foreach ($trackArray as $trackId) {
			$theTrack = new Track($con, $trackId);
			$theTitle = $theTrack->getTitle();
			$theId = $theTrack->getId();
			$theArtist = $theTrack->getArtist();
			$theTime = $theTrack->getDuration();
			echo "<li class='trackListRow'>
				<div class='trackCount'>
				<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"$theId\", tempPlaylist, true)'>
				<span class='trackNumber'>$i.</span>
				</div>
				<div class='trackInfo'>
				<span class='trackName'>$theTitle</span>
				<span class='artistName'>$theArtist</span>
				</div>
				<div class='trackOptions'>
				<img class='optionsButton' src='assets/images/icons/more.png'>
				</div>
				<div class='trackDuration'>
				<span>$theTime</span>
				</div>
			</li>";
			$i++;
			//echo $theTrack->getTitle()."<br>".$theArtist ."<br>" ;
			
		}
		?>
		<script type="text/javascript">
			var tempTrackIds = '<?php echo json_encode($trackArray); ?>';
			tempPlaylist = JSON.parse(tempTrackIds);
		</script>
	</ul>
</div>
<!--
<?php include("includes/footer.php"); ?>
-->