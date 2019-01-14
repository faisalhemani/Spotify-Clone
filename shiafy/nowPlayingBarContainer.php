<div id="nowPlayingBarContainer">
	<div id="nowPlayingBar">
		<div id="nowPlayingLeft">
			<div class="content">
				<span class="albumLink">
					<img class="albumArtwork" src="https://i.pinimg.com/736x/02/05/11/020511bede2858a41c5bb3b646337a68--album-art-design-album-covers-design.jpg">
				</span>
				<div class="trackInfo">
					<span class="trackName">
						<span>Happy Birthday</span>
					</span>
					<span class="artistName">
						<span>Faisal Hemani</span>
					</span>
				</div>
			</div>
		</div>
		<div id="nowPlayingCenter">
			<div class="content playerControls">
				<div class="buttons">
					<button class="controlButton shuffle" title="shuffle button">
						<img src="assets/images/icons/shuffle.png">
					</button>

					<button class="controlButton previous" title="previous button">
						<img src="assets/images/icons/previous.png">
					</button>

					<button class="controlButton play" title="play button" onclick="playTrack()">
						<img src="assets/images/icons/play.png">
					</button>

					<button class="controlButton pause" title="pause button" style="display: none;" onclick="pauseTrack()">
						<img src="assets/images/icons/pause.png">
					</button>

					<button class="controlButton next" title="next button">
						<img src="assets/images/icons/next.png">
					</button>

					<button class="controlButton repeat" title="repeat button">
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
				<button class="controlButton" title="volumeButton">
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