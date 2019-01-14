<?php
include("includes/config.php");
include("includes/classes/Track.php");
//session_destroy();
if(isset($_SESSION['userLoggedIn'])){
	$userLoggedIn = $_SESSION['userLoggedIn'];
	echo "<script>userLoggedIn = '$userLoggedIn'</script>";
}
else{
	header("Location: register.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Shiafy</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="assets/js/script.js"></script>
</head>
<body>
	<script type="text/javascript">
		//var audioElement  = new Audio();
		//audioElement.setTrack("assets/tracks/BhayyaMeinBinTumharayWatanKoNaJaungi.mp3");
		//
		//audioElement.audio.play();
	</script>>

	<div id="mainContainer">
		<div id="topContainer">
			<?php 
				include("includes/navbarContainer.php");
			?>
			<div id="mainViewContainer">
				<div id="mainContent">
					
				</div>