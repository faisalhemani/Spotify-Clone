<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
	include("includes/classes/Track.php");
	include("includes/config.php");
	//exit();
} else {
	include("includes/header.php");
	include("includes/footer.php");
	$url = $_SERVER['REQUEST_URI'];
	echo "<script>openPage('$url')</script>";
	exit();
}
?>