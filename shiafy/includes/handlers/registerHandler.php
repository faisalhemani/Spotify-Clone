<?php
include("includes/config.php");
include("includes/classes/Account.php");
include("includes/classes/Constants.php");
	$account = new Account($con);
if(isset($_POST['registerButton'])){
	//register button was pressed
	$username = sanitizeFormUsername($_POST["registerUsername"]);
	$Firstname = sanitizeFormString($_POST["registerFirstname"]);
	$Lastname = sanitizeFormString($_POST["registerLastname"]);
	$email = sanitizeFormString($_POST["registerEmail"]);
	$emailConfirm = sanitizeFormString($_POST["registerEmailConfirm"]);
	$password = sanitizeFormPassword($_POST["registerPassword"]);
	$passwordConfirm = sanitizeFormPassword($_POST["registerPasswordConfirm"]);
	$wasSuccessful = $account->register($username, $Firstname, $Lastname, $email, $emailConfirm, $password, $passwordConfirm);
	if($wasSuccessful){
		$_SESSION['userLoggedIn'] = $username;
		header("Location: index.php");
	}
}

function sanitizeFormUsername($inputText){
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	return $inputText;
}
function sanitizeFormString($inputText){
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	$inputText = ucfirst(strtolower($inputText));
	return $inputText;
}
function sanitizeFormPassword($inputText){
	$inputText = strip_tags($inputText);
	return $inputText;
}

?>
