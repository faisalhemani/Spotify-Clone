<?php
$trackQuery = mysqli_query($con, "SELECT ID FROM tracks ORDER BY RAND() LIMIT 10");
$resultArray = array();
while ($row = mysqli_fetch_array($trackQuery)) {
	array_push($resultArray, $row['ID']);
}
$jsonArray = json_encode($resultArray);
?>

<script type="text/javascript">
$(document).ready(function(){
	var newPlaylist = <?php
			echo $jsonArray;
		?>;
	currentPlaylist = [];
		console.log(newPlaylist);
	audioElement = new Audio();
	setTrack(newPlaylist[0], newPlaylist, false);
	updateVolumeProgressBar(audioElement.audio);
	$("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e){
		e.preventDefault  ();
	})
	$(".playbackBar .progressBar").mousedown(function(){
		mouseDown = true;
	});
	$(".playbackBar .progressBar").mousemove(function(e){
		if(mouseDown == true){
			timeFromOffset(e, this);
		}
	});
	$(".playbackBar .progressBar").mouseup(function(e){
		timeFromOffset(e, this);
	});

	$(".volumeBar .progressBar").mousedown(function(){
		mouseDown = true;
	});
	$(".volumeBar .progressBar").mousemove(function(e){
		if(mouseDown == true){
			var percentage = e.offsetX / $(this).width();
			if (percentage>=0 && percentage<=1){
			audioElement.audio.volume = percentage;
			}
		}
	});
	$(".volumeBar .progressBar").mouseup(function(e){
		var percentage = e.offsetX / $(this).width();
		if (percentage>=0 && percentage<=1){
			audioElement.audio.volume = percentage;
		}
	});

	$(document).mouseup(function(){
		mouseDown = false;
	});
});

function timeFromOffset(mouse, progressBar){
	var percentage = mouse.offsetX / $(progressBar).width() * 100;
	var seconds = audioElement.audio.duration * (percentage / 100);
	audioElement.setTime(seconds);
}

function prevTrack(){
	if(audioElement.audio.currentTime >= 3 || currentIndex == 0) {
		audioElement.setTime(0);
	} else {
		currentIndex--;
		setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
	}
}

function nextTrack(){
	if(repeat){
		audioElement.setTime(0);
		playTrack();
		return;
	}
	if(currentIndex == currentPlaylist.length - 1){
		currentIndex = 0;
	} else {
		currentIndex++;
	}
	var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
	setTrack(trackToPlay, currentPlaylist, true);
}

function setRepeat(){
	repeat = !repeat;
	var imageName = repeat ? "repeat-active.png" : "repeat.png";
	$(".controlButton.repeat img").attr("src", "assets/images/icons/"+ imageName);
}

function setMute(){
	audioElement.audio.muted = !audioElement.audio.muted;
	var imageName = audioElement.audio.muted ? "volume-mute.png" : "volume.png";
	$(".controlButton.volume img").attr("src", "assets/images/icons/"+ imageName);
}

function setShuffle(){
	shuffle = !shuffle;
	var imageName = shuffle ? "shuffle-active.png" : "shuffle.png";
	$(".controlButton.shuffle img").attr("src", "assets/images/icons/"+ imageName);
	if(shuffle){
		shuffleArray(shufflePlaylist);
		currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
	} else {
		currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
	}
}

function shuffleArray(a) {
    var j, x, i;
    for (i = a.length - 1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        x = a[i];
        a[i] = a[j];
        a[j] = x;
    }
    return a;
}

function setTrack(trackId, newPlaylist, play){
	if(newPlaylist != currentPlaylist){
		currentPlaylist = newPlaylist;
		shufflePlaylist = currentPlaylist.slice();
		shuffleArray(shufflePlaylist);
	}
	if(shuffle){
		currentIndex = shufflePlaylist.indexOf(trackId);	
	} else {
		currentIndex = currentPlaylist.indexOf(trackId);
	}
	pauseTrack();
	$.post("includes/handlers/ajax/getSongJson.php", {songId: trackId}, function(data){

		var track = JSON.parse(data);
		audioElement.setTrack(track);
		$(".trackName span").text(track.title);
		$.post("includes/handlers/ajax/getArtistJson.php", {artistId: track.artist}, function(data){
			console.log(data);
			var artist = JSON.parse(data);
			$(".artistName span").text(artist.name);
		});
		//playTrack();
		if(play){
		audioElement.play();
		$(".controlButton.play").hide();
		$(".controlButton.pause").show();
	}
	});
	
	
}

function playTrack() {
	$(".controlButton.play").hide();
	$(".controlButton.pause").show();
	audioElement.play();
}

function pauseTrack() {
	$(".controlButton.play").show();
	$(".controlButton.pause").hide();
	audioElement.pause();
}
</script>
<div id="nowPlayingBarContainer">
	<div id="nowPlayingBar">
		<div id="nowPlayingLeft">
			<div class="content">
				<div class="trackInfo">
					<span class="trackName">
						<span></span>
					</span>
					<span class="artistName">
						<span></span>
					</span>
				</div>
			</div>
		</div>
		<div id="nowPlayingCenter">
			<div class="content playerControls">
				<div class="buttons">
					<button class="controlButton shuffle" title="shuffle button" onclick="setShuffle()">
						<img src="assets/images/icons/shuffle.png">
					</button>

					<button class="controlButton previous" title="previous button" onclick="prevTrack()">
						<img src="assets/images/icons/previous.png">
					</button>

					<button class="controlButton play" title="play button" onclick="playTrack()">
						<img src="assets/images/icons/play.png">
					</button>

					<button class="controlButton pause" title="pause button" style="display: none;" onclick="pauseTrack()">
						<img src="assets/images/icons/pause.png">
					</button>

					<button class="controlButton next" title="next button" onclick="nextTrack()">
						<img src="assets/images/icons/next.png">
					</button>

					<button class="controlButton repeat" title="repeat button" onclick="setRepeat()">
						<img src="assets/images/icons/repeat.png">
					</button>
				</div>
				<div class="playbackBar">
					<span class="progressTime current">0:00</span>
					<div class="progressBar">
						<div class="progressBarBg">
							<div class="progress"></div>
						</div>
					</div>
					<span class="progressTime remaining">0:00</span>
				</div>
			</div>
		</div>
		<div id="nowPlayingRight">
			<div class="volumeBar">
				<button class="controlButton volume" title="volumeButton" onclick="setMute()">
					<img src="assets/images/icons/volume.png" alt="volume">
				</button>
				<div class="progressBar">
						<div class="progressBarBg">
							<div class="progress"></div>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>