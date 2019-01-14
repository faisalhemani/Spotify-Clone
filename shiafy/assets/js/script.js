var curretPlaylist = [];
var shufflePlaylist = [];
var tempPlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;
var timer;
function openPage(url) {
	if(timer != null){
		clearTimeout(timer);
	}
	if(url.indexOf("?") == -1) {
		url = url + "?";
	}
	var encodeUrl = encodeURI(url + "&userLoggedIn="+ userLoggedIn);
	$(".entityInfo").hide();
	$(".trackListContainer").hide();
	$("#mainContent").load(encodeUrl);
	$("body").scrollTop(0);
	history.pushState(null, null, url);
}

function format(sec){
	var time = Math.round(sec);
	var min = Math.floor(time/60);
	var seconds = time - (min * 60);
	var extraZero;
	if(seconds<10){
		extraZero = "0";
	} else {
		extraZero = "";
	}
	return min+":"+extraZero+seconds;
}
function updateTimeProgressBar(audio) {
	$(".progressTime.current").text(format(audio.currentTime));
	$(".progressTime.remaining").text(format(audio.duration - audio.currentTime));
	var progress = audio.currentTime / audio.duration * 100;
	$(".playbackBar .progress").css("width",progress+"%");
}
function updateVolumeProgressBar(audio) {
	var volume = audio.volume * 100;
	$(".volumeBar .progress").css("width", volume+"%");
}
function Audio(){
	this.currentlyPlaying;
	this.audio = document.createElement("audio");

	this.audio.addEventListener("ended", function(){
		nextTrack();
	});

	this.audio.addEventListener("canplay", function(){
		var duration = format(this.duration);
		$(".progressTime.remaining").text(duration);
	});

	this.audio.addEventListener("timeupdate", function(){
		if(this.duration){
			updateTimeProgressBar(this);
		}
	});

	this.audio.addEventListener("volumechange", function(){
		updateVolumeProgressBar(this);
	});

	this.setTrack = function (track) {
		this.currentlyPlaying = track;
		this.audio.src = track.path;
	}

	this.pause = function () {
		this.audio.pause();
	}

	this.play = function () {
		this.audio.play();
	}

	this.setTime = function (seconds) {
		this.audio.currentTime = seconds
	}
}