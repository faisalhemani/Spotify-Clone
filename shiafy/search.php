<?php
include("includes/includedFiles.php");

if(isset($_GET['term'])){
	$term = urldecode($_GET['term']);
} else {
	$term = '';
}

?>

<div class="searchContainer">
	<h4>Search for a track name</h4>
	<input type="text" name="" class="searchInput" value="<?php echo $term; ?>" onfocus="this.value = this.value;" placeholder="Start Typing...." >
</div>

<script>
	$(".searchInput").focus();
	$(function(){
		$(".searchInput").keyup(function(){
			clearTimeout(timer);
			timer = setTimeout(function(){
				var val = $(".searchInput").val();
				openPage("search.php?term="+val);
			}, 2000);
		})
	})
</script>

<div class="tracklistContainer borderBottom">
	<h2>TRACKS</h2>
	<?php 
		$trackQuery = mysqli_query($con, "SELECT id FROM tracks WHERE title LIKE '%$term%' ");
		if(mysqli_num_rows($trackQuery) == 0) {
			echo "<span class='noResults'>No tracks found matching:" .$term ."</span>";
		}
		$trackIdArray = array();
		$i = 1;
		while($row = mysqli_fetch_array($trackQuery)) {
			if ($i > 15) {
				break;
			}
			array_push($trackIdArray, $row['id']);
			$theTrack = new Track($con, $row['id']);
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
		}
	?>
	
</div>

